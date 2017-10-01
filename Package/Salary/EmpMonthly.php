<?php


namespace Package\Salary;


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