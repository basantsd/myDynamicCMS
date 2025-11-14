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
        * {
            box-sizing: border-box;
        }

        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        /* Main Layout */
        .builder-wrapper {
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        /* Top Toolbar */
        .builder-toolbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        .builder-toolbar-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .builder-toolbar-right {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .page-title {
            font-size: 18px;
            font-weight: 600;
            color: white;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }

        .btn-white {
            background: white;
            color: #667eea;
        }

        .btn-white:hover {
            background: #f8f9fa;
        }

        .btn-success {
            background: #10b981;
            color: white;
        }

        .btn-success:hover {
            background: #059669;
        }

        .btn-transparent {
            background: rgba(255,255,255,0.2);
            color: white;
            border: 1px solid rgba(255,255,255,0.3);
        }

        .btn-transparent:hover {
            background: rgba(255,255,255,0.3);
        }

        /* Main Content Area */
        .builder-content {
            display: flex;
            flex: 1;
            overflow: hidden;
            height: calc(100vh - 56px);
        }

        /* Left Sidebar - Blocks Panel */
        .blocks-panel {
            width: 280px;
            background: #f8f9fa;
            border-right: 1px solid #e0e0e0;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .panel-header {
            padding: 12px 16px;
            background: white;
            border-bottom: 1px solid #e0e0e0;
            font-weight: 600;
            color: #333;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .blocks-search {
            padding: 10px;
            background: white;
            border-bottom: 1px solid #e0e0e0;
        }

        .blocks-search input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 13px;
            outline: none;
            transition: all 0.2s;
        }

        .blocks-search input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .blocks-search input::placeholder {
            color: #999;
        }

        .blocks-container {
            flex: 1;
            overflow-y: auto;
            padding: 10px;
        }

        /* Center Canvas */
        .canvas-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #e9ecef;
            overflow: hidden;
        }

        #gjs {
            height: 100%;
            width: 100%;
        }

        /* Right Sidebar - Properties */
        .properties-panel {
            width: 300px;
            background: #f8f9fa;
            border-left: 1px solid #e0e0e0;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .properties-tabs {
            display: flex;
            background: white;
            border-bottom: 1px solid #e0e0e0;
        }

        .properties-tab {
            flex: 1;
            padding: 12px 8px;
            text-align: center;
            cursor: pointer;
            border: none;
            background: none;
            font-size: 13px;
            color: #666;
            transition: all 0.2s;
            border-bottom: 2px solid transparent;
        }

        .properties-tab:hover {
            background: #f8f9fa;
            color: #333;
        }

        .properties-tab.active {
            color: #667eea;
            border-bottom-color: #667eea;
            background: white;
        }

        .properties-tab i {
            display: block;
            font-size: 18px;
            margin-bottom: 4px;
        }

        .properties-content {
            flex: 1;
            overflow-y: auto;
        }

        .tab-pane {
            display: none;
            height: 100%;
        }

        .tab-pane.active {
            display: block;
        }

        .styles-container,
        .traits-container,
        .layers-container {
            height: 100%;
        }

        /* Device Switcher */
        .device-switcher {
            display: flex;
            gap: 5px;
            background: rgba(255,255,255,0.15);
            padding: 4px;
            border-radius: 6px;
        }

        .device-btn {
            padding: 6px 12px;
            background: transparent;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
            transition: all 0.2s;
        }

        .device-btn:hover {
            background: rgba(255,255,255,0.2);
        }

        .device-btn.active {
            background: rgba(255,255,255,0.3);
            font-weight: 600;
        }

        /* GrapesJS Theme Customization */
        .gjs-one-bg {
            background-color: white;
        }

        .gjs-two-color {
            color: #667eea;
        }

        .gjs-three-bg {
            background-color: #667eea;
            color: white;
        }

        .gjs-four-color,
        .gjs-four-color-h:hover {
            color: #667eea;
        }

        .gjs-block {
            min-height: 80px;
            border-radius: 8px;
            border: 2px solid #e0e0e0;
            transition: all 0.2s;
            margin-bottom: 10px;
        }

        .gjs-block:hover {
            border-color: #667eea;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
            transform: translateY(-2px);
        }

        .gjs-block-label {
            padding: 12px 8px;
            line-height: 1.3;
        }

        .gjs-block__media {
            margin-bottom: 6px;
        }

        .gjs-category-title {
            padding: 12px 10px;
            background: white;
            border-radius: 6px;
            margin-bottom: 10px;
            font-weight: 600;
            color: #333;
            border-left: 3px solid #667eea;
        }

        .gjs-blocks-c {
            padding: 0;
        }

        /* Trait Manager Buttons */
        .gjs-trt-trait__wrp button[type="button"] {
            width: 100%;
            margin: 5px 0;
            padding: 10px 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .gjs-trt-trait__wrp button[type="button"]:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        /* Style Manager */
        .gjs-sm-sector-title {
            background: white;
            border-radius: 6px;
            padding: 10px 12px;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .gjs-sm-sector.gjs-sm-open .gjs-sm-sector-title {
            color: #667eea;
        }

        /* Layer Manager */
        .gjs-layer {
            border-radius: 4px;
            margin-bottom: 2px;
        }

        .gjs-layer.gjs-selected {
            background: #e7e9fc;
        }

        /* Scrollbar Styling */
        .blocks-container::-webkit-scrollbar,
        .properties-content::-webkit-scrollbar {
            width: 8px;
        }

        .blocks-container::-webkit-scrollbar-track,
        .properties-content::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .blocks-container::-webkit-scrollbar-thumb,
        .properties-content::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 4px;
        }

        .blocks-container::-webkit-scrollbar-thumb:hover,
        .properties-content::-webkit-scrollbar-thumb:hover {
            background: #999;
        }

        /* Canvas background pattern */
        .gjs-cv-canvas {
            background-image:
                linear-gradient(45deg, #f0f0f0 25%, transparent 25%),
                linear-gradient(-45deg, #f0f0f0 25%, transparent 25%),
                linear-gradient(45deg, transparent 75%, #f0f0f0 75%),
                linear-gradient(-45deg, transparent 75%, #f0f0f0 75%);
            background-size: 20px 20px;
            background-position: 0 0, 0 10px, 10px -10px, -10px 0px;
        }

        /* Section Movement Controls */
        .gjs-toolbar {
            background: #667eea;
            border-radius: 6px;
        }

        .gjs-toolbar-item {
            color: white !important;
            padding: 6px 8px;
            border-radius: 4px;
            transition: all 0.2s;
        }

        .gjs-toolbar-item:hover {
            background: rgba(255,255,255,0.2);
        }

        /* Template Selector Dropdown */
        .template-selector {
            position: relative;
        }

        .template-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 8px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            min-width: 250px;
            max-height: 400px;
            overflow-y: auto;
            z-index: 1000;
            display: none;
        }

        .template-dropdown.active {
            display: block;
        }

        .template-dropdown-header {
            padding: 15px;
            border-bottom: 1px solid #e0e0e0;
            font-weight: 600;
            color: #333;
        }

        .template-item {
            padding: 12px 15px;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .template-item:hover {
            background: #f8f9fa;
        }

        .template-item i {
            color: #667eea;
            font-size: 18px;
            width: 24px;
        }

        .template-item-content h6 {
            margin: 0 0 4px 0;
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        .template-item-content p {
            margin: 0;
            font-size: 12px;
            color: #666;
        }

        /* Block hidden state for search */
        .gjs-block.hidden {
            display: none !important;
        }

        .gjs-category.hidden {
            display: none !important;
        }

        /* No results message */
        .no-results {
            padding: 40px 20px;
            text-align: center;
            color: #999;
        }

        .no-results i {
            font-size: 48px;
            margin-bottom: 10px;
            opacity: 0.5;
        }
    </style>
</head>
<body>
    <div class="builder-wrapper">
        <!-- Top Toolbar -->
        <div class="builder-toolbar">
            <div class="builder-toolbar-left">
                <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-white">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
                <span class="page-title">
                    <i class="bi bi-pencil-square"></i>
                    {{ $page->title }}
                </span>
            </div>
            <div class="builder-toolbar-right">
                <!-- Device Switcher -->
                <div class="device-switcher">
                    <button class="device-btn active" data-device="Desktop" title="Desktop View">
                        <i class="bi bi-display"></i>
                    </button>
                    <button class="device-btn" data-device="Tablet" title="Tablet View">
                        <i class="bi bi-tablet"></i>
                    </button>
                    <button class="device-btn" data-device="Mobile" title="Mobile View">
                        <i class="bi bi-phone"></i>
                    </button>
                </div>

                <!-- Template Selector -->
                <div class="template-selector">
                    <button onclick="toggleTemplateDropdown()" class="btn btn-transparent" id="templateBtn">
                        <i class="bi bi-layout-text-sidebar"></i> Templates
                    </button>
                    <div class="template-dropdown" id="templateDropdown">
                        <div class="template-dropdown-header">
                            <i class="bi bi-layout-text-sidebar"></i> Choose Template
                        </div>
                        <div class="template-item" onclick="loadTemplate('blank')">
                            <i class="bi bi-file-earmark"></i>
                            <div class="template-item-content">
                                <h6>Blank Page</h6>
                                <p>Start from scratch</p>
                            </div>
                        </div>
                        <div class="template-item" onclick="loadTemplate('hero')">
                            <i class="bi bi-card-image"></i>
                            <div class="template-item-content">
                                <h6>Hero Landing</h6>
                                <p>Hero section with CTA</p>
                            </div>
                        </div>
                        <div class="template-item" onclick="loadTemplate('services')">
                            <i class="bi bi-grid-3x3"></i>
                            <div class="template-item-content">
                                <h6>Services Page</h6>
                                <p>Service grid layout</p>
                            </div>
                        </div>
                        <div class="template-item" onclick="loadTemplate('about')">
                            <i class="bi bi-person-badge"></i>
                            <div class="template-item-content">
                                <h6>About Us</h6>
                                <p>Team and mission</p>
                            </div>
                        </div>
                        <div class="template-item" onclick="loadTemplate('contact')">
                            <i class="bi bi-envelope"></i>
                            <div class="template-item-content">
                                <h6>Contact Page</h6>
                                <p>Form and info</p>
                            </div>
                        </div>
                    </div>
                </div>

                <button onclick="previewPage()" class="btn btn-transparent">
                    <i class="bi bi-eye"></i> Preview
                </button>
                <button onclick="savePage()" class="btn btn-success" id="saveBtn">
                    <i class="bi bi-save"></i> Save
                </button>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="builder-content">
            <!-- Left Sidebar - Blocks Panel -->
            <div class="blocks-panel">
                <div class="panel-header">
                    <i class="bi bi-grid-3x3-gap"></i>
                    Blocks
                </div>
                <div class="blocks-search">
                    <input type="text" id="blockSearch" placeholder="Search blocks..." autocomplete="off">
                </div>
                <div class="blocks-container"></div>
            </div>

            <!-- Center Canvas Area -->
            <div class="canvas-area">
                <div id="gjs"></div>
            </div>

            <!-- Right Sidebar - Properties Panel -->
            <div class="properties-panel">
                <div class="properties-tabs">
                    <button class="properties-tab active" data-tab="styles">
                        <i class="bi bi-palette"></i>
                        Styles
                    </button>
                    <button class="properties-tab" data-tab="settings">
                        <i class="bi bi-gear"></i>
                        Settings
                    </button>
                    <button class="properties-tab" data-tab="layers">
                        <i class="bi bi-layers"></i>
                        Layers
                    </button>
                </div>
                <div class="properties-content">
                    <div class="tab-pane active" id="styles-pane">
                        <div class="styles-container"></div>
                    </div>
                    <div class="tab-pane" id="settings-pane">
                        <div class="traits-container"></div>
                    </div>
                    <div class="tab-pane" id="layers-pane">
                        <div class="layers-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- GrapesJS Scripts -->
    <script src="https://unpkg.com/grapesjs"></script>
    <script src="https://unpkg.com/grapesjs-preset-webpage"></script>
    <script src="https://unpkg.com/grapesjs-blocks-basic"></script>

    <!-- Dynamic Database-Driven Blocks Loader -->
    <script src="{{ asset('js/dynamic-blocks-loader.js') }}"></script>

    <!-- Banner and Form Loader -->
    <script src="{{ asset('js/banner-form-loader.js') }}"></script>

    <script>
        // Initialize GrapesJS and expose globally for treasury-blocks.js
        window.editor = grapesjs.init({
            container: '#gjs',
            height: '100%',
            width: '100%',
            storageManager: false, // We'll handle storage manually

            // Remove default panels - we're using custom layout
            panels: { defaults: [] },

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

            // Block Manager - append to our custom container
            blockManager: {
                appendTo: '.blocks-container',
            },

            // Style Manager - append to our custom container
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

            // Trait Manager (Settings) - append to our custom container
            traitManager: {
                appendTo: '.traits-container'
            },

            // Layer Manager - append to our custom container
            layerManager: {
                appendTo: '.layers-container'
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

        // Load Banners and Forms from database (banner-form-loader.js)
        if (typeof BannerFormLoader !== 'undefined') {
            BannerFormLoader.init(editor);
        }

        // Tab Switching Functionality
        document.querySelectorAll('.properties-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs
                document.querySelectorAll('.properties-tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));

                // Add active class to clicked tab
                this.classList.add('active');
                const tabName = this.getAttribute('data-tab');
                document.getElementById(tabName + '-pane').classList.add('active');
            });
        });

        // Device Switcher Functionality
        document.querySelectorAll('.device-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove active class from all buttons
                document.querySelectorAll('.device-btn').forEach(b => b.classList.remove('active'));

                // Add active class to clicked button
                this.classList.add('active');

                // Set device in editor
                const deviceName = this.getAttribute('data-device');
                editor.setDevice(deviceName);
            });
        });

        // Block Search Functionality
        const blockSearch = document.getElementById('blockSearch');
        let noResultsMsg = null;

        blockSearch.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase().trim();
            const blocks = document.querySelectorAll('.gjs-block');
            const categories = document.querySelectorAll('.gjs-block-category');
            let visibleCount = 0;

            if (searchTerm === '') {
                // Show all blocks and categories
                blocks.forEach(block => block.classList.remove('hidden'));
                categories.forEach(cat => cat.classList.remove('hidden'));
                if (noResultsMsg) noResultsMsg.remove();
                return;
            }

            // Filter blocks
            blocks.forEach(block => {
                const label = block.querySelector('.gjs-block-label')?.textContent.toLowerCase() || '';
                if (label.includes(searchTerm)) {
                    block.classList.remove('hidden');
                    visibleCount++;
                } else {
                    block.classList.add('hidden');
                }
            });

            // Show/hide categories based on visible blocks
            categories.forEach(cat => {
                const visibleBlocks = cat.querySelectorAll('.gjs-block:not(.hidden)');
                if (visibleBlocks.length > 0) {
                    cat.classList.remove('hidden');
                } else {
                    cat.classList.add('hidden');
                }
            });

            // Show no results message
            if (visibleCount === 0) {
                if (!noResultsMsg) {
                    noResultsMsg = document.createElement('div');
                    noResultsMsg.className = 'no-results';
                    noResultsMsg.innerHTML = '<i class="bi bi-search"></i><div>No blocks found</div>';
                    document.querySelector('.blocks-container').appendChild(noResultsMsg);
                }
            } else if (noResultsMsg) {
                noResultsMsg.remove();
                noResultsMsg = null;
            }
        });

        // Template Dropdown Toggle
        function toggleTemplateDropdown() {
            const dropdown = document.getElementById('templateDropdown');
            dropdown.classList.toggle('active');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('templateDropdown');
            const btn = document.getElementById('templateBtn');
            if (!dropdown.contains(e.target) && !btn.contains(e.target)) {
                dropdown.classList.remove('active');
            }
        });

        // Load Template Function
        function loadTemplate(templateName) {
            if (!confirm('This will replace your current page content. Continue?')) {
                return;
            }

            const templates = {
                blank: `
                    <div class="container" style="padding: 40px 20px;">
                        <div class="row">
                            <div class="col-12">
                                <h1>Start Building</h1>
                                <p>Drag blocks from the left panel to create your page</p>
                            </div>
                        </div>
                    </div>
                `,
                hero: `
                    <section class="hero-wrapper" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 100px 0; color: white;">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-7">
                                    <h1 style="font-size: 48px; margin-bottom: 20px;">Welcome to Our Site</h1>
                                    <p style="font-size: 18px; margin-bottom: 30px;">Create amazing experiences for your visitors</p>
                                    <a href="#" class="btn btn-light" style="padding: 12px 30px; border-radius: 6px; text-decoration: none;">Get Started</a>
                                </div>
                            </div>
                        </div>
                    </section>
                `,
                services: `
                    <section style="padding: 80px 0;">
                        <div class="container">
                            <div class="text-center mb-5">
                                <h2>Our Services</h2>
                                <p>What we offer</p>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <div class="text-center p-4" style="border: 1px solid #e0e0e0; border-radius: 10px;">
                                        <i class="fas fa-laptop-code" style="font-size: 48px; color: #667eea; margin-bottom: 20px;"></i>
                                        <h4>Web Development</h4>
                                        <p>Modern websites</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="text-center p-4" style="border: 1px solid #e0e0e0; border-radius: 10px;">
                                        <i class="fas fa-mobile-alt" style="font-size: 48px; color: #667eea; margin-bottom: 20px;"></i>
                                        <h4>Mobile Apps</h4>
                                        <p>iOS & Android</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="text-center p-4" style="border: 1px solid #e0e0e0; border-radius: 10px;">
                                        <i class="fas fa-chart-line" style="font-size: 48px; color: #667eea; margin-bottom: 20px;"></i>
                                        <h4>Digital Marketing</h4>
                                        <p>Grow your business</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                `,
                about: `
                    <section style="padding: 80px 0;">
                        <div class="container">
                            <div class="row align-items-center mb-5">
                                <div class="col-lg-6">
                                    <h2>About Us</h2>
                                    <p style="font-size: 16px; line-height: 1.8;">We are a team of passionate professionals dedicated to delivering exceptional results.</p>
                                </div>
                                <div class="col-lg-6">
                                    <img src="/assets/img/placeholder.jpg" alt="About" style="width: 100%; border-radius: 10px;">
                                </div>
                            </div>
                            <div class="text-center mb-4">
                                <h3>Our Team</h3>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <div class="text-center">
                                        <div style="width: 150px; height: 150px; border-radius: 50%; background: #e0e0e0; margin: 0 auto 15px;"></div>
                                        <h5>John Doe</h5>
                                        <p>CEO</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="text-center">
                                        <div style="width: 150px; height: 150px; border-radius: 50%; background: #e0e0e0; margin: 0 auto 15px;"></div>
                                        <h5>Jane Smith</h5>
                                        <p>CTO</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="text-center">
                                        <div style="width: 150px; height: 150px; border-radius: 50%; background: #e0e0e0; margin: 0 auto 15px;"></div>
                                        <h5>Mike Johnson</h5>
                                        <p>Designer</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                `,
                contact: `
                    <section style="padding: 80px 0;">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 mx-auto">
                                    <div class="text-center mb-5">
                                        <h2>Contact Us</h2>
                                        <p>Get in touch with us</p>
                                    </div>
                                    <form>
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
                                                <textarea class="form-control" rows="5" placeholder="Message"></textarea>
                                            </div>
                                            <div class="col-12 text-center">
                                                <button type="submit" class="btn btn-primary">Send Message</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                `
            };

            editor.setComponents(templates[templateName] || templates.blank);
            document.getElementById('templateDropdown').classList.remove('active');
        }

        // Add Move Section Commands
        editor.Commands.add('move-up', {
            run(editor, sender, options) {
                const selected = editor.getSelected();
                if (selected) {
                    const parent = selected.parent();
                    const index = parent.components().indexOf(selected);
                    if (index > 0) {
                        parent.components().remove(selected);
                        parent.components().add(selected, { at: index - 1 });
                        editor.select(selected);
                    }
                }
            }
        });

        editor.Commands.add('move-down', {
            run(editor, sender, options) {
                const selected = editor.getSelected();
                if (selected) {
                    const parent = selected.parent();
                    const components = parent.components();
                    const index = components.indexOf(selected);
                    if (index < components.length - 1) {
                        parent.components().remove(selected);
                        parent.components().add(selected, { at: index + 1 });
                        editor.select(selected);
                    }
                }
            }
        });

        // Customize toolbar to include move buttons for sections
        editor.on('component:selected', (component) => {
            const toolbar = component.get('toolbar');
            const defaultToolbar = [
                { attributes: { class: 'fa fa-arrow-up' }, command: 'move-up', label: '↑' },
                { attributes: { class: 'fa fa-arrow-down' }, command: 'move-down', label: '↓' },
                { attributes: { class: 'fa fa-arrows-alt' }, command: 'tlb-move', label: '⇵' },
                { attributes: { class: 'fa fa-clone' }, command: 'tlb-clone', label: '⎘' },
                { attributes: { class: 'fa fa-trash' }, command: 'tlb-delete', label: '🗑' }
            ];

            component.set('toolbar', defaultToolbar);
        });

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

    <!-- Load HTML Elements Blocks -->
    <script src="{{ asset('js/html-elements-blocks.js') }}"></script>
</body>
</html>
