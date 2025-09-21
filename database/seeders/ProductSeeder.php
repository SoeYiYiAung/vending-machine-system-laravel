<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            ['name' => 'Coke', 'price' => 1.50, 'stock' => 10],
            ['name' => 'Pepsi', 'price' => 1.40, 'stock' => 8],
            ['name' => 'Water', 'price' => 1.00, 'stock' => 15],
        ]);
    }

}
