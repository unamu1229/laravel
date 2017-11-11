<?php


namespace Package\Salary\Repository;


use App\SalesReceipt;
use Package\Salary\Model\SalesReceiptModel;

class SalesReceiptRepository extends Repository
{
    private $eloquent;

    public function __construct(SalesReceipt $salesReceipt)
    {
        $this->eloquent = $salesReceipt;
    }

    public function save(SalesReceiptModel $salesReceiptModel)
    {
        $this->setModelPropertyToEloquent($salesReceiptModel, $this->eloquent);
    }
}