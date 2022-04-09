<?php

namespace App\Service;

use RuntimeException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class RequestService
{
    private RequestStack $requestStack;

    protected Request $request;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;

        $this->setRequest();
    }

    private function setRequest(): void
    {
        $request = $this->requestStack->getCurrentRequest();
        if (!$request) {
            throw new RuntimeException(sprintf('Request must be an instance of "%s"', Request::class));
        }

        $this->request = $request;
    }
}
