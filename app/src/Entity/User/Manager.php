<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class Manager extends User
{
    public const ROLE_MANAGER = 'ROLE_MANAGER';

    /**
     * @ORM\ManyToOne(targetEntity=Clinic::class, inversedBy="Managers")
     */
    private $clinic;

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = self::ROLE_MANAGER;

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
