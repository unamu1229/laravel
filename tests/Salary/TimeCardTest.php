<?php


namespace tests\Salary;


use Package\Salary\Model\TimeCard;
use Package\Salary\Service\Transaction;
use Package\Salary\UseCase\TimeCardUseCase;
use Tests\TestCase;
// use PHPUnit\Framework\TestCase;
// Eloquent を利用しようとすると
// Class config does not exist
// /var/www/html/laravel/vendor/laravel/framework/src/Illuminate/Container/Container.php:752
// となる。

class TimeCardTest extends TestCase
{

    public function testConstruct()
    {
        $transaction = new Transaction();
        $timeCardsData = $transaction->getTransaction('/var/www/html/laravel/tests/Salary/Transaction/TimeCard');
        $timeCardUseCase = new TimeCardUseCase();
        $tmpTimeCards = $timeCardUseCase->add($timeCardsData);
        $this->assertEquals($tmpTimeCards[0]->getEmpId(), 1);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage この従業員は時給ではありません
     */
    public function testFalseConstruct()
    {
        $transaction = new Transaction();
        $timeCardsData = $transaction->getTransaction('/var/www/html/laravel/tests/Salary/Transaction/TimeCardNotEmpHourly');
        $timeCardUseCase = new TimeCardUseCase();
        $tmpTimeCards = $timeCardUseCase->add($timeCardsData);
    }
}