<?php

use Illuminate\Database\Seeder;

class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('book')->delete();
        DB::table('book')->insert(
            [
                [
                    'name' => 'ワンピース',
                    'author_id' => '1'
                ],
                [
                    'name' => 'ハンターハンター',
                    'author_id' => '2'
                ]
            ]
        );
    }
}
