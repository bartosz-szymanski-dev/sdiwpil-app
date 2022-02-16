<?php

namespace App\Entity;

use App\Repository\AppointmentRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AppointmentRepository::class)
 */
class Appointment extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\ManyToOne(targetEntity=PatientData::class, inversedBy="appointments")
     * @ORM\JoinColumn(nullable=false)
     */
    private PatientData $patient;

    /**
     * @ORM\ManyToOne(targetEntity=DoctorData::class, inversedBy="appointments")
     * @ORM\JoinColumn(nullable=false)
     */
    private DoctorData $doctor;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private DateTimeImmutable $scheduledAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $patientReason;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $doctorNotes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPatient(): PatientData
    {
        return $this->patient;
    }

    public function setPatient(PatientData $patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    public function getDoctor(): DoctorData
    {
        return $this->doctor;
    }

    public function setDoctor(DoctorData $doctor): self
    {
        $this->doctor = $doctor;

        return $this;
    }

    public function getScheduledAt(): ?DateTimeImmutable
    {
        return $this->scheduledAt;
    }

    public function setScheduledAt(DateTimeImmutable $scheduledAt): self
    {
        $this->scheduledAt = $scheduledAt;

        return $this;
    }

    public function getPatientReason(): string
    {
        return $this->patientReason;
    }

    public function setPatientReason(string $patientReason): self
    {
        $this->patientReason = $patientReason;

        return $this;
    }

    public function getDoctorNotes(): ?string
    {
        return $this->doctorNotes;
    }

    public function setDoctorNotes(?string $doctorNotes): self
    {
        $this->doctorNotes = $doctorNotes;

        return $this;
    }
}
