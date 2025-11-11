<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageSection;
use App\Models\User;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing pages and sections
        PageSection::query()->delete();
        Page::query()->delete();

        $user = User::first();

        // Home Page
        $home = Page::create([
            'title' => 'Home',
            'slug' => 'home',
            'template' => 'treasury',
            'meta_description' => 'Accountant General\'s Department - Government of St. Kitts and Nevis. Serving the people with transparency, professionalism, and confidentiality.',
            'meta_keywords' => 'accountant general, st kitts nevis, government, treasury, financial management',
            'is_published' => true,
            'show_in_menu' => true,
            'menu_order' => 1,
            'created_by' => $user->id,
        ]);

        // About Us
        $about = Page::create([
            'title' => 'About Us',
            'slug' => 'about',
            'template' => 'treasury',
            'meta_description' => 'Learn about the Accountant General\'s Department, our mission, vision, and values',
            'meta_keywords' => 'about, accountant general, mission, vision, history',
            'is_published' => true,
            'show_in_menu' => true,
            'menu_order' => 2,
            'created_by' => $user->id,
        ]);

        PageSection::create([
            'page_id' => $about->id,
            'section_type' => 'hero',
            'name' => 'About Hero',
            'content' => [
                'html' => '<section class="page-hero">
                    <div class="container">
                        <h1>About Us</h1>
                        <p class="lead">Learn about the Accountant General\'s Department</p>
                    </div>
                </section>'
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        PageSection::create([
            'page_id' => $about->id,
            'section_type' => 'content',
            'name' => 'About Content',
            'content' => [
                'html' => '<section class="content-section py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <h2 class="mb-4">Who We Are</h2>
                                <p>The Accountant General\'s Department is the central financial management unit of the Government of St. Kitts and Nevis. We are responsible for ensuring efficient and effective management of Government\'s financial operations.</p>
                                <p>Our department plays a crucial role in maintaining fiscal responsibility, transparency, and accountability in all government financial transactions.</p>
                            </div>
                        </div>
                    </div>
                </section>'
            ],
            'order' => 2,
            'is_active' => true,
        ]);

        // Mission & Vision Page
        $missionVision = Page::create([
            'title' => 'Mission & Vision',
            'slug' => 'mission-vision',
            'template' => 'treasury',
            'meta_description' => 'Our mission and vision for financial excellence and public service',
            'meta_keywords' => 'mission, vision, goals, objectives',
            'is_published' => true,
            'parent_id' => $about->id,
            'created_by' => $user->id,
        ]);

        PageSection::create([
            'page_id' => $missionVision->id,
            'section_type' => 'mission_section',
            'name' => 'Mission Section',
            'content' => [
                'html' => '<section class="mission-section py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10 mx-auto text-center">
                                <h2 class="section-title">Our Mission</h2>
                                <p class="mission-text">
                                    To ensure efficient and effective managing and reporting of Government\'s financial operations,
                                    in order to support and foster the achievements of the Government\'s goals and objectives with
                                    the highest level of proficiency, confidentiality and professionalism with the support of a
                                    well-trained and highly motivated staff.
                                </p>
                                <hr class="my-5">
                                <h2 class="section-title">Our Vision</h2>
                                <p class="mission-text">
                                    To be recognized as a model of excellence in financial management, providing innovative and
                                    efficient services that support the economic development and prosperity of St. Kitts and Nevis.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>'
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        // Core Values Page
        $coreValues = Page::create([
            'title' => 'Core Values',
            'slug' => 'core-values',
            'template' => 'treasury',
            'meta_description' => 'Our core values guide our work and service delivery',
            'is_published' => true,
            'parent_id' => $about->id,
            'created_by' => $user->id,
        ]);

        PageSection::create([
            'page_id' => $coreValues->id,
            'section_type' => 'core_values_cards',
            'name' => 'Core Values Cards',
            'content' => [
                'html' => '<section class="core-values-section py-5">
                    <div class="container">
                        <h2 class="section-title text-center">Our Core Values</h2>
                        <p class="section-subtitle text-center mb-5">Guiding principles that define how we serve the people of St. Kitts and Nevis</p>
                        <div class="row justify-content-center">
                            <div class="col-md-4 mb-4">
                                <div class="core-card">
                                    <i class="fas fa-shield-alt"></i>
                                    <h5>Transparency</h5>
                                    <p>Open and clear communication in all financial operations and reporting</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="core-card">
                                    <i class="fas fa-user-tie"></i>
                                    <h5>Professionalism</h5>
                                    <p>Delivering services with expertise, integrity, and the highest standards</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="core-card">
                                    <i class="fas fa-user-shield"></i>
                                    <h5>Confidentiality</h5>
                                    <p>Protecting sensitive information with strict security and privacy measures</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>'
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        // Our Mandate Page
        $mandate = Page::create([
            'title' => 'Our Mandate',
            'slug' => 'our-mandate',
            'template' => 'treasury',
            'meta_description' => 'The mandate and responsibilities of the Accountant General\'s Department',
            'is_published' => true,
            'parent_id' => $about->id,
            'created_by' => $user->id,
        ]);

        PageSection::create([
            'page_id' => $mandate->id,
            'section_type' => 'mandate_box',
            'name' => 'Mandate Content',
            'content' => [
                'html' => '<section class="mandate-section py-5">
                    <div class="container">
                        <h2 class="section-title text-center mb-5">Our Mandate</h2>
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="mandate-box p-4 mb-3">
                                    <h5><i class="fas fa-check-circle text-success me-2"></i>Financial Management</h5>
                                    <p>Oversee and manage all government financial operations and transactions</p>
                                </div>
                                <div class="mandate-box p-4 mb-3">
                                    <h5><i class="fas fa-check-circle text-success me-2"></i>Budget Preparation</h5>
                                    <p>Prepare and manage the national budget and financial estimates</p>
                                </div>
                                <div class="mandate-box p-4 mb-3">
                                    <h5><i class="fas fa-check-circle text-success me-2"></i>Financial Reporting</h5>
                                    <p>Produce accurate and timely financial reports and statements</p>
                                </div>
                                <div class="mandate-box p-4 mb-3">
                                    <h5><i class="fas fa-check-circle text-success me-2"></i>Debt Management</h5>
                                    <p>Monitor and manage government debt obligations</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>'
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        // Divisions Page
        $divisions = Page::create([
            'title' => 'Divisions & Units',
            'slug' => 'divisions',
            'template' => 'treasury',
            'meta_description' => 'Our divisions and organizational structure',
            'meta_keywords' => 'divisions, departments, organizational structure',
            'is_published' => true,
            'show_in_menu' => true,
            'menu_order' => 3,
            'created_by' => $user->id,
        ]);

        PageSection::create([
            'page_id' => $divisions->id,
            'section_type' => 'division_boxes',
            'name' => 'Divisions',
            'content' => [
                'html' => '<section class="divisions-section py-5">
                    <div class="container">
                        <h2 class="section-title text-center mb-5">Our Divisions & Units</h2>
                        <div class="row">
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="division-box">
                                    <i class="fas fa-calculator"></i>
                                    <h5>Budget Division</h5>
                                    <p>Responsible for budget preparation, monitoring, and financial planning</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="division-box">
                                    <i class="fas fa-coins"></i>
                                    <h5>Treasury Division</h5>
                                    <p>Manages government cash flow, payments, and collections</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="division-box">
                                    <i class="fas fa-file-invoice-dollar"></i>
                                    <h5>Accounts Division</h5>
                                    <p>Maintains government accounts and financial records</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="division-box">
                                    <i class="fas fa-chart-line"></i>
                                    <h5>Debt Management Unit</h5>
                                    <p>Monitors and manages government debt portfolio</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="division-box">
                                    <i class="fas fa-users"></i>
                                    <h5>Pension Unit</h5>
                                    <p>Administers government pension programs and benefits</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="division-box">
                                    <i class="fas fa-money-check-alt"></i>
                                    <h5>Payroll Unit</h5>
                                    <p>Processes government employee payroll and benefits</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>'
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        // Team Page
        $team = Page::create([
            'title' => 'Management Team',
            'slug' => 'team',
            'template' => 'treasury',
            'meta_description' => 'Meet our management team and leadership',
            'meta_keywords' => 'team, management, leadership, staff',
            'is_published' => true,
            'show_in_menu' => true,
            'menu_order' => 4,
            'created_by' => $user->id,
        ]);

        PageSection::create([
            'page_id' => $team->id,
            'section_type' => 'profile_cards',
            'name' => 'Team Profiles',
            'content' => [
                'html' => '<section class="team-section py-5">
                    <div class="container">
                        <h2 class="section-title text-center mb-5">Our Management Team</h2>
                        <div class="row justify-content-center">
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="profile-card text-center">
                                    <div class="profile-img-wrapper">
                                        <img src="' . asset('assets/img/team/team-1.jpg') . '" alt="Accountant General" class="img-fluid rounded-circle">
                                    </div>
                                    <h5 class="mt-3">Accountant General</h5>
                                    <p class="text-muted">Head of Department</p>
                                    <p>Leading the department with vision and excellence</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="profile-card text-center">
                                    <div class="profile-img-wrapper">
                                        <img src="' . asset('assets/img/team/team-2.jpg') . '" alt="Deputy Accountant General" class="img-fluid rounded-circle">
                                    </div>
                                    <h5 class="mt-3">Deputy Accountant General</h5>
                                    <p class="text-muted">Deputy Head</p>
                                    <p>Supporting operations and strategic initiatives</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>'
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        // Financial Reports Parent
        $financialReports = Page::create([
            'title' => 'Financial Reports',
            'slug' => 'financial-reports',
            'template' => 'treasury',
            'meta_description' => 'Access government financial reports, budgets, and statements',
            'meta_keywords' => 'financial reports, budget, statements, treasury',
            'is_published' => true,
            'show_in_menu' => true,
            'menu_order' => 5,
            'created_by' => $user->id,
        ]);

        // Annual Budget
        $annualBudget = Page::create([
            'title' => 'Annual Budget',
            'slug' => 'annual-budget',
            'template' => 'treasury',
            'meta_description' => 'Annual budget documents and information',
            'is_published' => true,
            'parent_id' => $financialReports->id,
            'created_by' => $user->id,
        ]);

        PageSection::create([
            'page_id' => $annualBudget->id,
            'section_type' => 'budget_box',
            'name' => 'Budget Content',
            'content' => [
                'html' => '<section class="budget-section py-5">
                    <div class="container">
                        <h2 class="section-title text-center mb-5">Annual Budget</h2>
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="budget-box p-4 mb-4">
                                    <h5><i class="fas fa-file-pdf text-danger me-2"></i>Budget 2024</h5>
                                    <p>Fiscal year 2024 budget document</p>
                                    <a href="#" class="btn btn-sm btn-primary">Download</a>
                                </div>
                                <div class="budget-box p-4 mb-4">
                                    <h5><i class="fas fa-file-pdf text-danger me-2"></i>Budget 2023</h5>
                                    <p>Fiscal year 2023 budget document</p>
                                    <a href="#" class="btn btn-sm btn-primary">Download</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>'
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        // Estimates
        $estimates = Page::create([
            'title' => 'Estimates of Revenue & Expenditure',
            'slug' => 'estimates',
            'template' => 'treasury',
            'meta_description' => 'Government revenue and expenditure estimates',
            'is_published' => true,
            'parent_id' => $financialReports->id,
            'created_by' => $user->id,
        ]);

        // Audited Financial Statements
        $auditedStatements = Page::create([
            'title' => 'Audited Financial Statements',
            'slug' => 'audited-financial-statements',
            'template' => 'treasury',
            'meta_description' => 'Audited financial statements of the Government',
            'is_published' => true,
            'parent_id' => $financialReports->id,
            'created_by' => $user->id,
        ]);

        // Treasury Circulars
        $circulars = Page::create([
            'title' => 'Treasury Circulars',
            'slug' => 'treasury-circulars',
            'template' => 'treasury',
            'meta_description' => 'Treasury circulars and directives',
            'is_published' => true,
            'parent_id' => $financialReports->id,
            'created_by' => $user->id,
        ]);

        // Debt Management Parent
        $debtManagement = Page::create([
            'title' => 'Debt Management',
            'slug' => 'debt-management',
            'template' => 'treasury',
            'meta_description' => 'Government debt management information and reports',
            'meta_keywords' => 'debt management, government debt, debt reports',
            'is_published' => true,
            'show_in_menu' => true,
            'menu_order' => 6,
            'created_by' => $user->id,
        ]);

        // Debt Overview
        $debtOverview = Page::create([
            'title' => 'Debt Overview',
            'slug' => 'debt-overview',
            'template' => 'treasury',
            'meta_description' => 'Overview of government debt position',
            'is_published' => true,
            'parent_id' => $debtManagement->id,
            'created_by' => $user->id,
        ]);

        // Domestic & External Debt Reports
        $debtReports = Page::create([
            'title' => 'Domestic & External Debt Reports',
            'slug' => 'domestic-external-debt-reports',
            'template' => 'treasury',
            'meta_description' => 'Domestic and external debt reports and statistics',
            'is_published' => true,
            'parent_id' => $debtManagement->id,
            'created_by' => $user->id,
        ]);

        // Government Guarantees
        $guarantees = Page::create([
            'title' => 'Government Guarantees',
            'slug' => 'government-guarantees',
            'template' => 'treasury',
            'meta_description' => 'Information on government guarantees',
            'is_published' => true,
            'parent_id' => $debtManagement->id,
            'created_by' => $user->id,
        ]);

        PageSection::create([
            'page_id' => $guarantees->id,
            'section_type' => 'guarantee_cards',
            'name' => 'Guarantees',
            'content' => [
                'html' => '<section class="guarantees-section py-5">
                    <div class="container">
                        <h2 class="section-title text-center mb-5">Government Guarantees</h2>
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="guarantee-card p-4 mb-3">
                                    <h5>Active Guarantees</h5>
                                    <p>Information on currently active government guarantees</p>
                                </div>
                                <div class="guarantee-card p-4 mb-3">
                                    <h5>Guarantee Policy</h5>
                                    <p>Government policy on issuing guarantees</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>'
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        // Treasury Services Parent
        $treasuryServices = Page::create([
            'title' => 'Treasury Services',
            'slug' => 'treasury-services',
            'template' => 'treasury',
            'meta_description' => 'Treasury services for citizens and government employees',
            'meta_keywords' => 'treasury services, pension, payroll, payments',
            'is_published' => true,
            'show_in_menu' => true,
            'menu_order' => 7,
            'created_by' => $user->id,
        ]);

        // Pension Services
        $pensionServices = Page::create([
            'title' => 'Pension Services',
            'slug' => 'pension-services',
            'template' => 'treasury',
            'meta_description' => 'Government pension services and information',
            'is_published' => true,
            'parent_id' => $treasuryServices->id,
            'created_by' => $user->id,
        ]);

        PageSection::create([
            'page_id' => $pensionServices->id,
            'section_type' => 'content',
            'name' => 'Pension Services Content',
            'content' => [
                'html' => '<section class="pension-section py-5">
                    <div class="container">
                        <h2 class="section-title text-center mb-5">Pension Services</h2>
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="service-box p-4 mb-4">
                                    <h5><i class="fas fa-calendar-check text-primary me-2"></i>Pension Payment Schedule</h5>
                                    <p>Pensions are paid on the last working day of each month</p>
                                </div>
                                <div class="service-box p-4 mb-4">
                                    <h5><i class="fas fa-file-alt text-primary me-2"></i>Life Certificates</h5>
                                    <p>Annual life certificates must be submitted to continue receiving pension payments</p>
                                </div>
                                <div class="service-box p-4 mb-4">
                                    <h5><i class="fas fa-user-plus text-primary me-2"></i>New Pension Applications</h5>
                                    <p>Apply for pension benefits upon retirement from government service</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>'
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        // Vendor/Supplier Payments
        $vendorPayments = Page::create([
            'title' => 'Vendor/Supplier Payments',
            'slug' => 'vendor-supplier-payments',
            'template' => 'treasury',
            'meta_description' => 'Information for government vendors and suppliers',
            'is_published' => true,
            'parent_id' => $treasuryServices->id,
            'created_by' => $user->id,
        ]);

        // Government Payroll Services
        $payrollServices = Page::create([
            'title' => 'Government Payroll Services',
            'slug' => 'government-payroll-services',
            'template' => 'treasury',
            'meta_description' => 'Government employee payroll information',
            'is_published' => true,
            'parent_id' => $treasuryServices->id,
            'created_by' => $user->id,
        ]);

        // Investment Services
        $investmentServices = Page::create([
            'title' => 'Investment Services',
            'slug' => 'investment-services',
            'template' => 'treasury',
            'meta_description' => 'Government investment services including Treasury Bills and Savings Bank',
            'is_published' => true,
            'parent_id' => $treasuryServices->id,
            'created_by' => $user->id,
        ]);

        PageSection::create([
            'page_id' => $investmentServices->id,
            'section_type' => 'content',
            'name' => 'Investment Services Content',
            'content' => [
                'html' => '<section class="investment-section py-5">
                    <div class="container">
                        <h2 class="section-title text-center mb-5">Investment Services</h2>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="investment-card p-4">
                                    <i class="fas fa-piggy-bank fa-3x text-primary mb-3"></i>
                                    <h5>Government Savings Bank</h5>
                                    <p>Earn 2% interest per annum on your savings with the Government Savings Bank</p>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-check text-success me-2"></i>Safe and secure</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Competitive interest rates</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Easy access to funds</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="investment-card p-4">
                                    <i class="fas fa-chart-line fa-3x text-primary mb-3"></i>
                                    <h5>Treasury Bills</h5>
                                    <p>Short-term investment opportunities with competitive returns</p>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-check text-success me-2"></i>91-day bills available</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Government backed</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Market-based rates</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>'
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        // Cash Collection
        $cashCollection = Page::create([
            'title' => 'Cash Collection',
            'slug' => 'cash-collection',
            'template' => 'treasury',
            'meta_description' => 'Cash collection services and procedures',
            'is_published' => true,
            'parent_id' => $treasuryServices->id,
            'created_by' => $user->id,
        ]);

        // News & Updates Parent
        $news = Page::create([
            'title' => 'News & Updates',
            'slug' => 'news',
            'template' => 'treasury',
            'meta_description' => 'Latest news and updates from the Treasury',
            'meta_keywords' => 'news, updates, announcements, treasury news',
            'is_published' => true,
            'show_in_menu' => true,
            'menu_order' => 8,
            'created_by' => $user->id,
        ]);

        // Treasury News
        $treasuryNews = Page::create([
            'title' => 'Treasury News',
            'slug' => 'treasury-news',
            'template' => 'treasury',
            'meta_description' => 'Latest news and announcements from the Treasury',
            'is_published' => true,
            'parent_id' => $news->id,
            'created_by' => $user->id,
        ]);

        PageSection::create([
            'page_id' => $treasuryNews->id,
            'section_type' => 'treasury_news_cards',
            'name' => 'Treasury News',
            'content' => [
                'html' => '<section class="news-section py-5">
                    <div class="container">
                        <h2 class="section-title text-center mb-5">Treasury News</h2>
                        <div class="row">
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="news-card">
                                    <div class="news-date">Nov 10, 2024</div>
                                    <h5>Budget 2025 Presentation</h5>
                                    <p>The 2025 National Budget will be presented next month...</p>
                                    <a href="#" class="btn btn-sm btn-outline-primary">Read More</a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="news-card">
                                    <div class="news-date">Nov 5, 2024</div>
                                    <h5>Pension Payment Notice</h5>
                                    <p>November pension payments will be processed on schedule...</p>
                                    <a href="#" class="btn btn-sm btn-outline-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>'
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        // Public Notices
        $publicNotices = Page::create([
            'title' => 'Public Notices',
            'slug' => 'public-notices',
            'template' => 'treasury',
            'meta_description' => 'Important public notices and announcements',
            'is_published' => true,
            'parent_id' => $news->id,
            'created_by' => $user->id,
        ]);

        PageSection::create([
            'page_id' => $publicNotices->id,
            'section_type' => 'public_notice_cards',
            'name' => 'Public Notices',
            'content' => [
                'html' => '<section class="notices-section py-5">
                    <div class="container">
                        <h2 class="section-title text-center mb-5">Public Notices</h2>
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="notice-card p-4 mb-3">
                                    <div class="notice-badge">Important</div>
                                    <h5>Life Certificate Submission Deadline</h5>
                                    <p class="text-muted mb-2"><i class="fas fa-calendar me-2"></i>Posted: Nov 1, 2024</p>
                                    <p>All pensioners are reminded to submit their annual life certificates by December 31, 2024.</p>
                                </div>
                                <div class="notice-card p-4 mb-3">
                                    <div class="notice-badge">Notice</div>
                                    <h5>Office Hours During Holiday Season</h5>
                                    <p class="text-muted mb-2"><i class="fas fa-calendar me-2"></i>Posted: Oct 25, 2024</p>
                                    <p>Please note our adjusted operating hours during the upcoming holiday season.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>'
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        // Downloads
        $downloads = Page::create([
            'title' => 'Downloads',
            'slug' => 'download',
            'template' => 'treasury',
            'meta_description' => 'Download forms, documents, and resources',
            'meta_keywords' => 'downloads, forms, documents, applications',
            'is_published' => true,
            'show_in_menu' => true,
            'menu_order' => 9,
            'created_by' => $user->id,
        ]);

        PageSection::create([
            'page_id' => $downloads->id,
            'section_type' => 'download_section',
            'name' => 'Downloads',
            'content' => [
                'html' => '<section class="download-section py-5">
                    <div class="container">
                        <h2 class="section-title text-center mb-5">Downloads</h2>
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="download-category mb-4">
                                    <h5 class="mb-3"><i class="fas fa-folder-open text-primary me-2"></i>Forms & Applications</h5>
                                    <div class="download-item p-3 mb-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1">Pension Application Form</h6>
                                                <small class="text-muted">PDF • 250 KB</small>
                                            </div>
                                            <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-download me-1"></i>Download</a>
                                        </div>
                                    </div>
                                    <div class="download-item p-3 mb-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1">Life Certificate Form</h6>
                                                <small class="text-muted">PDF • 180 KB</small>
                                            </div>
                                            <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-download me-1"></i>Download</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="download-category mb-4">
                                    <h5 class="mb-3"><i class="fas fa-folder-open text-primary me-2"></i>Financial Reports</h5>
                                    <div class="download-item p-3 mb-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1">Annual Budget 2024</h6>
                                                <small class="text-muted">PDF • 2.5 MB</small>
                                            </div>
                                            <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-download me-1"></i>Download</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>'
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        // Contact Page
        $contact = Page::create([
            'title' => 'Contact Us',
            'slug' => 'contact',
            'template' => 'treasury',
            'meta_description' => 'Contact the Accountant General\'s Department',
            'meta_keywords' => 'contact, address, phone, email, location',
            'is_published' => true,
            'show_in_menu' => true,
            'menu_order' => 10,
            'created_by' => $user->id,
        ]);

        PageSection::create([
            'page_id' => $contact->id,
            'section_type' => 'content',
            'name' => 'Contact Information',
            'content' => [
                'html' => '<section class="contact-section py-5">
                    <div class="container">
                        <h2 class="section-title text-center mb-5">Contact Us</h2>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="contact-info-box p-4">
                                    <h5><i class="fas fa-map-marker-alt text-primary me-2"></i>Office Location</h5>
                                    <p>Treasury Chambers<br>
                                    Church Street<br>
                                    Basseterre, St. Kitts</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="contact-info-box p-4">
                                    <h5><i class="fas fa-phone text-primary me-2"></i>Phone</h5>
                                    <p>Main: (869) 465-2521<br>
                                    Fax: (869) 465-5109</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="contact-info-box p-4">
                                    <h5><i class="fas fa-envelope text-primary me-2"></i>Email</h5>
                                    <p>info@treasury.gov.kn</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="contact-info-box p-4">
                                    <h5><i class="fas fa-clock text-primary me-2"></i>Office Hours</h5>
                                    <p>Monday - Friday<br>
                                    8:00 AM - 4:00 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>'
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        // Calculator Page (for calculators/tools)
        $calculator = Page::create([
            'title' => 'Financial Calculators',
            'slug' => 'calculators',
            'template' => 'treasury',
            'meta_description' => 'Financial calculators and tools',
            'is_published' => true,
            'show_in_menu' => false,
            'created_by' => $user->id,
        ]);
    }
}
