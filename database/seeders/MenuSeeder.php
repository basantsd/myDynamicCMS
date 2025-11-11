<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // Create Menus
        $headerMenu = Menu::create([
            'name' => 'Header Menu',
            'location' => 'header',
            'description' => 'Main navigation menu',
        ]);

        $footerMenu = Menu::create([
            'name' => 'Footer Menu',
            'location' => 'footer',
            'description' => 'Footer navigation links',
        ]);

        $mobileMenu = Menu::create([
            'name' => 'Mobile Menu',
            'location' => 'mobile',
            'description' => 'Mobile navigation menu',
        ]);

        // Get pages
        $pages = Page::all()->keyBy('slug');

        // Header Menu Items
        $headerItems = [
            ['label' => 'Home', 'page' => 'home', 'order' => 1],
            ['label' => 'About Us', 'page' => 'about', 'order' => 2],
            ['label' => 'Divisions', 'page' => 'divisions', 'order' => 3],
            ['label' => 'Team', 'page' => 'team', 'order' => 4],
            [
                'label' => 'Services',
                'page' => 'services',
                'order' => 5,
                'children' => [
                    ['label' => 'Government Payroll Services', 'page' => 'government-payroll-services', 'order' => 1],
                    ['label' => 'Pension Services', 'page' => 'pension-services', 'order' => 2],
                    ['label' => 'Cash Collection', 'page' => 'cash-collection', 'order' => 3],
                    ['label' => 'Investment Services', 'page' => 'investment-services', 'order' => 4],
                ],
            ],
            [
                'label' => 'Financial Reports',
                'page' => 'financial-reports',
                'order' => 6,
                'children' => [
                    ['label' => 'Annual Budget', 'page' => 'annual-budget', 'order' => 1],
                    ['label' => 'Audited Financial Statements', 'page' => 'audited-financial-statements', 'order' => 2],
                    ['label' => 'Debt Overview', 'page' => 'debt-overview', 'order' => 3],
                    ['label' => 'Domestic & External Debt', 'page' => 'domestic-external-debt-reports', 'order' => 4],
                    ['label' => 'Government Guarantees', 'page' => 'government-guarantees', 'order' => 5],
                    ['label' => 'Estimates', 'page' => 'estimates', 'order' => 6],
                ],
            ],
            [
                'label' => 'News & Updates',
                'page' => 'news',
                'order' => 7,
                'children' => [
                    ['label' => 'Treasury News', 'page' => 'treasury-news', 'order' => 1],
                    ['label' => 'Public Notices', 'page' => 'public-notices', 'order' => 2],
                    ['label' => 'Treasury Circulars', 'page' => 'treasury-circulars', 'order' => 3],
                ],
            ],
            ['label' => 'Downloads', 'page' => 'download', 'order' => 8],
            ['label' => 'Contact Us', 'page' => 'contact', 'order' => 9],
        ];

        // Create header menu items
        foreach ($headerItems as $itemData) {
            $page = $pages->get($itemData['page']);

            $item = MenuItem::create([
                'menu_id' => $headerMenu->id,
                'label' => $itemData['label'],
                'page_id' => $page ? $page->id : null,
                'type' => 'page',
                'order' => $itemData['order'],
                'is_active' => true,
            ]);

            // Create children if exists
            if (isset($itemData['children'])) {
                foreach ($itemData['children'] as $childData) {
                    $childPage = $pages->get($childData['page']);

                    MenuItem::create([
                        'menu_id' => $headerMenu->id,
                        'parent_id' => $item->id,
                        'label' => $childData['label'],
                        'page_id' => $childPage ? $childPage->id : null,
                        'type' => 'page',
                        'order' => $childData['order'],
                        'is_active' => true,
                    ]);
                }
            }
        }

        // Footer Menu Items (simpler, flat structure)
        $footerItems = [
            ['label' => 'About Us', 'page' => 'about', 'order' => 1],
            ['label' => 'Services', 'page' => 'services', 'order' => 2],
            ['label' => 'Financial Reports', 'page' => 'financial-reports', 'order' => 3],
            ['label' => 'Downloads', 'page' => 'download', 'order' => 4],
            ['label' => 'Contact Us', 'page' => 'contact', 'order' => 5],
            ['label' => 'Privacy Policy', 'url' => '#', 'order' => 6],
            ['label' => 'Terms & Conditions', 'url' => '#', 'order' => 7],
        ];

        foreach ($footerItems as $itemData) {
            $page = isset($itemData['page']) ? $pages->get($itemData['page']) : null;

            MenuItem::create([
                'menu_id' => $footerMenu->id,
                'label' => $itemData['label'],
                'page_id' => $page ? $page->id : null,
                'url' => $itemData['url'] ?? null,
                'type' => isset($itemData['url']) ? 'url' : 'page',
                'order' => $itemData['order'],
                'is_active' => true,
            ]);
        }

        // Mobile Menu (same as header menu)
        foreach ($headerItems as $itemData) {
            $page = $pages->get($itemData['page']);

            $item = MenuItem::create([
                'menu_id' => $mobileMenu->id,
                'label' => $itemData['label'],
                'page_id' => $page ? $page->id : null,
                'type' => 'page',
                'order' => $itemData['order'],
                'is_active' => true,
            ]);

            // Create children if exists
            if (isset($itemData['children'])) {
                foreach ($itemData['children'] as $childData) {
                    $childPage = $pages->get($childData['page']);

                    MenuItem::create([
                        'menu_id' => $mobileMenu->id,
                        'parent_id' => $item->id,
                        'label' => $childData['label'],
                        'page_id' => $childPage ? $childPage->id : null,
                        'type' => 'page',
                        'order' => $childData['order'],
                        'is_active' => true,
                    ]);
                }
            }
        }
    }
}
