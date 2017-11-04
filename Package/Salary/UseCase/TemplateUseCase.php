<?php


namespace Package\Salary\UseCase;


abstract class TemplateUseCase
{
    public function add($transactionsData)
    {
        $tmpData = [];
        foreach ($transactionsData as $transactionData) {
            $tmpData[] = $this->makeModel($transactionData);
        }

        return $tmpData;
    }

    abstract function makeModel($transactionData);
}