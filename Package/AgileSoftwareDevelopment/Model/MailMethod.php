<?php


namespace Package\AgileSoftwareDevelopment\Model;


class MailMethod
{
    private $address;

    public function __construct($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

}