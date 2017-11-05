<?php


namespace tests\Salary;

use Package\Salary\UseCase\PaydayUseCase;
use Tests\TestCase;
use Package\Salary\Service\Transaction;
use Package\Salary\Repository\EmployeeRepository;
use Package\Salary\Repository\TimeCardRepository;

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
                $this->assertEquals('every_friday', $payDayEmp->payDay);
                $timeCards = $timeCardRepository->getAllWhereColumnValue('empId', $payDayEmp->empId);
                $serviceChargeDue = $employeeRepository->getArgValueById($payDayEmp->empId, 'service_charge_dues');
                $salary = $paydayUseCase->calcHourlySalary($payDayEmp->hourlyRate, $timeCards, $serviceChargeDue);
                $this->assertTrue(in_array($salary, [3000, 600]));
                $this->assertEquals('Hold', $payDayEmp->paymentType()->first()->name);
            }
        }
    }
}