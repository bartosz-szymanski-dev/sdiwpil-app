<?php

namespace App\Controller\Patient\Settings;

use GuzzleHttp\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewController extends AbstractController
{
    /**
     * @Route("/patient/settings", name="front.patient.settings")
     */
    public function index(): Response
    {
        return $this->render('patient/settings.html.twig', [
            'state' => Utils::jsonEncode([]),
        ]);
    }
}
