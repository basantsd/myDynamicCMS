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
        // Clear existing menus and menu items
        MenuItem::query()->delete();
        Menu::query()->delete();

        // Create Menus
        $headerMenu = Menu::create([
            'name' => 'Header Menu',
            'location' => 'header',
            'description' => 'Main navigation menu',
        ]);

        $footerQuickLinksMenu = Menu::create([
            'name' => 'Footer Quick Links',
            'location' => 'footer-quick-links',
            'description' => 'Footer Quick Links column',
        ]);

        $footerLegalMenu = Menu::create([
            'name' => 'Footer Legal',
            'location' => 'footer-legal',
            'description' => 'Footer Legal column',
        ]);

        $footerRelatedLinksMenu = Menu::create([
            'name' => 'Footer Related Links',
            'location' => 'footer-related-links',
            'description' => 'Footer Related Links column',
        ]);

        $mobileMenu = Menu::create([
            'name' => 'Mobile Menu',
            'location' => 'mobile',
            'description' => 'Mobile navigation menu',
        ]);

        // Get pages
        $pages = Page::all()->keyBy('slug');

        // Header and Mobile Menu Items (same structure)
        $mainMenuItems = [
            ['title' => 'Home', 'page' => 'home', 'order' => 1],
            [
                'title' => 'About Us',
                'page' => 'about',
                'order' => 2,
                'children' => [
                    ['title' => 'Mission & Vision', 'page' => 'mission-vision', 'order' => 1],
                    ['title' => 'Core Values', 'page' => 'core-values', 'order' => 2],
                    ['title' => 'Our Mandate', 'page' => 'our-mandate', 'order' => 3],
                ],
            ],
            [
                'title' => 'Financial Reports',
                'page' => 'financial-reports',
                'order' => 3,
                'children' => [
                    ['title' => 'Annual Budget', 'page' => 'annual-budget', 'order' => 1],
                    ['title' => 'Audited Financial Statements', 'page' => 'audited-financial-statements', 'order' => 2],
                    ['title' => 'Quarterly Reports', 'page' => 'quarterly-reports', 'order' => 3],
                    ['title' => 'Estimates', 'page' => 'estimates', 'order' => 4],
                ],
            ],
            [
                'title' => 'Debt Management',
                'page' => 'debt-management',
                'order' => 4,
                'children' => [
                    ['title' => 'Debt Overview', 'page' => 'debt-overview', 'order' => 1],
                    ['title' => 'Domestic & External Debt', 'page' => 'domestic-external-debt-reports', 'order' => 2],
                    ['title' => 'Government Guarantees', 'page' => 'government-guarantees', 'order' => 3],
                ],
            ],
            [
                'title' => 'Treasury Services',
                'page' => 'treasury-services',
                'order' => 5,
                'children' => [
                    ['title' => 'Government Payroll Services', 'page' => 'government-payroll-services', 'order' => 1],
                    ['title' => 'Pension Services', 'page' => 'pension-services', 'order' => 2],
                    ['title' => 'Cash Collection', 'page' => 'cash-collection', 'order' => 3],
                    ['title' => 'Investment Services', 'page' => 'investment-services', 'order' => 4],
                ],
            ],
            [
                'title' => 'News & Notices',
                'page' => 'news',
                'order' => 6,
                'children' => [
                    ['title' => 'Treasury News', 'page' => 'treasury-news', 'order' => 1],
                    ['title' => 'Public Notices', 'page' => 'public-notices', 'order' => 2],
                ],
            ],
            ['title' => 'Download Centre', 'page' => 'download', 'order' => 7],
            ['title' => 'Contact', 'page' => 'contact', 'order' => 8],
        ];

        // Create header menu items
        foreach ($mainMenuItems as $itemData) {
            $page = isset($itemData['page']) ? $pages->get($itemData['page']) : null;

            $item = MenuItem::create([
                'menu_id' => $headerMenu->id,
                'title' => $itemData['title'],
                'page_id' => $page ? $page->id : null,
                'url' => isset($itemData['url']) ? $itemData['url'] : null,
                'order' => $itemData['order'],
                'is_active' => true,
            ]);

            // Create children if exists
            if (isset($itemData['children'])) {
                foreach ($itemData['children'] as $childData) {
                    $childPage = isset($childData['page']) ? $pages->get($childData['page']) : null;

                    MenuItem::create([
                        'menu_id' => $headerMenu->id,
                        'parent_id' => $item->id,
                        'title' => $childData['title'],
                        'page_id' => $childPage ? $childPage->id : null,
                        'url' => isset($childData['url']) ? $childData['url'] : null,
                        'order' => $childData['order'],
                        'is_active' => true,
                    ]);
                }
            }
        }

        // Create mobile menu items (same as header)
        foreach ($mainMenuItems as $itemData) {
            $page = isset($itemData['page']) ? $pages->get($itemData['page']) : null;

            $item = MenuItem::create([
                'menu_id' => $mobileMenu->id,
                'title' => $itemData['title'],
                'page_id' => $page ? $page->id : null,
                'url' => isset($itemData['url']) ? $itemData['url'] : null,
                'order' => $itemData['order'],
                'is_active' => true,
            ]);

            // Create children if exists
            if (isset($itemData['children'])) {
                foreach ($itemData['children'] as $childData) {
                    $childPage = isset($childData['page']) ? $pages->get($childData['page']) : null;

                    MenuItem::create([
                        'menu_id' => $mobileMenu->id,
                        'parent_id' => $item->id,
                        'title' => $childData['title'],
                        'page_id' => $childPage ? $childPage->id : null,
                        'url' => isset($childData['url']) ? $childData['url'] : null,
                        'order' => $childData['order'],
                        'is_active' => true,
                    ]);
                }
            }
        }

        // Footer Quick Links Menu
        $quickLinksItems = [
            ['title' => 'About Us', 'page' => 'about', 'order' => 1],
            ['title' => 'Financial Reports', 'page' => 'financial-reports', 'order' => 2],
            ['title' => 'Treasury Services', 'page' => 'treasury-services', 'order' => 3],
            ['title' => 'Download Centre', 'page' => 'download', 'order' => 4],
            ['title' => 'Contact Us', 'page' => 'contact', 'order' => 5],
        ];

        foreach ($quickLinksItems as $itemData) {
            $page = isset($itemData['page']) ? $pages->get($itemData['page']) : null;

            MenuItem::create([
                'menu_id' => $footerQuickLinksMenu->id,
                'title' => $itemData['title'],
                'page_id' => $page ? $page->id : null,
                'order' => $itemData['order'],
                'is_active' => true,
            ]);
        }

        // Footer Legal Menu
        $legalItems = [
            ['title' => 'Privacy Policy', 'page' => 'privacy-policy', 'order' => 1],
            ['title' => 'Terms & Conditions', 'page' => 'terms-conditions', 'order' => 2],
            ['title' => 'Disclaimer', 'page' => 'disclaimer', 'order' => 3],
            ['title' => 'Accessibility', 'page' => 'accessibility', 'order' => 4],
            ['title' => 'Site Map', 'page' => 'sitemap', 'order' => 5],
        ];

        foreach ($legalItems as $itemData) {
            $page = isset($itemData['page']) ? $pages->get($itemData['page']) : null;

            MenuItem::create([
                'menu_id' => $footerLegalMenu->id,
                'title' => $itemData['title'],
                'page_id' => $page ? $page->id : null,
                'order' => $itemData['order'],
                'is_active' => true,
            ]);
        }

        // Footer Related Links Menu (External Links)
        $relatedLinksItems = [
            ['title' => 'Government of St. Kitts & Nevis', 'url' => 'https://www.gov.kn', 'order' => 1],
            ['title' => 'Ministry of Finance', 'url' => 'https://www.finance.gov.kn', 'order' => 2],
            ['title' => 'Inland Revenue Department', 'url' => 'https://www.ird.gov.kn', 'order' => 3],
            ['title' => 'Customs & Excise Department', 'url' => 'https://www.customs.gov.kn', 'order' => 4],
            ['title' => 'National Insurance', 'url' => 'https://www.nis.gov.kn', 'order' => 5],
        ];

        foreach ($relatedLinksItems as $itemData) {
            MenuItem::create([
                'menu_id' => $footerRelatedLinksMenu->id,
                'title' => $itemData['title'],
                'url' => $itemData['url'],
                'target' => '_blank',
                'order' => $itemData['order'],
                'is_active' => true,
            ]);
        }

        $this->command->info('Menus seeded successfully!');
    }
}
