@extends('admin.layouts.app')

@section('title', 'Create Banner')
@section('page-title', 'Create New Banner')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Create New Banner</h1>
            <p>Add a new banner to your website</p>
        </div>
        <a href="{{ route('admin.banners.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to Banners
        </a>
    </div>
</div>

<form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Banner Details</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Banner Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="banner_type" class="form-label">Banner Type <span class="text-danger">*</span></label>
                        <select class="form-select @error('banner_type') is-invalid @enderror" id="banner_type" name="banner_type" required>
                            <option value="hero" {{ old('banner_type') == 'hero' ? 'selected' : '' }}>Hero</option>
                            <option value="promotional" {{ old('banner_type') == 'promotional' ? 'selected' : '' }}>Promotional</option>
                            <option value="image" {{ old('banner_type') == 'image' ? 'selected' : '' }}>Image</option>
                            <option value="video" {{ old('banner_type') == 'video' ? 'selected' : '' }}>Video</option>
                            <option value="slider" {{ old('banner_type') == 'slider' ? 'selected' : '' }}>Slider</option>
                        </select>
                        @error('banner_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Banner Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Banner Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                        <small class="text-muted">Recommended size: 1920x600px</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="button_text" class="form-label">Button Text</label>
                        <input type="text" class="form-control @error('button_text') is-invalid @enderror" id="button_text" name="button_text" value="{{ old('button_text') }}">
                        @error('button_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="button_url" class="form-label">Button URL</label>
                        <input type="text" class="form-control @error('button_url') is-invalid @enderror" id="button_url" name="button_url" value="{{ old('button_url') }}" placeholder="/about">
                        @error('button_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="button_action" class="form-label">Button Action</label>
                            <select class="form-select @error('button_action') is-invalid @enderror" id="button_action" name="button_action">
                                <option value="link" {{ old('button_action') == 'link' ? 'selected' : '' }}>Link</option>
                                <option value="redirect" {{ old('button_action') == 'redirect' ? 'selected' : '' }}>Redirect</option>
                                <option value="scroll" {{ old('button_action') == 'scroll' ? 'selected' : '' }}>Scroll to Section</option>
                                <option value="modal" {{ old('button_action') == 'modal' ? 'selected' : '' }}>Open Modal</option>
                                <option value="download" {{ old('button_action') == 'download' ? 'selected' : '' }}>Download</option>
                            </select>
                            @error('button_action')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="button_target" class="form-label">Button Target</label>
                            <select class="form-select @error('button_target') is-invalid @enderror" id="button_target" name="button_target">
                                <option value="_self" {{ old('button_target') == '_self' ? 'selected' : '' }}>Same Window</option>
                                <option value="_blank" {{ old('button_target') == '_blank' ? 'selected' : '' }}>New Window</option>
                            </select>
                            @error('button_target')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="button_style" class="form-label">Button Style</label>
                        <select class="form-select @error('button_style') is-invalid @enderror" id="button_style" name="button_style">
                            <option value="primary" {{ old('button_style') == 'primary' ? 'selected' : '' }}>Primary (Blue)</option>
                            <option value="secondary" {{ old('button_style') == 'secondary' ? 'selected' : '' }}>Secondary (Gray)</option>
                            <option value="success" {{ old('button_style') == 'success' ? 'selected' : '' }}>Success (Green)</option>
                            <option value="danger" {{ old('button_style') == 'danger' ? 'selected' : '' }}>Danger (Red)</option>
                            <option value="warning" {{ old('button_style') == 'warning' ? 'selected' : '' }}>Warning (Yellow)</option>
                            <option value="info" {{ old('button_style') == 'info' ? 'selected' : '' }}>Info (Cyan)</option>
                            <option value="light" {{ old('button_style') == 'light' ? 'selected' : '' }}>Light</option>
                            <option value="dark" {{ old('button_style') == 'dark' ? 'selected' : '' }}>Dark</option>
                            <option value="outline-light" {{ old('button_style') == 'outline-light' ? 'selected' : '' }}>Outline Light</option>
                            <option value="outline-dark" {{ old('button_style') == 'outline-dark' ? 'selected' : '' }}>Outline Dark</option>
                        </select>
                        @error('button_style')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Slider Slides Section (Only for Slider Type) -->
            <div class="card mb-4" id="slider-slides-section" style="display: none;">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Slider Slides</h5>
                    <button type="button" class="btn btn-sm btn-success" onclick="addSlide()">
                        <i class="fas fa-plus me-1"></i> Add Slide
                    </button>
                </div>
                <div class="card-body">
                    <div id="slides-container">
                        <!-- Slides will be added here dynamically -->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Settings</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}">
                        @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">
                            Active
                        </label>
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="show_overlay" name="show_overlay" value="1" {{ old('show_overlay') ? 'checked' : '' }}>
                        <label class="form-check-label" for="show_overlay">
                            Show Overlay
                        </label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="autoplay" name="autoplay" value="1" {{ old('autoplay', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="autoplay">
                            Autoplay (for sliders)
                        </label>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save me-2"></i> Create Banner
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
    let slideIndex = 0;

    // Show/hide sections based on banner type
    document.getElementById('banner_type').addEventListener('change', function() {
        const sliderSection = document.getElementById('slider-slides-section');
        if (this.value === 'slider') {
            sliderSection.style.display = 'block';
            if (document.getElementById('slides-container').children.length === 0) {
                addSlide(); // Add first slide automatically
            }
        } else {
            sliderSection.style.display = 'none';
        }
    });

    function addSlide() {
        const container = document.getElementById('slides-container');
        const slideHtml = `
            <div class="slide-item card mb-3" data-slide-index="${slideIndex}">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Slide ${slideIndex + 1}</h6>
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeSlide(this)">
                        <i class="fas fa-trash"></i> Remove
                    </button>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Slide Image URL</label>
                        <input type="text" class="form-control" name="slides[${slideIndex}][image]" placeholder="/assets/img/slider/slide-1.jpg" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Slide Title</label>
                        <input type="text" class="form-control" name="slides[${slideIndex}][title]" placeholder="Enter slide title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Slide Description</label>
                        <textarea class="form-control" name="slides[${slideIndex}][description]" rows="2" placeholder="Enter slide description"></textarea>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', slideHtml);
        slideIndex++;
    }

    function removeSlide(button) {
        const slideItem = button.closest('.slide-item');
        slideItem.remove();

        // Renumber remaining slides
        const slides = document.querySelectorAll('.slide-item');
        slides.forEach((slide, index) => {
            slide.querySelector('h6').textContent = `Slide ${index + 1}`;
        });
    }
</script>
@endpush
@endsection
