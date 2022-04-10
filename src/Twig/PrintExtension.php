<?php

namespace App\Twig;

use Picqer\Barcode\BarcodeGeneratorPNG;
use Symfony\Component\HttpKernel\KernelInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class PrintExtension extends AbstractExtension
{
    private KernelInterface $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_environment', [$this, 'getEnvironment']),
            new TwigFunction('get_random_barcode', [$this, 'getRandomBarcode']),
        ];
    }

    public function getEnvironment(): string
    {
        return $_ENV['APP_ENV'];
    }

    public function getRandomBarcode(): array
    {
        $this->removeExistingBarcodes();
        $generator = new BarcodeGeneratorPNG();
        $randomBareCodeNumber = $this->getRandomNumberForPrescription();
        $fileName = $this->kernel->getProjectDir() . '/tmp/' . $randomBareCodeNumber . '.png';
        file_put_contents($fileName, $generator->getBarcode($randomBareCodeNumber, $generator::TYPE_CODE_128));

        return [
            'file' => $fileName,
            'code' => $randomBareCodeNumber,
        ];
    }

    private function getRandomNumberForPrescription(): string
    {
        $alphabet = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $result = '';
        for ($i = 0; $i < 44; $i++) {
            $result .= $alphabet[array_rand($alphabet)];
        }

        return $result;
    }

    private function removeExistingBarcodes(): void
    {
        $files = glob($this->kernel->getProjectDir() . '/tmp/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }
}
