<?php

namespace App\Controller\Doctor;

use GuzzleHttp\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DoctorAppointmentsViewController extends AbstractController
{
    /**
     * @Route("/doctor/appointments", name="front.doctor.appointments")
     */
    public function index(): Response
    {
        return $this->render('doctor/appointments.html.twig', [
            'state' => Utils::jsonEncode([]),
        ]);
    }
}
