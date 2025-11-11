<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PageSection;

class TreasurySectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Add new treasury-specific section type constants to PageSection model
        $treasurySections = [
            [
                'section_type' => 'carousel_slider',
                'name' => 'Carousel Slider',
                'order' => 1,
                'content' => [
                    'html' => '<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active" style="background-image: url(\'/assets/img/hero/hero_bg_1_1.jpg\'); background-size: cover; background-position: center; min-height: 500px;">
                                <div class="carousel-caption">
                                    <h1>Accountant General\'s Department</h1>
                                    <h5>Treasury Chambers - St. Kitts and Nevis</h5>
                                    <p>Serving the people with transparency, professionalism, and confidentiality.</p>
                                    <a href="#" class="btn btn-danger">Our Services <i class="fas fa-arrow-right ms-2"></i></a>
                                    <a href="#" class="btn btn-outline-light">Learn More</a>
                                </div>
                            </div>
                            <div class="carousel-item" style="background-image: url(\'/assets/img/hero/hero_bg_1_1.jpg\'); background-size: cover; background-position: center; min-height: 500px;">
                                <div class="carousel-caption">
                                    <h1>Professional Expertise</h1>
                                    <h5>Experience Excellence in Financial Management</h5>
                                    <p>Dedicated to efficient and effective management of Government financial operations.</p>
                                    <a href="#" class="btn btn-danger">Our Services <i class="fas fa-arrow-right ms-2"></i></a>
                                    <a href="#" class="btn btn-outline-light">Learn More</a>
                                </div>
                            </div>
                            <div class="carousel-item" style="background-image: url(\'/assets/img/hero/hero_bg_1_1.jpg\'); background-size: cover; background-position: center; min-height: 500px;">
                                <div class="carousel-caption">
                                    <h1>Financial Transparency</h1>
                                    <h5>Accountability and Trust</h5>
                                    <p>Access reports, budgets, and financial statements with complete transparency.</p>
                                    <a href="#" class="btn btn-danger">Our Services <i class="fas fa-arrow-right ms-2"></i></a>
                                    <a href="#" class="btn btn-outline-light">Learn More</a>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                            <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                        </button>
                    </div>',
                    'category' => 'treasury',
                    'description' => 'Bootstrap carousel with 3 slides'
                ],
                'is_active' => true,
            ],
            [
                'section_type' => 'core_values_cards',
                'name' => 'Core Values Cards',
                'order' => 2,
                'content' => [
                    'html' => '<section class="core-values-section" style="padding: 80px 0;">
                        <div class="container">
                            <h2 class="section-title" style="text-align: center; font-size: 36px; margin-bottom: 15px;">Our Core Values</h2>
                            <p class="section-subtitle" style="text-align: center; color: #666; margin-bottom: 50px;">Guiding principles that define how we serve the people</p>
                            <div class="row justify-content-center">
                                <div class="col-md-4 mb-4">
                                    <div class="core-card" style="background: #fff; padding: 40px 30px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); text-align: center;">
                                        <i class="fas fa-shield-alt" style="font-size: 48px; color: #bd2828; margin-bottom: 20px;"></i>
                                        <h5 style="font-size: 22px; font-weight: 600; margin-bottom: 15px;">Transparency</h5>
                                        <p style="color: #666; line-height: 1.6;">Open and clear communication in all financial operations and reporting</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="core-card" style="background: #fff; padding: 40px 30px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); text-align: center;">
                                        <i class="fas fa-user-tie" style="font-size: 48px; color: #bd2828; margin-bottom: 20px;"></i>
                                        <h5 style="font-size: 22px; font-weight: 600; margin-bottom: 15px;">Professionalism</h5>
                                        <p style="color: #666; line-height: 1.6;">Delivering services with expertise, integrity, and the highest standards</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="core-card" style="background: #fff; padding: 40px 30px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); text-align: center;">
                                        <i class="fas fa-user-shield" style="font-size: 48px; color: #bd2828; margin-bottom: 20px;"></i>
                                        <h5 style="font-size: 22px; font-weight: 600; margin-bottom: 15px;">Confidentiality</h5>
                                        <p style="color: #666; line-height: 1.6;">Protecting sensitive information with strict security and privacy measures</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>',
                    'category' => 'treasury',
                    'description' => '3-column cards for Transparency, Professionalism, Confidentiality'
                ],
                'is_active' => true,
            ],
            [
                'section_type' => 'mission_section',
                'name' => 'Mission Section',
                'order' => 3,
                'content' => [
                    'html' => '<section class="mission-section" style="background: linear-gradient(135deg, #bd2828 0%, #8b1c1c 100%); padding: 60px 0; color: white;">
                        <div class="container text-center">
                            <h2 class="section-title" style="font-size: 32px; margin-bottom: 25px; font-weight: 600;">Our Mission</h2>
                            <p class="mission-text" style="font-size: 18px; line-height: 1.8; max-width: 900px; margin: 0 auto;">
                                To ensure efficient and effective managing and reporting of Government\'s financial operations, in order to support and foster the achievements of the Government\'s goals and objectives with the highest level of proficiency, confidentiality and professionalism with the support of a well-trained and highly motivated staff.
                            </p>
                        </div>
                    </section>',
                    'category' => 'treasury',
                    'description' => 'Full-width mission statement with gradient background'
                ],
                'is_active' => true,
            ],
            [
                'section_type' => 'mandate_box',
                'name' => 'Mandate Box',
                'order' => 4,
                'content' => [
                    'html' => '<section class="mandate-section" style="padding: 80px 0; background: #f8f9fa;">
                        <div class="container">
                            <h3 style="text-align: center; font-size: 32px; margin-bottom: 40px;">Our Mandate</h3>
                            <div class="mandate-box" style="background: white; padding: 40px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
                                <p style="margin-bottom: 20px; line-height: 1.8; color: #333;">
                                    The Accountant General\'s Department is administered under the Finance Administration Act, 2007. In accordance with the directions of the Financial Secretary, the Accountant General is responsible for:
                                </p>
                                <ul class="mandate-list" style="list-style: none; padding: 0;">
                                    <li style="padding: 15px 0; border-bottom: 1px solid #eee; display: flex; align-items: start;">
                                        <span class="mandate-number" style="background: #bd2828; color: white; width: 32px; height: 32px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-right: 15px; flex-shrink: 0; font-weight: 600;">1</span>
                                        <span>Maintaining central accounts of the Government showing the current state of the Consolidated Fund</span>
                                    </li>
                                    <li style="padding: 15px 0; border-bottom: 1px solid #eee; display: flex; align-items: start;">
                                        <span class="mandate-number" style="background: #bd2828; color: white; width: 32px; height: 32px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-right: 15px; flex-shrink: 0; font-weight: 600;">2</span>
                                        <span>Receiving, banking and overseeing disbursement of public money</span>
                                    </li>
                                    <li style="padding: 15px 0; border-bottom: 1px solid #eee; display: flex; align-items: start;">
                                        <span class="mandate-number" style="background: #bd2828; color: white; width: 32px; height: 32px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-right: 15px; flex-shrink: 0; font-weight: 600;">3</span>
                                        <span>Preparing Public Accounts and financial statements</span>
                                    </li>
                                    <li style="padding: 15px 0; display: flex; align-items: start;">
                                        <span class="mandate-number" style="background: #bd2828; color: white; width: 32px; height: 32px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-right: 15px; flex-shrink: 0; font-weight: 600;">4</span>
                                        <span>Maintaining a system for examination of payments</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </section>',
                    'category' => 'treasury',
                    'description' => 'Numbered list of government mandates'
                ],
                'is_active' => true,
            ],
            [
                'section_type' => 'division_boxes',
                'name' => 'Division Boxes',
                'order' => 5,
                'content' => [
                    'html' => '<section style="padding: 80px 0;">
                        <div class="container">
                            <h2 style="text-align: center; font-size: 36px; margin-bottom: 15px;">Divisions & Units</h2>
                            <p style="text-align: center; color: #666; margin-bottom: 50px;">
                                Explore the different divisions and units that make up the Accountant General\'s Department
                            </p>
                            <div class="row g-4">
                                <div class="col-lg-6 col-md-6">
                                    <div class="div-box" style="background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); border-left: 4px solid #bd2828;">
                                        <h5 style="font-size: 20px; font-weight: 600; margin-bottom: 20px; color: #bd2828;">Accounting & Reporting</h5>
                                        <ul style="line-height: 2; color: #666;">
                                            <li>Maintenance of proper accounting records to assess performance</li>
                                            <li>Preparation of the Annual Public Accounts</li>
                                            <li>Bank Reconciliation</li>
                                            <li>Computation of Pensions and Gratuities</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="div-box" style="background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); border-left: 4px solid #bd2828;">
                                        <h5 style="font-size: 20px; font-weight: 600; margin-bottom: 20px; color: #bd2828;">Cash Management</h5>
                                        <ul style="line-height: 2; color: #666;">
                                            <li>Cash forecasting and short-term investments</li>
                                            <li>Monitoring of Government\'s cash position</li>
                                            <li>Liaison between Government and banking partners</li>
                                            <li>Ensuring obligations are adequately funded</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>',
                    'category' => 'treasury',
                    'description' => '2-column layout for department divisions'
                ],
                'is_active' => true,
            ],
            [
                'section_type' => 'profile_cards',
                'name' => 'Profile Cards',
                'order' => 6,
                'content' => [
                    'html' => '<section style="padding: 80px 0; background: #f8f9fa;">
                        <div class="container">
                            <h1 style="text-align: center; font-size: 36px; margin-bottom: 15px;">Management Team</h1>
                            <p style="text-align: center; color: #666; margin-bottom: 50px;">Meet the dedicated professionals leading the Accountant General\'s Department</p>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="profile-card-unique" style="background: white; padding: 30px; border-radius: 10px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1); margin-bottom: 30px;">
                                        <div class="icon-wrapper" style="margin-bottom: 20px;">
                                            <div class="icon-circle" style="width: 100px; height: 100px; border-radius: 50%; background: linear-gradient(135deg, #bd2828, #8b1c1c); display: inline-flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-user" style="font-size: 40px; color: white;"></i>
                                            </div>
                                        </div>
                                        <h3 style="font-size: 22px; margin-bottom: 10px;">Mr. John Doe</h3>
                                        <p class="title" style="color: #bd2828; font-weight: 600; margin-bottom: 20px;">Accountant General</p>
                                        <hr style="border-color: #eee; margin: 20px 0;">
                                        <div class="contact-info" style="text-align: left;">
                                            <div style="padding: 8px 0;"><i class="fas fa-envelope" style="color: #bd2828; margin-right: 10px;"></i> accountant.general@gov.kn</div>
                                            <div style="padding: 8px 0;"><i class="fas fa-phone" style="color: #bd2828; margin-right: 10px;"></i> +1 (869) 465-2521</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="profile-card-unique" style="background: white; padding: 30px; border-radius: 10px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1); margin-bottom: 30px;">
                                        <div class="icon-wrapper" style="margin-bottom: 20px;">
                                            <div class="icon-circle" style="width: 100px; height: 100px; border-radius: 50%; background: linear-gradient(135deg, #bd2828, #8b1c1c); display: inline-flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-user" style="font-size: 40px; color: white;"></i>
                                            </div>
                                        </div>
                                        <h3 style="font-size: 22px; margin-bottom: 10px;">Ms. Jane Smith</h3>
                                        <p class="title" style="color: #bd2828; font-weight: 600; margin-bottom: 20px;">Deputy Accountant General</p>
                                        <hr style="border-color: #eee; margin: 20px 0;">
                                        <div class="contact-info" style="text-align: left;">
                                            <div style="padding: 8px 0;"><i class="fas fa-envelope" style="color: #bd2828; margin-right: 10px;"></i> deputy.ag@gov.kn</div>
                                            <div style="padding: 8px 0;"><i class="fas fa-phone" style="color: #bd2828; margin-right: 10px;"></i> +1 (869) 465-2522</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="profile-card-unique" style="background: white; padding: 30px; border-radius: 10px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1); margin-bottom: 30px;">
                                        <div class="icon-wrapper" style="margin-bottom: 20px;">
                                            <div class="icon-circle" style="width: 100px; height: 100px; border-radius: 50%; background: linear-gradient(135deg, #bd2828, #8b1c1c); display: inline-flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-user" style="font-size: 40px; color: white;"></i>
                                            </div>
                                        </div>
                                        <h3 style="font-size: 22px; margin-bottom: 10px;">Mr. Robert Brown</h3>
                                        <p class="title" style="color: #bd2828; font-weight: 600; margin-bottom: 20px;">Director of Finance</p>
                                        <hr style="border-color: #eee; margin: 20px 0;">
                                        <div class="contact-info" style="text-align: left;">
                                            <div style="padding: 8px 0;"><i class="fas fa-envelope" style="color: #bd2828; margin-right: 10px;"></i> director.finance@gov.kn</div>
                                            <div style="padding: 8px 0;"><i class="fas fa-phone" style="color: #bd2828; margin-right: 10px;"></i> +1 (869) 465-2523</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>',
                    'category' => 'treasury',
                    'description' => 'Team member cards with contact information'
                ],
                'is_active' => true,
            ],
            [
                'section_type' => 'budget_box',
                'name' => 'Budget Box',
                'order' => 7,
                'content' => [
                    'html' => '<section style="padding: 60px 0;">
                        <div class="container">
                            <div class="budget-box" style="background: #fff; padding: 40px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); border-left: 5px solid #bd2828;">
                                <h2 style="font-size: 28px; margin-bottom: 20px; color: #bd2828;">Budget Overview</h2>
                                <p style="color: #666; line-height: 1.8; margin-bottom: 25px;">
                                    The national budget sets out the Government\'s spending plan and priorities for the fiscal year.
                                </p>
                                <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 15px;">Key Budget Themes</h3>
                                <ul style="line-height: 2; color: #666;">
                                    <li>Supporting economic growth</li>
                                    <li>Public infrastructure development</li>
                                    <li>Fiscal responsibility and transparency</li>
                                </ul>
                            </div>
                        </div>
                    </section>',
                    'category' => 'treasury',
                    'description' => 'Budget overview with themes'
                ],
                'is_active' => true,
            ],
            [
                'section_type' => 'download_section',
                'name' => 'Download Section',
                'order' => 8,
                'content' => [
                    'html' => '<section style="padding: 60px 0; background: #f8f9fa;">
                        <div class="container">
                            <div class="download-section" style="background: white; padding: 40px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                                <h2 style="font-size: 28px; margin-bottom: 30px; color: #333;">Download Documents</h2>
                                <div class="download-item" style="display: flex; justify-content: space-between; align-items: center; padding: 20px; background: #f8f9fa; border-radius: 8px; margin-bottom: 15px;">
                                    <div class="download-info">
                                        <i class="fas fa-download" style="color: #bd2828; margin-right: 10px;"></i>
                                        <span style="font-weight: 600;">Budget 2025</span>
                                    </div>
                                    <button class="download-btn" style="background: #bd2828; color: white; border: none; padding: 10px 25px; border-radius: 5px; cursor: pointer; font-weight: 600;">Download PDF</button>
                                </div>
                                <div class="download-item" style="display: flex; justify-content: space-between; align-items: center; padding: 20px; background: #f8f9fa; border-radius: 8px;">
                                    <div class="download-info">
                                        <i class="fas fa-download" style="color: #bd2828; margin-right: 10px;"></i>
                                        <span style="font-weight: 600;">Budget 2024</span>
                                    </div>
                                    <button class="download-btn" style="background: #bd2828; color: white; border: none; padding: 10px 25px; border-radius: 5px; cursor: pointer; font-weight: 600;">Download PDF</button>
                                </div>
                            </div>
                        </div>
                    </section>',
                    'category' => 'treasury',
                    'description' => 'Document download list'
                ],
                'is_active' => true,
            ],
            [
                'section_type' => 'calculator_box',
                'name' => 'Calculator Box',
                'order' => 9,
                'content' => [
                    'html' => '<section style="padding: 60px 0;">
                        <div class="container">
                            <div class="calculator-box" style="background: white; padding: 40px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); border-top: 5px solid #bd2828;">
                                <h2 style="margin-bottom: 20px;">
                                    <i class="fas fa-calculator" style="color: #bd2828; margin-right: 10px;"></i>
                                    Pension Calculator
                                </h2>
                                <p style="color: #666; margin-bottom: 30px;">Calculate your estimated government pension and gratuity based on years of service and final salary</p>
                                <div class="eligibility" style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 30px;">
                                    <h5 style="font-size: 18px; margin-bottom: 15px; color: #bd2828;">Eligibility Requirements:</h5>
                                    <ul style="color: #666; line-height: 2;">
                                        <li>Minimum 10 years (120 months) of service for gratuity</li>
                                        <li>Minimum 15 years (180 months) of service for pension eligibility</li>
                                        <li>Maximum pensionable service 33⅓ years (400 months)</li>
                                    </ul>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Years of Service</label>
                                        <input type="number" placeholder="Enter years" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 20px;">
                                    </div>
                                    <div class="col-md-6">
                                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Additional Months</label>
                                        <input type="number" placeholder="0-11 months" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 20px;">
                                    </div>
                                    <div class="col-md-12">
                                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Final Annual Salary (XCD)</label>
                                        <input type="text" placeholder="Enter your final annual salary" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 5px;">
                                        <small style="color: #999;">Your annual salary at the time of retirement</small>
                                    </div>
                                </div>
                                <div style="margin-top: 25px;">
                                    <button class="btn" style="background: #bd2828; color: white; border: none; padding: 12px 30px; border-radius: 5px; cursor: pointer; font-weight: 600; margin-right: 10px;">Calculate Pension</button>
                                    <button class="btn" style="background: #6c757d; color: white; border: none; padding: 12px 30px; border-radius: 5px; cursor: pointer; font-weight: 600;">Reset</button>
                                </div>
                            </div>
                        </div>
                    </section>',
                    'category' => 'treasury',
                    'description' => 'Pension calculator form'
                ],
                'is_active' => true,
            ],
            [
                'section_type' => 'treasury_news_cards',
                'name' => 'Treasury News Cards',
                'order' => 10,
                'content' => [
                    'html' => '<section style="padding: 80px 0; background: #f8f9fa;">
                        <div class="container">
                            <h2 style="text-align: center; font-size: 36px; margin-bottom: 50px;">Treasury News & Updates</h2>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="tnews-card" style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); margin-bottom: 30px;">
                                        <div style="background: #bd2828; height: 150px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-newspaper" style="font-size: 48px; color: white;"></i>
                                        </div>
                                        <div style="padding: 25px;">
                                            <div style="color: #999; font-size: 14px; margin-bottom: 10px;">January 15, 2025</div>
                                            <h3 style="font-size: 20px; margin-bottom: 15px;">New Budget Announcement</h3>
                                            <p style="color: #666; line-height: 1.6;">The Treasury Department announces the new fiscal year budget with focus on infrastructure development...</p>
                                            <a href="#" style="color: #bd2828; font-weight: 600; text-decoration: none;">Read More <i class="fas fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="tnews-card" style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); margin-bottom: 30px;">
                                        <div style="background: #bd2828; height: 150px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-coins" style="font-size: 48px; color: white;"></i>
                                        </div>
                                        <div style="padding: 25px;">
                                            <div style="color: #999; font-size: 14px; margin-bottom: 10px;">January 10, 2025</div>
                                            <h3 style="font-size: 20px; margin-bottom: 15px;">Pension Payment Schedule</h3>
                                            <p style="color: #666; line-height: 1.6;">Updated pension payment dates for Q1 2025 are now available for all beneficiaries...</p>
                                            <a href="#" style="color: #bd2828; font-weight: 600; text-decoration: none;">Read More <i class="fas fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="tnews-card" style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); margin-bottom: 30px;">
                                        <div style="background: #bd2828; height: 150px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-file-invoice-dollar" style="font-size: 48px; color: white;"></i>
                                        </div>
                                        <div style="padding: 25px;">
                                            <div style="color: #999; font-size: 14px; margin-bottom: 10px;">January 5, 2025</div>
                                            <h3 style="font-size: 20px; margin-bottom: 15px;">Financial Report Released</h3>
                                            <p style="color: #666; line-height: 1.6;">The annual financial statements for fiscal year 2024 have been published and are available...</p>
                                            <a href="#" style="color: #bd2828; font-weight: 600; text-decoration: none;">Read More <i class="fas fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>',
                    'category' => 'treasury',
                    'description' => '3-column news grid'
                ],
                'is_active' => true,
            ],
            [
                'section_type' => 'public_notice_cards',
                'name' => 'Public Notice Cards',
                'order' => 11,
                'content' => [
                    'html' => '<section style="padding: 80px 0;">
                        <div class="container">
                            <h2 style="text-align: center; font-size: 36px; margin-bottom: 50px;">Public Notices</h2>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="pnotice-card" style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); border-left: 5px solid #bd2828; margin-bottom: 30px;">
                                        <div style="display: flex; align-items: start; margin-bottom: 15px;">
                                            <div style="background: #bd2828; color: white; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-right: 20px;">
                                                <i class="fas fa-exclamation" style="font-size: 24px;"></i>
                                            </div>
                                            <div>
                                                <div style="color: #999; font-size: 14px; margin-bottom: 5px;">January 20, 2025</div>
                                                <h3 style="font-size: 20px; margin-bottom: 10px;">Tax Filing Deadline</h3>
                                                <p style="color: #666; line-height: 1.6;">Important reminder: The deadline for annual tax filing is approaching. Ensure all documents are submitted by February 28, 2025.</p>
                                                <a href="#" style="color: #bd2828; font-weight: 600; text-decoration: none;">View Details <i class="fas fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="pnotice-card" style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); border-left: 5px solid #bd2828; margin-bottom: 30px;">
                                        <div style="display: flex; align-items: start; margin-bottom: 15px;">
                                            <div style="background: #bd2828; color: white; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-right: 20px;">
                                                <i class="fas fa-bell" style="font-size: 24px;"></i>
                                            </div>
                                            <div>
                                                <div style="color: #999; font-size: 14px; margin-bottom: 5px;">January 18, 2025</div>
                                                <h3 style="font-size: 20px; margin-bottom: 10px;">Office Closure Notice</h3>
                                                <p style="color: #666; line-height: 1.6;">The Treasury Department will be closed on January 25, 2025 for a public holiday. Normal operations resume on January 26.</p>
                                                <a href="#" style="color: #bd2828; font-weight: 600; text-decoration: none;">View Details <i class="fas fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>',
                    'category' => 'treasury',
                    'description' => '2-column notice cards'
                ],
                'is_active' => true,
            ],
            [
                'section_type' => 'guarantee_cards',
                'name' => 'Guarantee Cards',
                'order' => 12,
                'content' => [
                    'html' => '<section style="padding: 80px 0; background: #f8f9fa;">
                        <div class="container">
                            <h2 style="text-align: center; font-size: 36px; margin-bottom: 50px;">Government Guarantees</h2>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="guarantee-card" style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); text-align: center; margin-bottom: 30px;">
                                        <div style="background: linear-gradient(135deg, #bd2828, #8b1c1c); width: 80px; height: 80px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                                            <i class="fas fa-shield-alt" style="font-size: 36px; color: white;"></i>
                                        </div>
                                        <h3 style="font-size: 22px; margin-bottom: 15px;">Loan Guarantee</h3>
                                        <p style="color: #666; line-height: 1.6; margin-bottom: 20px;">Government-backed loan guarantee program for approved projects and initiatives.</p>
                                        <div style="background: #f8f9fa; padding: 15px; border-radius: 8px;">
                                            <div style="font-size: 14px; color: #999; margin-bottom: 5px;">Amount</div>
                                            <div style="font-size: 24px; font-weight: 600; color: #bd2828;">$5.2M</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="guarantee-card" style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); text-align: center; margin-bottom: 30px;">
                                        <div style="background: linear-gradient(135deg, #bd2828, #8b1c1c); width: 80px; height: 80px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                                            <i class="fas fa-handshake" style="font-size: 36px; color: white;"></i>
                                        </div>
                                        <h3 style="font-size: 22px; margin-bottom: 15px;">Bond Guarantee</h3>
                                        <p style="color: #666; line-height: 1.6; margin-bottom: 20px;">Treasury bonds backed by the full faith and credit of the Government.</p>
                                        <div style="background: #f8f9fa; padding: 15px; border-radius: 8px;">
                                            <div style="font-size: 14px; color: #999; margin-bottom: 5px;">Amount</div>
                                            <div style="font-size: 24px; font-weight: 600; color: #bd2828;">$8.7M</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="guarantee-card" style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); text-align: center; margin-bottom: 30px;">
                                        <div style="background: linear-gradient(135deg, #bd2828, #8b1c1c); width: 80px; height: 80px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                                            <i class="fas fa-file-contract" style="font-size: 36px; color: white;"></i>
                                        </div>
                                        <h3 style="font-size: 22px; margin-bottom: 15px;">Performance Guarantee</h3>
                                        <p style="color: #666; line-height: 1.6; margin-bottom: 20px;">Guarantees for contract performance and project completion obligations.</p>
                                        <div style="background: #f8f9fa; padding: 15px; border-radius: 8px;">
                                            <div style="font-size: 14px; color: #999; margin-bottom: 5px;">Amount</div>
                                            <div style="font-size: 24px; font-weight: 600; color: #bd2828;">$3.5M</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>',
                    'category' => 'treasury',
                    'description' => '3-column guarantee cards'
                ],
                'is_active' => true,
            ],
            [
                'section_type' => 'filter_download_box',
                'name' => 'Filter Download Box',
                'order' => 13,
                'content' => [
                    'html' => '<section style="padding: 80px 0;">
                        <div class="container">
                            <div class="dcentre-filter-box" style="background: white; padding: 40px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
                                <h2 style="margin-bottom: 30px; color: #bd2828;">Filter Documents</h2>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Document Type</label>
                                        <select style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 20px;">
                                            <option>All Documents</option>
                                            <option>Budget Reports</option>
                                            <option>Financial Statements</option>
                                            <option>Circulars</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Year</label>
                                        <select style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 20px;">
                                            <option>2025</option>
                                            <option>2024</option>
                                            <option>2023</option>
                                            <option>2022</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Search</label>
                                        <input type="text" placeholder="Search documents..." style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 20px;">
                                    </div>
                                </div>
                                <div style="text-align: center;">
                                    <button style="background: #bd2828; color: white; border: none; padding: 12px 40px; border-radius: 5px; cursor: pointer; font-weight: 600;">Apply Filters</button>
                                </div>
                                <div style="margin-top: 40px;">
                                    <table style="width: 100%; border-collapse: collapse;">
                                        <thead>
                                            <tr style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                                                <th style="padding: 15px; text-align: left; font-weight: 600;">Document Name</th>
                                                <th style="padding: 15px; text-align: left; font-weight: 600;">Type</th>
                                                <th style="padding: 15px; text-align: left; font-weight: 600;">Date</th>
                                                <th style="padding: 15px; text-align: center; font-weight: 600;">Download</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style="border-bottom: 1px solid #dee2e6;">
                                                <td style="padding: 15px;">Annual Budget 2025</td>
                                                <td style="padding: 15px;">Budget Report</td>
                                                <td style="padding: 15px;">Jan 2025</td>
                                                <td style="padding: 15px; text-align: center;">
                                                    <button style="background: #bd2828; color: white; border: none; padding: 8px 20px; border-radius: 5px; cursor: pointer;">
                                                        <i class="fas fa-download"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr style="border-bottom: 1px solid #dee2e6;">
                                                <td style="padding: 15px;">Financial Statement Q4 2024</td>
                                                <td style="padding: 15px;">Financial Statement</td>
                                                <td style="padding: 15px;">Dec 2024</td>
                                                <td style="padding: 15px; text-align: center;">
                                                    <button style="background: #bd2828; color: white; border: none; padding: 8px 20px; border-radius: 5px; cursor: pointer;">
                                                        <i class="fas fa-download"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>',
                    'category' => 'treasury',
                    'description' => 'Filterable document table'
                ],
                'is_active' => true,
            ],
        ];

        // Create each section
        foreach ($treasurySections as $section) {
            PageSection::create([
                'page_id' => null, // Template sections have no page_id
                'section_type' => $section['section_type'],
                'order' => $section['order'],
                'content' => $section['content'],
                'is_active' => $section['is_active'],
            ]);
        }

        $this->command->info('Treasury sections seeded successfully!');
    }
}
