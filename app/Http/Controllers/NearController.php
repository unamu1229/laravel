<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Package\HowToUse\Domain\VehicleInterface;

class NearController extends Controller
{
    public $vehicleInterface;

    public function __construct(VehicleInterface $vehicleInterface){
        $this->vehicleInterface = $vehicleInterface;
    }
    public function index(){
        return view('near', ['massage' => $this->vehicleInterface->run()]);
    }
}
