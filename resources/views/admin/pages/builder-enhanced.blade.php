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

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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
            width: 300px;
            background: #f8f9fa;
            border-right: 1px solid #e0e0e0;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .panel-header {
            padding: 0;
            background: white;
            border-bottom: 1px solid #e0e0e0;
        }

        .blocks-tabs {
            display: flex;
            border-bottom: 2px solid #e0e0e0;
        }

        .blocks-tab {
            flex: 1;
            padding: 12px 8px;
            text-align: center;
            cursor: pointer;
            border: none;
            background: #f8f9fa;
            font-size: 13px;
            color: #666;
            transition: all 0.2s;
            border-bottom: 3px solid transparent;
        }

        .blocks-tab:hover {
            background: #e9ecef;
            color: #333;
        }

        .blocks-tab.active {
            color: #667eea;
            border-bottom-color: #667eea;
            background: white;
            font-weight: 600;
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

        .blocks-container {
            flex: 1;
            overflow-y: auto;
            padding: 10px;
        }

        .blocks-tab-content {
            display: none;
        }

        .blocks-tab-content.active {
            display: block;
        }

        /* Custom Blocks Styling */
        .custom-block-item {
            padding: 12px;
            margin-bottom: 10px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            cursor: move;
            transition: all 0.2s;
            background: white;
        }

        .custom-block-item:hover {
            border-color: #667eea;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
            transform: translateY(-2px);
        }

        .custom-block-item.dragging {
            opacity: 0.5;
        }

        .custom-block-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 5px;
        }

        .custom-block-icon {
            font-size: 24px;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .custom-block-info {
            flex: 1;
        }

        .custom-block-name {
            font-weight: 600;
            font-size: 14px;
            color: #333;
            margin-bottom: 2px;
        }

        .custom-block-category {
            font-size: 11px;
            padding: 2px 8px;
            border-radius: 4px;
            display: inline-block;
        }

        .custom-block-description {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
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
        .layers-container,
        .page-settings-container {
            height: 100%;
            padding: 15px;
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

        /* Custom Block Form Modal */
        .custom-block-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 10000;
            align-items: center;
            justify-content: center;
        }

        .custom-block-modal.active {
            display: flex;
        }

        .custom-block-modal-content {
            background: white;
            border-radius: 10px;
            max-width: 800px;
            max-height: 90vh;
            width: 90%;
            display: flex;
            flex-direction: column;
        }

        .custom-block-modal-header {
            padding: 20px;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .custom-block-modal-body {
            padding: 20px;
            overflow-y: auto;
            flex: 1;
        }

        .custom-block-modal-footer {
            padding: 15px 20px;
            border-top: 1px solid #e0e0e0;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        /* Scrollbar Styling */
        .blocks-container::-webkit-scrollbar,
        .properties-content::-webkit-scrollbar,
        .custom-block-modal-body::-webkit-scrollbar {
            width: 8px;
        }

        .blocks-container::-webkit-scrollbar-track,
        .properties-content::-webkit-scrollbar-track,
        .custom-block-modal-body::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .blocks-container::-webkit-scrollbar-thumb,
        .properties-content::-webkit-scrollbar-thumb,
        .custom-block-modal-body::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 4px;
        }

        .blocks-container::-webkit-scrollbar-thumb:hover,
        .properties-content::-webkit-scrollbar-thumb:hover,
        .custom-block-modal-body::-webkit-scrollbar-thumb:hover {
            background: #999;
        }

        /* Page Settings in Right Panel */
        .page-settings-container .form-group {
            margin-bottom: 15px;
        }

        .page-settings-container label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .page-settings-container input[type="text"],
        .page-settings-container select,
        .page-settings-container textarea {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 13px;
        }

        .page-settings-container .form-check {
            margin-bottom: 10px;
        }

        .section-heading {
            font-size: 14px;
            font-weight: 700;
            color: #667eea;
            margin: 20px 0 10px 0;
            padding-bottom: 5px;
            border-bottom: 2px solid #e0e0e0;
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
                    <div class="blocks-tabs">
                        <button class="blocks-tab active" data-tab="grapesjs">
                            <i class="bi bi-grid-3x3-gap"></i><br>
                            Elements
                        </button>
                        <button class="blocks-tab" data-tab="custom">
                            <i class="bi bi-puzzle"></i><br>
                            Custom Blocks
                        </button>
                    </div>
                </div>
                <div class="blocks-search">
                    <input type="text" id="blockSearch" placeholder="Search blocks..." autocomplete="off">
                </div>
                <div class="blocks-container">
                    <!-- GrapesJS Blocks Tab -->
                    <div class="blocks-tab-content active" id="grapesjs-blocks"></div>

                    <!-- Custom Blocks Tab -->
                    <div class="blocks-tab-content" id="custom-blocks">
                        <div id="customBlocksList"></div>
                    </div>
                </div>
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
                    <button class="properties-tab" data-tab="page-settings">
                        <i class="bi bi-file-earmark"></i>
                        Page
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
                    <div class="tab-pane" id="page-settings-pane">
                        <div class="page-settings-container">
                            <h6 class="section-heading">Page Information</h6>
                            <div class="form-group">
                                <label>Page Title</label>
                                <input type="text" class="form-control" id="pageTitle" value="{{ $page->title }}">
                            </div>
                            <div class="form-group">
                                <label>URL Slug</label>
                                <input type="text" class="form-control" id="pageSlug" value="{{ $page->slug }}">
                            </div>

                            <h6 class="section-heading">Options</h6>
                            <div class="form-group">
                                <label>Template</label>
                                <select class="form-select" id="pageTemplate">
                                    <option value="default" {{ $page->template === 'default' ? 'selected' : '' }}>Default</option>
                                    <option value="full-width" {{ $page->template === 'full-width' ? 'selected' : '' }}>Full Width</option>
                                    <option value="sidebar" {{ $page->template === 'sidebar' ? 'selected' : '' }}>With Sidebar</option>
                                    <option value="landing" {{ $page->template === 'landing' ? 'selected' : '' }}>Landing Page</option>
                                </select>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="pagePublished" {{ $page->is_published ? 'checked' : '' }}>
                                <label class="form-check-label" for="pagePublished">
                                    Published
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="pageShowInMenu" {{ $page->show_in_menu ? 'checked' : '' }}>
                                <label class="form-check-label" for="pageShowInMenu">
                                    Show in Menu
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Block Form Modal -->
    <div class="custom-block-modal" id="customBlockModal">
        <div class="custom-block-modal-content">
            <div class="custom-block-modal-header">
                <h5 id="customBlockModalTitle">Add Custom Block</h5>
                <button onclick="closeCustomBlockModal()" class="btn-close"></button>
            </div>
            <div class="custom-block-modal-body" id="customBlockModalBody">
                <!-- Dynamic form will be inserted here -->
            </div>
            <div class="custom-block-modal-footer">
                <button onclick="closeCustomBlockModal()" class="btn btn-secondary">Cancel</button>
                <button onclick="submitCustomBlockForm()" class="btn btn-primary">Add Block</button>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- GrapesJS Scripts -->
    <script src="https://unpkg.com/grapesjs"></script>
    <script src="https://unpkg.com/grapesjs-preset-webpage"></script>
    <script src="https://unpkg.com/grapesjs-blocks-basic"></script>

    <!-- Custom Blocks Script -->
    <script src="{{ asset('js/grapes-custom-blocks.js') }}"></script>

    <script>
        // Initialize GrapesJS
        window.editor = grapesjs.init({
            container: '#gjs',
            height: '100%',
            width: '100%',
            storageManager: false,
            panels: { defaults: [] },
            plugins: ['gjs-preset-webpage', 'gjs-blocks-basic'],
            pluginsOpts: {
                'gjs-preset-webpage': {
                    blocks: ['column1', 'column2', 'column3', 'column3-7'],
                }
            },
            canvas: {
                styles: [
                    '{{ asset("assets/css/bootstrap.min.css") }}',
                    '{{ asset("assets/css/fontawesome.min.css") }}',
                    '{{ asset("assets/css/style.css") }}'
                ],
                scripts: []
            },
            blockManager: {
                appendTo: '#grapesjs-blocks',
            },
            styleManager: {
                appendTo: '.styles-container',
                sectors: [{
                    name: 'General',
                    open: true,
                    buildProps: ['display', 'position', 'float']
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
            traitManager: {
                appendTo: '.traits-container'
            },
            layerManager: {
                appendTo: '.layers-container'
            },
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

        const editor = window.editor;
        let customBlocks = [];
        let currentCustomBlock = null;

        // Add Custom GrapesJS Blocks (function defined in grapes-custom-blocks.js)
        addCustomBlocks(editor);

        // Load Custom Blocks
        async function loadCustomBlocks() {
            try {
                const response = await fetch('{{ route("admin.blocks.list") }}', {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                const data = await response.json();

                if (data.success) {
                    customBlocks = data.blocks;
                    renderCustomBlocks();
                }
            } catch (error) {
                console.error('Error loading custom blocks:', error);
            }
        }

        // Render Custom Blocks in the panel
        function renderCustomBlocks() {
            const container = document.getElementById('customBlocksList');
            container.innerHTML = '';

            customBlocks.forEach(block => {
                const blockEl = document.createElement('div');
                blockEl.className = 'custom-block-item';
                blockEl.setAttribute('draggable', 'true');
                blockEl.setAttribute('data-block-id', block.id);

                blockEl.innerHTML = `
                    <div class="custom-block-header">
                        <div class="custom-block-icon" style="color: ${block.color}">
                            <i class="fas ${block.icon}"></i>
                        </div>
                        <div class="custom-block-info">
                            <div class="custom-block-name">${block.name}</div>
                            <span class="custom-block-category" style="background-color: ${block.color}20; color: ${block.color}">
                                ${block.category}
                            </span>
                        </div>
                    </div>
                    ${block.description ? `<div class="custom-block-description">${block.description}</div>` : ''}
                `;

                blockEl.addEventListener('click', () => openCustomBlockModal(block));

                container.appendChild(blockEl);
            });
        }

        // Open Custom Block Modal
        function openCustomBlockModal(block) {
            currentCustomBlock = block;
            document.getElementById('customBlockModalTitle').textContent = `Add ${block.name}`;
            document.getElementById('customBlockModalBody').innerHTML = generateCustomBlockForm(block);
            document.getElementById('customBlockModal').classList.add('active');
        }

        // Close Custom Block Modal
        function closeCustomBlockModal() {
            document.getElementById('customBlockModal').classList.remove('active');
            currentCustomBlock = null;
        }

        // Generate form based on block schema
        function generateCustomBlockForm(block) {
            let formHTML = '';
            const schema = block.schema;
            const defaults = block.default_values || {};

            if (schema && schema.fields) {
                schema.fields.forEach(field => {
                    formHTML += `<div class="mb-3">`;
                    formHTML += `<label class="form-label">${field.label}</label>`;

                    switch (field.type) {
                        case 'text':
                            formHTML += `<input type="text" class="form-control" name="${field.name}" value="${defaults[field.name] || ''}" ${field.required ? 'required' : ''}>`;
                            break;
                        case 'textarea':
                            formHTML += `<textarea class="form-control" name="${field.name}" rows="3" ${field.required ? 'required' : ''}>${defaults[field.name] || ''}</textarea>`;
                            break;
                        case 'image':
                            formHTML += `<input type="url" class="form-control" name="${field.name}" placeholder="Image URL" value="${defaults[field.name] || ''}">`;
                            break;
                        case 'button':
                            formHTML += `<input type="text" class="form-control mb-2" name="${field.name}_text" placeholder="Button Text" value="${defaults[field.name + '_text'] || ''}">`;
                            formHTML += `<input type="url" class="form-control" name="${field.name}_url" placeholder="Button URL" value="${defaults[field.name + '_url'] || ''}">`;
                            break;
                        case 'color':
                            formHTML += `<input type="color" class="form-control form-control-color" name="${field.name}" value="${defaults[field.name] || '#000000'}">`;
                            break;
                        case 'select':
                            formHTML += `<select class="form-select" name="${field.name}">`;
                            if (field.options) {
                                field.options.forEach(opt => {
                                    formHTML += `<option value="${opt}">${opt}</option>`;
                                });
                            }
                            formHTML += `</select>`;
                            break;
                        case 'toggle':
                            formHTML += `<div class="form-check form-switch">`;
                            formHTML += `<input class="form-check-input" type="checkbox" name="${field.name}" ${defaults[field.name] ? 'checked' : ''}>`;
                            formHTML += `</div>`;
                            break;
                    }

                    formHTML += `</div>`;
                });
            }

            return formHTML;
        }

        // Submit Custom Block Form
        function submitCustomBlockForm() {
            const formData = new FormData();
            const modalBody = document.getElementById('customBlockModalBody');
            const inputs = modalBody.querySelectorAll('input, textarea, select');

            const blockData = {
                block_id: currentCustomBlock.id,
                block_name: currentCustomBlock.name,
                fields: {}
            };

            inputs.forEach(input => {
                if (input.type === 'checkbox') {
                    blockData.fields[input.name] = input.checked;
                } else {
                    blockData.fields[input.name] = input.value;
                }
            });

            // Generate HTML based on block type and data
            const blockHTML = generateBlockHTML(currentCustomBlock, blockData.fields);

            // Add to canvas
            editor.addComponents(blockHTML);

            closeCustomBlockModal();
        }

        // Generate HTML for custom block
        function generateBlockHTML(block, fields) {
            // This is a simple version - you can expand this based on block types
            let html = `<section class="custom-block" data-block-type="${block.category}" style="padding: 60px 0;">`;
            html += `<div class="container">`;

            // Generate based on category
            switch (block.category) {
                case 'hero':
                    html += `
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <h1>${fields.title || 'Title'}</h1>
                                <p>${fields.subtitle || 'Subtitle'}</p>
                                ${fields.button_text_text ? `<a href="${fields.button_url || '#'}" class="btn btn-primary">${fields.button_text_text}</a>` : ''}
                            </div>
                            ${fields.image ? `<div class="col-lg-6"><img src="${fields.image}" class="img-fluid" /></div>` : ''}
                        </div>
                    `;
                    break;

                default:
                    html += `<div class="text-center"><h3>${block.name}</h3><p>Custom block content</p></div>`;
            }

            html += `</div></section>`;
            return html;
        }

        // Tab Switching for Blocks Panel
        document.querySelectorAll('.blocks-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.blocks-tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.blocks-tab-content').forEach(c => c.classList.remove('active'));

                this.classList.add('active');
                const tabName = this.getAttribute('data-tab');
                document.getElementById(tabName + '-blocks').classList.add('active');
            });
        });

        // Tab Switching for Properties Panel
        document.querySelectorAll('.properties-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.properties-tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));

                this.classList.add('active');
                const tabName = this.getAttribute('data-tab');
                document.getElementById(tabName + '-pane').classList.add('active');
            });
        });

        // Device Switcher
        document.querySelectorAll('.device-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.device-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const deviceName = this.getAttribute('data-device');
                editor.setDevice(deviceName);
            });
        });

        // Load existing content
        @if($page->builder_data)
            editor.setComponents({!! json_encode($page->builder_data['components'] ?? []) !!});
            editor.setStyle({!! json_encode($page->builder_data['styles'] ?? []) !!});
        @elseif($page->builder_html)
            editor.setComponents(`{!! addslashes($page->builder_html) !!}`);
            @if($page->builder_css)
                editor.setStyle(`{!! addslashes($page->builder_css) !!}`);
            @endif
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

            // Get page settings
            const pageSettings = {
                title: document.getElementById('pageTitle').value,
                slug: document.getElementById('pageSlug').value,
                template: document.getElementById('pageTemplate').value,
                is_published: document.getElementById('pagePublished').checked,
                show_in_menu: document.getElementById('pageShowInMenu').checked
            };

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
                    use_builder: true,
                    ...pageSettings
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    saveBtn.innerHTML = '<i class="bi bi-check-circle"></i> Saved!';
                    setTimeout(() => {
                        saveBtn.disabled = false;
                        saveBtn.innerHTML = '<i class="bi bi-save"></i> Save';
                    }, 2000);
                } else {
                    alert('Error saving page: ' + (data.message || 'Unknown error'));
                    saveBtn.disabled = false;
                    saveBtn.innerHTML = '<i class="bi bi-save"></i> Save';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error saving page. Please try again.');
                saveBtn.disabled = false;
                saveBtn.innerHTML = '<i class="bi bi-save"></i> Save';
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
            if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                e.preventDefault();
                savePage();
            }
        });

        // Initialize
        loadCustomBlocks();
    </script>
</body>
</html>
