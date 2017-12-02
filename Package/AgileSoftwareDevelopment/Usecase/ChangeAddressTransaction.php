<?php


namespace Package\AgileSoftwareDevelopment\Usecase;


class ChangeAddressTransaction extends ChangeEmployeeTransaction
{
    private $address;

    public function __construct($empId, $address)
    {
        parent::__construct($empId);
        $this->address = $address;
    }

    public function change($e)
    {
        $e->setAddress($this->address);
    }
}