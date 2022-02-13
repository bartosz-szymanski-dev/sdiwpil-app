<?php

namespace App\Entity;

class Patient extends User
{
    public const ROLE_PATIENT = 'ROLE_PATIENT';

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = self::ROLE_PATIENT;

        return array_unique($roles);
    }
}
