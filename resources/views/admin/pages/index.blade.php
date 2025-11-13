@extends('admin.layouts.app')

@section('title', 'Pages')
@section('page-title', 'Pages Management')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Pages</h1>
            <p>Manage your website pages and content</p>
        </div>
        @permission('pages.create')
        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Create New Page
        </a>
        @endpermission
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i> All Pages</h5>
            </div>
            <div class="col-auto">
                <div class="input-group" style="width: 300px;">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" id="searchPages" placeholder="Search pages...">
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        @if($pages->count() > 0)
        <div class="table-responsive">
            <table class="table mb-0" id="pagesTable">
                <thead>
                    <tr>
                        <th style="width: 40px;">#</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Template</th>
                        <th>Status</th>
                        <th>Updated</th>
                        <th style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pages as $page)
                    <tr>
                        <td>{{ $page->id }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-file-alt me-2 text-primary"></i>
                                <div>
                                    <strong>{{ $page->title }}</strong>
                                    @if($page->show_in_menu)
                                    <br><small class="text-muted"><i class="fas fa-eye me-1"></i> Visible in menu</small>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <code>{{ $page->slug }}</code>
                        </td>
                        <td>
                            <span class="badge bg-secondary">{{ $page->template ?? 'default' }}</span>
                        </td>
                        <td>
                            @if($page->is_published)
                            <span class="badge bg-success">
                                <i class="fas fa-check-circle me-1"></i> Published
                            </span>
                            @else
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-clock me-1"></i> Draft
                            </span>
                            @endif
                        </td>
                        <td>
                            <small class="text-muted">
                                {{ $page->updated_at->format('M d, Y') }}
                                <br>
                                {{ $page->updated_at->format('h:i A') }}
                            </small>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('page.show', $page->slug) }}" target="_blank" class="btn btn-outline-secondary" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @permission('pages.edit')
                                <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endpermission
                                @permission('pages.delete')
                                <button type="button" class="btn btn-outline-danger" onclick="deletePage({{ $page->id }})" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endpermission
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($pages->hasPages())
        <div class="card-footer">
            {{ $pages->links() }}
        </div>
        @endif
        @else
        <div class="text-center py-5">
            <i class="fas fa-file-alt text-muted" style="font-size: 64px; opacity: 0.3;"></i>
            <h4 class="mt-4 text-muted">No Pages Found</h4>
            <p class="text-muted">Get started by creating your first page</p>
            <a href="{{ route('admin.pages.create') }}" class="btn btn-primary mt-3">
                <i class="fas fa-plus me-2"></i> Create New Page
            </a>
        </div>
        @endif
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
                Are you sure you want to delete this page? This action cannot be undone.
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
    document.getElementById('searchPages').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const rows = document.querySelectorAll('#pagesTable tbody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchValue) ? '' : 'none';
        });
    });

    // Delete page
    function deletePage(pageId) {
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        document.getElementById('deleteForm').action = `/admin/pages/${pageId}`;
        modal.show();
    }
</script>
@endpush
@endsection
