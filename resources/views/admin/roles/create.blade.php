@extends('admin.layouts.app')

@section('title', 'Create Role')
@section('page-title', 'Create New Role')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Create New Role</h1>
            <p>Define a new role with custom permissions</p>
        </div>
        <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to Roles
        </a>
    </div>
</div>

<form action="{{ route('admin.roles.store') }}" method="POST">
    @csrf

    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-info-circle me-2"></i> Role Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <label for="name" class="form-label">Role Name (Slug) <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="e.g., content-manager"
                            required
                        >
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Lowercase, no spaces. Use hyphens or underscores.</small>
                    </div>

                    <div class="mb-4">
                        <label for="display_name" class="form-label">Display Name <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('display_name') is-invalid @enderror"
                            id="display_name"
                            name="display_name"
                            value="{{ old('display_name') }}"
                            placeholder="e.g., Content Manager"
                            required
                        >
                        @error('display_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Human-readable name shown in the UI.</small>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label">Description</label>
                        <textarea
                            class="form-control @error('description') is-invalid @enderror"
                            id="description"
                            name="description"
                            rows="4"
                            placeholder="Describe what this role can do..."
                        >{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-grid gap-2 mt-3">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save me-2"></i> Create Role
                </button>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times me-2"></i> Cancel
                </a>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-key me-2"></i> Permissions</h5>
                    <small class="text-muted">Select the permissions for this role</small>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Tip:</strong> Check the permissions you want to grant to users with this role. You can organize permissions by groups below.
                    </div>

                    @if($permissions->count() > 0)
                        @foreach($permissions as $group => $groupPermissions)
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0 text-uppercase" style="color: #3b82f6; font-weight: 600;">
                                    <i class="fas fa-folder me-2"></i> {{ ucfirst($group) }}
                                </h6>
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="toggleGroup('{{ $group }}')">
                                    <i class="fas fa-check-double me-1"></i> Toggle All
                                </button>
                            </div>
                            <div class="row g-2">
                                @foreach($groupPermissions as $permission)
                                <div class="col-md-6">
                                    <div class="form-check p-3 border rounded" style="background: #f8f9fa;">
                                        <input
                                            class="form-check-input permission-check {{ $group }}-permission"
                                            type="checkbox"
                                            name="permissions[]"
                                            value="{{ $permission->id }}"
                                            id="permission_{{ $permission->id }}"
                                            {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}
                                        >
                                        <label class="form-check-label w-100" for="permission_{{ $permission->id }}">
                                            <strong>{{ $permission->display_name }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $permission->name }}</small>
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        @endforeach
                    @else
                    <div class="text-center py-4">
                        <i class="fas fa-key fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No permissions available. Please seed permissions first.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
    // Toggle all permissions in a group
    function toggleGroup(group) {
        const checkboxes = document.querySelectorAll(`.${group}-permission`);
        const allChecked = Array.from(checkboxes).every(cb => cb.checked);

        checkboxes.forEach(checkbox => {
            checkbox.checked = !allChecked;
        });
    }

    // Auto-generate slug from display name
    document.getElementById('display_name').addEventListener('input', function() {
        const nameInput = document.getElementById('name');
        if (!nameInput.value || nameInput.dataset.manual !== 'true') {
            const slug = this.value
                .toLowerCase()
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_]+/g, '-')
                .replace(/^-+|-+$/g, '');
            nameInput.value = slug;
        }
    });

    // Mark name as manually edited
    document.getElementById('name').addEventListener('input', function() {
        this.dataset.manual = 'true';
    });
</script>
@endpush
@endsection
