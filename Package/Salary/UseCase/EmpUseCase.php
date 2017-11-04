<?php


namespace Package\Salary\UseCase;
use Package\Salary\Service\Transaction;
use Package\Salary\Service\Factory;
use Package\Salary\Repository\EmployeeRepository;
use Package\Salary\Repository\PaymentTypeRepository;

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

    public function changeEmp($empsData)
    {
        $employeeRepository = app()->make(EmployeeRepository::class);
        foreach ($empsData as $empData) {
            $empId = $empData['empId'];
            $changeType = $empData['changeType'];
            $updateValue = null;
            if (array_key_exists(mb_strtolower($empData['changeType']), $empData)) {
                $updateValue = $empData[mb_strtolower($empData['changeType'])];
            }
            if ($changeType == 'Name') {
                $employeeRepository->updateWhereEmpId($empId, ['name' => $updateValue]);
                continue;
            }
            if ($changeType == 'Address') {
                $employeeRepository->updateWhereEmpId($empId, ['address' => $updateValue]);
                continue;
            }
            if ($changeType == 'Hourly') {
                $employeeRepository->updateWhereEmpId($empId, ['hourlyRate' => $updateValue]);
                continue;
            }
            if ($changeType == 'Salaried') {
                $employeeRepository->updateWhereEmpId($empId,['monthlySalary' => $updateValue]);
                continue;
            }
            if ($changeType == 'Commissioned') {
                $employeeRepository->updateWhereEmpId($empId, ['commissionRate' => $updateValue]);
                continue;
            }
            if ($changeType == 'Hold') {
                $paymentTypeId = (app()->make(PaymentTypeRepository::class))->getArgValueByName($changeType, 'id');
                $employeeRepository->updateWhereEmpId($empId, ['payment_type_id' => $paymentTypeId]);
            }
            if ($changeType == 'Direct') {
                $employeeRepository->updateWhereEmpId($empId, ['bank' => $empData['direct'], 'account' => $empData['account']]);
            }
            if ($changeType == 'Mail') {
                $employeeRepository->updateWhereEmpId($empId, ['check_send_address' => $empData['mail']]);
            }
        }
    }
}