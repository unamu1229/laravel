<?php


namespace Package\Salary\Salary;


class Employee
{
    private $empId;
    private $name;
    private $address;

    /**
     * @return mixed
     */
    public function getEmpId()
    {
        return $this->empId;
    }

    public function setEmpId($empId)
    {
        $this->empId = $empId;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }
}