@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="page-header">
    <h1>Welcome back, {{ auth()->user()->name }}!</h1>
    <p>Here's what's happening with your website today</p>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-2" style="font-size: 13px; text-transform: uppercase; font-weight: 600; letter-spacing: 0.5px;">Total Pages</p>
                        <h2 class="mb-0" style="font-weight: 700; color: #1e293b;">{{ $totalPages }}</h2>
                        <small class="text-success">
                            <i class="fas fa-arrow-up"></i> {{ $publishedPages }} Published
                        </small>
                    </div>
                    <div style="width: 60px; height: 60px; border-radius: 12px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-file-alt" style="font-size: 24px; color: #fff;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-2" style="font-size: 13px; text-transform: uppercase; font-weight: 600; letter-spacing: 0.5px;">Menu Items</p>
                        <h2 class="mb-0" style="font-weight: 700; color: #1e293b;">{{ $totalMenuItems }}</h2>
                        <small class="text-muted">
                            <i class="fas fa-layer-group"></i> Across all menus
                        </small>
                    </div>
                    <div style="width: 60px; height: 60px; border-radius: 12px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-bars" style="font-size: 24px; color: #fff;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-2" style="font-size: 13px; text-transform: uppercase; font-weight: 600; letter-spacing: 0.5px;">Media Files</p>
                        <h2 class="mb-0" style="font-weight: 700; color: #1e293b;">{{ $totalMedia }}</h2>
                        <small class="text-muted">
                            <i class="fas fa-hdd"></i> {{ $mediaSize }}
                        </small>
                    </div>
                    <div style="width: 60px; height: 60px; border-radius: 12px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-image" style="font-size: 24px; color: #fff;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-2" style="font-size: 13px; text-transform: uppercase; font-weight: 600; letter-spacing: 0.5px;">Users</p>
                        <h2 class="mb-0" style="font-weight: 700; color: #1e293b;">{{ $totalUsers }}</h2>
                        <small class="text-success">
                            <i class="fas fa-check-circle"></i> {{ $activeUsers }} Active
                        </small>
                    </div>
                    <div style="width: 60px; height: 60px; border-radius: 12px; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-users" style="font-size: 24px; color: #fff;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Pages -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5><i class="fas fa-file-alt me-2"></i> Recent Pages</h5>
                <a href="{{ route('admin.pages.index') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus me-1"></i> New Page
                </a>
            </div>
            <div class="card-body p-0">
                @if($recentPages->count() > 0)
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Updated</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentPages as $page)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-file-alt me-2 text-muted"></i>
                                        <div>
                                            <strong>{{ $page->title }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $page->slug }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($page->is_published)
                                    <span class="badge bg-success">Published</span>
                                    @else
                                    <span class="badge bg-warning">Draft</span>
                                    @endif
                                </td>
                                <td>
                                    <small class="text-muted">{{ $page->updated_at->diffForHumans() }}</small>
                                </td>
                                <td>
                                    <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-sm btn-outline-primary">
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
                    <i class="fas fa-file-alt text-muted" style="font-size: 48px; opacity: 0.3;"></i>
                    <p class="text-muted mt-3 mb-0">No pages created yet</p>
                    <a href="{{ route('admin.pages.create') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-plus me-2"></i> Create Your First Page
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-bolt me-2"></i> Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.pages.create') }}" class="btn btn-outline-primary text-start">
                        <i class="fas fa-plus-circle me-2"></i> Create New Page
                    </a>
                    <a href="{{ route('admin.menus.index') }}" class="btn btn-outline-success text-start">
                        <i class="fas fa-bars me-2"></i> Manage Menus
                    </a>
                    <a href="{{ route('admin.media.index') }}" class="btn btn-outline-warning text-start">
                        <i class="fas fa-upload me-2"></i> Upload Media
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="btn btn-outline-info text-start">
                        <i class="fas fa-cog me-2"></i> Site Settings
                    </a>
                    <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-secondary text-start">
                        <i class="fas fa-external-link-alt me-2"></i> View Website
                    </a>
                </div>
            </div>
        </div>

        <!-- System Info -->
        <div class="card mt-4">
            <div class="card-header">
                <h5><i class="fas fa-info-circle me-2"></i> System Info</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted d-block mb-1">CMS Version</small>
                    <strong>1.0.0</strong>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block mb-1">Laravel Version</small>
                    <strong>{{ app()->version() }}</strong>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block mb-1">PHP Version</small>
                    <strong>{{ PHP_VERSION }}</strong>
                </div>
                <div>
                    <small class="text-muted d-block mb-1">Your Role</small>
                    <span class="badge bg-primary">{{ ucfirst(auth()->user()->role) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
    }
</style>
@endpush
@endsection
