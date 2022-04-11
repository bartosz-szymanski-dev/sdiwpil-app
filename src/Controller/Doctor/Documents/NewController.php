<?php

namespace App\Controller\Doctor\Documents;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class NewController extends AbstractController
{
    /**
     * @Route(
     *     "/doctor/documents/new",
     *     name="front.doctor.documents.new",
     *     methods={"POST"},
     * )
     */
    public function index(): JsonResponse
    {
        return new JsonResponse();
    }
}
