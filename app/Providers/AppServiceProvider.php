<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Package\HowToUse\Domain\Bicycle;
use Package\HowToUse\Domain\Car;
use App\Http\Controllers\DistantController;
use Package\HowToUse\Domain\DistantUsecase;
use Package\HowToUse\Domain\NearUsecase;
use Package\HowToUse\Domain\VehicleInterface;
use App\Http\Controllers\NearController;
use Package\HowToUse\Domain\GoToCityUsecase;
use Package\HowToUse\Domain\Train;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->when(DistantController::class)
            ->needs(VehicleInterface::class)
            ->give(function(){
                return new Car();
            });

        $this->app->when(NearController::class)
            ->needs(VehicleInterface::class)
            ->give(function(){
                return new Bicycle();
            });



        $this->app->when(DistantUsecase::class)
            ->needs(VehicleInterface::class)
            ->give(function(){
                return new Car();
            });

        $this->app->when(NearUsecase::class)
            ->needs(VehicleInterface::class)
            ->give(function(){
                return new Bicycle();
            });



        $this->app->resolving(GoToCityUsecase::class, function($goToCityUsecase){
            $goToCityUsecase->setVehicle(new Train());
            return $goToCityUsecase;
        });
    }
}
