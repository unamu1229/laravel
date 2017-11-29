<?php


namespace Package\AgileSoftwareDevelopment\Model;


class CommissionedClassification implements PaymentClassification
{
    private $salary;
    private $commissionRate;
    private $receipt;

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

    public function addSalesReceipt($receipt)
    {
        $this->receipt[] = $receipt;
    }

    /**
     * @return mixed
     */
    public function getReceipt()
    {
        return $this->receipt;
    }


}