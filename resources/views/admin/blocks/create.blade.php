@extends('admin.layouts.app')

@section('title', 'Create Custom Block')
@section('page-title', 'Create Custom Block')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Create Custom Block</h1>
            <p class="text-muted">Define a new reusable block template</p>
        </div>
        <a href="{{ route('admin.blocks.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to Blocks
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.blocks.store') }}" method="POST" id="blockForm">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="form-label">Block Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-4">
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
                            <small class="text-muted">Enter FontAwesome class (e.g., fa-image, fa-table)</small>
                            @error('icon')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="color" class="form-label">Color <span class="text-danger">*</span></label>
                            <input type="color" class="form-control form-control-color @error('color') is-invalid @enderror"
                                   id="color" name="color" value="{{ old('color', '#3498db') }}" required>
                            @error('color')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                        <select class="form-select @error('category') is-invalid @enderror"
                                id="category" name="category" required>
                            <option value="">Select Category</option>
                            @foreach(\App\Models\CustomBlock::getCategories() as $key => $name)
                                <option value="{{ $key }}" {{ old('category') == $key ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="schema" class="form-label">Block Schema (JSON) <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('schema') is-invalid @enderror"
                                  id="schema" name="schema" rows="10" required>{{ old('schema', '{"fields": []}') }}</textarea>
                        <small class="text-muted">Define the block structure in JSON format</small>
                        @error('schema')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="default_values" class="form-label">Default Values (JSON)</label>
                        <textarea class="form-control @error('default_values') is-invalid @enderror"
                                  id="default_values" name="default_values" rows="5">{{ old('default_values', '{}') }}</textarea>
                        @error('default_values')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                   {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active (available for use)
                            </label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.blocks.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Create Block
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Schema Examples</h5>
            </div>
            <div class="card-body">
                <p class="small text-muted">Common field types:</p>
                <ul class="small">
                    <li><code>text</code> - Single line text</li>
                    <li><code>textarea</code> - Multi-line text</li>
                    <li><code>image</code> - Image upload</li>
                    <li><code>button</code> - Button configuration</li>
                    <li><code>repeater</code> - Repeating fields</li>
                    <li><code>table</code> - Table data</li>
                    <li><code>select</code> - Dropdown</li>
                    <li><code>toggle</code> - On/off switch</li>
                </ul>
                <a href="{{ asset('custom-blocks-examples.json') }}" target="_blank" class="btn btn-sm btn-outline-primary w-100">
                    <i class="fas fa-book me-2"></i> View Full Examples
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('icon').addEventListener('input', function(e) {
    document.getElementById('icon-preview').className = 'fas ' + e.target.value;
});
</script>
@endsection
