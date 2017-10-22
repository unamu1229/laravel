<?php

namespace Tests\Salary;

use Package\Salary\Model\SalesReceipt;
use Package\Salary\Service\Transaction;
use Package\Salary\UseCase\SalesReceiptUseCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesReceiptTest extends TestCase
{
    public function testMake()
    {
        $salesReceiptsData = (new Transaction())->getTransaction('/var/www/html/laravel/tests/Salary/Transaction/SalesReceipt');
        $tmpSalesReceiptData = (new SalesReceiptUseCase())->add($salesReceiptsData);
        $this->assertEquals($tmpSalesReceiptData[0]->getAmount(), 100000);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage この従業員はコミッション制ではありません
     */
    public function testNotCommissionEmp()
    {
        $salesReceiptsData = (new Transaction())->getTransaction('/var/www/html/laravel/tests/Salary/Transaction/SalesReceiptNotCommissionEmp');
        $tmpSalesReceiptData = (new SalesReceiptUseCase())->add($salesReceiptsData);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage 0行目のカラムの数が異なります。
     */
    public function testIncorrectFormat()
    {
        $transaction = new Transaction();
        $salesReceiptsData = $transaction->getTransaction('/var/www/html/laravel/tests/Salary/Transaction/SalesReceiptIncorrectFormat');
        $transaction->checkColumns($salesReceiptsData, 4);
    }
}
