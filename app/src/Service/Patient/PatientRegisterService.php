<?php

namespace App\Service\Patient;

use App\Entity\User;
use App\Form\PatientFormType;
use App\Service\AbstractRegisterService;

class PatientRegisterService extends AbstractRegisterService
{
    protected function getRole(): string
    {
        return User::ROLE_PATIENT;
    }

    protected function getRegisterNewRoute(): string
    {
        return 'front.patient.register.new';
    }

    protected function getFormClass(): string
    {
        return PatientFormType::class;
    }

    protected function getRedirectRoute(): string
    {
        return 'front.patient.dashboard';
    }
}
