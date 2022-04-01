<?php

namespace App\Service\Settings;

use App\Entity\User;
use GuzzleHttp\Utils;
use RuntimeException;
use Symfony\Component\Security\Core\Security;

class UserSettingsStateService
{
    protected Security $security;
    protected User $user;

    protected array $state = [];

    public function __construct(Security $security)
    {
        $this->security = $security;
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
