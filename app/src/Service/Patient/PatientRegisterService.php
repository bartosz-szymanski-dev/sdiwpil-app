<?php

namespace App\Service\Patient;

use App\Controller\Patient\Dashboard\ViewController;
use App\Controller\Patient\Register\NewController;
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
        return NewController::ROUTE_NAME;
    }

    protected function getFormClass(): string
    {
        return PatientFormType::class;
    }

    protected function getRedirectRoute(): string
    {
        return ViewController::ROUTE_NAME;
    }
}