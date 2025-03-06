<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'id_director' => null,
            'id_area' => null,
            'vacaciones' => 0,
            'permisos' => 0,
            'asistencia' => null,
        ]);
    }
}
