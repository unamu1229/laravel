<?php


namespace Package\AgileSoftwareDevelopment\Usecase;

use Package\AgileSoftwareDevelopment\Model\WeeklySchedule;
use Package\AgileSoftwareDevelopment\Model\HourlyClassification;

class AddHourlyEmployee extends AddEmployeeTransaction
{

    private $hourlyRate;

    public function __construct(int $empId, string $name, string $address, float $hourlyRate)
    {
        parent::__construct($empId, $name, $address);
        $this->hourlyRate = $hourlyRate;
    }
    function getSchedule()
    {
        return new WeeklySchedule();
    }

    function getClassification()
    {
        return new HourlyClassification($this->hourlyRate);
    }
}