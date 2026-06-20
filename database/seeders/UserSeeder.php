<?php

namespace Database\Seeders;

use App\Enum\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Racoon',
            'role' => Role::ADMIN,
            'email' => 'racoon@mail.com',
            'password' => 'racoon123',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Emma',
            'role' => Role::STAFF,
            'email' => 'emma@mail.com',
            'password' => 'emma123',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Pororo',
            'role' => Role::EMPLOYEE,
            'email' => 'pororo@mail.com',
            'password' => 'pororo123',
            'email_verified_at' => now(),
        ]);
    }
}
