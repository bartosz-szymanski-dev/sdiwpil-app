<?php

namespace App\Controller\Doctor\Documents;

use App\Service\Document\DocumentListService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
    /**
     * @Route("/doctor/documents/list")
     */
    public function index(DocumentListService $documentListService): JsonResponse
    {
        return $documentListService->getJsonResponse();
    }
}
