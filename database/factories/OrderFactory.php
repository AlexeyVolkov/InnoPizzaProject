<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'customer__id' => rand(1, 25),
        'open' => false,
        'payment' => rand(1, 2),
        'comments' => $faker->paragraph(),
    ];
});