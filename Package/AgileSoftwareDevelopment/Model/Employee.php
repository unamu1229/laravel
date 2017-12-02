<?php


namespace Package\AgileSoftwareDevelopment\Model;


class Employee
{

    private $schedule;
    private $classification;
    private $method;
    private $empId;
    private $name;
    private $address;

    public function __construct(int $itsEmpId, string $itsName, string $itsAddress)
    {
        $this->empId = $itsEmpId;
        $this->name = $itsName;
        $this->address = $itsAddress;
    }

    public function getClassification()
    {
        return $this->classification;
    }

    /**
     * @param mixed $classification
     */
    public function setClassification(PaymentClassification $classification)
    {
        $this->classification = $classification;
    }



    public function getName()
    {
        return $this->name;
    }

    public function getSchedule()
    {
        return $this->schedule;
    }

    /**
     * @param mixed $schedule
     */
    public function setSchedule($schedule)
    {
        $this->schedule = $schedule;
    }



    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return int
     */
    public function getEmpId()
    {
        return $this->empId;
    }

    /**
     * @param int $empId
     */
    public function setEmpId($empId)
    {
        $this->empId = $empId;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }





}