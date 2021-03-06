<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Package\HowToUse\Domain\UseCase\InstantNoodleInterface;
use Package\HowToUse\Domain\Model\Nitsushin;

class EatServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(InstantNoodleInterface::class, Nitsushin::class);
    }
}
