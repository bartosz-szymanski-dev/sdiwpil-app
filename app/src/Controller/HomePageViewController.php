<?php

namespace App\Controller;

use GuzzleHttp\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageViewController extends AbstractController
{
    /**
     * @Route("/", name="front.home_page")
     */
    public function index(): Response
    {
        return $this->render('home_page/index.html.twig', [
            'state' => Utils::jsonEncode([]),
        ]);
    }
}
