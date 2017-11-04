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
            $rowData = explode(' ', $row);
            if ($rowData[0] != 'ChgEmp') {
                $tmpData[] = $rowData;
                continue;
            }

            $rowDataHaveKey = [];
            $rowDataHaveKey['empId'] = $rowData[1];
            $rowDataHaveKey['changeType'] = $rowData[2];

            if ($rowDataHaveKey['changeType'] == 'Hold') {
                $tmpData[] = $rowDataHaveKey;
                continue;
            }

            $setValue = $rowData[3];
            if ($rowDataHaveKey['changeType'] == 'Commissioned') {
                $setValue = $rowData[4];
            }

            $rowDataHaveKey = $this->setRowDataKeyByValue($rowDataHaveKey, $rowDataHaveKey['changeType'], $setValue);

            if($rowDataHaveKey['changeType'] == 'Member') {
                $rowDataHaveKey['dues'] = $rowData[5];
            }

            if ($rowDataHaveKey['changeType'] == 'Direct') {
                $rowDataHaveKey['account'] = $rowData[4];
            }

            $tmpData[] = $rowDataHaveKey;
            continue;

        }

        return $tmpData;
    }

    private function setRowDataKeyByValue($rowData, $key, $value)
    {
        $rowData[mb_strtolower($key)] = $value;
        return $rowData;
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

    public function checkColumns($data, $expectColumns)
    {
        foreach ($data as $row => $columns) {
            if (count($columns) != $expectColumns) {
                throw new \Exception($row.'行目のカラムの数が異なります。');
            }
        }
    }
}