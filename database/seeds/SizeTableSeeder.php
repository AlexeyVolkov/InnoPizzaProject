<?php

use Illuminate\Database\Seeder;

class SizeTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		factory(App\Size::class, 25)->create();
	}
}