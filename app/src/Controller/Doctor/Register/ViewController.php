<?php

namespace App\Controller\Doctor\Register;

use App\Service\MedicalSpecialty\MedicalSpecialtyService;
use GuzzleHttp\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewController extends AbstractController
{
    /**
     * @Route("/doctor/register", name="front.doctor.register")
     * @param MedicalSpecialtyService $medicalSpecialtyService
     * @return Response
     */
    public function index(MedicalSpecialtyService $medicalSpecialtyService): Response
    {
        return $this->render('doctor/register.html.twig', [
           'state' => Utils::jsonEncode([
               'medical_specialties' => $medicalSpecialtyService->getMedicalSpecialties(),
           ]),
        ]);
    }
}
