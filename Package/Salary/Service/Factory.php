<?php


namespace Package\Salary\Service;


use Package\Salary\Salary\EmpHourly;
use Package\Salary\Salary\Employee;
use Package\Salary\Salary\EmpMonthly;
use Package\Salary\Salary\EmpMonthlyCommission;

class Factory
{
    public static function makeEmp($empsData)
    {
        $employees = [];

        foreach ($empsData as $empData) {
            if ($empData[4] == 'H') {
                $emp = new EmpHourly();
                $emp = self::setBasicEmpData($emp, $empData);
                $emp->setHourlyRate($empData[4]);
                $employees[] = $emp;
                continue;
            }
            if ($empData[4] == 'S') {
                $emp = new EmpMonthly();
                $emp = self::setBasicEmpData($emp, $empData);
                $emp->setMonthlySalary($empData[4]);
                $employees[] = $emp;
                continue;
            }
            if ($empData[4] == 'C') {
                $emp = new EmpMonthlyCommission();
                $emp = self::setBasicEmpData($emp, $empData);
                $emp->setMonthlySalary($empData[4]);
                $emp->setCommissionRate($empData[5]);
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