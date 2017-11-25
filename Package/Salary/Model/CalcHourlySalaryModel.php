<?php


namespace Package\Salary\Model;

use Package\Salary\Repository\TimeCardRepository;

class CalcHourlySalaryModel implements CalcSalaryInterface
{

    const REGULAR_WORK_TIME = 8;

    private $hourlyRate;
    private $timeCards;
    private $serviceChargeDue;

    public function __construct($emp, $serviceChageDue)
    {
        $this->hourlyRate = $emp->hourlyRate;

        $timeCardRepository = app()->make(TimeCardRepository::class);
        $this->timeCards = $timeCardRepository->getAllWhereColumnValue('empId', $emp->empId);

        $this->serviceChargeDue = $serviceChageDue;
    }
    public function calcSalary()
    {
        $salary = 0;

        foreach ($this->timeCards as $timeCard) {
            if ($timeCard->hours > self::REGULAR_WORK_TIME) {
                $salary += ($this->hourlyRate * 1.5) * ($timeCard->hours - self::REGULAR_WORK_TIME);
                $salary += $this->hourlyRate * self::REGULAR_WORK_TIME;
            } else {
                $salary += $this->hourlyRate * $timeCard->hours;
            }
        }

        $salary -= $this->serviceChargeDue;

        return $salary;
    }
}