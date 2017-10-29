<?php

namespace Package\Salary\Repository;

use App\Employee;
use Package\Salary\Model\EmployeeModel;

class EmployeeRepository
{
    private $employee;
    
    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function save(EmployeeModel $employee)
    {
        $reflect = new \ReflectionClass($employee);
        foreach ($reflect->getProperties(\ReflectionProperty::IS_PRIVATE | \ReflectionProperty::IS_PROTECTED) as $reflectionProperty) {
            $reflectionProperty->setAccessible(true);
            $propertyName = $reflectionProperty->getName();
            $this->employee->$propertyName = $reflectionProperty->getValue($employee);
        }
        $this->employee->save();
    }

    public function getArgValueById($id, $value)
    {
        return $this->employee->where('empId', $id)->value($value);
    }
    
    public function updateWhereEmpId($empId, $updateData)
    {
        $this->employee->where('empId', $empId)->update($updateData);
    }
}