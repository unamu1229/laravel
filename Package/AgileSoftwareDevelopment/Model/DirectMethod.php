<?php


namespace Package\AgileSoftwareDevelopment\Model;


class DirectMethod
{
    private $bank;
    private $account;

    public function __construct($bank,$account)
    {
        $this->bank = $bank;
        $this->account = $account;
    }

    /**
     * @return mixed
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @return mixed
     */
    public function getBank()
    {
        return $this->bank;
    }


}