<?php


namespace Package\AgileSoftwareDevelopment\Usecase;

use Package\AgileSoftwareDevelopment\Model\BiweeklySchedule;
use Package\AgileSoftwareDevelopment\Model\CommissionedClassification;


class AddCommissionedEmployee extends AddEmployeeTransaction
{
    private $salary;
    private $commission;

    public function __construct(int $empId, string $name, string $address, float $salary, float $commission)
    {
        parent::__construct($empId, $name, $address);
        $this->salary = $salary;
        $this->commission = $commission;
    }

    function getSchedule()
    {
        return new BiweeklySchedule();
    }

    function getClassification()
    {
        return new CommissionedClassification($this->salary, $this->commission);
    }
}