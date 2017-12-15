<?php


namespace tests\AgileSoftwareDevelopment;

use Package\AgileSoftwareDevelopment\Model\BiweeklySchedule;
use Package\AgileSoftwareDevelopment\Model\HoldMethod;
use Package\AgileSoftwareDevelopment\Model\MonthlySchedule;
use Package\AgileSoftwareDevelopment\Model\WeeklySchedule;
use Package\AgileSoftwareDevelopment\Usecase\ChangeCommissionedTransaction;
use Package\AgileSoftwareDevelopment\Usecase\ChangeDirectTransaction;
use Package\AgileSoftwareDevelopment\Usecase\ChangeHoldTransaction;
use Package\AgileSoftwareDevelopment\Usecase\ChangeMailTransaction;
use Package\AgileSoftwareDevelopment\Usecase\ChangeSalariedTransaction;
use Package\AgileSoftwareDevelopment\Usecase\PaydayTransaction;
use Package\AgileSoftwareDevelopment\Usecase\SalesReceiptTransaction;
use Tests\TestCase;
use Package\AgileSoftwareDevelopment\Usecase\AddSalariedEmployee;
use Package\AgileSoftwareDevelopment\Repository\PayrollDatabase;
use Package\AgileSoftwareDevelopment\Usecase\AddHourlyEmployee;
use Package\AgileSoftwareDevelopment\Usecase\AddCommissionedEmployee;
use Package\AgileSoftwareDevelopment\Usecase\ChangeAddressTransaction;

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

    public function testSalesReceiptTransaction()
    {
        $empId = 3;
        $t = new AddCommissionedEmployee($empId, 'Takeshi', 'Bank', 1000.00, 50000);
        $t->execute();
        $sr = new SalesReceiptTransaction($empId,'20171129', '20000000');
        $sr->execute();
        $e = PayrollDatabase::getEmployee($empId);
        $pc = $e->getClassification();
        $receipts = $pc->getReceipt();
        foreach ($receipts as $receipt) {
            $this->assertEquals($receipt->getAmount(),'20000000');
        }
    }

    public function testChangeAddressTransaction()
    {
        $empId = 2;
        $t = new AddHourlyEmployee($empId, 'Yoneda', 'ShinOsaka', 15.25);
        $t->execute();
        $cnt = new ChangeAddressTransaction($empId, 'Tokyo');
        $cnt->execute();
        $e = PayrollDatabase::getEmployee($empId);
        $this->assertEquals('Tokyo', $e->getAddress());
    }

    public function testChangeSalariedTransaction()
    {
        $empId = 2;
        $t = new AddSalariedEmployee($empId, 'Kusaka', 'Toyonaka', 300000);
        $t->execute();
        $cst = new ChangeSalariedTransaction($empId, 450000);
        $cst->execute();
        $e = PayrollDatabase::getEmployee($empId);
        $this->assertEquals($e->getClassification()->getSalary(), 450000);
        $this->assertTrue($e->getSchedule() instanceof MonthlySchedule);
    }

    public function testChangeCommissionedTransaction()
    {
        $empId = 3;
        $t = new AddCommissionedEmployee($empId, 'Abe', 'Sakai', 300000, 150000);
        $t->execute();
        $cct = new ChangeCommissionedTransaction($empId, 330000, 160000);
        $cct->execute();
        $e = PayrollDatabase::getEmployee($empId);
        $this->assertEquals($e->getClassification()->getCommissionRate(), 160000);
        $this->assertTrue($e->getSchedule() instanceof BiweeklySchedule);
    }

    public function testChangeMethodTransaction()
    {
        $empId = 2;
        $t = new AddSalariedEmployee($empId, 'Kusaka', 'Toyonaka', 300000);
        $t->execute();

        $cdt = new ChangeDirectTransaction($empId, 'smbc', '231188976');
        $cdt->execute();

        $e = PayrollDatabase::getEmployee($empId);
        $this->assertEquals($e->getMethod()->getAccount(), '231188976');
    }

    public function testChangeMailTransaction()
    {
        $empId = 3;
        $t = new AddCommissionedEmployee($empId, 'Abe', 'Sakai', 300000, 150000);
        $t->execute();

        $cmt = new ChangeMailTransaction($empId, 'Mikuni');
        $cmt->execute();

        $e = PayrollDatabase::getEmployee($empId);
        $this->assertEquals($e->getMethod()->getAddress(), 'Mikuni');
    }

    public function testChangeHoldTransaction()
    {
        $empId = 1;
        $t = new AddSalariedEmployee($empId, 'Bob', 'Home', 1000.00);
        $t->execute();

        $cht = new ChangeHoldTransaction($empId);
        $cht->execute();

        $e = PayrollDatabase::getEmployee($empId);
        $this->assertTrue($e->getMethod() instanceof HoldMethod);
    }

    public function testReference()
    {
        $test = new Test();
        $nameObj = new Name();
        $test->setName($nameObj);
        $name = $test->getName();
        $name->setName('sssss');
        $name->name = 'ffff';
        $this->assertEquals($test->getName()->name, 'ffff');
        $nameName = $name->getName();
        $nameName = 'zzzz';
        $this->assertEquals($test->getName()->name, 'ffff');
    }

    public function testLiteralNotReference()
    {
        $test = new Test();
        $test->setName('dddd');
        $name = $test->getName();
        $name = 'zzzzz';
        $this->assertEquals($test->getName(), 'dddd');
    }

    public function testLiteralUseReference()
    {
        $testReference = new TestReference();
        $testReference->setName('dddd');
        $name =& $testReference->getName();
        $name = 'zzzzz';
        $this->assertEquals($testReference->getName(), 'zzzzz');
    }

    public function testThis()
    {
        $test = new Test();
        $test->setName('dddd');
        $testThis = $test->getThis();
        $testThis->setName('zzzz');
        $this->assertEquals($test->getName(), 'zzzz');
    }

    public function testPaySingleSalariedEmployee()
    {
        PayrollDatabase::clear();
        $empId = 1;
        $t = new AddSalariedEmployee($empId, 'Bob', 'Home', 1000.0);
        $t->execute();
        $payDate = '2017-12-31';
        $pt = new PaydayTransaction($payDate);
        $pt->execute();
        $this->validatePaycheck($pt, $empId, $payDate, 1000.0);
    }

    public function testPayCommissionedEmployee()
    {
        $empId = 3;
        $t = new AddCommissionedEmployee($empId, 'Abe', 'Sakai', 300000, 150000);
        $t->execute();
        $cct = new ChangeCommissionedTransaction($empId, 330000, 160000);
        $cct->execute();
        $sr = new SalesReceiptTransaction($empId,'20171129', '20000000');
        $sr->execute();
        $payDate = '2017-12-15';
        $pt = new PaydayTransaction($payDate);
        $pt->execute();
        $this->validatePaycheck($pt, $empId, $payDate, 3530000);
    }

    private function validatePaycheck(PaydayTransaction $pt, int $empId, $payDate, $pay)
    {
        $pc = $pt->getPaycheck($empId);
        $this->assertNotNull($pc);
        $this->assertEquals($pc->getPayPeriodEndDate(), $payDate);
        $this->assertEquals($pay, $pc->getGrossPay());
        $this->assertEquals('Hold', $pc->getField('Disposition'));
        $this->assertEquals(0.0, $pc->getDeductions());
        $this->assertEquals($pay, $pc->getNetPay());
    }
}


class TestReference
{
    public $name;
    public function setName($name)
    {
        $this->name = $name;
    }
    public function &getName()
    {
        return $this->name;
    }
    public function getThis()
    {
        return $this;
    }
}

class Test
{
    public $name;
    public function setName($name)
    {
        $this->name = $name;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getThis()
    {
        return $this;
    }
}

class Name
{
    public $name;
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
}