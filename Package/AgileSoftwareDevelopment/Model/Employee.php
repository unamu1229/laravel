<?php


namespace Package\AgileSoftwareDevelopment\Model;


class Employee
{

    private $schedule;
    private $classification;
    private $empId;
    private $name;
    private $address;
    private $affiliation;
    private $paymentMethod;

    /**
     * @param mixed $paymentMethod
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }


    public function __construct(int $itsEmpId, string $itsName, string $itsAddress)
    {
        $this->empId = $itsEmpId;
        $this->name = $itsName;
        $this->address = $itsAddress;
        $this->affiliation = new NoAffiliation();
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
        return $this->paymentMethod;
    }

    /**
     * @param mixed $method
     */
    public function setMethod($method)
    {
        $this->paymentMethod = $method;
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

    public function isPayDate($itsPayDate)
    {
        return $this->schedule->isPayDate($itsPayDate);
    }

    public function getPayPeriodStartDate($payDate)
    {
        return $this->schedule->getPayPeriodStartDate($payDate);
    }

    public function payday($pc)
    {
        $grossPay = $this->classification->calculatePay($pc);
        $deductions = $this->affiliation->calculateDeductions($pc);
        $netPay = $grossPay - $deductions;
        $pc->setGrossPay($grossPay);
        $pc->setDeductions($deductions);
        $pc->setNetPay($netPay);
        $this->paymentMethod->pay($pc);
    }

}