<?php


namespace Package\Salary\UseCase;

use Package\Salary\Model\TimeCard;

class TimeCardUseCase extends TemplateUseCase
{
    public function makeModel($timeCardData)
    {
        return new TimeCard($timeCardData[1], $timeCardData[2], $timeCardData[3]);
    }
}