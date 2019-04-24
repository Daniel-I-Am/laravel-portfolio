<?php

use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataArr = [
            ['name' => 'Studieloopbaan Oriëntatie', 'ec_value' => 2.5, 'course_id' => 1, 'grades' => [8.5]],
            ['name' => 'Computer Science Basics', 'ec_value' => 7.5, 'course_id' => 1, 'grades' => [8.8]],
            ['name' => 'Programming Basics', 'ec_value' => 5, 'course_id' => 1, 'grades' => [10]],
            ['name' => 'Object Oriented Programming 101', 'ec_value' => 5, 'course_id' => 2, 'grades' => [9.8]],
            ['name' => 'OOP Project', 'ec_value' => 5, 'course_id' => 2, 'grades' => [7.8]],
            ['name' => 'Professional Skills 1', 'ec_value' => 2.5, 'course_id' => 2, 'grades' => [6.0, 7.5, 8.0 , 7.2]],
            ['name' => 'HZ-Personality', 'ec_value' => 2.5, 'course_id' => 2, 'grades' => [null]],
            ['name' => 'Professional Skills 2', 'ec_value' => 2.5, 'course_id' => 3, 'grades' => [7.7, null]],
            ['name' => 'Professionele werkplek', 'ec_value' => 2.5, 'course_id' => 3, 'grades' => [10]],
            ['name' => 'Framework Development 1', 'ec_value' => 5, 'course_id' => 3, 'grades' => [10]],
            ['name' => 'Framework Project 1', 'ec_value' => 5, 'course_id' => 3, 'grades' => [8.7, 7.4]],
            ['name' => 'Professional Skills 3', 'ec_value' => 2.5, 'course_id' => 4, 'grades' => [null, null]],
            ['name' => 'IT Personality 2a', 'ec_value' => 2.5, 'course_id' => 4, 'grades' => [null]],
            ['name' => 'Framework development 2', 'ec_value' => 5, 'course_id' => 4, 'grades' => [null, null]],
            ['name' => 'Framework Project 2', 'ec_value' => 5, 'course_id' => 4, 'grades' => [null]],
        ];

        foreach ($dataArr as $data) {
            $subject = \App\Subject::create([
                'name' => $data['name'],
                'ec_value' => $data['ec_value'],
                'course_id' => $data['course_id'],
            ]);
            foreach($data['grades'] as $grade)
                \App\Grade::create([
                    'subject_id' => $subject->id,
                    'grade' => $grade,
                ]);
        }
    }
}
