<?php

namespace App\Service\Document;

use App\Entity\Document;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Snappy\Pdf;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class PrintService
{
    public const PRINT_PRESCRIPTION = 'prescription';

    private const DOCUMENT_SETTINGS = [
        self::PRINT_PRESCRIPTION => [
            'page-size' => 'A4',
            'dpi' => 300,
            'page-width' => 90,
            'page-height' => 200,
            'margin-left' => 0,
            'margin-right' => 0,
            'margin-top' => 0,
            'margin-bottom' => 0,
            'disable-smart-shrinking' => true,
            'enable-local-file-access' => true,
        ],
    ];

    private Pdf $pdf;
    private Environment $twig;
    private EntityManagerInterface $entityManager;

    public function __construct(Pdf $pdf, Environment $twig, EntityManagerInterface $entityManager)
    {
        $this->pdf = $pdf;
        $this->twig = $twig;
        $this->entityManager = $entityManager;
    }

    public function getDocumentResponse(string $hash): Response
    {
        $document = $this->entityManager->getRepository(Document::class)->findOneBy(['hash' => $hash]);

        return new Response();
    }

    private function getResponse(string $type, string $content): Response
    {
        $fileName = sprintf('%s.pdf', $type === self::PRINT_PRESCRIPTION ? 'Recepta' : 'Skierowanie');
        $response = new Response();
        $response->headers->set('Cache-Control', 'private');
        $response->headers->set('Content-Type', 'application/pdf');
        $response->headers->set('Content-Disposition', 'inline; filename="' . $fileName . '";');
        $response->headers->set('Content-length', strlen($content));
        $response->setContent($content);

        return $response;
    }

    private function generatePrescriptionContent(): string
    {
        $html = $this->twig->render('/print/prescription.html.twig');

        return $this->pdf->getOutputFromHtml($html, self::DOCUMENT_SETTINGS[self::PRINT_PRESCRIPTION]);
    }
}
