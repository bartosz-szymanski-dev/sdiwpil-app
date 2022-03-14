<?php

namespace App\Controller\Patient\Register;

use GuzzleHttp\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewController extends AbstractController
{
    public const ROUTE_NAME = 'front.patient.register';

    /**
     * @Route("/patient/register", name="front.patient.register")
     */
    public function index(): Response
    {
        return $this->render('/patient/register.html.twig', [
            'state' => Utils::jsonEncode([]),
        ]);
    }
}
