<?php

namespace Database\Seeders;

use App\Models\Inventory\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stock::insert([
            [
                'product_id' => 1,
                'warehouse_id' => 1,
                'quantity' => 10,
            ],
            [
                'product_id' => 2,
                'warehouse_id' => 1,
                'quantity' => 15,
            ],
            [
                'product_id' => 3,
                'warehouse_id' => 2,
                'quantity' => 8,
            ],
            [
                'product_id' => 4,
                'warehouse_id' => 2,
                'quantity' => 50,
            ],
            [
                'product_id' => 5,
                'warehouse_id' => 3,
                'quantity' => 5,
            ],
            [
                'product_id' => 6,
                'warehouse_id' => 3,
                'quantity' => 20,
            ],
        ]);
    }
}
