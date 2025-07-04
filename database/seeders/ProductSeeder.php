<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Pecel Lele',
                'description' => 'Lele goreng dengan sambal pecel dan lalapan segar.',
                'image' => 'pecel-lele.jpg',
                'quantity' => 30,
                'barcode' => '8991234567001',
                'regular_price' => 18000,
                'price' => 15000,
                'status' => true,
            ],
            [
                'name' => 'Pecel Ayam',
                'description' => 'Ayam goreng disajikan dengan sambal pecel khas Jawa Timur.',
                'image' => 'pecel-ayam.jpg',
                'quantity' => 25,
                'barcode' => '8991234567002',
                'regular_price' => 19000,
                'price' => 16000,
                'status' => true,
            ],
            [
                'name' => 'Nasi Pecel',
                'description' => 'Sayuran rebus disiram sambal kacang, disajikan dengan nasi.',
                'image' => 'nasi-pecel.jpg',
                'quantity' => 40,
                'barcode' => '8991234567003',
                'regular_price' => 15000,
                'price' => 13000,
                'status' => true,
            ],
            [
                'name' => 'Pecel Tempe Tahu',
                'description' => 'Tempe dan tahu goreng dengan sambal pecel pedas.',
                'image' => 'pecel-tempe-tahu.jpg',
                'quantity' => 35,
                'barcode' => '8991234567004',
                'regular_price' => 17000,
                'price' => 14000,
                'status' => true,
            ],
            [
                'name' => 'Pecel Komplit',
                'description' => 'Pecel lengkap dengan ayam, tempe, tahu, dan kerupuk.',
                'image' => 'pecel-komplit.jpg',
                'quantity' => 20,
                'barcode' => '8991234567005',
                'regular_price' => 22000,
                'price' => 20000,
                'status' => true,
            ],
        ];

        foreach ($products as $data) {
            Product::create($data);
        }
    }
}
