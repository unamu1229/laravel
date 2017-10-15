<?php


namespace Package\Salary\Model;


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