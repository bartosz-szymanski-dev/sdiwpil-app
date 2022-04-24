<?php

namespace App\Controller\Doctor\Appointments;

use App\Service\Menu\MenuService;
use GuzzleHttp\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewController extends AbstractController
{
    /**
     * @Route("/doctor/appointments", name="front.doctor.appointments")
     */
    public function index(MenuService $menuService): Response
    {
        return $this->render('doctor/appointments.html.twig', [
            'state' => Utils::jsonEncode([
                'menu' => $menuService->getMenu(),
            ]),
        ]);
    }
}
