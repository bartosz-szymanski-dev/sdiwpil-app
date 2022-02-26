<?php

namespace App\Controller\Patient;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PatientDashboardController extends AbstractController
{
    /**
     * @Route("/patient/dashboard", name="front.patient.dashboard")
     */
    public function index(): Response
    {
        return $this->render('patient/dashboard.html.twig', [
            'controller_name' => 'PatientDashboardController',
        ]);
    }
}
