<?php

namespace Package\HowToUse\Domain;


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
