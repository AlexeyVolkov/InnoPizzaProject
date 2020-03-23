<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Size;
use Faker\Generator as Faker;

$factory->define(Size::class, function (Faker $faker) {
    return [
        'name' => $faker->numberBetween(15, 35),
        'weight' => $faker->randomFloat(null, 1.0, 3.0),
    ];
});