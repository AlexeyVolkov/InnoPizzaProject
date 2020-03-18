<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
	return [
		'customer__id' => rand(1, 25),
		'pizza__id' => rand(1, 15),
		'date' => $faker->dateTime($max = 'now'),
	];
});