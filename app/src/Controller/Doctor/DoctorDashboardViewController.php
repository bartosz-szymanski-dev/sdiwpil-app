<?php

namespace App\Controller\Doctor;

use GuzzleHttp\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DoctorDashboardViewController extends AbstractController
{
    /**
     * @Route("/doctor", name="front.doctor.dashboard")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('doctor/dashboard.html.twig', [
            'state' => Utils::jsonEncode([]),
        ]);
    }
}