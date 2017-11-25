<?php


namespace tests\Salary;

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

        $timeCardRepository = $this->app->make(TimeCardRepository::class);
        $employeeRepository = $this->app->make(EmployeeRepository::class);
        $paydayUseCase = new PaydayUseCase();

        foreach ($empsData as $empData) {
            $payDayEmps = $employeeRepository->getAllByPayday($empData[1]);

            foreach ($payDayEmps as $payDayEmp) {
                $timeCards = $timeCardRepository->getAllWhereColumnValue('empId', $payDayEmp->empId);
                $serviceChargeDue = $employeeRepository->getArgValueById($payDayEmp->empId, 'service_charge_dues');
                if ($payDayEmp->payDay == 'every_friday') {
                    $salary = $paydayUseCase->calcHourlySalary($payDayEmp->hourlyRate, $timeCards, $serviceChargeDue);
                    $this->assertTrue(in_array($salary, [3000]));
                    $this->assertEquals('Hold', $payDayEmp->paymentType()->first()->name);
                    continue;
                }
                if ($payDayEmp->payDay == 'biweekly_friday') {
                    $salesReceipt = $this->app->make(SalesReceiptRepository::class);
                    $salary = $paydayUseCase->CommissionSalary($payDayEmp->commissionRate, $salesReceipt->getAllWhereColumnValue('empId', $payDayEmp->empId), $serviceChargeDue);
                    $this->assertEquals(680000, $salary);
                    $this->assertEquals('Hold', $payDayEmp->paymentType()->first()->name);
                    continue;
                }
                if ($payDayEmp->payDay == 'end_month') {
                    $salary = $paydayUseCase->calcMonthlySalary($payDayEmp->monthlySalary, $serviceChargeDue);
                    $this->assertEquals(330000, $salary);
                    $this->assertEquals('Hold', $payDayEmp->paymentType()->first()->name);
                }
            }
        }
    }
}