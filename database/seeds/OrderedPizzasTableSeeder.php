<?php

use Illuminate\Database\Seeder;

class OrderedPizzasTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		factory(App\OrderedPizza::class, 15)->create();
	}
}