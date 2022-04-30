<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
    private FlashBagInterface $flashBag;
    private UrlGeneratorInterface $router;

    public function __construct(FlashBagInterface $flashBag, UrlGeneratorInterface $router)
    {
        $this->flashBag = $flashBag;
        $this->router = $router;
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request, AccessDeniedException $accessDeniedException)
    {
        $this->flashBag->add('error', 'Nie masz uprawnień, by przejść do tej zawartości.');

        return new RedirectResponse($this->router->generate('front.home_page'));
    }
}
