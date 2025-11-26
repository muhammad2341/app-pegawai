<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class EmployeeUserSeeder extends Seeder
{
    /**
     * Seed user accounts for existing employees
     */
    public function run(): void
    {
        // Ambil semua employee yang belum punya user account
        $employees = Employee::all();

        foreach ($employees as $employee) {
            // Cek apakah employee sudah punya user
            $existingUser = User::where('employee_id', $employee->id)->first();
            
            if (!$existingUser) {
                User::create([
                    'name' => $employee->nama_lengkap,
                    'email' => $employee->email,
                    'password' => Hash::make('password123'), // Password default
                    'role' => 'karyawan',
                    'employee_id' => $employee->id,
                ]);
            }
        }

        $this->command->info('User accounts created for all employees!');
    }
}
