@extends('admin.layouts.app')

@section('title', 'Forms')
@section('page-title', 'Forms Management')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Forms</h1>
            <p>Manage your website forms</p>
        </div>
        @permission('forms.create')
        <a href="{{ route('admin.forms.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Create New Form
        </a>
        @endpermission
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="mb-0"><i class="fas fa-wpforms me-2"></i> All Forms</h5>
            </div>
            <div class="col-auto">
                <div class="input-group" style="width: 300px;">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" id="searchForms" placeholder="Search forms...">
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        @if($forms->count() > 0)
        <div class="table-responsive">
            <table class="table mb-0" id="formsTable">
                <thead>
                    <tr>
                        <th style="width: 40px;">#</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Title</th>
                        <th>Submissions</th>
                        <th>Status</th>
                        <th>Order</th>
                        <th>Updated</th>
                        <th style="width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($forms as $form)
                    <tr>
                        <td>{{ $form->id }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-wpforms me-2 text-primary"></i>
                                <strong>{{ $form->name }}</strong>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-info">{{ ucfirst($form->form_type) }}</span>
                        </td>
                        <td>{{ $form->title }}</td>
                        <td>
                            <span class="badge bg-secondary">{{ $form->submissions_count ?? 0 }}</span>
                        </td>
                        <td>
                            @if($form->is_active)
                            <span class="badge bg-success">
                                <i class="fas fa-check-circle me-1"></i> Active
                            </span>
                            @else
                            <span class="badge bg-secondary">
                                <i class="fas fa-times-circle me-1"></i> Inactive
                            </span>
                            @endif
                        </td>
                        <td>{{ $form->sort_order ?? 0 }}</td>
                        <td>
                            <small class="text-muted">{{ $form->updated_at->diffForHumans() }}</small>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                @permission('forms.view')
                                <a href="{{ route('admin.forms.submissions', $form) }}" class="btn btn-outline-info" title="View Submissions">
                                    <i class="fas fa-list"></i>
                                </a>
                                @endpermission
                                @permission('forms.edit')
                                <a href="{{ route('admin.forms.edit', $form) }}" class="btn btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endpermission
                                @permission('forms.delete')
                                <form action="{{ route('admin.forms.destroy', $form) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this form?');">
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
            <i class="fas fa-wpforms fa-3x text-muted mb-3"></i>
            <p class="text-muted">No forms found. Create your first form to get started.</p>
            @permission('forms.create')
            <a href="{{ route('admin.forms.create') }}" class="btn btn-primary mt-2">
                <i class="fas fa-plus me-2"></i> Create Form
            </a>
            @endpermission
        </div>
        @endif
    </div>
    @if($forms->hasPages())
    <div class="card-footer">
        {{ $forms->links() }}
    </div>
    @endif
</div>

@push('scripts')
<script>
    // Search functionality
    document.getElementById('searchForms')?.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('#formsTable tbody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
</script>
@endpush
@endsection
