<?php

namespace Tests\Salary;

use Package\Salary\UseCase\EmpUseCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Package\Salary\Repository\EmployeeRepository;
use Package\Salary\Service\Transaction;

class EmployeeRepositoryTest extends TestCase
{

    public function testSave()
    {
        $transaction = new Transaction();
        $empsData = $transaction->getTransaction('/var/www/html/laravel/tests/Salary/Transaction/AddEmp');
        $empUseCase = new EmpUseCase();
        $employees = $empUseCase->addEmp($empsData);
        foreach ($employees as $employee) {
            $employeeRepository = $this->app->make(EmployeeRepository::class);
            $employeeRepository->save($employee);
        }
        $this->assertTrue(true);
    }
}
