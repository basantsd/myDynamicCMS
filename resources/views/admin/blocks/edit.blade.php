@extends('admin.layouts.app')

@section('title', 'Edit Custom Block')
@section('page-title', 'Edit Custom Block')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/monokai.min.css">
<style>
    .CodeMirror { height: 300px; border: 1px solid #ddd; border-radius: 4px; }
    .nav-tabs .nav-link.active { background-color: #667eea; color: white; }
    .form-section { margin-bottom: 2rem; }
</style>
@endpush

@section('content')
<div class="page-header mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Edit Block: {{ $block->name }}</h1>
            <p class="text-muted">Modify block template and settings</p>
        </div>
        <a href="{{ route('admin.blocks.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to Blocks
        </a>
    </div>
</div>

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show">
    <strong>Error!</strong> Please fix the following issues:
    <ul class="mb-0 mt-2">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<form action="{{ route('admin.blocks.update', $block->id) }}" method="POST" id="blockForm" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs mb-4" role="tablist">
                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#basic-info"><i class="fas fa-info-circle me-2"></i>Basic Info</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#template"><i class="fas fa-code me-2"></i>HTML Template</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#styles"><i class="fas fa-palette me-2"></i>CSS Styles</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#scripts"><i class="fas fa-file-code me-2"></i>JavaScript</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#schema"><i class="fas fa-database me-2"></i>Schema</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#traits"><i class="fas fa-sliders-h me-2"></i>Traits</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#defaults"><i class="fas fa-magic me-2"></i>Defaults</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#meta"><i class="fas fa-tags me-2"></i>Meta</a></li>
                    </ul>

                    <div class="tab-content">
                        <!-- Basic Info -->
                        <div class="tab-pane fade show active" id="basic-info">
                            <div class="form-section">
                                <h5 class="mb-3">Basic Information</h5>

                                <div class="mb-3">
                                    <label for="name" class="form-label">Block Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name" value="{{ old('name', $block->name) }}" required>
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="icon" class="form-label">Icon</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas {{ $block->icon }}" id="icon-preview"></i>
                                            </span>
                                            <input type="text" class="form-control" id="icon" name="icon"
                                                   value="{{ old('icon', $block->icon) }}" placeholder="fa-cube">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="color" class="form-label">Color</label>
                                        <input type="color" class="form-control form-control-color w-100"
                                               id="color" name="color" value="{{ old('color', $block->color) }}">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="form-select" id="category" name="category">
                                        @foreach(\App\Models\CustomBlock::getCategories() as $key => $name)
                                            <option value="{{ $key }}" {{ old('category', $block->category) == $key ? 'selected' : '' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $block->description) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- HTML Template -->
                        <div class="tab-pane fade" id="template">
                            <div class="form-section">
                                <h5 class="mb-3">HTML Template</h5>
                                <textarea class="form-control" id="html_template" name="html_template" rows="15">{{ old('html_template', $block->html_template) }}</textarea>
                                <div class="alert alert-info mt-3">
                                    <strong>Template Syntax:</strong> Use <code>{<!-- -->{variable}}</code>, <code>{<!-- -->{#if}}</code>, <code>{<!-- -->{#each}}</code>
                                </div>
                            </div>
                        </div>

                        <!-- CSS Styles -->
                        <div class="tab-pane fade" id="styles">
                            <div class="form-section">
                                <h5 class="mb-3">CSS Styles</h5>
                                <textarea class="form-control" id="css_styles" name="css_styles" rows="15">{{ old('css_styles', $block->css_styles) }}</textarea>
                            </div>
                        </div>

                        <!-- JavaScript -->
                        <div class="tab-pane fade" id="scripts">
                            <div class="form-section">
                                <h5 class="mb-3">JavaScript Code</h5>
                                <textarea class="form-control" id="js_scripts" name="js_scripts" rows="15">{{ old('js_scripts', $block->js_scripts) }}</textarea>
                            </div>
                        </div>

                        <!-- Schema -->
                        <div class="tab-pane fade" id="schema">
                            <div class="form-section">
                                <h5 class="mb-3">Block Schema (JSON)</h5>
                                <textarea class="form-control" id="schema" name="schema" rows="15">{{ old('schema', is_string($block->schema) ? $block->schema : json_encode($block->schema, JSON_PRETTY_PRINT)) }}</textarea>
                            </div>
                        </div>

                        <!-- Traits -->
                        <div class="tab-pane fade" id="traits">
                            <div class="form-section">
                                <h5 class="mb-3">GrapesJS Traits</h5>
                                <textarea class="form-control" id="traits_config" name="traits_config" rows="15">{{ old('traits_config', is_string($block->traits_config) ? $block->traits_config : json_encode($block->traits_config, JSON_PRETTY_PRINT)) }}</textarea>
                            </div>
                        </div>

                        <!-- Defaults -->
                        <div class="tab-pane fade" id="defaults">
                            <div class="form-section">
                                <h5 class="mb-3">Default Values</h5>
                                <textarea class="form-control" id="default_values" name="default_values" rows="10">{{ old('default_values', is_string($block->default_values) ? $block->default_values : json_encode($block->default_values, JSON_PRETTY_PRINT)) }}</textarea>
                            </div>
                        </div>

                        <!-- Meta -->
                        <div class="tab-pane fade" id="meta">
                            <div class="form-section">
                                <h5 class="mb-3">Additional Information</h5>

                                <div class="mb-3">
                                    <label for="tags" class="form-label">Tags</label>
                                    <input type="text" class="form-control" id="tags" name="tags"
                                           value="{{ old('tags', is_array($block->tags) ? implode(', ', $block->tags) : '') }}"
                                           placeholder="hero, banner, header (comma-separated)">
                                </div>

                                <div class="mb-3">
                                    <label for="dependencies" class="form-label">Dependencies (JSON)</label>
                                    <textarea class="form-control" id="dependencies" name="dependencies" rows="5">{{ old('dependencies', is_string($block->dependencies) ? $block->dependencies : json_encode($block->dependencies, JSON_PRETTY_PRINT)) }}</textarea>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="author" class="form-label">Author</label>
                                        <input type="text" class="form-control" id="author" name="author"
                                               value="{{ old('author', $block->author) }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="block_version" class="form-label">Version</label>
                                        <input type="text" class="form-control" id="block_version" name="block_version"
                                               value="{{ old('block_version', $block->block_version) }}">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="thumbnail" class="form-label">Thumbnail/Preview Image</label>
                                    @if($block->thumbnail)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $block->thumbnail) }}" alt="Current thumbnail" class="img-thumbnail" style="max-width: 200px;">
                                        <p class="small text-muted">Current thumbnail</p>
                                    </div>
                                    @endif
                                    <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*">
                                    <small class="text-muted">Upload new preview image (optional)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-3">
            <!-- Info Card -->
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="mb-0">Block Info</h6>
                </div>
                <div class="card-body">
                    <p class="small mb-2"><strong>Usage Count:</strong> {{ $block->usage_count }}</p>
                    <p class="small mb-2"><strong>Created:</strong> {{ $block->created_at->format('M d, Y') }}</p>
                    <p class="small mb-2"><strong>Updated:</strong> {{ $block->updated_at->format('M d, Y') }}</p>
                    <p class="small mb-0"><strong>Version:</strong> {{ $block->block_version ?? '1.0.0' }}</p>
                </div>
            </div>

            <!-- Actions Card -->
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="mb-0">Actions</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                   {{ old('is_active', $block->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-2">
                        <i class="fas fa-save me-2"></i> Update Block
                    </button>

                    <a href="{{ route('admin.blocks.index') }}" class="btn btn-secondary w-100">
                        <i class="fas fa-times me-2"></i> Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/htmlmixed/htmlmixed.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/css/css.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/javascript/javascript.min.js"></script>

<script>
document.getElementById('icon').addEventListener('input', function(e) {
    document.getElementById('icon-preview').className = 'fas ' + e.target.value;
});

function initCodeMirror(id, mode) {
    const textarea = document.getElementById(id);
    if (textarea) {
        CodeMirror.fromTextArea(textarea, {
            mode: mode,
            theme: 'monokai',
            lineNumbers: true,
            autoCloseTags: true,
            autoCloseBrackets: true,
            matchBrackets: true,
            indentUnit: 4,
            indentWithTabs: false,
            lineWrapping: true
        });
    }
}

document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
    tab.addEventListener('shown.bs.tab', function (e) {
        const target = e.target.getAttribute('href');
        if (target === '#template' && !document.querySelector('#template .CodeMirror')) {
            initCodeMirror('html_template', 'htmlmixed');
        }
        if (target === '#styles' && !document.querySelector('#styles .CodeMirror')) {
            initCodeMirror('css_styles', 'css');
        }
        if (target === '#scripts' && !document.querySelector('#scripts .CodeMirror')) {
            initCodeMirror('js_scripts', 'javascript');
        }
        if (target === '#schema' && !document.querySelector('#schema .CodeMirror')) {
            initCodeMirror('schema', {name: 'javascript', json: true});
        }
        if (target === '#traits' && !document.querySelector('#traits .CodeMirror')) {
            initCodeMirror('traits_config', {name: 'javascript', json: true});
        }
        if (target === '#defaults' && !document.querySelector('#defaults .CodeMirror')) {
            initCodeMirror('default_values', {name: 'javascript', json: true});
        }
    });
});

document.getElementById('blockForm').addEventListener('submit', function(e) {
    const tagsInput = document.getElementById('tags');
    if (tagsInput.value) {
        const tagsArray = tagsInput.value.split(',').map(t => t.trim()).filter(t => t);
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'tags';
        hiddenInput.value = JSON.stringify(tagsArray);
        this.appendChild(hiddenInput);
        tagsInput.removeAttribute('name');
    }
});
</script>
@endpush
