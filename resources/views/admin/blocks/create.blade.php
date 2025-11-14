@extends('admin.layouts.app')

@section('title', 'Create Custom Block')
@section('page-title', 'Create Custom Block')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/monokai.min.css">
<style>
    .CodeMirror {
        height: 300px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    .nav-tabs .nav-link.active {
        background-color: #667eea;
        color: white;
    }
    .form-section {
        margin-bottom: 2rem;
    }
    .preview-box {
        border: 1px solid #ddd;
        padding: 20px;
        border-radius: 4px;
        background: #f8f9fa;
        min-height: 200px;
    }
</style>
@endpush

@section('content')
<div class="page-header mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Create Custom Block</h1>
            <p class="text-muted">Define a new reusable block template for GrapesJS</p>
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

<form action="{{ route('admin.blocks.store') }}" method="POST" id="blockForm" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <!-- Tabs Navigation -->
                    <ul class="nav nav-tabs mb-4" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#basic-info">
                                <i class="fas fa-info-circle me-2"></i>Basic Info
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#template">
                                <i class="fas fa-code me-2"></i>HTML Template
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#styles">
                                <i class="fas fa-palette me-2"></i>CSS Styles
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#scripts">
                                <i class="fas fa-file-code me-2"></i>JavaScript
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#schema">
                                <i class="fas fa-database me-2"></i>Schema
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#traits">
                                <i class="fas fa-sliders-h me-2"></i>Traits
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#defaults">
                                <i class="fas fa-magic me-2"></i>Defaults
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#meta">
                                <i class="fas fa-tags me-2"></i>Meta
                            </a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content">
                        <!-- Basic Info Tab -->
                        <div class="tab-pane fade show active" id="basic-info">
                            <div class="form-section">
                                <h5 class="mb-3">Basic Information</h5>

                                <div class="mb-3">
                                    <label for="name" class="form-label">Block Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name" value="{{ old('name') }}" required>
                                    <small class="text-muted">Display name for the block</small>
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="icon" class="form-label">Icon (FontAwesome) <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-cube" id="icon-preview"></i>
                                            </span>
                                            <input type="text" class="form-control @error('icon') is-invalid @enderror"
                                                   id="icon" name="icon" value="{{ old('icon', 'fa-cube') }}"
                                                   placeholder="fa-cube" required>
                                        </div>
                                        <small class="text-muted">e.g., fa-image, fa-table, fa-star</small>
                                        @error('icon')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="color" class="form-label">Color <span class="text-danger">*</span></label>
                                        <input type="color" class="form-control form-control-color w-100 @error('color') is-invalid @enderror"
                                               id="color" name="color" value="{{ old('color', '#667eea') }}" required>
                                        @error('color')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                                    <select class="form-select @error('category') is-invalid @enderror"
                                            id="category" name="category" required>
                                        <option value="">Select Category</option>
                                        @foreach(\App\Models\CustomBlock::getCategories() as $key => $name)
                                            <option value="{{ $key }}" {{ old('category') == $key ? 'selected' : '' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              id="description" name="description" rows="3">{{ old('description') }}</textarea>
                                    <small class="text-muted">Brief description of what this block does</small>
                                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <!-- HTML Template Tab -->
                        <div class="tab-pane fade" id="template">
                            <div class="form-section">
                                <h5 class="mb-3">HTML Template</h5>
                                <p class="text-muted">Define the HTML structure. Use <code>{<!-- -->{variable}}</code> for dynamic content.</p>

                                <div class="mb-3">
                                    <label for="html_template" class="form-label">HTML Template <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('html_template') is-invalid @enderror"
                                              id="html_template" name="html_template" rows="15" required>{{ old('html_template', '<div class="custom-block">
    <h2>{{title}}</h2>
    <p>{{description}}</p>
</div>') }}</textarea>
                                    @error('html_template')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="alert alert-info">
                                    <strong>Template Syntax:</strong>
                                    <ul class="mb-0 mt-2">
                                        <li>Variables: <code>{<!-- -->{title}}</code></li>
                                        <li>Conditionals: <code>{<!-- -->{#if show_section}}...{<!-- -->{/if}}</code></li>
                                        <li>Loops: <code>{<!-- -->{#each items}}...{<!-- -->{/each}}</code></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- CSS Styles Tab -->
                        <div class="tab-pane fade" id="styles">
                            <div class="form-section">
                                <h5 class="mb-3">CSS Styles</h5>
                                <p class="text-muted">Define custom styles for your block</p>

                                <div class="mb-3">
                                    <label for="css_styles" class="form-label">CSS Styles</label>
                                    <textarea class="form-control @error('css_styles') is-invalid @enderror"
                                              id="css_styles" name="css_styles" rows="15">{{ old('css_styles', '.custom-block {
    padding: 20px;
    background: #f8f9fa;
    border-radius: 8px;
}') }}</textarea>
                                    @error('css_styles')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <!-- JavaScript Tab -->
                        <div class="tab-pane fade" id="scripts">
                            <div class="form-section">
                                <h5 class="mb-3">JavaScript</h5>
                                <p class="text-muted">Add interactivity to your block</p>

                                <div class="mb-3">
                                    <label for="js_scripts" class="form-label">JavaScript Code</label>
                                    <textarea class="form-control @error('js_scripts') is-invalid @enderror"
                                              id="js_scripts" name="js_scripts" rows="15">{{ old('js_scripts', '// Your JavaScript code here
console.log("Block loaded");') }}</textarea>
                                    @error('js_scripts')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <!-- Schema Tab -->
                        <div class="tab-pane fade" id="schema">
                            <div class="form-section">
                                <h5 class="mb-3">Block Schema</h5>
                                <p class="text-muted">Define the structure and fields for your block</p>

                                <div class="mb-3">
                                    <label for="schema" class="form-label">Schema (JSON) <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('schema') is-invalid @enderror"
                                              id="schema" name="schema" rows="15" required>{{ old('schema', '{
    "fields": [
        {
            "name": "title",
            "type": "text",
            "label": "Title",
            "required": true
        },
        {
            "name": "description",
            "type": "textarea",
            "label": "Description"
        }
    ]
}') }}</textarea>
                                    @error('schema')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="alert alert-secondary">
                                    <strong>Available Field Types:</strong><br>
                                    <code>text</code>, <code>textarea</code>, <code>email</code>, <code>number</code>,
                                    <code>select</code>, <code>checkbox</code>, <code>toggle</code>, <code>image</code>,
                                    <code>color</code>, <code>repeater</code>, <code>table</code>
                                </div>
                            </div>
                        </div>

                        <!-- Traits Tab -->
                        <div class="tab-pane fade" id="traits">
                            <div class="form-section">
                                <h5 class="mb-3">GrapesJS Traits</h5>
                                <p class="text-muted">Define editable properties in the GrapesJS settings panel</p>

                                <div class="mb-3">
                                    <label for="traits_config" class="form-label">Traits Configuration (JSON)</label>
                                    <textarea class="form-control @error('traits_config') is-invalid @enderror"
                                              id="traits_config" name="traits_config" rows="15">{{ old('traits_config', '{
    "traits": [
        {
            "type": "text",
            "label": "Title",
            "name": "title",
            "changeProp": 1
        },
        {
            "type": "text",
            "label": "Description",
            "name": "description",
            "changeProp": 1
        }
    ]
}') }}</textarea>
                                    @error('traits_config')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="alert alert-info">
                                    <strong>Note:</strong> Traits appear in the GrapesJS settings panel when a block is selected.
                                    Set <code>"changeProp": 1</code> to make traits update the component properties.
                                </div>
                            </div>
                        </div>

                        <!-- Defaults Tab -->
                        <div class="tab-pane fade" id="defaults">
                            <div class="form-section">
                                <h5 class="mb-3">Default Values</h5>
                                <p class="text-muted">Set default values for template variables</p>

                                <div class="mb-3">
                                    <label for="default_values" class="form-label">Default Values (JSON)</label>
                                    <textarea class="form-control @error('default_values') is-invalid @enderror"
                                              id="default_values" name="default_values" rows="10">{{ old('default_values', '{
    "title": "Block Title",
    "description": "Block description text"
}') }}</textarea>
                                    @error('default_values')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <!-- Meta Tab -->
                        <div class="tab-pane fade" id="meta">
                            <div class="form-section">
                                <h5 class="mb-3">Additional Information</h5>

                                <div class="mb-3">
                                    <label for="tags" class="form-label">Tags</label>
                                    <input type="text" class="form-control @error('tags') is-invalid @enderror"
                                           id="tags" name="tags" value="{{ old('tags') }}"
                                           placeholder="hero, banner, header (comma-separated)">
                                    <small class="text-muted">Comma-separated tags for search and filtering</small>
                                    @error('tags')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="mb-3">
                                    <label for="dependencies" class="form-label">Dependencies (JSON)</label>
                                    <textarea class="form-control @error('dependencies') is-invalid @enderror"
                                              id="dependencies" name="dependencies" rows="5">{{ old('dependencies', '{
    "bootstrap": "5.x",
    "fontawesome": "6.x"
}') }}</textarea>
                                    <small class="text-muted">External libraries required by this block</small>
                                    @error('dependencies')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="author" class="form-label">Author</label>
                                        <input type="text" class="form-control @error('author') is-invalid @enderror"
                                               id="author" name="author" value="{{ old('author', auth()->user()->name ?? '') }}">
                                        @error('author')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="block_version" class="form-label">Version</label>
                                        <input type="text" class="form-control @error('block_version') is-invalid @enderror"
                                               id="block_version" name="block_version" value="{{ old('block_version', '1.0.0') }}"
                                               placeholder="1.0.0">
                                        @error('block_version')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="thumbnail" class="form-label">Thumbnail/Preview Image</label>
                                    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror"
                                           id="thumbnail" name="thumbnail" accept="image/*">
                                    <small class="text-muted">Upload a preview image for the block (optional)</small>
                                    @error('thumbnail')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-3">
            <!-- Actions Card -->
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="mb-0">Actions</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                   {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active
                            </label>
                        </div>
                        <small class="text-muted">Make block available in GrapesJS</small>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-2">
                        <i class="fas fa-save me-2"></i> Create Block
                    </button>

                    <a href="{{ route('admin.blocks.index') }}" class="btn btn-secondary w-100">
                        <i class="fas fa-times me-2"></i> Cancel
                    </a>
                </div>
            </div>

            <!-- Quick Tips Card -->
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-lightbulb me-2"></i>Quick Tips</h6>
                </div>
                <div class="card-body">
                    <ul class="small mb-0 ps-3">
                        <li class="mb-2">Use descriptive names for easy identification</li>
                        <li class="mb-2">Test templates with default values</li>
                        <li class="mb-2">Keep CSS scoped to avoid conflicts</li>
                        <li class="mb-2">Validate JSON before saving</li>
                        <li>Add tags for better searchability</li>
                    </ul>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/xml/xml.min.js"></script>

<script>
// Icon preview
document.getElementById('icon').addEventListener('input', function(e) {
    document.getElementById('icon-preview').className = 'fas ' + e.target.value;
});

// Initialize CodeMirror for code editors
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

// Initialize editors when tabs are shown
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

// Convert tags input to JSON array before submit
document.getElementById('blockForm').addEventListener('submit', function(e) {
    const tagsInput = document.getElementById('tags');
    if (tagsInput.value) {
        const tagsArray = tagsInput.value.split(',').map(t => t.trim()).filter(t => t);
        // Create hidden input with JSON
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'tags';
        hiddenInput.value = JSON.stringify(tagsArray);
        this.appendChild(hiddenInput);
        tagsInput.removeAttribute('name'); // Remove name so it doesn't submit
    }
});
</script>
@endpush
