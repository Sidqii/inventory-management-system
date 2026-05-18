<?php

namespace Database\Seeders;

use App\Models\Catalog\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Warehouse::insert([
            [
                'code' => 'WH-IT',
                'name' => 'IT Warehouse',
                'location' => 'Head Office',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'WH-NET',
                'name' => 'Network Warehouse',
                'location' => 'Head Office',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'WH-SAF',
                'name' => 'Safety Warehouse',
                'location' => 'Head Office',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
