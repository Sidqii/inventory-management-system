<?php

namespace Database\Seeders;

use App\Models\Catalog\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            [
                'sku' => 'PC-001',
                'name' => 'Desktop Computer',
                'category_id' => 1,
                'unit_id' => 1,
                'description' => 'Standard office desktop computer.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sku' => 'PC-002',
                'name' => 'Laptop',
                'category_id' => 1,
                'unit_id' => 1,
                'description' => 'Portable computer for office use.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sku' => 'NET-001',
                'name' => 'Router',
                'category_id' => 2,
                'unit_id' => 1,
                'description' => 'Network routing device.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sku' => 'NET-002',
                'name' => 'UTP Cable',
                'category_id' => 2,
                'unit_id' => 2,
                'description' => 'Network cable for data transmission.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sku' => 'SAFE-001',
                'name' => 'Fire Extinguisher',
                'category_id' => 3,
                'unit_id' => 1,
                'description' => 'Portable fire suppression equipment.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sku' => 'SAFE-002',
                'name' => 'First Aid Kit',
                'category_id' => 3,
                'unit_id' => 4,
                'description' => 'Basic emergency medical supplies.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
