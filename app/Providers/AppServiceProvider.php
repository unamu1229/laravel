<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Package\HowToUse\Domain\Bicycle;
use Package\HowToUse\Domain\Car;
use App\Http\Controllers\DistantController;
use Package\HowToUse\Domain\VehicleInterface;
use App\Http\Controllers\NearController;

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
    }
}
