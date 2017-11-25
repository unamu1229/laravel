<?php


namespace Package\Salary\Model;


class CalcMonthlySalaryModel implements CalcSalaryInterface
{
    private $monthlySalary;
    private $serviceChargeDue;

    public function __construct($monthlySalary, $serviceChargeDue)
    {
        $this->monthlySalary = $monthlySalary;
        $this->serviceChargeDue = $serviceChargeDue;
    }

    public function calcSalary()
    {
        $paySalary = $this->monthlySalary - $this->serviceChargeDue;
        return $paySalary;
    }
}