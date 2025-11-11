<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Visual Builder - {{ $page->title }}</title>

    <!-- GrapesJS CSS -->
    <link rel="stylesheet" href="https://unpkg.com/grapesjs/dist/css/grapes.min.css">
    <link rel="stylesheet" href="https://unpkg.com/grapesjs-preset-webpage/dist/grapesjs-preset-webpage.min.css">

    <!-- Bootstrap Icons for blocks -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Font Awesome for icons in blocks -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }

        #gjs {
            height: 100vh;
            width: 100vw;
        }

        /* Custom toolbar */
        .builder-toolbar {
            background: #fff;
            border-bottom: 1px solid #ddd;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .builder-toolbar-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .builder-toolbar-right {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-primary {
            background: #3b82f6;
            color: white;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .btn-success {
            background: #10b981;
            color: white;
        }

        .btn-success:hover {
            background: #059669;
        }

        .page-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        /* GrapesJS customization */
        .gjs-one-bg {
            background-color: #f8f9fa;
        }

        .gjs-two-color {
            color: #3b82f6;
        }

        .gjs-three-bg {
            background-color: #3b82f6;
            color: white;
        }

        .gjs-four-color,
        .gjs-four-color-h:hover {
            color: #3b82f6;
        }

        /* Custom block styles */
        .gjs-block-label {
            text-align: center;
            padding: 10px 5px;
            font-size: 11px;
        }

        .gjs-block-label i {
            font-size: 24px;
            display: block;
            margin-bottom: 5px;
        }

        /* Treasury blocks category */
        .gjs-block-category[data-title="Treasury Sections"] {
            background: #e3f2fd;
        }

        /* Trait button styling */
        .gjs-trt-trait__wrp button[type="button"] {
            width: 100%;
            margin: 5px 0;
            padding: 8px 12px;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
        }

        .gjs-trt-trait__wrp button[type="button"]:hover {
            background: #2563eb;
        }
    </style>
</head>
<body>
    <!-- Custom Toolbar -->
    <div class="builder-toolbar">
        <div class="builder-toolbar-left">
            <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back to Editor
            </a>
            <span class="page-title">{{ $page->title }}</span>
        </div>
        <div class="builder-toolbar-right">
            <button onclick="previewPage()" class="btn btn-secondary">
                <i class="bi bi-eye"></i> Preview
            </button>
            <button onclick="savePage()" class="btn btn-success" id="saveBtn">
                <i class="bi bi-save"></i> Save Page
            </button>
        </div>
    </div>

    <!-- GrapesJS Editor -->
    <div id="gjs"></div>

    <!-- GrapesJS Scripts -->
    <script src="https://unpkg.com/grapesjs"></script>
    <script src="https://unpkg.com/grapesjs-preset-webpage"></script>
    <script src="https://unpkg.com/grapesjs-blocks-basic"></script>

    <script>
        // Initialize GrapesJS and expose globally for treasury-blocks.js
        window.editor = grapesjs.init({
            container: '#gjs',
            height: 'calc(100vh - 60px)',
            width: '100%',
            storageManager: false, // We'll handle storage manually

            // Use webpage preset for better defaults
            plugins: ['gjs-preset-webpage', 'gjs-blocks-basic'],
            pluginsOpts: {
                'gjs-preset-webpage': {
                    blocks: ['column1', 'column2', 'column3', 'column3-7'],
                    modalImportTitle: 'Import Template',
                    modalImportLabel: '<div style="margin-bottom: 10px; font-size: 13px;">Paste here your HTML/CSS and click Import</div>',
                    modalImportContent: function(editor) {
                        return editor.getHtml() + '<style>' + editor.getCss() + '</style>';
                    },
                }
            },

            // Canvas settings
            canvas: {
                styles: [
                    '{{ asset("assets/css/bootstrap.min.css") }}',
                    '{{ asset("assets/css/fontawesome.min.css") }}',
                    '{{ asset("assets/css/style.css") }}'
                ],
                scripts: []
            },

            // Layer Manager
            layerManager: {
                appendTo: '.layers-container'
            },

            // Block Manager
            blockManager: {
                appendTo: '.blocks-container'
            },

            // Style Manager
            styleManager: {
                appendTo: '.styles-container',
                sectors: [{
                    name: 'General',
                    open: true,
                    buildProps: ['float', 'display', 'position', 'top', 'right', 'left', 'bottom']
                }, {
                    name: 'Dimension',
                    open: false,
                    buildProps: ['width', 'height', 'max-width', 'min-height', 'margin', 'padding']
                }, {
                    name: 'Typography',
                    open: false,
                    buildProps: ['font-family', 'font-size', 'font-weight', 'letter-spacing', 'color', 'line-height', 'text-align']
                }, {
                    name: 'Decorations',
                    open: false,
                    buildProps: ['background-color', 'border-radius', 'border', 'box-shadow', 'background']
                }]
            },

            // Trait Manager
            traitManager: {
                appendTo: '.traits-container'
            },

            // Device Manager for responsive
            deviceManager: {
                devices: [{
                    name: 'Desktop',
                    width: ''
                }, {
                    name: 'Tablet',
                    width: '768px',
                    widthMedia: '992px'
                }, {
                    name: 'Mobile',
                    width: '320px',
                    widthMedia: '480px'
                }]
            }
        });

        // Keep local reference to editor for rest of script
        const editor = window.editor;

        // Load existing content if available
        @if($page->builder_data)
            editor.setComponents({!! json_encode($page->builder_data['components'] ?? []) !!});
            editor.setStyle({!! json_encode($page->builder_data['styles'] ?? []) !!});
        @elseif($page->builder_html)
            editor.setComponents(`{!! addslashes($page->builder_html) !!}`);
            @if($page->builder_css)
                editor.setStyle(`{!! addslashes($page->builder_css) !!}`);
            @endif
        @else
            // Load default starter template
            editor.setComponents(`
                <div class="container" style="padding: 40px 20px;">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h1>{{ $page->title }}</h1>
                            <p>Start building your page by dragging blocks from the left panel</p>
                        </div>
                    </div>
                </div>
            `);
        @endif

        // Add custom blocks matching your existing sections
        editor.BlockManager.add('hero-section', {
            label: 'Hero Banner',
            category: 'Custom Sections',
            content: `
                <section class="hero-wrapper hero-1" style="background-image: url('{{ asset('assets/img/hero/hero_bg_1_1.jpg') }}'); padding: 100px 0; background-size: cover; background-position: center;">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-7">
                                <div class="hero-style1">
                                    <span class="sub-title">Welcome</span>
                                    <h1 class="hero-title">Your Title Here</h1>
                                    <p class="hero-text">Your description text goes here.</p>
                                    <a href="#" class="th-btn">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            `,
            attributes: { class: 'bi bi-card-heading' }
        });

        editor.BlockManager.add('services-grid', {
            label: 'Services Grid',
            category: 'Custom Sections',
            content: `
                <section class="space" style="padding: 80px 0;">
                    <div class="container">
                        <div class="title-area text-center">
                            <h2 class="sec-title">Our Services</h2>
                        </div>
                        <div class="row gy-4 mt-4">
                            <div class="col-md-4">
                                <div class="feature-card">
                                    <div class="feature-card-icon">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                    <h3>Service Title</h3>
                                    <p>Service description goes here</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="feature-card">
                                    <div class="feature-card-icon">
                                        <i class="fas fa-cog"></i>
                                    </div>
                                    <h3>Service Title</h3>
                                    <p>Service description goes here</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="feature-card">
                                    <div class="feature-card-icon">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <h3>Service Title</h3>
                                    <p>Service description goes here</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            `,
            attributes: { class: 'bi bi-grid-3x3' }
        });

        editor.BlockManager.add('statistics', {
            label: 'Statistics',
            category: 'Custom Sections',
            content: `
                <section class="counter-area-1" style="padding: 60px 0; background: #f8f9fa;">
                    <div class="container">
                        <div class="row gy-4 justify-content-center">
                            <div class="col-lg-3 col-sm-6">
                                <div class="counter-card text-center">
                                    <div class="counter-card_number" style="font-size: 48px; font-weight: bold; color: #3b82f6;">100+</div>
                                    <p class="counter-card_text">Projects</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="counter-card text-center">
                                    <div class="counter-card_number" style="font-size: 48px; font-weight: bold; color: #3b82f6;">50+</div>
                                    <p class="counter-card_text">Clients</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="counter-card text-center">
                                    <div class="counter-card_number" style="font-size: 48px; font-weight: bold; color: #3b82f6;">15+</div>
                                    <p class="counter-card_text">Years</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            `,
            attributes: { class: 'bi bi-123' }
        });

        editor.BlockManager.add('contact-form', {
            label: 'Contact Form',
            category: 'Custom Sections',
            content: `
                <section class="space" style="padding: 80px 0;">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="title-area text-center mb-4">
                                    <h2 class="sec-title">Get In Touch</h2>
                                    <p>Have a question? We'd love to hear from you.</p>
                                </div>
                                <form class="contact-form">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <input type="text" class="form-control" placeholder="Your Name">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="email" class="form-control" placeholder="Your Email">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <input type="text" class="form-control" placeholder="Subject">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <textarea class="form-control" rows="5" placeholder="Your Message"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="th-btn">Send Message</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            `,
            attributes: { class: 'bi bi-envelope' }
        });

        // Save function
        function savePage() {
            const saveBtn = document.getElementById('saveBtn');
            saveBtn.disabled = true;
            saveBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Saving...';

            const html = editor.getHtml();
            const css = editor.getCss();
            const components = editor.getComponents();
            const styles = editor.getStyle();

            fetch('{{ route("admin.pages.builder.save", $page->id) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    builder_html: html,
                    builder_css: css,
                    builder_data: {
                        components: components,
                        styles: styles
                    },
                    use_builder: true
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    saveBtn.innerHTML = '<i class="bi bi-check-circle"></i> Saved!';
                    setTimeout(() => {
                        saveBtn.disabled = false;
                        saveBtn.innerHTML = '<i class="bi bi-save"></i> Save Page';
                    }, 2000);
                } else {
                    alert('Error saving page: ' + (data.message || 'Unknown error'));
                    saveBtn.disabled = false;
                    saveBtn.innerHTML = '<i class="bi bi-save"></i> Save Page';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error saving page. Please try again.');
                saveBtn.disabled = false;
                saveBtn.innerHTML = '<i class="bi bi-save"></i> Save Page';
            });
        }

        // Preview function
        function previewPage() {
            window.open('{{ route("page.show", $page->slug) }}', '_blank');
        }

        // Auto-save every 2 minutes
        setInterval(() => {
            savePage();
        }, 120000);

        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            // Ctrl+S or Cmd+S to save
            if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                e.preventDefault();
                savePage();
            }
        });
    </script>

    <!-- Load Treasury Custom Blocks -->
    <script src="{{ asset('assets/js/treasury-blocks.js') }}"></script>
</body>
</html>
