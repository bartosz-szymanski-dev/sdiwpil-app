<?php

namespace App\Service\Message;

use App\Form\MessageType;
use App\Service\FormErrorService;
use App\Service\RequestService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use GuzzleHttp\Utils;
use Psr\Log\LoggerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;

class MessageNewService extends RequestService
{
    private const SUCCESS = 'success';
    private const ERRORS = 'errors';

    private FormFactoryInterface $formFactory;
    private FormErrorService $formErrorService;
    private EntityManagerInterface $entityManager;
    private LoggerInterface $logger;

    private array $result = [
        self::SUCCESS => false,
        self::ERRORS => [],
    ];

    public function __construct(
        FormFactoryInterface $formFactory,
        FormErrorService $formErrorService,
        EntityManagerInterface $entityManager,
        RequestStack $requestStack,
        LoggerInterface $logger
    ) {
        parent::__construct($requestStack);

        $this->formFactory = $formFactory;
        $this->formErrorService = $formErrorService;
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    public function getJsonResponse(): JsonResponse
    {
        $this->processValidation();

        return new JsonResponse();
    }

    private function processValidation(): void
    {
        try {
            $form = $this->formFactory->create(MessageType::class)->submit(
                Utils::jsonDecode($this->request->getContent(), true)
            );
            if ($form->isValid()) {
                // TODO: handle valid form
            } else {
                $this->result[self::ERRORS] = $this->formErrorService->getArray($form);
            }
        } catch (Exception $exception) {
            $this->result[self::ERRORS][] = ['message' => 'Something went wrong, try again'];
            $this->logger->error($exception->getMessage());
        }
    }
}
