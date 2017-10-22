<?php

namespace Tests\Salary;

use Package\Salary\Model\ServiceCharge;
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
        $tmpServiceCharge = $serviceChargeUseCase->add($serviceChargesData);
        $this->assertEquals($tmpServiceCharge[0]->getAmount(), 300);
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
