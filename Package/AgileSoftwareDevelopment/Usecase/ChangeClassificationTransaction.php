<?php


namespace Package\AgileSoftwareDevelopment\Usecase;


abstract class ChangeClassificationTransaction extends ChangeEmployeeTransaction
{
    public function change($e)
    {
        $e->setClassification($this->getClassification());
        $e->setSchedule($this->getSchedule());
    }

    abstract protected function getClassification();
    abstract protected function getSchedule();
}