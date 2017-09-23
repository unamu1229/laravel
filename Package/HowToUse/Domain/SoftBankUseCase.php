<?php

namespace Package\HowToUse\Domain;


class SoftBankUseCase
{

    private $kakuyasuSim;

    public function __construct(KakuyasuSimInterface $kakuyasuSim)
    {
        $this->kakuyasuSim = $kakuyasuSim;
    }

    public function price()
    {
        return $this->kakuyasuSim->price();
    }
}
