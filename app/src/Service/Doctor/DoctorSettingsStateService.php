<?php

namespace App\Service\Doctor;

use App\Entity\User;
use App\Service\MedicalSpecialty\FrontEndMedicalSpecialtyService;
use GuzzleHttp\Utils;
use RuntimeException;
use Symfony\Component\Security\Core\Security;

class DoctorSettingsStateService
{
    private Security $security;

    private FrontEndMedicalSpecialtyService $medicalSpecialtyService;

    private array $state = [];

    public function __construct(Security $security, FrontEndMedicalSpecialtyService $medicalSpecialtyService)
    {
        $this->security = $security;
        $this->medicalSpecialtyService = $medicalSpecialtyService;
    }

    public function getState(): string
    {
        $this->buildState();

        return Utils::jsonEncode($this->state);
    }

    private function buildState(): void
    {
        /** @var User $doctor */
        $doctor = $this->security->getUser();
        if (!$doctor) {
            throw new RuntimeException('User not found');
        }

        $this->state['email'] = $doctor->getEmail();
        $this->state['medicalSpecialty'] = $doctor->getDoctorData()->getMedicalSpecialty()->getId();
        $this->state['medicalSpecialties'] = $this->medicalSpecialtyService->getResult();
        $this->state['workingTime'] = $doctor->getDoctorData()->getWorkingTime();
    }
}
