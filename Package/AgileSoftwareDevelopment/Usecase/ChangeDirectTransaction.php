<?php


namespace Package\AgileSoftwareDevelopment\Usecase;


use Package\AgileSoftwareDevelopment\Model\DirectMethod;

class ChangeDirectTransaction extends ChangeMethodTransaction
{
    private $bank;
    private $account;

    public function __construct($empId, $bank, $account)
    {
        parent::__construct($empId);
        $this->bank = $bank;
        $this->account = $account;
    }

    public function getMethod()
    {
        return new DirectMethod($this->bank, $this->account);
    }
}