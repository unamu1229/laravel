<?php


namespace Package\Salary\Salary;


class EmpMonthlyCommission extends EmpMonthly
{
    private $commissionRate;

    /**
     * @return mixed
     */
    public function getCommissionRate()
    {
        return $this->commissionRate;
    }

    /**
     * @param mixed $commissionRate
     */
    public function setCommissionRate($commissionRate)
    {
        $this->commissionRate = $commissionRate;
    }
}