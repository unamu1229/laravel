<?php


namespace Package\AgileSoftwareDevelopment\Model;


interface PaymentSchedule
{
    public function isPayDate($payDate);

    public function getPayPeriodStartDate($payDate);
}