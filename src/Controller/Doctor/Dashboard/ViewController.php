<?php

namespace App\Controller\Doctor\Dashboard;

use GuzzleHttp\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewController extends AbstractController
{
    public const ROUTE_NAME = 'front.doctor.dashboard';

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
