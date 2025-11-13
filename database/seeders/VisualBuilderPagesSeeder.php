<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageSection;
use App\Models\User;
use Illuminate\Database\Seeder;

class VisualBuilderPagesSeeder extends Seeder
{
    /**
     * Creates ALL pages with complete Visual Builder HTML content
     * This seeder populates builder_html and builder_css for visual page builder
     * Run: php artisan db:seed --class=VisualBuilderPagesSeeder
     */
    public function run(): void
    {
        $this->command->info('🚀 Starting Visual Builder Pages Seeder...');

        // Clear existing pages if needed (optional - comment out if you want to keep existing)
        // PageSection::query()->delete();
        // Page::query()->delete();

        $user = User::first();

        if (!$user) {
            $this->command->error('❌ No users found! Please run UserSeeder first.');
            return;
        }

        // Common CSS for all pages
        $commonCSS = $this->getCommonCSS();

        // Create all pages
        $pages = [
            // ========== HOME PAGE ==========
            [
                'title' => 'Home',
                'slug' => 'home',
                'template' => 'treasury',
                'meta_description' => 'Accountant General\'s Department - Government of St. Kitts and Nevis. Serving the people with transparency, professionalism, and confidentiality.',
                'meta_keywords' => 'accountant general, st kitts nevis, government, treasury, financial management',
                'is_published' => true,
                'use_builder' => true,
                'created_by' => $user->id,
                'builder_html' => $this->getHomePageHTML(),
                'builder_css' => $commonCSS,
            ],

            // ========== ABOUT US PAGE ==========
            [
                'title' => 'About Us',
                'slug' => 'about',
                'template' => 'treasury',
                'meta_description' => 'Learn about the Accountant General\'s Department, our mission, vision, and values',
                'meta_keywords' => 'about, accountant general, mission, vision',
                'is_published' => true,
                'use_builder' => true,
                'created_by' => $user->id,
                'builder_html' => $this->getAboutPageHTML(),
                'builder_css' => $commonCSS,
            ],

            // ========== DIVISIONS & UNITS PAGE ==========
            [
                'title' => 'Divisions & Units',
                'slug' => 'divisions',
                'template' => 'treasury',
                'meta_description' => 'Our divisions and organizational structure',
                'meta_keywords' => 'divisions, departments, structure',
                'is_published' => true,
                'use_builder' => true,
                'created_by' => $user->id,
                'builder_html' => $this->getDivisionsPageHTML(),
                'builder_css' => $commonCSS,
            ],

            // ========== TEAM PAGE ==========
            [
                'title' => 'Management Team',
                'slug' => 'team',
                'template' => 'treasury',
                'meta_description' => 'Meet our management team and leadership',
                'meta_keywords' => 'team, management, leadership',
                'is_published' => true,
                'use_builder' => true,
                'created_by' => $user->id,
                'builder_html' => $this->getTeamPageHTML(),
                'builder_css' => $commonCSS,
            ],

            // ========== FINANCIAL REPORTS ==========
            [
                'title' => 'Financial Reports',
                'slug' => 'financial-reports',
                'template' => 'treasury',
                'meta_description' => 'Access government financial reports, budgets, and statements',
                'is_published' => true,
                'use_builder' => true,
                'created_by' => $user->id,
                'builder_html' => $this->getFinancialReportsPageHTML(),
                'builder_css' => $commonCSS,
            ],

            // ========== ANNUAL BUDGET ==========
            [
                'title' => 'Annual Budget',
                'slug' => 'annual-budget',
                'template' => 'treasury',
                'meta_description' => 'Annual budget documents and information',
                'is_published' => true,
                'use_builder' => true,
                'created_by' => $user->id,
                'builder_html' => $this->getAnnualBudgetPageHTML(),
                'builder_css' => $commonCSS,
            ],

            // ========== ESTIMATES ==========
            [
                'title' => 'Estimates of Revenue & Expenditure',
                'slug' => 'estimates',
                'template' => 'treasury',
                'meta_description' => 'Government revenue and expenditure estimates',
                'is_published' => true,
                'use_builder' => true,
                'created_by' => $user->id,
                'builder_html' => $this->getEstimatesPageHTML(),
                'builder_css' => $commonCSS,
            ],

            // ========== AUDITED STATEMENTS ==========
            [
                'title' => 'Audited Financial Statements',
                'slug' => 'audited-financial-statements',
                'template' => 'treasury',
                'meta_description' => 'Audited financial statements of the Government',
                'is_published' => true,
                'use_builder' => true,
                'created_by' => $user->id,
                'builder_html' => $this->getAuditedStatementsPageHTML(),
                'builder_css' => $commonCSS,
            ],

            // ========== TREASURY CIRCULARS ==========
            [
                'title' => 'Treasury Circulars',
                'slug' => 'treasury-circulars',
                'template' => 'treasury',
                'meta_description' => 'Treasury circulars and directives',
                'is_published' => true,
                'use_builder' => true,
                'created_by' => $user->id,
                'builder_html' => $this->getTreasuryCircularsPageHTML(),
                'builder_css' => $commonCSS,
            ],

            // ========== DEBT OVERVIEW ==========
            [
                'title' => 'Debt Overview',
                'slug' => 'debt-overview',
                'template' => 'treasury',
                'meta_description' => 'Overview of government debt position',
                'is_published' => true,
                'use_builder' => true,
                'created_by' => $user->id,
                'builder_html' => $this->getDebtOverviewPageHTML(),
                'builder_css' => $commonCSS,
            ],

            // ========== DEBT REPORTS ==========
            [
                'title' => 'Domestic & External Debt Reports',
                'slug' => 'domestic-external-debt-reports',
                'template' => 'treasury',
                'meta_description' => 'Domestic and external debt reports and statistics',
                'is_published' => true,
                'use_builder' => true,
                'created_by' => $user->id,
                'builder_html' => $this->getDebtReportsPageHTML(),
                'builder_css' => $commonCSS,
            ],

            // ========== GOVERNMENT GUARANTEES ==========
            [
                'title' => 'Government Guarantees',
                'slug' => 'government-guarantees',
                'template' => 'treasury',
                'meta_description' => 'Information on government guarantees',
                'is_published' => true,
                'use_builder' => true,
                'created_by' => $user->id,
                'builder_html' => $this->getGovernmentGuaranteesPageHTML(),
                'builder_css' => $commonCSS,
            ],

            // ========== PENSION SERVICES ==========
            [
                'title' => 'Pension Services',
                'slug' => 'pension-services',
                'template' => 'treasury',
                'meta_description' => 'Government pension services and information',
                'is_published' => true,
                'use_builder' => true,
                'created_by' => $user->id,
                'builder_html' => $this->getPensionServicesPageHTML(),
                'builder_css' => $commonCSS,
            ],

            // ========== GOVERNMENT PAYROLL ==========
            [
                'title' => 'Government Payroll Services',
                'slug' => 'government-payroll-services',
                'template' => 'treasury',
                'meta_description' => 'Government employee payroll information',
                'is_published' => true,
                'use_builder' => true,
                'created_by' => $user->id,
                'builder_html' => $this->getGovernmentPayrollPageHTML(),
                'builder_css' => $commonCSS,
            ],

            // ========== INVESTMENT SERVICES ==========
            [
                'title' => 'Investment Services',
                'slug' => 'investment-services',
                'template' => 'treasury',
                'meta_description' => 'Government investment services including Treasury Bills and Savings Bank',
                'is_published' => true,
                'use_builder' => true,
                'created_by' => $user->id,
                'builder_html' => $this->getInvestmentServicesPageHTML(),
                'builder_css' => $commonCSS,
            ],

            // ========== CASH COLLECTION ==========
            [
                'title' => 'Cash Collection',
                'slug' => 'cash-collection',
                'template' => 'treasury',
                'meta_description' => 'Cash collection services and procedures',
                'is_published' => true,
                'use_builder' => true,
                'created_by' => $user->id,
                'builder_html' => $this->getCashCollectionPageHTML(),
                'builder_css' => $commonCSS,
            ],

            // ========== TREASURY NEWS ==========
            [
                'title' => 'Treasury News',
                'slug' => 'treasury-news',
                'template' => 'treasury',
                'meta_description' => 'Latest news and announcements from the Treasury',
                'is_published' => true,
                'use_builder' => true,
                'created_by' => $user->id,
                'builder_html' => $this->getTreasuryNewsPageHTML(),
                'builder_css' => $commonCSS,
            ],

            // ========== PUBLIC NOTICES ==========
            [
                'title' => 'Public Notices',
                'slug' => 'public-notices',
                'template' => 'treasury',
                'meta_description' => 'Important public notices and announcements',
                'is_published' => true,
                'use_builder' => true,
                'created_by' => $user->id,
                'builder_html' => $this->getPublicNoticesPageHTML(),
                'builder_css' => $commonCSS,
            ],

            // ========== DOWNLOADS ==========
            [
                'title' => 'Downloads',
                'slug' => 'download',
                'template' => 'treasury',
                'meta_description' => 'Download forms, documents, and resources',
                'meta_keywords' => 'downloads, forms, documents',
                'is_published' => true,
                'use_builder' => true,
                'created_by' => $user->id,
                'builder_html' => $this->getDownloadPageHTML(),
                'builder_css' => $commonCSS,
            ],

            // ========== CONTACT ==========
            [
                'title' => 'Contact Us',
                'slug' => 'contact',
                'template' => 'treasury',
                'meta_description' => 'Contact the Accountant General\'s Department',
                'meta_keywords' => 'contact, address, phone, email',
                'is_published' => true,
                'use_builder' => true,
                'created_by' => $user->id,
                'builder_html' => $this->getContactPageHTML(),
                'builder_css' => $commonCSS,
            ],
        ];

        $this->command->info('📝 Creating ' . count($pages) . ' pages...');

        foreach ($pages as $pageData) {
            Page::updateOrCreate(
                ['slug' => $pageData['slug']],
                $pageData
            );
            $this->command->info('  ✓ ' . $pageData['title']);
        }

        $this->command->info('✅ Successfully created/updated all Visual Builder pages!');
        $this->command->info('🎨 All pages are now editable in the Visual Page Builder');
    }

