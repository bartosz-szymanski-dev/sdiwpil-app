<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class Receptionist extends User
{
    public const ROLE_RECEPTIONIST = 'ROLE_RECEPTIONIST';

    /**
     * @ORM\ManyToOne(targetEntity=Clinic::class, inversedBy="Receptionists")
     */
    private $clinic;

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = self::ROLE_RECEPTIONIST;

        return array_unique($roles);
    }

    public function getClinic(): ?Clinic
    {
        return $this->clinic;
    }

    public function setClinic(?Clinic $clinic): self
    {
        $this->clinic = $clinic;

        return $this;
    }
}
