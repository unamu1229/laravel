<?php

namespace App\Providers;

use App\Http\Controllers\SmartPhoneController;
use Illuminate\Support\ServiceProvider;
use Package\HowToUse\Domain\UseCase\AuUseCase;
use Package\HowToUse\Domain\UseCase\KakuyasuSimInterface;
use Package\HowToUse\Domain\Model\Mineo;
use Package\HowToUse\Domain\UseCase\SoftBankUseCase;
use Package\HowToUse\Domain\Model\Storage;
use Package\HowToUse\Domain\Model\Umoblile;

class SmartPhoneServiceProvider extends ServiceProvider
{

    //const STORAGE_TO_SOFTBANK = "1GB";

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

        $this->app->when(AuUseCase::class)
            ->needs(KakuyasuSimInterface::class)
            ->give(function($app){
                /*
                return new Mineo(
                    // 公式サイトで載っている use を使わない書き方
                    // $app->make('Package\HowToUse\Domain\Storage')
                     $app->make(Storage::class)
                    );
                */
                return $app->make(Mineo::class);
            });

        $this->app->when(SoftBankUseCase::class)
            ->needs(KakuyasuSimInterface::class)
            ->give(function($app){
                return $app->makeWith(Umoblile::class, ['conditions' => 'ネットワーク通信量', 'area' => '関西エリア']);

                //return new Umoblile(self::STORAGE_TO_SOFTBANK);
            });

    }
}
