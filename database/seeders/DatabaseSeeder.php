<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'first_name' => 'Mr',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com',
            'phone' => '01710101010',
            'password' => Hash::make('password'),
            'role' => Role::ADMIN->toString(),
            'is_deletable' => false,
        ]);

        // User
        User::create([
            'first_name' => 'Mr',
            'last_name' => 'User',
            'email' => 'users@users.com',
            'phone' => '01720101010',
            'password' => Hash::make('password'),
            'role' => Role::User->toString(),
            'is_deletable' => true,
        ]);
    }
}
