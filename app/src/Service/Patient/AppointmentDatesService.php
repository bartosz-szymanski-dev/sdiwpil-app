<?php

namespace App\Service\Patient;

use App\Entity\Appointment;
use Carbon\Carbon;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;

class AppointmentDatesService
{
    private const TEXTUAL_DAY_REPRESENTATION_FORMAT = 'l';

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getResult(array $workingTime): array
    {
        $doctorVacation = $workingTime['vacation'];
        if ($this->isVacationLeave($doctorVacation)) {
            throw new \RuntimeException('Lekarz jest obecnie na urlopie.');
        }

        $day = strtolower(Carbon::now()->format(self::TEXTUAL_DAY_REPRESENTATION_FORMAT));
        $currentDayValues = $workingTime[$day];

        return $this->getAppointmentDatesForCurrentDay($currentDayValues, $day);
    }

    /**
     * @param array{start: DateTimeImmutable|null, end: DateTimeImmutable|null} $doctorVacation
     * @return bool
     */
    private function isVacationLeave(array $doctorVacation): bool
    {
        $start = $doctorVacation['start'] ?? null;
        $end = $doctorVacation['end'] ?? null;
        if (!$start || !$end) {
            return false;
        }

        $now = Carbon::now();

        return $now->greaterThanOrEqualTo($start) && $now->lessThanOrEqualTo($end);
    }

    private function isBookedAppointment(Carbon $now): ?Appointment
    {
        return $this->entityManager->getRepository(Appointment::class)
            ->findOneBy(['scheduledAt' => $now->toDateTimeImmutable()]);
    }

    private function getNow(): Carbon
    {
        $now = Carbon::now();
        $hour = (int)$now->format('H');
        $minute = (int)$now->format('i');
        if ($minute > 0 && $minute < 30) {
            $minute = 30;
        } elseif ($minute > 30) {
            $minute = 0;
            $hour++;
        }

        return Carbon::createFromTime($hour, $minute);
    }

    private function createDateFromNowAndDate(Carbon $now, DateTime $date): Carbon
    {
        return Carbon::create(
            $now->format('Y'),
            $now->format('m'),
            $now->format('d'),
            $date->format('H'),
            $date->format('i')
        );
    }

    /**
     * @param array{now: Carbon, day: string, start: Carbon, end: Carbon} $params
     * @return bool
     */
    private function cannotUse(array $params): bool
    {
        $now = $params['now'];
        $nowDay = strtolower($now->format(self::TEXTUAL_DAY_REPRESENTATION_FORMAT));

        return $nowDay !== $params['day'] ||
            $now->lessThan($params['start']) ||
            $now->greaterThan($params['end']) ||
            $this->isBookedAppointment($now) ||
            $now->eq(Carbon::now());
    }

    private function buildFrontEndValue(Carbon $now): array
    {
        return [
            'text' => sprintf('%s na godz.: %s', $now->format('d.m.Y'), $now->format('H:i')),
            'value' => $now->format('Y-m-d H:i'),
        ];
    }

    /**
     * @param array{start: DateTimeImmutable, end: DateTimeImmutable} $currentDayValues
     * @param string $day
     * @return array
     */
    private function getAppointmentDatesForCurrentDay(array $currentDayValues, string $day): array
    {
        $start = $currentDayValues['start'];
        $end = $currentDayValues['end'];

        $now = $this->getNow();
        for (; $now < Carbon::now()->addMonth(); $now->addMinutes(30)) {
            $start = $this->createDateFromNowAndDate($now, $start);
            $end = $this->createDateFromNowAndDate($now, $end);
            $cannotUseParams = [
                'now' => $now,
                'day' => $day,
                'start' => $start,
                'end' => $end,
            ];
            if ($this->cannotUse($cannotUseParams)) {
                continue;
            }

            $result[] = $this->buildFrontEndValue($now);
        }

        return $result ?? [];
    }
}
