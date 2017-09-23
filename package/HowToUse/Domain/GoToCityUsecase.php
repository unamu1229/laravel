<?php
/**
 * Created by PhpStorm.
 * User: unamu
 * Date: 17/09/15
 * Time: 23:47
 */

namespace Package\HowToUse\Domain;


class GoToCityUsecase
{
    public $vehicle;

    public function setVehicle(VehicleInterface $vehicle)
    {
        $this->vehicle = $vehicle;
    }

    public function useVehicleRun()
    {
        return $this->vehicle->run();
    }
}