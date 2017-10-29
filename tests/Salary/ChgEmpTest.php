<?php


namespace tests\Salary;

use Package\Salary\Repository\EmployeeRepository;
use Tests\TestCase;
use Package\Salary\Service\Transaction;
use Package\Salary\UseCase\EmpUseCase;
use Package\Salary\Repository\PaymentTypeRepository;

class ChgEmpTest extends TestCase
{
    private $empUseCase;

    function setUp()
    {
        parent::setUp();
        $this->empUseCase = new EmpUseCase();
    }

    public function testChgName()
    {
        $transaction = new Transaction();
        $empsData = $transaction->getTransaction('/var/www/html/laravel/tests/Salary/Transaction/ChgEmp');
        $empUseCase = new EmpUseCase();
        $empUseCase->changeEmp($empsData);
        $employeeRepository = $this->app->make(EmployeeRepository::class);
        $changedValue = null;

        foreach ($empsData as $empData) {
            $empId = $empData['empId'];
            $updateDataValue = null;
            if (array_key_exists(mb_strtolower($empData['changeType']), $empData)) {
                $updateDataValue = $empData[mb_strtolower($empData['changeType'])];
            }
            $changeType = $empData['changeType'];
            if ($changeType == 'Name') {
                $changedValue = $employeeRepository->getArgValueById($empId, 'name');
            }
            if ($changeType == 'Address') {
                $changedValue = $employeeRepository->getArgValueById($empId, 'address');
            }
            if ($changeType == 'Hourly') {
                $changedValue = $employeeRepository->getArgValueById($empId, 'hourlyRate');
            }
            if ($changeType == 'Salaried') {
                $changedValue = $employeeRepository->getArgValueById($empId, 'monthlySalary');
            }
            if ($changeType == 'Commissioned') {
                $changedValue = $employeeRepository->getArgValueById($empId, 'commissionRate');
            }
            if ($changeType == 'Hold') {
                $updateDataValue = (app()->make(PaymentTypeRepository::class))->getArgValueByName($changeType, 'id');
                $changedValue = $employeeRepository->getArgValueById($empId, 'payment_type_id');
            }
            $this->assertEquals($updateDataValue, $changedValue);
        }

    }
}