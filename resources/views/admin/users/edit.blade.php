@extends('admin.layouts.app')

@section('title', 'Edit User')
@section('page-title', 'Edit User')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Edit User</h1>
            <p>Update user information and permissions</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to Users
        </a>
    </div>
</div>

<form action="{{ route('admin.users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-user-edit me-2"></i> User Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            required
                        >
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                        <input
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            id="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            required
                        >
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>

                    <h6 class="mb-3">Change Password (Optional)</h6>
                    <p class="text-muted small">Leave blank to keep current password</p>

                    <div class="mb-4">
                        <label for="password" class="form-label">New Password</label>
                        <input
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            id="password"
                            name="password"
                            placeholder="Enter new password"
                        >
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Minimum 8 characters</small>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <input
                            type="password"
                            class="form-control"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Confirm new password"
                        >
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-shield-alt me-2"></i> Role & Status</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="role" class="form-label">User Role <span class="text-danger">*</span></label>
                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="editor" {{ $user->role === 'editor' ? 'selected' : '' }}>Editor</option>
                            <option value="staff" {{ $user->role === 'staff' ? 'selected' : '' }}>Staff</option>
                        </select>
                        @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div id="roleDescription" class="alert alert-info" style="font-size: 13px;">
                        <!-- Description will be populated by JavaScript -->
                    </div>

                    <hr>

                    <div class="mb-3">
                        <label class="form-label">Additional Roles (Optional)</label>
                        @if(isset($roles) && $roles->count() > 0)
                        <div class="border rounded p-3" style="max-height: 200px; overflow-y: auto;">
                            @foreach($roles as $roleItem)
                            <div class="form-check mb-2">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="roles[]"
                                    value="{{ $roleItem->id }}"
                                    id="role_{{ $roleItem->id }}"
                                    {{ $user->roles->contains($roleItem->id) ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="role_{{ $roleItem->id }}">
                                    <strong>{{ $roleItem->display_name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $roleItem->description }}</small>
                                </label>
                            </div>
                            @endforeach
                        </div>
                        <small class="text-muted mt-2 d-block">Assign additional roles for granular permissions</small>
                        @else
                        <p class="text-muted small mb-0">No roles available</p>
                        @endif
                    </div>

                    <hr>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="is_active"
                                name="is_active"
                                value="1"
                                {{ $user->is_active ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="is_active">
                                <strong>Active Account</strong>
                                <br>
                                <small class="text-muted">User can login and access the system</small>
                            </label>
                        </div>
                    </div>

                    <hr>

                    <div class="small text-muted">
                        <p class="mb-1"><strong>Created:</strong> {{ $user->created_at->format('M d, Y h:i A') }}</p>
                        <p class="mb-0"><strong>Updated:</strong> {{ $user->updated_at->format('M d, Y h:i A') }}</p>
                    </div>
                </div>
            </div>

            <div class="d-grid gap-2 mt-3">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save me-2"></i> Update User
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times me-2"></i> Cancel
                </a>
            </div>

            @if($user->id !== auth()->id())
            <div class="card mt-3 border-danger">
                <div class="card-body">
                    <h6 class="text-danger mb-2">
                        <i class="fas fa-exclamation-triangle me-2"></i> Danger Zone
                    </h6>
                    <p class="small text-muted mb-3">Deleting a user is permanent and cannot be undone.</p>
                    <button type="button" class="btn btn-danger btn-sm w-100" onclick="confirmDelete()">
                        <i class="fas fa-trash me-2"></i> Delete User
                    </button>
                </div>
            </div>
            @endif
        </div>
    </div>
</form>

<!-- Delete Confirmation Modal -->
@if($user->id !== auth()->id())
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p><strong>Are you sure you want to delete this user?</strong></p>
                <p class="text-muted mb-0">This action cannot be undone. All user data will be permanently removed.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i> Delete User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

@push('scripts')
<script>
    const roleDescriptions = {
        admin: '<i class="fas fa-crown me-2"></i><strong>Admin:</strong> Full access to all features including user management, settings, pages, menus, and media.',
        editor: '<i class="fas fa-edit me-2"></i><strong>Editor:</strong> Can manage pages, menus, and media. Cannot access user management or system settings.',
        staff: '<i class="fas fa-user me-2"></i><strong>Staff:</strong> Limited access to view content only. Cannot create, edit, or delete any content.'
    };

    // Initialize description on page load
    function updateRoleDescription() {
        const role = document.getElementById('role').value;
        document.getElementById('roleDescription').innerHTML = roleDescriptions[role];
    }

    document.getElementById('role').addEventListener('change', updateRoleDescription);
    updateRoleDescription();

    function confirmDelete() {
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }
</script>
@endpush
@endsection
