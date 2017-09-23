<?php
/**
 * Created by PhpStorm.
 * User: unamu
 * Date: 17/09/14
 * Time: 23:03
 */

namespace Package\HowToUse\Domain;


class Car implements VehicleInterface
{
    public function run()
    {
        return 'ガソリンではしります';
    }
}