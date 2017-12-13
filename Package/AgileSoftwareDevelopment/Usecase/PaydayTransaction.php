<?php


namespace Package\AgileSoftwareDevelopment\Usecase;


use Package\AgileSoftwareDevelopment\Repository\PayrollDatabase;
use Package\AgileSoftwareDevelopment\Model\Paycheck;

class PaydayTransaction implements Transaction
{
    private $itsPayDate;
    private $itsPaychecks = [];

    public function __construct($payDate)
    {
        $this->itsPayDate = $payDate;
    }
    
    public function execute()
    {
        $empIds = PayrollDatabase::getAllEmployeeIds();

        foreach ($empIds as $empId) {
            $e = PayrollDatabase::getEmployee($empId);
            if ($e->isPayDate($this->itsPayDate)) {
                $pc = new Paycheck($e->getPayPeriodStartDate($this->itsPayDate), $this->itsPayDate);
                $this->itsPaychecks[$empId] = $pc;
                $e->payday($pc);
            }
        }
    }

    public function getPaycheck($empId)
    {
        return $this->itsPaychecks[$empId];
    }

    public function getField($string)
    {
        if ($string == 'Disposition') {
            return 'Hold';
        }

        return null;
    }
}