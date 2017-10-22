<?php


namespace Package\Salary\UseCase;


use Package\Salary\Model\ServiceCharge;

class ServiceChargeUseCase extends TemplateUseCase
{
    public function makeModel($servicesChargeData)
    {
        return new ServiceCharge($servicesChargeData[1], $servicesChargeData[2]);
    }
}