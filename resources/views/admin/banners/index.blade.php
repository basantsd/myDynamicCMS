@extends('admin.layouts.app')

@section('title', 'Banners')
@section('page-title', 'Banners Management')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Banners</h1>
            <p>Manage your website banners and sliders</p>
        </div>
        @permission('pages.create')
        <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Create New Banner
        </a>
        @endpermission
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="mb-0"><i class="fas fa-image me-2"></i> All Banners</h5>
            </div>
            <div class="col-auto">
                <div class="input-group" style="width: 300px;">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" id="searchBanners" placeholder="Search banners...">
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        @if($banners->count() > 0)
        <div class="table-responsive">
            <table class="table mb-0" id="bannersTable">
                <thead>
                    <tr>
                        <th style="width: 40px;">#</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Order</th>
                        <th>Updated</th>
                        <th style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($banners as $banner)
                    <tr>
                        <td>{{ $banner->id }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-image me-2 text-primary"></i>
                                <strong>{{ $banner->name }}</strong>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-info">{{ ucfirst($banner->banner_type) }}</span>
                        </td>
                        <td>{{ $banner->title }}</td>
                        <td>
                            @if($banner->is_active)
                            <span class="badge bg-success">
                                <i class="fas fa-check-circle me-1"></i> Active
                            </span>
                            @else
                            <span class="badge bg-secondary">
                                <i class="fas fa-times-circle me-1"></i> Inactive
                            </span>
                            @endif
                        </td>
                        <td>{{ $banner->sort_order ?? 0 }}</td>
                        <td>
                            <small class="text-muted">{{ $banner->updated_at->diffForHumans() }}</small>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                @permission('pages.edit')
                                <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endpermission
                                @permission('pages.delete')
                                <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this banner?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endpermission
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-image fa-3x text-muted mb-3"></i>
            <p class="text-muted">No banners found. Create your first banner to get started.</p>
            @permission('pages.create')
            <a href="{{ route('admin.banners.create') }}" class="btn btn-primary mt-2">
                <i class="fas fa-plus me-2"></i> Create Banner
            </a>
            @endpermission
        </div>
        @endif
    </div>
    @if($banners->hasPages())
    <div class="card-footer">
        {{ $banners->links() }}
    </div>
    @endif
</div>

@push('scripts')
<script>
    // Search functionality
    document.getElementById('searchBanners')?.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('#bannersTable tbody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
</script>
@endpush
@endsection
