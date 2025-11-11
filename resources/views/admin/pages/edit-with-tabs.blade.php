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
        // Implementation same as before...
        alert('Section form for: ' + type + '\n\nThis will show a modal with section-specific fields.');
    }

    function editSection(sectionId) {
        alert('Edit section: ' + sectionId);
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
            }
        });
    }
</script>
@endpush
@endsection
