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
            new TwigFunction('get_random_prefix_id', [$this, 'getRandomPrefixId']),
            new TwigFunction('get_random_access_code', [$this, 'getRandomAccessCode']),
            new TwigFunction('get_random_date_in_past', [$this, 'getRandomDateInPast']),
            new TwigFunction('get_random_prescription_id', [$this, 'getRandomPrescriptionId']),
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

    public function getRandomPrefixId(): string
    {
        $mapping = [
            [0, 9],
            [10, 99],
            [100, 999],
            [0, 9],
            [100000, 999999],
            [0, 9],
            [1000, 9999],
            [0, 9],
            [0, 9],
            [10000, 99999],
            [0, 9],
            [0, 9],
        ];

        $result = '';
        foreach ($mapping as $i => $rangeArray) {
            $result .= random_int($rangeArray[0], $rangeArray[1]);
            if ($i !== 11) {
                $result .= '.';
            }
        }

        return $result;
    }

    public function getRandomAccessCode(): int
    {
        return random_int(1000, 9999);
    }

    public function getRandomDateInPast(): string
    {
        return (new \DateTime('-' . random_int(1, 365) . ' days'))->format('d.m.Y');
    }

    public function getRandomPrescriptionId(): string
    {
        $alphabet = 'qwertyuiopasdfghjklzxcvbnm';
        $randomLetters = '';
        for ($i = 0; $i < 2; $i++) {
            $randomLetters .= $alphabet[random_int(0, 25)];
        }

        return sprintf(
            '%s%s%s',
            random_int(1000000000, 9999999999),
            $randomLetters,
            random_int(1000000000, 9999999999)
        );
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
