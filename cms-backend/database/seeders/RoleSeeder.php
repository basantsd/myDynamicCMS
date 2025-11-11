<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'Full access to all CMS features',
            ],
            [
                'name' => 'editor',
                'display_name' => 'Editor',
                'description' => 'Can manage pages and content',
            ],
            [
                'name' => 'staff',
                'display_name' => 'Staff',
                'description' => 'Limited access to view content',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
