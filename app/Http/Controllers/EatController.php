<?php


namespace app\Http\Controllers;

use Package\HowToUse\Domain\Nitsushin;
use Package\HowToUse\Domain\InstantNoodleInterface;

class EatController
{
    public function getItemName()
    {
        $instantNoodle = app()->makeWith(InstantNoodleInterface::class, ['type' => 'うどん']);

        return view('eat', ['massage' => $instantNoodle->name()]);
    }

}