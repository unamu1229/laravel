<?php


namespace Package\Salary\Model;


class CalcCommissionSalaryModel implements CalcSalaryInterface
{

    const COMPENSATION_SALES_UNIT = 500000;

    private $commissionRate;
    private $salesReceipts;
    private $serviceCharge;

    public function __construct($commissionRate, $salesReceipts, $serviceCharge)
    {
        $this->commissionRate = $commissionRate;
        $this->salesReceipts = $salesReceipts;
        $this->serviceCharge = $serviceCharge;
    }

    public function calcSalary()
    {
        $sales = 0;

        $compensationSalery = $this->serviceCharge * "-1";

        foreach ($this->salesReceipts as $salesReceipt) {
            $sales += $salesReceipt->amount;
        }

        $compesationAmount = $sales / self::COMPENSATION_SALES_UNIT;
        if ($compesationAmount) {
            $compensationSalery += $this->commissionRate * $compesationAmount;

            return $compensationSalery;
        }

        return $compensationSalery;
    }
}