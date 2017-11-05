<?php


namespace Package\Salary\UseCase;

use Package\Salary\Model\TimeCardModel;

class TimeCardUseCase extends TemplateUseCase
{
    public function makeModel($timeCardData)
    {
        return new TimeCardModel($timeCardData[1], $timeCardData[2], $timeCardData[3]);
    }
}