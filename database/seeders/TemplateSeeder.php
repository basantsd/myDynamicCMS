<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $htmlPath = database_path('seeders/pages_html/');

        // Define template metadata
        $templates = [
            'home.html' => [
                'name' => 'Complete Homepage',
                'slug' => 'homepage-template',
                'description' => 'Full homepage with hero carousel, core values, quick access sections',
                'category' => 'home',
                'thumbnail' => '/assets/img/templates/home.jpg',
                'sort_order' => 1,
            ],
            'about.html' => [
                'name' => 'About Us Page',
                'slug' => 'about-template',
                'description' => 'Complete about page with mission, vision, team, mandate',
                'category' => 'about',
                'thumbnail' => '/assets/img/templates/about.jpg',
                'sort_order' => 2,
            ],
            'contact.html' => [
                'name' => 'Contact Page',
                'slug' => 'contact-template',
                'description' => 'Contact page with information cards and contact details',
                'category' => 'contact',
                'thumbnail' => '/assets/img/templates/contact.jpg',
                'sort_order' => 3,
            ],
            'team.html' => [
                'name' => 'Team Page',
                'slug' => 'team-template',
                'description' => 'Team members with profiles and contact information',
                'category' => 'about',
                'thumbnail' => '/assets/img/templates/team.jpg',
                'sort_order' => 4,
            ],
            'divisions.html' => [
                'name' => 'Divisions Page',
                'slug' => 'divisions-template',
                'description' => 'Organizational divisions and departments',
                'category' => 'general',
                'thumbnail' => '/assets/img/templates/divisions.jpg',
                'sort_order' => 5,
            ],
            'financial-reports.html' => [
                'name' => 'Financial Reports',
                'slug' => 'financial-reports-template',
                'description' => 'Financial reports and documents listing',
                'category' => 'reports',
                'thumbnail' => '/assets/img/templates/reports.jpg',
                'sort_order' => 6,
            ],
            'debt-reports.html' => [
                'name' => 'Debt Reports',
                'slug' => 'debt-reports-template',
                'description' => 'Debt management reports and information',
                'category' => 'reports',
                'thumbnail' => '/assets/img/templates/debt.jpg',
                'sort_order' => 7,
            ],
            'download.html' => [
                'name' => 'Downloads Center',
                'slug' => 'downloads-template',
                'description' => 'Document downloads and resources center',
                'category' => 'general',
                'thumbnail' => '/assets/img/templates/downloads.jpg',
                'sort_order' => 8,
            ],
            'treasury-news.html' => [
                'name' => 'News & Updates',
                'slug' => 'news-template',
                'description' => 'Latest news and announcements',
                'category' => 'blog',
                'thumbnail' => '/assets/img/templates/news.jpg',
                'sort_order' => 9,
            ],
            'public-notices.html' => [
                'name' => 'Public Notices',
                'slug' => 'public-notices-template',
                'description' => 'Official public notices and announcements',
                'category' => 'general',
                'thumbnail' => '/assets/img/templates/notices.jpg',
                'sort_order' => 10,
            ],
            'treasury-circulars.html' => [
                'name' => 'Treasury Circulars',
                'slug' => 'circulars-template',
                'description' => 'Treasury circulars and official communications',
                'category' => 'general',
                'thumbnail' => '/assets/img/templates/circulars.jpg',
                'sort_order' => 11,
            ],
            'annual-budget.html' => [
                'name' => 'Annual Budget',
                'slug' => 'budget-template',
                'description' => 'Annual budget information and documents',
                'category' => 'reports',
                'thumbnail' => '/assets/img/templates/budget.jpg',
                'sort_order' => 12,
            ],
            'estimates.html' => [
                'name' => 'Estimates',
                'slug' => 'estimates-template',
                'description' => 'Budget estimates and projections',
                'category' => 'reports',
                'thumbnail' => '/assets/img/templates/estimates.jpg',
                'sort_order' => 13,
            ],
            'audited-statements.html' => [
                'name' => 'Audited Statements',
                'slug' => 'audited-statements-template',
                'description' => 'Audited financial statements',
                'category' => 'reports',
                'thumbnail' => '/assets/img/templates/audited.jpg',
                'sort_order' => 14,
            ],
            'debt-overview.html' => [
                'name' => 'Debt Overview',
                'slug' => 'debt-overview-template',
                'description' => 'Overview of government debt',
                'category' => 'reports',
                'thumbnail' => '/assets/img/templates/debt-overview.jpg',
                'sort_order' => 15,
            ],
            'government-guarantees.html' => [
                'name' => 'Government Guarantees',
                'slug' => 'guarantees-template',
                'description' => 'Government guarantees information',
                'category' => 'general',
                'thumbnail' => '/assets/img/templates/guarantees.jpg',
                'sort_order' => 16,
            ],
            'government-payroll.html' => [
                'name' => 'Government Payroll',
                'slug' => 'payroll-template',
                'description' => 'Payroll services and information',
                'category' => 'services',
                'thumbnail' => '/assets/img/templates/payroll.jpg',
                'sort_order' => 17,
            ],
            'pension-services.html' => [
                'name' => 'Pension Services',
                'slug' => 'pension-template',
                'description' => 'Pension services and benefits information',
                'category' => 'services',
                'thumbnail' => '/assets/img/templates/pension.jpg',
                'sort_order' => 18,
            ],
            'investment-services.html' => [
                'name' => 'Investment Services',
                'slug' => 'investment-template',
                'description' => 'Investment services and opportunities',
                'category' => 'services',
                'thumbnail' => '/assets/img/templates/investment.jpg',
                'sort_order' => 19,
            ],
            'cash-collection.html' => [
                'name' => 'Cash Collection',
                'slug' => 'cash-collection-template',
                'description' => 'Cash collection services and centers',
                'category' => 'services',
                'thumbnail' => '/assets/img/templates/cash.jpg',
                'sort_order' => 20,
            ],
        ];

        // Add blank template
        Template::create([
            'name' => 'Blank Page',
            'slug' => 'blank-page',
            'description' => 'Start from scratch with a clean slate',
            'thumbnail' => '/assets/img/templates/blank.jpg',
            'category' => 'general',
            'html_content' => '<div class="container" style="padding: 40px 20px;"><div class="row"><div class="col-12 text-center"><h1>Start Building</h1><p>Drag blocks from the left panel to create your page</p></div></div></div>',
            'is_active' => true,
            'sort_order' => 0,
        ]);

        // Create templates from HTML files
        foreach ($templates as $filename => $metadata) {
            $filePath = $htmlPath . $filename;

            if (File::exists($filePath)) {
                $htmlContent = File::get($filePath);

                // Replace color #667eea with #9d141f (primary color)
                $htmlContent = str_replace('#667eea', '#9d141f', $htmlContent);
                $htmlContent = str_replace('667eea', '9d141f', $htmlContent);

                Template::create([
                    'name' => $metadata['name'],
                    'slug' => $metadata['slug'],
                    'description' => $metadata['description'],
                    'thumbnail' => $metadata['thumbnail'],
                    'category' => $metadata['category'],
                    'html_content' => $htmlContent,
                    'is_active' => true,
                    'sort_order' => $metadata['sort_order'],
                ]);

                echo "✅ Created template: {$metadata['name']}\n";
            } else {
                echo "❌ File not found: {$filename}\n";
            }
        }
    }
}
