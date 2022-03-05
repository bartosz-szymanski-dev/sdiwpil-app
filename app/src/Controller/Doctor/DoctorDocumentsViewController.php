<?php

namespace App\Controller\Doctor;

use GuzzleHttp\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DoctorDocumentsViewController extends AbstractController
{
    /**
     * @Route("/doctor/documents", name="front.doctor.documents")
     */
    public function index(): Response
    {
        return $this->render('doctor/documents.html.twig', [
            'state' => Utils::jsonEncode([]),
        ]);
    }
}
