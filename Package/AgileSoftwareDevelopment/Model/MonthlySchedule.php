<?php


namespace Package\AgileSoftwareDevelopment\Model;


class MonthlySchedule
{
    public function isPayDate($itsPayDate)
    {
        return $this->isLastDayOfMonth($itsPayDate);
    }

    private function isLastDayOfMonth($itsPayDate)
    {
        $lastDayOfMonth = date('Y-m-t');
        return $lastDayOfMonth == $itsPayDate;
    }

    public function getPayPeriodStartDate($payDate)
    {
        $payPeriodStartDate = date('Y-m-d');
        return $payPeriodStartDate;
    }
}