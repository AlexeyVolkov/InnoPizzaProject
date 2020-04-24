<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('deliveries')->insert([
            'name' => 'Shipping'
        ]);
        DB::table('deliveries')->insert([
            'name' => 'Take away'
        ]);
    }
}