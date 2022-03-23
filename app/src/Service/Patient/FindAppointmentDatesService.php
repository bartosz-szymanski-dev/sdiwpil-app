<?php

namespace App\Service\Patient;

use App\Entity\User;
use App\Form\FindAppointmentDatesFormType;
use App\Service\FormErrorService;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Utils;
use Psr\Log\LoggerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class FindAppointmentDatesService
{
    private const SUCCESS_KEY = 'success';
    private const APPOINTMENT_DATES_KEY = 'appointmentDates';
    private const ERRORS_KEY = 'errors';

    private FormFactoryInterface $formFactory;
    private FormErrorService $formErrorService;
    private EntityManagerInterface $entityManager;
    private LoggerInterface $logger;
    private RequestStack $requestStack;
    private AppointmentDatesService $datesService;
    private Request $request;

    private array $result = [
        self::SUCCESS_KEY => false,
        self::APPOINTMENT_DATES_KEY => [],
        self::ERRORS_KEY => [],
    ];

    public function __construct(
        FormFactoryInterface $formFactory,
        FormErrorService $formErrorService,
        EntityManagerInterface $entityManager,
        LoggerInterface $logger,
        RequestStack $requestStack,
        AppointmentDatesService $datesService
    ) {
        $this->formFactory = $formFactory;
        $this->formErrorService = $formErrorService;
        $this->entityManager = $entityManager;
        $this->logger = $logger;
        $this->requestStack = $requestStack;
        $this->datesService = $datesService;
    }

    public function getJsonResponse(): JsonResponse
    {
        $this->init();

        return new JsonResponse();
    }

    private function setRequest(): void
    {
        $request = $this->requestStack->getCurrentRequest();
        if (!$request) {
            throw new \RuntimeException(sprintf('Request must be an instance of %s', Request::class));
        }

        $this->request = $request;
    }

    private function handleException(\Exception $exception): void
    {
        $this->result[self::ERRORS_KEY][] = ['message' => 'Coś poszło nie tak, przepraszamy'];
        $this->logger->error($exception->getMessage());
    }

    private function setAppointmentDates(array $workingTime): void
    {
        $result = $this->datesService->getResult($workingTime);
        if (empty($result)) {
            $this->result[self::ERRORS_KEY][] = ['Przepraszamy, nie znaleziono propozycji daty wizyty...'];
        }

        $this->result[self::APPOINTMENT_DATES_KEY] = $result;
    }

    private function handleValidForm(array $data): void
    {
        /** @var User $doctor */
        $doctor = $data['doctor'];
        $workingTime = $doctor->getDoctorData()->getWorkingTime();
        if (!$workingTime) {
            $this->result[self::ERRORS_KEY][] = [
                'message' => 'Wybrany lekarz nie ustawił godzin pracy. Skontaktuj się z administracją w celu rozwiązania tego problemu'
            ];
        }

        $this->setAppointmentDates($workingTime);
    }

    private function init(): void
    {
        $this->setRequest();
        try {
            $form = $this->formFactory->create(FindAppointmentDatesFormType::class)->submit(
                Utils::jsonDecode($this->request->getContent(), true)
            );
            if ($form->isSubmitted() && $form->isValid()) {
                $this->handleValidForm($form->getData());
            } else {
                $this->result[self::ERRORS_KEY] = $this->formErrorService->getArray($form);
            }
        } catch (\Exception $exception) {
            $this->handleException($exception);
        }
    }
}
