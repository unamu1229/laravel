<?php
/**
 * Created by PhpStorm.
 * User: unamu
 * Date: 17/09/14
 * Time: 23:05
 */

namespace Package\HowToUse\Domain\Model;

use Package\HowToUse\Domain\UseCase\VehicleInterface;

class Bicycle implements VehicleInterface
{

    public function run()
    {
        return '人力ではしります';
    }
}