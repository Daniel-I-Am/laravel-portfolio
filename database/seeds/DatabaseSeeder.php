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

        $this->call(CourseSeeder::class);
        $this->call(SubjectSeeder::class);
    }
}
