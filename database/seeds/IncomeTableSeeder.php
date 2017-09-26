<?php

use Illuminate\Database\Seeder;

class IncomeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('income')->delete();
        DB::table('income')->insert(
            [
                [
                    'id' => 1,
                    'money' => 300000000,
                    'author_id' => 1
                ],
                [
                    'id' => 2,
                    'money' => 200000000,
                    'author_id' => 2
                ]
            ]
        );
    }
}
