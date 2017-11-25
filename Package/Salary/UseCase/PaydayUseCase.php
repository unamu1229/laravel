<?php


namespace Package\Salary\UseCase;


use Package\Salary\Model\CalcSalaryInterface;

class PaydayUseCase
{
    public function execCalcSalary(CalcSalaryInterface $calcSalaryInterface)
    {
        return $calcSalaryInterface->calcSalary();
    }
}