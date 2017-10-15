<?php

namespace Tests\Salary;

use Package\Salary\UseCase\EmpUseCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Package\Salary\Repository\EmployeeRepository;

class EmployeeRepositoryTest extends TestCase
{

    public function testSave()
    {
        $empUseCase = new EmpUseCase();
        $employees = $empUseCase->addEmp('/var/www/html/laravel/tests/Salary/Transaction/AddEmp');
        foreach ($employees as $employee) {
            $employeeRepository = $this->app->make(EmployeeRepository::class);
            $employeeRepository->save($employee);
        }
        $this->assertTrue(true);
    }
}
