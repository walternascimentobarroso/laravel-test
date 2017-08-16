<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product')->insert([
            'name' => str_random(10),
            'description' => str_random(20),
            'quantity' => str_random(3),
            'price' => 4.2,
        ]);
    }
}
