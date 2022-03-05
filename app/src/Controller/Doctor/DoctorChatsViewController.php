<?php

namespace App\Controller\Doctor;

use GuzzleHttp\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DoctorChatsViewController extends AbstractController
{
    /**
     * @Route("/doctor/chats", name="front.doctor.chats")
     */
    public function index(): Response
    {
        return $this->render('doctor/chats.html.twig', [
            'state' => Utils::jsonEncode([]),
        ]);
    }
}
