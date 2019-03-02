<?php

use Faker\Generator as Faker;

$factory->define(\App\Survey::class, function (Faker $faker) {
    return [
        'title' => $faker->text,
        'is_published' => 0
    ];
});
