<?php

namespace App\Controller\Doctor\Register;

use GuzzleHttp\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewController extends AbstractController
{
    /**
     * @Route("/doctor/register", name="front.doctor.register")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('doctor/register.html.twig', [
           'state' => Utils::jsonEncode([]),
        ]);
    }
}
