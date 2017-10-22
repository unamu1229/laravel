<?php


namespace Package\Salary\UseCase;


abstract class TemplateUseCase
{
    public function add($transactionsData)
    {
        $tmpTimeCards = [];
        foreach ($transactionsData as $transactionData) {
            $tmpTimeCards[] = $this->makeModel($transactionData);
        }

        return $tmpTimeCards;
    }

    abstract function makeModel($transactionData);
}