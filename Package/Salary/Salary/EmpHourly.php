<?php


namespace Package\Salary\Salary;


class EmpHourly extends Employee
{
    private $hourlyRate;

    public function setHourlyRate($hourlyRate)
    {
        $this->hourlyRate = $hourlyRate;
    }
}