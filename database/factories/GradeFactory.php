<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Grade;
use Faker\Generator as Faker;

$factory->define(Grade::class, function (Faker $faker) {
    return [
        'subject_id' => \App\Subject::all('id')->random()->id,
        'grade' => $faker->randomNumber(3)/100,
    ];
});
