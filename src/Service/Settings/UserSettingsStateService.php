<?php

namespace App\Service\Settings;

use App\Entity\User;
use App\Service\Menu\MenuService;
use GuzzleHttp\Utils;
use RuntimeException;
use Symfony\Component\Security\Core\Security;

class UserSettingsStateService
{
    protected Security $security;
    protected User $user;
    protected MenuService $menuService;

    protected array $state = [];

    public function __construct(Security $security, MenuService $menuService)
    {
        $this->security = $security;
        $this->menuService = $menuService;
        $this->setUser();
    }

    public function getState(): string
    {
        $this->buildState();

        return Utils::jsonEncode($this->state);
    }

    protected function buildState(): void
    {
        $this->state['email'] = $this->user->getEmail();
        $this->state['menu'] = $this->menuService->getMenu();
    }

    private function setUser(): void
    {
        /** @var User $user */
        $user = $this->security->getUser();
        if (!$user) {
            throw new RuntimeException('User not found');
        }

        $this->user = $user;
    }
}
