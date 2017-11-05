<?php

namespace Package\Salary\Model;

class EmployeeModel
{
    protected $empId;
    protected $name;
    protected $address;
    protected $payDay;

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
        $name = ltrim($name,'"');
        $name = rtrim($name,'"');
        $this->name = $name;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getPayDay()
    {
        return $this->payDay;
    }

    /**
     * @param mixed $payDay
     */
    public function setPayDay($payDay)
    {
        $this->payDay = $payDay;
    }


    
}
