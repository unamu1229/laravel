<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Package\HowToUse\Domain\VehicleInterface;

class DistantController extends Controller
{

    public $vehicleInterface;

    public function __construct(VehicleInterface $vehicleInterface)
    {
        $this->vehicleInterface = $vehicleInterface;
    }

    public function index(){
        return view('distant', ['massage' => $this->vehicleInterface->run()]);
    }
}
