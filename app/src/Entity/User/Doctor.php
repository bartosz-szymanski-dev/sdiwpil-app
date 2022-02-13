<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

class Doctor extends User
{
    public const ROLE_DOCTOR = 'ROLE_DOCTOR';

    /**
     * @ORM\ManyToMany(targetEntity=Clinic::class, mappedBy="Doctors")
     */
    private $clinics;

    public function __construct()
    {
        $this->clinics = new ArrayCollection();
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = self::ROLE_DOCTOR;

        return array_unique($roles);
    }

    /**
     * @return Collection|Clinic[]
     */
    public function getClinics(): Collection
    {
        return $this->clinics;
    }

    public function addClinic(Clinic $clinic): self
    {
        if (!$this->clinics->contains($clinic)) {
            $this->clinics[] = $clinic;
            $clinic->addDoctor($this);
        }

        return $this;
    }

    public function removeClinic(Clinic $clinic): self
    {
        if ($this->clinics->removeElement($clinic)) {
            $clinic->removeDoctor($this);
        }

        return $this;
    }
}
