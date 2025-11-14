@extends('admin.layouts.app')

@section('title', 'Form Submissions')
@section('page-title', 'Form Submissions Management')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Form Submissions</h1>
            <p class="text-muted">View and manage all form submissions</p>
        </div>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card border-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Total Submissions</h6>
                        <h3 class="mb-0">{{ $stats['total'] }}</h3>
                    </div>
                    <div class="text-primary" style="font-size: 2rem;">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Submission Forms</h6>
                        <h3 class="mb-0">{{ $stats['submission_type'] }}</h3>
                    </div>
                    <div class="text-success" style="font-size: 2rem;">
                        <i class="fas fa-paper-plane"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-info">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Calculation Forms</h6>
                        <h3 class="mb-0">{{ $stats['calculation_type'] }}</h3>
                    </div>
                    <div class="text-info" style="font-size: 2rem;">
                        <i class="fas fa-calculator"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Action Forms</h6>
                        <h3 class="mb-0">{{ $stats['action_type'] }}</h3>
                    </div>
                    <div class="text-warning" style="font-size: 2rem;">
                        <i class="fas fa-bolt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.form-submissions.index') }}" class="row g-3">
            <div class="col-md-3">
                <label for="form_name" class="form-label">Form Name</label>
                <select name="form_name" id="form_name" class="form-select">
                    <option value="">All Forms</option>
                    @foreach($formNames as $name)
                        <option value="{{ $name }}" {{ request('form_name') == $name ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="form_type" class="form-label">Form Type</label>
                <select name="form_type" id="form_type" class="form-select">
                    <option value="">All Types</option>
                    <option value="submission" {{ request('form_type') == 'submission' ? 'selected' : '' }}>Submission</option>
                    <option value="calculation" {{ request('form_type') == 'calculation' ? 'selected' : '' }}>Calculation</option>
                    <option value="action" {{ request('form_type') == 'action' ? 'selected' : '' }}>Action</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="page_id" class="form-label">Page</label>
                <select name="page_id" id="page_id" class="form-select">
                    <option value="">All Pages</option>
                    @foreach($pages as $page)
                        <option value="{{ $page->id }}" {{ request('page_id') == $page->id ? 'selected' : '' }}>{{ $page->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-2">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-filter"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Submissions Table -->
@if($submissions->count() > 0)
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Submissions</h5>
        @if(request('form_name'))
        <a href="{{ route('admin.form-submissions.export', request('form_name')) }}" class="btn btn-sm btn-success">
            <i class="fas fa-download me-2"></i> Export CSV
        </a>
        @endif
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Form Name</th>
                    <th>Type</th>
                    <th>Page</th>
                    <th>Submitted At</th>
                    <th>IP Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($submissions as $submission)
                <tr>
                    <td>{{ $submission->id }}</td>
                    <td>
                        <strong>{{ $submission->form_name }}</strong>
                    </td>
                    <td>
                        @if($submission->form_type == 'submission')
                            <span class="badge bg-success">Submission</span>
                        @elseif($submission->form_type == 'calculation')
                            <span class="badge bg-info">Calculation</span>
                        @else
                            <span class="badge bg-warning">Action</span>
                        @endif
                    </td>
                    <td>
                        @if($submission->page)
                            {{ $submission->page->title }}
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>
                    <td>
                        <small>{{ $submission->submitted_at->format('M d, Y H:i') }}</small>
                    </td>
                    <td>
                        <small class="text-muted">{{ $submission->ip_address }}</small>
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="viewSubmission({{ $submission->id }})">
                            <i class="fas fa-eye"></i> View
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteSubmission({{ $submission->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $submissions->links() }}
    </div>
</div>
@else
<div class="card">
    <div class="card-body text-center py-5">
        <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
        <h4>No Submissions Found</h4>
        <p class="text-muted">Form submissions will appear here when users submit forms</p>
    </div>
</div>
@endif

<!-- View Submission Modal -->
<div class="modal fade" id="viewSubmissionModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submission Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="submissionDetails">
                <div class="text-center py-4">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function viewSubmission(id) {
    const modal = new bootstrap.Modal(document.getElementById('viewSubmissionModal'));
    modal.show();

    fetch(`/admin/form-submissions/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const submission = data.submission;
                const labeledData = data.labeled_data;

                let html = `
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Form Name:</strong> ${submission.form_name}
                        </div>
                        <div class="col-md-6">
                            <strong>Type:</strong> ${submission.form_type}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Submitted:</strong> ${new Date(submission.submitted_at).toLocaleString()}
                        </div>
                        <div class="col-md-6">
                            <strong>IP Address:</strong> ${submission.ip_address}
                        </div>
                    </div>
                    <hr>
                    <h6 class="mb-3">Submitted Information:</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tbody>
                `;

                // Display labeled data
                for (const [label, value] of Object.entries(labeledData)) {
                    let displayValue = value;

                    // Handle arrays/objects
                    if (typeof value === 'object' && value !== null) {
                        displayValue = JSON.stringify(value, null, 2);
                    }

                    html += `
                        <tr>
                            <td style="width: 30%; background-color: #f8f9fa;"><strong>${label}</strong></td>
                            <td style="width: 70%;">${displayValue}</td>
                        </tr>
                    `;
                }

                html += `
                            </tbody>
                        </table>
                    </div>
                `;

                if (submission.calculated_result && Object.keys(submission.calculated_result).length > 0) {
                    html += `
                        <hr>
                        <h6 class="mb-3">Calculated Result:</h6>
                        <div class="alert alert-info">
                            <pre class="mb-0">${JSON.stringify(submission.calculated_result, null, 2)}</pre>
                        </div>
                    `;
                }

                document.getElementById('submissionDetails').innerHTML = html;
            }
        })
        .catch(error => {
            document.getElementById('submissionDetails').innerHTML = '<div class="alert alert-danger">Failed to load submission details</div>';
        });
}

function deleteSubmission(id) {
    if (confirm('Are you sure you want to delete this submission?')) {
        fetch(`/admin/form-submissions/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to delete submission');
            }
        });
    }
}
</script>
@endsection
