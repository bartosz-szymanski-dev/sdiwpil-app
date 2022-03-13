<?php

namespace App\Service\Patient;

use Exception;
use GuzzleHttp\Utils;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PatientRegisterService
{
    private const SUCCESS_KEY = 'success';
    private const MESSAGE_KEY = 'message';
    private const ROUTE_KEY = 'route';

    private UrlGeneratorInterface $urlGenerator;

    private Request $request;

    private LoggerInterface $logger;

    private array $state = [
        self::SUCCESS_KEY => false,
        self::MESSAGE_KEY => '',
        self::ROUTE_KEY => '',
    ];

    public function __construct(UrlGeneratorInterface $urlGenerator, LoggerInterface $logger)
    {
        $this->urlGenerator = $urlGenerator;
        $this->logger = $logger;
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

    private function supports(): bool
    {
        return $this->request->getPathInfo() === $this->urlGenerator->generate('front.patient.register.new')
            && $this->request->isMethod(Request::METHOD_POST);
    }

    private function handleNotSupportedRequest(): void
    {
        $this->state[self::MESSAGE_KEY] = 'Nieprawidłowe zapytanie';
    }

    private function processValidation(): void
    {
        try {
            $params = $this->getParams();
        } catch (Exception $exception) {
            $this->handleValidationException($exception);
        }
    }

    private function getParams(): array
    {
        return Utils::jsonDecode($this->request->getContent(), true);
    }

    private function handleValidationException(Exception $exception): void
    {
        $this->state[self::MESSAGE_KEY] = 'Przepraszamy. Coś poszło nie tak';
        $this->logger->error($exception->getMessage());
    }
}
