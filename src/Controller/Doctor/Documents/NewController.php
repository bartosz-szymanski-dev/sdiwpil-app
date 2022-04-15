<?php

namespace App\Controller\Doctor\Documents;

use App\Service\Document\CreateNewDocumentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class NewController extends AbstractController
{
    /**
     * @Route(
     *     "/doctor/documents/new",
     *     name="front.doctor.documents.new",
     *     methods={"POST"},
     * )
     */
    public function index(CreateNewDocumentService $newDocumentService): JsonResponse
    {
        return $newDocumentService->getJsonResponse();
    }
}
