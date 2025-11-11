@extends('admin.layouts.app')

@section('title', 'Edit Page')
@section('page-title', 'Edit Page')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Edit Page: {{ $page->title }}</h1>
            <p>Choose how you want to build your page</p>
            @if($page->use_builder)
            <span class="badge bg-info"><i class="fas fa-paint-brush me-1"></i> Using Visual Builder</span>
            @endif
        </div>
        <div class="btn-group">
            <a href="{{ route('page.show', $page->slug) }}" target="_blank" class="btn btn-outline-secondary">
                <i class="fas fa-eye me-2"></i> Preview
            </a>
            <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i> Back
            </a>
        </div>
    </div>
</div>

<!-- Tabs Navigation -->
<ul class="nav nav-tabs mb-4" id="pageEditTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab">
            <i class="fas fa-cog me-2"></i> Page Settings
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="sections-tab" data-bs-toggle="tab" data-bs-target="#sections" type="button" role="tab">
            <i class="fas fa-layer-group me-2"></i> Section Builder
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="visual-builder-tab" data-bs-toggle="tab" data-bs-target="#visual-builder" type="button" role="tab" onclick="initializeGrapesJS()">
            <i class="fas fa-paint-brush me-2"></i> Visual Builder
        </button>
    </li>
</ul>

