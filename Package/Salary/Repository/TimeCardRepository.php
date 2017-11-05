<?php


namespace Package\Salary\Repository;


use App\TimeCard;
use Package\Salary\Model\TimeCardModel;

class TimeCardRepository extends Repository
{
    protected $eloquent;

    public function __construct(TimeCard $timeCard)
    {
        $this->eloquent = $timeCard;
    }

    public function save(TimeCardModel $timeCardModel)
    {
        $this->setModelPropertyToEloquent($timeCardModel, $this->eloquent);
    }
}