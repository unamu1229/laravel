<?php


namespace Package\AgileSoftwareDevelopment\Model;


class SalesReceipt
{
    private $amount;
    private $date;

    public function __construct(string $date, int $amount)
    {
        $this->date = $date;
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

}