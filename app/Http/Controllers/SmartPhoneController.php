<?php


namespace App\Http\Controllers;

use Package\HowToUse\Domain\AuUseCase;
use Package\HowToUse\Domain\SoftBankUseCase;

class SmartPhoneController extends Controller
{
    public function au()
    {
        $auUseCase = app()->make(AuUseCase::class);

        return view('smartphone', ['massage' => $auUseCase->price()]);
    }

    public function umoblie()
    {
        $umoblieUseCase = app()->make(SoftBankUseCase::class);

        return view('smartphone', ['massage' => $umoblieUseCase->price()]);
    }

}