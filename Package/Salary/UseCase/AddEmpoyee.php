<?php


namespace Package\Salary\UseCase;
use Package\Salary\Service\Transaction;
use Package\Salary\Service\Factory;

class AddEmpoyee
{
    public function exec($transactionPath)
    {
        $transaction = new Transaction();
        $empsData = $transaction->getTransaction($transactionPath);
        try {
            $transaction->checkFormat($empsData);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        $employees = Factory::makeEmp($empsData);

        return $employees;
    }
}