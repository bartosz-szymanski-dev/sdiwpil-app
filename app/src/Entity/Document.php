<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DocumentRepository::class)
 */
class Document extends AbstractEntity
{
    public const PRESCRIPTION_TYPE = 'prescription';
    public const SICK_LEAVE_TYPE = 'sick_leave';
    public const REFERRAL_TYPE = 'referral';

    public const ALLOWED_TYPES = [
        self::PRESCRIPTION_TYPE,
        self::SICK_LEAVE_TYPE,
        self::REFERRAL_TYPE,
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private string $name;

    /**
     * @ORM\Column(type="blob")
     */
    private string $content;

    /**
     * @ORM\Column(type="string", length=12)
     */
    private string $type;

    /**
     * @ORM\ManyToOne(targetEntity=DoctorData::class, inversedBy="documents")
     * @ORM\JoinColumn(nullable=false)
     */
    private DoctorData $doctor;

    /**
     * @ORM\ManyToOne(targetEntity=PatientData::class, inversedBy="documents")
     * @ORM\JoinColumn(nullable=false)
     */
    private PatientData $patient;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        if (!in_array($type, self::ALLOWED_TYPES)) {
            throw new \RuntimeException('Given type is not allowed');
        }

        $this->type = $type;

        return $this;
    }

    public function getDoctor(): ?DoctorData
    {
        return $this->doctor;
    }

    public function setDoctor(?DoctorData $doctor): self
    {
        $this->doctor = $doctor;

        return $this;
    }

    public function getPatient(): ?PatientData
    {
        return $this->patient;
    }

    public function setPatient(?PatientData $patient): self
    {
        $this->patient = $patient;

        return $this;
    }
}
