<?php

namespace App\Controller\Patient\Register;

use App\Service\RegisterInterlinkingService;
use GuzzleHttp\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewController extends AbstractController
{
    /**
     * @Route("/patient/register", name="front.patient.register")
     */
    public function index(RegisterInterlinkingService $interlinkingService): Response
    {
        return $this->render('/patient/register.html.twig', [
            'state' => Utils::jsonEncode([
                'register_interlinking' => $interlinkingService->get('front.patient.register'),
            ]),
        ]);
    }
}
