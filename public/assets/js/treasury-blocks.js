/**
 * Dynamic Custom Blocks Loader for GrapesJS Visual Page Builder
 * Loads blocks from database via API endpoint
 */

(function (editor) {
    if (!editor) {
        console.error('GrapesJS editor not found!');
        return;
    }

    const blockManager = editor.BlockManager;
    const domComponents = editor.DomComponents;

    // Reset categories to show only Custom Blocks
    blockManager.getCategories().reset([
        { id: 'custom', label: 'Custom Blocks', open: true },
        { id: 'basic', label: 'Basic Elements' },
        { id: 'layout', label: 'Layout' },
    ]);

    // Fetch and load custom blocks from API
    fetch('/admin/custom-blocks/list', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success || !data.blocks) {
            console.error('Failed to load custom blocks');
            return;
        }

        // Load each block from database
        data.blocks.forEach(block => {
            loadCustomBlock(block);
        });

        console.log(`Loaded ${data.blocks.length} custom blocks`);
    })
    .catch(error => {
        console.error('Error loading custom blocks:', error);
    });

    /**
     * Load a custom block into GrapesJS
     */
    function loadCustomBlock(blockData) {
        const blockId = `custom-block-${blockData.id}`;
        const category = 'Custom Blocks';

        // Create block label with icon
        const label = `
            <div class="gjs-block-label">
                <i class="${blockData.icon}" style="color: ${blockData.color || '#667eea'};"></i>
                <br>
                ${blockData.name}
            </div>
        `;

        // Generate HTML content based on block schema
        const content = generateBlockContent(blockData);

        // Add block to GrapesJS
        blockManager.add(blockId, {
            label: label,
            category: category,
            content: {
                type: blockId,
                components: content,
            },
            attributes: {
                title: blockData.description || blockData.name,
            },
        });

        // Define component type with traits
        const traits = generateBlockTraits(blockData);

        domComponents.addType(blockId, {
            model: {
                defaults: {
                    traits: traits,
                    draggable: true,
                    droppable: true,
                    removable: true,
                    copyable: true,
                },
            },
        });
    }

    /**
     * Generate HTML content from block schema
     */
    function generateBlockContent(blockData) {
        const schema = blockData.schema || {};
        const defaults = blockData.default_values || {};
        const category = blockData.category;

        // Generate content based on category
        switch (category) {
            case 'slider':
                return generateSliderContent(blockData, schema, defaults);
            case 'table':
                return generateTableContent(blockData, schema, defaults);
            case 'hero':
                return generateHeroContent(blockData, schema, defaults);
            case 'content':
                return generateContentContent(blockData, schema, defaults);
            case 'form':
                return generateFormContent(blockData, schema, defaults);
            case 'feature':
                return generateFeatureContent(blockData, schema, defaults);
            case 'list':
                return generateListContent(blockData, schema, defaults);
            default:
                return generateGenericContent(blockData, schema, defaults);
        }
    }

    /**
     * Generate Slider Content
     */
    function generateSliderContent(blockData, schema, defaults) {
        return `
            <section class="carousel-section" style="position: relative;">
                <div class="carousel-wrapper" data-carousel-id="carousel-${blockData.id}">
                    <div class="carousel-slides">
                        <div class="carousel-slide active" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 500px; display: flex; align-items: center; background-size: cover; background-position: center;">
                            <div class="container">
                                <div class="carousel-content" style="color: white; max-width: 600px;">
                                    <h1 style="font-size: 48px; margin-bottom: 20px;">Slide Title 1</h1>
                                    <p style="font-size: 18px; margin-bottom: 30px;">Slide description goes here</p>
                                    <a href="#" class="btn btn-light" style="padding: 12px 30px; border-radius: 6px; text-decoration: none; display: inline-block;">Learn More</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-slide" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); min-height: 500px; display: none; align-items: center; background-size: cover; background-position: center;">
                            <div class="container">
                                <div class="carousel-content" style="color: white; max-width: 600px;">
                                    <h1 style="font-size: 48px; margin-bottom: 20px;">Slide Title 2</h1>
                                    <p style="font-size: 18px; margin-bottom: 30px;">Another amazing slide</p>
                                    <a href="#" class="btn btn-light" style="padding: 12px 30px; border-radius: 6px; text-decoration: none; display: inline-block;">Get Started</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-prev" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.3); border: none; color: white; width: 50px; height: 50px; border-radius: 50%; cursor: pointer; font-size: 24px; z-index: 10;">‹</button>
                    <button class="carousel-next" style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.3); border: none; color: white; width: 50px; height: 50px; border-radius: 50%; cursor: pointer; font-size: 24px; z-index: 10;">›</button>
                    <div class="carousel-dots" style="position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); display: flex; gap: 10px; z-index: 10;">
                        <span class="dot active" style="width: 12px; height: 12px; background: white; border-radius: 50%; cursor: pointer;"></span>
                        <span class="dot" style="width: 12px; height: 12px; background: rgba(255,255,255,0.5); border-radius: 50%; cursor: pointer;"></span>
                    </div>
                </div>
            </section>
            <script>
                (function() {
                    const carousel = document.querySelector('[data-carousel-id="carousel-${blockData.id}"]');
                    if (!carousel) return;

                    let currentSlide = 0;
                    const slides = carousel.querySelectorAll('.carousel-slide');
                    const dots = carousel.querySelectorAll('.dot');

                    function showSlide(n) {
                        slides.forEach((slide, i) => {
                            slide.style.display = i === n ? 'flex' : 'none';
                            slide.classList.toggle('active', i === n);
                        });
                        dots.forEach((dot, i) => {
                            dot.style.background = i === n ? 'white' : 'rgba(255,255,255,0.5)';
                            dot.classList.toggle('active', i === n);
                        });
                    }

                    carousel.querySelector('.carousel-prev').onclick = () => {
                        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
                        showSlide(currentSlide);
                    };

                    carousel.querySelector('.carousel-next').onclick = () => {
                        currentSlide = (currentSlide + 1) % slides.length;
                        showSlide(currentSlide);
                    };

                    dots.forEach((dot, i) => {
                        dot.onclick = () => {
                            currentSlide = i;
                            showSlide(currentSlide);
                        };
                    });

                    // Auto-play
                    setInterval(() => {
                        currentSlide = (currentSlide + 1) % slides.length;
                        showSlide(currentSlide);
                    }, 5000);
                })();
            </script>
        `;
    }

    /**
     * Generate Table Content
     */
    function generateTableContent(blockData, schema, defaults) {
        return `
            <section class="download-table-section py-5" style="padding: 60px 0;">
                <div class="container">
                    <h2 class="text-center mb-4">${blockData.name}</h2>

                    <!-- Filter Controls -->
                    <div class="download-filters mb-4" style="display: flex; gap: 15px; flex-wrap: wrap;">
                        <input type="text" class="filter-search" placeholder="Search..." style="flex: 1; min-width: 250px; padding: 10px 15px; border: 1px solid #ddd; border-radius: 6px;">
                        <select class="filter-category" style="padding: 10px 15px; border: 1px solid #ddd; border-radius: 6px;">
                            <option value="">All Categories</option>
                            <option value="reports">Reports</option>
                            <option value="documents">Documents</option>
                            <option value="forms">Forms</option>
                        </select>
                        <select class="filter-year" style="padding: 10px 15px; border: 1px solid #ddd; border-radius: 6px;">
                            <option value="">All Years</option>
                            <option value="2024">2024</option>
                            <option value="2023">2023</option>
                            <option value="2022">2022</option>
                        </select>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="data-table" style="width: 100%; border-collapse: collapse; background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                            <thead>
                                <tr style="background: ${blockData.color || '#667eea'}; color: white;">
                                    <th style="padding: 15px; text-align: left; cursor: pointer;">Name <i class="fa fa-sort"></i></th>
                                    <th style="padding: 15px; text-align: left; cursor: pointer;">Category <i class="fa fa-sort"></i></th>
                                    <th style="padding: 15px; text-align: left; cursor: pointer;">Year <i class="fa fa-sort"></i></th>
                                    <th style="padding: 15px; text-align: center;">Size</th>
                                    <th style="padding: 15px; text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr data-category="reports" data-year="2024" style="border-bottom: 1px solid #eee;">
                                    <td style="padding: 15px;">Sample Document 2024</td>
                                    <td style="padding: 15px;">Reports</td>
                                    <td style="padding: 15px;">2024</td>
                                    <td style="padding: 15px; text-align: center;">2.5 MB</td>
                                    <td style="padding: 15px; text-align: center;">
                                        <a href="#" class="btn btn-sm" style="padding: 6px 15px; background: ${blockData.color || '#667eea'}; color: white; border-radius: 4px; text-decoration: none;">
                                            <i class="fa fa-download"></i> Download
                                        </a>
                                    </td>
                                </tr>
                                <tr data-category="documents" data-year="2024" style="border-bottom: 1px solid #eee;">
                                    <td style="padding: 15px;">Policy Document</td>
                                    <td style="padding: 15px;">Documents</td>
                                    <td style="padding: 15px;">2024</td>
                                    <td style="padding: 15px; text-align: center;">1.2 MB</td>
                                    <td style="padding: 15px; text-align: center;">
                                        <a href="#" class="btn btn-sm" style="padding: 6px 15px; background: ${blockData.color || '#667eea'}; color: white; border-radius: 4px; text-decoration: none;">
                                            <i class="fa fa-download"></i> Download
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="no-results" style="display: none; text-align: center; padding: 40px; color: #999;">
                        <i class="fa fa-search" style="font-size: 48px; margin-bottom: 10px; opacity: 0.5;"></i>
                        <p>No items found</p>
                    </div>
                </div>
            </section>
            <script>
                (function() {
                    const section = document.querySelector('.download-table-section');
                    if (!section) return;

                    const searchInput = section.querySelector('.filter-search');
                    const categorySelect = section.querySelector('.filter-category');
                    const yearSelect = section.querySelector('.filter-year');
                    const table = section.querySelector('.data-table');
                    const tbody = table.querySelector('tbody');
                    const noResults = section.querySelector('.no-results');

                    function filterTable() {
                        const searchTerm = searchInput.value.toLowerCase();
                        const categoryFilter = categorySelect.value;
                        const yearFilter = yearSelect.value;
                        const rows = tbody.querySelectorAll('tr');
                        let visibleCount = 0;

                        rows.forEach(row => {
                            const text = row.textContent.toLowerCase();
                            const category = row.dataset.category;
                            const year = row.dataset.year;

                            const matchesSearch = text.includes(searchTerm);
                            const matchesCategory = !categoryFilter || category === categoryFilter;
                            const matchesYear = !yearFilter || year === yearFilter;

                            if (matchesSearch && matchesCategory && matchesYear) {
                                row.style.display = '';
                                visibleCount++;
                            } else {
                                row.style.display = 'none';
                            }
                        });

                        table.style.display = visibleCount > 0 ? 'table' : 'none';
                        noResults.style.display = visibleCount === 0 ? 'block' : 'none';
                    }

                    searchInput.addEventListener('input', filterTable);
                    categorySelect.addEventListener('change', filterTable);
                    yearSelect.addEventListener('change', filterTable);

                    // Sortable columns
                    const headers = table.querySelectorAll('th');
                    headers.forEach((header, index) => {
                        if (index < 3) {
                            header.addEventListener('click', () => {
                                const rows = Array.from(tbody.querySelectorAll('tr'));
                                const isAsc = header.classList.contains('asc');

                                rows.sort((a, b) => {
                                    const aText = a.children[index].textContent;
                                    const bText = b.children[index].textContent;
                                    return isAsc ? bText.localeCompare(aText) : aText.localeCompare(bText);
                                });

                                rows.forEach(row => tbody.appendChild(row));
                                header.classList.toggle('asc', !isAsc);
                            });
                        }
                    });
                })();
            </script>
        `;
    }

    /**
     * Generate Hero Content
     */
    function generateHeroContent(blockData, schema, defaults) {
        return `
            <section class="hero-section" style="background: linear-gradient(135deg, ${blockData.color || '#667eea'} 0%, #764ba2 100%); padding: 100px 0; color: white;">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-7">
                            <h1 style="font-size: 48px; margin-bottom: 20px;">${blockData.name}</h1>
                            <p style="font-size: 18px; margin-bottom: 30px;">${blockData.description || 'Welcome message'}</p>
                            <a href="#" class="btn btn-light" style="padding: 12px 30px; border-radius: 6px; text-decoration: none; display: inline-block;">Get Started</a>
                        </div>
                    </div>
                </div>
            </section>
        `;
    }

    /**
     * Generate Content Block
     */
    function generateContentContent(blockData, schema, defaults) {
        return `
            <section class="content-section py-5" style="padding: 80px 0;">
                <div class="container">
                    <div class="text-center mb-5">
                        <h2>${blockData.name}</h2>
                        <p>${blockData.description || 'Content description'}</p>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="content-card p-4" style="border: 2px solid #e0e0e0; border-radius: 12px;">
                                <i class="${blockData.icon}" style="font-size: 48px; color: ${blockData.color || '#667eea'}; margin-bottom: 20px;"></i>
                                <h4>Feature Title</h4>
                                <p>Feature description</p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="content-card p-4" style="border: 2px solid #e0e0e0; border-radius: 12px;">
                                <i class="fa fa-star" style="font-size: 48px; color: ${blockData.color || '#667eea'}; margin-bottom: 20px;"></i>
                                <h4>Feature Title</h4>
                                <p>Feature description</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        `;
    }

    /**
     * Generate Form Content
     */
    function generateFormContent(blockData, schema, defaults) {
        return `
            <section class="form-section py-5" style="padding: 80px 0;">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="text-center mb-5">
                                <h2>${blockData.name}</h2>
                                <p>${blockData.description || 'Fill out the form below'}</p>
                            </div>
                            <form class="custom-form" style="background: white; padding: 40px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Name</label>
                                        <input type="text" class="form-control" placeholder="Your Name" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px;">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Email</label>
                                        <input type="email" class="form-control" placeholder="your@email.com" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px;">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Message</label>
                                        <textarea class="form-control" rows="5" placeholder="Your message..." required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px;"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" style="width: 100%; padding: 15px; background: ${blockData.color || '#667eea'}; color: white; border: none; border-radius: 6px; font-size: 16px; font-weight: 600; cursor: pointer;">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        `;
    }

    /**
     * Generate Feature Content
     */
    function generateFeatureContent(blockData, schema, defaults) {
        return `
            <section class="features-section py-5" style="padding: 80px 0;">
                <div class="container">
                    <div class="text-center mb-5">
                        <h2>${blockData.name}</h2>
                        <p>${blockData.description || 'Key features'}</p>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="feature-item text-center p-4" style="border: 2px solid #e0e0e0; border-radius: 12px;">
                                <div style="width: 80px; height: 80px; margin: 0 auto 20px; background: ${blockData.color || '#667eea'}; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <i class="${blockData.icon}" style="font-size: 32px; color: white;"></i>
                                </div>
                                <h4>Feature 1</h4>
                                <p>Description</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="feature-item text-center p-4" style="border: 2px solid #e0e0e0; border-radius: 12px;">
                                <div style="width: 80px; height: 80px; margin: 0 auto 20px; background: ${blockData.color || '#667eea'}; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa fa-star" style="font-size: 32px; color: white;"></i>
                                </div>
                                <h4>Feature 2</h4>
                                <p>Description</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="feature-item text-center p-4" style="border: 2px solid #e0e0e0; border-radius: 12px;">
                                <div style="width: 80px; height: 80px; margin: 0 auto 20px; background: ${blockData.color || '#667eea'}; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa fa-heart" style="font-size: 32px; color: white;"></i>
                                </div>
                                <h4>Feature 3</h4>
                                <p>Description</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        `;
    }

    /**
     * Generate List Content
     */
    function generateListContent(blockData, schema, defaults) {
        return `
            <section class="list-section py-5" style="padding: 80px 0; background: #f8f9fa;">
                <div class="container">
                    <div class="text-center mb-5">
                        <h2>${blockData.name}</h2>
                        <p>${blockData.description || 'List items'}</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="list-item mb-4" style="background: white; padding: 25px; border-left: 4px solid ${blockData.color || '#667eea'}; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                <h5><i class="${blockData.icon}" style="color: ${blockData.color || '#667eea'}; margin-right: 10px;"></i>List Item 1</h5>
                                <p>Item description</p>
                            </div>
                            <div class="list-item mb-4" style="background: white; padding: 25px; border-left: 4px solid ${blockData.color || '#667eea'}; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                <h5><i class="${blockData.icon}" style="color: ${blockData.color || '#667eea'}; margin-right: 10px;"></i>List Item 2</h5>
                                <p>Item description</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        `;
    }

    /**
     * Generate Generic Content (fallback)
     */
    function generateGenericContent(blockData, schema, defaults) {
        return `
            <section class="generic-section py-5" style="padding: 80px 0;">
                <div class="container">
                    <div class="text-center">
                        <i class="${blockData.icon}" style="font-size: 64px; color: ${blockData.color || '#667eea'}; margin-bottom: 20px;"></i>
                        <h2>${blockData.name}</h2>
                        <p>${blockData.description || 'Custom block content'}</p>
                    </div>
                </div>
            </section>
        `;
    }

    /**
     * Generate traits (settings) for the block
     */
    function generateBlockTraits(blockData) {
        const traits = [];

        // Add common traits based on category
        if (blockData.category === 'slider') {
            traits.push(
                {
                    type: 'button',
                    label: 'Add Slide',
                    text: '+ Add Slide',
                    command: (editor) => addSlide(editor),
                },
                {
                    type: 'button',
                    label: 'Remove Slide',
                    text: '− Remove Slide',
                    command: (editor) => removeSlide(editor),
                },
                {
                    type: 'checkbox',
                    label: 'Auto Play',
                    name: 'autoplay',
                    value: true,
                }
            );
        }

        if (blockData.category === 'table') {
            traits.push(
                {
                    type: 'button',
                    label: 'Add Row',
                    text: '+ Add Row',
                    command: (editor) => addTableRow(editor),
                },
                {
                    type: 'button',
                    label: 'Remove Row',
                    text: '− Remove Row',
                    command: (editor) => removeTableRow(editor),
                }
            );
        }

        return traits;
    }

    /**
     * Helper functions for dynamic traits
     */
    function addSlide(editor) {
        const selected = editor.getSelected();
        const slidesContainer = selected.find('.carousel-slides')[0];
        const dotsContainer = selected.find('.carousel-dots')[0];

        if (slidesContainer && dotsContainer) {
            const slideCount = slidesContainer.components().length + 1;

            slidesContainer.append(`
                <div class="carousel-slide" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); min-height: 500px; display: none; align-items: center; background-size: cover; background-position: center;">
                    <div class="container">
                        <div class="carousel-content" style="color: white; max-width: 600px;">
                            <h1 style="font-size: 48px; margin-bottom: 20px;">Slide ${slideCount}</h1>
                            <p style="font-size: 18px; margin-bottom: 30px;">New slide</p>
                            <a href="#" class="btn btn-light" style="padding: 12px 30px; border-radius: 6px; text-decoration: none; display: inline-block;">Action</a>
                        </div>
                    </div>
                </div>
            `);

            dotsContainer.append(`
                <span class="dot" style="width: 12px; height: 12px; background: rgba(255,255,255,0.5); border-radius: 50%; cursor: pointer;"></span>
            `);
        }
    }

    function removeSlide(editor) {
        const selected = editor.getSelected();
        const slidesContainer = selected.find('.carousel-slides')[0];
        const dotsContainer = selected.find('.carousel-dots')[0];

        if (slidesContainer && dotsContainer) {
            const slides = slidesContainer.components();
            const dots = dotsContainer.components();

            if (slides.length > 1) {
                slides.at(slides.length - 1).remove();
                dots.at(dots.length - 1).remove();
            }
        }
    }

    function addTableRow(editor) {
        const selected = editor.getSelected();
        const tbody = selected.find('tbody')[0];

        if (tbody) {
            tbody.append(`
                <tr data-category="documents" data-year="2024" style="border-bottom: 1px solid #eee;">
                    <td style="padding: 15px;">New Document</td>
                    <td style="padding: 15px;">Documents</td>
                    <td style="padding: 15px;">2024</td>
                    <td style="padding: 15px; text-align: center;">0 KB</td>
                    <td style="padding: 15px; text-align: center;">
                        <a href="#" class="btn btn-sm" style="padding: 6px 15px; background: #667eea; color: white; border-radius: 4px; text-decoration: none;">
                            <i class="fa fa-download"></i> Download
                        </a>
                    </td>
                </tr>
            `);
        }
    }

    function removeTableRow(editor) {
        const selected = editor.getSelected();
        const tbody = selected.find('tbody')[0];

        if (tbody) {
            const rows = tbody.components();
            if (rows.length > 1) {
                rows.at(rows.length - 1).remove();
            }
        }
    }

})(window.editor);
