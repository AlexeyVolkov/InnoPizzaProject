<?php

use Illuminate\Database\Seeder;

class SizesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		factory(App\Size::class, 8)->create();
	}
}