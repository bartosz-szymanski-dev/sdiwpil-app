<?php

namespace App\Service\Message;

use App\Entity\Message;
use App\Form\Message\MessageBulkType;
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

        return new JsonResponse($this->result);
    }

    /**
     * @param Message[] $messages
     */
    private function saveMessages(array $messages): void
    {
        foreach ($messages as $message) {
            $conversation = $message->getConversation();
            $conversation->addMessage($message);
            $this->entityManager->persist($message);
            $this->entityManager->persist($conversation);
        }

        $this->entityManager->flush();
    }

    private function processValidation(): void
    {
        try {
            $form = $this->formFactory->create(MessageBulkType::class)->submit(
                Utils::jsonDecode($this->request->getContent(), true)
            );
            if ($form->isValid()) {
                $this->saveMessages($form->get(MessageBulkType::MESSAGES)->getData());
                $this->result[self::SUCCESS] = true;
            } else {
                $this->result[self::ERRORS] = $this->formErrorService->getArray($form);
            }
        } catch (Exception $exception) {
            $this->result[self::ERRORS][] = ['message' => 'Something went wrong, try again'];
            $this->logger->error($exception->getMessage());
        }
    }
}
