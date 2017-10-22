<?php


namespace Package\Salary\Service;


class Transaction
{
    public function getTransaction($transactionPath)
    {
        // ファイルのパスはコマンド打つディレクトリからのパス
        $transaction = file_get_contents($transactionPath, true);
        $rows = explode("\n", $transaction);
        $tmpData = [];
        foreach($rows as $row){
            $tmpData[] = explode(' ', $row);
        }

        return $tmpData;
    }
    public function checkAddEmpFormat($empsData)
    {
        foreach($empsData as $row => $empData){
            if($empData[4] == 'H' || $empData[4] == 'S'){
                $this->checkColumns($empData, 6);
            }
            if($empData[4] == 'C'){
                $this->checkColumns($empData, 7);
            }
            if(!in_array($empData[4],['H', 'S', 'C'])){
                throw new \Exception($row.'行の給与種別が存在しない物になっています。');
            }
        }
    }

    public function checkDelEmpFormat($delEmpsData)
    {
        $this->checkColumns($delEmpsData, 2);
    }

    public function checkTimeCardFormat($timeCardsData)
    {
        $this->checkColumns($timeCardsData, 3);
    }

    private function checkColumns($data, $expectColumns)
    {
        foreach ($data as $row => $columns) {
            if (count($columns) != $expectColumns) {
                throw new \Exception($row.'行目のカラムの数が異なります。');
            }
        }
    }
}