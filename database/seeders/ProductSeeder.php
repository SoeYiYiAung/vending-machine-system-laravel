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
            ['name' => 'Coke', 'price' => 1.50, 'quantity_available' => 10],
            ['name' => 'Pepsi', 'price' => 1.40, 'quantity_available' => 8],
            ['name' => 'Water', 'price' => 1.00, 'quantity_available' => 15],
        ]);
    }

}
