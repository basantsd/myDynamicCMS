// Enhanced GrapesJS Custom Blocks with Proper Forms and Traits
function addEnhancedBlocks(editor) {

    // ========== ENHANCED IMAGE SLIDER WITH EDITABLE IMAGES ==========
    editor.DomComponents.addType('image-slider-enhanced', {
        model: {
            defaults: {
                tagName: 'div',
                classes: ['carousel', 'slide'],
                attributes: { 'data-bs-ride': 'carousel' },
                traits: [
                    {
                        type: 'number',
                        name: 'slide-count',
                        label: 'Number of Slides',
                        value: 3,
                        min: 1,
                        max: 10,
                        changeProp: 1,
                    },
                    {
                        type: 'select',
                        name: 'interval',
                        label: 'Auto Play Interval (ms)',
                        options: [
                            { value: '0', name: 'No Auto Play' },
                            { value: '2000', name: '2 seconds' },
                            { value: '3000', name: '3 seconds' },
                            { value: '5000', name: '5 seconds' },
                        ],
                        changeProp: 1,
                    }
                ],
                'slide-count': 3,
                interval: '5000',
            },
            init() {
                this.on('change:slide-count', this.updateSlides);
                this.on('change:interval', this.updateInterval);
                this.updateSlides();
            },
            updateSlides() {
                const count = parseInt(this.get('slide-count')) || 3;
                const sliderId = 'slider-' + Date.now();

                let slides = '';
                for (let i = 0; i < count; i++) {
                    const activeClass = i === 0 ? 'active' : '';
                    slides += `
                        <div class="carousel-item ${activeClass}">
                            <img src="/assets/img/hero/hero_bg_1_1.jpg" class="d-block w-100" alt="Slide ${i + 1}" style="height: 400px; object-fit: cover;" data-gjs-editable="false">
                            <div class="carousel-caption" data-gjs-editable="true">
                                <h3>Slide ${i + 1} Title</h3>
                                <p>Click to edit this caption</p>
                            </div>
                        </div>
                    `;
                }

                const html = `
                    <style>
                        #${sliderId} .carousel-control-prev,
                        #${sliderId} .carousel-control-next {
                            width: 50px;
                            height: 50px;
                            top: 50%;
                            transform: translateY(-50%);
                            background: rgba(0,0,0,0.5);
                            border-radius: 50%;
                            opacity: 0.7;
                        }
                        #${sliderId} .carousel-control-prev:hover,
                        #${sliderId} .carousel-control-next:hover { opacity: 1; }
                        #${sliderId} .carousel-control-prev { left: 20px; }
                        #${sliderId} .carousel-control-next { right: 20px; }
                    </style>
                    <div id="${sliderId}" class="carousel slide" data-bs-ride="carousel" data-bs-interval="${this.get('interval')}">
                        <div class="carousel-inner">
                            ${slides}
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#${sliderId}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#${sliderId}" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                `;

                this.components(html);
            },
            updateInterval() {
                this.updateSlides();
            }
        }
    });

    editor.BlockManager.add('image-slider-enhanced', {
        label: 'Image Slider (Editable)',
        category: '🎢 Sliders',
        content: { type: 'image-slider-enhanced' },
        media: '<i class="fas fa-images"></i>',
    });

    // ========== ENHANCED DATA TABLE WITH EDITABLE ROWS ==========
    editor.DomComponents.addType('data-table-enhanced', {
        model: {
            defaults: {
                tagName: 'section',
                traits: [
                    {
                        type: 'number',
                        name: 'rows',
                        label: 'Number of Rows',
                        value: 3,
                        min: 1,
                        max: 20,
                        changeProp: 1,
                    },
                    {
                        type: 'checkbox',
                        name: 'striped',
                        label: 'Striped Rows',
                        value: true,
                        changeProp: 1,
                    }
                ],
                rows: 3,
                striped: true,
            },
            init() {
                this.on('change:rows change:striped', this.updateTable);
                this.updateTable();
            },
            updateTable() {
                const rows = parseInt(this.get('rows')) || 3;
                const striped = this.get('striped');

                let tableRows = '';
                for (let i = 0; i < rows; i++) {
                    const bgStyle = striped && i % 2 === 1 ? 'background: #f9fafb;' : '';
                    tableRows += `
                        <tr style="border-bottom: 1px solid #e5e7eb; ${bgStyle}">
                            <td style="padding: 15px;" data-gjs-editable="true">Item ${i + 1}</td>
                            <td style="padding: 15px;" data-gjs-editable="true">Description</td>
                            <td style="padding: 15px;" data-gjs-editable="true">Value</td>
                            <td style="padding: 15px;"><span style="background: #10b981; color: white; padding: 5px 15px; border-radius: 20px; font-size: 12px;" data-gjs-editable="true">Active</span></td>
                        </tr>
                    `;
                }

                const html = `
                    <section style="padding: 60px 0;">
                        <div class="container">
                            <h2 style="margin-bottom: 30px;" data-gjs-editable="true">Data Table</h2>
                            <div style="overflow-x: auto;">
                                <table style="width: 100%; border-collapse: collapse; background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
                                    <thead>
                                        <tr style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                                            <th style="padding: 15px; text-align: left;" data-gjs-editable="true">Name</th>
                                            <th style="padding: 15px; text-align: left;" data-gjs-editable="true">Description</th>
                                            <th style="padding: 15px; text-align: left;" data-gjs-editable="true">Value</th>
                                            <th style="padding: 15px; text-align: left;" data-gjs-editable="true">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${tableRows}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                `;

                this.components(html);
            }
        }
    });

    editor.BlockManager.add('data-table-enhanced', {
        label: 'Data Table (Editable)',
        category: '📋 Tables',
        content: { type: 'data-table-enhanced' },
        media: '<i class="fas fa-table"></i>',
    });

    // ========== ENHANCED ICON LIST WITH ADD/REMOVE ==========
    editor.DomComponents.addType('icon-list-enhanced', {
        model: {
            defaults: {
                tagName: 'section',
                traits: [
                    {
                        type: 'number',
                        name: 'items',
                        label: 'Number of Items',
                        value: 4,
                        min: 1,
                        max: 10,
                        changeProp: 1,
                    },
                    {
                        type: 'select',
                        name: 'icon-style',
                        label: 'Icon Style',
                        options: [
                            { value: 'check', name: 'Check Circle' },
                            { value: 'star', name: 'Star' },
                            { value: 'heart', name: 'Heart' },
                            { value: 'shield', name: 'Shield' },
                        ],
                        changeProp: 1,
                    }
                ],
                items: 4,
                'icon-style': 'check',
            },
            init() {
                this.on('change:items change:icon-style', this.updateList);
                this.updateList();
            },
            updateList() {
                const items = parseInt(this.get('items')) || 4;
                const iconStyle = this.get('icon-style');

                const iconMap = {
                    'check': 'fa-check-circle',
                    'star': 'fa-star',
                    'heart': 'fa-heart',
                    'shield': 'fa-shield-alt'
                };

                let listItems = '';
                for (let i = 0; i < items; i++) {
                    listItems += `
                        <li style="padding: 15px 0; border-bottom: 1px solid #e5e7eb; display: flex; align-items: start;">
                            <i class="fas ${iconMap[iconStyle]}" style="color: #10b981; margin-right: 15px; margin-top: 5px; font-size: 20px;"></i>
                            <span style="flex: 1; line-height: 1.6;" data-gjs-editable="true">Feature item ${i + 1} - click to edit</span>
                        </li>
                    `;
                }

                const html = `
                    <section style="padding: 60px 0;">
                        <div class="container">
                            <h2 style="margin-bottom: 30px;" data-gjs-editable="true">Key Features</h2>
                            <ul style="list-style: none; padding: 0;">
                                ${listItems}
                            </ul>
                        </div>
                    </section>
                `;

                this.components(html);
            }
        }
    });

    editor.BlockManager.add('icon-list-enhanced', {
        label: 'Icon List (Editable)',
        category: '📝 Lists',
        content: { type: 'icon-list-enhanced' },
        media: '<i class="fas fa-list-ul"></i>',
    });

    // ========== ENHANCED BUTTON GROUP ==========
    editor.DomComponents.addType('button-group-enhanced', {
        model: {
            defaults: {
                tagName: 'div',
                traits: [
                    {
                        type: 'number',
                        name: 'button-count',
                        label: 'Number of Buttons',
                        value: 3,
                        min: 1,
                        max: 6,
                        changeProp: 1,
                    },
                    {
                        type: 'select',
                        name: 'button-style',
                        label: 'Button Style',
                        options: [
                            { value: 'primary', name: 'Primary' },
                            { value: 'success', name: 'Success' },
                            { value: 'danger', name: 'Danger' },
                            { value: 'outline-primary', name: 'Outline Primary' },
                        ],
                        changeProp: 1,
                    },
                    {
                        type: 'select',
                        name: 'alignment',
                        label: 'Alignment',
                        options: [
                            { value: 'left', name: 'Left' },
                            { value: 'center', name: 'Center' },
                            { value: 'right', name: 'Right' },
                        ],
                        changeProp: 1,
                    }
                ],
                'button-count': 3,
                'button-style': 'primary',
                alignment: 'center',
            },
            init() {
                this.on('change:button-count change:button-style change:alignment', this.updateButtons);
                this.updateButtons();
            },
            updateButtons() {
                const count = parseInt(this.get('button-count')) || 3;
                const style = this.get('button-style');
                const alignment = this.get('alignment');

                let buttons = '';
                for (let i = 0; i < count; i++) {
                    buttons += `
                        <a href="#" class="btn btn-${style}" style="padding: 12px 30px; margin: 5px; display: inline-block;" data-gjs-editable="true">Button ${i + 1}</a>
                    `;
                }

                const html = `
                    <section style="padding: 60px 0; text-align: ${alignment};">
                        <div class="container">
                            <h2 style="margin-bottom: 30px;" data-gjs-editable="true">Action Buttons</h2>
                            ${buttons}
                        </div>
                    </section>
                `;

                this.components(html);
            }
        }
    });

    editor.BlockManager.add('button-group-enhanced', {
        label: 'Button Group (Editable)',
        category: '🔘 Buttons',
        content: { type: 'button-group-enhanced' },
        media: '<i class="fas fa-hand-pointer"></i>',
    });

    // ========== ENHANCED TESTIMONIAL CARDS ==========
    editor.DomComponents.addType('testimonial-cards-enhanced', {
        model: {
            defaults: {
                tagName: 'section',
                traits: [
                    {
                        type: 'number',
                        name: 'testimonial-count',
                        label: 'Number of Testimonials',
                        value: 3,
                        min: 1,
                        max: 6,
                        changeProp: 1,
                    },
                    {
                        type: 'select',
                        name: 'columns',
                        label: 'Columns',
                        options: [
                            { value: '12', name: '1 Column' },
                            { value: '6', name: '2 Columns' },
                            { value: '4', name: '3 Columns' },
                        ],
                        changeProp: 1,
                    }
                ],
                'testimonial-count': 3,
                columns: '4',
            },
            init() {
                this.on('change:testimonial-count change:columns', this.updateTestimonials);
                this.updateTestimonials();
            },
            updateTestimonials() {
                const count = parseInt(this.get('testimonial-count')) || 3;
                const columns = this.get('columns');

                let cards = '';
                for (let i = 0; i < count; i++) {
                    cards += `
                        <div class="col-lg-${columns}">
                            <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                                <div style="color: #fbbf24; margin-bottom: 15px;">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                                <p style="font-style: italic; color: #666; margin-bottom: 20px;" data-gjs-editable="true">"Click to edit this testimonial text. Share your customer's experience here."</p>
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 50px; height: 50px; border-radius: 50%; background: #e5e7eb; margin-right: 15px;"></div>
                                    <div>
                                        <div style="font-weight: bold;" data-gjs-editable="true">Customer Name</div>
                                        <div style="font-size: 14px; color: #666;" data-gjs-editable="true">Position, Company</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                }

                const html = `
                    <section style="padding: 80px 0;">
                        <div class="container">
                            <div class="text-center mb-5">
                                <h2 style="font-size: 36px; font-weight: bold;" data-gjs-editable="true">What Our Clients Say</h2>
                                <p style="font-size: 18px; color: #666;" data-gjs-editable="true">Don't take our word for it</p>
                            </div>
                            <div class="row gy-4">
                                ${cards}
                            </div>
                        </div>
                    </section>
                `;

                this.components(html);
            }
        }
    });

    editor.BlockManager.add('testimonial-cards-enhanced', {
        label: 'Testimonial Cards (Editable)',
        category: '💬 Testimonials',
        content: { type: 'testimonial-cards-enhanced' },
        media: '<i class="fas fa-quote-left"></i>',
    });

    console.log('✅ Enhanced Custom Blocks with Editable Forms Loaded!');
}
