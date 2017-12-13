<?php


namespace Package\AgileSoftwareDevelopment\Model;


class Paycheck
{
    private $itsPayPeriodStartDate;
    private $itsPayPeriodEndDate;
    private $grossPay;
    private $deductions;
    private $netPay;


    public function __construct($payPeriodStartDate, $payPeriodEndDate)
    {
        $this->itsPayPeriodStartDate = $payPeriodStartDate;
        $this->itsPayPeriodEndDate = $payPeriodEndDate;
    }

    public function setGrossPay($grossPay)
    {
        $this->grossPay = $grossPay;
    }

    public function setDeductions($deductions)
    {
        $this->deductions = $deductions;
    }

    public function setNetPay($netPay)
    {
        $this->netPay = $netPay;
    }

    public function getPayPeriodEndDate()
    {
        return $this->itsPayPeriodEndDate;
    }

    public function getGrossPay()
    {
        return $this->grossPay;
    }

    public function getDeductions()
    {
        return $this->deductions;
    }

    /**
     * @return mixed
     */
    public function getNetPay()
    {
        return $this->netPay;
    }

    public function getField($string)
    {
        if ($string == 'Disposition') {
            return 'Hold';
        }
        return null;
    }
}