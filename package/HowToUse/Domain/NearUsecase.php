<?php
/**
 * Created by PhpStorm.
 * User: unamu
 * Date: 17/09/15
 * Time: 23:46
 */

namespace Package\HowToUse\Domain;


class NearUsecase
{
    public $vehicleInterface;

    public function __construct(VehicleInterface $vehicleInterface)
    {
        $this->vehicleInterface = $vehicleInterface;
    }

    public function useVehicleRun()
    {
        return $this->vehicleInterface->run();
    }
}