    // ==================== COMMON CSS ====================
    private function getCommonCSS(): string
    {
        return '/* Common Treasury Page Styles */
.carousel-item { transition: transform 0.6s ease-in-out; min-height: 500px; }
.carousel-caption { background: rgba(0,0,0,0.6); padding: 30px; border-radius: 10px; }
.core-card, .division-box, .quick-card, .service-box, .news-card, .notice-card, .download-item, .contact-info-box {
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    transition: all 0.3s;
    background: white;
}
.core-card:hover, .division-box:hover, .quick-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    border-color: #007bff;
}
.section-title { font-size: 2.5rem; font-weight: 700; color: #333; margin-bottom: 1rem; }
.section-subtitle { font-size: 1.1rem; color: #666; margin-bottom: 2rem; }
.mission-text { font-size: 1.1rem; max-width: 900px; margin: 0 auto; line-height: 1.8; color: #555; }
.profile-img-wrapper { width: 150px; height: 150px; margin: 0 auto; border-radius: 50%; overflow: hidden; border: 3px solid #007bff; }
.profile-img-wrapper img { width: 100%; height: 100%; object-fit: cover; }
.news-date { color: #666; font-size: 14px; margin-bottom: 10px; }
.notice-badge { display: inline-block; padding: 4px 12px; border-radius: 4px; font-size: 12px; font-weight: 600; color: white; margin-bottom: 10px; }
.notice-badge.important { background: #dc3545; }
.notice-badge.notice { background: #17a2b8; }
.download-category { margin-bottom: 30px; }
.btn-red { background: #dc3545; color: white; border: none; padding: 12px 30px; border-radius: 5px; }
.btn-red:hover { background: #c82333; color: white; }';
    }

    // ==================== PAGE HTML METHODS ====================

    private function getHomePageHTML(): string
    {
        return file_get_contents(database_path('seeders/pages_html/home.html'));
    }

    private function getAboutPageHTML(): string
    {
        return file_get_contents(database_path('seeders/pages_html/about.html'));
    }

    private function getDivisionsPageHTML(): string
    {
        return file_get_contents(database_path('seeders/pages_html/divisions.html'));
    }

    private function getTeamPageHTML(): string
    {
        return file_get_contents(database_path('seeders/pages_html/team.html'));
    }

    private function getFinancialReportsPageHTML(): string
    {
        return file_get_contents(database_path('seeders/pages_html/financial-reports.html'));
    }

    private function getAnnualBudgetPageHTML(): string
    {
        return file_get_contents(database_path('seeders/pages_html/annual-budget.html'));
    }

    private function getEstimatesPageHTML(): string
    {
        return file_get_contents(database_path('seeders/pages_html/estimates.html'));
    }

    private function getAuditedStatementsPageHTML(): string
    {
        return file_get_contents(database_path('seeders/pages_html/audited-statements.html'));
    }

    private function getTreasuryCircularsPageHTML(): string
    {
        return file_get_contents(database_path('seeders/pages_html/treasury-circulars.html'));
    }

    private function getDebtOverviewPageHTML(): string
    {
        return file_get_contents(database_path('seeders/pages_html/debt-overview.html'));
    }

    private function getDebtReportsPageHTML(): string
    {
        return file_get_contents(database_path('seeders/pages_html/debt-reports.html'));
    }

    private function getGovernmentGuaranteesPageHTML(): string
    {
        return file_get_contents(database_path('seeders/pages_html/government-guarantees.html'));
    }

    private function getPensionServicesPageHTML(): string
    {
        return file_get_contents(database_path('seeders/pages_html/pension-services.html'));
    }

    private function getGovernmentPayrollPageHTML(): string
    {
        return file_get_contents(database_path('seeders/pages_html/government-payroll.html'));
    }

    private function getInvestmentServicesPageHTML(): string
    {
        return file_get_contents(database_path('seeders/pages_html/investment-services.html'));
    }

    private function getCashCollectionPageHTML(): string
    {
        return file_get_contents(database_path('seeders/pages_html/cash-collection.html'));
    }

    private function getTreasuryNewsPageHTML(): string
    {
        return file_get_contents(database_path('seeders/pages_html/treasury-news.html'));
    }

    private function getPublicNoticesPageHTML(): string
    {
        return file_get_contents(database_path('seeders/pages_html/public-notices.html'));
    }

    private function getDownloadPageHTML(): string
    {
        return file_get_contents(database_path('seeders/pages_html/download.html'));
    }

    private function getContactPageHTML(): string
    {
        return file_get_contents(database_path('seeders/pages_html/contact.html'));
    }
}
