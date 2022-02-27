<?php

namespace App\Controller\Patient;

use GuzzleHttp\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PatientDashboardViewController extends AbstractController
{
    /**
     * @Route("/patient", name="front.patient.dashboard")
     */
    public function index(): Response
    {
        return $this->render('patient/dashboard.html.twig', [
            'state' => Utils::jsonEncode([]),
        ]);
    }
}
