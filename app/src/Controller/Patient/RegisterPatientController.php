<?php

namespace App\Controller\Patient;

use GuzzleHttp\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterPatientController extends AbstractController
{
    /**
     * @Route("/patient/register", name="front.patient.register")
     */
    public function index(): Response
    {
        return $this->render('/patient/register/index.html.twig', [
            'state' => Utils::jsonEncode([]),
        ]);
    }
}
