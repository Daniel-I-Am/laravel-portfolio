<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Grade::truncate();
        \App\Subject::truncate();
        \App\Course::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        factory(\App\Course::class, 10)->create();
        factory(\App\Subject::class, 25)->create();
        factory(\App\Grade::class, 50)->create();
    }
}
