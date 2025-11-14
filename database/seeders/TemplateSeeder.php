<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = [
            // 1. Blank Template
            [
                'name' => 'Blank Page',
                'slug' => 'blank-page',
                'description' => 'Start from scratch with a clean slate',
                'thumbnail' => '/assets/img/templates/blank.jpg',
                'category' => 'general',
                'html_content' => '<div class="container" style="padding: 40px 20px;"><div class="row"><div class="col-12 text-center"><h1>Start Building</h1><p>Drag blocks from the left panel to create your page</p></div></div></div>',
                'is_active' => true,
                'sort_order' => 1,
            ],

            // 2. Home Page Template
            [
                'name' => 'Complete Homepage',
                'slug' => 'complete-homepage',
                'description' => 'Full-featured homepage with hero, features, and CTA sections',
                'thumbnail' => '/assets/img/templates/home.jpg',
                'category' => 'home',
                'html_content' => '<!-- Hero Carousel Section --><div id="heroCarousel" class="carousel slide" data-bs-ride="carousel"><div class="carousel-indicators"><button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button></div><div class="carousel-inner"><div class="carousel-item active" style="background-image: url(\'/assets/img/hero/hero_bg_1_1.jpg\'); min-height: 500px; background-size: cover; background-position: center;"><div class="carousel-caption"><h1>Welcome to Our Organization</h1><h5>Serving with Excellence</h5><p>Your trusted partner in delivering quality services</p><a href="#" class="btn btn-red">Learn More <i class="fas fa-arrow-right ms-2"></i></a></div></div></div></div><!-- Core Values Section --><section class="core-values-section" style="padding: 80px 0; background: #f8f9fa;"><div class="container"><h2 class="section-title text-center mb-4">Our Core Values</h2><p class="section-subtitle text-center mb-5">Guiding principles that define how we serve</p><div class="row justify-content-center"><div class="col-md-4 mb-4"><div class="text-center p-4" style="background: white; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);"><i class="fas fa-shield-alt" style="font-size: 48px; color: #667eea; margin-bottom: 20px;"></i><h5>Transparency</h5><p>Open and clear communication in all operations</p></div></div><div class="col-md-4 mb-4"><div class="text-center p-4" style="background: white; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);"><i class="fas fa-user-tie" style="font-size: 48px; color: #667eea; margin-bottom: 20px;"></i><h5>Professionalism</h5><p>Delivering services with expertise and integrity</p></div></div></div></div></section>',
                'is_active' => true,
                'sort_order' => 2,
            ],

            // 3. About Us Template
            [
                'name' => 'About Us Page',
                'slug' => 'about-us-page',
                'description' => 'Complete about page with mission, vision, team, and mandate sections',
                'thumbnail' => '/assets/img/templates/about.jpg',
                'category' => 'about',
                'html_content' => '<!-- Mission Section --><section class="mission-section" style="padding: 80px 0; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;"><div class="container text-center"><h2 class="section-title mb-4">Our Mission</h2><p class="mission-text" style="font-size: 18px; max-width: 800px; margin: 0 auto; line-height: 1.8;">To deliver exceptional services with transparency, professionalism, and dedication, ensuring the highest standards of excellence in everything we do.</p></div></section><!-- Mission & Vision Cards --><section class="mv-section" style="padding: 80px 0; background: #f8f9fa;"><div class="container"><h2 class="mv-title text-center mb-4">Our Mission & Vision</h2><div class="row justify-content-center"><div class="col-md-4 mb-4"><div class="mv-card h-100 p-4 text-center" style="background: white; border-radius: 10px;"><i class="fas fa-bullseye" style="font-size: 48px; color: #667eea; margin-bottom: 20px;"></i><h5>Our Mission</h5><p>To provide exceptional services that exceed expectations</p></div></div><div class="col-md-4 mb-4"><div class="mv-card h-100 p-4 text-center" style="background: white; border-radius: 10px;"><i class="fas fa-book-open" style="font-size: 48px; color: #667eea; margin-bottom: 20px;"></i><h5>Our Vision</h5><p>To be the leading organization recognized for innovation</p></div></div></div></div></section>',
                'is_active' => true,
                'sort_order' => 3,
            ],

            // 4. Services Page Template
            [
                'name' => 'Services Grid',
                'slug' => 'services-grid',
                'description' => 'Professional services page with 6 service cards',
                'thumbnail' => '/assets/img/templates/services.jpg',
                'category' => 'services',
                'html_content' => '<!-- Services Hero --><section class="hero-wrapper" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 100px 0; color: white; text-align: center;"><div class="container"><h1 style="font-size: 48px; margin-bottom: 20px;">Our Services</h1><p style="font-size: 18px;">Comprehensive solutions tailored to your needs</p></div></section><!-- Services Grid --><section style="padding: 80px 0;"><div class="container"><div class="text-center mb-5"><h2>What We Offer</h2></div><div class="row"><div class="col-md-4 mb-4"><div class="service-card text-center p-4" style="border: 1px solid #e0e0e0; border-radius: 10px;"><i class="fas fa-laptop-code" style="font-size: 48px; color: #667eea; margin-bottom: 20px;"></i><h4>Web Development</h4><p>Modern, responsive websites</p></div></div></div></div></section>',
                'is_active' => true,
                'sort_order' => 4,
            ],

            // 5. Contact Page Template
            [
                'name' => 'Contact Page',
                'slug' => 'contact-page',
                'description' => 'Contact page with form and office information',
                'thumbnail' => '/assets/img/templates/contact.jpg',
                'category' => 'contact',
                'html_content' => '<!-- Contact Hero --><section class="hero-wrapper" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 80px 0; color: white; text-align: center;"><div class="container"><h1 style="font-size: 48px; margin-bottom: 20px;">Contact Us</h1><p style="font-size: 18px;">We\'d love to hear from you</p></div></section><!-- Contact Info --><section style="padding: 80px 0;"><div class="container"><div class="row"><div class="col-lg-6"><div class="p-4" style="border: 1px solid #e0e0e0; border-radius: 10px;"><h5><i class="fas fa-map-marker-alt"></i> Location</h5><p>123 Main Street, City, State 12345</p></div></div><div class="col-lg-6"><div class="p-4" style="border: 1px solid #e0e0e0; border-radius: 10px;"><h5><i class="fas fa-envelope"></i> Email</h5><p>info@example.com</p></div></div></div></div></section>',
                'is_active' => true,
                'sort_order' => 5,
            ],

            // 6. Landing Page Template
            [
                'name' => 'Product Landing',
                'slug' => 'product-landing',
                'description' => 'Modern product landing page with features and pricing',
                'thumbnail' => '/assets/img/templates/landing.jpg',
                'category' => 'landing',
                'html_content' => '<section style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 120px 0; color: white; text-align: center;"><div class="container"><h1 style="font-size: 56px; font-weight: bold; margin-bottom: 20px;">Transform Your Business</h1><p style="font-size: 24px; margin-bottom: 40px;">The ultimate solution for modern teams</p><a href="#" class="btn btn-light btn-lg me-2">Get Started Free</a><a href="#" class="btn btn-outline-light btn-lg">Watch Demo</a></div></section>',
                'is_active' => true,
                'sort_order' => 6,
            ],

            // 7. Blog/News Template
            [
                'name' => 'Blog Layout',
                'slug' => 'blog-layout',
                'description' => 'Blog page with article grid and sidebar',
                'thumbnail' => '/assets/img/templates/blog.jpg',
                'category' => 'blog',
                'html_content' => '<section style="padding: 80px 0;"><div class="container"><div class="row"><div class="col-lg-8"><h1 class="mb-4">Latest News & Updates</h1><div class="row"><div class="col-md-6 mb-4"><div class="card"><img src="/assets/img/placeholder.jpg" class="card-img-top"><div class="card-body"><h5>Article Title</h5><p class="text-muted">Posted on Jan 1, 2024</p><p>Article excerpt goes here...</p><a href="#" class="btn btn-primary">Read More</a></div></div></div></div></div><div class="col-lg-4"><div class="card"><div class="card-body"><h5>Categories</h5><ul class="list-unstyled"><li><a href="#">News</a></li><li><a href="#">Updates</a></li></ul></div></div></div></div></div></section>',
                'is_active' => true,
                'sort_order' => 7,
            ],

            // 8. Portfolio Template
            [
                'name' => 'Portfolio Grid',
                'slug' => 'portfolio-grid',
                'description' => 'Showcase your work with a beautiful portfolio grid',
                'thumbnail' => '/assets/img/templates/portfolio.jpg',
                'category' => 'portfolio',
                'html_content' => '<section style="padding: 80px 0;"><div class="container"><div class="text-center mb-5"><h1>Our Portfolio</h1><p class="lead">Showcasing our best work</p></div><div class="row g-4"><div class="col-md-4"><div class="position-relative overflow-hidden" style="border-radius: 10px;"><img src="/assets/img/placeholder.jpg" class="w-100"><div class="position-absolute bottom-0 start-0 end-0 p-4" style="background: linear-gradient(transparent, rgba(0,0,0,0.8)); color: white;"><h5>Project Name</h5><p class="mb-0">Category</p></div></div></div></div></div></section>',
                'is_active' => true,
                'sort_order' => 8,
            ],

            // 9. Pricing Table Template
            [
                'name' => 'Pricing Table',
                'slug' => 'pricing-table',
                'description' => '3-column pricing table with highlighted featured plan',
                'thumbnail' => '/assets/img/templates/pricing.jpg',
                'category' => 'pricing',
                'html_content' => '<section style="padding: 80px 0; background: #f8f9fa;"><div class="container"><div class="text-center mb-5"><h2 style="font-size: 36px; font-weight: bold;">Choose Your Plan</h2><p class="lead">Select the perfect plan for your needs</p></div><div class="row"><div class="col-lg-4"><div class="card text-center p-4"><h3>Basic</h3><div class="display-4 my-4">$9<small class="text-muted">/mo</small></div><ul class="list-unstyled"><li class="mb-2">✓ 10 Projects</li><li class="mb-2">✓ 5GB Storage</li><li class="mb-2">✓ Basic Support</li></ul><a href="#" class="btn btn-outline-primary w-100">Get Started</a></div></div><div class="col-lg-4"><div class="card text-center p-4" style="border: 2px solid #667eea; transform: scale(1.05);"><span class="badge bg-primary mb-3">Popular</span><h3>Pro</h3><div class="display-4 my-4">$29<small class="text-muted">/mo</small></div><ul class="list-unstyled"><li class="mb-2">✓ Unlimited Projects</li><li class="mb-2">✓ 50GB Storage</li><li class="mb-2">✓ Priority Support</li></ul><a href="#" class="btn btn-primary w-100">Get Started</a></div></div><div class="col-lg-4"><div class="card text-center p-4"><h3>Enterprise</h3><div class="display-4 my-4">$99<small class="text-muted">/mo</small></div><ul class="list-unstyled"><li class="mb-2">✓ Unlimited Everything</li><li class="mb-2">✓ 500GB Storage</li><li class="mb-2">✓ 24/7 Support</li></ul><a href="#" class="btn btn-outline-primary w-100">Contact Sales</a></div></div></div></div></section>',
                'is_active' => true,
                'sort_order' => 9,
            ],

            // 10. FAQ Template
            [
                'name' => 'FAQ Page',
                'slug' => 'faq-page',
                'description' => 'Frequently asked questions with accordion layout',
                'thumbnail' => '/assets/img/templates/faq.jpg',
                'category' => 'general',
                'html_content' => '<section style="padding: 80px 0;"><div class="container"><div class="text-center mb-5"><h1>Frequently Asked Questions</h1><p class="lead">Find answers to common questions</p></div><div class="row justify-content-center"><div class="col-lg-8"><div class="accordion" id="faqAccordion"><div class="accordion-item mb-3"><h2 class="accordion-header"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">What services do you offer?</button></h2><div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion"><div class="accordion-body">We offer a wide range of professional services tailored to your needs.</div></div></div><div class="accordion-item mb-3"><h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">How can I get started?</button></h2><div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion"><div class="accordion-body">Getting started is easy! Simply contact us and we\'ll guide you through the process.</div></div></div></div></div></div></div></section>',
                'is_active' => true,
                'sort_order' => 10,
            ],

            // 11. Team Page Template
            [
                'name' => 'Team Grid',
                'slug' => 'team-grid',
                'description' => 'Showcase your team members with profile cards',
                'thumbnail' => '/assets/img/templates/team.jpg',
                'category' => 'about',
                'html_content' => '<section style="padding: 80px 0;"><div class="container"><div class="text-center mb-5"><h2>Meet Our Team</h2><p class="lead">The people behind our success</p></div><div class="row"><div class="col-md-4 mb-4"><div class="card text-center"><div class="card-body p-4"><div style="width: 120px; height: 120px; border-radius: 50%; background: linear-gradient(135deg, #667eea, #764ba2); margin: 0 auto 20px; display: flex; align-items: center; justify-content: center;"><i class="fas fa-user" style="font-size: 50px; color: white;"></i></div><h4>John Doe</h4><p class="text-muted">CEO & Founder</p><p>Passionate about innovation and excellence</p><div class="mt-3"><a href="#" class="me-2"><i class="fab fa-linkedin"></i></a><a href="#" class="me-2"><i class="fab fa-twitter"></i></a></div></div></div></div></div></div></section>',
                'is_active' => true,
                'sort_order' => 11,
            ],

            // 12. Event/Conference Template
            [
                'name' => 'Event Page',
                'slug' => 'event-page',
                'description' => 'Event or conference page with schedule and registration',
                'thumbnail' => '/assets/img/templates/event.jpg',
                'category' => 'landing',
                'html_content' => '<section style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 100px 0; color: white; text-align: center;"><div class="container"><h1 style="font-size: 48px; margin-bottom: 10px;">Annual Tech Conference 2024</h1><p style="font-size: 24px; margin-bottom: 30px;">March 15-17, 2024 | Convention Center</p><a href="#" class="btn btn-light btn-lg">Register Now</a></div></section><section style="padding: 80px 0;"><div class="container"><h2 class="text-center mb-5">Event Schedule</h2><div class="row"><div class="col-md-4 mb-4"><div class="card"><div class="card-header bg-primary text-white"><h5 class="mb-0">Day 1 - March 15</h5></div><div class="card-body"><div class="mb-3"><strong>9:00 AM</strong> - Opening Keynote</div><div class="mb-3"><strong>11:00 AM</strong> - Workshop Sessions</div><div class="mb-3"><strong>2:00 PM</strong> - Panel Discussion</div></div></div></div></div></div></section>',
                'is_active' => true,
                'sort_order' => 12,
            ],

            // 13. Testimonials Template
            [
                'name' => 'Testimonials',
                'slug' => 'testimonials-page',
                'description' => 'Customer testimonials and reviews page',
                'thumbnail' => '/assets/img/templates/testimonials.jpg',
                'category' => 'general',
                'html_content' => '<section style="padding: 80px 0; background: #f8f9fa;"><div class="container"><div class="text-center mb-5"><h2>What Our Clients Say</h2><p class="lead">Don\'t just take our word for it</p></div><div class="row"><div class="col-md-4 mb-4"><div class="card h-100"><div class="card-body text-center"><div class="mb-3"><i class="fas fa-quote-left fa-2x text-primary"></i></div><p class="mb-4">"Excellent service and outstanding results. Highly recommend!"</p><div style="width: 60px; height: 60px; border-radius: 50%; background: #667eea; margin: 0 auto 10px;"></div><h6 class="mb-0">Jane Smith</h6><small class="text-muted">CEO, Company Inc</small><div class="mt-2"><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i></div></div></div></div></div></div></section>',
                'is_active' => true,
                'sort_order' => 13,
            ],
        ];

        foreach ($templates as $template) {
            Template::create($template);
        }
    }
}
