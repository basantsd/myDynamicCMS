@extends('admin.layouts.app')

@section('title', 'Create User')
@section('page-title', 'Create New User')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Create New User</h1>
            <p>Add a new user to the admin panel</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to Users
        </a>
    </div>
</div>

<form action="{{ route('admin.users.store') }}" method="POST">
    @csrf

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-user-plus me-2"></i> User Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Enter full name"
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
                            value="{{ old('email') }}"
                            placeholder="user@example.com"
                            required
                        >
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">User will use this email to login</small>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            id="password"
                            name="password"
                            placeholder="Enter password"
                            required
                        >
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Minimum 8 characters</small>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <input
                            type="password"
                            class="form-control"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Confirm password"
                            required
                        >
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-shield-alt me-2"></i> Role & Permissions</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="role" class="form-label">User Role <span class="text-danger">*</span></label>
                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                            <option value="">- Select Role -</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="editor" {{ old('role') === 'editor' ? 'selected' : '' }}>Editor</option>
                            <option value="staff" {{ old('role') === 'staff' ? 'selected' : '' }}>Staff</option>
                        </select>
                        @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div id="roleDescription" class="alert alert-info" style="font-size: 13px;">
                        Select a role to see description
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
                                {{ old('is_active', true) ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="is_active">
                                <strong>Active Account</strong>
                                <br>
                                <small class="text-muted">User can login and access the system</small>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-grid gap-2 mt-3">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-user-plus me-2"></i> Create User
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times me-2"></i> Cancel
                </a>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
    const roleDescriptions = {
        admin: '<i class="fas fa-crown me-2"></i><strong>Admin:</strong> Full access to all features including user management, settings, pages, menus, and media.',
        editor: '<i class="fas fa-edit me-2"></i><strong>Editor:</strong> Can manage pages, menus, and media. Cannot access user management or system settings.',
        staff: '<i class="fas fa-user me-2"></i><strong>Staff:</strong> Limited access to view content only. Cannot create, edit, or delete any content.'
    };

    document.getElementById('role').addEventListener('change', function() {
        const description = roleDescriptions[this.value] || 'Select a role to see description';
        document.getElementById('roleDescription').innerHTML = description;
    });
</script>
@endpush
@endsection
