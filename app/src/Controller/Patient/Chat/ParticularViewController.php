<?php

namespace App\Controller\Patient\Chat;

use App\Entity\Conversation;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParticularViewController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    private Conversation $conversation;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route(
     *     "/patient/chat/{channelId}",
     *     name="front.patient.chat.particular",
     *     requirements={"channelId"="\w+"},
     * )
     */
    public function index(string $channelId): Response
    {
        $this->setConversation($channelId);

        $doctor = $this->conversation->getDoctor()->getDoctor();

        return $this->render('patient/particular_chat.html.twig', [
            'pageTitle' => sprintf('Czat z lek. %s %s', $doctor->getFirstName(), $doctor->getLastName()),
            'state' => Utils::jsonEncode([
                'messages' => $this->getFrontEndMessages(),
                'channelId' => $channelId,
            ]),
        ]);
    }

    private function setConversation(string $channelId): void
    {
        $conversation = $this->entityManager->getRepository(Conversation::class)
            ->findOneBy(['channelId' => $channelId]);
        if (!$conversation) {
            throw $this->createNotFoundException();
        }

        $this->conversation = $conversation;
    }

    private function getFrontEndMessages(): array
    {
        foreach ($this->conversation->getMessages() as $message) {
            $result[] = $message->toArray();
        }

        return $result ?? [];
    }
}
