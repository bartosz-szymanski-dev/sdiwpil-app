<?php

namespace App\Controller\Document;

use App\Service\Document\PrintService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DownloadController extends AbstractController
{
    /**
     * @Route(
     *     "/document/{type}",
     *     name="front.document.generate",
     *     requirements={"type"="(prescription|leave)"},
     * )
     */
    public function index(string $type, PrintService $printService): Response
    {
        return $printService->getDocumentResponse($type);
    }
}
