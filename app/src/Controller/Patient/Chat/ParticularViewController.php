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
        $this->check($channelId);

        return $this->render('patient/particular_chat.html.twig', [
            'state' => Utils::jsonEncode([]),
        ]);
    }

    private function check(string $channelId): void
    {
        $conversation = $this->entityManager->getRepository(Conversation::class)
            ->findOneBy(['channelId' => $channelId]);
        if (!$conversation) {
            throw $this->createNotFoundException();
        }
    }
}
