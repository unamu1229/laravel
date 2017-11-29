<?php


namespace Package\AgileSoftwareDevelopment\Usecase;

use Package\AgileSoftwareDevelopment\Model\SalariedClassification;
use Package\AgileSoftwareDevelopment\Model\MonthlySchedule;

class AddSalariedEmployee extends AddEmployeeTransaction
{

    private $itsSalary;

    public function __construct(int $empId, string $name, string $address, float $salary)
    {
        parent::__construct($empId,$name,$address);
        $this->itsSalary = $salary;
    }

    public function getClassification()
    {
        return new SalariedClassification($this->itsSalary);
    }

    public function getSchedule()
    {
        return new MonthlySchedule();
    }
}