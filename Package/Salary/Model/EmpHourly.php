<?php


namespace Package\Salary\Model;


class EmpHourly extends EmployeeModel
{
    private $hourlyRate;

    public function setHourlyRate($hourlyRate)
    {
        $this->hourlyRate = $hourlyRate;
    }
}