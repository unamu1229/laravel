<?php


namespace tests\Salary;


use App\TimeCard;
use Package\Salary\Model\TimeCardModel;
use Package\Salary\Service\Transaction;
use Package\Salary\UseCase\TimeCardUseCase;
use Tests\TestCase;
// use PHPUnit\Framework\TestCase;
// Eloquent を利用しようとすると
// Class config does not exist
// /var/www/html/laravel/vendor/laravel/framework/src/Illuminate/Container/Container.php:752
// となる。
use Package\Salary\Repository\TimeCardRepository;

class TimeCardTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();
        TimeCard::query()->truncate();
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

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage 0行目のカラムの数が異なります。
     */
    public function testCheckTimeCardTransactionFormat()
    {
        $transaction = new Transaction();
        $timeCardsData = $transaction->getTransaction('/var/www/html/laravel/tests/Salary/Transaction/TimeCardIncorrectFormat');
        $transaction->checkTimeCardFormat($timeCardsData);
    }

    public function testConstruct()
    {
        $transaction = new Transaction();
        $timeCardsData = $transaction->getTransaction('/var/www/html/laravel/tests/Salary/Transaction/TimeCard');
        $timeCardUseCase = new TimeCardUseCase();
        $tmpTimeCards = $timeCardUseCase->add($timeCardsData);
        $timeCardRepository = $this->app->make(TimeCardRepository::class);
        foreach ($tmpTimeCards as $tmpTimeCard) {
            $timeCardRepository->save($tmpTimeCard);
        }
        $this->assertEquals($tmpTimeCards[0]->getEmpId(), 1);
    }
}