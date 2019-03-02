<?php

use Faker\Generator as Faker;

$factory->define(\App\Question::class, function (Faker $faker) {
    return [
        'question' => $faker->text,
        'options' => $faker->words,
        'type' => $faker->word
    ];
});
