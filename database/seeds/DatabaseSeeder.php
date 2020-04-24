<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CustomerSeeder::class,
            PaymentSeeder::class,
            DeliverySeeder::class,
            SizeSeeder::class,
            ToppingSeeder::class
        ]);
    }
}