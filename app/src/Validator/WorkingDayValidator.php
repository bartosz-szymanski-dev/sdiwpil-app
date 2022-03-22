<?php

namespace App\Validator;

use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class WorkingDayValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        /* @var $constraint WorkingDay */
        if (!$constraint instanceof WorkingDay) {
            throw new UnexpectedTypeException($constraint, WorkingDay::class);
        }

        $start = $value['start'] ?? '';
        $end = $value['end'] ?? '';
        if ('' === $start || '' === $end) {
            return;
        }

        if (!is_array($value)) {
            throw new UnexpectedTypeException($value, 'array');
        }

        if (!$this->isValidWorkingDay($value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', implode(', ', $value))
                ->addViolation();
        }
    }

    private function isValidWorkingDay(array $workingDay): bool
    {
        $pattern = '/^(0\d|1\d|2[0-3]):([0-5]\d)$/';
        $separator = ':';
        $start = $workingDay['start'] ?? '';
        $end = $workingDay['end'] ?? '';
        dd($end);
        if (!$start || !$end || !preg_match($pattern, $start) || !preg_match($pattern, $end)) {
            return false;
        }

        $start = explode($separator, $start);
        $startHour = (int)$start[0];
        $startMinutes = (int)$start[1];

        $end = explode($separator, $end);
        $endHour = (int)$end[0];
        $endMinutes = (int)$end[1];

        if ($endHour < $startHour) {
            return false;
        }

        if ($startHour === $endHour && $endMinutes <= $startMinutes) {
            return false;
        }

        return true;
    }
}
