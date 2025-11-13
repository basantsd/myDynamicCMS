@extends('admin.layouts.app')

@section('title', 'Edit Page')
@section('page-title', 'Edit Page')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Edit Page</h1>
            <p>Update page content and sections</p>
            @if($page->use_builder)
            <span class="badge bg-info">Using Visual Builder</span>
            @endif
        </div>
        <div class="btn-group">
            <a href="{{ route('admin.pages.builder', $page->id) }}" class="btn btn-primary">
                <i class="fas fa-paint-brush me-2"></i> Visual Builder
            </a>
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
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    // Initialize Sortable for drag-and-drop
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
                console.log('Section order updated successfully');
            }
        })
        .catch(error => console.error('Error updating section order:', error));
    }

    function selectSectionType(type) {
        const modal = bootstrap.Modal.getInstance(document.getElementById('addSectionModal'));
        modal.hide();

        // Show section form modal based on type
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
                <div class="mb-3">
                    <label class="form-label">Title</label>
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
                    <input type="text" class="form-control" name="content[button_text]">
                </div>
                <div class="mb-3">
                    <label class="form-label">Button Link</label>
                    <input type="text" class="form-control" name="content[button_link]">
                </div>
                <div class="mb-3">
                    <label class="form-label">Background Image</label>
                    <input type="file" class="form-control" name="background_image" accept="image/*">
                </div>
            `,
            'rich_content': `
                <div class="mb-3">
                    <label class="form-label">Content</label>
                    <textarea class="form-control" name="content[content]" rows="10" required></textarea>
                    <small class="text-muted">You can use HTML</small>
                </div>
            `,
            'breadcrumb': `
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="content[title]" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Background Image</label>
                    <input type="file" class="form-control" name="background_image" accept="image/*">
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="content[show_breadcrumb]" id="show_breadcrumb" value="1" checked>
                        <label class="form-check-label" for="show_breadcrumb">Show Breadcrumb Navigation</label>
                    </div>
                </div>
            `,
            'services_grid': `
                <div class="mb-3">
                    <label class="form-label">Section Title</label>
                    <input type="text" class="form-control" name="content[title]">
                </div>
                <div class="mb-3">
                    <label class="form-label">Services (JSON)</label>
                    <textarea class="form-control" name="content[services]" rows="8" placeholder='[{"title": "Service 1", "description": "Description", "icon": "fa-icon"}]'></textarea>
                    <small class="text-muted">Enter services in JSON format</small>
                </div>
            `,
            'statistics': `
                <div class="mb-3">
                    <label class="form-label">Statistics (JSON)</label>
                    <textarea class="form-control" name="content[stats]" rows="8" placeholder='[{"number": "100+", "label": "Projects", "suffix": ""}]' required></textarea>
                    <small class="text-muted">Enter statistics in JSON format</small>
                </div>
            `,
            'faq': `
                <div class="mb-3">
                    <label class="form-label">Section Title</label>
                    <input type="text" class="form-control" name="content[title]">
                </div>
                <div class="mb-3">
                    <label class="form-label">FAQs (JSON)</label>
                    <textarea class="form-control" name="content[faqs]" rows="8" placeholder='[{"question": "Question?", "answer": "Answer"}]' required></textarea>
                    <small class="text-muted">Enter FAQs in JSON format</small>
                </div>
            `,
            'contact_form': `
                <div class="mb-3">
                    <label class="form-label">Form Title</label>
                    <input type="text" class="form-control" name="content[title]">
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="content[description]" rows="3"></textarea>
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
                if (fieldName === 'services' || fieldName === 'faqs' || fieldName === 'stats') {
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

        const method = isEdit ? 'PUT' : 'POST';

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
        // For now, we'll implement a simple version
        console.log('Loading section data for:', sectionId);
    }

    function deleteSection(sectionId) {
        if (!confirm('Are you sure you want to delete this section?')) {
            return;
        }

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
                // Remove section from UI
                const sectionItem = document.querySelector(`[data-section-id="${sectionId}"]`);
                sectionItem.remove();

                // Reload page if no sections left
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
