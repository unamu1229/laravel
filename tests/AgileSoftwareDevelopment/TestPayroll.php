<?php


namespace tests\AgileSoftwareDevelopment;

use Package\AgileSoftwareDevelopment\Model\BiweeklySchedule;
use Package\AgileSoftwareDevelopment\Model\WeeklySchedule;
use Tests\TestCase;
use Package\AgileSoftwareDevelopment\Usecase\AddSalariedEmployee;
use Package\AgileSoftwareDevelopment\Repository\PayrollDatabase;
use Package\AgileSoftwareDevelopment\Usecase\AddHourlyEmployee;
use Package\AgileSoftwareDevelopment\Usecase\AddCommissionedEmployee;

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

    public function testAddHourlyEmployee()
    {
        $empId = 2;
        $t = new AddHourlyEmployee($empId, 'Ken', 'Mail', 1300);
        $t->execute();
        $e = PayrollDatabase::getEmployee($empId);
        $this->assertEquals('Ken', $e->getName());
        $pc = $e->getClassification();
        $this->assertEquals(1300, $pc->getHourlyRate());
        $ps = $e->getSchedule();
        $this->assertTrue($ps instanceof WeeklySchedule);
    }

    public function testAddCommissionedEmployee()
    {
        $empId = 3;
        $t = new AddCommissionedEmployee($empId, 'Takeshi', 'Bank', 1000.00, 50000);
        $t->execute();
        $e = PayrollDatabase::getEmployee($empId);
        $this->assertEquals('Takeshi', $e->getName());
        $pc = $e->getClassification();
        $this->assertEquals(1000.00, $pc->getSalary());
        $this->assertEquals(50000, $pc->getCommissionRate());
        $ps = $e->getSchedule();
        $this->assertTrue($ps instanceof BiweeklySchedule);
    }
}