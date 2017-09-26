<?php
/**
 * Created by PhpStorm.
 * User: unamu
 * Date: 17/09/15
 * Time: 23:47
 */

namespace Package\HowToUse\Domain\UseCase;

use Package\HowToUse\Domain\UseCase\VehicleInterface;

class DistantUsecase
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