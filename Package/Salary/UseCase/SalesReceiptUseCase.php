<?php


namespace Package\Salary\UseCase;

use Package\Salary\Model\SalesReceipt;

class SalesReceiptUseCase extends TemplateUseCase
{
    public function makeModel($salesReceiptData)
    {
        return new SalesReceipt($salesReceiptData[1], $salesReceiptData[2], $salesReceiptData[3]);
    }
}