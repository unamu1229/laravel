<?php


namespace Package\Salary\Service;


class CheckTransaction
{
    public function checkFormat($empsData)
    {
        foreach($empsData as $row => $empData){
            if($empData[4] == 'H' || $empData[4] == 'S'){
                if(count($empData) != 6){
                    throw new \Exception($row.'行のカラムの数が異なります。');
                }
            }
            if($empData[4] == 'C'){
                if(count($empData) != 7){
                    throw new \Exception($row.'行のカラムの数が異なります。');
                }
            }
            if(!in_array($empData[4],['H', 'S', 'C'])){
                throw new \Exception($row.'行の給与種別が存在しない物になっています。');
            }
        }
    }
}