<?php

namespace App\Controller;

use GuzzleHttp\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    /**
     * @Route("/register", name="front.register")
     */
    public function index(): Response
    {
        return $this->render('register/index.html.twig', [
            'state' => Utils::jsonEncode([]),
        ]);
    }
}
