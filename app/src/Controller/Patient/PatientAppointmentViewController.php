<?php

namespace App\Controller\Patient;

use GuzzleHttp\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PatientAppointmentViewController extends AbstractController
{
    /**
     * @Route("/patient/appointment", name="front.patient.appointment")
     */
    public function index(): Response
    {
        return $this->render('patient/appointment.html.twig', [
            'state' => Utils::jsonEncode([]),
        ]);
    }
}
