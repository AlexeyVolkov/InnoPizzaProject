<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert([
            'name' => 'Cash'
        ]);
        DB::table('payments')->insert([
            'name' => 'Bank Card'
        ]);
        DB::table('payments')->insert([
            'name' => 'Coupons'
        ]);
        DB::table('payments')->insert([
            'name' => 'Credit'
        ]);
    }
}