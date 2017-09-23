<?php

use Illuminate\Database\Seeder;

class AuthorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('author')->delete();
        DB::table('author')->insert(
            [
                [
                    'id' => 1,
                    'name' => '尾田',
                    'active' => 1
                ],
                [
                    'id' => 2,
                    'name' => '富樫',
                    'active' => 0
                ]
            ]
        );
    }
}
