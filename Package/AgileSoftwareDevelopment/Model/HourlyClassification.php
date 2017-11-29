<?php


namespace Package\AgileSoftwareDevelopment\Model;


class HourlyClassification
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