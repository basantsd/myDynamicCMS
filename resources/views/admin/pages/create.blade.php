@extends('admin.layouts.app')

@section('title', 'Create Page')
@section('page-title', 'Create New Page')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Create New Page</h1>
            <p>Add a new page to your website</p>
        </div>
        <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to Pages
        </a>
    </div>
</div>

<form action="{{ route('admin.pages.store') }}" method="POST">
    @csrf

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-edit me-2"></i> Page Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <label for="title" class="form-label">Page Title <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('title') is-invalid @enderror"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="Enter page title"
                            required
                        >
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">This will be the main heading of your page</small>
                    </div>

                    <div class="mb-4">
                        <label for="slug" class="form-label">URL Slug <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">{{ url('/') }}/</span>
                            <input
                                type="text"
                                class="form-control @error('slug') is-invalid @enderror"
                                id="slug"
                                name="slug"
                                value="{{ old('slug') }}"
                                placeholder="page-url"
                                required
                            >
                        </div>
                        @error('slug')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Leave empty to auto-generate from title</small>
                    </div>

                    <div class="mb-4">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea
                            class="form-control @error('meta_description') is-invalid @enderror"
                            id="meta_description"
                            name="meta_description"
                            rows="3"
                            placeholder="Brief description for search engines (160 characters)"
                        >{{ old('meta_description') }}</textarea>
                        @error('meta_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Recommended: 150-160 characters</small>
                    </div>

                    <div class="mb-4">
                        <label for="meta_keywords" class="form-label">Meta Keywords</label>
                        <input
                            type="text"
                            class="form-control @error('meta_keywords') is-invalid @enderror"
                            id="meta_keywords"
                            name="meta_keywords"
                            value="{{ old('meta_keywords') }}"
                            placeholder="keyword1, keyword2, keyword3"
                        >
                        @error('meta_keywords')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Separate keywords with commas</small>
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
                        <select class="form-select @error('template') is-invalid @enderror" id="template" name="template">
                            <option value="default">Default Template</option>
                            <option value="full-width">Full Width</option>
                            <option value="sidebar">With Sidebar</option>
                            <option value="landing">Landing Page</option>
                        </select>
                        @error('template')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="parent_id" class="form-label">Parent Page</label>
                        <select class="form-select @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id">
                            <option value="">None (Top Level)</option>
                            @foreach($pages as $parentPage)
                            <option value="{{ $parentPage->id }}">{{ $parentPage->title }}</option>
                            @endforeach
                        </select>
                        @error('parent_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">For creating child pages</small>
                    </div>

                    <div class="mb-3">
                        <label for="menu_order" class="form-label">Menu Order</label>
                        <input
                            type="number"
                            class="form-control @error('menu_order') is-invalid @enderror"
                            id="menu_order"
                            name="menu_order"
                            value="{{ old('menu_order', 0) }}"
                            min="0"
                        >
                        @error('menu_order')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Lower numbers appear first</small>
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
                                {{ old('is_published', true) ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="is_published">
                                <strong>Publish Page</strong>
                                <br>
                                <small class="text-muted">Make this page visible to visitors</small>
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
                                {{ old('show_in_menu', true) ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="show_in_menu">
                                <strong>Show in Menu</strong>
                                <br>
                                <small class="text-muted">Display in navigation menus</small>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <div class="alert alert-info mb-0" style="font-size: 13px;">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Note:</strong> After creating the page, you can add dynamic sections like Hero Banner, Content, Gallery, etc. from the edit page.
                    </div>
                </div>
            </div>

            <div class="d-grid gap-2 mt-3">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save me-2"></i> Create Page
                </button>
                <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times me-2"></i> Cancel
                </a>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
    // Auto-generate slug from title
    document.getElementById('title').addEventListener('input', function() {
        const title = this.value;
        const slug = title
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
        document.getElementById('slug').value = slug;
    });
</script>
@endpush
@endsection
