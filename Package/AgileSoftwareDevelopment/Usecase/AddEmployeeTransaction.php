<?php


namespace Package\AgileSoftwareDevelopment\Usecase;


use Package\AgileSoftwareDevelopment\Repository\PayrollDatabase;
use Package\AgileSoftwareDevelopment\Model\Employee;
use Package\AgileSoftwareDevelopment\Model\HoldMethod;

abstract class AddEmployeeTransaction implements Transaction
{

    private $itsEmpId;
    private $itsName;
    private $itsAddress;

    public function __construct(int $empId, string $name, string $address)
    {
        $this->itsEmpId = $empId;
        $this->itsName = $name;
        $this->itsAddress = $address;
    }

    public function execute()
    {
        $pc = $this->getClassification();
        $ps = $this->getSchedule();
        $pm = new HoldMethod();
        $e = new Employee($this->itsEmpId, $this->itsName, $this->itsAddress);
        $e->setClassification($pc);
        $e->setSchedule($ps);
        $e->setMethod($pm);
        PayrollDatabase::addEmployee($this->itsEmpId, $e);
    }

    abstract function getSchedule();
    abstract function getClassification();
}