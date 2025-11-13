@extends('admin.layouts.app')

@section('title', 'Users')
@section('page-title', 'User Management')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>User Management</h1>
            <p>Manage admin users and their roles</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus me-2"></i> Add New User
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="mb-0"><i class="fas fa-users me-2"></i> All Users</h5>
            </div>
            <div class="col-auto">
                <div class="input-group" style="width: 300px;">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" id="searchUsers" placeholder="Search users...">
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        @if($users->count() > 0)
        <div class="table-responsive">
            <table class="table mb-0" id="usersTable">
                <thead>
                    <tr>
                        <th style="width: 40px;">#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="user-avatar me-2" style="width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 600; font-size: 14px;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <strong>{{ $user->name }}</strong>
                            </div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->role === 'admin')
                            <span class="badge bg-danger">
                                <i class="fas fa-crown me-1"></i> Admin
                            </span>
                            @elseif($user->role === 'editor')
                            <span class="badge bg-primary">
                                <i class="fas fa-edit me-1"></i> Editor
                            </span>
                            @else
                            <span class="badge bg-secondary">
                                <i class="fas fa-user me-1"></i> Staff
                            </span>
                            @endif
                        </td>
                        <td>
                            @if($user->is_active)
                            <span class="badge bg-success">
                                <i class="fas fa-check-circle me-1"></i> Active
                            </span>
                            @else
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-ban me-1"></i> Inactive
                            </span>
                            @endif
                        </td>
                        <td>
                            <small class="text-muted">
                                {{ $user->created_at->format('M d, Y') }}
                            </small>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if($user->id !== auth()->id())
                                <button type="button" class="btn btn-outline-danger" onclick="deleteUser({{ $user->id }})" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
        <div class="card-footer">
            {{ $users->links() }}
        </div>
        @endif
        @else
        <div class="text-center py-5">
            <i class="fas fa-users text-muted" style="font-size: 64px; opacity: 0.3;"></i>
            <h4 class="mt-4 text-muted">No Users Found</h4>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary mt-3">
                <i class="fas fa-user-plus me-2"></i> Add New User
            </a>
        </div>
        @endif
    </div>
</div>

<!-- Role Information -->
<div class="row g-4 mt-3">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div style="width: 48px; height: 48px; border-radius: 10px; background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-crown text-white" style="font-size: 20px;"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Admin</h6>
                        <small class="text-muted">Full Access</small>
                    </div>
                </div>
                <p class="small text-muted mb-0">
                    Complete control over all CMS features including users, settings, pages, menus, and media.
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div style="width: 48px; height: 48px; border-radius: 10px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-edit text-white" style="font-size: 20px;"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Editor</h6>
                        <small class="text-muted">Content Manager</small>
                    </div>
                </div>
                <p class="small text-muted mb-0">
                    Can manage pages, menus, and media. Cannot access user management or system settings.
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div style="width: 48px; height: 48px; border-radius: 10px; background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-user text-white" style="font-size: 20px;"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Staff</h6>
                        <small class="text-muted">View Only</small>
                    </div>
                </div>
                <p class="small text-muted mb-0">
                    Limited access to view content only. Cannot create, edit, or delete any content.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this user? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Search functionality
    document.getElementById('searchUsers').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const rows = document.querySelectorAll('#usersTable tbody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchValue) ? '' : 'none';
        });
    });

    // Delete user
    function deleteUser(userId) {
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        document.getElementById('deleteForm').action = `/admin/users/${userId}`;
        modal.show();
    }
</script>
@endpush
@endsection
