<?php

namespace Tests\Salary;

use App\SalesReceipt;
use Package\Salary\Model\SalesReceiptModel;
use Package\Salary\Service\Transaction;
use Package\Salary\UseCase\SalesReceiptUseCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Package\Salary\Repository\SalesReceiptRepository;

class SalesReceiptTest extends TestCase
{

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

    public function testMake()
    {
        SalesReceipt::query()->truncate();
        $salesReceiptsData = (new Transaction())->getTransaction('/var/www/html/laravel/tests/Salary/Transaction/SalesReceipt');
        $tmpSalesReceiptData = (new SalesReceiptUseCase())->add($salesReceiptsData);
        $this->assertEquals($tmpSalesReceiptData[0]->getAmount(), 1000000);
        $salesReceiptRepository = $this->app->make(SalesReceiptRepository::class);
        foreach ($tmpSalesReceiptData as $salesReceipt) {
            $salesReceiptRepository->save($salesReceipt);
        }
    }
}
