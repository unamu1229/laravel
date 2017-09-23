<?php
/**
 * Created by PhpStorm.
 * User: unamu
 * Date: 17/09/16
 * Time: 9:58
 */

namespace Package\HowToUse\Domain;


class Train implements VehicleInterface
{

    public function run()
    {
        return '電気ではしります';
    }
}