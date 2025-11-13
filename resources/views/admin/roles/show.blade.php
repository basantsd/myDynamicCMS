@extends('admin.layouts.app')

@section('title', 'Role Details')
@section('page-title', 'Role Details')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>{{ $role->display_name }}</h1>
            <p>{{ $role->description }}</p>
        </div>
        <div>
            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-primary">
                <i class="fas fa-edit me-2"></i> Edit Role
            </a>
            <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i> Back
            </a>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Role Info Card -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-info-circle me-2"></i> Role Information</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="text-muted small mb-1">Role Name (Slug)</label>
                    <p class="mb-0"><code>{{ $role->name }}</code></p>
                </div>

                <div class="mb-3">
                    <label class="text-muted small mb-1">Display Name</label>
                    <p class="mb-0"><strong>{{ $role->display_name }}</strong></p>
                </div>

                <div class="mb-3">
                    <label class="text-muted small mb-1">Description</label>
                    <p class="mb-0">{{ $role->description ?? 'No description provided.' }}</p>
                </div>

                @if(in_array($role->name, ['admin', 'editor', 'staff']))
                <div class="mb-3">
                    <span class="badge bg-warning text-dark">
                        <i class="fas fa-lock me-1"></i> System Role
                    </span>
                </div>
                @endif

                <hr>

                <div class="row text-center g-3">
                    <div class="col-6">
                        <div class="p-3 bg-light rounded">
                            <h3 class="mb-1" style="color: #3b82f6;">{{ $role->permissions->count() }}</h3>
                            <small class="text-muted">Permissions</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 bg-light rounded">
                            <h3 class="mb-1" style="color: #10b981;">{{ $role->users->count() }}</h3>
                            <small class="text-muted">Users</small>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="small text-muted">
                    <p class="mb-1"><strong>Created:</strong> {{ $role->created_at->format('M d, Y h:i A') }}</p>
                    <p class="mb-0"><strong>Updated:</strong> {{ $role->updated_at->format('M d, Y h:i A') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Permissions Card -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-key me-2"></i> Assigned Permissions ({{ $role->permissions->count() }})</h5>
            </div>
            <div class="card-body">
                @if($role->permissions->count() > 0)
                    @php
                        $groupedPermissions = $role->permissions->groupBy('group');
                    @endphp

                    @foreach($groupedPermissions as $group => $permissions)
                    <div class="mb-4">
                        <h6 class="text-uppercase mb-3" style="color: #3b82f6; font-weight: 600;">
                            <i class="fas fa-folder me-2"></i> {{ ucfirst($group) }}
                            <span class="badge bg-primary ms-2">{{ $permissions->count() }}</span>
                        </h6>
                        <div class="row g-2">
                            @foreach($permissions as $permission)
                            <div class="col-md-6">
                                <div class="p-3 border rounded bg-light">
                                    <div class="d-flex align-items-start">
                                        <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                        <div>
                                            <strong>{{ $permission->display_name }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $permission->name }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                @else
                <div class="text-center py-5">
                    <i class="fas fa-key fa-3x text-muted mb-3" style="opacity: 0.3;"></i>
                    <h5 class="text-muted">No Permissions Assigned</h5>
                    <p class="text-muted mb-4">This role doesn't have any permissions yet.</p>
                    <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i> Add Permissions
                    </a>
                </div>
                @endif
            </div>
        </div>

        <!-- Assigned Users Card -->
        <div class="card mt-4">
            <div class="card-header">
                <h5><i class="fas fa-users me-2"></i> Assigned Users ({{ $role->users->count() }})</h5>
            </div>
            <div class="card-body">
                @if($role->users->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th style="width: 40px;">#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Primary Role</th>
                                <th>Status</th>
                                <th style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($role->users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-2" style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 600; font-size: 12px;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <strong>{{ $user->name }}</strong>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge bg-secondary">{{ ucfirst($user->role) }}</span>
                                </td>
                                <td>
                                    @if($user->is_active)
                                    <span class="badge bg-success">Active</span>
                                    @else
                                    <span class="badge bg-warning text-dark">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-5">
                    <i class="fas fa-users fa-3x text-muted mb-3" style="opacity: 0.3;"></i>
                    <h5 class="text-muted">No Users Assigned</h5>
                    <p class="text-muted mb-0">No users have been assigned this role yet.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
