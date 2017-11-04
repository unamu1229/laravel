<?php


namespace Package\Salary\Repository;


use App\ServiceCharge;
use Package\Salary\Model\ServiceModel;

class ServiceChargeRepository
{
    private $serviceCharge;

    public function __construct(ServiceCharge $serviceCharge)
    {
        $this->serviceCharge = $serviceCharge;
    }

    public function save(ServiceModel $serviceModel)
    {
        $this->serviceCharge->id = $serviceModel->getMemberId();
        $this->serviceCharge->amount = $serviceModel->getAmount();
        $this->serviceCharge->save();
    }

    public function delete(ServiceModel $serviceModel)
    {
        $this->serviceCharge->where('id', $serviceModel->getMemberId())->delete();
    }
}