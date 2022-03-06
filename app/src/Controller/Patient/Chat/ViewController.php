<?php

namespace App\Controller\Patient\Chat;

use GuzzleHttp\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewController extends AbstractController
{
    /**
     * @Route("/patient/chat", name="front.patient.chat")
     */
    public function index(): Response
    {
        return $this->render('patient/chat.html.twig', [
            'state' => Utils::jsonEncode([]),
        ]);
    }
}
