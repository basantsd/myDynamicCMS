<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General Settings
            [
                'key' => 'site_name',
                'value' => "Accountant General's Department",
                'type' => 'text',
                'group' => 'general',
                'label' => 'Site Name',
                'description' => 'The name of your website',
            ],
            [
                'key' => 'site_tagline',
                'value' => 'Government Of St. Kitts Nevis',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Site Tagline',
                'description' => 'A short description of your website',
            ],
            [
                'key' => 'site_logo',
                'value' => './assets/img/logo1.png',
                'type' => 'image',
                'group' => 'general',
                'label' => 'Site Logo',
                'description' => 'Upload your site logo',
            ],
            [
                'key' => 'site_favicon',
                'value' => './assets/img/fav.jpg',
                'type' => 'image',
                'group' => 'general',
                'label' => 'Site Favicon',
                'description' => 'Upload your site favicon',
            ],

            // Contact Settings
            [
                'key' => 'contact_phone',
                'value' => '+1 (869) 467-1293',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Phone Number',
                'description' => 'Contact phone number',
            ],
            [
                'key' => 'contact_email',
                'value' => 'info@skntreasury.gov.kn',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Email Address',
                'description' => 'Contact email address',
            ],
            [
                'key' => 'contact_address',
                'value' => 'Treasury Chambers, Ministry of Finance, Basseterre, St. Kitts',
                'type' => 'textarea',
                'group' => 'contact',
                'label' => 'Address',
                'description' => 'Physical address',
            ],

            // SEO Settings
            [
                'key' => 'meta_description',
                'value' => 'Accountant General\'s Department',
                'type' => 'textarea',
                'group' => 'seo',
                'label' => 'Meta Description',
                'description' => 'Default meta description for SEO',
            ],
            [
                'key' => 'meta_keywords',
                'value' => 'Accountant General\'s Department',
                'type' => 'textarea',
                'group' => 'seo',
                'label' => 'Meta Keywords',
                'description' => 'Default meta keywords for SEO',
            ],

            // Footer Settings
            [
                'key' => 'footer_copyright',
                'value' => '© 2025 Government of St. Kitts and Nevis - Accountant General\'s Department. All rights reserved.',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Footer Copyright',
                'description' => 'Copyright text in footer',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
