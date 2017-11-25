<?php


namespace Package\Salary\UseCase;


class PaydayUseCase
{
    const REGULAR_WORK_TIME = 8;
    const COMPENSATION_SALES_UNIT = 500000;

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

    public function CommissionSalary($commissionRate, $salesReceipts, $serviceChargeDue)
    {
        $sales = 0;

        $compesationSalery = $serviceChargeDue * "-1";

        foreach ($salesReceipts as $salesReceipt) {
            $sales += $salesReceipt->amount;
        }

        $compesationAmount = $sales / self::COMPENSATION_SALES_UNIT;
        if ($compesationAmount) {
            $compesationSalery += $commissionRate * $compesationAmount;

            return $compesationSalery;
        }

        return $compesationSalery;
    }

    public function calcMonthlySalary($monthlySalary, $serviceChargeDue)
    {
        $paySalary = $monthlySalary - $serviceChargeDue;
        return $paySalary;
    }
}