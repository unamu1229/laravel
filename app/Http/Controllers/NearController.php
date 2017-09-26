<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Package\HowToUse\Domain\UseCase\VehicleInterface;
use Package\HowToUse\Domain\UseCase\NearUsecase;

class NearController extends Controller
{
    public $vehicleInterface;

    public function __construct(VehicleInterface $vehicleInterface){
        $this->vehicleInterface = $vehicleInterface;
    }

    public function index()
    {
        return view('near', ['massage' => $this->vehicleInterface->run()]);
    }

    public function usecase()
    {
        $nearUsecase = app()->make(NearUsecase::class);
        return view('near', ['massage' => $nearUsecase->useVehicleRun()]);
    }

}
