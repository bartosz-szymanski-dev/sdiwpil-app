<?php

namespace App\Controller\Login;

use App\Entity\User;
use App\Service\LoginCheckHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CheckController extends AbstractController
{
    /**
     * @Route(
     *     "/login/check",
     *     name="front.login.check",
     *     methods={"POST"},
     * )
     * @param User|null $user
     * @param LoginCheckHelper $loginCheckHelper
     * @return JsonResponse
     */
    public function index(?User $user, LoginCheckHelper $loginCheckHelper): JsonResponse
    {
        return $this->json($loginCheckHelper->getState($user));
    }
}
