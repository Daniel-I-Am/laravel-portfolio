<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Subject;
use Faker\Generator as Faker;

$factory->define(Subject::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'ec_value' => $faker->randomNumber(3)/100,
        'course_id' => \App\Course::all('id')->random()->id,
    ];
});
