<?php


namespace Package\AgileSoftwareDevelopment\Model;


class CommissionedClassification
{
    private $salary;
    private $commissionRate;

    public function __construct($salary, $commissionRate)
    {
        $this->salary = $salary;
        $this->commissionRate = $commissionRate;
    }

    /**
     * @return mixed
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * @return mixed
     */
    public function getCommissionRate()
    {
        return $this->commissionRate;
    }

}