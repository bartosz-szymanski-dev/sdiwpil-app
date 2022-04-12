<?php

namespace App\Service\Document;

use App\Entity\Document;
use App\Entity\Prescription;
use App\Form\Document\DocumentType;
use App\Service\FormErrorService;
use App\Service\RequestService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use GuzzleHttp\Utils;
use Psr\Log\LoggerInterface;
use Sentry\Client;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;

class CreateNewDocumentService extends RequestService
{
    private const SUCCESS = 'success';
    private const LIST = 'list';
    private const ERRORS = 'errors';

    private array $response = [
        self::SUCCESS => false,
        self::LIST => [],
        self::ERRORS => [],
    ];

    private LoggerInterface $logger;
    private Client $sentry;
    private FormFactoryInterface $formFactory;
    private FormErrorService $formErrorService;
    private EntityManagerInterface $entityManager;
    private PrescriptionService $prescriptionService;

    public function __construct(
        RequestStack $requestStack,
        LoggerInterface $logger,
        Client $sentry,
        FormFactoryInterface $formFactory,
        FormErrorService $formErrorService,
        EntityManagerInterface $entityManager,
        PrescriptionService $prescriptionService
    ) {
        parent::__construct($requestStack);

        $this->logger = $logger;
        $this->sentry = $sentry;
        $this->formFactory = $formFactory;
        $this->formErrorService = $formErrorService;
        $this->entityManager = $entityManager;
        $this->prescriptionService = $prescriptionService;
    }

    public function getJsonResponse(): JsonResponse
    {
        $this->init();

        return new JsonResponse($this->response);
    }

    private function handleException(Exception $exception): void
    {
        $this->logger->error($exception->getMessage());
        $this->sentry->captureException($exception);
        $this->response[self::ERRORS][] = ['message' => 'Coś poszło nie tak, przepraszamy.'];
    }

    private function createDocument(Document $document): void
    {
        if ($document->getType() === Document::PRESCRIPTION_TYPE) {
            $this->prescriptionService->createPrescription($document);
        }
    }

    private function processDataWithForm(): void
    {
        $form = $this->formFactory->create(DocumentType::class)->submit(
            Utils::jsonDecode($this->request->getContent(), true)
        );
        if ($form->isValid()) {
            $this->createDocument($form->getData());
        } else {
            $this->response[self::ERRORS] = $this->formErrorService->getArray($form);
        }
    }

    private function init(): void
    {
        try {
            $this->processDataWithForm();
        } catch (Exception $exception) {
            $this->handleException($exception);
        }
    }
}
