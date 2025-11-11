<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => env('ADMIN_EMAIL', 'admin@example.com'),
            'password' => Hash::make(env('ADMIN_PASSWORD', 'admin123')),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Assign admin role
        $adminRole = Role::where('name', 'admin')->first();
        $admin->roles()->attach($adminRole);
    }
}
