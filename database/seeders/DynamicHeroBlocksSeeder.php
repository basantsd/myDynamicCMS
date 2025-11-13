<?php

namespace Database\Seeders;

use App\Models\CustomBlock;
use Illuminate\Database\Seeder;

class DynamicHeroBlocksSeeder extends Seeder
{
    /**
     * Run the database seeds - Add Hero, Features, CTA, and other dynamic blocks
     */
    public function run(): void
    {
        $blocks = [
            // ========== 🎯 HERO SECTIONS ==========
            [
                'name' => 'Hero Banner Split',
                'icon' => 'fa-image',
                'color' => '#667eea',
                'category' => 'hero',
                'description' => 'Full-width hero with text and image split layout',
                'schema' => [
                    'fields' => [
                        ['name' => 'title', 'type' => 'text', 'label' => 'Title', 'required' => true],
                        ['name' => 'subtitle', 'type' => 'textarea', 'label' => 'Subtitle'],
                        ['name' => 'button1_text', 'type' => 'text', 'label' => 'Button 1 Text'],
                        ['name' => 'button1_url', 'type' => 'text', 'label' => 'Button 1 URL'],
                        ['name' => 'button2_text', 'type' => 'text', 'label' => 'Button 2 Text'],
                        ['name' => 'button2_url', 'type' => 'text', 'label' => 'Button 2 URL'],
                        ['name' => 'image', 'type' => 'image', 'label' => 'Hero Image', 'required' => true],
                    ],
                ],
                'default_values' => [
                    'title' => 'Welcome to Our Platform',
                    'subtitle' => 'Build amazing websites with our powerful drag-and-drop builder',
                    'button1_text' => 'Get Started',
                    'button2_text' => 'Learn More',
                ],
            ],

            [
                'name' => 'Hero Centered with Overlay',
                'icon' => 'fa-align-center',
                'color' => '#667eea',
                'category' => 'hero',
                'description' => 'Centered hero with background image overlay',
                'schema' => [
                    'fields' => [
                        ['name' => 'title', 'type' => 'text', 'label' => 'Title', 'required' => true],
                        ['name' => 'subtitle', 'type' => 'text', 'label' => 'Subtitle'],
                        ['name' => 'button_text', 'type' => 'text', 'label' => 'Button Text'],
                        ['name' => 'button_url', 'type' => 'text', 'label' => 'Button URL'],
                        ['name' => 'background_image', 'type' => 'image', 'label' => 'Background Image', 'required' => true],
                        ['name' => 'overlay_opacity', 'type' => 'select', 'label' => 'Overlay Opacity', 'options' => ['0.3', '0.5', '0.7']],
                    ],
                ],
                'default_values' => [
                    'title' => 'Your Amazing Headline',
                    'subtitle' => 'Tell your story here',
                    'button_text' => 'Call to Action',
                    'overlay_opacity' => '0.5',
                ],
            ],

            // ========== ✨ FEATURES ==========
            [
                'name' => 'Features 3 Columns',
                'icon' => 'fa-th-large',
                'color' => '#3b82f6',
                'category' => 'feature',
                'description' => 'Three column feature section with icons',
                'schema' => [
                    'fields' => [
                        ['name' => 'section_title', 'type' => 'text', 'label' => 'Section Title'],
                        ['name' => 'section_subtitle', 'type' => 'text', 'label' => 'Section Subtitle'],
                        [
                            'name' => 'features',
                            'type' => 'repeater',
                            'label' => 'Features (Max 3)',
                            'max' => 3,
                            'fields' => [
                                ['name' => 'icon', 'type' => 'icon', 'label' => 'Icon', 'required' => true],
                                ['name' => 'title', 'type' => 'text', 'label' => 'Title', 'required' => true],
                                ['name' => 'description', 'type' => 'textarea', 'label' => 'Description'],
                            ],
                        ],
                    ],
                ],
                'default_values' => [
                    'section_title' => 'Our Features',
                    'section_subtitle' => 'Everything you need to succeed',
                    'features' => [
                        ['icon' => 'fa-rocket', 'title' => 'Fast Performance', 'description' => 'Lightning-fast loading speeds'],
                        ['icon' => 'fa-shield-alt', 'title' => 'Secure & Safe', 'description' => 'Enterprise-grade security'],
                        ['icon' => 'fa-mobile-alt', 'title' => 'Mobile Responsive', 'description' => 'Perfect on all devices'],
                    ],
                ],
            ],

            [
                'name' => 'Features 4 Columns',
                'icon' => 'fa-th',
                'color' => '#3b82f6',
                'category' => 'feature',
                'description' => 'Four column compact feature section',
                'schema' => [
                    'fields' => [
                        ['name' => 'background_color', 'type' => 'select', 'label' => 'Background', 'options' => ['White', 'Light Gray', 'Light Blue']],
                        ['name' => 'column_count', 'type' => 'number', 'label' => 'Number of Features', 'min' => 2, 'max' => 4],
                        [
                            'name' => 'features',
                            'type' => 'repeater',
                            'label' => 'Features',
                            'max' => 4,
                            'fields' => [
                                ['name' => 'icon', 'type' => 'icon', 'label' => 'Icon', 'required' => true],
                                ['name' => 'icon_color', 'type' => 'color', 'label' => 'Icon Color'],
                                ['name' => 'title', 'type' => 'text', 'label' => 'Title', 'required' => true],
                                ['name' => 'description', 'type' => 'text', 'label' => 'Description'],
                            ],
                        ],
                    ],
                ],
                'default_values' => [
                    'background_color' => 'Light Gray',
                    'column_count' => 4,
                ],
            ],

            // ========== 📣 CALL TO ACTIONS ==========
            [
                'name' => 'CTA Simple Horizontal',
                'icon' => 'fa-bullhorn',
                'color' => '#8b5cf6',
                'category' => 'content',
                'description' => 'Simple horizontal CTA section',
                'schema' => [
                    'fields' => [
                        ['name' => 'title', 'type' => 'text', 'label' => 'Title', 'required' => true],
                        ['name' => 'subtitle', 'type' => 'text', 'label' => 'Subtitle'],
                        ['name' => 'button_text', 'type' => 'text', 'label' => 'Button Text'],
                        ['name' => 'button_url', 'type' => 'text', 'label' => 'Button URL'],
                    ],
                ],
                'default_values' => [
                    'title' => 'Ready to Get Started?',
                    'subtitle' => 'Join thousands of satisfied customers today',
                    'button_text' => 'Get Started',
                ],
            ],

            [
                'name' => 'CTA Centered with Dual Buttons',
                'icon' => 'fa-align-center',
                'color' => '#8b5cf6',
                'category' => 'content',
                'description' => 'Centered CTA with dual buttons',
                'schema' => [
                    'fields' => [
                        ['name' => 'title', 'type' => 'text', 'label' => 'Title', 'required' => true],
                        ['name' => 'subtitle', 'type' => 'text', 'label' => 'Subtitle'],
                        ['name' => 'button1_text', 'type' => 'text', 'label' => 'Primary Button Text'],
                        ['name' => 'button1_url', 'type' => 'text', 'label' => 'Primary Button URL'],
                        ['name' => 'button2_text', 'type' => 'text', 'label' => 'Secondary Button Text'],
                        ['name' => 'button2_url', 'type' => 'text', 'label' => 'Secondary Button URL'],
                    ],
                ],
                'default_values' => [
                    'title' => 'Transform Your Business Today',
                    'subtitle' => 'Start your free trial now',
                    'button1_text' => 'Start Free Trial',
                    'button2_text' => 'Contact Sales',
                ],
            ],

            // ========== 💰 PRICING ==========
            [
                'name' => 'Pricing 3 Plans',
                'icon' => 'fa-dollar-sign',
                'color' => '#06b6d4',
                'category' => 'table',
                'description' => 'Three-tier pricing table',
                'schema' => [
                    'fields' => [
                        ['name' => 'highlight_middle', 'type' => 'toggle', 'label' => 'Highlight Middle Plan'],
                        [
                            'name' => 'plans',
                            'type' => 'repeater',
                            'label' => 'Pricing Plans',
                            'max' => 3,
                            'fields' => [
                                ['name' => 'name', 'type' => 'text', 'label' => 'Plan Name', 'required' => true],
                                ['name' => 'price', 'type' => 'number', 'label' => 'Price', 'required' => true],
                                ['name' => 'features', 'type' => 'textarea', 'label' => 'Features (one per line)'],
                            ],
                        ],
                    ],
                ],
                'default_values' => [
                    'highlight_middle' => true,
                    'plans' => [
                        ['name' => 'Starter', 'price' => 9, 'features' => "10 Projects\n1 GB Storage\nEmail Support"],
                        ['name' => 'Professional', 'price' => 29, 'features' => "100 Projects\n10 GB Storage\nPriority Support"],
                        ['name' => 'Enterprise', 'price' => 99, 'features' => "Unlimited Projects\n100 GB Storage\n24/7 Support"],
                    ],
                ],
            ],

            // ========== 📊 STATISTICS ==========
            [
                'name' => 'Statistics 4 Columns',
                'icon' => 'fa-chart-line',
                'color' => '#ef4444',
                'category' => 'content',
                'description' => 'Four column statistics showcase',
                'schema' => [
                    'fields' => [
                        [
                            'name' => 'stats',
                            'type' => 'repeater',
                            'label' => 'Statistics',
                            'max' => 4,
                            'fields' => [
                                ['name' => 'number', 'type' => 'text', 'label' => 'Number', 'required' => true],
                                ['name' => 'label', 'type' => 'text', 'label' => 'Label', 'required' => true],
                            ],
                        ],
                    ],
                ],
                'default_values' => [
                    'stats' => [
                        ['number' => '10K+', 'label' => 'Happy Customers'],
                        ['number' => '500+', 'label' => 'Projects Completed'],
                        ['number' => '98%', 'label' => 'Client Satisfaction'],
                        ['number' => '24/7', 'label' => 'Support Available'],
                    ],
                ],
            ],

            // ========== 👥 TEAM ==========
            [
                'name' => 'Team Grid',
                'icon' => 'fa-users',
                'color' => '#f59e0b',
                'category' => 'content',
                'description' => 'Team member grid with photos',
                'schema' => [
                    'fields' => [
                        ['name' => 'section_title', 'type' => 'text', 'label' => 'Section Title'],
                        ['name' => 'section_subtitle', 'type' => 'text', 'label' => 'Section Subtitle'],
                        ['name' => 'show_social', 'type' => 'toggle', 'label' => 'Show Social Links'],
                        [
                            'name' => 'members',
                            'type' => 'repeater',
                            'label' => 'Team Members',
                            'fields' => [
                                ['name' => 'photo', 'type' => 'image', 'label' => 'Photo'],
                                ['name' => 'name', 'type' => 'text', 'label' => 'Name', 'required' => true],
                                ['name' => 'position', 'type' => 'text', 'label' => 'Position'],
                                ['name' => 'bio', 'type' => 'textarea', 'label' => 'Bio'],
                            ],
                        ],
                    ],
                ],
                'default_values' => [
                    'section_title' => 'Our Team',
                    'section_subtitle' => 'Meet the people behind our success',
                    'show_social' => true,
                ],
            ],

            // ========== 🏛️ TREASURY SECTIONS ==========
            [
                'name' => 'Treasury Core Values',
                'icon' => 'fa-shield-alt',
                'color' => '#bd2828',
                'category' => 'content',
                'description' => 'Treasury core values section with 3 values',
                'schema' => [
                    'fields' => [
                        ['name' => 'title', 'type' => 'text', 'label' => 'Section Title'],
                        ['name' => 'subtitle', 'type' => 'text', 'label' => 'Section Subtitle'],
                        [
                            'name' => 'values',
                            'type' => 'repeater',
                            'label' => 'Core Values',
                            'max' => 3,
                            'fields' => [
                                ['name' => 'icon', 'type' => 'icon', 'label' => 'Icon', 'required' => true],
                                ['name' => 'title', 'type' => 'text', 'label' => 'Value Title', 'required' => true],
                                ['name' => 'description', 'type' => 'textarea', 'label' => 'Description'],
                            ],
                        ],
                    ],
                ],
                'default_values' => [
                    'title' => 'Our Core Values',
                    'subtitle' => 'Guiding principles that define how we serve the people',
                    'values' => [
                        ['icon' => 'fa-shield-alt', 'title' => 'Transparency', 'description' => 'Open and clear communication in all financial operations'],
                        ['icon' => 'fa-user-tie', 'title' => 'Professionalism', 'description' => 'Delivering services with expertise and integrity'],
                        ['icon' => 'fa-user-shield', 'title' => 'Confidentiality', 'description' => 'Protecting sensitive information with strict security'],
                    ],
                ],
            ],

            [
                'name' => 'Treasury Mission Section',
                'icon' => 'fa-bullseye',
                'color' => '#bd2828',
                'category' => 'content',
                'description' => 'Mission statement section',
                'schema' => [
                    'fields' => [
                        ['name' => 'title', 'type' => 'text', 'label' => 'Title'],
                        ['name' => 'mission_text', 'type' => 'textarea', 'label' => 'Mission Statement', 'required' => true],
                    ],
                ],
                'default_values' => [
                    'title' => 'Our Mission',
                    'mission_text' => 'To ensure efficient and effective managing and reporting of Government financial operations.',
                ],
            ],

            [
                'name' => 'Treasury Mandate Box',
                'icon' => 'fa-tasks',
                'color' => '#bd2828',
                'category' => 'content',
                'description' => 'Mandate/responsibilities section with numbered list',
                'schema' => [
                    'fields' => [
                        ['name' => 'title', 'type' => 'text', 'label' => 'Title'],
                        ['name' => 'intro', 'type' => 'textarea', 'label' => 'Introduction Text'],
                        [
                            'name' => 'mandates',
                            'type' => 'repeater',
                            'label' => 'Mandate Items',
                            'fields' => [
                                ['name' => 'text', 'type' => 'text', 'label' => 'Mandate Text', 'required' => true],
                            ],
                        ],
                    ],
                ],
                'default_values' => [
                    'title' => 'Our Mandate',
                    'intro' => 'The Accountant General\'s Department is responsible for:',
                    'mandates' => [
                        ['text' => 'Maintaining central accounts of the Government'],
                        ['text' => 'Receiving, banking and overseeing disbursement of public money'],
                        ['text' => 'Preparing Public Accounts and financial statements'],
                        ['text' => 'Maintaining a system for examination of payments'],
                    ],
                ],
            ],

            [
                'name' => 'Treasury Division Boxes',
                'icon' => 'fa-sitemap',
                'color' => '#bd2828',
                'category' => 'content',
                'description' => 'Divisions and units section',
                'schema' => [
                    'fields' => [
                        ['name' => 'title', 'type' => 'text', 'label' => 'Section Title'],
                        ['name' => 'subtitle', 'type' => 'text', 'label' => 'Section Subtitle'],
                        [
                            'name' => 'divisions',
                            'type' => 'repeater',
                            'label' => 'Divisions',
                            'fields' => [
                                ['name' => 'title', 'type' => 'text', 'label' => 'Division Title', 'required' => true],
                                ['name' => 'responsibilities', 'type' => 'textarea', 'label' => 'Responsibilities (one per line)'],
                            ],
                        ],
                    ],
                ],
                'default_values' => [
                    'title' => 'Divisions & Units',
                    'subtitle' => 'Explore the different divisions and units',
                    'divisions' => [
                        ['title' => 'Accounting & Reporting', 'responsibilities' => "Maintenance of proper accounting records\nPreparation of Annual Public Accounts\nBank Reconciliation\nComputation of Pensions"],
                        ['title' => 'Cash Management', 'responsibilities' => "Cash forecasting and investments\nMonitoring Government cash position\nLiaison with banking partners\nEnsuring obligations are funded"],
                    ],
                ],
            ],

            [
                'name' => 'Treasury Profile Cards',
                'icon' => 'fa-id-card',
                'color' => '#bd2828',
                'category' => 'content',
                'description' => 'Management team profiles',
                'schema' => [
                    'fields' => [
                        ['name' => 'title', 'type' => 'text', 'label' => 'Section Title'],
                        ['name' => 'subtitle', 'type' => 'text', 'label' => 'Section Subtitle'],
                        [
                            'name' => 'profiles',
                            'type' => 'repeater',
                            'label' => 'Team Profiles',
                            'fields' => [
                                ['name' => 'photo', 'type' => 'image', 'label' => 'Photo'],
                                ['name' => 'name', 'type' => 'text', 'label' => 'Name', 'required' => true],
                                ['name' => 'position', 'type' => 'text', 'label' => 'Position', 'required' => true],
                                ['name' => 'email', 'type' => 'text', 'label' => 'Email'],
                                ['name' => 'phone', 'type' => 'text', 'label' => 'Phone'],
                            ],
                        ],
                    ],
                ],
                'default_values' => [
                    'title' => 'Management Team',
                    'subtitle' => 'Meet the dedicated professionals',
                ],
            ],

            [
                'name' => 'Treasury Budget Box',
                'icon' => 'fa-file-invoice-dollar',
                'color' => '#bd2828',
                'category' => 'content',
                'description' => 'Budget overview section',
                'schema' => [
                    'fields' => [
                        ['name' => 'title', 'type' => 'text', 'label' => 'Title'],
                        ['name' => 'description', 'type' => 'textarea', 'label' => 'Description'],
                        ['name' => 'themes', 'type' => 'textarea', 'label' => 'Budget Themes (one per line)'],
                    ],
                ],
                'default_values' => [
                    'title' => 'Budget Overview',
                    'description' => 'The national budget sets out Government spending priorities',
                    'themes' => "Supporting economic growth\nPublic infrastructure development\nFiscal responsibility and transparency",
                ],
            ],

            [
                'name' => 'Treasury Download Section',
                'icon' => 'fa-download',
                'color' => '#bd2828',
                'category' => 'content',
                'description' => 'Document download section with list of files',
                'schema' => [
                    'fields' => [
                        ['name' => 'title', 'type' => 'text', 'label' => 'Section Title'],
                        [
                            'name' => 'documents',
                            'type' => 'repeater',
                            'label' => 'Documents',
                            'fields' => [
                                ['name' => 'title', 'type' => 'text', 'label' => 'Document Title', 'required' => true],
                                ['name' => 'file_url', 'type' => 'text', 'label' => 'File URL', 'required' => true],
                            ],
                        ],
                    ],
                ],
                'default_values' => [
                    'title' => 'Download Documents',
                ],
            ],

            [
                'name' => 'Treasury Pension Calculator',
                'icon' => 'fa-calculator',
                'color' => '#bd2828',
                'category' => 'form',
                'description' => 'Pension calculator form with eligibility info',
                'schema' => [
                    'fields' => [
                        ['name' => 'title', 'type' => 'text', 'label' => 'Calculator Title'],
                        ['name' => 'description', 'type' => 'textarea', 'label' => 'Description'],
                    ],
                ],
                'form_table_name' => 'pension_calculations',
                'default_values' => [
                    'title' => 'Pension Calculator',
                    'description' => 'Calculate your estimated government pension and gratuity',
                ],
            ],
        ];

        foreach ($blocks as $block) {
            CustomBlock::updateOrCreate(
                ['name' => $block['name']],
                $block
            );
        }

        $this->command->info('✅ Added ' . count($blocks) . ' dynamic hero and treasury blocks!');
    }
}
