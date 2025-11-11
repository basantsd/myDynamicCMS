@extends('admin.layouts.app')

@section('title', 'Edit Page')
@section('page-title', 'Edit Page')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Edit Page</h1>
            <p>Update page content and sections</p>
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

<form action="{{ route('admin.pages.update', $page->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-lg-8">
            <!-- Page Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5><i class="fas fa-edit me-2"></i> Page Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Page Title <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('title') is-invalid @enderror"
                            id="title"
                            name="title"
                            value="{{ old('title', $page->title) }}"
                            required
                        >
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">URL Slug <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">{{ url('/') }}/</span>
                            <input
                                type="text"
                                class="form-control @error('slug') is-invalid @enderror"
                                id="slug"
                                name="slug"
                                value="{{ old('slug', $page->slug) }}"
                                required
                            >
                        </div>
                        @error('slug')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea
                            class="form-control"
                            id="meta_description"
                            name="meta_description"
                            rows="3"
                        >{{ old('meta_description', $page->meta_description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="meta_keywords" class="form-label">Meta Keywords</label>
                        <input
                            type="text"
                            class="form-control"
                            id="meta_keywords"
                            name="meta_keywords"
                            value="{{ old('meta_keywords', $page->meta_keywords) }}"
                        >
                    </div>
                </div>
            </div>

            <!-- Page Sections -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5><i class="fas fa-layer-group me-2"></i> Page Sections</h5>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addSectionModal">
                        <i class="fas fa-plus me-1"></i> Add Section
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
                                                @php
                                                $content = $section->content;
                                                @endphp
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
                        <input
                            type="number"
                            class="form-control"
                            id="menu_order"
                            name="menu_order"
                            value="{{ old('menu_order', $page->menu_order) }}"
                            min="0"
                        >
                    </div>

                    <hr>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="is_published"
                                name="is_published"
                                value="1"
                                {{ $page->is_published ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="is_published">
                                <strong>Published</strong>
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="show_in_menu"
                                name="show_in_menu"
                                value="1"
                                {{ $page->show_in_menu ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="show_in_menu">
                                <strong>Show in Menu</strong>
                            </label>
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
                    <i class="fas fa-save me-2"></i> Update Page
                </button>
                <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times me-2"></i> Cancel
                </a>
            </div>
        </div>
    </div>
</form>

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
<style>
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
</style>
@endpush

@push('scripts')
<script>
    function selectSectionType(type) {
        alert('Section type selected: ' + type + '\n\nSection builder functionality will be implemented with dynamic forms for each section type.');
        // TODO: Implement section builder with dynamic forms
    }

    function editSection(sectionId) {
        alert('Edit section: ' + sectionId + '\n\nThis will open a modal with section-specific fields.');
        // TODO: Implement edit section modal
    }

    function deleteSection(sectionId) {
        if (confirm('Are you sure you want to delete this section?')) {
            // TODO: Implement delete section
            console.log('Delete section:', sectionId);
        }
    }
</script>
@endpush
@endsection
