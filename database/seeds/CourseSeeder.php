<?php

use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataArr = [
            ['name' => 'Introduction to Computer Science', 'term' => 1],
            ['name' => 'Game Development 101', 'term' => 2],
            ['name' => 'Frameworks 1', 'term' => 3],
            ['name' => 'Frameworks 2', 'term' => 4],
        ];

        foreach ($dataArr as $data)
            \App\Course::create($data);
    }
}
