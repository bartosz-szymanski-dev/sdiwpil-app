<?php

namespace App\Service\Doctor;

use App\Entity\DoctorData;
use App\Entity\MedicalSpecialty;
use App\Entity\User;
use App\Form\Settings\DoctorSettingsFormType;
use App\Service\FormErrorService;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Utils;
use Psr\Log\LoggerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Security;

class DoctorSettingsSaveService
{
    private const SUCCESS_KEY = 'success';
    private const ERRORS_KEY = 'errors';

    private RequestStack $requestStack;
    private Request $request;
    private FormFactoryInterface $formFactory;
    private FormErrorService $formErrorService;
    private Security $security;
    private UserPasswordHasherInterface $passwordHasher;
    private EntityManagerInterface $entityManager;
    private LoggerInterface $logger;

    private array $result = [
        self::SUCCESS_KEY => false,
        self::ERRORS_KEY => [],
    ];

    public function __construct(
        RequestStack $requestStack,
        FormFactoryInterface $formFactory,
        FormErrorService $formErrorService,
        Security $security,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager,
        LoggerInterface $logger
    ) {
        $this->requestStack = $requestStack;
        $this->request = $this->getRequest();
        $this->formFactory = $formFactory;
        $this->formErrorService = $formErrorService;
        $this->security = $security;
        $this->passwordHasher = $passwordHasher;
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    public function getJsonResponse(): JsonResponse
    {
        $this->init();

        return new JsonResponse($this->result);
    }

    private function getRequest(): Request
    {
        $request = $this->requestStack->getCurrentRequest();
        if (!$request) {
            throw new \RuntimeException(sprintf('Request must be instance of %s', Request::class));
        }

        return $request;
    }

    private function init(): void
    {
        try {
            $this->handleForm();
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage());
            $this->result[self::ERRORS_KEY][] = [
                'message' => 'Wystąpił błąd zapisania danych, spróbuj ponownie lub skontaktuj się z administratorem systemu',
            ];
        }
    }

    private function getDoctor(): User
    {
        /** @var User $doctor */
        $doctor = $this->security->getUser();
        if (!$doctor) {
            throw new \RuntimeException(sprintf('User must be an instance of %s', User::class));
        }

        return $doctor;
    }

    private function handleEmailSave(User $doctor, array $data): void
    {
        $email = $data['email'] ?? '';
        if ($email) {
            $doctor->setEmail($email);
        }
    }

    private function handlePasswordSave(User $doctor, array $data): void
    {
        $password = $data['password'] ?? '';
        if ($password) {
            $hashedPassword = $this->passwordHasher->hashPassword($doctor, $password);
            $doctor->setPassword($hashedPassword);
        }
    }

    private function handleMedicalSpecialtySave(User $doctor, array $data): void
    {
        /** @var MedicalSpecialty $medicalSpecialty */
        $medicalSpecialty = $data['medicalSpecialty'] ?? null;
        if ($medicalSpecialty) {
            /** @var DoctorData $doctorData */
            $doctorData = $doctor->getDoctorData();
            $doctorData->setMedicalSpecialty($medicalSpecialty);
            $this->entityManager->persist($doctorData);
        }
    }

    private function handleWorkingTimeSave(User $doctor, array $data): void
    {
        $workingTime = $data['workingTime'] ?? null;
        if ($workingTime) {
            /** @var DoctorData $doctorData */
            $doctorData = $doctor->getDoctorData();
            $doctorData->setWorkingTime($workingTime);
            $this->entityManager->persist($doctorData);
        }
    }

    private function handleDoctorDataSave(FormInterface $form): void
    {
        $doctor = $this->getDoctor();
        $data = $form->getData();
        $this->handleEmailSave($doctor, $data);
        $this->handlePasswordSave($doctor, $data);
        $this->handleMedicalSpecialtySave($doctor, $data);
        $this->handleWorkingTimeSave($doctor, $data);
        $this->entityManager->persist($doctor);
    }

    private function handleForm(): void
    {
        $form = $this->formFactory->create(DoctorSettingsFormType::class)->submit(
            Utils::jsonDecode($this->request->getContent(), true)
        );
        if ($form->isSubmitted() && $form->isValid()) {
            $this->handleDoctorDataSave($form);
            $this->result[self::SUCCESS_KEY] = true;
        } else {
            $this->result[self::ERRORS_KEY] = $this->formErrorService->getArray($form);
        }
    }
}
