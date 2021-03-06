<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pizza;
use Faker\Generator as Faker;

$factory->define(Pizza::class, function (Faker $faker) {
    return [
        'name' => $faker->colorName,
        'img_url' => $faker->imageUrl($width = 640, $height = 480),
        'description' => $faker->paragraph,
        'price' => '1.0',
    ];
});