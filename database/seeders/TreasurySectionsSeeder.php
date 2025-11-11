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
