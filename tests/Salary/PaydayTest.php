<?php


namespace tests\Salary;

use Package\Salary\Service\CalcSalaryFactory;
use Package\Salary\UseCase\PaydayUseCase;
use Tests\TestCase;
use Package\Salary\Service\Transaction;
use Package\Salary\Repository\EmployeeRepository;
use Package\Salary\Repository\TimeCardRepository;
use Package\Salary\Repository\SalesReceiptRepository;

class PaydayTest extends  TestCase
{
    public function testPayday()
    {
        $transaction = new Transaction();
        $empsData = $transaction->getTransaction('/var/www/html/laravel/tests/Salary/Transaction/Payday');

        $employeeRepository = $this->app->make(EmployeeRepository::class);
        $paydayUseCase = new PaydayUseCase();

        foreach ($empsData as $empData) {
            $payDayEmps = $employeeRepository->getAllByPayday($empData[1]);

            foreach ($payDayEmps as $payDayEmp) {
                $serviceChargeDue = $employeeRepository->getArgValueById($payDayEmp->empId, 'service_charge_dues');

                $calcSalaryFactory = new CalcSalaryFactory();
                $calcSalary = $calcSalaryFactory->makeCalcSalary($payDayEmp, $serviceChargeDue);
                if ($calcSalary == null) continue;

                $salary = $paydayUseCase->execCalcSalary($calcSalary);

                if ($payDayEmp->payDay == 'every_friday') {
                    $this->assertTrue(in_array($salary, [3000]));
                    $this->assertEquals('Hold', $payDayEmp->paymentType()->first()->name);
                    continue;
                }
                if ($payDayEmp->payDay == 'biweekly_friday') {
                    $this->assertEquals(680000, $salary);
                    $this->assertEquals('Hold', $payDayEmp->paymentType()->first()->name);
                    continue;
                }
                if ($payDayEmp->payDay == 'end_month') {
                    $this->assertEquals(330000, $salary);
                    $this->assertEquals('Hold', $payDayEmp->paymentType()->first()->name);
                    continue;
                }
            }
        }
    }
}