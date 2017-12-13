<?php


namespace Package\AgileSoftwareDevelopment\Model;


class SalariedClassification implements PaymentClassification
{
    private $salary;

    public function __construct($salary)
    {
        $this->salary = $salary;
    }

    /**
     * @return mixed
     */
    public function getSalary()
    {
        return $this->salary;
    }

    public function calculatePay($pc)
    {
        return $this->salary;
    }

}