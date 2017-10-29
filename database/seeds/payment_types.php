<?php

use Illuminate\Database\Seeder;

class payment_types extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('payment_types')->insert([
            [
                'id' => 1,
                'name' => 'Hold'
            ],
            [
                'id' => 2,
                'name' => 'Direct'
            ],
            [
                'id' => 3,
                'name' => 'Mail'
            ]
        ]);
    }
}
