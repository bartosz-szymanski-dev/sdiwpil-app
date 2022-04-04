<?php

namespace App\Controller;

use App\Entity\Conversation;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

abstract class AbstractParticularConversationController extends AbstractController
{
    protected Conversation $conversation;

    private EntityManagerInterface $entityManager;

    abstract protected function getHeader(): string;
    abstract protected function getTemplatePath(): string;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route(
     *     "/chat/{channelId}",
     *     name="front.patient.chat.particular",
     *     requirements={"channelId"="\w+"},
     * )
     */
    public function index(string $channelId): Response
    {
        $this->setConversation($channelId);

        return $this->render($this->getTemplatePath(), $this->getState());
    }

    protected function setConversation(string $channelId): void
    {
        $conversation = $this->entityManager->getRepository(Conversation::class)
            ->findOneBy(['channelId' => $channelId]);
        if (!$conversation) {
            throw $this->createNotFoundException();
        }

        $this->conversation = $conversation;
    }

    protected function getFrontEndMessages(): array
    {
        foreach ($this->conversation->getMessages() as $message) {
            $result[] = $message->toArray();
        }

        return $result ?? [];
    }

    protected function getState(): array
    {
        return [
            'pageTitle' => $this->getHeader(),
            'state' => Utils::jsonEncode([
                'messages' => $this->getFrontEndMessages(),
                'conversation' => $this->conversation->getId(),
                'userId' => $this->getUser()->getId(),
                'routeScreenHeader' => $this->getHeader(),
            ]),
        ];
    }
}
