<?php

namespace App\Service\Appointment;

use App\Entity\Appointment;
use App\Entity\User;
use App\Form\Appointment\AppointmentNewFormType;
use App\Service\FormErrorService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use GuzzleHttp\Utils;
use RuntimeException;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Security;

class AppointmentNewActionService
{
    private const SUCCESS_KEY = 'success';
    private const APPOINTMENTS_KEY = 'appointments';
    private const ERRORS_KEY = 'errors';

    private RequestStack $requestStack;
    private Security $security;
    private FormFactoryInterface $formFactory;
    private FormErrorService $formErrorService;
    private EntityManagerInterface $entityManager;

    private Request $request;
    private User $patient;

    private array $result = [
        self::SUCCESS_KEY => false,
        self::APPOINTMENTS_KEY => [],
        self::ERRORS_KEY => [],
    ];

    public function __construct(
        RequestStack $requestStack,
        Security $security,
        FormFactoryInterface $formFactory,
        FormErrorService $formErrorService,
        EntityManagerInterface $entityManager
    ) {
        $this->requestStack = $requestStack;
        $this->security = $security;
        $this->formFactory = $formFactory;
        $this->formErrorService = $formErrorService;
        $this->entityManager = $entityManager;
    }

    public function getJsonResponse(): JsonResponse
    {
        $this->init();

        return new JsonResponse($this->result);
    }

    private function setRequest(): AppointmentNewActionService
    {
        $request = $this->requestStack->getCurrentRequest();
        if (!$request) {
            throw new RuntimeException(sprintf('Request must be an instance of %s', Request::class));
        }

        $this->request = $request;

        return $this;
    }

    private function setPatient(): AppointmentNewActionService
    {
        /** @var User $patient */
        $patient = $this->security->getUser();
        if (!$patient || !in_array(User::ROLE_PATIENT, $patient->getRoles(), true)) {
            throw new RuntimeException('Patient not found');
        }

        $this->patient = $patient;

        return $this;
    }

    private function successfulFormAction(FormInterface $form): void
    {
        /** @var Appointment $appointment */
        $appointment = $form->getData();
        $appointment->setPatient($this->patient->getPatientData());
        $this->entityManager->persist($appointment);
        $this->entityManager->flush();
    }

    private function setAppointments(): void
    {
        // TODO: get paginated appointments
    }

    private function processForm(): void
    {
        $form = $this->formFactory->create(AppointmentNewFormType::class)->submit(
            Utils::jsonDecode($this->request->getContent(), true)
        );
        if ($form->isSubmitted() && $form->isValid()) {
            $this->successfulFormAction($form);
            $this->setAppointments();
        } else {
            $this->result[self::ERRORS_KEY] = $this->formErrorService->getArray($form);
        }
    }

    private function init(): void
    {
        try {
            $this
                ->setRequest()
                ->setPatient()
                ->processForm();
        } catch (Exception $exception) {

        }
    }
}
