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
                'payment_type' => 'Hold'
            ],
            [
                'id' => 2,
                'payment_type' => 'Direct'
            ],
            [
                'id' => 3,
                'payment_type' => 'Mail'
            ]
        ]);
    }
}
