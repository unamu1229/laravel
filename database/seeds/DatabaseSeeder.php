<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BookTableSeeder::class);
        $this->call(AuthorTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
