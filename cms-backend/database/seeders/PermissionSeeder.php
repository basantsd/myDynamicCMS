<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Pages
            ['name' => 'pages.view', 'display_name' => 'View Pages', 'group' => 'pages'],
            ['name' => 'pages.create', 'display_name' => 'Create Pages', 'group' => 'pages'],
            ['name' => 'pages.edit', 'display_name' => 'Edit Pages', 'group' => 'pages'],
            ['name' => 'pages.delete', 'display_name' => 'Delete Pages', 'group' => 'pages'],

            // Menus
            ['name' => 'menus.view', 'display_name' => 'View Menus', 'group' => 'menus'],
            ['name' => 'menus.manage', 'display_name' => 'Manage Menus', 'group' => 'menus'],

            // Media
            ['name' => 'media.view', 'display_name' => 'View Media', 'group' => 'media'],
            ['name' => 'media.upload', 'display_name' => 'Upload Media', 'group' => 'media'],
            ['name' => 'media.delete', 'display_name' => 'Delete Media', 'group' => 'media'],

            // Settings
            ['name' => 'settings.view', 'display_name' => 'View Settings', 'group' => 'settings'],
            ['name' => 'settings.edit', 'display_name' => 'Edit Settings', 'group' => 'settings'],

            // Users
            ['name' => 'users.view', 'display_name' => 'View Users', 'group' => 'users'],
            ['name' => 'users.create', 'display_name' => 'Create Users', 'group' => 'users'],
            ['name' => 'users.edit', 'display_name' => 'Edit Users', 'group' => 'users'],
            ['name' => 'users.delete', 'display_name' => 'Delete Users', 'group' => 'users'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // Assign all permissions to admin role
        $adminRole = Role::where('name', 'admin')->first();
        $adminRole->permissions()->attach(Permission::all());

        // Assign limited permissions to editor role
        $editorRole = Role::where('name', 'editor')->first();
        $editorPermissions = Permission::whereIn('group', ['pages', 'media', 'menus'])->get();
        $editorRole->permissions()->attach($editorPermissions);

        // Assign view-only permissions to staff role
        $staffRole = Role::where('name', 'staff')->first();
        $staffPermissions = Permission::where('name', 'like', '%.view')->get();
        $staffRole->permissions()->attach($staffPermissions);
    }
}
