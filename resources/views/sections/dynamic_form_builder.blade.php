{{-- Dynamic Form Builder Section --}}
@php
    $formFields = isset($content['form_fields']) ? json_decode($content['form_fields'], true) : [];
    $formName = $content['form_name'] ?? 'custom_form';
    $layout = $content['layout'] ?? 'single';
    $enableFileUpload = $content['enable_file_upload'] ?? false;
    $maxFileSize = $content['max_file_size'] ?? 5;
    $allowedTypes = $content['allowed_file_types'] ?? 'pdf,doc,docx,jpg,png';
@endphp

<section class="dynamic-form-section py-5">
    <div class="container">
        @if(isset($content['form_title']) || isset($content['form_subtitle']))
        <div class="text-center mb-4">
            @if(isset($content['form_title']))
            <h2 class="form-title mb-3">{{ $content['form_title'] }}</h2>
            @endif
            @if(isset($content['form_subtitle']))
            <p class="form-subtitle text-muted">{{ $content['form_subtitle'] }}</p>
            @endif
        </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form
                    class="dynamic-form {{ $layout }}"
                    data-form-type="submission"
                    data-form-name="{{ $formName }}"
                    data-page-id="{{ $page->id ?? '' }}"
                    data-section-id="{{ $section->id ?? '' }}"
                    data-enable-files="{{ $enableFileUpload ? 'true' : 'false' }}"
                    data-max-file-size="{{ $maxFileSize }}"
                    data-allowed-types="{{ $allowedTypes }}"
                    data-success-message="{{ $content['success_message'] ?? 'Form submitted successfully!' }}"
                >
                    <div class="row">
                        @foreach($formFields as $field)
                            @php
                                $fieldName = $field['name'] ?? '';
                                $fieldLabel = $field['label'] ?? ucfirst($fieldName);
                                $fieldType = $field['type'] ?? 'text';
                                $fieldPlaceholder = $field['placeholder'] ?? '';
                                $fieldRequired = $field['required'] ?? false;
                                $fieldRows = $field['rows'] ?? 5;
                                $fieldOptions = $field['options'] ?? [];
                                $fieldHelp = $field['help'] ?? '';
                                $colClass = $layout === 'two-column' && !in_array($fieldType, ['textarea']) ? 'col-md-6' : 'col-12';
                            @endphp

                            <div class="{{ $colClass }} mb-3">
                                <label for="{{ $fieldName }}" class="form-label">
                                    {{ $fieldLabel }}
                                    @if($fieldRequired)
                                    <span class="text-danger">*</span>
                                    @endif
                                </label>

                                @switch($fieldType)
                                    @case('textarea')
                                        <textarea
                                            class="form-control"
                                            id="{{ $fieldName }}"
                                            name="{{ $fieldName }}"
                                            rows="{{ $fieldRows }}"
                                            placeholder="{{ $fieldPlaceholder }}"
                                            {{ $fieldRequired ? 'required' : '' }}
                                            data-validation="{{ $field['validation'] ?? '' }}"
                                        ></textarea>
                                        @break

                                    @case('select')
                                        <select
                                            class="form-select"
                                            id="{{ $fieldName }}"
                                            name="{{ $fieldName }}"
                                            {{ $fieldRequired ? 'required' : '' }}
                                            data-validation="{{ $field['validation'] ?? '' }}"
                                        >
                                            <option value="">Select {{ $fieldLabel }}</option>
                                            @foreach($fieldOptions as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        @break

                                    @case('checkbox')
                                        <div class="form-check">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                id="{{ $fieldName }}"
                                                name="{{ $fieldName }}"
                                                value="1"
                                                {{ $fieldRequired ? 'required' : '' }}
                                            >
                                            <label class="form-check-label" for="{{ $fieldName }}">
                                                {{ $fieldPlaceholder ?: $fieldLabel }}
                                            </label>
                                        </div>
                                        @break

                                    @case('radio')
                                        @foreach($fieldOptions as $value => $label)
                                        <div class="form-check">
                                            <input
                                                class="form-check-input"
                                                type="radio"
                                                name="{{ $fieldName }}"
                                                id="{{ $fieldName }}_{{ $value }}"
                                                value="{{ $value }}"
                                                {{ $fieldRequired ? 'required' : '' }}
                                            >
                                            <label class="form-check-label" for="{{ $fieldName }}_{{ $value }}">
                                                {{ $label }}
                                            </label>
                                        </div>
                                        @endforeach
                                        @break

                                    @case('file')
                                        <input
                                            type="file"
                                            class="form-control"
                                            id="{{ $fieldName }}"
                                            name="{{ $fieldName }}"
                                            accept="{{ $field['accept'] ?? '' }}"
                                            {{ $fieldRequired ? 'required' : '' }}
                                        >
                                        @break

                                    @default
                                        <input
                                            type="{{ $fieldType }}"
                                            class="form-control"
                                            id="{{ $fieldName }}"
                                            name="{{ $fieldName }}"
                                            placeholder="{{ $fieldPlaceholder }}"
                                            {{ $fieldRequired ? 'required' : '' }}
                                            data-validation="{{ $field['validation'] ?? '' }}"
                                        >
                                @endswitch

                                @if($fieldHelp)
                                <small class="form-text text-muted">{{ $fieldHelp }}</small>
                                @endif
                            </div>
                        @endforeach

                        @if($enableFileUpload)
                        <div class="col-12 mb-3">
                            <label for="attachment" class="form-label">Attachment (Optional)</label>
                            <input
                                type="file"
                                class="form-control"
                                id="attachment"
                                name="attachment"
                                accept=".{{ str_replace(',', ',.', $allowedTypes) }}"
                            >
                            <small class="form-text text-muted">
                                Allowed types: {{ $allowedTypes }}. Max size: {{ $maxFileSize }}MB
                            </small>
                        </div>
                        @endif

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-lg">
                                {{ $content['submit_button_text'] ?? 'Submit' }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    .dynamic-form-section {
        background: #f8f9fa;
    }

    .form-title {
        font-size: 2rem;
        font-weight: 700;
        color: #333;
    }

    .form-subtitle {
        font-size: 1.1rem;
    }

    .dynamic-form .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
    }

    .dynamic-form .form-control,
    .dynamic-form .form-select {
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }

    .dynamic-form .form-control:focus,
    .dynamic-form .form-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
    }

    .dynamic-form .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        border: none;
        border-radius: 8px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .dynamic-form .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    }

    .dynamic-form .form-message {
        margin-bottom: 1.5rem;
        border-radius: 8px;
    }

    .dynamic-form .is-invalid {
        border-color: #dc3545;
    }

    .dynamic-form .invalid-feedback {
        display: block;
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
</style>
@endpush
