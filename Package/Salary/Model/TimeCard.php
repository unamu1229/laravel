<?php


namespace Package\Salary\Model;

use App\Employee;
use Package\Salary\Repository\EmployeeRepository;

class TimeCard
{
    private $empId;
    private $date;
    private $hours;

    public function __construct($empId, $date, $hours)
    {
        $this->setEmpId($empId);
        $this->setDate($date);
        $this->setHours($hours);
    }

    /**
     * @return mixed
     */
    public function getEmpId()
    {
        return $this->empId;
    }

    /**
     * @param mixed $empId
     */
    public function setEmpId($empId)
    {
        $employeeRepository = app()->make(EmployeeRepository::class);
        $hourlyRate = $employeeRepository->getHourlyRateById($empId);
        if (! $hourlyRate) {
            throw new \Exception('この従業員は時給ではありません');
        };
        $this->empId = $empId;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * @param mixed $hours
     */
    public function setHours($hours)
    {
        $this->hours = $hours;
    }


}