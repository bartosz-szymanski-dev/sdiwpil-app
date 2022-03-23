<?php

namespace App\Service\Patient;

use Carbon\Carbon;
use DateTime;

class AppointmentDatesService
{
    public function getResult(array $workingTime): array
    {
        $doctorVacation = $workingTime['vacation'];
        if ($this->isVacationLeave($doctorVacation)) {
            throw new \RuntimeException('Lekarz jest obecnie na urlopie.');
        }

        $day = strtolower(Carbon::now()->format('l'));
        $currentDayValues = $workingTime[$day];

        return $this->getAppointmentDatesForCurrentDay($currentDayValues);
    }

    private function isVacationLeave(array $doctorVacation): bool
    {
        /** @var DateTime $start */
        $start = $doctorVacation['start'] ?? null;
        /** @var DateTime $end */
        $end = $doctorVacation['end'] ?? null;
        if (!$start || !$end) {
            return false;
        }

        $now = Carbon::now();

        return $now->greaterThanOrEqualTo($start) && $now->lessThanOrEqualTo($end);
    }

    /**
     * @param array{start: DateTime, end: DateTime} $currentDayValues
     * @return array
     */
    private function getAppointmentDatesForCurrentDay(array $currentDayValues): array
    {
        $start = $currentDayValues['start'];
        $end = $currentDayValues['end'];

        $now = Carbon::now();
//        for ($now; $now < Carbon::now()->addDays(31); $now->)
    }
}
