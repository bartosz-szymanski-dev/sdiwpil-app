<?php

namespace App\Controller\Patient\Referral;

use GuzzleHttp\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewController extends AbstractController
{
    /**
     * @Route("/patient/referral", name="front.patient.referral")
     */
    public function index(): Response
    {
        return $this->render('patient/referral.html.twig', [
            'state' => Utils::jsonEncode([]),
        ]);
    }
}