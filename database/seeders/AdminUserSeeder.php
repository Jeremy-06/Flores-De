<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'admin@flowershop.com',
        ], [
            'name' => 'Admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        User::updateOrCreate([
            'email' => 'customer@flowershop.com',
        ], [
            'name' => 'Customer',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // Additional test customers
        User::create([
            'name' => 'Maria Santos',
            'email' => 'maria@test.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Juan Dela Cruz',
            'email' => 'juan@test.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Ana Reyes',
            'email' => 'ana@test.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
    }
}