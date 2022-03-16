<?php

namespace App\Service\Doctor;

use App\Controller\Doctor\Dashboard\ViewController;
use App\Entity\User;
use App\Service\AbstractRegisterService;

class DoctorRegisterService extends AbstractRegisterService
{
    protected function getRole(): string
    {
        return User::ROLE_DOCTOR;
    }

    protected function getRegisterNewRoute(): string
    {
        // TODO: Implement getRegisterNewRoute() method.
    }

    protected function getFormClass(): string
    {
        // TODO: Implement getFormClass() method.
    }

    protected function getRedirectRoute(): string
    {
        return ViewController::ROUTE_NAME;
    }
}
