<?php

namespace Tests\Salary;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddEmpTest extends TestCase
{

    public function testUseCase()
    {
        // ファイルのパスはコマンド打つディレクトリからのパス
        $transaction = file_get_contents('tests/Salary/Transaction/AddEmp', true);
        $rows = explode("\n", $transaction);
        $empData = [];
        foreach($rows as $row){
            $empData[] = explode(' ', $row);
        }
        print_r($empData);
        $this->assertTrue(true);
    }
}
