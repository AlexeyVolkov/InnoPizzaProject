<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		// $this->call(UsersTableSeeder::class);
		$this->call(SizesTableSeeder::class);
		$this->call(CustomersTableSeeder::class);
		$this->call(PizzasTableSeeder::class);
		$this->call(OrdersTableSeeder::class);
		$this->call(OrderedPizzasTableSeeder::class);
	}
}