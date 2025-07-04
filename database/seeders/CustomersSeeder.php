<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CustomersSeeder extends Seeder
{
    public function run(): void
    {
        // Gunakan locale Indonesia
        $faker = Faker::create('id_ID');

        foreach (range(1, 10) as $index) {
            Customer::create([
                'first_name' => $faker->firstName,
                'last_name'  => $faker->lastName,
                'email'      => $faker->unique()->safeEmail,
                'phone'      => $faker->phoneNumber,
                'address'    => $faker->address,
                'avatar'     => '', // kosongkan dulu, nanti bisa isi dengan upload
            ]);
        }
    }
}
