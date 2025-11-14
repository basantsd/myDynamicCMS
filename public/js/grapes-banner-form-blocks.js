/**
 * Enhanced Banner and Form Blocks for GrapesJS
 * Separate components for banners and forms with add functionality
 */

function addBannerFormBlocks(editor) {

    // ========== BANNER COMPONENT WITH ADD FUNCTIONALITY ==========
    editor.DomComponents.addType('banner-enhanced', {
        model: {
            defaults: {
                tagName: 'section',
                classes: ['banner-section'],
                traits: [
                    {
                        type: 'select',
                        name: 'banner-style',
                        label: 'Banner Style',
                        options: [
                            { value: 'hero', name: 'Hero Banner' },
                            { value: 'promotional', name: 'Promotional Banner' },
                            { value: 'image', name: 'Image Banner' },
                            { value: 'video', name: 'Video Banner' },
                        ],
                        changeProp: 1,
                    },
                    {
                        type: 'select',
                        name: 'banner-height',
                        label: 'Banner Height',
                        options: [
                            { value: '300px', name: 'Small (300px)' },
                            { value: '400px', name: 'Medium (400px)' },
                            { value: '500px', name: 'Large (500px)' },
                            { value: '100vh', name: 'Full Screen' },
                        ],
                        changeProp: 1,
                    },
                    {
                        type: 'select',
                        name: 'text-position',
                        label: 'Text Position',
                        options: [
                            { value: 'left', name: 'Left' },
                            { value: 'center', name: 'Center' },
                            { value: 'right', name: 'Right' },
                        ],
                        changeProp: 1,
                    },
                    {
                        type: 'checkbox',
                        name: 'overlay',
                        label: 'Dark Overlay',
                        value: true,
                        changeProp: 1,
                    },
                    {
                        type: 'text',
                        name: 'bg-image',
                        label: 'Background Image URL',
                        changeProp: 1,
                    }
                ],
                'banner-style': 'hero',
                'banner-height': '500px',
                'text-position': 'center',
                'overlay': true,
                'bg-image': '/assets/img/hero/hero_bg_1_1.jpg',
            },
            init() {
                this.on('change:banner-style change:banner-height change:text-position change:overlay change:bg-image', this.updateBanner);
                this.updateBanner();
            },
            updateBanner() {
                const style = this.get('banner-style');
                const height = this.get('banner-height');
                const textPos = this.get('text-position');
                const overlay = this.get('overlay');
                const bgImage = this.get('bg-image') || '/assets/img/hero/hero_bg_1_1.jpg';

                let html = '';
                const overlayStyle = overlay ? `
                    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 1;"></div>
                ` : '';

                const textAlignment = textPos === 'center' ? 'text-center' : textPos === 'right' ? 'text-end' : 'text-start';

                switch (style) {
                    case 'hero':
                        html = `
                            <section class="banner-section" style="background-image: url('${bgImage}'); background-size: cover; background-position: center; height: ${height}; position: relative; display: flex; align-items: center;">
                                ${overlayStyle}
                                <div class="container" style="position: relative; z-index: 2;">
                                    <div class="row">
                                        <div class="col-lg-8 mx-auto ${textAlignment} text-white">
                                            <h1 style="font-size: 56px; font-weight: bold; margin-bottom: 20px;" data-gjs-editable="true">Your Awesome Headline Here</h1>
                                            <p style="font-size: 20px; margin-bottom: 30px;" data-gjs-editable="true">Create stunning banners with our easy-to-use page builder. Click to edit this text.</p>
                                            <div class="banner-buttons">
                                                <a href="#" class="btn btn-primary btn-lg" style="padding: 15px 40px; margin: 5px;" data-gjs-editable="true">Get Started</a>
                                                <a href="#" class="btn btn-outline-light btn-lg" style="padding: 15px 40px; margin: 5px;" data-gjs-editable="true">Learn More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        `;
                        break;

                    case 'promotional':
                        html = `
                            <section class="banner-section" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: ${height}; position: relative; display: flex; align-items: center;">
                                ${overlayStyle}
                                <div class="container" style="position: relative; z-index: 2;">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 text-white">
                                            <div class="promotional-badge" style="display: inline-block; background: #fbbf24; color: #000; padding: 5px 15px; border-radius: 20px; font-weight: bold; margin-bottom: 15px;" data-gjs-editable="true">SPECIAL OFFER</div>
                                            <h2 style="font-size: 42px; font-weight: bold; margin-bottom: 20px;" data-gjs-editable="true">Limited Time Offer!</h2>
                                            <p style="font-size: 18px; margin-bottom: 30px;" data-gjs-editable="true">Don't miss out on this amazing opportunity. Click to edit and customize.</p>
                                            <a href="#" class="btn btn-warning btn-lg" style="padding: 12px 35px;" data-gjs-editable="true">Claim Offer</a>
                                        </div>
                                        <div class="col-lg-6 text-center">
                                            <img src="${bgImage}" alt="Promo" style="max-width: 100%; border-radius: 10px;" data-gjs-editable="false">
                                        </div>
                                    </div>
                                </div>
                            </section>
                        `;
                        break;

                    case 'image':
                        html = `
                            <section class="banner-section" style="background-image: url('${bgImage}'); background-size: cover; background-position: center; height: ${height}; position: relative; display: flex; align-items: center;">
                                ${overlayStyle}
                                <div class="container" style="position: relative; z-index: 2;">
                                    <div class="row">
                                        <div class="col-12 ${textAlignment} text-white">
                                            <h2 style="font-size: 48px; font-weight: bold; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);" data-gjs-editable="true">Image Banner Title</h2>
                                            <p style="font-size: 20px; text-shadow: 1px 1px 2px rgba(0,0,0,0.5);" data-gjs-editable="true">Subtitle or description goes here</p>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        `;
                        break;

                    case 'video':
                        html = `
                            <section class="banner-section" style="background: #000; height: ${height}; position: relative; overflow: hidden;">
                                <video autoplay muted loop style="position: absolute; width: 100%; height: 100%; object-fit: cover; opacity: 0.7;">
                                    <source src="/path/to/video.mp4" type="video/mp4">
                                </video>
                                ${overlayStyle}
                                <div class="container" style="position: relative; z-index: 2; height: 100%; display: flex; align-items: center;">
                                    <div class="row w-100">
                                        <div class="col-12 ${textAlignment} text-white">
                                            <h2 style="font-size: 48px; font-weight: bold;" data-gjs-editable="true">Video Banner Title</h2>
                                            <p style="font-size: 20px; margin-top: 20px;" data-gjs-editable="true">Engaging video background banner</p>
                                            <a href="#" class="btn btn-light btn-lg mt-3" style="padding: 12px 35px;" data-gjs-editable="true">Watch More</a>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        `;
                        break;
                }

                this.components(html);
            }
        }
    });

    // Add Banner Block to Block Manager
    editor.BlockManager.add('banner-enhanced', {
        label: 'Banner',
        category: '🎯 Banners',
        content: { type: 'banner-enhanced' },
        media: '<svg viewBox="0 0 24 24" width="48" height="48"><path fill="currentColor" d="M21,16V4H3V16H21M21,2A2,2 0 0,1 23,4V16A2,2 0 0,1 21,18H14V20H16V22H8V20H10V18H3C1.89,18 1,17.1 1,16V4C1,2.89 1.89,2 3,2H21M5,6H14V11H5V6M15,6H19V8H15V6M19,9V14H15V9H19M5,12H9V14H5V12M10,12H14V14H10V12Z"/></svg>',
        attributes: { title: 'Add customizable banner with various styles' }
    });

    // ========== FORM COMPONENT WITH ADD FUNCTIONALITY ==========
    editor.DomComponents.addType('form-enhanced', {
        model: {
            defaults: {
                tagName: 'section',
                classes: ['form-section'],
                traits: [
                    {
                        type: 'select',
                        name: 'form-style',
                        label: 'Form Style',
                        options: [
                            { value: 'contact', name: 'Contact Form' },
                            { value: 'newsletter', name: 'Newsletter Signup' },
                            { value: 'registration', name: 'Registration Form' },
                            { value: 'feedback', name: 'Feedback Form' },
                        ],
                        changeProp: 1,
                    },
                    {
                        type: 'select',
                        name: 'form-layout',
                        label: 'Form Layout',
                        options: [
                            { value: 'centered', name: 'Centered' },
                            { value: 'left', name: 'Left Aligned' },
                            { value: 'right', name: 'Right Aligned' },
                            { value: 'split', name: 'Split Layout' },
                        ],
                        changeProp: 1,
                    },
                    {
                        type: 'text',
                        name: 'form-action',
                        label: 'Form Action URL',
                        placeholder: '/api/form-submit',
                        changeProp: 1,
                    },
                    {
                        type: 'text',
                        name: 'submit-text',
                        label: 'Submit Button Text',
                        changeProp: 1,
                    }
                ],
                'form-style': 'contact',
                'form-layout': 'centered',
                'form-action': '/api/form-submit',
                'submit-text': 'Submit',
            },
            init() {
                this.on('change:form-style change:form-layout change:form-action change:submit-text', this.updateForm);
                this.updateForm();
            },
            updateForm() {
                const style = this.get('form-style');
                const layout = this.get('form-layout');
                const action = this.get('form-action') || '/api/form-submit';
                const submitText = this.get('submit-text') || 'Submit';

                let html = '';
                const formId = 'form-' + Date.now();

                const layoutClass = layout === 'centered' ? 'col-lg-6 mx-auto' :
                                   layout === 'left' ? 'col-lg-8' :
                                   layout === 'right' ? 'col-lg-8 ms-auto' :
                                   'col-lg-6';

                switch (style) {
                    case 'contact':
                        html = `
                            <section class="form-section" style="padding: 80px 0; background: #f8f9fa;">
                                <div class="container">
                                    <div class="row">
                                        ${layout === 'split' ? `
                                            <div class="col-lg-6 mb-4 mb-lg-0">
                                                <h2 style="font-size: 36px; font-weight: bold; margin-bottom: 20px;" data-gjs-editable="true">Get in Touch</h2>
                                                <p style="font-size: 18px; color: #666; margin-bottom: 30px;" data-gjs-editable="true">We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
                                                <div style="margin-bottom: 20px;">
                                                    <i class="fas fa-envelope" style="color: #667eea; margin-right: 10px;"></i>
                                                    <span data-gjs-editable="true">contact@example.com</span>
                                                </div>
                                                <div style="margin-bottom: 20px;">
                                                    <i class="fas fa-phone" style="color: #667eea; margin-right: 10px;"></i>
                                                    <span data-gjs-editable="true">+1 (555) 123-4567</span>
                                                </div>
                                                <div>
                                                    <i class="fas fa-map-marker-alt" style="color: #667eea; margin-right: 10px;"></i>
                                                    <span data-gjs-editable="true">123 Main St, City, State 12345</span>
                                                </div>
                                            </div>
                                        ` : `
                                            <div class="${layoutClass}">
                                                <div class="text-center mb-4">
                                                    <h2 style="font-size: 36px; font-weight: bold;" data-gjs-editable="true">Contact Us</h2>
                                                    <p style="font-size: 18px; color: #666;" data-gjs-editable="true">Fill out the form below and we'll get back to you</p>
                                                </div>
                                            </div>
                                        `}
                                        <div class="${layoutClass}">
                                            <form id="${formId}" action="${action}" method="POST" style="background: white; padding: 40px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                                                <div class="mb-3">
                                                    <label class="form-label" data-gjs-editable="true">Full Name</label>
                                                    <input type="text" class="form-control" name="name" required style="padding: 12px; border-radius: 5px;">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" data-gjs-editable="true">Email Address</label>
                                                    <input type="email" class="form-control" name="email" required style="padding: 12px; border-radius: 5px;">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" data-gjs-editable="true">Phone Number</label>
                                                    <input type="tel" class="form-control" name="phone" style="padding: 12px; border-radius: 5px;">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" data-gjs-editable="true">Message</label>
                                                    <textarea class="form-control" name="message" rows="5" required style="padding: 12px; border-radius: 5px;"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-lg w-100" style="padding: 12px;" data-gjs-editable="true">${submitText}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        `;
                        break;

                    case 'newsletter':
                        html = `
                            <section class="form-section" style="padding: 60px 0; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                <div class="container">
                                    <div class="row">
                                        <div class="${layoutClass} text-center text-white">
                                            <h2 style="font-size: 36px; font-weight: bold; margin-bottom: 15px;" data-gjs-editable="true">Subscribe to Our Newsletter</h2>
                                            <p style="font-size: 18px; margin-bottom: 30px;" data-gjs-editable="true">Get the latest updates and exclusive offers delivered to your inbox</p>
                                            <form id="${formId}" action="${action}" method="POST" class="newsletter-form">
                                                <div class="input-group input-group-lg" style="box-shadow: 0 5px 15px rgba(0,0,0,0.2);">
                                                    <input type="email" class="form-control" name="email" placeholder="Enter your email address" required style="border: none; padding: 15px 20px;">
                                                    <button type="submit" class="btn btn-warning" style="padding: 15px 30px; border: none; font-weight: bold;" data-gjs-editable="true">${submitText}</button>
                                                </div>
                                                <small style="display: block; margin-top: 15px; opacity: 0.9;" data-gjs-editable="true">We respect your privacy. Unsubscribe at any time.</small>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        `;
                        break;

                    case 'registration':
                        html = `
                            <section class="form-section" style="padding: 80px 0; background: #f8f9fa;">
                                <div class="container">
                                    <div class="row">
                                        <div class="${layoutClass}">
                                            <div class="text-center mb-4">
                                                <h2 style="font-size: 36px; font-weight: bold;" data-gjs-editable="true">Create Your Account</h2>
                                                <p style="font-size: 18px; color: #666;" data-gjs-editable="true">Join thousands of satisfied users today</p>
                                            </div>
                                            <form id="${formId}" action="${action}" method="POST" style="background: white; padding: 40px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label" data-gjs-editable="true">First Name</label>
                                                        <input type="text" class="form-control" name="first_name" required style="padding: 12px;">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label" data-gjs-editable="true">Last Name</label>
                                                        <input type="text" class="form-control" name="last_name" required style="padding: 12px;">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" data-gjs-editable="true">Email Address</label>
                                                    <input type="email" class="form-control" name="email" required style="padding: 12px;">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" data-gjs-editable="true">Password</label>
                                                    <input type="password" class="form-control" name="password" required style="padding: 12px;">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" data-gjs-editable="true">Confirm Password</label>
                                                    <input type="password" class="form-control" name="password_confirmation" required style="padding: 12px;">
                                                </div>
                                                <div class="mb-3 form-check">
                                                    <input type="checkbox" class="form-check-input" name="terms" required>
                                                    <label class="form-check-label" data-gjs-editable="true">I agree to the Terms and Conditions</label>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-lg w-100" style="padding: 12px;" data-gjs-editable="true">${submitText}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        `;
                        break;

                    case 'feedback':
                        html = `
                            <section class="form-section" style="padding: 80px 0;">
                                <div class="container">
                                    <div class="row">
                                        <div class="${layoutClass}">
                                            <div class="text-center mb-4">
                                                <h2 style="font-size: 36px; font-weight: bold;" data-gjs-editable="true">Share Your Feedback</h2>
                                                <p style="font-size: 18px; color: #666;" data-gjs-editable="true">We value your opinion and would love to hear from you</p>
                                            </div>
                                            <form id="${formId}" action="${action}" method="POST" style="background: white; padding: 40px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                                                <div class="mb-3">
                                                    <label class="form-label" data-gjs-editable="true">Name</label>
                                                    <input type="text" class="form-control" name="name" required style="padding: 12px;">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" data-gjs-editable="true">Email</label>
                                                    <input type="email" class="form-control" name="email" required style="padding: 12px;">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" data-gjs-editable="true">Rating</label>
                                                    <select class="form-select" name="rating" required style="padding: 12px;">
                                                        <option value="">Select rating</option>
                                                        <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
                                                        <option value="4">⭐⭐⭐⭐ Good</option>
                                                        <option value="3">⭐⭐⭐ Average</option>
                                                        <option value="2">⭐⭐ Below Average</option>
                                                        <option value="1">⭐ Poor</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" data-gjs-editable="true">Your Feedback</label>
                                                    <textarea class="form-control" name="feedback" rows="6" required style="padding: 12px;"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-lg w-100" style="padding: 12px;" data-gjs-editable="true">${submitText}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        `;
                        break;
                }

                this.components(html);

                // Add form submission handler
                setTimeout(() => {
                    const formElement = document.getElementById(formId);
                    if (formElement && typeof window.handleFormSubmit === 'function') {
                        formElement.addEventListener('submit', window.handleFormSubmit);
                    }
                }, 100);
            }
        }
    });

    // Add Form Block to Block Manager
    editor.BlockManager.add('form-enhanced', {
        label: 'Form',
        category: '📝 Forms',
        content: { type: 'form-enhanced' },
        media: '<svg viewBox="0 0 24 24" width="48" height="48"><path fill="currentColor" d="M13,9H18.5L13,3.5V9M6,2H14L20,8V20A2,2 0 0,1 18,22H6C4.89,22 4,21.1 4,20V4C4,2.89 4.89,2 6,2M15,18V16H6V18H15M18,14V12H6V14H18Z"/></svg>',
        attributes: { title: 'Add customizable form with various styles' }
    });

    console.log('✅ Banner and Form Blocks Loaded Successfully!');
}

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = addBannerFormBlocks;
}
