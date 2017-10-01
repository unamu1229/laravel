<?php

namespace Tests\Salary;

use Package\Salary\Service\CheckTransaction;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddEmpTest extends TestCase
{

    public function testUseCase()
    {
        // ファイルのパスはコマンド打つディレクトリからのパス
        $transaction = file_get_contents('tests/Salary/Transaction/AddEmpIncorrectFormat', true);
        $rows = explode("\n", $transaction);
        $empsData = [];
        foreach($rows as $row){
            $empsData[] = explode(' ', $row);
        }
        $checkTransaction = new CheckTransaction();
        try {
            $checkTransaction->checkFormat($empsData);
        } catch (\Exception $e) {
            echo $e->getMessage();
            $this->assertTrue(true);
            return;
        }
        print_r($empsData);
        $this->assertTrue(true);
    }

    public function testCatchFatalError()
    {
        try {
            $this->notExistMethod();
        } catch  (\Error $e) {
            echo $e->getMessage();
            $this->assertTrue(true);
            return;
        }
    }
}
