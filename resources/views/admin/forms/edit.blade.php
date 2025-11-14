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

                    <div class="mb-4">
                        <label for="form_type" class="form-label">Form Type <span class="text-danger">*</span></label>
                        <select class="form-select @error('form_type') is-invalid @enderror" id="form_type" name="form_type" required>
                            <option value="">-- Select Form Type --</option>
                            <option value="submission" {{ old('form_type', $form->form_type) == 'submission' ? 'selected' : '' }}>
                                Submission Form - Collects and saves user data
                            </option>
                            <option value="calculation" {{ old('form_type', $form->form_type) == 'calculation' ? 'selected' : '' }}>
                                Calculation Form - Performs client-side calculations
                            </option>
                            <option value="action" {{ old('form_type', $form->form_type) == 'action' ? 'selected' : '' }}>
                                Action Form - Triggers specific actions
                            </option>
                        </select>
                        @error('form_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <!-- Form Type Descriptions -->
                        <div id="form-type-help" class="mt-3">
                            <div id="help-submission" class="alert alert-info" style="display:none;">
                                <strong><i class="fas fa-paper-plane me-2"></i>Submission Form</strong>
                                <ul class="mb-0 mt-2">
                                    <li><strong>Purpose:</strong> Collect user data and save to database</li>
                                    <li><strong>Examples:</strong> Contact forms, registration, feedback, surveys</li>
                                    <li><strong>Behavior:</strong> Dynamic - Data is submitted to server and saved</li>
                                    <li><strong>Features:</strong> Email notifications, auto-responses, data export</li>
                                </ul>
                            </div>
                            <div id="help-calculation" class="alert alert-success" style="display:none;">
                                <strong><i class="fas fa-calculator me-2"></i>Calculation Form</strong>
                                <ul class="mb-0 mt-2">
                                    <li><strong>Purpose:</strong> Perform calculations and show results instantly</li>
                                    <li><strong>Examples:</strong> Loan calculator, BMI calculator, price estimator</li>
                                    <li><strong>Behavior:</strong> Static - Works entirely in browser, no data saved</li>
                                    <li><strong>Features:</strong> Real-time results, custom formulas, no database storage</li>
                                </ul>
                            </div>
                            <div id="help-action" class="alert alert-warning" style="display:none;">
                                <strong><i class="fas fa-bolt me-2"></i>Action Form</strong>
                                <ul class="mb-0 mt-2">
                                    <li><strong>Purpose:</strong> Trigger specific actions or processes</li>
                                    <li><strong>Examples:</strong> API calls, downloads, external integrations</li>
                                    <li><strong>Behavior:</strong> Can be static or dynamic based on requirements</li>
                                    <li><strong>Features:</strong> Custom actions, API integration, event triggers</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Form Behavior <span class="text-danger">*</span></label>
                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                            <option value="">-- Auto-selected based on form type --</option>
                            <option value="dynamic" {{ old('type', $form->type ?? 'dynamic') == 'dynamic' ? 'selected' : '' }}>
                                Dynamic - Saves data to database
                            </option>
                            <option value="static" {{ old('type', $form->type ?? 'dynamic') == 'static' ? 'selected' : '' }}>
                                Static - Client-side only (no database)
                            </option>
                        </select>
                        <small class="text-muted" id="type-description">This will be automatically set based on your form type selection</small>
                        @error('type')
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
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <small class="text-muted">Add and configure form fields</small>
                            <button type="button" class="btn btn-sm btn-primary" onclick="addField()">
                                <i class="fas fa-plus me-1"></i> Add Field
                            </button>
                        </div>
                        <div id="fields-list" class="mb-3">
                            <!-- Fields will be added here dynamically -->
                        </div>
                        <!-- Hidden textarea for JSON storage -->
                        <textarea class="form-control d-none" id="fields-json" name="fields" required>{{ old('fields', json_encode($form->fields)) }}</textarea>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const formTypeSelect = document.getElementById('form_type');
    const typeSelect = document.getElementById('type');
    const typeDescription = document.getElementById('type-description');

    // Form type configurations
    const formTypeConfig = {
        'submission': {
            type: 'dynamic',
            description: 'Submission forms always save data to the database (Dynamic)',
            helpId: 'help-submission'
        },
        'calculation': {
            type: 'static',
            description: 'Calculation forms work client-side only, no data is saved (Static)',
            helpId: 'help-calculation'
        },
        'action': {
            type: 'dynamic',
            description: 'Action forms can be dynamic or static - choose based on your needs',
            helpId: 'help-action'
        }
    };

    function updateFormBehavior() {
        const selectedType = formTypeSelect.value;

        // Hide all help texts
        document.querySelectorAll('#form-type-help .alert').forEach(el => {
            el.style.display = 'none';
        });

        if (selectedType && formTypeConfig[selectedType]) {
            const config = formTypeConfig[selectedType];

            // Auto-select the appropriate type
            typeSelect.value = config.type;

            // Update description
            typeDescription.textContent = config.description;

            // Show relevant help text
            const helpElement = document.getElementById(config.helpId);
            if (helpElement) {
                helpElement.style.display = 'block';
            }

            // For calculation forms, disable type selection (must be static)
            if (selectedType === 'calculation') {
                typeSelect.disabled = true;
                typeSelect.style.opacity = '0.6';
            } else if (selectedType === 'submission') {
                // For submission forms, disable type selection (must be dynamic)
                typeSelect.disabled = true;
                typeSelect.style.opacity = '0.6';
            } else {
                // For action forms, allow manual selection
                typeSelect.disabled = false;
                typeSelect.style.opacity = '1';
            }
        } else {
            typeSelect.value = '';
            typeDescription.textContent = 'This will be automatically set based on your form type selection';
            typeSelect.disabled = false;
            typeSelect.style.opacity = '1';
        }
    }

    // Update on page load
    updateFormBehavior();

    // Update when form type changes
    formTypeSelect.addEventListener('change', updateFormBehavior);

    // Load existing fields from JSON
    loadFieldsFromJSON();
});

