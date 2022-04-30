<?php

namespace App\Controller;

use App\Service\Menu\MenuService;
use GuzzleHttp\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomePageViewController extends AbstractController
{
    /**
     * @Route("/", name="front.home_page")
     */
    public function index(MenuService $menuService, FlashBagInterface $flashBag): Response
    {
        return $this->render('home_page/index.html.twig', [
            'state' => Utils::jsonEncode([
                'menu' => $menuService->getMenu(),
                'errors' => $this->getErrorsPreparedForVue($flashBag->get('error')),
            ]),
        ]);
    }

    private function getErrorsPreparedForVue(array $errors): array
    {
        foreach ($errors as $error) {
            $result[]['message'] = $error;
        }

        return $result ?? [];
    }
}
