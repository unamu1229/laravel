<?php


namespace Package\AgileSoftwareDevelopment\Usecase;


abstract class ChangeMethodTransaction extends ChangeEmployeeTransaction
{
    public function change($e)
    {
        $e->setMethod($this->getMethod());
    }
    abstract function getMethod();
}