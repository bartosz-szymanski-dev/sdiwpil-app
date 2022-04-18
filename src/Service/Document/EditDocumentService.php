<?php

namespace App\Service\Document;

use App\Entity\Document;
use App\Form\Document\EditDocumentType;
use App\Service\FormErrorService;
use App\Service\RequestService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use GuzzleHttp\Utils;
use Psr\Log\LoggerInterface;
use Sentry\ClientInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class EditDocumentService extends RequestService
{
    private const SUCCESS = 'success';
    private const LIST = 'list';
    private const ERRORS = 'errors';

    private array $response = [
        self::SUCCESS => false,
        self::LIST => [],
        self::ERRORS => [],
    ];

    private FormFactoryInterface $formFactory;
    private FormErrorService $formErrorService;
    private EntityManagerInterface $entityManager;
    private ClientInterface $sentry;
    private LoggerInterface $logger;

    public function __construct(
        FormFactoryInterface $formFactory,
        FormErrorService $formErrorService,
        EntityManagerInterface $entityManager,
        RequestStack $requestStack,
        ClientInterface $sentry,
        LoggerInterface $logger
    ) {
        parent::__construct($requestStack);

        $this->formFactory = $formFactory;
        $this->formErrorService = $formErrorService;
        $this->entityManager = $entityManager;
        $this->sentry = $sentry;
        $this->logger = $logger;
    }

    public function getJsonResponse(): JsonResponse
    {
        $this->init();

        return new JsonResponse($this->response);
    }

    private function savePrescriptionData(Document $document, array $documentData): void
    {
        if ($document->getType() === Document::PRESCRIPTION_TYPE && $prescription = $document->getPrescription()) {
            $prescription
                ->setMedicamentName($documentData['medicamentName'])
                ->setMedicamentDescription($documentData['medicamentDescription'])
                ->setMedicamentUsageDescription($documentData['medicamentUsageDescription'])
                ->setMedicamentRemission($documentData['medicamentRemission']);
            $this->entityManager->persist($prescription);
        }
    }

    private function saveData(array $documentData): void
    {
        /** @var Document $document */
        $document = $documentData['document'];
        $document
            ->setPatient($documentData['patient'])
            ->setType($documentData['type']);
        $this->savePrescriptionData($document, $documentData);

        $this->entityManager->persist($document);
        $this->entityManager->flush();
    }

    private function checkRequest(): void
    {
        if (!$this->request->getContent()) {
            throw new BadRequestHttpException();
        }
    }

    private function processDataWithForm(): void
    {
        $form = $this->formFactory->create(EditDocumentType::class)->submit(
            Utils::jsonDecode($this->request->getContent(), true)
        );

        if ($form->isValid()) {
            $this->saveData($form->getData());
        } else {
            $this->response[self::ERRORS] = $this->formErrorService->getArray($form);
        }
    }

    private function handleException(Exception $exception): void
    {
        $this->response[self::ERRORS][] = ['message' => 'Coś poszło nie tak, przepraszamy...'];
        $this->logger->error($exception->getMessage());
        $this->sentry->captureException($exception);
    }

    private function init(): void
    {
        try {
            $this->checkRequest();
            $this->processDataWithForm();
            $this->response[self::SUCCESS] = true;
        } catch (BadRequestHttpException $badRequestHttpException) {
            $this->response[self::ERRORS][] = ['message' => 'Nieprawidłowe zapytanie'];
        } catch (Exception $exception) {
            $this->handleException($exception);
        }
    }
}
