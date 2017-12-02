<?php


namespace Package\AgileSoftwareDevelopment\Usecase;


use Package\AgileSoftwareDevelopment\Model\MonthlySchedule;
use Package\AgileSoftwareDevelopment\Model\SalariedClassification;

class ChangeSalariedTransaction extends ChangeClassificationTransaction
{

    private $salary;

    public function __construct($empId, $salary)
    {
        parent::__construct($empId);

        $this->salary = $salary;
    }
    protected function getClassification()
    {
        return new SalariedClassification($this->salary);
    }
    protected function getSchedule()
    {
        return new MonthlySchedule();
    }
}