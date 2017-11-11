<?php


namespace Package\Salary\Repository;


use App\ServiceCharge;
use Package\Salary\Model\ServiceModel;

class ServiceChargeRepository extends Repository
{
    private $serviceCharge;

    public function __construct(ServiceCharge $serviceCharge)
    {
        $this->serviceCharge = $serviceCharge;
    }

    public function save(ServiceModel $serviceModel)
    {
        $this->setModelPropertyToEloquent($serviceModel, $this->serviceCharge);
    }

    public function delete(ServiceModel $serviceModel)
    {
        $this->serviceCharge->where('id', $serviceModel->getMemberId())->delete();
    }
}