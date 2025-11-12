@extends('admin.layouts.app')

@section('title', 'Edit Custom Block')
@section('page-title', 'Edit Custom Block')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Edit Block: {{ $block->name }}</h1>
            <p class="text-muted">Modify block template settings</p>
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
                <form action="{{ route('admin.blocks.update', $block->id) }}" method="POST" id="blockForm">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="form-label">Block Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name', $block->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="icon" class="form-label">Icon (FontAwesome) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas {{ $block->icon }}" id="icon-preview"></i>
                                </span>
                                <input type="text" class="form-control @error('icon') is-invalid @enderror"
                                       id="icon" name="icon" value="{{ old('icon', $block->icon) }}"
                                       placeholder="fa-cube" required>
                            </div>
                            @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="color" class="form-label">Color <span class="text-danger">*</span></label>
                            <input type="color" class="form-control form-control-color @error('color') is-invalid @enderror"
                                   id="color" name="color" value="{{ old('color', $block->color) }}" required>
                            @error('color')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                        <select class="form-select @error('category') is-invalid @enderror"
                                id="category" name="category" required>
                            @foreach(\App\Models\CustomBlock::getCategories() as $key => $name)
                                <option value="{{ $key }}" {{ old('category', $block->category) == $key ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description" name="description" rows="3">{{ old('description', $block->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="schema" class="form-label">Block Schema (JSON) <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('schema') is-invalid @enderror"
                                  id="schema" name="schema" rows="10" required>{{ old('schema', json_encode($block->schema, JSON_PRETTY_PRINT)) }}</textarea>
                        @error('schema')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="default_values" class="form-label">Default Values (JSON)</label>
                        <textarea class="form-control @error('default_values') is-invalid @enderror"
                                  id="default_values" name="default_values" rows="5">{{ old('default_values', json_encode($block->default_values, JSON_PRETTY_PRINT)) }}</textarea>
                        @error('default_values')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                   {{ old('is_active', $block->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active (available for use)
                            </label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.blocks.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Update Block
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0">Block Stats</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span>Usage Count:</span>
                    <strong>{{ $block->usage_count }}</strong>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Status:</span>
                    <span class="badge bg-{{ $block->is_active ? 'success' : 'secondary' }}">
                        {{ $block->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Created:</span>
                    <small>{{ $block->created_at->diffForHumans() }}</small>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-outline-primary btn-sm w-100 mb-2" onclick="duplicateBlock()">
                    <i class="fas fa-copy me-2"></i> Duplicate This Block
                </button>
                <a href="{{ asset('custom-blocks-examples.json') }}" target="_blank" class="btn btn-outline-secondary btn-sm w-100">
                    <i class="fas fa-book me-2"></i> View Examples
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('icon').addEventListener('input', function(e) {
    document.getElementById('icon-preview').className = 'fas ' + e.target.value;
});

function duplicateBlock() {
    if (confirm('Create a duplicate of this block?')) {
        fetch(`/admin/custom-blocks/{{ $block->id }}/duplicate`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Block duplicated successfully!');
                window.location.href = '/admin/custom-blocks/' + data.block.id + '/edit';
            }
        });
    }
}
</script>
@endsection
