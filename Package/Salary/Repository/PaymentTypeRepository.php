<?php


namespace Package\Salary\Repository;


use App\PaymentType;

class PaymentTypeRepository
{
    private $paymentType;

    public function __construct(PaymentType $paymentType)
    {
        $this->paymentType = $paymentType;
    }

    public function getArgValueByName($name, $value)
    {
        return PaymentType::where('name', $name)->value($value);
    }
}