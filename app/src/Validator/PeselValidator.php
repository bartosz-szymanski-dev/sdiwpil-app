<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PeselValidator extends ConstraintValidator
{
    /**
     * @see https://cyberfolks.pl/blog/walidacja-pesel-w-php/
     */
    private const POSITION_WAGES = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3];

    public function validate($value, Constraint $constraint): void
    {
        /* @var $constraint Pesel */

        if (null === $value || '' === $value) {
            return;
        }

        if (!$this->isMatchingRegExp($value) || !$this->isCheckSumValid($value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }

    /**
     * @see https://cyberfolks.pl/blog/walidacja-pesel-w-php/
     */
    private function isMatchingRegExp(string $pesel): bool
    {
        return preg_match('/^\d{11}$/', $pesel);
    }

    private function getCheckSum(string $pesel): int
    {
        $sum = 0;
        for ($i = 0; $i < 10; $i++) {
            $sum += self::POSITION_WAGES[$i] * (int)$pesel[$i];
        }

        return $sum;
    }

    /**
     * @see https://cyberfolks.pl/blog/walidacja-pesel-w-php/
     */
    private function isCheckSumValid(string $pesel): bool
    {
        $int = 10 - $this->getCheckSum($pesel) % 10;
        $controlSum = ($int === 10) ? 0 : $int;

        return $controlSum === (int)$pesel[10];
    }
}
