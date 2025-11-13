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
                                <i class="fas fa-users fa-3x mb-3" style="color: #bd2828;"></i>
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
                                <div style="background: white; padding: 40px; border-radius: 10px; text-align: center; box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3); border: 2px solid #bd2828; position: relative;">
                                    <div style="position: absolute; top: -15px; left: 50%; transform: translateX(-50%); background: #bd2828; color: white; padding: 5px 20px; border-radius: 20px; font-size: 12px;">POPULAR</div>
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
                                    <a href="#" style="color: #bd2828; margin: 0 5px;"><i class="fab fa-linkedin"></i></a>
                                    <a href="#" style="color: #bd2828; margin: 0 5px;"><i class="fab fa-twitter"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 text-center">
                                <div style="background: #f8f9fa; width: 200px; height: 200px; border-radius: 50%; margin: 0 auto 20px;"></div>
                                <h4 style="font-size: 20px; margin-bottom: 5px;">Team Member</h4>
                                <p style="color: #667eea; margin-bottom: 10px;">Position</p>
                                <div>
                                    <a href="#" style="color: #bd2828; margin: 0 5px;"><i class="fab fa-linkedin"></i></a>
                                    <a href="#" style="color: #bd2828; margin: 0 5px;"><i class="fab fa-twitter"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 text-center">
                                <div style="background: #f8f9fa; width: 200px; height: 200px; border-radius: 50%; margin: 0 auto 20px;"></div>
                                <h4 style="font-size: 20px; margin-bottom: 5px;">Team Member</h4>
                                <p style="color: #667eea; margin-bottom: 10px;">Position</p>
                                <div>
                                    <a href="#" style="color: #bd2828; margin: 0 5px;"><i class="fab fa-linkedin"></i></a>
                                    <a href="#" style="color: #bd2828; margin: 0 5px;"><i class="fab fa-twitter"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 text-center">
                                <div style="background: #f8f9fa; width: 200px; height: 200px; border-radius: 50%; margin: 0 auto 20px;"></div>
                                <h4 style="font-size: 20px; margin-bottom: 5px;">Team Member</h4>
                                <p style="color: #667eea; margin-bottom: 10px;">Position</p>
                                <div>
                                    <a href="#" style="color: #bd2828; margin: 0 5px;"><i class="fab fa-linkedin"></i></a>
                                    <a href="#" style="color: #bd2828; margin: 0 5px;"><i class="fab fa-twitter"></i></a>
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
                                    <button type="submit" style="padding: 10px 20px; background: #bd2828; color: white; border: none; border-radius: 0 5px 5px 0; cursor: pointer;">Subscribe</button>
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
                <style>
                    #heroCarousel .carousel-indicators button {
                        width: 12px;
                        height: 12px;
                        border-radius: 50%;
                        margin: 0 5px;
                        background-color: rgba(255,255,255,0.5);
                        border: none;
                    }
                    #heroCarousel .carousel-indicators button.active {
                        background-color: #fff;
                    }
                    #heroCarousel .carousel-control-prev,
                    #heroCarousel .carousel-control-next {
                        width: 50px;
                        height: 50px;
                        top: 50%;
                        transform: translateY(-50%);
                        background: rgba(0,0,0,0.3);
                        border-radius: 50%;
                        opacity: 0.8;
                    }
                    #heroCarousel .carousel-control-prev:hover,
                    #heroCarousel .carousel-control-next:hover {
                        opacity: 1;
                        background: rgba(0,0,0,0.5);
                    }
                    #heroCarousel .carousel-control-prev {
                        left: 20px;
                    }
                    #heroCarousel .carousel-control-next {
                        right: 20px;
                    }
                </style>
                <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
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
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
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
                                <div class="core-card" style="background: #fff; padding: 40px 30px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); text-align: center; transition: transform 0.3s;">
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

        // 3. Mission Section
        editor.BlockManager.add('mission-section', {
            label: 'Mission Section',
            category: '🏛️ Treasury Sections',
            content: `
                <section class="mission-section" style="background: linear-gradient(135deg, #bd2828 0%, #8b1c1c 100%); padding: 60px 0; color: white;">
                    <div class="container text-center">
                        <h2 class="section-title" style="font-size: 32px; margin-bottom: 25px; font-weight: 600;">Our Mission</h2>
                        <p class="mission-text" style="font-size: 18px; line-height: 1.8; max-width: 900px; margin: 0 auto;">
                            To ensure efficient and effective managing and reporting of Government's financial operations, in order to support and foster the achievements of the Government's goals and objectives with the highest level of proficiency, confidentiality and professionalism with the support of a well-trained and highly motivated staff.
                        </p>
                    </div>
                </section>
            `
        });

        // 4. Mandate Box
        editor.BlockManager.add('mandate-box', {
            label: 'Mandate Box',
            category: '🏛️ Treasury Sections',
            content: `
                <section class="mandate-section" style="padding: 80px 0; background: #f8f9fa;">
                    <div class="container">
                        <h3 style="text-align: center; font-size: 32px; margin-bottom: 40px;">Our Mandate</h3>
                        <div class="mandate-box" style="background: white; padding: 40px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
                            <p style="margin-bottom: 20px; line-height: 1.8; color: #333;">
                                The Accountant General's Department is administered under the Finance Administration Act, 2007.
                                In accordance with the directions of the Financial Secretary, the Accountant General is responsible for:
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
                </section>
            `
        });

        // 5. Division Boxes
        editor.BlockManager.add('division-boxes', {
            label: 'Division Boxes',
            category: '🏛️ Treasury Sections',
            content: `
                <section style="padding: 80px 0;">
                    <div class="container">
                        <h2 style="text-align: center; font-size: 36px; margin-bottom: 15px;">Divisions & Units</h2>
                        <p style="text-align: center; color: #666; margin-bottom: 50px;">
                            Explore the different divisions and units that make up the Accountant General's Department
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
                                        <li>Monitoring of Government's cash position</li>
                                        <li>Liaison between Government and banking partners</li>
                                        <li>Ensuring obligations are adequately funded</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            `
        });

        // 6. Profile Cards (Team)
        editor.BlockManager.add('profile-cards', {
            label: 'Profile Cards',
            category: '🏛️ Treasury Sections',
            content: `
                <section style="padding: 80px 0; background: #f8f9fa;">
                    <div class="container">
                        <h1 style="text-align: center; font-size: 36px; margin-bottom: 15px;">Management Team</h1>
                        <p style="text-align: center; color: #666; margin-bottom: 50px;">Meet the dedicated professionals leading the Accountant General's Department</p>
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
                </section>
            `
        });

        // 7. Budget Box
        editor.BlockManager.add('budget-box', {
            label: 'Budget Box',
            category: '🏛️ Treasury Sections',
            content: `
                <section style="padding: 60px 0;">
                    <div class="container">
                        <div class="budget-box" style="background: #fff; padding: 40px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); border-left: 5px solid #bd2828;">
                            <h2 style="font-size: 28px; margin-bottom: 20px; color: #bd2828;">Budget Overview</h2>
                            <p style="color: #666; line-height: 1.8; margin-bottom: 25px;">
                                The national budget sets out the Government's spending plan and priorities for the fiscal year.
                            </p>
                            <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 15px;">Key Budget Themes</h3>
                            <ul style="line-height: 2; color: #666;">
                                <li>Supporting economic growth</li>
                                <li>Public infrastructure development</li>
                                <li>Fiscal responsibility and transparency</li>
                            </ul>
                        </div>
                    </div>
                </section>
            `
        });

        // 8. Download Section
        editor.BlockManager.add('download-section', {
            label: 'Download Section',
            category: '🏛️ Treasury Sections',
            content: `
                <section style="padding: 60px 0; background: #f8f9fa;">
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

                            <div class="download-item" style="display: flex; justify-content: space-between; align-items: center; padding: 20px; background: #f8f9fa; border-radius: 8px; margin-bottom: 15px;">
                                <div class="download-info">
                                    <i class="fas fa-download" style="color: #bd2828; margin-right: 10px;"></i>
                                    <span style="font-weight: 600;">Budget 2024</span>
                                </div>
                                <button class="download-btn" style="background: #bd2828; color: white; border: none; padding: 10px 25px; border-radius: 5px; cursor: pointer; font-weight: 600;">Download PDF</button>
                            </div>

                            <div class="download-item" style="display: flex; justify-content: space-between; align-items: center; padding: 20px; background: #f8f9fa; border-radius: 8px;">
                                <div class="download-info">
                                    <i class="fas fa-download" style="color: #bd2828; margin-right: 10px;"></i>
                                    <span style="font-weight: 600;">Budget 2023</span>
                                </div>
                                <button class="download-btn" style="background: #bd2828; color: white; border: none; padding: 10px 25px; border-radius: 5px; cursor: pointer; font-weight: 600;">Download PDF</button>
                            </div>
                        </div>
                    </div>
                </section>
            `
        });

        // 9. Calculator Box
        editor.BlockManager.add('calculator-box', {
            label: 'Calculator Box',
            category: '🏛️ Treasury Sections',
            content: `
                <section style="padding: 60px 0;">
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
                </section>
            `
        });

        // 10. Treasury News Card
        editor.BlockManager.add('treasury-news-cards', {
            label: 'Treasury News Cards',
            category: '🏛️ Treasury Sections',
            content: `
                <section style="padding: 80px 0; background: #f8f9fa;">
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
                </section>
            `
        });

        // 11. Public Notice Cards
        editor.BlockManager.add('public-notice-cards', {
            label: 'Public Notice Cards',
            category: '🏛️ Treasury Sections',
            content: `
                <section style="padding: 80px 0;">
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
                </section>
            `
        });

        // 12. Guarantee Cards
        editor.BlockManager.add('guarantee-cards', {
            label: 'Guarantee Cards',
            category: '🏛️ Treasury Sections',
            content: `
                <section style="padding: 80px 0; background: #f8f9fa;">
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
                </section>
            `
        });

        // 13. Filter/Download Center Box
        editor.BlockManager.add('filter-download-box', {
            label: 'Filter Download Box',
            category: '🏛️ Treasury Sections',
            content: `
                <section style="padding: 80px 0;">
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

                            <!-- Results Table -->
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
                </section>
            `
        });

        // ========== MORE SLIDER/CAROUSEL BLOCKS ==========

        // Image Gallery Slider
        editor.BlockManager.add('image-slider', {
            label: 'Image Gallery Slider',
            category: '🎢 Sliders',
            content: `
                <style>
                    #imageSlider .carousel-control-prev,
                    #imageSlider .carousel-control-next {
                        width: 50px;
                        height: 50px;
                        top: 50%;
                        transform: translateY(-50%);
                        background: rgba(0,0,0,0.5);
                        border-radius: 50%;
                        opacity: 0.7;
                    }
                    #imageSlider .carousel-control-prev:hover,
                    #imageSlider .carousel-control-next:hover {
                        opacity: 1;
                    }
                    #imageSlider .carousel-control-prev {
                        left: 20px;
                    }
                    #imageSlider .carousel-control-next {
                        right: 20px;
                    }
                </style>
                <div id="imageSlider" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="/assets/img/hero/hero_bg_1_1.jpg" class="d-block w-100" alt="Image 1" style="height: 400px; object-fit: cover;">
                        </div>
                        <div class="carousel-item">
                            <img src="/assets/img/hero/hero_bg_1_1.jpg" class="d-block w-100" alt="Image 2" style="height: 400px; object-fit: cover;">
                        </div>
                        <div class="carousel-item">
                            <img src="/assets/img/hero/hero_bg_1_1.jpg" class="d-block w-100" alt="Image 3" style="height: 400px; object-fit: cover;">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#imageSlider" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#imageSlider" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            `
        });

        // Testimonial Slider
        editor.BlockManager.add('testimonial-slider', {
            label: 'Testimonial Slider',
            category: '🎢 Sliders',
            content: `
                <style>
                    #testimonialSlider .carousel-control-prev,
                    #testimonialSlider .carousel-control-next {
                        width: 50px;
                        height: 50px;
                        top: 50%;
                        transform: translateY(-50%);
                        background: rgba(102, 126, 234, 0.8);
                        border-radius: 50%;
                        opacity: 0.8;
                    }
                    #testimonialSlider .carousel-control-prev:hover,
                    #testimonialSlider .carousel-control-next:hover {
                        opacity: 1;
                        background: rgba(102, 126, 234, 1);
                    }
                    #testimonialSlider .carousel-control-prev {
                        left: 20px;
                    }
                    #testimonialSlider .carousel-control-next {
                        right: 20px;
                    }
                </style>
                <section style="padding: 80px 0; background: #f8f9fa;">
                    <div class="container">
                        <h2 style="text-align: center; margin-bottom: 50px;">Client Testimonials</h2>
                        <div id="testimonialSlider" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="text-center" style="max-width: 800px; margin: 0 auto; padding: 40px;">
                                        <i class="fas fa-quote-left" style="font-size: 48px; color: #667eea; margin-bottom: 30px;"></i>
                                        <p style="font-size: 20px; line-height: 1.8; color: #333; margin-bottom: 30px;">"This service has transformed our business. Professional and exceptional results."</p>
                                        <div style="width: 80px; height: 80px; border-radius: 50%; background: #e5e7eb; margin: 0 auto 15px;"></div>
                                        <h5 style="font-weight: 600; margin-bottom: 5px;">Sarah Johnson</h5>
                                        <p style="color: #667eea;">CEO, Tech Solutions</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="text-center" style="max-width: 800px; margin: 0 auto; padding: 40px;">
                                        <i class="fas fa-quote-left" style="font-size: 48px; color: #667eea; margin-bottom: 30px;"></i>
                                        <p style="font-size: 20px; line-height: 1.8; color: #333; margin-bottom: 30px;">"Outstanding experience! Exceeded all our expectations."</p>
                                        <div style="width: 80px; height: 80px; border-radius: 50%; background: #e5e7eb; margin: 0 auto 15px;"></div>
                                        <h5 style="font-weight: 600; margin-bottom: 5px;">Michael Chen</h5>
                                        <p style="color: #667eea;">Director, Innovation Hub</p>
                                    </div>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#testimonialSlider" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#testimonialSlider" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </section>
            `
        });

        // ========== TABLE BLOCKS ==========

        // Simple Data Table
        editor.BlockManager.add('simple-table', {
            label: 'Simple Data Table',
            category: '📋 Tables',
            content: `
                <section style="padding: 60px 0;">
                    <div class="container">
                        <h2 style="margin-bottom: 30px;">Data Table</h2>
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse; background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
                                <thead>
                                    <tr style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                                        <th style="padding: 15px; text-align: left;">Name</th>
                                        <th style="padding: 15px; text-align: left;">Position</th>
                                        <th style="padding: 15px; text-align: left;">Department</th>
                                        <th style="padding: 15px; text-align: left;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="border-bottom: 1px solid #e5e7eb;">
                                        <td style="padding: 15px;">John Doe</td>
                                        <td style="padding: 15px;">Manager</td>
                                        <td style="padding: 15px;">Sales</td>
                                        <td style="padding: 15px;"><span style="background: #10b981; color: white; padding: 5px 15px; border-radius: 20px; font-size: 12px;">Active</span></td>
                                    </tr>
                                    <tr style="border-bottom: 1px solid #e5e7eb; background: #f9fafb;">
                                        <td style="padding: 15px;">Jane Smith</td>
                                        <td style="padding: 15px;">Developer</td>
                                        <td style="padding: 15px;">Engineering</td>
                                        <td style="padding: 15px;"><span style="background: #10b981; color: white; padding: 5px 15px; border-radius: 20px; font-size: 12px;">Active</span></td>
                                    </tr>
                                    <tr style="border-bottom: 1px solid #e5e7eb;">
                                        <td style="padding: 15px;">Bob Johnson</td>
                                        <td style="padding: 15px;">Designer</td>
                                        <td style="padding: 15px;">Creative</td>
                                        <td style="padding: 15px;"><span style="background: #f59e0b; color: white; padding: 5px 15px; border-radius: 20px; font-size: 12px;">Pending</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            `
        });

        // Comparison Table
        editor.BlockManager.add('comparison-table', {
            label: 'Comparison Table',
            category: '📋 Tables',
            content: `
                <section style="padding: 80px 0; background: #f8f9fa;">
                    <div class="container">
                        <h2 style="text-align: center; margin-bottom: 50px;">Feature Comparison</h2>
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse; background: white;">
                                <thead>
                                    <tr>
                                        <th style="padding: 20px; text-align: left; background: #667eea; color: white;">Feature</th>
                                        <th style="padding: 20px; text-align: center; background: #667eea; color: white;">Basic</th>
                                        <th style="padding: 20px; text-align: center; background: #bd2828; color: white;">Pro</th>
                                        <th style="padding: 20px; text-align: center; background: #667eea; color: white;">Enterprise</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="border-bottom: 1px solid #e5e7eb;">
                                        <td style="padding: 20px; font-weight: 600;">Users</td>
                                        <td style="padding: 20px; text-align: center;">5</td>
                                        <td style="padding: 20px; text-align: center; background: #fef3f2;">50</td>
                                        <td style="padding: 20px; text-align: center;">Unlimited</td>
                                    </tr>
                                    <tr style="border-bottom: 1px solid #e5e7eb; background: #f9fafb;">
                                        <td style="padding: 20px; font-weight: 600;">Storage</td>
                                        <td style="padding: 20px; text-align: center;">10 GB</td>
                                        <td style="padding: 20px; text-align: center; background: #fef3f2;">100 GB</td>
                                        <td style="padding: 20px; text-align: center;">1 TB</td>
                                    </tr>
                                    <tr style="border-bottom: 1px solid #e5e7eb;">
                                        <td style="padding: 20px; font-weight: 600;">Support</td>
                                        <td style="padding: 20px; text-align: center;"><i class="fas fa-check" style="color: #10b981;"></i></td>
                                        <td style="padding: 20px; text-align: center; background: #fef3f2;"><i class="fas fa-check" style="color: #10b981;"></i></td>
                                        <td style="padding: 20px; text-align: center;"><i class="fas fa-check" style="color: #10b981;"></i></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            `
        });

        // ========== BUTTON COLLECTION BLOCKS ==========

        // Button Collection
        editor.BlockManager.add('button-collection', {
            label: 'Button Collection',
            category: '🔘 Buttons',
            content: `
                <section style="padding: 60px 0; background: #f8f9fa;">
                    <div class="container">
                        <h2 style="text-align: center; margin-bottom: 40px;">Button Styles</h2>
                        <div class="row g-4">
                            <div class="col-md-4 text-center">
                                <h5 style="margin-bottom: 20px;">Primary Buttons</h5>
                                <a href="#" class="btn btn-primary" style="padding: 12px 30px; margin: 5px; display: inline-block;">Primary</a><br>
                                <a href="#" class="btn btn-success" style="padding: 12px 30px; margin: 5px; display: inline-block;">Success</a><br>
                                <a href="#" class="btn btn-danger" style="padding: 12px 30px; margin: 5px; display: inline-block;">Danger</a>
                            </div>
                            <div class="col-md-4 text-center">
                                <h5 style="margin-bottom: 20px;">Outlined Buttons</h5>
                                <a href="#" class="btn btn-outline-primary" style="padding: 12px 30px; margin: 5px; display: inline-block;">Outline</a><br>
                                <a href="#" class="btn btn-outline-success" style="padding: 12px 30px; margin: 5px; display: inline-block;">Outline</a><br>
                                <a href="#" class="btn btn-outline-danger" style="padding: 12px 30px; margin: 5px; display: inline-block;">Outline</a>
                            </div>
                            <div class="col-md-4 text-center">
                                <h5 style="margin-bottom: 20px;">Icon Buttons</h5>
                                <a href="#" class="btn btn-primary" style="padding: 12px 30px; margin: 5px; display: inline-block;"><i class="fas fa-download me-2"></i>Download</a><br>
                                <a href="#" class="btn btn-success" style="padding: 12px 30px; margin: 5px; display: inline-block;"><i class="fas fa-check me-2"></i>Success</a><br>
                                <a href="#" class="btn btn-info" style="padding: 12px 30px; margin: 5px; display: inline-block;"><i class="fas fa-info me-2"></i>Info</a>
                            </div>
                        </div>
                    </div>
                </section>
            `
        });

        // CTA Buttons
        editor.BlockManager.add('cta-buttons', {
            label: 'CTA Button Group',
            category: '🔘 Buttons',
            content: `
                <section style="padding: 60px 0;">
                    <div class="container text-center">
                        <h2 style="margin-bottom: 30px;">Take Action Now</h2>
                        <div style="margin-bottom: 20px;">
                            <a href="#" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 15px 40px; border-radius: 30px; text-decoration: none; display: inline-block; font-weight: 600; margin: 10px; box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);">Get Started Now</a>
                        </div>
                        <div style="margin-bottom: 20px;">
                            <a href="#" style="background: #bd2828; color: white; padding: 15px 40px; border-radius: 5px; text-decoration: none; display: inline-block; font-weight: 600; margin: 10px;">Join Today <i class="fas fa-arrow-right ms-2"></i></a>
                        </div>
                        <div style="margin-bottom: 20px;">
                            <a href="#" style="background: #10b981; color: white; padding: 18px 50px; border-radius: 50px; text-decoration: none; display: inline-block; font-weight: 600; margin: 10px; box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);"><i class="fas fa-play-circle me-2"></i>Watch Demo</a>
                        </div>
                    </div>
                </section>
            `
        });

        // ========== LISTING BLOCKS ==========

        // Bullet List
        editor.BlockManager.add('bullet-list', {
            label: 'Bullet List',
            category: '📝 Lists',
            content: `
                <section style="padding: 60px 0;">
                    <div class="container">
                        <h2 style="margin-bottom: 30px;">Key Features</h2>
                        <ul style="list-style: none; padding: 0;">
                            <li style="padding: 15px 0; border-bottom: 1px solid #e5e7eb; display: flex; align-items: start;">
                                <i class="fas fa-check-circle" style="color: #10b981; margin-right: 15px; margin-top: 5px; font-size: 20px;"></i>
                                <span style="flex: 1; line-height: 1.6;">Easy to use drag-and-drop interface</span>
                            </li>
                            <li style="padding: 15px 0; border-bottom: 1px solid #e5e7eb; display: flex; align-items: start;">
                                <i class="fas fa-check-circle" style="color: #10b981; margin-right: 15px; margin-top: 5px; font-size: 20px;"></i>
                                <span style="flex: 1; line-height: 1.6;">Responsive design for all devices</span>
                            </li>
                            <li style="padding: 15px 0; border-bottom: 1px solid #e5e7eb; display: flex; align-items: start;">
                                <i class="fas fa-check-circle" style="color: #10b981; margin-right: 15px; margin-top: 5px; font-size: 20px;"></i>
                                <span style="flex: 1; line-height: 1.6;">24/7 customer support available</span>
                            </li>
                            <li style="padding: 15px 0; border-bottom: 1px solid #e5e7eb; display: flex; align-items: start;">
                                <i class="fas fa-check-circle" style="color: #10b981; margin-right: 15px; margin-top: 5px; font-size: 20px;"></i>
                                <span style="flex: 1; line-height: 1.6;">Regular updates and new features</span>
                            </li>
                            <li style="padding: 15px 0; display: flex; align-items: start;">
                                <i class="fas fa-check-circle" style="color: #10b981; margin-right: 15px; margin-top: 5px; font-size: 20px;"></i>
                                <span style="flex: 1; line-height: 1.6;">Secure and encrypted data storage</span>
                            </li>
                        </ul>
                    </div>
                </section>
            `
        });

        // Icon List
        editor.BlockManager.add('icon-list', {
            label: 'Icon List',
            category: '📝 Lists',
            content: `
                <section style="padding: 60px 0; background: #f8f9fa;">
                    <div class="container">
                        <h2 style="text-align: center; margin-bottom: 50px;">What We Offer</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <div style="display: flex; align-items: start; margin-bottom: 30px;">
                                    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-right: 20px;">
                                        <i class="fas fa-rocket" style="color: white; font-size: 20px;"></i>
                                    </div>
                                    <div>
                                        <h5 style="margin-bottom: 10px;">Fast Performance</h5>
                                        <p style="color: #666; line-height: 1.6;">Lightning-fast loading speeds</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="display: flex; align-items: start; margin-bottom: 30px;">
                                    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-right: 20px;">
                                        <i class="fas fa-shield-alt" style="color: white; font-size: 20px;"></i>
                                    </div>
                                    <div>
                                        <h5 style="margin-bottom: 10px;">Secure & Safe</h5>
                                        <p style="color: #666; line-height: 1.6;">Enterprise-grade security</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            `
        });

        // Numbered List
        editor.BlockManager.add('numbered-list', {
            label: 'Numbered List',
            category: '📝 Lists',
            content: `
                <section style="padding: 60px 0;">
                    <div class="container">
                        <h2 style="margin-bottom: 30px;">How It Works</h2>
                        <div style="max-width: 800px;">
                            <div style="display: flex; align-items: start; margin-bottom: 30px;">
                                <div style="background: #667eea; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-right: 20px; font-weight: 600; font-size: 18px;">1</div>
                                <div style="flex: 1;">
                                    <h4 style="margin-bottom: 10px;">Sign Up</h4>
                                    <p style="color: #666; line-height: 1.6;">Create your account in just 30 seconds</p>
                                </div>
                            </div>
                            <div style="display: flex; align-items: start; margin-bottom: 30px;">
                                <div style="background: #667eea; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-right: 20px; font-weight: 600; font-size: 18px;">2</div>
                                <div style="flex: 1;">
                                    <h4 style="margin-bottom: 10px;">Customize</h4>
                                    <p style="color: #666; line-height: 1.6;">Set up your workspace</p>
                                </div>
                            </div>
                            <div style="display: flex; align-items: start;">
                                <div style="background: #10b981; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-right: 20px; font-weight: 600; font-size: 18px;"><i class="fas fa-check"></i></div>
                                <div style="flex: 1;">
                                    <h4 style="margin-bottom: 10px;">Launch</h4>
                                    <p style="color: #666; line-height: 1.6;">You're all set!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            `
        });

        console.log('✅ All Custom Blocks Loaded Successfully! (40+ Blocks Available)');
    }
