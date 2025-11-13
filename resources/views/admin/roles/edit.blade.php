@extends('admin.layouts.app')

@section('title', 'Edit Role')
@section('page-title', 'Edit Role')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Edit Role: {{ $role->display_name }}</h1>
            <p>Update role information and permissions</p>
        </div>
        <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to Roles
        </a>
    </div>
</div>

<form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-info-circle me-2"></i> Role Information</h5>
                </div>
                <div class="card-body">
                    @if(in_array($role->name, ['admin', 'editor', 'staff']))
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>System Role:</strong> This is a default system role. Be careful when modifying permissions.
                    </div>
                    @endif

                    <div class="mb-4">
                        <label for="name" class="form-label">Role Name (Slug) <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                            value="{{ old('name', $role->name) }}"
                            placeholder="e.g., content-manager"
                            {{ in_array($role->name, ['admin', 'editor', 'staff']) ? 'readonly' : 'required' }}
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
                            value="{{ old('display_name', $role->display_name) }}"
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
                        >{{ old('description', $role->description) }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>

                    <div class="small text-muted">
                        <p class="mb-1"><strong>Created:</strong> {{ $role->created_at->format('M d, Y h:i A') }}</p>
                        <p class="mb-0"><strong>Updated:</strong> {{ $role->updated_at->format('M d, Y h:i A') }}</p>
                    </div>
                </div>
            </div>

            <div class="d-grid gap-2 mt-3">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save me-2"></i> Update Role
                </button>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times me-2"></i> Cancel
                </a>
            </div>

            @if(!in_array($role->name, ['admin', 'editor', 'staff']))
            <div class="card mt-3 border-danger">
                <div class="card-body">
                    <h6 class="text-danger mb-2">
                        <i class="fas fa-exclamation-triangle me-2"></i> Danger Zone
                    </h6>
                    <p class="small text-muted mb-3">Deleting a role is permanent and cannot be undone. Make sure no users are assigned to this role.</p>
                    <button type="button" class="btn btn-danger btn-sm w-100" onclick="confirmDelete()">
                        <i class="fas fa-trash me-2"></i> Delete Role
                    </button>
                </div>
            </div>
            @endif
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
                        <strong>Current Status:</strong> This role has {{ $role->permissions->count() }} permission(s) assigned.
                    </div>

                    @if($permissions->count() > 0)
                        @foreach($permissions as $group => $groupPermissions)
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0 text-uppercase" style="color: #3b82f6; font-weight: 600;">
                                    <i class="fas fa-folder me-2"></i> {{ ucfirst($group) }}
                                </h6>
                                <div>
                                    <span class="badge bg-secondary me-2">
                                        <span id="{{ $group }}-count">{{ $groupPermissions->whereIn('id', $role->permissions->pluck('id'))->count() }}</span> / {{ $groupPermissions->count() }}
                                    </span>
                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="toggleGroup('{{ $group }}')">
                                        <i class="fas fa-check-double me-1"></i> Toggle All
                                    </button>
                                </div>
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
                                            {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}
                                            onchange="updateCount('{{ $group }}')"
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

<!-- Delete Confirmation Modal -->
@if(!in_array($role->name, ['admin', 'editor', 'staff']))
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p><strong>Are you sure you want to delete this role?</strong></p>
                <p class="text-muted mb-0">This action cannot be undone. Make sure no users are assigned to this role.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i> Delete Role
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

@push('scripts')
<script>
    // Toggle all permissions in a group
    function toggleGroup(group) {
        const checkboxes = document.querySelectorAll(`.${group}-permission`);
        const allChecked = Array.from(checkboxes).every(cb => cb.checked);

        checkboxes.forEach(checkbox => {
            checkbox.checked = !allChecked;
        });

        updateCount(group);
    }

    // Update permission count for a group
    function updateCount(group) {
        const checkboxes = document.querySelectorAll(`.${group}-permission:checked`);
        const countElement = document.getElementById(`${group}-count`);
        if (countElement) {
            countElement.textContent = checkboxes.length;
        }
    }

    function confirmDelete() {
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }
</script>
@endpush
@endsection
