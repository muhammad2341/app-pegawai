<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan admin dengan email yang diminta ada; jika sudah ada, perbarui password & role.
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Utama',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
            ]
        );
    }
}
