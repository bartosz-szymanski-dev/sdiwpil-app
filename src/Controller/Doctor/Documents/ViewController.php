<?php

namespace App\Controller\Doctor\Documents;

use App\Entity\Document;
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
                'documentTypes' => $this->getDocumentTypes(),
                'doctor' => $this->getUser()->getDoctorData()->getId(),
                'documents' => $this->getDocuments(),
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

    private function getDocumentTypes(): array
    {
        return [
            [
                'text' => 'Recepta',
                'value' => Document::PRESCRIPTION_TYPE,
            ]
        ];
    }

    private function getFrontEndType(Document $document): string
    {
        if ($document->getType() === Document::PRESCRIPTION_TYPE) {
            return 'recepta';
        }

        return $document->getType();
    }

    private function getDocuments(): array
    {
        /** @var User $doctor */
        $doctor = $this->getUser();
        $documents = $this->entityManager->getRepository(Document::class)->findBy(['doctor' => $doctor]);
        foreach ($documents as $document) {
            $tmpDocument = $document->toArray();
            $tmpDocument['type'] = $this->getFrontEndType($document);
            $result[] = $tmpDocument;
        }

        return $result ?? [];
    }
}
