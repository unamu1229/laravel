<?php


namespace Package\AgileSoftwareDevelopment\Usecase;


use Package\AgileSoftwareDevelopment\Model\BiweeklySchedule;
use Package\AgileSoftwareDevelopment\Model\CommissionedClassification;

class ChangeCommissionedTransaction extends ChangeClassificationTransaction
{
    private $salary;
    private $commission;

    public function __construct($empId, $salary, $commission)
    {
        parent::__construct($empId);
        $this->salary = $salary;
        $this->commission = $commission;
    }

    public function getClassification()
    {
        return new CommissionedClassification($this->salary, $this->commission);
    }

    public function getSchedule()
    {
        return new BiweeklySchedule();
    }
}