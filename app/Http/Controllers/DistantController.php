<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Package\HowToUse\Domain\UseCase\VehicleInterface;
use Package\HowToUse\Domain\UseCase\DistantUsecase;
use Package\HowToUse\Domain\UseCase\GoToCityUsecase;


class DistantController extends Controller
{

    public $vehicleInterface;

    public function __construct(VehicleInterface $vehicleInterface)
    {
        $this->vehicleInterface = $vehicleInterface;
    }

    public function index()
    {
        return view('distant', ['massage' => $this->vehicleInterface->run()]);
    }

    public function usecase()
    {
        $distantUsecase = app()->make(DistantUsecase::class);
        return view('distant', ['massage' => $distantUsecase->useVehicleRun()]);
    }

    public function goToCityUsecase()
    {
        $goToCityUsecase = app()->make(GoToCityUsecase::class);
        return view('distant', ['massage' => $goToCityUsecase->useVehicleRun()]);
    }
}
