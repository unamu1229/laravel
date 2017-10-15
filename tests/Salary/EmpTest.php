<?php

namespace Tests\Salary;

use Package\Salary\Model\EmpHourly;
use Package\Salary\Model\EmpMonthly;
use Package\Salary\Model\EmpMonthlyCommission;
use Package\Salary\Service\Transaction;
use Package\Salary\UseCase\EmpUseCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmpTest extends TestCase
{

    private $empUseCase;

    function setUp()
    {
        parent::setUp();
        $this->empUseCase = new EmpUseCase();
    }


    /**
     * @expectedException \Exception
     */
    public function testCheckAddEmpTransaction()
    {
        $transaction = new Transaction();
        $empsData = $transaction->getTransaction('/var/www/html/laravel/tests/Salary/Transaction/AddEmpIncorrectFormat');
        $transaction->checkAddEmpFormat($empsData);
    }

    /**
     * @expectedException \Error
     * @expectedExceptionMessage Call to undefined method Tests\Salary\EmpTest::notExistMethod()
     */
    public function testCatchFatalError()
    {
        $this->notExistMethod();
    }

    public function testAddEmp()
    {
        $transaction = new Transaction();
        $empsData = $transaction->getTransaction('/var/www/html/laravel/tests/Salary/Transaction/AddEmp');
        $employees = $this->empUseCase->addEmp($empsData);
        $this->assertTrue($employees[0] instanceof EmpHourly);
        $this->assertTrue($employees[1] instanceof EmpMonthly);
        $this->assertTrue($employees[2] instanceof EmpMonthlyCommission);
    }

    public function testDelEmp()
    {
        $transaction = new Transaction();
        $empsData = $transaction->getTransaction('/var/www/html/laravel/tests/Salary/Transaction/AddEmp');
        $employees = $this->empUseCase->addEmp($empsData);
        $transaction = new Transaction();
        $delEmps = $transaction->getTransaction('/var/www/html/laravel/tests/Salary/Transaction/DelEmp');
        $empUseCase = new EmpUseCase();
        $employees = $empUseCase->delEmp($delEmps, $employees);

        foreach ($employees as $employee) {
            $this->assertNotEquals(1, $employee->getEmpId());
        }
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage 該当する従業員レコードがありません
     */
    public function testDisabledEmpIdOnDelEmp()
    {
        $transaction = new Transaction();
        $empsData = $transaction->getTransaction('/var/www/html/laravel/tests/Salary/Transaction/AddEmp');
        $employees = $this->empUseCase->addEmp($empsData);
        $transaction = new Transaction();
        $delEmps = $transaction->getTransaction('/var/www/html/laravel/tests/Salary/Transaction/DelEmpDisbledEmpId');
        $empUseCase = new EmpUseCase();
        $empUseCase->delEmp($delEmps, $employees);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage 0行目のカラムの数が異なります
     */
    public function testIncorrectTransactionOnDelEmp()
    {
        $transaction = new Transaction();
        $delEmps = $transaction->getTransaction('/var/www/html/laravel/tests/Salary/Transaction/DelEmpIncorrectFormat');
        $transaction->checkDelEmpFormat($delEmps);
    }

}
