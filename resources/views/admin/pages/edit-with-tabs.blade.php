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
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <h5 class="alert-heading"><i class="fas fa-magic me-2"></i>How to Use Visual Builder</h5>
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-2"><strong>✨ Getting Started:</strong></p>
                    <ul class="mb-0 small">
                        <li><strong>Drag & Drop:</strong> Drag blocks from left panel onto canvas</li>
                        <li><strong>Click to Edit:</strong> Double-click text to edit, single-click for settings</li>
                        <li><strong>Right Panel:</strong> Layers, Styles, and Settings tabs</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <p class="mb-2"><strong>🎨 Tips:</strong></p>
                    <ul class="mb-0 small">
                        <li><strong>Templates:</strong> Click template icon in toolbar for ready-made pages</li>
                        <li><strong>Devices:</strong> Preview on desktop/tablet/mobile views</li>
                        <li><strong>Save Often:</strong> Click Save Design (or Ctrl+S) frequently</li>
                    </ul>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center py-2">
                <div class="d-flex align-items-center gap-3">
                    <h5 class="mb-0"><i class="fas fa-paint-brush me-2"></i> Visual Page Builder</h5>
                    <div class="panel__devices btn-group btn-group-sm"></div>
                </div>
                <div class="btn-group btn-group-sm">
                    <button onclick="saveBuilderContent()" class="btn btn-success" id="saveBuilderBtn">
                        <i class="fas fa-save me-1"></i> Save Design
                    </button>
                    <button onclick="previewPage()" class="btn btn-outline-secondary">
                        <i class="fas fa-eye me-1"></i> Preview
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <!-- GrapesJS Editor with Panels -->
                <div class="editor-row" style="display: flex; height: 75vh;">
                    <!-- Left Panel: Blocks -->
                    <div class="editor-column" style="flex: 0 0 250px; overflow-y: auto; border-right: 1px solid #dee2e6; background: #f8f9fa;">
                        <div style="padding: 15px 10px; background: #fff; border-bottom: 2px solid #bd2828;">
                            <h6 class="mb-0" style="font-weight: 600; color: #bd2828;">
                                <i class="fas fa-th-large me-2"></i>Block Library
                            </h6>
                            <small class="text-muted">Drag blocks onto canvas</small>
                        </div>
                        <div class="blocks-container" style="padding: 10px;"></div>
                    </div>

                    <!-- Center: Canvas -->
                    <div class="editor-column" style="flex: 1; display: flex; flex-direction: column;">
                        <div class="panel__switcher" style="padding: 10px; background: #fff; border-bottom: 1px solid #dee2e6; display: flex; gap: 5px;"></div>
                        <div id="gjs" style="flex: 1; overflow: hidden;"></div>
                    </div>

                    <!-- Right Panel: Layers, Styles, Traits -->
                    <div class="panel__right editor-column" style="flex: 0 0 300px; display: flex; flex-direction: column; border-left: 1px solid #dee2e6; background: #fff;">
                        <!-- Panel Tabs -->
                        <div style="padding: 10px; background: #f8f9fa; border-bottom: 1px solid #dee2e6;">
                            <ul class="nav nav-pills nav-fill" role="tablist" style="font-size: 13px;">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="layers-tab" data-bs-toggle="pill" data-bs-target="#layers-panel" type="button" role="tab">
                                        <i class="fas fa-bars"></i> Layers
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="styles-tab" data-bs-toggle="pill" data-bs-target="#styles-panel" type="button" role="tab">
                                        <i class="fas fa-paint-brush"></i> Styles
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="traits-tab" data-bs-toggle="pill" data-bs-target="#traits-panel" type="button" role="tab">
                                        <i class="fas fa-cog"></i> Settings
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <!-- Tab Content -->
                        <div class="tab-content" style="flex: 1; overflow-y: auto;">
                            <!-- Layers Panel -->
                            <div class="tab-pane fade show active" id="layers-panel" role="tabpanel">
                                <div style="padding: 15px 10px; background: #fff; border-bottom: 1px solid #dee2e6;">
                                    <h6 class="mb-0" style="font-weight: 600;">
                                        <i class="fas fa-layer-group me-2"></i>Element Layers
                                    </h6>
                                    <small class="text-muted">Click to select, drag to reorder</small>
                                </div>
                                <div class="layers-container" style="padding: 5px;"></div>
                            </div>

                            <!-- Styles Panel -->
                            <div class="tab-pane fade" id="styles-panel" role="tabpanel">
                                <div style="padding: 15px 10px; background: #fff; border-bottom: 1px solid #dee2e6;">
                                    <h6 class="mb-0" style="font-weight: 600;">
                                        <i class="fas fa-palette me-2"></i>Style Properties
                                    </h6>
                                    <small class="text-muted">Customize appearance</small>
                                </div>
                                <div class="styles-container"></div>
                            </div>

                            <!-- Traits Panel -->
                            <div class="tab-pane fade" id="traits-panel" role="tabpanel">
                                <div style="padding: 15px 10px; background: #fff; border-bottom: 1px solid #dee2e6;">
                                    <h6 class="mb-0" style="font-weight: 600;">
                                        <i class="fas fa-sliders-h me-2"></i>Element Settings
                                    </h6>
                                    <small class="text-muted">Configure attributes</small>
                                </div>
                                <div class="traits-container" style="padding: 10px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
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
        color: #bd2828;
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
        border-color: #bd2828;
    }
    #gjs {
        border: 1px solid #dee2e6;
        border-top: none;
    }

    /* Enhanced GrapesJS Styling - Make UI More User Friendly */
    .gjs-one-bg {
        background-color: #f8f9fa !important;
    }
    .gjs-two-color {
        color: #212529 !important;
    }
    .gjs-three-bg {
        background-color: #bd2828 !important;
        color: white !important;
    }
    .gjs-four-color, .gjs-four-color-h:hover {
        color: #bd2828 !important;
    }

    /* Make buttons look active and clickable */
    .gjs-pn-btn {
        opacity: 1 !important;
        cursor: pointer !important;
        background-color: transparent !important;
        border: none !important;
        color: #495057 !important;
        transition: all 0.2s ease !important;
    }
    .gjs-pn-btn:hover {
        background-color: #e9ecef !important;
        color: #212529 !important;
    }
    .gjs-pn-btn.gjs-pn-active {
        background-color: #bd2828 !important;
        color: #ffffff !important;
    }

    /* Block Manager Styling */
    .gjs-blocks-c {
        background-color: #ffffff !important;
    }
    .gjs-block-category .gjs-title {
        background-color: #e9ecef !important;
        color: #212529 !important;
        font-weight: 600 !important;
        padding: 12px 10px !important;
        border-bottom: 1px solid #dee2e6 !important;
    }
    .gjs-block {
        background-color: #ffffff !important;
        border: 2px solid #dee2e6 !important;
        border-radius: 6px !important;
        margin: 8px !important;
        padding: 15px 10px !important;
        min-height: 90px !important;
        cursor: move !important;
        transition: all 0.2s ease !important;
    }
    .gjs-block:hover {
        border-color: #bd2828 !important;
        background-color: #f8f9fa !important;
        transform: scale(1.05) !important;
        box-shadow: 0 4px 8px rgba(59, 130, 246, 0.2) !important;
    }
    .gjs-block__media {
        margin-bottom: 8px !important;
        font-size: 32px !important;
    }
    .gjs-block-label {
        font-size: 12px !important;
        font-weight: 600 !important;
        color: #495057 !important;
        text-align: center !important;
    }

    /* Rich Text Editor Toolbar */
    .gjs-rte-toolbar {
        background-color: #ffffff !important;
        border: 2px solid #bd2828 !important;
        border-radius: 6px !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
        padding: 5px !important;
    }
    .gjs-rte-action {
        color: #495057 !important;
        border: 1px solid #dee2e6 !important;
        margin: 2px !important;
        background-color: #f8f9fa !important;
        border-radius: 4px !important;
        padding: 6px 10px !important;
        cursor: pointer !important;
        transition: all 0.2s ease !important;
    }
    .gjs-rte-action:hover {
        background-color: #e9ecef !important;
        color: #212529 !important;
        border-color: #bd2828 !important;
    }
    .gjs-rte-active {
        background-color: #bd2828 !important;
        color: #ffffff !important;
        border-color: #bd2828 !important;
    }

    /* Style Manager */
    .gjs-sm-sector {
        border-bottom: 1px solid #dee2e6 !important;
    }
    .gjs-sm-sector-title {
        background-color: #f8f9fa !important;
        color: #212529 !important;
        font-weight: 600 !important;
        padding: 12px 10px !important;
        border-bottom: 1px solid #dee2e6 !important;
        cursor: pointer !important;
    }
    .gjs-sm-sector-title:hover {
        background-color: #e9ecef !important;
    }
    .gjs-sm-property {
        background-color: #ffffff !important;
        border-bottom: 1px solid #f8f9fa !important;
        padding: 8px 10px !important;
    }
    .gjs-sm-label {
        font-weight: 500 !important;
        color: #495057 !important;
    }

    /* Layer Manager */
    .gjs-layer {
        background-color: #ffffff !important;
        border-bottom: 1px solid #f8f9fa !important;
    }
    .gjs-layer:hover {
        background-color: #f8f9fa !important;
    }
    .gjs-layer.gjs-selected {
        background-color: #e7f1ff !important;
        border-left: 3px solid #bd2828 !important;
    }

    /* Toolbar on elements */
    .gjs-toolbar {
        background-color: #bd2828 !important;
        border-radius: 6px !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2) !important;
    }
    .gjs-toolbar-item {
        color: #ffffff !important;
        border-radius: 4px !important;
        padding: 6px 8px !important;
    }
    .gjs-toolbar-item:hover {
        background-color: rgba(255,255,255,0.2) !important;
    }

    /* Canvas */
    .gjs-cv-canvas {
        background-color: #ffffff !important;
        background-image:
            linear-gradient(45deg, #f8f9fa 25%, transparent 25%),
            linear-gradient(-45deg, #f8f9fa 25%, transparent 25%),
            linear-gradient(45deg, transparent 75%, #f8f9fa 75%),
            linear-gradient(-45deg, transparent 75%, #f8f9fa 75%);
        background-size: 20px 20px;
        background-position: 0 0, 0 10px, 10px -10px, -10px 0px;
    }

    /* Panel containers */
    .gjs-pn-panel {
        background-color: #ffffff !important;
    }

    /* Input fields */
    input.gjs-sm-input,
    select.gjs-sm-input {
        background-color: #ffffff !important;
        border: 1px solid #dee2e6 !important;
        border-radius: 4px !important;
        padding: 6px 8px !important;
        color: #212529 !important;
    }
    input.gjs-sm-input:focus,
    select.gjs-sm-input:focus {
        border-color: #bd2828 !important;
        outline: none !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
    }

    /* Color picker */
    .gjs-field-color-picker {
        border: 2px solid #dee2e6 !important;
        border-radius: 4px !important;
    }

    /* Device buttons */
    .gjs-pn-devices-c {
        display: flex;
        gap: 5px;
    }
</style>
@endpush

@push('scripts')
<!-- GrapesJS Scripts -->
<script src="https://unpkg.com/grapesjs"></script>
<script src="https://unpkg.com/grapesjs-preset-webpage"></script>
<script src="https://unpkg.com/grapesjs-blocks-basic"></script>
<script src="https://unpkg.com/grapesjs-plugin-forms"></script>
<script src="https://unpkg.com/grapesjs-navbar"></script>
<script src="https://unpkg.com/grapesjs-tabs"></script>
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
            fromElement: false,

            // Plugins
            plugins: ['gjs-preset-webpage', 'gjs-blocks-basic', 'gjs-plugin-forms', 'gjs-navbar', 'gjs-tabs'],
            pluginsOpts: {
                'gjs-preset-webpage': {
                    blocks: ['column1', 'column2', 'column3', 'column3-7', 'text', 'link', 'image', 'video', 'map'],
                    modalImportTitle: 'Import Template',
                    modalImportLabel: '<div style="margin-bottom: 10px; font-size: 13px;">Paste your HTML/CSS here</div>',
                    modalImportContent: function(editor) {
                        return editor.getHtml() + '<style>' + editor.getCss() + '</style>';
                    },
                },
                'gjs-blocks-basic': {},
                'gjs-plugin-forms': {
                    blocks: ['form', 'input', 'textarea', 'select', 'button', 'label', 'checkbox', 'radio']
                },
                'gjs-navbar': {},
                'gjs-tabs': {}
            },

            // Canvas configuration
            canvas: {
                styles: [
                    '{{ asset("assets/css/bootstrap.min.css") }}',
                    '{{ asset("assets/css/fontawesome.min.css") }}',
                    '{{ asset("assets/css/style.css") }}'
                ],
                scripts: [
                    '{{ asset("assets/js/bootstrap.bundle.min.js") }}'
                ]
            },

            // Layer Manager
            layerManager: {
                appendTo: '.layers-container',
                sortable: true,
                hidable: true,
            },

            // Panels configuration
            panels: {
                defaults: [
                    {
                        id: 'layers',
                        el: '.panel__right',
                        resizable: {
                            maxDim: 350,
                            minDim: 200,
                            tc: 0,
                            cl: 1,
                            cr: 0,
                            bc: 0,
                            keyWidth: 'flex-basis',
                        },
                    },
                    {
                        id: 'panel-switcher',
                        el: '.panel__switcher',
                        buttons: [{
                            id: 'show-layers',
                            active: true,
                            label: '<i class="fa fa-bars"></i>',
                            command: 'show-layers',
                            togglable: false,
                            attributes: { title: 'Show Layers' }
                        }, {
                            id: 'show-style',
                            active: true,
                            label: '<i class="fa fa-paint-brush"></i>',
                            command: 'show-styles',
                            togglable: false,
                            attributes: { title: 'Show Styles' }
                        }, {
                            id: 'show-traits',
                            active: true,
                            label: '<i class="fa fa-cog"></i>',
                            command: 'show-traits',
                            togglable: false,
                            attributes: { title: 'Show Settings' }
                        }],
                    },
                    {
                        id: 'panel-devices',
                        el: '.panel__devices',
                        buttons: [{
                            id: 'device-desktop',
                            label: '<i class="fa fa-desktop"></i>',
                            command: 'set-device-desktop',
                            active: true,
                            togglable: false,
                            attributes: { title: 'Desktop' }
                        }, {
                            id: 'device-tablet',
                            label: '<i class="fa fa-tablet"></i>',
                            command: 'set-device-tablet',
                            togglable: false,
                            attributes: { title: 'Tablet' }
                        }, {
                            id: 'device-mobile',
                            label: '<i class="fa fa-mobile"></i>',
                            command: 'set-device-mobile',
                            togglable: false,
                            attributes: { title: 'Mobile' }
                        }],
                    },
                ]
            },

            // Trait Manager
            traitManager: {
                appendTo: '.traits-container',
            },

            // Selector Manager
            selectorManager: {
                appendTo: '.styles-container',
            },

            // Style Manager
            styleManager: {
                appendTo: '.styles-container',
                sectors: [{
                    name: 'General',
                    open: true,
                    buildProps: ['display', 'position', 'top', 'right', 'left', 'bottom', 'float', 'clear']
                }, {
                    name: 'Dimension',
                    open: false,
                    buildProps: ['width', 'height', 'max-width', 'max-height', 'min-width', 'min-height', 'margin', 'padding']
                }, {
                    name: 'Typography',
                    open: false,
                    buildProps: ['font-family', 'font-size', 'font-weight', 'letter-spacing', 'color', 'line-height', 'text-align', 'text-decoration', 'text-shadow', 'text-transform']
                }, {
                    name: 'Decorations',
                    open: false,
                    buildProps: ['background-color', 'background', 'border-radius', 'border', 'box-shadow', 'opacity']
                }, {
                    name: 'Extra',
                    open: false,
                    buildProps: ['transition', 'perspective', 'transform', 'cursor', 'overflow', 'z-index']
                }]
            },

            // Device Manager
            deviceManager: {
                devices: [{
                    name: 'Desktop',
                    width: '',
                }, {
                    name: 'Tablet',
                    width: '768px',
                    widthMedia: '992px',
                }, {
                    name: 'Mobile',
                    width: '320px',
                    widthMedia: '480px',
                }]
            },

            // Block Manager
            blockManager: {
                appendTo: '.blocks-container',
            },

            // Rich Text Editor
            richTextEditor: {
                actions: ['bold', 'italic', 'underline', 'strikethrough', '|', 'link', '|', 'h1', 'h2', 'h3', 'p', '|', 'ul', 'ol', '|', 'align-left', 'align-center', 'align-right', 'align-justify'],
            },

            // Asset Manager
            assetManager: {
                assets: [],
                upload: false,
                uploadText: 'Drop files here or click to upload',
                addBtnText: 'Add Image',
                customFetch: () => { return [] },
            },
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
                            <p>Start building your page by dragging blocks from the left panel or choose a template!</p>
                            <button class="btn btn-primary" onclick="showTemplateLibrary()">Choose Template</button>
                        </div>
                    </div>
                </div>
            `);
        @endif

        // Add custom commands
        const commands = editor.Commands;

        // Layer panel commands
        commands.add('show-layers', {
            getRowEl(editor) { return editor.getContainer().closest('.editor-row'); },
            getLayersEl(row) { return row.querySelector('.layers-container') },

            run(editor, sender) {
                const lmEl = this.getLayersEl(this.getRowEl(editor));
                lmEl.style.display = '';
            },
            stop(editor, sender) {
                const lmEl = this.getLayersEl(this.getRowEl(editor));
                lmEl.style.display = 'none';
            },
        });

        // Styles panel commands
        commands.add('show-styles', {
            getRowEl(editor) { return editor.getContainer().closest('.editor-row'); },
            getStyleEl(row) { return row.querySelector('.styles-container') },

            run(editor, sender) {
                const smEl = this.getStyleEl(this.getRowEl(editor));
                smEl.style.display = '';
            },
            stop(editor, sender) {
                const smEl = this.getStyleEl(this.getRowEl(editor));
                smEl.style.display = 'none';
            },
        });

        // Traits panel commands
        commands.add('show-traits', {
            getRowEl(editor) { return editor.getContainer().closest('.editor-row'); },
            getTraitsEl(row) { return row.querySelector('.traits-container') },

            run(editor, sender) {
                const tmEl = this.getTraitsEl(this.getRowEl(editor));
                tmEl.style.display = '';
            },
            stop(editor, sender) {
                const tmEl = this.getTraitsEl(this.getRowEl(editor));
                tmEl.style.display = 'none';
            },
        });

        // Device commands
        commands.add('set-device-desktop', {
            run: editor => editor.setDevice('Desktop')
        });
        commands.add('set-device-tablet', {
            run: editor => editor.setDevice('Tablet')
        });
        commands.add('set-device-mobile', {
            run: editor => editor.setDevice('Mobile')
        });

        // Add custom blocks
        addCustomBlocks(editor);

        // Add page templates button
        addTemplateButton(editor);

        editorInitialized = true;
    }

    function addTemplateButton(editor) {
        editor.Panels.addButton('options', {
            id: 'template-library',
            className: 'fa fa-file-alt',
            command: 'open-templates',
            attributes: { title: 'Page Templates' }
        });

        editor.Commands.add('open-templates', {
            run: function(editor) {
                showTemplateLibrary();
            }
        });
    }

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
                                <img src="{{ asset('assets/img/hero/hero_bg_1_1.jpg') }}" alt="Hero" style="max-width: 100%; border-radius: 10px;">
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
                <section style="background-image: url('{{ asset('assets/img/hero/hero_bg_1_1.jpg') }}'); background-size: cover; background-position: center; padding: 150px 0; position: relative;">
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

    function showTemplateLibrary() {
        // Create modal HTML
        const modalHTML = `
            <div class="modal fade" id="templateLibraryModal" tabindex="-1">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fas fa-file-alt me-2"></i>Choose Page Template</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p class="text-muted mb-4">Select a pre-designed template to get started quickly. You can customize everything after!</p>
                            <div class="row g-4">
                                <!-- Landing Page -->
                                <div class="col-md-4">
                                    <div class="template-card" onclick="loadTemplate('landing')" style="cursor: pointer; border: 2px solid #ddd; border-radius: 10px; overflow: hidden; transition: transform 0.3s;">
                                        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 200px; display: flex; align-items: center; justify-content: center; color: white;">
                                            <div class="text-center">
                                                <i class="fas fa-rocket fa-3x mb-3"></i>
                                                <h4>Landing Page</h4>
                                            </div>
                                        </div>
                                        <div class="p-3">
                                            <h5>Landing Page</h5>
                                            <p class="text-muted small">Hero + Features + CTA + Footer</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- About Page -->
                                <div class="col-md-4">
                                    <div class="template-card" onclick="loadTemplate('about')" style="cursor: pointer; border: 2px solid #ddd; border-radius: 10px; overflow: hidden;">
                                        <div style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); height: 200px; display: flex; align-items: center; justify-content: center; color: white;">
                                            <div class="text-center">
                                                <i class="fas fa-users fa-3x mb-3"></i>
                                                <h4>About Us</h4>
                                            </div>
                                        </div>
                                        <div class="p-3">
                                            <h5>About Us Page</h5>
                                            <p class="text-muted small">Hero + Stats + Team + CTA</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Services Page -->
                                <div class="col-md-4">
                                    <div class="template-card" onclick="loadTemplate('services')" style="cursor: pointer; border: 2px solid #ddd; border-radius: 10px; overflow: hidden;">
                                        <div style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); height: 200px; display: flex; align-items: center; justify-content: center; color: white;">
                                            <div class="text-center">
                                                <i class="fas fa-cogs fa-3x mb-3"></i>
                                                <h4>Services</h4>
                                            </div>
                                        </div>
                                        <div class="p-3">
                                            <h5>Services Page</h5>
                                            <p class="text-muted small">Hero + Features Grid + Testimonials</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pricing Page -->
                                <div class="col-md-4">
                                    <div class="template-card" onclick="loadTemplate('pricing')" style="cursor: pointer; border: 2px solid #ddd; border-radius: 10px; overflow: hidden;">
                                        <div style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); height: 200px; display: flex; align-items: center; justify-content: center; color: white;">
                                            <div class="text-center">
                                                <i class="fas fa-dollar-sign fa-3x mb-3"></i>
                                                <h4>Pricing</h4>
                                            </div>
                                        </div>
                                        <div class="p-3">
                                            <h5>Pricing Page</h5>
                                            <p class="text-muted small">Hero + Pricing Table + FAQ</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact Page -->
                                <div class="col-md-4">
                                    <div class="template-card" onclick="loadTemplate('contact')" style="cursor: pointer; border: 2px solid #ddd; border-radius: 10px; overflow: hidden;">
                                        <div style="background: linear-gradient(135deg, #30cfd0 0%, #330867 100%); height: 200px; display: flex; align-items: center; justify-content: center; color: white;">
                                            <div class="text-center">
                                                <i class="fas fa-envelope fa-3x mb-3"></i>
                                                <h4>Contact</h4>
                                            </div>
                                        </div>
                                        <div class="p-3">
                                            <h5>Contact Page</h5>
                                            <p class="text-muted small">Hero + Contact Form + Map</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Blank Page -->
                                <div class="col-md-4">
                                    <div class="template-card" onclick="loadTemplate('blank')" style="cursor: pointer; border: 2px solid #ddd; border-radius: 10px; overflow: hidden;">
                                        <div style="background: #f8f9fa; height: 200px; display: flex; align-items: center; justify-content: center; color: #666;">
                                            <div class="text-center">
                                                <i class="fas fa-file fa-3x mb-3"></i>
                                                <h4>Start Fresh</h4>
                                            </div>
                                        </div>
                                        <div class="p-3">
                                            <h5>Blank Page</h5>
                                            <p class="text-muted small">Empty canvas - build from scratch</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        // Remove existing modal if any
        const existing = document.getElementById('templateLibraryModal');
        if (existing) existing.remove();

        // Add modal to body
        document.body.insertAdjacentHTML('beforeend', modalHTML);

        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('templateLibraryModal'));
        modal.show();

        // Add hover effect
        document.querySelectorAll('.template-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.boxShadow = '0 10px 20px rgba(0,0,0,0.1)';
            });
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = 'none';
            });
        });
    }

    function loadTemplate(templateType) {
        if (!editorInitialized) {
            alert('Please wait for the editor to initialize.');
            return;
        }

        // Close modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('templateLibraryModal'));
        if (modal) modal.hide();

        // Define templates
        const templates = {
            landing: `
                <!-- Hero Section -->
                <section style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 100px 0; color: white;">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <h1 style="font-size: 48px; font-weight: bold; margin-bottom: 20px;">Build Amazing Websites</h1>
                                <p style="font-size: 18px; margin-bottom: 30px;">Create stunning pages with our drag-and-drop builder. No coding required!</p>
                                <a href="#" class="btn btn-light btn-lg" style="padding: 12px 30px; margin-right: 10px;">Get Started</a>
                                <a href="#" class="btn btn-outline-light btn-lg" style="padding: 12px 30px;">Learn More</a>
                            </div>
                            <div class="col-lg-6 text-center">
                                <img src="{{ asset('assets/img/hero/hero_bg_1_1.jpg') }}" alt="Hero" style="max-width: 100%; border-radius: 10px;">
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Features -->
                <section style="padding: 80px 0;">
                    <div class="container">
                        <div class="text-center mb-5">
                            <h2 style="font-size: 36px; font-weight: bold;">Our Features</h2>
                            <p style="font-size: 18px; color: #666;">Everything you need to succeed</p>
                        </div>
                        <div class="row gy-4">
                            <div class="col-md-4 text-center">
                                <i class="fas fa-rocket fa-3x mb-3" style="color: #667eea;"></i>
                                <h3>Fast</h3>
                                <p style="color: #666;">Lightning-fast performance</p>
                            </div>
                            <div class="col-md-4 text-center">
                                <i class="fas fa-shield-alt fa-3x mb-3" style="color: #667eea;"></i>
                                <h3>Secure</h3>
                                <p style="color: #666;">Enterprise-grade security</p>
                            </div>
                            <div class="col-md-4 text-center">
                                <i class="fas fa-mobile-alt fa-3x mb-3" style="color: #667eea;"></i>
                                <h3>Responsive</h3>
                                <p style="color: #666;">Perfect on all devices</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- CTA -->
                <section style="padding: 60px 0; background: #f8f9fa;">
                    <div class="container text-center">
                        <h2 style="font-size: 36px; margin-bottom: 20px;">Ready to Get Started?</h2>
                        <p style="font-size: 18px; color: #666; margin-bottom: 30px;">Join thousands of satisfied customers</p>
                        <a href="#" class="btn btn-primary btn-lg">Start Free Trial</a>
                    </div>
                </section>
            `,
            about: `
                <!-- Hero -->
                <section style="padding: 100px 0; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; text-center;">
                    <div class="container">
                        <h1 style="font-size: 48px; font-weight: bold; margin-bottom: 20px;">About Us</h1>
                        <p style="font-size: 20px; margin: 0;">Learn about our story and mission</p>
                    </div>
                </section>

                <!-- Stats -->
                <section style="padding: 60px 0; background: white;">
                    <div class="container">
                        <div class="row text-center">
                            <div class="col-md-3">
                                <h2 style="font-size: 48px; font-weight: bold; color: #667eea;">1000+</h2>
                                <p>Clients</p>
                            </div>
                            <div class="col-md-3">
                                <h2 style="font-size: 48px; font-weight: bold; color: #667eea;">500+</h2>
                                <p>Projects</p>
                            </div>
                            <div class="col-md-3">
                                <h2 style="font-size: 48px; font-weight: bold; color: #667eea;">50+</h2>
                                <p>Awards</p>
                            </div>
                            <div class="col-md-3">
                                <h2 style="font-size: 48px; font-weight: bold; color: #667eea;">15+</h2>
                                <p>Years</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Team -->
                <section style="padding: 80px 0; background: #f8f9fa;">
                    <div class="container">
                        <div class="text-center mb-5">
                            <h2 style="font-size: 36px; font-weight: bold;">Meet Our Team</h2>
                        </div>
                        <div class="row gy-4">
                            <div class="col-md-4 text-center">
                                <div style="width: 150px; height: 150px; border-radius: 50%; background: #ddd; margin: 0 auto 20px;"></div>
                                <h4>Team Member</h4>
                                <p>Position</p>
                            </div>
                            <div class="col-md-4 text-center">
                                <div style="width: 150px; height: 150px; border-radius: 50%; background: #ddd; margin: 0 auto 20px;"></div>
                                <h4>Team Member</h4>
                                <p>Position</p>
                            </div>
                            <div class="col-md-4 text-center">
                                <div style="width: 150px; height: 150px; border-radius: 50%; background: #ddd; margin: 0 auto 20px;"></div>
                                <h4>Team Member</h4>
                                <p>Position</p>
                            </div>
                        </div>
                    </div>
                </section>
            `,
            services: `
                <!-- Hero -->
                <section style="padding: 100px 0; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; text-center;">
                    <div class="container">
                        <h1 style="font-size: 48px; font-weight: bold;">Our Services</h1>
                        <p style="font-size: 20px; margin-top: 20px;">Comprehensive solutions for your needs</p>
                    </div>
                </section>

                <!-- Services Grid -->
                <section style="padding: 80px 0;">
                    <div class="container">
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div style="padding: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); border-radius: 10px;">
                                    <i class="fas fa-code fa-3x mb-3" style="color: #4facfe;"></i>
                                    <h3>Web Development</h3>
                                    <p style="color: #666;">Custom websites and applications</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="padding: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); border-radius: 10px;">
                                    <i class="fas fa-mobile-alt fa-3x mb-3" style="color: #4facfe;"></i>
                                    <h3>Mobile Apps</h3>
                                    <p style="color: #666;">iOS and Android applications</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="padding: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); border-radius: 10px;">
                                    <i class="fas fa-chart-line fa-3x mb-3" style="color: #4facfe;"></i>
                                    <h3>Digital Marketing</h3>
                                    <p style="color: #666;">SEO, SEM, and social media</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="padding: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); border-radius: 10px;">
                                    <i class="fas fa-paint-brush fa-3x mb-3" style="color: #4facfe;"></i>
                                    <h3>UI/UX Design</h3>
                                    <p style="color: #666;">Beautiful, user-friendly designs</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            `,
            pricing: `
                <!-- Hero -->
                <section style="padding: 100px 0; background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); text-center; color: white;">
                    <div class="container">
                        <h1 style="font-size: 48px; font-weight: bold;">Choose Your Plan</h1>
                        <p style="font-size: 20px; margin-top: 20px;">Simple, transparent pricing</p>
                    </div>
                </section>

                <!-- Pricing Table -->
                <section style="padding: 80px 0;">
                    <div class="container">
                        <div class="row gy-4">
                            <div class="col-lg-4">
                                <div style="background: white; padding: 40px; border-radius: 10px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                                    <h3>Starter</h3>
                                    <div style="font-size: 48px; font-weight: bold; margin: 20px 0;">$9<span style="font-size: 18px;">/mo</span></div>
                                    <ul style="list-style: none; padding: 0; margin: 30px 0;">
                                        <li style="margin: 15px 0;">✓ 10 Projects</li>
                                        <li style="margin: 15px 0;">✓ 1 GB Storage</li>
                                        <li style="margin: 15px 0;">✓ Email Support</li>
                                    </ul>
                                    <a href="#" class="btn btn-outline-primary">Get Started</a>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div style="background: white; padding: 40px; border-radius: 10px; text-align: center; border: 2px solid #bd2828; box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);">
                                    <h3>Professional</h3>
                                    <div style="font-size: 48px; font-weight: bold; margin: 20px 0;">$29<span style="font-size: 18px;">/mo</span></div>
                                    <ul style="list-style: none; padding: 0; margin: 30px 0;">
                                        <li style="margin: 15px 0;">✓ 100 Projects</li>
                                        <li style="margin: 15px 0;">✓ 10 GB Storage</li>
                                        <li style="margin: 15px 0;">✓ Priority Support</li>
                                    </ul>
                                    <a href="#" class="btn btn-primary">Get Started</a>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div style="background: white; padding: 40px; border-radius: 10px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                                    <h3>Enterprise</h3>
                                    <div style="font-size: 48px; font-weight: bold; margin: 20px 0;">$99<span style="font-size: 18px;">/mo</span></div>
                                    <ul style="list-style: none; padding: 0; margin: 30px 0;">
                                        <li style="margin: 15px 0;">✓ Unlimited</li>
                                        <li style="margin: 15px 0;">✓ 100 GB Storage</li>
                                        <li style="margin: 15px 0;">✓ 24/7 Support</li>
                                    </ul>
                                    <a href="#" class="btn btn-outline-primary">Contact Sales</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            `,
            contact: `
                <!-- Hero -->
                <section style="padding: 100px 0; background: linear-gradient(135deg, #30cfd0 0%, #330867 100%); color: white; text-center;">
                    <div class="container">
                        <h1 style="font-size: 48px; font-weight: bold;">Get In Touch</h1>
                        <p style="font-size: 20px; margin-top: 20px;">We'd love to hear from you</p>
                    </div>
                </section>

                <!-- Contact Form -->
                <section style="padding: 80px 0;">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 mb-4">
                                <h2 style="margin-bottom: 30px;">Send Us a Message</h2>
                                <form>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Your Name" style="padding: 12px;">
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" class="form-control" placeholder="Your Email" style="padding: 12px;">
                                    </div>
                                    <div class="mb-3">
                                        <textarea class="form-control" rows="5" placeholder="Your Message" style="padding: 12px;"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
                                </form>
                            </div>
                            <div class="col-lg-6">
                                <h2 style="margin-bottom: 30px;">Contact Information</h2>
                                <div style="margin-bottom: 20px;">
                                    <i class="fas fa-map-marker-alt" style="margin-right: 15px; color: #667eea;"></i>
                                    <span>123 Main Street, City, Country</span>
                                </div>
                                <div style="margin-bottom: 20px;">
                                    <i class="fas fa-phone" style="margin-right: 15px; color: #667eea;"></i>
                                    <span>+1 (555) 123-4567</span>
                                </div>
                                <div style="margin-bottom: 20px;">
                                    <i class="fas fa-envelope" style="margin-right: 15px; color: #667eea;"></i>
                                    <span>info@example.com</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            `,
            blank: '<div class="container" style="padding: 40px 20px;"><div class="row"><div class="col-12"><h1>Start building your page!</h1><p>Drag blocks from the left panel to begin.</p></div></div></div>'
        };

        // Load selected template
        if (templates[templateType]) {
            editor.setComponents(templates[templateType]);
            alert('Template loaded! Start customizing your page.');
        }
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
