<?php
/**
 * Created by PhpStorm.
 * User: unamu
 * Date: 17/09/14
 * Time: 23:05
 */

namespace Package\HowToUse\Domain;


class Bicycle implements VehicleInterface
{

    public function run()
    {
        return '人力ではしります';
    }
}