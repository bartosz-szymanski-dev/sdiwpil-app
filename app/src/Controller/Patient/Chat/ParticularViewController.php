<?php

namespace App\Controller\Patient\Chat;

use App\Entity\Appointment;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParticularViewController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route(
     *     "/patient/chat/{appointmentId}/{hash}",
     *     name="front.patient.chat.particular",
     *     requirements={"appointmentId"="\d+", "hash"="\w+"},
     * )
     */
    public function index(int $appointmentId, string $hash): Response
    {
        $this->check($appointmentId, $hash);

        return $this->render('patient/particular_chat.html.twig', [
            'state' => Utils::jsonEncode([]),
        ]);
    }

    private function check(int $id, string $hash): void
    {
        /** @var Appointment $appointment */
        $appointment = $this->entityManager->getRepository(Appointment::class)->find($id);
        if (!$appointment || $appointment->getChecksum() !== $hash) {
            throw $this->createNotFoundException();
        }
    }
}
