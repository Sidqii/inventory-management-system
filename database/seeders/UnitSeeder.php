<?php

namespace Database\Seeders;

use App\Models\Catalog\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Unit::insert([
            [
                'name' => 'Unit',
                'symbol' => 'pcs',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Meter',
                'symbol' => 'm',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Roll',
                'symbol' => 'roll',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Set',
                'symbol' => 'set',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Box',
                'symbol' => 'box',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
