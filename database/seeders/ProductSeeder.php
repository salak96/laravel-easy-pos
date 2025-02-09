<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 5; $i++) {
            Customer::create([
                'name' => $faker->word,
                'description' => $faker->sentence,
                'image' => '',
                'barcode' => $faker->unique()->ean13,  
                'regular_price' => $faker->randomFloat(2, 50, 200),
                'price' => $faker->randomFloat(2, 40, 190),
                'status' => true
            ]);
        }
    }
}
