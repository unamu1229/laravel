<?php


namespace tests\AgileSoftwareDevelopment;

use Tests\TestCase;
use Package\AgileSoftwareDevelopment\Usecase\AddSalariedEmployee;
use Package\AgileSoftwareDevelopment\Repository\PayrollDatabase;


class TestPayroll extends TestCase
{
    public function testAddSalariedEmployee()
    {
        $empId = 1;
        $t = new AddSalariedEmployee($empId, 'Bob', 'Home', 1000.00);
        $t->execute();
        $e = PayrollDatabase::getEmployee($empId);
        $this->assertNotNull($e);
        $this->assertEquals('Bob', $e->getName());
        $pc = $e->getClassification();
        $sc = $pc; //$sc SalariedClassification
        $this->assertNotNull($sc);
        $this->assertEquals(1000.00, $sc->getSalary());
        $ps = $e->getSchedule();
        $ms = $ps; //$ms MonthlySchedule
        $this->assertNotNull($ms);
        $pm = $e->getMethod();
        $hm = $pm; //$hm HoldMethod
        $this->assertNotNull($hm);
    }
}