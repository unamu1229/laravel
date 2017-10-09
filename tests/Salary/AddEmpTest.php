<?php

namespace Tests\Salary;

use Package\Salary\Salary\EmpHourly;
use Package\Salary\Salary\EmpMonthly;
use Package\Salary\Salary\EmpMonthlyCommission;
use Package\Salary\Service\CheckTransaction;
use Package\Salary\UseCase\AddEmpoyee;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddEmpTest extends TestCase
{

    private $addEmployee;

    function setUp()
    {
        parent::setUp();
        $this->addEmployee = new AddEmpoyee();
    }


    public function testCheckTransaction()
    {
        print_r($this->addEmployee->exec('tests/Salary/Transaction/AddEmpIncorrectFormat'));
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
        $employees = $this->addEmployee->exec('tests/Salary/Transaction/AddEmp');
        $this->assertTrue($employees[0] instanceof EmpHourly);
        $this->assertTrue($employees[1] instanceof EmpMonthly);
        $this->assertTrue($employees[2] instanceof EmpMonthlyCommission);
    }
}
