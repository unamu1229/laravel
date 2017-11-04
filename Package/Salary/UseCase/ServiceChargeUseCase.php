<?php


namespace Package\Salary\UseCase;


use Package\Salary\Model\ServiceModel;

class ServiceChargeUseCase extends TemplateUseCase
{
    public function makeModel($servicesChargeData)
    {
        return new ServiceModel($servicesChargeData[1], $servicesChargeData[2]);
    }
}