<?php


namespace Package\Salary\Model;

use Package\Salary\Repository\EmployeeRepository;

class ServiceModel
{
    private $memberId;
    private $amount;
    public function __construct($memberId, $amount)
    {
        $this->setMemberId($memberId);
        $this->setAmount($amount);
    }

    /**
     * @return mixed
     */
    public function getMemberId()
    {
        return $this->memberId;
    }

    /**
     * @param mixed $memberId
     */
    public function setMemberId($memberId)
    {
        $employeeRepository = app()->make(EmployeeRepository::class);
        $empId = $employeeRepository->getArgValueById($memberId, 'empId');
        if (! $empId) {
            throw new \Exception('存在しない組合員です。');
        }
        $this->memberId = $memberId;
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