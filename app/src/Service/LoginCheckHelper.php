<?php

namespace App\Service;

use App\Entity\User;
use RuntimeException;

class LoginCheckHelper
{
    private const SUCCESS_KEY = 'success';
    private const MESSAGE_KEY = 'message';
    private const ROUTE_KEY = 'route';

    private array $state = [
        self::SUCCESS_KEY => false,
        self::MESSAGE_KEY => '',
        self::ROUTE_KEY => '',
    ];

    public function getState(?User $user): array
    {
        if (!$user) {
            return $this->getNoUserState();
        }

        return $this->getSuccessfulState($user);
    }

    private function getNoUserState(): array
    {
        $this->state[self::MESSAGE_KEY] = 'Nieprawidłowe dane logowania';

        return $this->state;
    }

    private function getSuccessfulState(User $user): array
    {
        $this->state[self::SUCCESS_KEY] = true;
        $this->state[self::MESSAGE_KEY] = 'Pomyślnie zalogowano do systemu';
        $this->state[self::ROUTE_KEY] = $this->getRoute($user);

        return $this->state;
    }

    private function getRoute(User $user): string
    {
        foreach ($user->getRoles() as $role) {
            if ($role !== User::ROLE_USER) {
                switch ($role) {
                    case User::ROLE_PATIENT:
                        return 'front.patient';
                    case User::ROLE_DOCTOR:
                        return 'front.doctor';
                    case User::ROLE_RECEPTIONIST:
                        return 'front.receptionist';
                    case User::ROLE_MANAGER:
                        return 'front.manager';
                    default:
                        throw new RuntimeException('Nie znaleziono strefy podanego użytkownika');
                }
            }
        }

        throw new RuntimeException('Użytkownik nie ma przypisanej żadnej roli w systemie');
    }
}
