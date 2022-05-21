<?php

namespace App\Controller\Doctor\Appointments;

use App\Service\Vuex\StateGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewController extends AbstractController
{
    /**
     * @Route("/doctor/appointments", name="front.doctor.appointments")
     */
    public function __invoke(StateGenerator $stateGenerator): Response
    {
        return $this->render('doctor/appointments.html.twig', $stateGenerator->getState());
    }
}
