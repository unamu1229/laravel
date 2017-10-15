<?php


namespace Package\Salary\Model;


class EmpMonthly extends EmployeeModel
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