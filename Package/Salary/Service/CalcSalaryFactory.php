<?php


namespace Package\Salary\Service;


use Package\Salary\Model\CalcCommissionSalaryModel;
use Package\Salary\Model\CalcHourlySalaryModel;
use Package\Salary\Model\CalcMonthlySalaryModel;
use Package\Salary\Repository\SalesReceiptRepository;

class CalcSalaryFactory
{
    function makeCalcSalary($emp, $serviceChargeDue)
    {
        if ($emp->payDay == 'every_friday') {
            return new CalcHourlySalaryModel($emp, $serviceChargeDue);
        }

        if ($emp->payDay == 'biweekly_friday') {
            $salesReceipt = app()->make(SalesReceiptRepository::class);
            return new CalcCommissionSalaryModel($emp->commissionRate, $salesReceipt->getAllWhereColumnValue('empId', $emp->empId), $serviceChargeDue);
        }

        if ($emp->payDay == 'end_month') {
            return new CalcMonthlySalaryModel($emp->monthlySalary, $serviceChargeDue);
        }

        return null;
    }
}