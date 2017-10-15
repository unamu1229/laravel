<?php

namespace Tests\Salary;

use Package\Salary\Salary\EmpHourly;
use Package\Salary\Salary\EmpMonthly;
use Package\Salary\Salary\EmpMonthlyCommission;
use Package\Salary\Service\Transaction;
use Package\Salary\UseCase\EmpUseCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmpTest extends TestCase
{

    private $addEmployee;

    function setUp()
    {
        parent::setUp();
        $this->addEmployee = new EmpUseCase();
    }


    public function testCheckTransaction()
    {
        print_r($this->addEmployee->exec('/var/www/html/laravel/tests/Salary/Transaction/AddEmpIncorrectFormat'));
        $this->assertTrue(true);
    }

    public function testCatchFatalError()
    {
        try {
            $this->notExistMethod();
        } catch  (\Error $e) {
            echo $e->getMessage();
            $this->assertTrue(true);
            return;
        }
    }

    public function testAddEmp()
    {
        $employees = $this->addEmployee->exec('/var/www/html/laravel/tests/Salary/Transaction/AddEmp');
        $this->assertTrue($employees[0] instanceof EmpHourly);
        $this->assertTrue($employees[1] instanceof EmpMonthly);
        $this->assertTrue($employees[2] instanceof EmpMonthlyCommission);
    }

    public function testDelEmp()
    {
        $employees = $this->addEmployee->exec('/var/www/html/laravel/tests/Salary/Transaction/AddEmp');
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
        $employees = $this->addEmployee->exec('/var/www/html/laravel/tests/Salary/Transaction/AddEmp');
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
