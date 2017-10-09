<?php


namespace Package\Salary\UseCase;
use Package\Salary\Salary\EmpHourly;
use Package\Salary\Salary\EmpMonthly;
use Package\Salary\Salary\EmpMonthlyCommission;
use Package\Salary\Service\CheckTransaction;

class AddEmpoyee
{
    public function exec($transactionPath)
    {
        // ファイルのパスはコマンド打つディレクトリからのパス
        $transaction = file_get_contents($transactionPath, true);
        $rows = explode("\n", $transaction);
        $empsData = [];
        foreach($rows as $row){
            $empsData[] = explode(' ', $row);
        }
        $checkTransaction = new CheckTransaction();
        try {
            $checkTransaction->checkFormat($empsData);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        $empHourly = new EmpHourly();
        $empMonthly = new EmpMonthly();
        $empMonthlyCommission = new EmpMonthlyCommission();

        return[$empHourly, $empMonthly, $empMonthlyCommission];
    }
}