<?php


namespace Package\AgileSoftwareDevelopment\Usecase;


use Package\AgileSoftwareDevelopment\Model\MailMethod;

class ChangeMailTransaction extends ChangeMethodTransaction
{

    private $address;

    public function __construct($empId, $address)
    {
        parent::__construct($empId);
        $this->address = $address;
    }
    public function getMethod()
    {
        return new MailMethod($this->address);
    }
}