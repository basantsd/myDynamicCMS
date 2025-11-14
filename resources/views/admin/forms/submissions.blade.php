@extends('admin.layouts.app')

@section('title', 'Form Submissions')
@section('page-title', 'Form Submissions')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>{{ $form->title }} - Submissions</h1>
            <p>View and manage form submissions</p>
        </div>
        <div>
            <a href="{{ route('admin.forms.index') }}" class="btn btn-outline-secondary me-2">
                <i class="fas fa-arrow-left me-2"></i> Back to Forms
            </a>
            <a href="{{ route('admin.forms.edit', $form) }}" class="btn btn-outline-primary">
                <i class="fas fa-edit me-2"></i> Edit Form
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="mb-0">
                    <i class="fas fa-list me-2"></i>
                    Submissions ({{ $submissions->total() }})
                </h5>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        @if($submissions->count() > 0)
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th style="width: 40px;">#</th>
                        <th>Submitted Data</th>
                        <th>IP Address</th>
                        <th>User</th>
                        <th>Submitted At</th>
                        <th style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($submissions as $submission)
                    <tr>
                        <td>{{ $submission->id }}</td>
                        <td>
                            <div class="small">
                                @if(is_array($submission->data))
                                    @foreach($submission->data as $key => $value)
                                        <strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}<br>
                                    @endforeach
                                @else
                                    {{ $submission->data }}
                                @endif
                            </div>
                        </td>
                        <td>
                            <code class="small">{{ $submission->ip_address }}</code>
                        </td>
                        <td>
                            @if($submission->user)
                                {{ $submission->user->name }}
                            @else
                                <span class="text-muted">Guest</span>
                            @endif
                        </td>
                        <td>
                            <small class="text-muted">{{ $submission->created_at->format('M d, Y H:i') }}</small>
                        </td>
                        <td>
                            @permission('forms.delete')
                            <form action="{{ route('admin.form-submissions.destroy', $submission) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this submission?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @endpermission
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
            <p class="text-muted">No submissions yet for this form.</p>
        </div>
        @endif
    </div>
    @if($submissions->hasPages())
    <div class="card-footer">
        {{ $submissions->links() }}
    </div>
    @endif
</div>
@endsection
