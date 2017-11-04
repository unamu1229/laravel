<?php

namespace Tests\Salary;

use Package\Salary\Model\ServiceModel;
use Package\Salary\Repository\EmployeeRepository;
use Package\Salary\Repository\ServiceChargeRepository;
use Package\Salary\Service\Transaction;
use Package\Salary\UseCase\ServiceChargeUseCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceChargeTest extends TestCase
{
    public function testServiceConstruct()
    {
        $transaction = new Transaction();
        $serviceChargesData = $transaction->getTransaction('/var/www/html/laravel/tests/Salary/Transaction/ServiceCharge');
        $serviceChargeUseCase = new ServiceChargeUseCase();
        $serviceCharges = $serviceChargeUseCase->add($serviceChargesData);
        $serviceChargeRepository = $this->app->make(ServiceChargeRepository::class);
        foreach ($serviceCharges as $serviceCharge) {
            $serviceChargeRepository->delete($serviceCharge);
            $serviceChargeRepository->save($serviceCharge);
        }
        $this->assertEquals($serviceCharges[0]->getAmount(), 300);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage 存在しない組合員です。
     */
    public function testNotExitMember()
    {
        $transaction = new Transaction();
        $serviceChargesData = $transaction->getTransaction('/var/www/html/laravel/tests/Salary/Transaction/ServiceChargeNotExit');
        $serviceChargeUseCase = new ServiceChargeUseCase();
        $tmpServiceCharge = $serviceChargeUseCase->add($serviceChargesData);
    }
}
