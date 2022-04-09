<?php

namespace App\Controller\Patient\Chat;

use App\Service\Conversation\ConversationService;
use GuzzleHttp\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/patient/chat-dashboard", name="front.patient.chat")
     * @param ConversationService $conversationService
     * @return Response
     */
    public function index(ConversationService $conversationService): Response
    {
        return $this->render('patient/chat.html.twig', [
            'state' => Utils::jsonEncode([
                'chats' => $conversationService->getConversations(),
            ]),
        ]);
    }
}