// Field Builder Functions
let fieldCounter = 0;

function loadFieldsFromJSON() {
    const fieldsJson = document.getElementById('fields-json').value;
    try {
        const fields = JSON.parse(fieldsJson);
        if (Array.isArray(fields) && fields.length > 0) {
            fields.forEach(field => addField(field));
        }
    } catch (e) {
        console.error('Error loading fields:', e);
    }
}

function addField(fieldData = null) {
    fieldCounter++;
    const fieldId = `field-${fieldCounter}`;

    const fieldHtml = `
        <div class="card mb-3 field-item" id="${fieldId}" data-field-id="${fieldCounter}">
            <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #f8f9fa;">
                <h6 class="mb-0">
                    <i class="fas fa-grip-vertical me-2 text-muted" style="cursor: move;"></i>
                    <span class="field-label-display">${fieldData?.label || 'New Field'}</span>
                </h6>
                <div>
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="toggleFieldDetails('${fieldId}')">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeField('${fieldId}')">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            <div class="card-body field-details" style="display: ${fieldData ? 'none' : 'block'};">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Field Name <small class="text-danger">*</small></label>
                        <input type="text" class="form-control field-name" value="${fieldData?.name || ''}" placeholder="e.g., email, full_name" required>
                        <small class="text-muted">Use lowercase, no spaces (use underscores)</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Field Type <small class="text-danger">*</small></label>
                        <select class="form-select field-type" required>
                            <option value="text" ${fieldData?.type === 'text' ? 'selected' : ''}>Text</option>
                            <option value="email" ${fieldData?.type === 'email' ? 'selected' : ''}>Email</option>
                            <option value="number" ${fieldData?.type === 'number' ? 'selected' : ''}>Number</option>
                            <option value="tel" ${fieldData?.type === 'tel' ? 'selected' : ''}>Phone</option>
                            <option value="url" ${fieldData?.type === 'url' ? 'selected' : ''}>URL</option>
                            <option value="textarea" ${fieldData?.type === 'textarea' ? 'selected' : ''}>Textarea</option>
                            <option value="select" ${fieldData?.type === 'select' ? 'selected' : ''}>Dropdown</option>
                            <option value="radio" ${fieldData?.type === 'radio' ? 'selected' : ''}>Radio Buttons</option>
                            <option value="checkbox" ${fieldData?.type === 'checkbox' ? 'selected' : ''}>Checkbox</option>
                            <option value="date" ${fieldData?.type === 'date' ? 'selected' : ''}>Date</option>
                            <option value="file" ${fieldData?.type === 'file' ? 'selected' : ''}>File Upload</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Label <small class="text-danger">*</small></label>
                        <input type="text" class="form-control field-label" value="${fieldData?.label || ''}" placeholder="e.g., Email Address" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Placeholder</label>
                        <input type="text" class="form-control field-placeholder" value="${fieldData?.placeholder || ''}" placeholder="e.g., Enter your email">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Default Value</label>
                        <input type="text" class="form-control field-default" value="${fieldData?.default_value || ''}" placeholder="Optional default value">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Help Text</label>
                        <input type="text" class="form-control field-help" value="${fieldData?.help_text || ''}" placeholder="Optional help text">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3 field-options-container" style="display: ${['select', 'radio'].includes(fieldData?.type) ? 'block' : 'none'};">
                        <label class="form-label">Options (comma-separated)</label>
                        <input type="text" class="form-control field-options" value="${fieldData?.options?.join(', ') || ''}" placeholder="e.g., Option 1, Option 2, Option 3">
                        <small class="text-muted">For dropdown and radio fields</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input field-required" type="checkbox" ${fieldData?.required ? 'checked' : ''}>
                            <label class="form-check-label">Required Field</label>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Validation Rules</label>
                        <input type="text" class="form-control field-validation" value="${fieldData?.validation || ''}" placeholder="e.g., required|email|max:255">
                        <small class="text-muted">Laravel validation rules</small>
                    </div>
                </div>
            </div>
        </div>
    `;

    document.getElementById('fields-list').insertAdjacentHTML('beforeend', fieldHtml);

    // Add event listener for field type change
    const fieldElement = document.getElementById(fieldId);
    const typeSelect = fieldElement.querySelector('.field-type');
    typeSelect.addEventListener('change', function() {
        const optionsContainer = fieldElement.querySelector('.field-options-container');
        if (['select', 'radio'].includes(this.value)) {
            optionsContainer.style.display = 'block';
        } else {
            optionsContainer.style.display = 'none';
        }
    });

    // Add event listener for label change to update display
    const labelInput = fieldElement.querySelector('.field-label');
    labelInput.addEventListener('input', function() {
        fieldElement.querySelector('.field-label-display').textContent = this.value || 'New Field';
    });

    updateFieldsJSON();
}

