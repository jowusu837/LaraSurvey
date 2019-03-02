<?php

use App\Survey;
use Faker\Generator as Faker;

$factory->define(Survey::class, function (Faker $faker) {
    return [
        'title' => $faker->text,
//        'is_published' => 0,
    ];
});
