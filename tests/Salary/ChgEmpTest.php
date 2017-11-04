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
            elseif ($changeType == 'Address') {
                $changedValue = $employeeRepository->getArgValueById($empId, 'address');
            }
            elseif ($changeType == 'Hourly') {
                $changedValue = $employeeRepository->getArgValueById($empId, 'hourlyRate');
            }
            elseif ($changeType == 'Salaried') {
                $changedValue = $employeeRepository->getArgValueById($empId, 'monthlySalary');
            }
            elseif ($changeType == 'Commissioned') {
                $changedValue = $employeeRepository->getArgValueById($empId, 'commissionRate');
            }
            elseif ($changeType == 'Hold') {
                $updateDataValue = (app()->make(PaymentTypeRepository::class))->getArgValueByName($changeType, 'id');
                $changedValue = $employeeRepository->getArgValueById($empId, 'payment_type_id');
            }
            elseif ($changeType == 'Direct') {
                $changedValue = $employeeRepository->getArgValueById($empId, 'bank');
            }
            elseif ($changeType == 'Mail') {
                $changedValue = $employeeRepository->getArgValueById($empId, 'check_send_address');
            }
            elseif ($changeType == 'Member') {
                $changedValue = $employeeRepository->getArgValueById($empId, 'service_charge_id');
            }
            elseif ($changeType == 'NoMember') {
                $changedValue = $employeeRepository->getArgValueById($empId, 'service_charge_id');
            }

            $this->assertEquals($updateDataValue, $changedValue);
        }

    }
}