function toggleFieldDetails(fieldId) {
    const field = document.getElementById(fieldId);
    const details = field.querySelector('.field-details');
    details.style.display = details.style.display === 'none' ? 'block' : 'none';
}

function removeField(fieldId) {
    if (confirm('Are you sure you want to remove this field?')) {
        document.getElementById(fieldId).remove();
        updateFieldsJSON();
    }
}

function updateFieldsJSON() {
    const fields = [];
    document.querySelectorAll('.field-item').forEach(fieldElement => {
        const field = {
            name: fieldElement.querySelector('.field-name').value,
            type: fieldElement.querySelector('.field-type').value,
            label: fieldElement.querySelector('.field-label').value,
            placeholder: fieldElement.querySelector('.field-placeholder').value,
            default_value: fieldElement.querySelector('.field-default').value,
            help_text: fieldElement.querySelector('.field-help').value,
            required: fieldElement.querySelector('.field-required').checked,
            validation: fieldElement.querySelector('.field-validation').value
        };

        // Add options for select/radio fields
        const optionsValue = fieldElement.querySelector('.field-options').value;
        if (optionsValue && ['select', 'radio'].includes(field.type)) {
            field.options = optionsValue.split(',').map(opt => opt.trim()).filter(opt => opt);
        }

        // Only add if name and label are filled
        if (field.name && field.label) {
            fields.push(field);
        }
    });

    document.getElementById('fields-json').value = JSON.stringify(fields);
}

// Update JSON before form submission
document.querySelector('form').addEventListener('submit', function(e) {
    updateFieldsJSON();
});

// Add event listeners to update JSON when fields change
document.addEventListener('input', function(e) {
    if (e.target.closest('.field-item')) {
        updateFieldsJSON();
    }
});
</script>
@endsection
