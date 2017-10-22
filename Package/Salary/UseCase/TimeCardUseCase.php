<?php


namespace Package\Salary\UseCase;

use Package\Salary\Model\TimeCard;

class TimeCardUseCase
{
    public function add($timeCardsData)
    {
        $tmpTimeCards = [];
        foreach ($timeCardsData as $timeCard) {
            $tmpTimeCards[] = new TimeCard($timeCard[1], $timeCard[2], $timeCard[3]);
        }

        return $tmpTimeCards;
    }
}