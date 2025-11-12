/**
 * Custom GrapesJS Blocks for Treasury CMS
 * This file contains all custom block definitions for the visual page builder
 */

function addCustomBlocks(editor) {
    // Hero Sections
    editor.BlockManager.add('hero-banner', {
        label: 'Hero Banner',
        category: '🎯 Hero Sections',
        content: `
            <section class="hero-wrapper" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 100px 0; color: white;">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <h1 style="font-size: 48px; font-weight: bold; margin-bottom: 20px;">Welcome to Our Platform</h1>
                            <p style="font-size: 18px; margin-bottom: 30px;">Build amazing websites with our powerful drag-and-drop builder. No coding required!</p>
                            <a href="#" class="btn btn-light btn-lg" style="padding: 12px 30px; border-radius: 30px;">Get Started</a>
                            <a href="#" class="btn btn-outline-light btn-lg ms-2" style="padding: 12px 30px; border-radius: 30px;">Learn More</a>
                        </div>
                        <div class="col-lg-6 text-center">
                            <img src="/assets/img/hero/hero_bg_1_1.jpg" alt="Hero" style="max-width: 100%; border-radius: 10px;">
                        </div>
                    </div>
                </div>
            </section>
        `
    });

    editor.BlockManager.add('hero-centered', {
        label: 'Hero Centered',
        category: '🎯 Hero Sections',
        content: `
            <section style="background-image: url('/assets/img/hero/hero_bg_1_1.jpg'); background-size: cover; background-position: center; padding: 150px 0; position: relative;">
                <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5);"></div>
                <div class="container" style="position: relative; z-index: 1;">
                    <div class="row">
                        <div class="col-12 text-center text-white">
                            <h1 style="font-size: 56px; font-weight: bold; margin-bottom: 20px;">Your Amazing Headline</h1>
                            <p style="font-size: 20px; margin-bottom: 30px;">Subheadline goes here - tell your story</p>
                            <a href="#" class="btn btn-primary btn-lg" style="padding: 15px 40px;">Call to Action</a>
                        </div>
                    </div>
                </div>
            </section>
        `
    });

    // Features/Services
    editor.BlockManager.add('features-3col', {
        label: 'Features 3 Columns',
        category: '✨ Features',
        content: `
            <section style="padding: 80px 0;">
                <div class="container">
                    <div class="text-center mb-5">
                        <h2 style="font-size: 36px; font-weight: bold;">Our Features</h2>
                        <p style="font-size: 18px; color: #666;">Everything you need to succeed</p>
                    </div>
                    <div class="row gy-4">
                        <div class="col-md-4 text-center">
                            <div style="padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                                <i class="fas fa-rocket fa-3x mb-3" style="color: #667eea;"></i>
                                <h3 style="font-size: 24px; margin-bottom: 15px;">Fast Performance</h3>
                                <p style="color: #666;">Lightning-fast loading speeds for the best user experience</p>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div style="padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                                <i class="fas fa-shield-alt fa-3x mb-3" style="color: #667eea;"></i>
                                <h3 style="font-size: 24px; margin-bottom: 15px;">Secure & Safe</h3>
                                <p style="color: #666;">Enterprise-grade security to protect your data</p>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div style="padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                                <i class="fas fa-mobile-alt fa-3x mb-3" style="color: #667eea;"></i>
                                <h3 style="font-size: 24px; margin-bottom: 15px;">Mobile Responsive</h3>
                                <p style="color: #666;">Perfect display on all devices and screen sizes</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        `
    });

    editor.BlockManager.add('features-4col', {
        label: 'Features 4 Columns',
        category: '✨ Features',
        content: `
            <section style="padding: 80px 0; background: #f8f9fa;">
                <div class="container">
                    <div class="row gy-4">
                        <div class="col-lg-3 col-md-6 text-center">
                            <i class="fas fa-check-circle fa-3x mb-3" style="color: #10b981;"></i>
                            <h4>Quality</h4>
                            <p style="color: #666; font-size: 14px;">Premium quality guaranteed</p>
                        </div>
                        <div class="col-lg-3 col-md-6 text-center">
                            <i class="fas fa-clock fa-3x mb-3" style="color: #f59e0b;"></i>
                            <h4>24/7 Support</h4>
                            <p style="color: #666; font-size: 14px;">Always here to help you</p>
                        </div>
                        <div class="col-lg-3 col-md-6 text-center">
                            <i class="fas fa-users fa-3x mb-3" style="color: #3b82f6;"></i>
                            <h4>Community</h4>
                            <p style="color: #666; font-size: 14px;">Join thousands of users</p>
                        </div>
                        <div class="col-lg-3 col-md-6 text-center">
                            <i class="fas fa-star fa-3x mb-3" style="color: #fbbf24;"></i>
                            <h4>Top Rated</h4>
                            <p style="color: #666; font-size: 14px;">5-star reviews worldwide</p>
                        </div>
                    </div>
                </div>
            </section>
        `
    });

    // Call to Actions
    editor.BlockManager.add('cta-simple', {
        label: 'CTA Simple',
        category: '📣 Call to Actions',
        content: `
            <section style="padding: 60px 0; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h2 style="font-size: 32px; margin-bottom: 10px;">Ready to Get Started?</h2>
                            <p style="font-size: 18px; margin: 0;">Join thousands of satisfied customers today</p>
                        </div>
                        <div class="col-lg-4 text-end">
                            <a href="#" class="btn btn-light btn-lg" style="padding: 12px 40px; border-radius: 30px;">Get Started</a>
                        </div>
                    </div>
                </div>
            </section>
        `
    });

    editor.BlockManager.add('cta-centered', {
        label: 'CTA Centered',
        category: '📣 Call to Actions',
        content: `
            <section style="padding: 80px 0; background: #1f2937; color: white; text-align: center;">
                <div class="container">
                    <h2 style="font-size: 42px; margin-bottom: 20px; font-weight: bold;">Transform Your Business Today</h2>
                    <p style="font-size: 20px; margin-bottom: 30px; color: #d1d5db;">Start your free trial now. No credit card required.</p>
                    <a href="#" class="btn btn-primary btn-lg me-2" style="padding: 15px 40px;">Start Free Trial</a>
                    <a href="#" class="btn btn-outline-light btn-lg" style="padding: 15px 40px;">Contact Sales</a>
                </div>
            </section>
        `
    });

    // Pricing Tables
    editor.BlockManager.add('pricing-3col', {
        label: 'Pricing 3 Plans',
        category: '💰 Pricing',
        content: `
            <section style="padding: 80px 0; background: #f8f9fa;">
                <div class="container">
                    <div class="text-center mb-5">
                        <h2 style="font-size: 36px; font-weight: bold;">Choose Your Plan</h2>
                        <p style="font-size: 18px; color: #666;">Simple, transparent pricing</p>
                    </div>
                    <div class="row gy-4">
                        <div class="col-lg-4">
                            <div style="background: white; padding: 40px; border-radius: 10px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                                <h3 style="font-size: 24px; margin-bottom: 10px;">Starter</h3>
                                <div style="font-size: 48px; font-weight: bold; margin: 20px 0;"><span style="font-size: 24px;">$</span>9<span style="font-size: 18px; color: #666;">/mo</span></div>
                                <ul style="list-style: none; padding: 0; margin: 30px 0;">
                                    <li style="margin: 15px 0;"><i class="fas fa-check" style="color: #10b981;"></i> 10 Projects</li>
                                    <li style="margin: 15px 0;"><i class="fas fa-check" style="color: #10b981;"></i> 1 GB Storage</li>
                                    <li style="margin: 15px 0;"><i class="fas fa-check" style="color: #10b981;"></i> Email Support</li>
                                </ul>
                                <a href="#" class="btn btn-outline-primary" style="padding: 10px 30px; width: 100%;">Get Started</a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div style="background: white; padding: 40px; border-radius: 10px; text-align: center; box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3); border: 2px solid #3b82f6; position: relative;">
                                <div style="position: absolute; top: -15px; left: 50%; transform: translateX(-50%); background: #3b82f6; color: white; padding: 5px 20px; border-radius: 20px; font-size: 12px;">POPULAR</div>
                                <h3 style="font-size: 24px; margin-bottom: 10px;">Professional</h3>
                                <div style="font-size: 48px; font-weight: bold; margin: 20px 0;"><span style="font-size: 24px;">$</span>29<span style="font-size: 18px; color: #666;">/mo</span></div>
                                <ul style="list-style: none; padding: 0; margin: 30px 0;">
                                    <li style="margin: 15px 0;"><i class="fas fa-check" style="color: #10b981;"></i> 100 Projects</li>
                                    <li style="margin: 15px 0;"><i class="fas fa-check" style="color: #10b981;"></i> 10 GB Storage</li>
                                    <li style="margin: 15px 0;"><i class="fas fa-check" style="color: #10b981;"></i> Priority Support</li>
                                </ul>
                                <a href="#" class="btn btn-primary" style="padding: 10px 30px; width: 100%;">Get Started</a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div style="background: white; padding: 40px; border-radius: 10px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                                <h3 style="font-size: 24px; margin-bottom: 10px;">Enterprise</h3>
                                <div style="font-size: 48px; font-weight: bold; margin: 20px 0;"><span style="font-size: 24px;">$</span>99<span style="font-size: 18px; color: #666;">/mo</span></div>
                                <ul style="list-style: none; padding: 0; margin: 30px 0;">
                                    <li style="margin: 15px 0;"><i class="fas fa-check" style="color: #10b981;"></i> Unlimited Projects</li>
                                    <li style="margin: 15px 0;"><i class="fas fa-check" style="color: #10b981;"></i> 100 GB Storage</li>
                                    <li style="margin: 15px 0;"><i class="fas fa-check" style="color: #10b981;"></i> 24/7 Support</li>
                                </ul>
                                <a href="#" class="btn btn-outline-primary" style="padding: 10px 30px; width: 100%;">Contact Sales</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        `
    });

    // Statistics/Counters
    editor.BlockManager.add('stats-4col', {
        label: 'Statistics 4 Col',
        category: '📊 Statistics',
        content: `
            <section style="padding: 60px 0; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                <div class="container">
                    <div class="row text-center">
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div style="font-size: 48px; font-weight: bold;">1000+</div>
                            <div style="font-size: 18px; margin-top: 10px;">Happy Clients</div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div style="font-size: 48px; font-weight: bold;">500+</div>
                            <div style="font-size: 18px; margin-top: 10px;">Projects Completed</div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div style="font-size: 48px; font-weight: bold;">50+</div>
                            <div style="font-size: 18px; margin-top: 10px;">Awards Won</div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div style="font-size: 48px; font-weight: bold;">15+</div>
                            <div style="font-size: 18px; margin-top: 10px;">Years Experience</div>
                        </div>
                    </div>
                </div>
            </section>
        `
    });

    // Testimonials
    editor.BlockManager.add('testimonial-card', {
        label: 'Testimonial Card',
        category: '💬 Testimonials',
        content: `
            <section style="padding: 80px 0;">
                <div class="container">
                    <div class="text-center mb-5">
                        <h2 style="font-size: 36px; font-weight: bold;">What Our Clients Say</h2>
                        <p style="font-size: 18px; color: #666;">Don't take our word for it</p>
                    </div>
                    <div class="row gy-4">
                        <div class="col-lg-4">
                            <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                                <div style="color: #fbbf24; margin-bottom: 15px;">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                                <p style="font-style: italic; color: #666; margin-bottom: 20px;">"This product has completely transformed how we work. Highly recommended!"</p>
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 50px; height: 50px; border-radius: 50%; background: #e5e7eb; margin-right: 15px;"></div>
                                    <div>
                                        <div style="font-weight: bold;">John Smith</div>
                                        <div style="font-size: 14px; color: #666;">CEO, Company Inc.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                                <div style="color: #fbbf24; margin-bottom: 15px;">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                                <p style="font-style: italic; color: #666; margin-bottom: 20px;">"Outstanding service and support. The team is amazing!"</p>
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 50px; height: 50px; border-radius: 50%; background: #e5e7eb; margin-right: 15px;"></div>
                                    <div>
                                        <div style="font-weight: bold;">Sarah Johnson</div>
                                        <div style="font-size: 14px; color: #666;">Marketing Director</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                                <div style="color: #fbbf24; margin-bottom: 15px;">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                                <p style="font-style: italic; color: #666; margin-bottom: 20px;">"Best investment we've made. ROI was incredible!"</p>
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 50px; height: 50px; border-radius: 50%; background: #e5e7eb; margin-right: 15px;"></div>
                                    <div>
                                        <div style="font-weight: bold;">Mike Davis</div>
                                        <div style="font-size: 14px; color: #666;">Founder, StartupCo</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        `
    });

    // Contact/Newsletter
    editor.BlockManager.add('newsletter-signup', {
        label: 'Newsletter',
        category: '✉️ Forms',
        content: `
            <section style="padding: 60px 0; background: #f8f9fa;">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 text-center">
                            <h2 style="font-size: 32px; font-weight: bold; margin-bottom: 15px;">Subscribe to Our Newsletter</h2>
                            <p style="font-size: 16px; color: #666; margin-bottom: 30px;">Get the latest updates and offers delivered to your inbox</p>
                            <form style="display: flex; gap: 10px;">
                                <input type="email" placeholder="Enter your email" style="flex: 1; padding: 12px 20px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                                <button type="submit" class="btn btn-primary" style="padding: 12px 30px; white-space: nowrap;">Subscribe</button>
                            </form>
                            <p style="font-size: 12px; color: #999; margin-top: 15px;">We respect your privacy. Unsubscribe at any time.</p>
                        </div>
                    </div>
                </div>
            </section>
        `
    });

    // Team Section
    editor.BlockManager.add('team-grid', {
        label: 'Team Grid',
        category: '👥 Team',
        content: `
            <section style="padding: 80px 0; background: white;">
                <div class="container">
                    <div class="text-center mb-5">
                        <h2 style="font-size: 36px; font-weight: bold;">Meet Our Team</h2>
                        <p style="font-size: 18px; color: #666;">The people behind our success</p>
                    </div>
                    <div class="row gy-4">
                        <div class="col-lg-3 col-md-6 text-center">
                            <div style="background: #f8f9fa; width: 200px; height: 200px; border-radius: 50%; margin: 0 auto 20px;"></div>
                            <h4 style="font-size: 20px; margin-bottom: 5px;">Team Member</h4>
                            <p style="color: #667eea; margin-bottom: 10px;">Position</p>
                            <div>
                                <a href="#" style="color: #3b82f6; margin: 0 5px;"><i class="fab fa-linkedin"></i></a>
                                <a href="#" style="color: #3b82f6; margin: 0 5px;"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 text-center">
                            <div style="background: #f8f9fa; width: 200px; height: 200px; border-radius: 50%; margin: 0 auto 20px;"></div>
                            <h4 style="font-size: 20px; margin-bottom: 5px;">Team Member</h4>
                            <p style="color: #667eea; margin-bottom: 10px;">Position</p>
                            <div>
                                <a href="#" style="color: #3b82f6; margin: 0 5px;"><i class="fab fa-linkedin"></i></a>
                                <a href="#" style="color: #3b82f6; margin: 0 5px;"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 text-center">
                            <div style="background: #f8f9fa; width: 200px; height: 200px; border-radius: 50%; margin: 0 auto 20px;"></div>
                            <h4 style="font-size: 20px; margin-bottom: 5px;">Team Member</h4>
                            <p style="color: #667eea; margin-bottom: 10px;">Position</p>
                            <div>
                                <a href="#" style="color: #3b82f6; margin: 0 5px;"><i class="fab fa-linkedin"></i></a>
                                <a href="#" style="color: #3b82f6; margin: 0 5px;"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 text-center">
                            <div style="background: #f8f9fa; width: 200px; height: 200px; border-radius: 50%; margin: 0 auto 20px;"></div>
                            <h4 style="font-size: 20px; margin-bottom: 5px;">Team Member</h4>
                            <p style="color: #667eea; margin-bottom: 10px;">Position</p>
                            <div>
                                <a href="#" style="color: #3b82f6; margin: 0 5px;"><i class="fab fa-linkedin"></i></a>
                                <a href="#" style="color: #3b82f6; margin: 0 5px;"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        `
    });

    // Footer
    editor.BlockManager.add('footer-modern', {
        label: 'Modern Footer',
        category: '🦶 Footer',
        content: `
            <footer style="background: #1f2937; color: white; padding: 60px 0 30px;">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 mb-4">
                            <h3 style="font-size: 24px; margin-bottom: 20px;">Your Brand</h3>
                            <p style="color: #d1d5db; margin-bottom: 20px;">Building amazing experiences for our customers worldwide.</p>
                            <div>
                                <a href="#" style="color: white; margin-right: 15px; font-size: 20px;"><i class="fab fa-facebook"></i></a>
                                <a href="#" style="color: white; margin-right: 15px; font-size: 20px;"><i class="fab fa-twitter"></i></a>
                                <a href="#" style="color: white; margin-right: 15px; font-size: 20px;"><i class="fab fa-instagram"></i></a>
                                <a href="#" style="color: white; font-size: 20px;"><i class="fab fa-linkedin"></i></a>
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
                        <div class="col-lg-4 mb-4">
                            <h4 style="font-size: 18px; margin-bottom: 20px;">Newsletter</h4>
                            <p style="color: #d1d5db; margin-bottom: 15px;">Subscribe to get updates</p>
                            <form style="display: flex; margin-bottom: 15px;">
                                <input type="email" placeholder="Your email" style="flex: 1; padding: 10px; border: none; border-radius: 5px 0 0 5px;">
                                <button type="submit" style="padding: 10px 20px; background: #3b82f6; color: white; border: none; border-radius: 0 5px 5px 0; cursor: pointer;">Subscribe</button>
                            </form>
                        </div>
                    </div>
                    <hr style="border-color: #374151; margin: 30px 0;">
                    <div class="text-center" style="color: #9ca3af;">
                        <p>© 2024 Your Company. All rights reserved.</p>
                    </div>
                </div>
            </footer>
        `
    });

    // ========== TREASURY-SPECIFIC BLOCKS ==========

    // 1. Bootstrap Carousel Slider
    editor.BlockManager.add('carousel-slider', {
        label: 'Carousel Slider',
        category: '🏛️ Treasury Sections',
        content: `
            <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active" style="background-image: url('/assets/img/hero/hero_bg_1_1.jpg'); background-size: cover; background-position: center; min-height: 500px;">
                        <div class="carousel-caption">
                            <h1>Accountant General's Department</h1>
                            <h5>Treasury Chambers - St. Kitts and Nevis</h5>
                            <p>Serving the people with transparency, professionalism, and confidentiality.</p>
                            <a href="#" class="btn btn-danger">Our Services <i class="fas fa-arrow-right ms-2"></i></a>
                            <a href="#" class="btn btn-outline-light">Learn More</a>
                        </div>
                    </div>
                    <div class="carousel-item" style="background-image: url('/assets/img/hero/hero_bg_1_1.jpg'); background-size: cover; background-position: center; min-height: 500px;">
                        <div class="carousel-caption">
                            <h1>Professional Expertise</h1>
                            <h5>Experience Excellence in Financial Management</h5>
                            <p>Dedicated to efficient and effective management of Government financial operations.</p>
                            <a href="#" class="btn btn-danger">Our Services <i class="fas fa-arrow-right ms-2"></i></a>
                            <a href="#" class="btn btn-outline-light">Learn More</a>
                        </div>
                    </div>
                    <div class="carousel-item" style="background-image: url('/assets/img/hero/hero_bg_1_1.jpg'); background-size: cover; background-position: center; min-height: 500px;">
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
            </div>
        `
    });

    // 2. Core Values Cards
    editor.BlockManager.add('core-values-cards', {
        label: 'Core Values Cards',
        category: '🏛️ Treasury Sections',
        content: `
            <section class="core-values-section" style="padding: 80px 0;">
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
            </section>
        `
    });
}
