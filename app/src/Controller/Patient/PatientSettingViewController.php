<?php

namespace App\Controller\Patient;

use GuzzleHttp\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PatientSettingViewController extends AbstractController
{
    /**
     * @Route("/patient/setting", name="front.patient.setting")
     */
    public function index(): Response
    {
        return $this->render('patient/setting.html.twig', [
            'state' => Utils::jsonEncode([]),
        ]);
    }
}
