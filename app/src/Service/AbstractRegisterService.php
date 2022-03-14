<?php

namespace App\Service;

use App\Entity\User;
use App\Security\JsonLoginAuthenticator;
use App\Service\User\UserRegisterService;
use Exception;
use GuzzleHttp\Utils;
use Psr\Log\LoggerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

abstract class AbstractRegisterService
{
    private const SUCCESS_KEY = 'success';
    private const MESSAGE_KEY = 'message';
    private const ROUTE_KEY = 'route';
    private const ERRORS_KEY = 'errors';

    private UrlGeneratorInterface $urlGenerator;

    private Request $request;

    private LoggerInterface $logger;

    private FormFactoryInterface $formFactory;

    private FormErrorService $formErrorService;

    private UserRegisterService $registerService;

    private UserAuthenticatorInterface $authenticator;

    private JsonLoginAuthenticator $loginAuthenticator;

    private array $state = [
        self::SUCCESS_KEY => false,
        self::MESSAGE_KEY => '',
        self::ROUTE_KEY => '',
        self::ERRORS_KEY => [],
    ];

    public function __construct(
        UrlGeneratorInterface $urlGenerator,
        LoggerInterface $logger,
        FormFactoryInterface $formFactory,
        FormErrorService $formErrorService,
        UserRegisterService $registerService,
        UserAuthenticatorInterface $authenticator,
        JsonLoginAuthenticator $loginAuthenticator
    ) {
        $this->urlGenerator = $urlGenerator;
        $this->logger = $logger;
        $this->formFactory = $formFactory;
        $this->formErrorService = $formErrorService;
        $this->registerService = $registerService;
        $this->authenticator = $authenticator;
        $this->loginAuthenticator = $loginAuthenticator;
    }

    public function handleRequest(Request $request): array
    {
        $this->request = $request;
        if (!$this->supports()) {
            $this->handleNotSupportedRequest();

            return $this->state;
        }

        $this->processValidation();

        return $this->state;
    }

    abstract protected function getRole(): string;
    abstract protected function getRegisterNewRoute(): string;
    abstract protected function getFormClass(): string;
    abstract protected function getRedirectRoute(): string;

    private function supports(): bool
    {
        return $this->request->getPathInfo() === $this->urlGenerator->generate($this->getRegisterNewRoute())
            && $this->request->isMethod(Request::METHOD_POST);
    }

    private function handleNotSupportedRequest(): void
    {
        $this->state[self::ERRORS_KEY][] = ['message' => 'Nieprawidłowe zapytanie'];
    }

    private function getParams(): array
    {
        return Utils::jsonDecode($this->request->getContent(), true);
    }

    private function handleValidationException(Exception $exception): void
    {
        $this->state[self::ERRORS_KEY][] = ['message' => 'Przepraszamy. Coś poszło nie tak'];
        $this->logger->error($exception->getMessage());
    }

    private function processValidation(): void
    {
        try {
            $params = $this->getParams();
            $form = $this->formFactory
                ->create($this->getFormClass())
                ->submit($params);
            if ($form->isSubmitted() && $form->isValid()) {
                $this->handleValidForm($form);
            } else {
                $this->state[self::ERRORS_KEY] = $this->formErrorService->getArray($form);
            }
        } catch (Exception $exception) {
            $this->handleValidationException($exception);
        }
    }

    private function handleValidForm(FormInterface $form): void
    {
        $user = $this->registerService->registerUser($form->getData(), $this->getRole());
        $this->authenticator->authenticateUser($user, $this->loginAuthenticator, $this->request);
        $this->state[self::SUCCESS_KEY] = true;
        $this->state[self::MESSAGE_KEY] = 'Pomyślnie zarejestrowano się w systemie';
        $this->state[self::ROUTE_KEY] = $this->getRedirectRoute();
    }
}
