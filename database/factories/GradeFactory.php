<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Grade;
use Faker\Generator as Faker;

$factory->define(Grade::class, function (Faker $faker) {
    $object =  [
        'subject_id' => \App\Subject::all('id')->random()->id,
        'grade' => $faker->randomNumber(3)/100,
        'lowest_passing' => $faker->randomNumber(3)/200,
    ];
    if ($object['grade'] < 1)
        $object['grade'] = null;
    if ($object['lowest_passing'] < 1)
        $object['lowest_passing'] = null;
    return $object;
});
