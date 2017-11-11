<?php


namespace Package\Salary\UseCase;

use Package\Salary\Model\SalesReceiptModel;

class SalesReceiptUseCase extends TemplateUseCase
{
    public function makeModel($salesReceiptData)
    {
        return new SalesReceiptModel($salesReceiptData[1], $salesReceiptData[2], $salesReceiptData[3]);
    }
}