<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\OrderedPizza;
use Faker\Generator as Faker;

$factory->define(OrderedPizza::class, function (Faker $faker) {
	return [
		'order__id' => rand(1, 15),
		'pizza__id' => rand(1, 15),
	];
});