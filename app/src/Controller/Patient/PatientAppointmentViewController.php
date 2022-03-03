<?php

namespace App\Controller\Patient;

use Carbon\Carbon;
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
            'state' => Utils::jsonEncode([
                'time_slots' => $this->getTimeSlots(),
            ]),
        ]);
    }

    private function getTimeSlots(): array
    {
        $result = [];
        $date = Carbon::now();
        for ($i = 0; $i < 5; $i++) {
            $date = $date->addDay();
            $d = $date->format('d.m.Y');
            $t = $date->format('H:i');
            $result[] = $d . 'r., godz.: ' . $t;
        }

        return $result;
    }
}
