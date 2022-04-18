<?php

namespace App\Service\Document;

use App\Entity\Document;
use App\Entity\User;
use App\Service\PaginatedRequestService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerInterface;
use RuntimeException;
use Sentry\ClientInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Security;

class DocumentListService
{
    private const SUCCESS = 'success';
    private const LIST = 'list';
    private const ERRORS = 'errors';

    private EntityManagerInterface $entityManager;
    private PaginatedRequestService $paginatedRequestService;
    private DocumentFrontEndStructureService $documentFrontEndStructureService;
    private LoggerInterface $logger;
    private ClientInterface $sentry;
    private Security $security;

    private array $response = [
        self::SUCCESS => false,
        self::LIST => [],
        self::ERRORS => [],
    ];

    public function __construct(
        EntityManagerInterface $entityManager,
        PaginatedRequestService $paginatedRequestService,
        DocumentFrontEndStructureService $documentFrontEndStructureService,
        LoggerInterface $logger,
        ClientInterface $sentry,
        Security $security
    ) {
        $this->entityManager = $entityManager;
        $this->paginatedRequestService = $paginatedRequestService;
        $this->documentFrontEndStructureService = $documentFrontEndStructureService;
        $this->logger = $logger;
        $this->sentry = $sentry;
        $this->security = $security;
    }

    public function getJsonResponse(): JsonResponse
    {
        $this->init();

        return new JsonResponse($this->response);
    }

    private function getUser(): User
    {
        /** @var User $user */
        $user = $this->security->getUser();
        if (!$user) {
            throw new RuntimeException('Musisz być zalogowanym użytkownikiem, by wykonać tę akcję.');
        }

        return $user;
    }

    private function setList(): void
    {
        $user = $this->getUser();
        $this->response[self::LIST] = $this->documentFrontEndStructureService->getFrontEndStructure(
            $this->entityManager->getRepository(Document::class)->getPaginatedDocuments(
                $this->paginatedRequestService->getMinMax(),
                $user->getDoctorData(),
                $user->getPatientData()
            )
        );
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
            $this->setList();
            $this->response[self::SUCCESS] = true;
        } catch (Exception $exception) {
            $this->handleException($exception);
        }
    }
}
