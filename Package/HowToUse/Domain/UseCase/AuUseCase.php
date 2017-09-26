<?php

namespace Package\HowToUse\Domain\UseCase;

use Package\HowToUse\Domain\UseCase\KakuyasuSimInterface;

class AuUseCase
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
