<?php

namespace App\Controller\Patient\Register;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class NewController extends AbstractController
{
    /**
     * @Route("/patient/register/new", name="front.patient.register.new")
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->json([]);
    }
}
