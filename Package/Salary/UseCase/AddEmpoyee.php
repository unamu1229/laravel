<?php


namespace Package\Salary\UseCase;
use Package\Salary\Service\CheckTransaction;
use Package\Salary\Service\Factory;

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

        $employees = Factory::makeEmp($empsData);

        return $employees;
    }
}