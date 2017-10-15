<?php


namespace Package\Salary\UseCase;
use Package\Salary\Service\Transaction;
use Package\Salary\Service\Factory;

class EmpUseCase
{
    public function addEmp($empsData)
    {
        $employees = Factory::makeEmp($empsData);

        return $employees;
    }

    public function delEmp($delEmps, $emps)
    {
        foreach ($delEmps as $delEmp) {
            foreach ($emps as $key => $employee) {
                if ($employee->getEmpId() == $delEmp[1]) {
                    unset($emps[$key]);
                    continue 2;
                }
            }
            throw new \Exception('該当する従業員レコードがありません');
        }
        return $emps;
    }
}