<?php

namespace App\Controller\Doctor\Register;

use App\Service\Clinic\FrontEndClinicService;
use App\Service\MedicalSpecialty\FrontEndMedicalSpecialtyService;
use GuzzleHttp\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewController extends AbstractController
{
    /**
     * @Route("/doctor/register", name="front.doctor.register")
     * @param FrontEndMedicalSpecialtyService $medicalSpecialtyService
     * @param FrontEndClinicService $clinicService
     * @return Response
     */
    public function index(
        FrontEndMedicalSpecialtyService $medicalSpecialtyService,
        FrontEndClinicService $clinicService
    ): Response {
        return $this->render('doctor/register.html.twig', [
            'state' => Utils::jsonEncode([
                'medical_specialties' => $medicalSpecialtyService->getResult(),
                'clinics' => $clinicService->getResult(),
            ]),
        ]);
    }
}
