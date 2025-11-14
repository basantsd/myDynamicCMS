@extends('admin.layouts.app')

@section('title', 'Edit Form')
@section('page-title', 'Edit Form')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Edit Form</h1>
            <p>Update form details</p>
        </div>
        <a href="{{ route('admin.forms.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to Forms
        </a>
    </div>
</div>

<form action="{{ route('admin.forms.update', $form) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Form Details</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Form Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $form->name) }}" required>
                        <small class="text-muted">Internal identifier for this form</small>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="form_type" class="form-label">Form Type <span class="text-danger">*</span></label>
                        <select class="form-select @error('form_type') is-invalid @enderror" id="form_type" name="form_type" required>
                            <option value="submission" {{ old('form_type', $form->form_type) == 'submission' ? 'selected' : '' }}>Submission Form</option>
                            <option value="calculation" {{ old('form_type', $form->form_type) == 'calculation' ? 'selected' : '' }}>Calculation Form</option>
                            <option value="action" {{ old('form_type', $form->form_type) == 'action' ? 'selected' : '' }}>Action Form</option>
                        </select>
                        @error('form_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Form Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $form->title) }}" required>
                        <small class="text-muted">Displayed to users</small>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $form->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Form Fields <span class="text-danger">*</span></label>
                        <div id="form-fields-container">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                Form fields configuration. Use JSON format:
                            </div>
                            <textarea class="form-control font-monospace" name="fields" rows="10" required>{{ old('fields', json_encode($form->fields, JSON_PRETTY_PRINT)) }}</textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="submit_button_text" class="form-label">Submit Button Text</label>
                        <input type="text" class="form-control @error('submit_button_text') is-invalid @enderror" id="submit_button_text" name="submit_button_text" value="{{ old('submit_button_text', $form->submit_button_text) }}">
                        @error('submit_button_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Notification Settings</h5>
                </div>
                <div class="card-body">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="send_email_notification" name="send_email_notification" value="1" {{ old('send_email_notification', $form->send_email_notification) ? 'checked' : '' }}>
                        <label class="form-check-label" for="send_email_notification">
                            Send Email Notification
                        </label>
                    </div>

                    <div class="mb-3">
                        <label for="notification_email" class="form-label">Notification Email</label>
                        <input type="email" class="form-control @error('notification_email') is-invalid @enderror" id="notification_email" name="notification_email" value="{{ old('notification_email', $form->notification_email) }}">
                        @error('notification_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Settings</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $form->sort_order ?? 0) }}">
                        @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $form->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">
                            Active
                        </label>
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="store_submissions" name="store_submissions" value="1" {{ old('store_submissions', $form->store_submissions) ? 'checked' : '' }}>
                        <label class="form-check-label" for="store_submissions">
                            Store Submissions
                        </label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="enable_captcha" name="enable_captcha" value="1" {{ old('enable_captcha', $form->enable_captcha) ? 'checked' : '' }}>
                        <label class="form-check-label" for="enable_captcha">
                            Enable Captcha
                        </label>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary w-100 mb-2">
                        <i class="fas fa-save me-2"></i> Update Form
                    </button>
                    <a href="{{ route('admin.forms.index') }}" class="btn btn-outline-secondary w-100">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
