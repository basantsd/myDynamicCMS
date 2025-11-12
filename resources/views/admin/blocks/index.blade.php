@extends('admin.layouts.app')

@section('title', 'Custom Blocks')
@section('page-title', 'Custom Blocks Management')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Custom Blocks</h1>
            <p class="text-muted">Manage dynamic content blocks for your pages</p>
        </div>
        <a href="{{ route('admin.blocks.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Create New Block
        </a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Search and Filter -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.blocks.index') }}" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search blocks..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="category" class="form-select">
                    <option value="">All Categories</option>
                    @foreach($categories as $key => $name)
                        <option value="{{ $key }}" {{ request('category') == $key ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="sort" class="form-select">
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Sort by Name</option>
                    <option value="usage" {{ request('sort') == 'usage' ? 'selected' : '' }}>Sort by Usage</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-secondary">
                    <i class="fas fa-search me-2"></i> Search
                </button>
                <a href="{{ route('admin.blocks.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times"></i> Clear
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Blocks Grid -->
@if($blocks->count() > 0)
<div class="row">
    @foreach($blocks as $block)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100" style="border-left: 4px solid {{ $block->color }};">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="d-flex align-items-center">
                        <div class="me-3" style="font-size: 2rem; color: {{ $block->color }};">
                            <i class="fas {{ $block->icon }}"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1">{{ $block->name }}</h5>
                            <span class="badge" style="background-color: {{ $block->color }}20; color: {{ $block->color }};">
                                {{ $categories[$block->category] ?? $block->category }}
                            </span>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.blocks.edit', $block->id) }}">
                                <i class="fas fa-edit me-2"></i> Edit
                            </a></li>
                            <li><a class="dropdown-item" href="#" onclick="duplicateBlock({{ $block->id }})">
                                <i class="fas fa-copy me-2"></i> Duplicate
                            </a></li>
                            <li><a class="dropdown-item" href="#" onclick="toggleBlock({{ $block->id }})">
                                <i class="fas fa-{{ $block->is_active ? 'eye-slash' : 'eye' }} me-2"></i>
                                {{ $block->is_active ? 'Deactivate' : 'Activate' }}
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#" onclick="deleteBlock({{ $block->id }})">
                                <i class="fas fa-trash me-2"></i> Delete
                            </a></li>
                        </ul>
                    </div>
                </div>

                <p class="card-text text-muted small">{{ $block->description }}</p>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                        @if($block->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </div>
                    <div class="text-muted small">
                        <i class="fas fa-chart-line me-1"></i> {{ $block->usage_count }} uses
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Pagination -->
<div class="d-flex justify-content-center mt-4">
    {{ $blocks->links() }}
</div>

@else
<div class="card">
    <div class="card-body text-center py-5">
        <i class="fas fa-cube fa-3x text-muted mb-3"></i>
        <h4>No Blocks Found</h4>
        <p class="text-muted">Create your first custom block to get started</p>
        <a href="{{ route('admin.blocks.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Create Block
        </a>
    </div>
</div>
@endif

<script>
function duplicateBlock(id) {
    if (confirm('Duplicate this block?')) {
        fetch(`/admin/custom-blocks/${id}/duplicate`, {
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
                location.reload();
            }
        });
    }
}

function toggleBlock(id) {
    fetch(`/admin/custom-blocks/${id}/toggle`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    });
}

function deleteBlock(id) {
    if (confirm('Are you sure you want to delete this block? This action cannot be undone.')) {
        fetch(`/admin/custom-blocks/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Block deleted successfully!');
                location.reload();
            } else {
                alert(data.message || 'Failed to delete block');
            }
        });
    }
}
</script>
@endsection
