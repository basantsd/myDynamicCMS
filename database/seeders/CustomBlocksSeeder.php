<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CustomBlocksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blocks = $this->getBlocksData();

        foreach ($blocks as $block) {
            DB::table('custom_blocks')->insert(array_merge($block, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }
    }

    /**
     * Get all blocks data with complete configuration
     */
    private function getBlocksData(): array
    {
        return [
            // HERO SECTIONS
            [
                'name' => 'Hero Banner Split',
                'icon' => 'fa-image',
                'color' => '#667eea',
                'category' => 'hero',
                'description' => 'Full-width hero with text and image split layout',
                'html_template' => $this->getHeroBannerTemplate(),
                'css_styles' => $this->getHeroBannerStyles(),
                'js_scripts' => null,
                'schema' => json_encode($this->getHeroBannerSchema()),
                'traits_config' => json_encode($this->getHeroBannerTraits()),
                'dependencies' => json_encode(['bootstrap' => '5.x', 'fontawesome' => '6.x']),
                'default_values' => json_encode([
                    'title' => 'Welcome to Our Platform',
                    'subtitle' => 'Build amazing websites with our powerful drag-and-drop builder',
                    'button1_text' => 'Get Started',
                    'button1_url' => '#',
                    'button2_text' => 'Learn More',
                    'button2_url' => '#',
                    'image' => '/assets/img/hero/hero_bg_1_1.jpg'
                ]),
                'tags' => json_encode(['hero', 'banner', 'split-layout', 'gradient']),
                'block_version' => '1.0.0',
                'is_active' => 1,
            ],

            // CAROUSEL SLIDER
            [
                'name' => 'Bootstrap Carousel Slider',
                'icon' => 'fa-images',
                'color' => '#9b59b6',
                'category' => 'slider',
                'description' => 'Bootstrap 5 carousel with indicators and controls',
                'html_template' => $this->getCarouselTemplate(),
                'css_styles' => $this->getCarouselStyles(),
                'js_scripts' => null,
                'schema' => json_encode($this->getCarouselSchema()),
                'traits_config' => json_encode($this->getCarouselTraits()),
                'dependencies' => json_encode(['bootstrap' => '5.x']),
                'default_values' => json_encode([
                    'autoplay' => true,
                    'interval' => 5000,
                    'slides' => [
                        [
                            'title' => 'Accountant General\'s Department',
                            'subtitle' => 'Treasury Chambers - St. Kitts and Nevis',
                            'description' => 'Serving the people with transparency',
                            'button_text' => 'Our Services',
                            'button_url' => '#',
                            'image' => '/assets/img/hero/hero_bg_1_1.jpg'
                        ]
                    ]
                ]),
                'tags' => json_encode(['slider', 'carousel', 'bootstrap', 'hero']),
                'block_version' => '1.0.0',
                'is_active' => 1,
            ],

            // DATA TABLE WITH FILTERS
            [
                'name' => 'Data Table with Filters',
                'icon' => 'fa-table',
                'color' => '#e74c3c',
                'category' => 'table',
                'description' => 'Dynamic table with search, filters, sorting, and download functionality',
                'html_template' => $this->getDataTableTemplate(),
                'css_styles' => $this->getDataTableStyles(),
                'js_scripts' => $this->getDataTableScripts(),
                'schema' => json_encode($this->getDataTableSchema()),
                'traits_config' => json_encode($this->getDataTableTraits()),
                'dependencies' => json_encode(['jquery' => '3.x', 'fontawesome' => '6.x']),
                'default_values' => json_encode([
                    'table_title' => 'Download Documents',
                    'show_filters' => true,
                    'show_search' => true,
                    'sortable' => true,
                    'columns' => ['Name', 'Category', 'Year', 'Size', 'Action'],
                    'rows' => []
                ]),
                'tags' => json_encode(['table', 'data', 'filters', 'download', 'sortable']),
                'block_version' => '1.0.0',
                'is_active' => 1,
            ],

            // CORE VALUES CARDS
            [
                'name' => 'Treasury Core Values',
                'icon' => 'fa-shield-alt',
                'color' => '#bd2828',
                'category' => 'content',
                'description' => 'Core values section with icon cards',
                'html_template' => $this->getCoreValuesTemplate(),
                'css_styles' => $this->getCoreValuesStyles(),
                'js_scripts' => null,
                'schema' => json_encode($this->getCoreValuesSchema()),
                'traits_config' => json_encode($this->getCoreValuesTraits()),
                'dependencies' => json_encode(['fontawesome' => '6.x']),
                'default_values' => json_encode([
                    'title' => 'Our Core Values',
                    'subtitle' => 'Guiding principles that define how we serve',
                    'values' => [
                        [
                            'icon' => 'fa-shield-alt',
                            'title' => 'Transparency',
                            'description' => 'Open and clear communication in all operations'
                        ],
                        [
                            'icon' => 'fa-user-tie',
                            'title' => 'Professionalism',
                            'description' => 'Delivering services with expertise and integrity'
                        ],
                        [
                            'icon' => 'fa-user-shield',
                            'title' => 'Confidentiality',
                            'description' => 'Protecting sensitive information with strict security'
                        ]
                    ]
                ]),
                'tags' => json_encode(['treasury', 'values', 'cards', 'icons']),
                'block_version' => '1.0.0',
                'is_active' => 1,
            ],

            // PRICING TABLE
            [
                'name' => 'Pricing Table 3 Plans',
                'icon' => 'fa-dollar-sign',
                'color' => '#06b6d4',
                'category' => 'table',
                'description' => 'Three-tier pricing table with featured plan',
                'html_template' => $this->getPricingTableTemplate(),
                'css_styles' => $this->getPricingTableStyles(),
                'js_scripts' => null,
                'schema' => json_encode($this->getPricingTableSchema()),
                'traits_config' => json_encode($this->getPricingTableTraits()),
                'dependencies' => json_encode(['bootstrap' => '5.x', 'fontawesome' => '6.x']),
                'default_values' => json_encode([
                    'section_title' => 'Choose Your Plan',
                    'section_subtitle' => 'Simple, transparent pricing',
                    'plans' => [
                        [
                            'name' => 'Starter',
                            'price' => 9,
                            'period' => '/mo',
                            'features' => ['10 Projects', '1 GB Storage', 'Email Support'],
                            'button_text' => 'Get Started',
                            'featured' => false
                        ],
                        [
                            'name' => 'Professional',
                            'price' => 29,
                            'period' => '/mo',
                            'features' => ['100 Projects', '10 GB Storage', 'Priority Support'],
                            'button_text' => 'Get Started',
                            'featured' => true
                        ],
                        [
                            'name' => 'Enterprise',
                            'price' => 99,
                            'period' => '/mo',
                            'features' => ['Unlimited Projects', '100 GB Storage', '24/7 Support'],
                            'button_text' => 'Contact Sales',
                            'featured' => false
                        ]
                    ]
                ]),
                'tags' => json_encode(['pricing', 'table', 'plans', 'subscription']),
                'block_version' => '1.0.0',
                'is_active' => 1,
            ],

            // CONTACT FORM
            [
                'name' => 'Contact Form with Submission',
                'icon' => 'fa-envelope',
                'color' => '#3498db',
                'category' => 'form',
                'description' => 'Contact form that stores submissions in database',
                'html_template' => $this->getContactFormTemplate(),
                'css_styles' => $this->getContactFormStyles(),
                'js_scripts' => $this->getContactFormScripts(),
                'schema' => json_encode($this->getContactFormSchema()),
                'traits_config' => json_encode($this->getContactFormTraits()),
                'dependencies' => json_encode(['jquery' => '3.x']),
                'form_table_name' => 'contact_form_submissions',
                'action_settings' => json_encode([
                    'submit_url' => '/api/contact-submit',
                    'method' => 'POST',
                    'success_message' => 'Thank you! We will get back to you soon.',
                    'error_message' => 'Something went wrong. Please try again.'
                ]),
                'default_values' => json_encode([
                    'form_title' => 'Get In Touch',
                    'form_subtitle' => 'We\'d love to hear from you',
                    'fields' => [
                        ['type' => 'text', 'name' => 'name', 'label' => 'Name', 'required' => true],
                        ['type' => 'email', 'name' => 'email', 'label' => 'Email', 'required' => true],
                        ['type' => 'tel', 'name' => 'phone', 'label' => 'Phone', 'required' => false],
                        ['type' => 'textarea', 'name' => 'message', 'label' => 'Message', 'required' => true]
                    ],
                    'submit_button_text' => 'Send Message'
                ]),
                'tags' => json_encode(['form', 'contact', 'submission', 'database']),
                'block_version' => '1.0.0',
                'is_active' => 1,
            ],

            // FEATURE GRID
            [
                'name' => 'Features 3 Columns',
                'icon' => 'fa-th-large',
                'color' => '#3b82f6',
                'category' => 'feature',
                'description' => 'Three column feature section with icons',
                'html_template' => $this->getFeaturesTemplate(),
                'css_styles' => $this->getFeaturesStyles(),
                'js_scripts' => null,
                'schema' => json_encode($this->getFeaturesSchema()),
                'traits_config' => json_encode($this->getFeaturesTraits()),
                'dependencies' => json_encode(['fontawesome' => '6.x']),
                'default_values' => json_encode([
                    'section_title' => 'Our Features',
                    'section_subtitle' => 'Everything you need to succeed',
                    'features' => [
                        [
                            'icon' => 'fa-rocket',
                            'title' => 'Fast Performance',
                            'description' => 'Lightning-fast loading speeds'
                        ],
                        [
                            'icon' => 'fa-shield-alt',
                            'title' => 'Secure & Safe',
                            'description' => 'Enterprise-grade security'
                        ],
                        [
                            'icon' => 'fa-mobile-alt',
                            'title' => 'Mobile Responsive',
                            'description' => 'Perfect on all devices'
                        ]
                    ]
                ]),
                'tags' => json_encode(['features', 'grid', 'icons', '3-column']),
                'block_version' => '1.0.0',
                'is_active' => 1,
            ],

            // TEAM GRID
            [
                'name' => 'Team Member Grid',
                'icon' => 'fa-users',
                'color' => '#f59e0b',
                'category' => 'content',
                'description' => 'Team member grid with photos and social links',
                'html_template' => $this->getTeamGridTemplate(),
                'css_styles' => $this->getTeamGridStyles(),
                'js_scripts' => null,
                'schema' => json_encode($this->getTeamGridSchema()),
                'traits_config' => json_encode($this->getTeamGridTraits()),
                'dependencies' => json_encode(['fontawesome' => '6.x']),
                'default_values' => json_encode([
                    'section_title' => 'Meet Our Team',
                    'section_subtitle' => 'The people behind our success',
                    'show_social' => true,
                    'members' => []
                ]),
                'tags' => json_encode(['team', 'people', 'grid', 'social']),
                'block_version' => '1.0.0',
                'is_active' => 1,
            ],

            // CTA SECTION
            [
                'name' => 'CTA Centered with Dual Buttons',
                'icon' => 'fa-bullhorn',
                'color' => '#8b5cf6',
                'category' => 'content',
                'description' => 'Centered call-to-action with two buttons',
                'html_template' => $this->getCTATemplate(),
                'css_styles' => $this->getCTAStyles(),
                'js_scripts' => null,
                'schema' => json_encode($this->getCTASchema()),
                'traits_config' => json_encode($this->getCTATraits()),
                'dependencies' => json_encode(['bootstrap' => '5.x']),
                'default_values' => json_encode([
                    'title' => 'Transform Your Business Today',
                    'subtitle' => 'Start your free trial now. No credit card required.',
                    'button1_text' => 'Start Free Trial',
                    'button1_url' => '#',
                    'button2_text' => 'Contact Sales',
                    'button2_url' => '#'
                ]),
                'tags' => json_encode(['cta', 'call-to-action', 'buttons', 'centered']),
                'block_version' => '1.0.0',
                'is_active' => 1,
            ],

            // FOOTER
            [
                'name' => 'Modern Footer',
                'icon' => 'fa-shoe-prints',
                'color' => '#1f2937',
                'category' => 'footer',
                'description' => 'Modern footer with multiple columns and social links',
                'html_template' => $this->getFooterTemplate(),
                'css_styles' => $this->getFooterStyles(),
                'js_scripts' => null,
                'schema' => json_encode($this->getFooterSchema()),
                'traits_config' => json_encode($this->getFooterTraits()),
                'dependencies' => json_encode(['fontawesome' => '6.x']),
                'default_values' => json_encode([
                    'brand_name' => 'Your Brand',
                    'brand_description' => 'Building amazing experiences for our customers worldwide.',
                    'copyright_text' => '© 2024 Your Company. All rights reserved.',
                    'show_newsletter' => true,
                    'social_links' => [
                        ['icon' => 'fa-facebook', 'url' => '#'],
                        ['icon' => 'fa-twitter', 'url' => '#'],
                        ['icon' => 'fa-instagram', 'url' => '#'],
                        ['icon' => 'fa-linkedin', 'url' => '#']
                    ]
                ]),
                'tags' => json_encode(['footer', 'social', 'newsletter', 'links']),
                'block_version' => '1.0.0',
                'is_active' => 1,
            ],
        ];
    }

    // Template methods for each block type
    private function getHeroBannerTemplate(): string
    {
        return '<section class="hero-wrapper" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 100px 0; color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="hero-title" style="font-size: 48px; font-weight: bold; margin-bottom: 20px;">{{title}}</h1>
                <p class="hero-subtitle" style="font-size: 18px; margin-bottom: 30px;">{{subtitle}}</p>
                <a href="{{button1_url}}" class="btn btn-light btn-lg" style="padding: 12px 30px; border-radius: 30px;">{{button1_text}}</a>
                <a href="{{button2_url}}" class="btn btn-outline-light btn-lg ms-2" style="padding: 12px 30px; border-radius: 30px;">{{button2_text}}</a>
            </div>
            <div class="col-lg-6 text-center">
                <img src="{{image}}" alt="Hero" class="hero-image" style="max-width: 100%; border-radius: 10px;">
            </div>
        </div>
    </div>
</section>';
    }

    private function getHeroBannerStyles(): string
    {
        return '.hero-wrapper { position: relative; overflow: hidden; }
.hero-title { animation: fadeInUp 0.8s ease-out; }
.hero-subtitle { animation: fadeInUp 1s ease-out; }
.hero-image { animation: fadeInRight 1.2s ease-out; }
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes fadeInRight {
    from { opacity: 0; transform: translateX(30px); }
    to { opacity: 1; transform: translateX(0); }
}';
    }

    private function getHeroBannerSchema(): array
    {
        return [
            'fields' => [
                ['name' => 'title', 'type' => 'text', 'label' => 'Title', 'required' => true],
                ['name' => 'subtitle', 'type' => 'textarea', 'label' => 'Subtitle'],
                ['name' => 'button1_text', 'type' => 'text', 'label' => 'Button 1 Text'],
                ['name' => 'button1_url', 'type' => 'text', 'label' => 'Button 1 URL'],
                ['name' => 'button2_text', 'type' => 'text', 'label' => 'Button 2 Text'],
                ['name' => 'button2_url', 'type' => 'text', 'label' => 'Button 2 URL'],
                ['name' => 'image', 'type' => 'image', 'label' => 'Hero Image', 'required' => true]
            ]
        ];
    }

    private function getHeroBannerTraits(): array
    {
        return [
            'traits' => [
                ['type' => 'text', 'label' => 'Title', 'name' => 'title', 'changeProp' => 1],
                ['type' => 'text', 'label' => 'Subtitle', 'name' => 'subtitle', 'changeProp' => 1],
                ['type' => 'text', 'label' => 'Button 1 Text', 'name' => 'button1_text', 'changeProp' => 1],
                ['type' => 'text', 'label' => 'Button 1 URL', 'name' => 'button1_url', 'changeProp' => 1],
                ['type' => 'text', 'label' => 'Button 2 Text', 'name' => 'button2_text', 'changeProp' => 1],
                ['type' => 'text', 'label' => 'Button 2 URL', 'name' => 'button2_url', 'changeProp' => 1]
            ]
        ];
    }

    private function getCarouselTemplate(): string
    {
        return '<div id="heroCarousel-{{block_id}}" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        {{#slides}}
        <button type="button" data-bs-target="#heroCarousel-{{block_id}}" data-bs-slide-to="{{@index}}" class="{{#if @first}}active{{/if}}" aria-label="Slide {{@index}}"></button>
        {{/slides}}
    </div>
    <div class="carousel-inner">
        {{#slides}}
        <div class="carousel-item {{#if @first}}active{{/if}}" style="background-image: url(\'{{image}}\'); background-size: cover; background-position: center; min-height: 500px;">
            <div class="carousel-caption">
                <h1>{{title}}</h1>
                <h5>{{subtitle}}</h5>
                <p>{{description}}</p>
                <a href="{{button_url}}" class="btn btn-danger">{{button_text}} <i class="fas fa-arrow-right ms-2"></i></a>
            </div>
        </div>
        {{/slides}}
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel-{{block_id}}" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel-{{block_id}}" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>';
    }

    private function getCarouselStyles(): string
    {
        return '.carousel-indicators button {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    margin: 0 5px;
}
.carousel-control-prev, .carousel-control-next {
    width: 50px;
    height: 50px;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0,0,0,0.3);
    border-radius: 50%;
}';
    }

    private function getCarouselSchema(): array
    {
        return [
            'fields' => [
                [
                    'name' => 'slides',
                    'type' => 'repeater',
                    'label' => 'Slides',
                    'fields' => [
                        ['name' => 'image', 'type' => 'image', 'label' => 'Image'],
                        ['name' => 'title', 'type' => 'text', 'label' => 'Title'],
                        ['name' => 'subtitle', 'type' => 'text', 'label' => 'Subtitle'],
                        ['name' => 'description', 'type' => 'textarea', 'label' => 'Description'],
                        ['name' => 'button_text', 'type' => 'text', 'label' => 'Button Text'],
                        ['name' => 'button_url', 'type' => 'text', 'label' => 'Button URL']
                    ]
                ]
            ]
        ];
    }

    private function getCarouselTraits(): array
    {
        return [
            'traits' => [
                ['type' => 'checkbox', 'label' => 'Auto Play', 'name' => 'autoplay', 'changeProp' => 1],
                ['type' => 'number', 'label' => 'Interval (ms)', 'name' => 'interval', 'min' => 1000, 'max' => 10000, 'changeProp' => 1],
                ['type' => 'button', 'label' => 'Add Slide', 'text' => '+ Add Slide', 'command' => 'add-carousel-slide'],
                ['type' => 'button', 'label' => 'Remove Slide', 'text' => '− Remove Slide', 'command' => 'remove-carousel-slide']
            ]
        ];
    }

    private function getDataTableTemplate(): string
    {
        return '<section class="data-table-section" style="padding: 60px 0;">
    <div class="container">
        <h2 class="table-title">{{table_title}}</h2>
        
        {{#show_search}}
        <div class="table-controls mb-3">
            <input type="text" class="form-control" placeholder="Search..." id="searchInput-{{block_id}}">
        </div>
        {{/show_search}}

        {{#show_filters}}
        <div class="table-filters mb-3">
            <select class="form-select" id="categoryFilter-{{block_id}}">
                <option value="">All Categories</option>
                {{#categories}}
                <option value="{{.}}">{{.}}</option>
                {{/categories}}
            </select>
        </div>
        {{/show_filters}}

        <div class="table-responsive">
            <table class="table table-striped" id="dataTable-{{block_id}}">
                <thead>
                    <tr>
                        {{#columns}}
                        <th>{{.}}</th>
                        {{/columns}}
                    </tr>
                </thead>
                <tbody>
                    {{#rows}}
                    <tr>
                        <td>{{name}}</td>
                        <td>{{category}}</td>
                        <td>{{year}}</td>
                        <td>{{size}}</td>
                        <td>
                            <button class="btn btn-sm btn-primary download-btn" data-file="{{file_url}}">
                                <i class="fas fa-download"></i> Download
                            </button>
                        </td>
                    </tr>
                    {{/rows}}
                </tbody>
            </table>
        </div>
    </div>
</section>';
    }

    private function getDataTableStyles(): string
    {
        return '.data-table-section { background: #f8f9fa; }
.table-controls { max-width: 300px; }
.table-filters { max-width: 200px; }
.download-btn { transition: all 0.3s ease; }
.download-btn:hover { transform: translateY(-2px); }';
    }

    private function getDataTableScripts(): string
    {
        return '$(document).ready(function() {
    // Search functionality
    $("#searchInput-{{block_id}}").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#dataTable-{{block_id}} tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    // Category filter
    $("#categoryFilter-{{block_id}}").on("change", function() {
        var value = $(this).val().toLowerCase();
        $("#dataTable-{{block_id}} tbody tr").filter(function() {
            $(this).toggle($(this).find("td:eq(1)").text().toLowerCase().indexOf(value) > -1)
        });
    });

    // Download button handler
    $(".download-btn").on("click", function() {
        var fileUrl = $(this).data("file");
        if(fileUrl) {
            window.open(fileUrl, "_blank");
        }
    });
});';
    }

    private function getDataTableSchema(): array
    {
        return [
            'fields' => [
                ['name' => 'table_title', 'type' => 'text', 'label' => 'Table Title'],
                ['name' => 'show_search', 'type' => 'checkbox', 'label' => 'Show Search'],
                ['name' => 'show_filters', 'type' => 'checkbox', 'label' => 'Show Filters'],
                ['name' => 'sortable', 'type' => 'checkbox', 'label' => 'Enable Sorting'],
                [
                    'name' => 'columns',
                    'type' => 'repeater',
                    'label' => 'Columns',
                    'fields' => [
                        ['name' => 'name', 'type' => 'text', 'label' => 'Column Name']
                    ]
                ],
                [
                    'name' => 'rows',
                    'type' => 'repeater',
                    'label' => 'Rows',
                    'fields' => [
                        ['name' => 'name', 'type' => 'text', 'label' => 'Name'],
                        ['name' => 'category', 'type' => 'text', 'label' => 'Category'],
                        ['name' => 'year', 'type' => 'number', 'label' => 'Year'],
                        ['name' => 'size', 'type' => 'text', 'label' => 'Size'],
                        ['name' => 'file_url', 'type' => 'text', 'label' => 'File URL']
                    ]
                ]
            ]
        ];
    }

    private function getDataTableTraits(): array
    {
        return [
            'traits' => [
                ['type' => 'text', 'label' => 'Table Title', 'name' => 'table_title', 'changeProp' => 1],
                ['type' => 'checkbox', 'label' => 'Show Search', 'name' => 'show_search', 'changeProp' => 1],
                ['type' => 'checkbox', 'label' => 'Show Filters', 'name' => 'show_filters', 'changeProp' => 1],
                ['type' => 'button', 'label' => 'Add Column', 'text' => '+ Add Column', 'command' => 'add-table-column'],
                ['type' => 'button', 'label' => 'Add Row', 'text' => '+ Add Row', 'command' => 'add-table-row']
            ]
        ];
    }

    private function getCoreValuesTemplate(): string
    {
        return '<section class="core-values-section" style="padding: 80px 0;">
    <div class="container">
        <h2 class="section-title" style="text-align: center; font-size: 36px; margin-bottom: 15px;">{{title}}</h2>
        <p class="section-subtitle" style="text-align: center; color: #666; margin-bottom: 50px;">{{subtitle}}</p>
        <div class="row justify-content-center">
            {{#values}}
            <div class="col-md-4 mb-4">
                <div class="core-card" style="background: #fff; padding: 40px 30px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); text-align: center; transition: transform 0.3s;">
                    <i class="{{icon}}" style="font-size: 48px; color: #bd2828; margin-bottom: 20px;"></i>
                    <h5 style="font-size: 22px; font-weight: 600; margin-bottom: 15px;">{{title}}</h5>
                    <p style="color: #666; line-height: 1.6;">{{description}}</p>
                </div>
            </div>
            {{/values}}
        </div>
    </div>
</section>';
    }

    private function getCoreValuesStyles(): string
    {
        return '.core-values-section { background: #f8f9fa; }
.core-card:hover { transform: translateY(-5px); }';
    }

    private function getCoreValuesSchema(): array
    {
        return [
            'fields' => [
                ['name' => 'title', 'type' => 'text', 'label' => 'Section Title'],
                ['name' => 'subtitle', 'type' => 'textarea', 'label' => 'Section Subtitle'],
                [
                    'name' => 'values',
                    'type' => 'repeater',
                    'label' => 'Values',
                    'fields' => [
                        ['name' => 'icon', 'type' => 'text', 'label' => 'Icon Class'],
                        ['name' => 'title', 'type' => 'text', 'label' => 'Value Title'],
                        ['name' => 'description', 'type' => 'textarea', 'label' => 'Description']
                    ]
                ]
            ]
        ];
    }

    private function getCoreValuesTraits(): array
    {
        return [
            'traits' => [
                ['type' => 'text', 'label' => 'Title', 'name' => 'title', 'changeProp' => 1],
                ['type' => 'text', 'label' => 'Subtitle', 'name' => 'subtitle', 'changeProp' => 1],
                ['type' => 'button', 'label' => 'Add Value', 'text' => '+ Add Value', 'command' => 'add-core-value']
            ]
        ];
    }

    private function getPricingTableTemplate(): string
    {
        return '<section style="padding: 80px 0; background: #f8f9fa;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 style="font-size: 36px; font-weight: bold;">{{section_title}}</h2>
            <p style="font-size: 18px; color: #666;">{{section_subtitle}}</p>
        </div>
        <div class="row gy-4">
            {{#plans}}
            <div class="col-lg-4">
                <div style="background: white; padding: 40px; border-radius: 10px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1); {{#featured}}border: 2px solid #bd2828;{{/featured}}">
                    {{#featured}}
                    <div style="position: absolute; top: -15px; left: 50%; transform: translateX(-50%); background: #bd2828; color: white; padding: 5px 20px; border-radius: 20px; font-size: 12px;">POPULAR</div>
                    {{/featured}}
                    <h3 style="font-size: 24px; margin-bottom: 10px;">{{name}}</h3>
                    <div style="font-size: 48px; font-weight: bold; margin: 20px 0;"><span style="font-size: 24px;">$</span>{{price}}<span style="font-size: 18px; color: #666;">{{period}}</span></div>
                    <ul style="list-style: none; padding: 0; margin: 30px 0;">
                        {{#features}}
                        <li style="margin: 15px 0;"><i class="fas fa-check" style="color: #10b981;"></i> {{.}}</li>
                        {{/features}}
                    </ul>
                    <a href="#" class="btn {{#featured}}btn-primary{{else}}btn-outline-primary{{/featured}}" style="padding: 10px 30px; width: 100%;">{{button_text}}</a>
                </div>
            </div>
            {{/plans}}
        </div>
    </div>
</section>';
    }

    private function getPricingTableStyles(): string
    {
        return '.pricing-card { transition: transform 0.3s ease; }
.pricing-card:hover { transform: translateY(-5px); }';
    }

    private function getPricingTableSchema(): array
    {
        return [
            'fields' => [
                ['name' => 'section_title', 'type' => 'text', 'label' => 'Section Title'],
                ['name' => 'section_subtitle', 'type' => 'textarea', 'label' => 'Section Subtitle'],
                [
                    'name' => 'plans',
                    'type' => 'repeater',
                    'label' => 'Plans',
                    'fields' => [
                        ['name' => 'name', 'type' => 'text', 'label' => 'Plan Name'],
                        ['name' => 'price', 'type' => 'number', 'label' => 'Price'],
                        ['name' => 'period', 'type' => 'text', 'label' => 'Period'],
                        ['name' => 'features', 'type' => 'repeater', 'label' => 'Features', 'fields' => [
                            ['name' => 'feature', 'type' => 'text', 'label' => 'Feature']
                        ]],
                        ['name' => 'button_text', 'type' => 'text', 'label' => 'Button Text'],
                        ['name' => 'featured', 'type' => 'checkbox', 'label' => 'Featured Plan']
                    ]
                ]
            ]
        ];
    }

    private function getPricingTableTraits(): array
    {
        return [
            'traits' => [
                ['type' => 'text', 'label' => 'Section Title', 'name' => 'section_title', 'changeProp' => 1],
                ['type' => 'text', 'label' => 'Section Subtitle', 'name' => 'section_subtitle', 'changeProp' => 1],
                ['type' => 'button', 'label' => 'Add Plan', 'text' => '+ Add Plan', 'command' => 'add-pricing-plan']
            ]
        ];
    }

    private function getContactFormTemplate(): string
    {
        return '<section class="contact-form-section" style="padding: 80px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-form-wrapper" style="background: white; padding: 40px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
                    <h2 style="text-align: center; margin-bottom: 10px;">{{form_title}}</h2>
                    <p style="text-align: center; color: #666; margin-bottom: 30px;">{{form_subtitle}}</p>
                    
                    <form id="contactForm-{{block_id}}">
                        {{#fields}}
                        <div class="mb-3">
                            <label for="{{name}}" class="form-label">{{label}}{{#required}} *{{/required}}</label>
                            {{#if_eq type "textarea"}}
                            <textarea class="form-control" id="{{name}}" name="{{name}}" rows="4" {{#required}}required{{/required}}></textarea>
                            {{else}}
                            <input type="{{type}}" class="form-control" id="{{name}}" name="{{name}}" {{#required}}required{{/required}}>
                            {{/if_eq}}
                        </div>
                        {{/fields}}
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg" style="padding: 12px 40px;">
                                {{submit_button_text}}
                            </button>
                        </div>
                    </form>
                    
                    <div id="formMessage-{{block_id}}" style="display: none; margin-top: 20px;"></div>
                </div>
            </div>
        </div>
    </div>
</section>';
    }

    private function getContactFormStyles(): string
    {
        return '.contact-form-section { background: #f8f9fa; }
.form-control { border-radius: 8px; padding: 12px; }
.btn-primary { background: #3498db; border: none; border-radius: 8px; }';
    }

    private function getContactFormScripts(): string
    {
        return '$(document).ready(function() {
    $("#contactForm-{{block_id}}").on("submit", function(e) {
        e.preventDefault();
        
        var formData = $(this).serialize();
        var submitUrl = "{{action_settings.submit_url}}";
        
        $.ajax({
            url: submitUrl,
            type: "POST",
            data: formData,
            success: function(response) {
                $("#formMessage-{{block_id}}").removeClass("alert-danger").addClass("alert-success")
                    .text("{{action_settings.success_message}}").show();
                $("#contactForm-{{block_id}}")[0].reset();
            },
            error: function() {
                $("#formMessage-{{block_id}}").removeClass("alert-success").addClass("alert-danger")
                    .text("{{action_settings.error_message}}").show();
            }
        });
    });
});';
    }

    private function getContactFormSchema(): array
    {
        return [
            'fields' => [
                ['name' => 'form_title', 'type' => 'text', 'label' => 'Form Title'],
                ['name' => 'form_subtitle', 'type' => 'textarea', 'label' => 'Form Subtitle'],
                ['name' => 'submit_button_text', 'type' => 'text', 'label' => 'Submit Button Text'],
                [
                    'name' => 'fields',
                    'type' => 'repeater',
                    'label' => 'Form Fields',
                    'fields' => [
                        ['name' => 'type', 'type' => 'select', 'label' => 'Field Type', 'options' => ['text', 'email', 'tel', 'textarea']],
                        ['name' => 'name', 'type' => 'text', 'label' => 'Field Name'],
                        ['name' => 'label', 'type' => 'text', 'label' => 'Field Label'],
                        ['name' => 'required', 'type' => 'checkbox', 'label' => 'Required']
                    ]
                ]
            ]
        ];
    }

    private function getContactFormTraits(): array
    {
        return [
            'traits' => [
                ['type' => 'text', 'label' => 'Form Title', 'name' => 'form_title', 'changeProp' => 1],
                ['type' => 'text', 'label' => 'Form Subtitle', 'name' => 'form_subtitle', 'changeProp' => 1],
                ['type' => 'text', 'label' => 'Submit Button Text', 'name' => 'submit_button_text', 'changeProp' => 1],
                ['type' => 'button', 'label' => 'Add Field', 'text' => '+ Add Field', 'command' => 'add-form-field']
            ]
        ];
    }

    private function getFeaturesTemplate(): string
    {
        return '<section style="padding: 80px 0;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 style="font-size: 36px; font-weight: bold;">{{section_title}}</h2>
            <p style="font-size: 18px; color: #666;">{{section_subtitle}}</p>
        </div>
        <div class="row gy-4">
            {{#features}}
            <div class="col-md-4 text-center">
                <div style="padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <i class="{{icon}} fa-3x mb-3" style="color: #667eea;"></i>
                    <h3 style="font-size: 24px; margin-bottom: 15px;">{{title}}</h3>
                    <p style="color: #666;">{{description}}</p>
                </div>
            </div>
            {{/features}}
        </div>
    </div>
</section>';
    }

    private function getFeaturesStyles(): string
    {
        return '.feature-card { transition: transform 0.3s ease; }
.feature-card:hover { transform: translateY(-5px); }';
    }

    private function getFeaturesSchema(): array
    {
        return [
            'fields' => [
                ['name' => 'section_title', 'type' => 'text', 'label' => 'Section Title'],
                ['name' => 'section_subtitle', 'type' => 'textarea', 'label' => 'Section Subtitle'],
                [
                    'name' => 'features',
                    'type' => 'repeater',
                    'label' => 'Features',
                    'fields' => [
                        ['name' => 'icon', 'type' => 'text', 'label' => 'Icon Class'],
                        ['name' => 'title', 'type' => 'text', 'label' => 'Feature Title'],
                        ['name' => 'description', 'type' => 'textarea', 'label' => 'Description']
                    ]
                ]
            ]
        ];
    }

    private function getFeaturesTraits(): array
    {
        return [
            'traits' => [
                ['type' => 'text', 'label' => 'Section Title', 'name' => 'section_title', 'changeProp' => 1],
                ['type' => 'text', 'label' => 'Section Subtitle', 'name' => 'section_subtitle', 'changeProp' => 1],
                ['type' => 'button', 'label' => 'Add Feature', 'text' => '+ Add Feature', 'command' => 'add-feature']
            ]
        ];
    }

    private function getTeamGridTemplate(): string
    {
        return '<section style="padding: 80px 0; background: white;">
    <div class="container">
        <h1 style="text-align: center; font-size: 36px; margin-bottom: 15px;">{{section_title}}</h1>
        <p style="text-align: center; color: #666; margin-bottom: 50px;">{{section_subtitle}}</p>
        <div class="row">
            {{#members}}
            <div class="col-md-4">
                <div class="profile-card-unique" style="background: white; padding: 30px; border-radius: 10px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1); margin-bottom: 30px;">
                    <div class="icon-wrapper" style="margin-bottom: 20px;">
                        <div class="icon-circle" style="width: 100px; height: 100px; border-radius: 50%; background: linear-gradient(135deg, #bd2828, #8b1c1c); display: inline-flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user" style="font-size: 40px; color: white;"></i>
                        </div>
                    </div>
                    <h3 style="font-size: 22px; margin-bottom: 10px;">{{name}}</h3>
                    <p class="title" style="color: #bd2828; font-weight: 600; margin-bottom: 20px;">{{position}}</p>
                    <hr style="border-color: #eee; margin: 20px 0;">
                    <div class="contact-info" style="text-align: left;">
                        <div style="padding: 8px 0;"><i class="fas fa-envelope" style="color: #bd2828; margin-right: 10px;"></i> {{email}}</div>
                        <div style="padding: 8px 0;"><i class="fas fa-phone" style="color: #bd2828; margin-right: 10px;"></i> {{phone}}</div>
                    </div>
                    {{#show_social}}
                    <div class="social-links mt-3">
                        {{#social_links}}
                        <a href="{{url}}" style="color: #bd2828; margin: 0 5px;"><i class="{{icon}}"></i></a>
                        {{/social_links}}
                    </div>
                    {{/show_social}}
                </div>
            </div>
            {{/members}}
        </div>
    </div>
</section>';
    }

    private function getTeamGridStyles(): string
    {
        return '.profile-card-unique { transition: transform 0.3s ease; }
.profile-card-unique:hover { transform: translateY(-5px); }
.social-links a { transition: color 0.3s ease; }
.social-links a:hover { color: #8b1c1c !important; }';
    }

    private function getTeamGridSchema(): array
    {
        return [
            'fields' => [
                ['name' => 'section_title', 'type' => 'text', 'label' => 'Section Title'],
                ['name' => 'section_subtitle', 'type' => 'textarea', 'label' => 'Section Subtitle'],
                ['name' => 'show_social', 'type' => 'checkbox', 'label' => 'Show Social Links'],
                [
                    'name' => 'members',
                    'type' => 'repeater',
                    'label' => 'Team Members',
                    'fields' => [
                        ['name' => 'name', 'type' => 'text', 'label' => 'Name'],
                        ['name' => 'position', 'type' => 'text', 'label' => 'Position'],
                        ['name' => 'email', 'type' => 'email', 'label' => 'Email'],
                        ['name' => 'phone', 'type' => 'tel', 'label' => 'Phone'],
                        [
                            'name' => 'social_links',
                            'type' => 'repeater',
                            'label' => 'Social Links',
                            'fields' => [
                                ['name' => 'icon', 'type' => 'text', 'label' => 'Icon Class'],
                                ['name' => 'url', 'type' => 'text', 'label' => 'URL']
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    private function getTeamGridTraits(): array
    {
        return [
            'traits' => [
                ['type' => 'text', 'label' => 'Section Title', 'name' => 'section_title', 'changeProp' => 1],
                ['type' => 'text', 'label' => 'Section Subtitle', 'name' => 'section_subtitle', 'changeProp' => 1],
                ['type' => 'checkbox', 'label' => 'Show Social Links', 'name' => 'show_social', 'changeProp' => 1],
                ['type' => 'button', 'label' => 'Add Member', 'text' => '+ Add Member', 'command' => 'add-team-member']
            ]
        ];
    }

    private function getCTATemplate(): string
    {
        return '<section style="padding: 80px 0; background: #1f2937; color: white; text-align: center;">
    <div class="container">
        <h2 style="font-size: 42px; margin-bottom: 20px; font-weight: bold;">{{title}}</h2>
        <p style="font-size: 20px; margin-bottom: 30px; color: #d1d5db;">{{subtitle}}</p>
        <a href="{{button1_url}}" class="btn btn-primary btn-lg me-2" style="padding: 15px 40px;">{{button1_text}}</a>
        <a href="{{button2_url}}" class="btn btn-outline-light btn-lg" style="padding: 15px 40px;">{{button2_text}}</a>
    </div>
</section>';
    }

    private function getCTAStyles(): string
    {
        return '.cta-section { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
.btn-primary { background: #bd2828; border: none; }
.btn-primary:hover { background: #8b1c1c; }';
    }

    private function getCTASchema(): array
    {
        return [
            'fields' => [
                ['name' => 'title', 'type' => 'text', 'label' => 'Title'],
                ['name' => 'subtitle', 'type' => 'textarea', 'label' => 'Subtitle'],
                ['name' => 'button1_text', 'type' => 'text', 'label' => 'Button 1 Text'],
                ['name' => 'button1_url', 'type' => 'text', 'label' => 'Button 1 URL'],
                ['name' => 'button2_text', 'type' => 'text', 'label' => 'Button 2 Text'],
                ['name' => 'button2_url', 'type' => 'text', 'label' => 'Button 2 URL']
            ]
        ];
    }

    private function getCTATraits(): array
    {
        return [
            'traits' => [
                ['type' => 'text', 'label' => 'Title', 'name' => 'title', 'changeProp' => 1],
                ['type' => 'text', 'label' => 'Subtitle', 'name' => 'subtitle', 'changeProp' => 1],
                ['type' => 'text', 'label' => 'Button 1 Text', 'name' => 'button1_text', 'changeProp' => 1],
                ['type' => 'text', 'label' => 'Button 1 URL', 'name' => 'button1_url', 'changeProp' => 1],
                ['type' => 'text', 'label' => 'Button 2 Text', 'name' => 'button2_text', 'changeProp' => 1],
                ['type' => 'text', 'label' => 'Button 2 URL', 'name' => 'button2_url', 'changeProp' => 1]
            ]
        ];
    }

    private function getFooterTemplate(): string
    {
        return '<footer style="background: #1f2937; color: white; padding: 60px 0 30px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <h3 style="font-size: 24px; margin-bottom: 20px;">{{brand_name}}</h3>
                <p style="color: #d1d5db; margin-bottom: 20px;">{{brand_description}}</p>
                <div>
                    {{#social_links}}
                    <a href="{{url}}" style="color: white; margin-right: 15px; font-size: 20px;"><i class="{{icon}}"></i></a>
                    {{/social_links}}
                </div>
            </div>
            <div class="col-lg-2 col-md-6 mb-4">
                <h4 style="font-size: 18px; margin-bottom: 20px;">Company</h4>
                <ul style="list-style: none; padding: 0;">
                    <li style="margin-bottom: 10px;"><a href="#" style="color: #d1d5db; text-decoration: none;">About</a></li>
                    <li style="margin-bottom: 10px;"><a href="#" style="color: #d1d5db; text-decoration: none;">Careers</a></li>
                    <li style="margin-bottom: 10px;"><a href="#" style="color: #d1d5db; text-decoration: none;">Blog</a></li>
                    <li><a href="#" style="color: #d1d5db; text-decoration: none;">Contact</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6 mb-4">
                <h4 style="font-size: 18px; margin-bottom: 20px;">Product</h4>
                <ul style="list-style: none; padding: 0;">
                    <li style="margin-bottom: 10px;"><a href="#" style="color: #d1d5db; text-decoration: none;">Features</a></li>
                    <li style="margin-bottom: 10px;"><a href="#" style="color: #d1d5db; text-decoration: none;">Pricing</a></li>
                    <li style="margin-bottom: 10px;"><a href="#" style="color: #d1d5db; text-decoration: none;">Security</a></li>
                    <li><a href="#" style="color: #d1d5db; text-decoration: none;">FAQ</a></li>
                </ul>
            </div>
            {{#show_newsletter}}
            <div class="col-lg-4 mb-4">
                <h4 style="font-size: 18px; margin-bottom: 20px;">Newsletter</h4>
                <p style="color: #d1d5db; margin-bottom: 15px;">Subscribe to get updates</p>
                <form style="display: flex; margin-bottom: 15px;">
                    <input type="email" placeholder="Your email" style="flex: 1; padding: 10px; border: none; border-radius: 5px 0 0 5px;">
                    <button type="submit" style="padding: 10px 20px; background: #bd2828; color: white; border: none; border-radius: 0 5px 5px 0; cursor: pointer;">Subscribe</button>
                </form>
            </div>
            {{/show_newsletter}}
        </div>
        <hr style="border-color: #374151; margin: 30px 0;">
        <div class="text-center" style="color: #9ca3af;">
            <p>{{copyright_text}}</p>
        </div>
    </div>
</footer>';
    }

    private function getFooterStyles(): string
    {
        return 'footer a { transition: color 0.3s ease; }
footer a:hover { color: #bd2828 !important; }';
    }

    private function getFooterSchema(): array
    {
        return [
            'fields' => [
                ['name' => 'brand_name', 'type' => 'text', 'label' => 'Brand Name'],
                ['name' => 'brand_description', 'type' => 'textarea', 'label' => 'Brand Description'],
                ['name' => 'copyright_text', 'type' => 'text', 'label' => 'Copyright Text'],
                ['name' => 'show_newsletter', 'type' => 'checkbox', 'label' => 'Show Newsletter'],
                [
                    'name' => 'social_links',
                    'type' => 'repeater',
                    'label' => 'Social Links',
                    'fields' => [
                        ['name' => 'icon', 'type' => 'text', 'label' => 'Icon Class'],
                        ['name' => 'url', 'type' => 'text', 'label' => 'URL']
                    ]
                ]
            ]
        ];
    }

    private function getFooterTraits(): array
    {
        return [
            'traits' => [
                ['type' => 'text', 'label' => 'Brand Name', 'name' => 'brand_name', 'changeProp' => 1],
                ['type' => 'text', 'label' => 'Brand Description', 'name' => 'brand_description', 'changeProp' => 1],
                ['type' => 'text', 'label' => 'Copyright Text', 'name' => 'copyright_text', 'changeProp' => 1],
                ['type' => 'checkbox', 'label' => 'Show Newsletter', 'name' => 'show_newsletter', 'changeProp' => 1],
                ['type' => 'button', 'label' => 'Add Social Link', 'text' => '+ Add Social Link', 'command' => 'add-social-link']
            ]
        ];
    }
}