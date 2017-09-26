<?php

use Illuminate\Database\Seeder;

class AssistantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assistant')->delete();
        DB::table('assistant')->insert(
            [
                [
                    'id' => 1,
                    'name' => '田中',
                    'author_id' => 1
                ],
                [
                    'id' => 2,
                    'name' => '鈴木',
                    'author_id' => 1
                ],
                [
                    'id' => 3,
                    'name' => '斎藤',
                    'author_id' => 1
                ],
                [
                    'id' => 4,
                    'name' => '西田',
                    'author_id' => 1
                ],
                [
                    'id' => 5,
                    'name' => '香月',
                    'author_id' => 2
                ]
            ]
        );
    }
}
