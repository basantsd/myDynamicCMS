/**
 * HTML Elements Blocks for GrapesJS Page Builder
 * Adds blocks based on HTML templates to the Elements category
 */

(function(editor) {
    if (!editor) {
        console.error('❌ GrapesJS editor not found!');
        return;
    }

    const blockManager = editor.BlockManager;
    console.log('🚀 Initializing HTML Elements Blocks...');

    // Hero Carousel Block
    blockManager.add('hero-carousel', {
        label: 'Hero Carousel',
        category: 'Elements',
        content: `
            <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active" style="background-image: url('/assets/img/hero/hero_bg_1_1.jpg');">
                        <div class="carousel-caption">
                            <h1>Welcome to Our Site</h1>
                            <h5>Your Tagline Here</h5>
                            <p>Your description goes here</p>
                            <a href="#" class="btn btn-red">Learn More <i class="fas fa-arrow-right ms-2"></i></a>
                            <a href="#" class="btn btn-outline-light">Contact Us</a>
                        </div>
                    </div>
                    <div class="carousel-item" style="background-image: url('/assets/img/hero/hero_bg_1_1.jpg');">
                        <div class="carousel-caption">
                            <h1>Second Slide</h1>
                            <h5>Slide Subtitle</h5>
                            <p>Slide description</p>
                            <a href="#" class="btn btn-red">Learn More <i class="fas fa-arrow-right ms-2"></i></a>
                            <a href="#" class="btn btn-outline-light">Contact Us</a>
                        </div>
                    </div>
                    <div class="carousel-item" style="background-image: url('/assets/img/hero/hero_bg_1_1.jpg');">
                        <div class="carousel-caption">
                            <h1>Third Slide</h1>
                            <h5>Slide Subtitle</h5>
                            <p>Slide description</p>
                            <a href="#" class="btn btn-red">Learn More <i class="fas fa-arrow-right ms-2"></i></a>
                            <a href="#" class="btn btn-outline-light">Contact Us</a>
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
        `,
        attributes: {
            title: 'Hero Carousel - Bootstrap carousel slider'
        }
    });

    // Core Values Section Block
    blockManager.add('core-values', {
        label: 'Core Values Section',
        category: 'Elements',
        content: `
            <section class="core-values-section">
                <div class="container">
                    <h2 class="section-title">Our Core Values</h2>
                    <p class="section-subtitle">Guiding principles that define how we serve</p>
                    <div class="row justify-content-center">
                        <div class="col-md-4 mb-4">
                            <div class="core-card">
                                <i class="fas fa-shield-alt"></i>
                                <h5>Transparency</h5>
                                <p>Open and clear communication in all operations</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="core-card">
                                <i class="fas fa-user-tie"></i>
                                <h5>Professionalism</h5>
                                <p>Delivering services with expertise and integrity</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="core-card">
                                <i class="fas fa-user-shield"></i>
                                <h5>Confidentiality</h5>
                                <p>Protecting sensitive information with strict security</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        `,
        attributes: {
            title: 'Core Values - 3 column cards with icons'
        }
    });

    // Quick Access Section Block
    blockManager.add('quick-access', {
        label: 'Quick Access Cards',
        category: 'Elements',
        content: `
            <section class="quick-access-section">
                <div class="container">
                    <h2 class="section-title">Quick Access</h2>
                    <p class="section-subtitle">Access our key services and resources</p>
                    <div class="row justify-content-center">
                        <div class="col-md-4 mb-4">
                            <div class="quick-card">
                                <h6>Service Title</h6>
                                <p>Service description goes here</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="quick-card">
                                <h6>Service Title</h6>
                                <p>Service description goes here</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="quick-card">
                                <h6>Service Title</h6>
                                <p>Service description goes here</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        `,
        attributes: {
            title: 'Quick Access - Service cards grid'
        }
    });

    // Mission Section Block
    blockManager.add('mission-section', {
        label: 'Mission Statement',
        category: 'Elements',
        content: `
            <section class="mission-section">
                <div class="container text-center">
                    <h2 class="section-title">Our Mission</h2>
                    <p class="mission-text">
                        Your mission statement goes here. Describe your organization's purpose and goals.
                    </p>
                </div>
            </section>
        `,
        attributes: {
            title: 'Mission Statement - Centered text section'
        }
    });

    // Mission & Vision Cards Block
    blockManager.add('mission-vision-cards', {
        label: 'Mission & Vision Cards',
        category: 'Elements',
        content: `
            <section class="mv-section">
                <div class="container">
                    <h2 class="mv-title">Our Mission & Vision</h2>
                    <p class="mv-subtitle">Learn about our mission, vision, and values</p>
                    <div class="row justify-content-center align-items-stretch">
                        <div class="col-md-4 mb-4">
                            <div class="mv-card h-100">
                                <i class="fas fa-bullseye"></i>
                                <h5>Our Mission</h5>
                                <p>Your mission statement goes here</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="mv-card h-100">
                                <i class="fas fa-book-open"></i>
                                <h5>Our Vision</h5>
                                <p>Your vision statement goes here</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="mv-card h-100">
                                <i class="fas fa-heart"></i>
                                <h5>Our Values</h5>
                                <ul class="mv-values-list">
                                    <li><i class="fas fa-circle"></i> Value 1</li>
                                    <li><i class="fas fa-circle"></i> Value 2</li>
                                    <li><i class="fas fa-circle"></i> Value 3</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        `,
        attributes: {
            title: 'Mission & Vision - 3 column cards'
        }
    });

    // Mandate Section Block
    blockManager.add('mandate-section', {
        label: 'Mandate Section',
        category: 'Elements',
        content: `
            <section class="mandate-section">
                <div class="container">
                    <h3 class="mandate-title">Our Mandate</h3>
                    <div class="mandate-box">
                        <p>Introduction to your mandate or responsibilities</p>
                        <ul class="mandate-list">
                            <li><span class="mandate-number">1</span> First responsibility</li>
                            <li><span class="mandate-number">2</span> Second responsibility</li>
                            <li><span class="mandate-number">3</span> Third responsibility</li>
                            <li><span class="mandate-number">4</span> Fourth responsibility</li>
                        </ul>
                    </div>
                </div>
            </section>
        `,
        attributes: {
            title: 'Mandate Section - Numbered list'
        }
    });

    // Team Profile Cards Block
    blockManager.add('team-profile-cards', {
        label: 'Team Profile Cards',
        category: 'Elements',
        content: `
            <section class="team-container">
                <div class="container">
                    <h1>Management Team</h1>
                    <p class="subtitle">Meet the dedicated professionals</p>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="profile-card-unique">
                                <div class="icon-wrapper">
                                    <div class="icon-circle">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>
                                <h3>Name Here</h3>
                                <p class="title">Job Title</p>
                                <hr>
                                <div class="contact-info">
                                    <div><i class="fas fa-envelope"></i> email@example.com</div>
                                    <div><i class="fas fa-phone"></i> +1 (000) 000-0000</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="profile-card-unique">
                                <div class="icon-wrapper">
                                    <div class="icon-circle">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>
                                <h3>Name Here</h3>
                                <p class="title">Job Title</p>
                                <hr>
                                <div class="contact-info">
                                    <div><i class="fas fa-envelope"></i> email@example.com</div>
                                    <div><i class="fas fa-phone"></i> +1 (000) 000-0000</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="profile-card-unique">
                                <div class="icon-wrapper">
                                    <div class="icon-circle">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>
                                <h3>Name Here</h3>
                                <p class="title">Job Title</p>
                                <hr>
                                <div class="contact-info">
                                    <div><i class="fas fa-envelope"></i> email@example.com</div>
                                    <div><i class="fas fa-phone"></i> +1 (000) 000-0000</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        `,
        attributes: {
            title: 'Team Profile Cards - Team member grid'
        }
    });

    // Contact Info Cards Block
    blockManager.add('contact-info-cards', {
        label: 'Contact Info Cards',
        category: 'Elements',
        content: `
            <section class="div-section cash-wrapp">
                <div class="container">
                    <h1 class="div-title">Contact Us</h1>
                    <p class="div-subtitle">Get in touch with us</p>
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="contactpg-card">
                                <h5><i class="fas fa-map-marker-alt"></i> Location</h5>
                                <p>Your Address Line 1</p>
                                <p>Your Address Line 2</p>
                                <p>City, State/Province</p>
                            </div>
                            <div class="contactpg-card">
                                <h5><i class="fas fa-phone-alt"></i> Phone</h5>
                                <p>Main Office: <span class="contactpg-highlight">+1 (000) 000-0000</span></p>
                            </div>
                            <div class="contactpg-card">
                                <h5><i class="fas fa-envelope"></i> Email</h5>
                                <p><a href="mailto:info@example.com">info@example.com</a></p>
                            </div>
                            <div class="contactpg-card">
                                <h5><i class="far fa-clock"></i> Office Hours</h5>
                                <p>Monday - Friday: 8:00 AM - 4:00 PM</p>
                                <p>Saturday - Sunday: Closed</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="contactpg-card side-cont">
                                <h5><i class="fas fa-info-circle"></i> Additional Information</h5>
                                <p>Your additional contact information goes here</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        `,
        attributes: {
            title: 'Contact Info Cards - Contact information layout'
        }
    });

    console.log('✅ HTML Elements Blocks loaded successfully!');
})(window.editor);
