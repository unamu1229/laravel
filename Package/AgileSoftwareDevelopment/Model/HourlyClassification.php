<?php


namespace Package\AgileSoftwareDevelopment\Model;


class HourlyClassification implements PaymentClassification
{
    private $hourlyRate;

    public function __construct($hourlyRate)
    {
        $this->hourlyRate = $hourlyRate;
    }

    public function getHourlyRate()
    {
        return $this->hourlyRate;
    }
}