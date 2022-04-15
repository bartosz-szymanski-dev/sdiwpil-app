<?php

namespace App\Controller\Doctor\Documents;

use App\Entity\PatientData;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/doctor/documents", name="front.doctor.documents")
     */
    public function index(): Response
    {
        return $this->render('doctor/documents.html.twig', [
            'state' => Utils::jsonEncode([
                'patients' => $this->getPatients(),
            ]),
        ]);
    }

    private function getPatients(): array
    {
        /** @var User $doctor */
        $doctor = $this->getUser();
        /** @var PatientData[] $patients */
        $patients = $this->entityManager->getRepository(PatientData::class)
            ->findPatientsDataByDoctorDataInAppointment($doctor->getDoctorData());
        foreach ($patients as $patient) {
            $patientUser = $patient->getPatient();
            $result[] = [
                'text' => $patientUser->getFirstName() . ' ' . $patientUser->getLastName(),
                'value' => $patient->getId(),
            ];
        }

        return $result ?? [];
    }
}
