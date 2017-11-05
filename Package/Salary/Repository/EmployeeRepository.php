<?php

namespace Package\Salary\Repository;

use App\Employee;
use Package\Salary\Model\EmployeeModel;

class EmployeeRepository extends Repository
{
    private $eloquent;
    
    public function __construct(Employee $employee)
    {
        $this->eloquent = $employee;
    }

    public function save(EmployeeModel $employee)
    {
        $this->setModelPropertyToEloquent($employee, $this->eloquent);
    }

    public function getArgValueById($id, $value)
    {
        return $this->eloquent->where('empId', $id)->value($value);
    }
    
    public function updateWhereEmpId($empId, $updateData)
    {
        $this->eloquent->where('empId', $empId)->update($updateData);
    }

    public function getAllByPayday($payDay)
    {
        return $this->eloquent->where('payDay', $payDay)->get();
    }
}