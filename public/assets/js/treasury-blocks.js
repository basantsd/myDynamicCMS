/**
 * Treasury Custom Blocks for GrapesJS Visual Page Builder
 * Provides dynamic, configurable sections for treasury website
 */

(function (editor) {
    const blockManager = editor.BlockManager;
    const domComponents = editor.DomComponents;

    // Custom category for Treasury blocks
    blockManager.getCategories().reset([
        { id: 'treasury', label: 'Treasury Sections' },
        { id: 'basic', label: 'Basic' },
        { id: 'layout', label: 'Layout' },
    ]);

    // ===========================================
    // 1. CAROUSEL/SLIDER BLOCK
    // ===========================================
    blockManager.add('treasury-carousel', {
        label: '<div class="gjs-block-label"><i class="fa fa-images"></i><br>Carousel</div>',
        category: 'Treasury Sections',
        content: {
            type: 'treasury-carousel',
            components: `
                <section class="treasury-carousel-section">
                    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active" style="background-image: url('/assets/img/hero/hero_bg_1_1.jpg'); min-height: 500px; background-size: cover; background-position: center;">
                                <div class="carousel-caption">
                                    <h1>Slide Title 1</h1>
                                    <h5>Subtitle</h5>
                                    <p>Slide description text</p>
                                    <a href="#" class="btn btn-red">Button 1</a>
                                    <a href="#" class="btn btn-outline-light">Button 2</a>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                            <i class="fa fa-long-arrow-left"></i>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                            <i class="fa fa-long-arrow-right"></i>
                        </button>
                    </div>
                </section>
            `,
        },
    });

    // Define carousel component type
    domComponents.addType('treasury-carousel', {
        model: {
            defaults: {
                traits: [
                    {
                        type: 'button',
                        label: 'Add New Slide',
                        text: 'Add Slide',
                        command: (editor) => {
                            const selected = editor.getSelected();
                            const carouselInner = selected.find('.carousel-inner')[0];
                            const indicators = selected.find('.carousel-indicators')[0];
                            const slideCount = carouselInner.components().length;

                            // Add indicator
                            indicators.append(`<button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="${slideCount}"></button>`);

                            // Add slide
                            carouselInner.append(`
                                <div class="carousel-item" style="background-image: url('/assets/img/hero/hero_bg_1_1.jpg'); min-height: 500px; background-size: cover; background-position: center;">
                                    <div class="carousel-caption">
                                        <h1>Slide Title ${slideCount + 1}</h1>
                                        <h5>Subtitle</h5>
                                        <p>Slide description text</p>
                                        <a href="#" class="btn btn-red">Button 1</a>
                                        <a href="#" class="btn btn-outline-light">Button 2</a>
                                    </div>
                                </div>
                            `);
                        },
                    },
                    {
                        type: 'button',
                        label: 'Remove Last Slide',
                        text: 'Remove Slide',
                        command: (editor) => {
                            const selected = editor.getSelected();
                            const carouselInner = selected.find('.carousel-inner')[0];
                            const indicators = selected.find('.carousel-indicators')[0];
                            const slides = carouselInner.components();

                            if (slides.length > 1) {
                                slides.at(slides.length - 1).remove();
                                const indicatorButtons = indicators.components();
                                indicatorButtons.at(indicatorButtons.length - 1).remove();
                            }
                        },
                    },
                ],
            },
        },
    });

    // ===========================================
    // 2. DOWNLOAD SECTION BLOCK
    // ===========================================
    blockManager.add('treasury-downloads', {
        label: '<div class="gjs-block-label"><i class="fa fa-download"></i><br>Downloads</div>',
        category: 'Treasury Sections',
        content: {
            type: 'treasury-downloads',
            components: `
                <section class="download-section py-5">
                    <div class="container">
                        <h2 class="section-title text-center mb-5">Downloads</h2>
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="download-category mb-4">
                                    <h5 class="mb-3"><i class="fas fa-folder-open text-primary me-2"></i>Category Name</h5>
                                    <div class="download-item p-3 mb-2" style="border: 1px solid #e0e0e0; border-radius: 5px; background: #f8f9fa;">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1">Document Title</h6>
                                                <small class="text-muted">PDF • 250 KB</small>
                                            </div>
                                            <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-download me-1"></i>Download</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            `,
        },
    });

    domComponents.addType('treasury-downloads', {
        model: {
            defaults: {
                traits: [
                    {
                        type: 'button',
                        label: 'Add Download Item',
                        text: 'Add Item',
                        command: (editor) => {
                            const selected = editor.getSelected();
                            const category = selected.find('.download-category')[0];

                            category.append(`
                                <div class="download-item p-3 mb-2" style="border: 1px solid #e0e0e0; border-radius: 5px; background: #f8f9fa;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">New Document</h6>
                                            <small class="text-muted">PDF • 0 KB</small>
                                        </div>
                                        <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-download me-1"></i>Download</a>
                                    </div>
                                </div>
                            `);
                        },
                    },
                    {
                        type: 'button',
                        label: 'Add Category',
                        text: 'Add Category',
                        command: (editor) => {
                            const selected = editor.getSelected();
                            const container = selected.find('.col-lg-8')[0];

                            container.append(`
                                <div class="download-category mb-4">
                                    <h5 class="mb-3"><i class="fas fa-folder-open text-primary me-2"></i>New Category</h5>
                                    <div class="download-item p-3 mb-2" style="border: 1px solid #e0e0e0; border-radius: 5px; background: #f8f9fa;">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1">Document Title</h6>
                                                <small class="text-muted">PDF • 0 KB</small>
                                            </div>
                                            <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-download me-1"></i>Download</a>
                                        </div>
                                    </div>
                                </div>
                            `);
                        },
                    },
                ],
            },
        },
    });

    // ===========================================
    // 3. CORE VALUES CARDS
    // ===========================================
    blockManager.add('treasury-core-values', {
        label: '<div class="gjs-block-label"><i class="fa fa-star"></i><br>Core Values</div>',
        category: 'Treasury Sections',
        content: {
            type: 'treasury-core-values',
            components: `
                <section class="core-values-section py-5">
                    <div class="container">
                        <h2 class="section-title text-center">Our Core Values</h2>
                        <p class="section-subtitle text-center mb-5">Guiding principles</p>
                        <div class="row justify-content-center core-values-container">
                            <div class="col-md-4 mb-4">
                                <div class="core-card text-center p-4" style="border: 2px solid #e0e0e0; border-radius: 10px;">
                                    <i class="fas fa-shield-alt fa-3x mb-3 text-primary"></i>
                                    <h5>Value Title</h5>
                                    <p>Value description text</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            `,
        },
    });

    domComponents.addType('treasury-core-values', {
        model: {
            defaults: {
                traits: [
                    {
                        type: 'button',
                        label: 'Add Value Card',
                        text: 'Add Card',
                        command: (editor) => {
                            const selected = editor.getSelected();
                            const container = selected.find('.core-values-container')[0];

                            container.append(`
                                <div class="col-md-4 mb-4">
                                    <div class="core-card text-center p-4" style="border: 2px solid #e0e0e0; border-radius: 10px;">
                                        <i class="fas fa-star fa-3x mb-3 text-primary"></i>
                                        <h5>New Value</h5>
                                        <p>Description</p>
                                    </div>
                                </div>
                            `);
                        },
                    },
                    {
                        type: 'button',
                        label: 'Remove Last Card',
                        text: 'Remove Card',
                        command: (editor) => {
                            const selected = editor.getSelected();
                            const container = selected.find('.core-values-container')[0];
                            const cards = container.components();

                            if (cards.length > 1) {
                                cards.at(cards.length - 1).remove();
                            }
                        },
                    },
                ],
            },
        },
    });

    // ===========================================
    // 4. DIVISION BOXES
    // ===========================================
    blockManager.add('treasury-divisions', {
        label: '<div class="gjs-block-label"><i class="fa fa-building"></i><br>Divisions</div>',
        category: 'Treasury Sections',
        content: {
            type: 'treasury-divisions',
            components: `
                <section class="divisions-section py-5">
                    <div class="container">
                        <h2 class="section-title text-center mb-5">Our Divisions</h2>
                        <div class="row divisions-container">
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="division-box text-center p-4" style="border: 1px solid #e0e0e0; border-radius: 10px; transition: all 0.3s;">
                                    <i class="fas fa-calculator fa-3x mb-3 text-primary"></i>
                                    <h5>Division Name</h5>
                                    <p>Division description</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            `,
        },
    });

    domComponents.addType('treasury-divisions', {
        model: {
            defaults: {
                traits: [
                    {
                        type: 'button',
                        label: 'Add Division',
                        text: 'Add Division',
                        command: (editor) => {
                            const selected = editor.getSelected();
                            const container = selected.find('.divisions-container')[0];

                            container.append(`
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="division-box text-center p-4" style="border: 1px solid #e0e0e0; border-radius: 10px;">
                                        <i class="fas fa-building fa-3x mb-3 text-primary"></i>
                                        <h5>New Division</h5>
                                        <p>Description</p>
                                    </div>
                                </div>
                            `);
                        },
                    },
                    {
                        type: 'button',
                        label: 'Remove Last',
                        text: 'Remove',
                        command: (editor) => {
                            const selected = editor.getSelected();
                            const container = selected.find('.divisions-container')[0];
                            const items = container.components();

                            if (items.length > 1) {
                                items.at(items.length - 1).remove();
                            }
                        },
                    },
                ],
            },
        },
    });

    // ===========================================
    // 5. NEWS CARDS
    // ===========================================
    blockManager.add('treasury-news', {
        label: '<div class="gjs-block-label"><i class="fa fa-newspaper"></i><br>News Cards</div>',
        category: 'Treasury Sections',
        content: {
            type: 'treasury-news',
            components: `
                <section class="news-section py-5">
                    <div class="container">
                        <h2 class="section-title text-center mb-5">Latest News</h2>
                        <div class="row news-container">
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="news-card p-4" style="border: 1px solid #e0e0e0; border-radius: 10px; background: white;">
                                    <div class="news-date mb-2" style="color: #666; font-size: 14px;">
                                        <i class="fas fa-calendar me-2"></i>Date
                                    </div>
                                    <h5>News Title</h5>
                                    <p>News description...</p>
                                    <a href="#" class="btn btn-sm btn-outline-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            `,
        },
    });

    domComponents.addType('treasury-news', {
        model: {
            defaults: {
                traits: [
                    {
                        type: 'button',
                        label: 'Add News Card',
                        text: 'Add News',
                        command: (editor) => {
                            const selected = editor.getSelected();
                            const container = selected.find('.news-container')[0];

                            container.append(`
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="news-card p-4" style="border: 1px solid #e0e0e0; border-radius: 10px; background: white;">
                                        <div class="news-date mb-2" style="color: #666; font-size: 14px;">
                                            <i class="fas fa-calendar me-2"></i>Date
                                        </div>
                                        <h5>News Title</h5>
                                        <p>News description...</p>
                                        <a href="#" class="btn btn-sm btn-outline-primary">Read More</a>
                                    </div>
                                </div>
                            `);
                        },
                    },
                    {
                        type: 'button',
                        label: 'Remove Last',
                        text: 'Remove',
                        command: (editor) => {
                            const selected = editor.getSelected();
                            const container = selected.find('.news-container')[0];
                            const items = container.components();

                            if (items.length > 1) {
                                items.at(items.length - 1).remove();
                            }
                        },
                    },
                ],
            },
        },
    });

    // ===========================================
    // 6. SERVICE BOXES (for services pages)
    // ===========================================
    blockManager.add('treasury-services', {
        label: '<div class="gjs-block-label"><i class="fa fa-concierge-bell"></i><br>Services</div>',
        category: 'Treasury Sections',
        content: {
            type: 'treasury-services',
            components: `
                <section class="services-section py-5">
                    <div class="container">
                        <h2 class="section-title text-center mb-5">Our Services</h2>
                        <div class="row">
                            <div class="col-lg-8 mx-auto services-container">
                                <div class="service-box p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 10px; background: #f8f9fa;">
                                    <h5><i class="fas fa-check-circle text-success me-2"></i>Service Name</h5>
                                    <p>Service description</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            `,
        },
    });

    domComponents.addType('treasury-services', {
        model: {
            defaults: {
                traits: [
                    {
                        type: 'button',
                        label: 'Add Service',
                        text: 'Add Service',
                        command: (editor) => {
                            const selected = editor.getSelected();
                            const container = selected.find('.services-container')[0];

                            container.append(`
                                <div class="service-box p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 10px; background: #f8f9fa;">
                                    <h5><i class="fas fa-check-circle text-success me-2"></i>New Service</h5>
                                    <p>Description</p>
                                </div>
                            `);
                        },
                    },
                    {
                        type: 'button',
                        label: 'Remove Last',
                        text: 'Remove',
                        command: (editor) => {
                            const selected = editor.getSelected();
                            const container = selected.find('.services-container')[0];
                            const items = container.components();

                            if (items.length > 1) {
                                items.at(items.length - 1).remove();
                            }
                        },
                    },
                ],
            },
        },
    });

    // ===========================================
    // 7. NOTICE CARDS
    // ===========================================
    blockManager.add('treasury-notices', {
        label: '<div class="gjs-block-label"><i class="fa fa-bell"></i><br>Notices</div>',
        category: 'Treasury Sections',
        content: {
            type: 'treasury-notices',
            components: `
                <section class="notices-section py-5">
                    <div class="container">
                        <h2 class="section-title text-center mb-5">Public Notices</h2>
                        <div class="row">
                            <div class="col-lg-8 mx-auto notices-container">
                                <div class="notice-card p-4 mb-3" style="border-left: 4px solid #dc3545; background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                    <div class="notice-badge mb-2" style="display: inline-block; padding: 4px 12px; background: #dc3545; color: white; border-radius: 4px; font-size: 12px;">Important</div>
                                    <h5>Notice Title</h5>
                                    <p class="text-muted mb-2"><i class="fas fa-calendar me-2"></i>Date</p>
                                    <p>Notice content goes here...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            `,
        },
    });

    domComponents.addType('treasury-notices', {
        model: {
            defaults: {
                traits: [
                    {
                        type: 'button',
                        label: 'Add Notice',
                        text: 'Add Notice',
                        command: (editor) => {
                            const selected = editor.getSelected();
                            const container = selected.find('.notices-container')[0];

                            container.append(`
                                <div class="notice-card p-4 mb-3" style="border-left: 4px solid #17a2b8; background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                    <div class="notice-badge mb-2" style="display: inline-block; padding: 4px 12px; background: #17a2b8; color: white; border-radius: 4px; font-size: 12px;">Notice</div>
                                    <h5>New Notice</h5>
                                    <p class="text-muted mb-2"><i class="fas fa-calendar me-2"></i>Date</p>
                                    <p>Content...</p>
                                </div>
                            `);
                        },
                    },
                    {
                        type: 'button',
                        label: 'Remove Last',
                        text: 'Remove',
                        command: (editor) => {
                            const selected = editor.getSelected();
                            const container = selected.find('.notices-container')[0];
                            const items = container.components();

                            if (items.length > 1) {
                                items.at(items.length - 1).remove();
                            }
                        },
                    },
                ],
            },
        },
    });

    // ===========================================
    // 8. TEAM/PROFILE CARDS
    // ===========================================
    blockManager.add('treasury-team', {
        label: '<div class="gjs-block-label"><i class="fa fa-users"></i><br>Team</div>',
        category: 'Treasury Sections',
        content: {
            type: 'treasury-team',
            components: `
                <section class="team-section py-5">
                    <div class="container">
                        <h2 class="section-title text-center mb-5">Our Team</h2>
                        <div class="row justify-content-center team-container">
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="profile-card text-center p-4" style="border: 1px solid #e0e0e0; border-radius: 10px; background: white;">
                                    <div class="profile-img-wrapper mb-3" style="width: 150px; height: 150px; margin: 0 auto; border-radius: 50%; overflow: hidden; border: 3px solid #007bff;">
                                        <img src="/assets/img/team/team-1.jpg" alt="Team Member" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                    <h5 class="mt-3">Name</h5>
                                    <p class="text-muted">Position</p>
                                    <p>Brief bio</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            `,
        },
    });

    domComponents.addType('treasury-team', {
        model: {
            defaults: {
                traits: [
                    {
                        type: 'button',
                        label: 'Add Team Member',
                        text: 'Add Member',
                        command: (editor) => {
                            const selected = editor.getSelected();
                            const container = selected.find('.team-container')[0];

                            container.append(`
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="profile-card text-center p-4" style="border: 1px solid #e0e0e0; border-radius: 10px; background: white;">
                                        <div class="profile-img-wrapper mb-3" style="width: 150px; height: 150px; margin: 0 auto; border-radius: 50%; overflow: hidden; border: 3px solid #007bff;">
                                            <img src="/assets/img/team/team-1.jpg" alt="Team Member" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                        <h5 class="mt-3">Name</h5>
                                        <p class="text-muted">Position</p>
                                        <p>Brief bio</p>
                                    </div>
                                </div>
                            `);
                        },
                    },
                    {
                        type: 'button',
                        label: 'Remove Last',
                        text: 'Remove',
                        command: (editor) => {
                            const selected = editor.getSelected();
                            const container = selected.find('.team-container')[0];
                            const items = container.components();

                            if (items.length > 1) {
                                items.at(items.length - 1).remove();
                            }
                        },
                    },
                ],
            },
        },
    });

    // ===========================================
    // 9. QUICK ACCESS/INFO BOXES
    // ===========================================
    blockManager.add('treasury-quick-access', {
        label: '<div class="gjs-block-label"><i class="fa fa-bolt"></i><br>Quick Access</div>',
        category: 'Treasury Sections',
        content: {
            type: 'treasury-quick-access',
            components: `
                <section class="quick-access-section py-5" style="background: #f8f9fa;">
                    <div class="container">
                        <h2 class="section-title text-center mb-5">Quick Access</h2>
                        <div class="row justify-content-center quick-access-container">
                            <div class="col-md-4 mb-4">
                                <div class="quick-card p-4 text-center" style="background: white; border: 1px solid #e0e0e0; border-radius: 10px; transition: all 0.3s;">
                                    <i class="fas fa-calculator fa-3x mb-3 text-primary"></i>
                                    <h6>Service Name</h6>
                                    <p>Brief description</p>
                                    <a href="#" class="btn btn-sm btn-primary">Access</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            `,
        },
    });

    domComponents.addType('treasury-quick-access', {
        model: {
            defaults: {
                traits: [
                    {
                        type: 'button',
                        label: 'Add Item',
                        text: 'Add Item',
                        command: (editor) => {
                            const selected = editor.getSelected();
                            const container = selected.find('.quick-access-container')[0];

                            container.append(`
                                <div class="col-md-4 mb-4">
                                    <div class="quick-card p-4 text-center" style="background: white; border: 1px solid #e0e0e0; border-radius: 10px;">
                                        <i class="fas fa-star fa-3x mb-3 text-primary"></i>
                                        <h6>New Service</h6>
                                        <p>Description</p>
                                        <a href="#" class="btn btn-sm btn-primary">Access</a>
                                    </div>
                                </div>
                            `);
                        },
                    },
                    {
                        type: 'button',
                        label: 'Remove Last',
                        text: 'Remove',
                        command: (editor) => {
                            const selected = editor.getSelected();
                            const container = selected.find('.quick-access-container')[0];
                            const items = container.components();

                            if (items.length > 1) {
                                items.at(items.length - 1).remove();
                            }
                        },
                    },
                ],
            },
        },
    });

    // ===========================================
    // 10. CONTACT INFO BOXES
    // ===========================================
    blockManager.add('treasury-contact', {
        label: '<div class="gjs-block-label"><i class="fa fa-address-card"></i><br>Contact Info</div>',
        category: 'Treasury Sections',
        content: {
            type: 'treasury-contact',
            components: `
                <section class="contact-section py-5">
                    <div class="container">
                        <h2 class="section-title text-center mb-5">Contact Information</h2>
                        <div class="row contact-container">
                            <div class="col-md-6 mb-4">
                                <div class="contact-info-box p-4" style="border: 1px solid #e0e0e0; border-radius: 10px; background: #f8f9fa;">
                                    <h5><i class="fas fa-map-marker-alt text-primary me-2"></i>Address</h5>
                                    <p>Your address here</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            `,
        },
    });

    domComponents.addType('treasury-contact', {
        model: {
            defaults: {
                traits: [
                    {
                        type: 'button',
                        label: 'Add Info Box',
                        text: 'Add Box',
                        command: (editor) => {
                            const selected = editor.getSelected();
                            const container = selected.find('.contact-container')[0];

                            container.append(`
                                <div class="col-md-6 mb-4">
                                    <div class="contact-info-box p-4" style="border: 1px solid #e0e0e0; border-radius: 10px; background: #f8f9fa;">
                                        <h5><i class="fas fa-info-circle text-primary me-2"></i>Info Title</h5>
                                        <p>Information content</p>
                                    </div>
                                </div>
                            `);
                        },
                    },
                    {
                        type: 'button',
                        label: 'Remove Last',
                        text: 'Remove',
                        command: (editor) => {
                            const selected = editor.getSelected();
                            const container = selected.find('.contact-container')[0];
                            const items = container.components();

                            if (items.length > 1) {
                                items.at(items.length - 1).remove();
                            }
                        },
                    },
                ],
            },
        },
    });

})(window.editor);
