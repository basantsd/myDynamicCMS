<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            ['name' => 'Header Menu', 'location' => 'header'],
            ['name' => 'Footer Menu', 'location' => 'footer'],
            ['name' => 'Mobile Menu', 'location' => 'mobile'],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
