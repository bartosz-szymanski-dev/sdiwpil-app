<?php

namespace App\Controller\Doctor\Conversations;

use App\Service\Conversation\ConversationService;
use GuzzleHttp\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewController extends AbstractController
{
    /**
     * @Route("/doctor/chats", name="front.doctor.chats")
     */
    public function index(ConversationService $conversationService): Response
    {
        return $this->render('doctor/chats.html.twig', [
            'state' => Utils::jsonEncode([
                'conversations' => $conversationService->getConversations(),
            ]),
        ]);
    }
}