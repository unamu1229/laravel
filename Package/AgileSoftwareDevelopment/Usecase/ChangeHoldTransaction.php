<?php


namespace Package\AgileSoftwareDevelopment\Usecase;


use Package\AgileSoftwareDevelopment\Model\HoldMethod;

class ChangeHoldTransaction extends ChangeMethodTransaction
{

    public function getMethod()
    {
        return new HoldMethod();
    }
}