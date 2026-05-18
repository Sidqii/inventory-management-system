<?php

namespace Database\Seeders;

use App\Models\Catalog\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            [
                'name' => 'Computer Equipment',
                'description' => 'Computer and related devices.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Network Equipment',
                'description' => 'Devices used for network infrastructure.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Safety Equipment',
                'description' => 'Equipment used for workspace safety.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
