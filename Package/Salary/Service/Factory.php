<?php


namespace Package\Salary\Service;


use Package\Salary\Model\EmpHourly;
use Package\Salary\Model\EmployeeModel;
use Package\Salary\Model\EmpMonthly;
use Package\Salary\Model\EmpMonthlyCommission;

class Factory
{
    public static function makeEmp($empsData)
    {
        $employees = [];

        foreach ($empsData as $empData) {
            if ($empData[4] == 'H') {
                $emp = new EmpHourly();
                $emp = self::setBasicEmpData($emp, $empData);
                $emp->setHourlyRate($empData[5]);
                $emp->setPayDay('every_friday');
                $employees[] = $emp;
                continue;
            }
            if ($empData[4] == 'S') {
                $emp = new EmpMonthly();
                $emp = self::setBasicEmpData($emp, $empData);
                $emp->setMonthlySalary($empData[5]);
                $emp->setPayDay('end_month');
                $employees[] = $emp;
                continue;
            }
            if ($empData[4] == 'C') {
                $emp = new EmpMonthlyCommission();
                $emp = self::setBasicEmpData($emp, $empData);
                $emp->setMonthlySalary($empData[5]);
                $emp->setCommissionRate($empData[6]);
                $emp->setPayDay('biweekly_friday');
                $employees[] = $emp;
                continue;
            }
        }

        return $employees;
    }

    private static function setBasicEmpData($emp, $empData) {
        $emp->setEmpId($empData[1]);
        $emp->setName($empData[2]);
        $emp->setAddress($empData[3]);

        return $emp;
    }
}