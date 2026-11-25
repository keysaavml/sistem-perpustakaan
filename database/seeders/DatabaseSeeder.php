<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@perpus.test'],
            ['name' => 'Admin', 'password' => Hash::make('password123'), 'role' => 'admin']
        );

        User::firstOrCreate(
            ['email' => 'petugas@perpus.test'],
            ['name' => 'Petugas', 'password' => Hash::make('password123'), 'role' => 'petugas']
        );
    }
}