<!-- Tabs Content -->
<div class="tab-content" id="pageEditTabsContent">

    <!-- Tab 1: Page Settings -->
    <div class="tab-pane fade show active" id="settings" role="tabpanel">
        <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" id="pageSettingsForm">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5><i class="fas fa-edit me-2"></i> Page Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="title" class="form-label">Page Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $page->title) }}" required>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="slug" class="form-label">URL Slug <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">{{ url('/') }}/</span>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $page->slug) }}" required>
                                </div>
                                @error('slug')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="meta_description" class="form-label">Meta Description</label>
                                <textarea class="form-control" id="meta_description" name="meta_description" rows="3">{{ old('meta_description', $page->meta_description) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $page->meta_keywords) }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="fas fa-cog me-2"></i> Page Settings</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="template" class="form-label">Template</label>
                                <select class="form-select" id="template" name="template">
                                    <option value="default" {{ $page->template === 'default' ? 'selected' : '' }}>Default Template</option>
                                    <option value="full-width" {{ $page->template === 'full-width' ? 'selected' : '' }}>Full Width</option>
                                    <option value="sidebar" {{ $page->template === 'sidebar' ? 'selected' : '' }}>With Sidebar</option>
                                    <option value="landing" {{ $page->template === 'landing' ? 'selected' : '' }}>Landing Page</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="parent_id" class="form-label">Parent Page</label>
                                <select class="form-select" id="parent_id" name="parent_id">
                                    <option value="">None (Top Level)</option>
                                    @foreach($pages as $parentPage)
                                    @if($parentPage->id !== $page->id)
                                    <option value="{{ $parentPage->id }}" {{ $page->parent_id == $parentPage->id ? 'selected' : '' }}>
                                        {{ $parentPage->title }}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="menu_order" class="form-label">Menu Order</label>
                                <input type="number" class="form-control" id="menu_order" name="menu_order" value="{{ old('menu_order', $page->menu_order) }}" min="0">
                            </div>

                            <hr>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1" {{ $page->is_published ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_published"><strong>Published</strong></label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="show_in_menu" name="show_in_menu" value="1" {{ $page->show_in_menu ? 'checked' : '' }}>
                                    <label class="form-check-label" for="show_in_menu"><strong>Show in Menu</strong></label>
                                </div>
                            </div>

                            <hr>

                            <div class="small text-muted">
                                <p class="mb-1"><strong>Created:</strong> {{ $page->created_at->format('M d, Y h:i A') }}</p>
                                <p class="mb-0"><strong>Updated:</strong> {{ $page->updated_at->format('M d, Y h:i A') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i> Update Settings
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Tab 2: Section Builder -->
    <div class="tab-pane fade" id="sections" role="tabpanel">
        <!-- Help Section -->
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <h5 class="alert-heading"><i class="fas fa-info-circle me-2"></i>How to Use Section Builder</h5>
            <p class="mb-2"><strong>Section Builder</strong> lets you build pages using pre-designed content blocks. Perfect for structured content!</p>
            <ul class="mb-2">
                <li><strong>Add Section:</strong> Click "Add Section" → Choose section type → Fill in the form</li>
                <li><strong>Reorder:</strong> Drag sections by the grip handle <i class="fas fa-grip-vertical"></i> to rearrange</li>
                <li><strong>Edit:</strong> Click <i class="fas fa-edit"></i> button to modify section content</li>
                <li><strong>Delete:</strong> Click <i class="fas fa-trash"></i> button to remove a section</li>
            </ul>
            <p class="mb-0"><strong>Tip:</strong> Use sections for consistent, structured layouts. For custom designs, use the Visual Builder tab!</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5><i class="fas fa-layer-group me-2"></i> Page Sections</h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSectionModal">
                    <i class="fas fa-plus me-2"></i> Add Section
                </button>
            </div>
            <div class="card-body">
                @if($page->sections->count() > 0)
                <div id="sections-list">
                    @foreach($page->sections as $section)
                    <div class="section-item card mb-3" data-section-id="{{ $section->id }}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center gap-3 mb-2">
                                        <i class="fas fa-grip-vertical text-muted" style="cursor: move;"></i>
                                        <div>
                                            <h6 class="mb-1">
                                                <span class="badge bg-primary me-2">{{ strtoupper(str_replace('_', ' ', $section->section_type)) }}</span>
                                                Order: {{ $section->order }}
                                            </h6>
                                            <small class="text-muted">
                                                @if($section->is_active)
                                                <i class="fas fa-check-circle text-success"></i> Active
                                                @else
                                                <i class="fas fa-times-circle text-danger"></i> Inactive
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                    <div class="section-preview mt-2 p-3 bg-light rounded">
                                        <small class="text-muted">
                                            @php $content = $section->content; @endphp
                                            @if($section->section_type === 'hero_banner')
                                                <strong>Title:</strong> {{ $content['title'] ?? 'N/A' }}
                                            @elseif($section->section_type === 'rich_content')
                                                {{ Str::limit(strip_tags($content['content'] ?? 'N/A'), 100) }}
                                            @else
                                                {{ json_encode($content, JSON_PRETTY_PRINT) }}
                                            @endif
                                        </small>
                                    </div>
                                </div>
                                <div class="btn-group-vertical btn-group-sm">
                                    <button type="button" class="btn btn-outline-primary" onclick="editSection({{ $section->id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger" onclick="deleteSection({{ $section->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-5">
                    <i class="fas fa-layer-group text-muted" style="font-size: 48px; opacity: 0.3;"></i>
                    <p class="text-muted mt-3 mb-0">No sections added yet</p>
                    <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addSectionModal">
                        <i class="fas fa-plus me-2"></i> Add Your First Section
                    </button>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Tab 3: Visual Builder (GrapesJS) -->
    <div class="tab-pane fade" id="visual-builder" role="tabpanel">
        <!-- Help Section -->
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5 class="alert-heading"><i class="fas fa-magic me-2"></i>How to Use Visual Builder</h5>
            <p class="mb-2"><strong>Visual Builder</strong> gives you complete design freedom with drag-and-drop editing. Build anything you can imagine!</p>
            <ul class="mb-2">
                <li><strong>Left Panel:</strong> Drag blocks (text, images, buttons, etc.) onto the canvas</li>
                <li><strong>Click to Edit:</strong> Click any element on the canvas to edit text or change styles</li>
                <li><strong>Right Panel:</strong> Customize colors, fonts, spacing, and more</li>
                <li><strong>Device Preview:</strong> Use the device icons at top to preview on desktop, tablet, and mobile</li>
                <li><strong>Save Your Work:</strong> Click "Save Design" button when you're done</li>
            </ul>
            <p class="mb-0"><strong>Tip:</strong> Start with pre-built blocks from "Custom Sections" category, then customize them to your needs!</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5><i class="fas fa-paint-brush me-2"></i> Visual Page Builder</h5>
                <div class="btn-group">
                    <button onclick="saveBuilderContent()" class="btn btn-success" id="saveBuilderBtn">
                        <i class="fas fa-save me-2"></i> Save Design
                    </button>
                    <button onclick="previewPage()" class="btn btn-outline-secondary">
                        <i class="fas fa-eye me-2"></i> Preview
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <div id="gjs" style="height: 70vh; overflow: hidden;"></div>
            </div>
        </div>
    </div>

</div>

<!-- Add Section Modal -->
<div class="modal fade" id="addSectionModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Section</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted">Select the type of section you want to add:</p>
                <div class="row g-3">
                    @foreach(\App\Models\PageSection::getSectionTypes() as $key => $label)
                    <div class="col-md-6">
                        <div class="card section-type-card" style="cursor: pointer;" onclick="selectSectionType('{{ $key }}')">
                            <div class="card-body">
                                <h6 class="mb-1">{{ $label }}</h6>
                                <small class="text-muted">Add a {{ strtolower($label) }} section</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<!-- GrapesJS CSS -->
<link rel="stylesheet" href="https://unpkg.com/grapesjs/dist/css/grapes.min.css">
<link rel="stylesheet" href="https://unpkg.com/grapesjs-preset-webpage/dist/grapesjs-preset-webpage.min.css">

<style>
    .nav-tabs .nav-link {
        color: #6c757d;
        font-weight: 500;
    }
    .nav-tabs .nav-link.active {
        color: #3b82f6;
        font-weight: 600;
    }
    .section-item {
        transition: all 0.3s ease;
    }
    .section-item:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .section-type-card:hover {
        background: #f8f9fa;
        border-color: #3b82f6;
    }
    #gjs {
        border: 1px solid #dee2e6;
        border-top: none;
    }
    .gjs-one-bg {
        background-color: #f8f9fa;
    }
    .gjs-three-bg {
        background-color: #3b82f6;
        color: white;
    }
    .gjs-four-color, .gjs-four-color-h:hover {
        color: #3b82f6;
    }
</style>
@endpush

@push('scripts')
<!-- GrapesJS Scripts -->
<script src="https://unpkg.com/grapesjs"></script>
<script src="https://unpkg.com/grapesjs-preset-webpage"></script>
<script src="https://unpkg.com/grapesjs-blocks-basic"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<script>
    let editor;
    let editorInitialized = false;

    function initializeGrapesJS() {
        if (editorInitialized) return;

        editor = grapesjs.init({
            container: '#gjs',
            height: '70vh',
            width: '100%',
            storageManager: false,

            plugins: ['gjs-preset-webpage', 'gjs-blocks-basic'],
            pluginsOpts: {
                'gjs-preset-webpage': {
                    blocks: ['column1', 'column2', 'column3'],
                }
            },

            canvas: {
                styles: [
                    '{{ asset("assets/css/bootstrap.min.css") }}',
                    '{{ asset("assets/css/fontawesome.min.css") }}',
                    '{{ asset("assets/css/style.css") }}'
                ]
            },

            deviceManager: {
                devices: [{
                    name: 'Desktop',
                    width: ''
                }, {
                    name: 'Tablet',
                    width: '768px'
                }, {
                    name: 'Mobile',
                    width: '320px'
                }]
            }
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
        @else
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

        // Add custom blocks
        addCustomBlocks(editor);

        editorInitialized = true;
    }

    function addCustomBlocks(editor) {
        editor.BlockManager.add('hero-section', {
            label: 'Hero Banner',
            category: 'Custom Sections',
            content: `
                <section class="hero-wrapper hero-1" style="background-image: url('{{ asset('assets/img/hero/hero_bg_1_1.jpg') }}'); padding: 100px 0; background-size: cover;">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7">
                                <h1 class="hero-title">Your Title Here</h1>
                                <p class="hero-text">Your description text goes here.</p>
                                <a href="#" class="th-btn">Learn More</a>
                            </div>
                        </div>
                    </div>
                </section>
            `
        });

        editor.BlockManager.add('services-grid', {
            label: 'Services Grid',
            category: 'Custom Sections',
            content: `
                <section class="space" style="padding: 80px 0;">
                    <div class="container">
                        <h2 class="text-center mb-5">Our Services</h2>
                        <div class="row gy-4">
                            <div class="col-md-4">
                                <div class="text-center p-4">
                                    <i class="fas fa-chart-line fa-3x mb-3" style="color: #3b82f6;"></i>
                                    <h3>Service Title</h3>
                                    <p>Service description</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center p-4">
                                    <i class="fas fa-cog fa-3x mb-3" style="color: #3b82f6;"></i>
                                    <h3>Service Title</h3>
                                    <p>Service description</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center p-4">
                                    <i class="fas fa-shield-alt fa-3x mb-3" style="color: #3b82f6;"></i>
                                    <h3>Service Title</h3>
                                    <p>Service description</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            `
        });
    }

    function saveBuilderContent() {
        if (!editorInitialized) {
            alert('Please wait for the editor to initialize.');
            return;
        }

        const saveBtn = document.getElementById('saveBuilderBtn');
        saveBtn.disabled = true;
        saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Saving...';

        const html = editor.getHtml();
        const css = editor.getCss();
        const components = editor.getComponents();
        const styles = editor.getStyle();

        fetch('{{ route("admin.pages.builder.save", $page->id) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
                saveBtn.innerHTML = '<i class="fas fa-check-circle me-2"></i> Saved!';
                setTimeout(() => {
                    saveBtn.disabled = false;
                    saveBtn.innerHTML = '<i class="fas fa-save me-2"></i> Save Design';
                }, 2000);
            } else {
                alert('Error saving: ' + (data.message || 'Unknown error'));
                saveBtn.disabled = false;
                saveBtn.innerHTML = '<i class="fas fa-save me-2"></i> Save Design';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error saving design. Please try again.');
            saveBtn.disabled = false;
            saveBtn.innerHTML = '<i class="fas fa-save me-2"></i> Save Design';
        });
    }

    function previewPage() {
        window.open('{{ route("page.show", $page->slug) }}', '_blank');
    }

    // Section Builder functions
    document.addEventListener('DOMContentLoaded', function() {
        const sectionsList = document.getElementById('sections-list');
        if (sectionsList) {
            new Sortable(sectionsList, {
                animation: 150,
                handle: '.fa-grip-vertical',
                onEnd: function(evt) {
                    updateSectionOrder();
                }
            });
        }
    });

    function updateSectionOrder() {
        const sections = document.querySelectorAll('.section-item');
        const sectionIds = Array.from(sections).map(section => section.dataset.sectionId);

        fetch('{{ route("admin.sections.reorder") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ sections: sectionIds })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Section order updated');
            }
        });
    }

    function selectSectionType(type) {
        const modal = bootstrap.Modal.getInstance(document.getElementById('addSectionModal'));
        modal.hide();
        showSectionForm(type);
    }

    function showSectionForm(type, sectionId = null) {
        const formModalHtml = getSectionFormModal(type, sectionId);

        // Remove existing modal if any
        const existingModal = document.getElementById('sectionFormModal');
        if (existingModal) {
            existingModal.remove();
        }

        // Add new modal to body
        document.body.insertAdjacentHTML('beforeend', formModalHtml);

        // Show modal
        const formModal = new bootstrap.Modal(document.getElementById('sectionFormModal'));
        formModal.show();

        // Load section data if editing
        if (sectionId) {
            loadSectionData(sectionId);
        }
    }

    function getSectionFormModal(type, sectionId = null) {
        const isEdit = sectionId !== null;
        const title = isEdit ? 'Edit Section' : 'Add Section';
        const formFields = getSectionFormFields(type);

        return `
            <div class="modal fade" id="sectionFormModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">${title} - ${type.replace(/_/g, ' ').toUpperCase()}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form id="sectionForm" enctype="multipart/form-data">
                                <input type="hidden" name="section_type" value="${type}">
                                <input type="hidden" name="page_id" value="{{ $page->id }}">
                                ${isEdit ? `<input type="hidden" name="section_id" value="${sectionId}">` : ''}
                                ${formFields}
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" checked>
                                    <label class="form-check-label" for="is_active">Active</label>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" onclick="submitSectionForm()">
                                ${isEdit ? 'Update' : 'Add'} Section
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    function getSectionFormFields(type) {
        const fields = {
            'hero_banner': `
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Hero Banner:</strong> Full-width hero section with background image, title, subtitle, and call-to-action button.
                </div>
                <div class="mb-3">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="content[title]" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Subtitle</label>
                    <input type="text" class="form-control" name="content[subtitle]">
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="content[description]" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Button Text</label>
                    <input type="text" class="form-control" name="content[button_text]" placeholder="e.g., Learn More">
                </div>
                <div class="mb-3">
                    <label class="form-label">Button Link</label>
                    <input type="text" class="form-control" name="content[button_link]" placeholder="e.g., /about">
                </div>
                <div class="mb-3">
                    <label class="form-label">Background Image</label>
                    <input type="file" class="form-control" name="background_image" accept="image/*">
                    <small class="text-muted">Recommended size: 1920x1080px</small>
                </div>
            `,
            'rich_content': `
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Rich Content:</strong> Add HTML content, text, images, and formatting.
                </div>
                <div class="mb-3">
                    <label class="form-label">Content <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="content[content]" rows="10" required></textarea>
                    <small class="text-muted">You can use HTML tags for formatting</small>
                </div>
            `,
            'breadcrumb': `
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Breadcrumb:</strong> Page header with title and navigation breadcrumbs.
                </div>
                <div class="mb-3">
                    <label class="form-label">Page Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="content[title]" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Background Image</label>
                    <input type="file" class="form-control" name="background_image" accept="image/*">
                    <small class="text-muted">Optional background image for page header</small>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="content[show_breadcrumb]" id="show_breadcrumb" value="1" checked>
                        <label class="form-check-label" for="show_breadcrumb">Show Breadcrumb Navigation</label>
                    </div>
                </div>
            `,
            'services_grid': `
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Services Grid:</strong> Display services in a grid layout with icons, titles, and descriptions.
                </div>
                <div class="mb-3">
                    <label class="form-label">Section Title</label>
                    <input type="text" class="form-control" name="content[title]" placeholder="e.g., Our Services">
                </div>
                <div class="mb-3">
                    <label class="form-label">Services (JSON Format)</label>
                    <textarea class="form-control" name="content[services]" rows="8" placeholder='[{"title": "Service Name", "description": "Service description", "icon": "fas fa-chart-line"}]'></textarea>
                    <small class="text-muted">Enter services in JSON format. Each service needs: title, description, icon</small>
                </div>
            `,
            'statistics': `
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Statistics:</strong> Display numbers/stats with labels (e.g., "100+ Projects", "50 Clients").
                </div>
                <div class="mb-3">
                    <label class="form-label">Statistics (JSON Format) <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="content[stats]" rows="8" placeholder='[{"number": "100+", "label": "Projects", "suffix": ""}, {"number": "50", "label": "Clients", "suffix": "+"}]' required></textarea>
                    <small class="text-muted">Each stat needs: number, label. Optional: suffix</small>
                </div>
            `,
            'faq': `
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>FAQ Section:</strong> Frequently Asked Questions with collapsible answers.
                </div>
                <div class="mb-3">
                    <label class="form-label">Section Title</label>
                    <input type="text" class="form-control" name="content[title]" placeholder="e.g., Frequently Asked Questions">
                </div>
                <div class="mb-3">
                    <label class="form-label">FAQs (JSON Format) <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="content[faqs]" rows="8" placeholder='[{"question": "What is your question?", "answer": "This is the answer."}]' required></textarea>
                    <small class="text-muted">Each FAQ needs: question, answer</small>
                </div>
            `,
            'contact_form': `
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Contact Form:</strong> Contact form section with title and description.
                </div>
                <div class="mb-3">
                    <label class="form-label">Form Title</label>
                    <input type="text" class="form-control" name="content[title]" placeholder="e.g., Get In Touch">
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="content[description]" rows="3" placeholder="Have a question? We'd love to hear from you."></textarea>
                </div>
            `,
            'team': `
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Team Section:</strong> Display team members with photos and details.
                </div>
                <div class="mb-3">
                    <label class="form-label">Section Title</label>
                    <input type="text" class="form-control" name="content[title]" placeholder="e.g., Our Team">
                </div>
                <div class="mb-3">
                    <label class="form-label">Team Members (JSON Format)</label>
                    <textarea class="form-control" name="content[members]" rows="8" placeholder='[{"name": "John Doe", "position": "Manager", "photo": "path/to/photo.jpg"}]'></textarea>
                    <small class="text-muted">Each member needs: name, position. Optional: photo, bio</small>
                </div>
            `,
            'testimonials': `
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Testimonials:</strong> Customer reviews and testimonials.
                </div>
                <div class="mb-3">
                    <label class="form-label">Section Title</label>
                    <input type="text" class="form-control" name="content[title]" placeholder="e.g., What Our Clients Say">
                </div>
                <div class="mb-3">
                    <label class="form-label">Testimonials (JSON Format)</label>
                    <textarea class="form-control" name="content[testimonials]" rows="8" placeholder='[{"name": "Client Name", "position": "CEO, Company", "content": "Great service!", "rating": 5}]'></textarea>
                    <small class="text-muted">Each testimonial needs: name, content. Optional: position, rating, photo</small>
                </div>
            `,
            'image_gallery': `
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Image Gallery:</strong> Photo gallery with lightbox viewing.
                </div>
                <div class="mb-3">
                    <label class="form-label">Gallery Title</label>
                    <input type="text" class="form-control" name="content[title]" placeholder="e.g., Our Gallery">
                </div>
                <div class="mb-3">
                    <label class="form-label">Images (JSON Format)</label>
                    <textarea class="form-control" name="content[images]" rows="8" placeholder='[{"url": "path/to/image.jpg", "caption": "Image caption"}]'></textarea>
                    <small class="text-muted">Each image needs: url. Optional: caption, alt</small>
                </div>
            `,
            'data_table': `
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Data Table:</strong> Display data in table format.
                </div>
                <div class="mb-3">
                    <label class="form-label">Table Title</label>
                    <input type="text" class="form-control" name="content[title]" placeholder="e.g., Pricing Table">
                </div>
                <div class="mb-3">
                    <label class="form-label">Table Data (JSON Format)</label>
                    <textarea class="form-control" name="content[data]" rows="8" placeholder='{"headers": ["Column 1", "Column 2"], "rows": [["Data 1", "Data 2"]]}'></textarea>
                    <small class="text-muted">Format: {"headers": [...], "rows": [[...]...]}</small>
                </div>
            `
        };

        return fields[type] || '<p class="text-muted">No specific fields for this section type.</p>';
    }

    function submitSectionForm() {
        const form = document.getElementById('sectionForm');
        const formData = new FormData(form);
        const sectionId = formData.get('section_id');
        const isEdit = sectionId !== null;

        // Convert form data to proper structure
        const contentData = {};
        const files = {};

        for (let [key, value] of formData.entries()) {
            if (key.startsWith('content[')) {
                const fieldName = key.match(/content\[(.*?)\]/)[1];
                // Try to parse JSON fields
                if (['services', 'faqs', 'stats', 'members', 'testimonials', 'images', 'data'].includes(fieldName)) {
                    try {
                        contentData[fieldName] = JSON.parse(value);
                    } catch (e) {
                        contentData[fieldName] = value;
                    }
                } else {
                    contentData[fieldName] = value;
                }
            } else if (['background_image', 'image', 'images'].includes(key)) {
                files[key] = value;
            }
        }

        // Prepare request data
        const requestData = new FormData();
        requestData.append('page_id', formData.get('page_id'));
        requestData.append('section_type', formData.get('section_type'));
        requestData.append('content', JSON.stringify(contentData));
        requestData.append('is_active', formData.get('is_active') ? '1' : '0');

        // Append files
        for (let [key, value] of Object.entries(files)) {
            requestData.append(key, value);
        }

        const url = isEdit
            ? `{{ url('admin/page-sections') }}/${sectionId}`
            : '{{ route("admin.sections.store") }}';

        // For PUT requests, we need to add _method field
        if (isEdit) {
            requestData.append('_method', 'PUT');
        }

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: requestData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('sectionFormModal'));
                modal.hide();

                // Reload page to show updated sections
                window.location.reload();
            } else {
                alert('Error saving section. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error saving section. Please try again.');
        });
    }

    function editSection(sectionId) {
        // Get section type from the page
        const sectionItem = document.querySelector(`[data-section-id="${sectionId}"]`);
        const sectionType = sectionItem.querySelector('.badge').textContent.toLowerCase().replace(/\s+/g, '_');

        showSectionForm(sectionType, sectionId);
    }

    function loadSectionData(sectionId) {
        // This would load section data via AJAX and populate the form
        console.log('Loading section data for:', sectionId);
        // TODO: Implement section data loading
    }

    function deleteSection(sectionId) {
        if (!confirm('Are you sure you want to delete this section?')) return;

        fetch(`{{ url('admin/page-sections') }}/${sectionId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelector(`[data-section-id="${sectionId}"]`).remove();
                if (document.querySelectorAll('.section-item').length === 0) {
                    window.location.reload();
                }
            } else {
                alert('Error deleting section. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error deleting section. Please try again.');
        });
    }
</script>
@endpush
@endsection
