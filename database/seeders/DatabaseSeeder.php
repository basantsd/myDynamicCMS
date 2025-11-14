<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            SettingSeeder::class,
            PageSeeder::class,      // Create pages first
            MenuSeeder::class,      // Then create menus with page references
            BannerSeeder::class,    // Create sample banners
            FormSeeder::class,      // Create sample forms
            TemplateSeeder::class,  // Create page templates
        ]);
    }
}
