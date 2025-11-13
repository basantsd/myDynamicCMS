@extends('admin.layouts.app')

@section('title', 'Roles & Permissions')
@section('page-title', 'Roles & Permissions Management')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Roles & Permissions</h1>
            <p>Manage user roles and their permissions</p>
        </div>
        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Create New Role
        </a>
    </div>
</div>

<!-- Roles Grid -->
<div class="row g-4">
    @forelse($roles as $role)
    <div class="col-md-6 col-lg-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="d-flex align-items-center">
                        <div class="me-3" style="width: 50px; height: 50px; border-radius: 10px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user-shield text-white" style="font-size: 24px;"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0">{{ $role->display_name }}</h5>
                            <small class="text-muted">{{ $role->name }}</small>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.roles.show', $role->id) }}">
                                <i class="fas fa-eye me-2"></i> View Details
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.roles.edit', $role->id) }}">
                                <i class="fas fa-edit me-2"></i> Edit
                            </a></li>
                            @if(!in_array($role->name, ['admin', 'editor', 'staff']))
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#" onclick="deleteRole({{ $role->id }})">
                                <i class="fas fa-trash me-2"></i> Delete
                            </a></li>
                            @endif
                        </ul>
                    </div>
                </div>

                <p class="card-text text-muted small mb-3">{{ $role->description }}</p>

                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="badge bg-primary">
                            <i class="fas fa-key me-1"></i> {{ $role->permissions_count }} Permissions
                        </span>
                        <span class="badge bg-info">
                            <i class="fas fa-users me-1"></i> {{ $role->users_count }} Users
                        </span>
                    </div>
                </div>

                @if(in_array($role->name, ['admin', 'editor', 'staff']))
                <div class="mt-3">
                    <span class="badge bg-warning text-dark">
                        <i class="fas fa-lock me-1"></i> System Role
                    </span>
                </div>
                @endif
            </div>
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.roles.show', $role->id) }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-eye me-1"></i> View
                    </a>
                    <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-user-shield fa-3x text-muted mb-3"></i>
                <h4>No Roles Found</h4>
                <p class="text-muted">Create your first role to get started</p>
                <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i> Create Role
                </a>
            </div>
        </div>
    </div>
    @endforelse
</div>

<!-- Delete Confirmation Modal -->
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
                <form id="deleteForm" method="POST" style="display: inline;">
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

@push('scripts')
<script>
    function deleteRole(roleId) {
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        document.getElementById('deleteForm').action = `/admin/roles/${roleId}`;
        modal.show();
    }
</script>
@endpush
@endsection
