@extends('admin.layouts.app')

@section('title', 'Edit Page')
@section('page-title', 'Edit Page')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Edit Page: {{ $page->title }}</h1>
            <p class="text-muted">Manage page content and settings</p>
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
<ul class="nav nav-tabs mb-4" id="pageTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab">
            <i class="fas fa-cog me-2"></i> Page Settings
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="builder-tab" data-bs-toggle="tab" data-bs-target="#builder" type="button" role="tab">
            <i class="fas fa-paint-brush me-2"></i> Visual Page Builder
        </button>
    </li>
</ul>

<!-- Tab Content -->
<div class="tab-content" id="pageTabsContent">
    <!-- Page Settings Tab -->
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
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                       id="title" name="title" value="{{ old('title', $page->title) }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="slug" class="form-label">URL Slug <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">{{ url('/') }}/</span>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                           id="slug" name="slug" value="{{ old('slug', $page->slug) }}" required>
                                </div>
                                @error('slug')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="meta_description" class="form-label">Meta Description</label>
                                <textarea class="form-control" id="meta_description" name="meta_description"
                                          rows="3">{{ old('meta_description', $page->meta_description) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                                       value="{{ old('meta_keywords', $page->meta_keywords) }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5><i class="fas fa-cog me-2"></i> Page Options</h5>
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
                                <input type="number" class="form-control" id="menu_order" name="menu_order"
                                       value="{{ old('menu_order', $page->menu_order) }}" min="0">
                            </div>

                            <hr>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_published"
                                           name="is_published" value="1" {{ $page->is_published ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_published">
                                        <strong>Published</strong>
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="show_in_menu"
                                           name="show_in_menu" value="1" {{ $page->show_in_menu ? 'checked' : '' }}>
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

                    <div class="d-grid gap-2">
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
    </div>

    <!-- Visual Page Builder Tab -->
    <div class="tab-pane fade" id="builder" role="tabpanel">
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-paint-brush fa-3x text-primary mb-3"></i>
                <h4>Visual Page Builder</h4>
                <p class="text-muted mb-4">Use the full-screen visual builder to create stunning pages</p>
                <a href="{{ route('admin.pages.builder', $page->id) }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-external-link-alt me-2"></i> Open Visual Builder
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Auto-generate slug from title
document.getElementById('title').addEventListener('input', function(e) {
    const slug = e.target.value
        .toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/(^-|-$)/g, '');
    document.getElementById('slug').value = slug;
});
</script>
@endpush
@endsection
