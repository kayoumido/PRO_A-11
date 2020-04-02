<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Presentation;
use Faker\Generator as Faker;

$factory->define(Presentation::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'date' => $faker->dateTime
    ];
});
