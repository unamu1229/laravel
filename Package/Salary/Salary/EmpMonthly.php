<?php


namespace Package\Salary\Salary;


class EmpMonthly extends Employee
{
    private $monthlySalary;

    /**
     * @return mixed
     */
    public function getMonthlySalary()
    {
        return $this->monthlySalary;
    }

    /**
     * @param mixed $monthlySalary
     */
    public function setMonthlySalary($monthlySalary)
    {
        $this->monthlySalary = $monthlySalary;
    }
}