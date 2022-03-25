<?php

namespace App\Controller\Appointment;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class NewController extends AbstractController
{
    /**
     * @Route(
     *     "/appointment/new",
     *     name="front.appointment.new",
     *     methods={"POST"},
     * )
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return new JsonResponse();
    }
}
