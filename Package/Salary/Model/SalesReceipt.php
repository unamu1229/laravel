<?php


namespace Package\Salary\Model;

use Package\Salary\Repository\EmployeeRepository;

class SalesReceipt
{
    private $empId;
    private $date;
    private $amount;

    public function __construct($empId, $date, $amount)
    {
        $this->setEmpId($empId);
        $this->setDate($date);
        $this->setAmount($amount);
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
        $empRepository = app()->make(EmployeeRepository::class);
        $commissionRate = $empRepository->getArgValueById($empId, 'commissionRate');
        if (! $commissionRate) {
            throw new \Exception('この従業員はコミッション制ではありません');
        }
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
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

}