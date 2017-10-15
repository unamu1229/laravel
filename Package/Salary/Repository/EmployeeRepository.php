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
}