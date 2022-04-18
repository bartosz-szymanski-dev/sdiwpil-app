<?php

namespace App\Service\Document;

use App\Entity\DoctorData;
use App\Entity\Document;
use App\Form\Document\NewDocumentType;
use App\Service\FormErrorService;
use App\Service\PaginatedRequestService;
use App\Service\RequestService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use GuzzleHttp\Utils;
use Psr\Log\LoggerInterface;
use Sentry\ClientInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;

class NewDocumentService extends RequestService
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
    private ClientInterface $sentry;
    private FormFactoryInterface $formFactory;
    private FormErrorService $formErrorService;
    private PrescriptionService $prescriptionService;
    private EntityManagerInterface $entityManager;
    private DocumentFrontEndStructureService $documentFrontEndStructureService;
    private PaginatedRequestService $paginatedRequestService;

    public function __construct(
        RequestStack $requestStack,
        LoggerInterface $logger,
        ClientInterface $sentry,
        FormFactoryInterface $formFactory,
        FormErrorService $formErrorService,
        PrescriptionService $prescriptionService,
        EntityManagerInterface $entityManager,
        DocumentFrontEndStructureService $documentFrontEndStructureService,
        PaginatedRequestService $paginatedRequestService
    ) {
        parent::__construct($requestStack);

        $this->logger = $logger;
        $this->sentry = $sentry;
        $this->formFactory = $formFactory;
        $this->formErrorService = $formErrorService;
        $this->prescriptionService = $prescriptionService;
        $this->entityManager = $entityManager;
        $this->documentFrontEndStructureService = $documentFrontEndStructureService;
        $this->paginatedRequestService = $paginatedRequestService;
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

    private function createDocument(array $documentData): void
    {
        if ($documentData['type'] === Document::PRESCRIPTION_TYPE) {
            $this->prescriptionService->createPrescription($documentData);
        }
    }

    private function setList(DoctorData $doctor): void
    {
        $this->response[self::LIST] = $this->documentFrontEndStructureService->getFrontEndStructure(
            $this->entityManager->getRepository(Document::class)->getPaginatedDocuments(
                $this->paginatedRequestService->getMinMax(),
                $doctor
            )
        );
    }

    private function processDataWithForm(): void
    {
        $form = $this->formFactory->create(NewDocumentType::class)->submit(
            Utils::jsonDecode($this->request->getContent(), true)
        );

        if ($form->isValid()) {
            $doctor = $form->get('doctor')->getData();
            $this->createDocument($form->getData());
            $this->setList($doctor);
            $this->response[self::SUCCESS] = true;
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
