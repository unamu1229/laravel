<?php


namespace Package\AgileSoftwareDevelopment\Model;


class BiweeklySchedule implements PaymentSchedule
{
    public function isPayDate($date)
    {
        static $cal = '';
        $weekDay = date('D', strtotime($date));
        if ($weekDay == 'Fri') {
            if ($cal == '') $cal = $date;
            if ($cal == $date) {
                $cal = date('Y-m-d', strtotime($date." + 14 day"));
                return true;
            }
        }
        return false;
    }

    public function getPayPeriodStartDate($payDate)
    {

    }
}