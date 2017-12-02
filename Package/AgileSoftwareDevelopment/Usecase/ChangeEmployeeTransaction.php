<?php


namespace Package\AgileSoftwareDevelopment\Usecase;


use Package\AgileSoftwareDevelopment\Repository\PayrollDatabase;

abstract class ChangeEmployeeTransaction implements Transaction
{
    private $empId;

    public function __construct($empId)
    {
        $this->empId = $empId;
    }

    public function execute()
    {
        $e = PayrollDatabase::getEmployee($this->empId);
        $this->change($e);
    }

    abstract function change($e);
}