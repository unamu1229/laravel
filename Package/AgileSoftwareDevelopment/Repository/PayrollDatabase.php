<?php


namespace Package\AgileSoftwareDevelopment\Repository;

use Package\AgileSoftwareDevelopment\Model\Employee;


class PayrollDatabase
{
    private static $itsEmployees = [];

    public static function addEmployee($empId, Employee $e)
    {
        self::$itsEmployees[$empId] = $e;
    }

    public static function getEmployee(int $empId)
    {
        return self::$itsEmployees[$empId];
    }

    public static function clear()
    {
        self::$itsEmployees = [];
    }

    public static function getAllEmployeeIds()
    {
        $employees = self::$itsEmployees;
        $empIds = [];
        foreach ($employees as $employee) {
            $empIds[] = $employee->getEmpId();
        }

        return $empIds;
    }
}