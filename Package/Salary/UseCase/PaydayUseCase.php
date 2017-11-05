<?php


namespace Package\Salary\UseCase;


class PaydayUseCase
{
    const REGULAR_WORK_TIME = 8;

    public function calcHourlySalary($rate, $timeCards, $serviceChargeDue)
    {
        $salary = 0;

        foreach ($timeCards as $timeCard) {
            if ($timeCard->hours > self::REGULAR_WORK_TIME) {
                $salary += ($rate * 1.5) * ($timeCard->hours - self::REGULAR_WORK_TIME);
                $salary += $rate * self::REGULAR_WORK_TIME;
            } else {
                $salary += $rate * $timeCard->hours;
            }
        }

        $salary -= $serviceChargeDue;

        return $salary;
    }
}