<?php


namespace Package\AgileSoftwareDevelopment\Usecase;


use Package\AgileSoftwareDevelopment\Model\CommissionedClassification;
use Package\AgileSoftwareDevelopment\Repository\PayrollDatabase;
use Package\AgileSoftwareDevelopment\Model\SalesReceipt;

class SalesReceiptTransaction implements Transaction
{
    private $empId;
    private $date;
    private $amount;

    public function __construct(int $empId, string $date, int $amount)
    {
        $this->empId = $empId;
        $this->date = $date;
        $this->amount = $amount;
    }

    public function execute()
    {
        $e = PayrollDatabase::getEmployee($this->empId);
        $pc = $e->getClassification();
        if (! $pc instanceof CommissionedClassification) {
            throw new \Exception('売上制では無い従業員に売上レシートを追加しようとしています。');
        }
        $r = new SalesReceipt($this->date, $this->amount);
        $pc->addSalesReceipt($r);
    }
}