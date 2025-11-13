@extends('admin.layouts.app')

@section('title', 'Settings')
@section('page-title', 'Site Settings')

@section('content')
<div class="page-header">
    <h1>Site Settings</h1>
    <p>Configure your website settings and preferences</p>
</div>

<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-lg-8">
            <!-- General Settings -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5><i class="fas fa-cog me-2"></i> General Settings</h5>
                </div>
                <div class="card-body">
                    @foreach($settings->where('group', 'general') as $setting)
                    <div class="mb-4">
                        <label class="form-label">{{ $setting->label }}</label>
                        @if($setting->type === 'textarea')
                        <textarea
                            class="form-control"
                            name="settings[{{ $setting->key }}]"
                            rows="3"
                        >{{ old('settings.' . $setting->key, $setting->value) }}</textarea>
                        @elseif($setting->type === 'image')
                        <input
                            type="file"
                            class="form-control"
                            name="settings[{{ $setting->key }}]"
                        >
                        @if($setting->value)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $setting->value) }}" alt="{{ $setting->label }}" style="max-height: 100px;">
                        </div>
                        @endif
                        @else
                        <input
                            type="text"
                            class="form-control"
                            name="settings[{{ $setting->key }}]"
                            value="{{ old('settings.' . $setting->key, $setting->value) }}"
                        >
                        @endif
                        @if($setting->key === 'site_name')
                        <small class="text-muted">The name of your website</small>
                        @elseif($setting->key === 'site_tagline')
                        <small class="text-muted">A short description or slogan</small>
                        @elseif($setting->key === 'site_logo')
                        <small class="text-muted">Upload your website logo</small>
                        @elseif($setting->key === 'site_favicon')
                        <small class="text-muted">Upload your website favicon (32x32px)</small>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- SEO Settings -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5><i class="fas fa-search me-2"></i> SEO Settings</h5>
                </div>
                <div class="card-body">
                    @foreach($settings->where('group', 'seo') as $setting)
                    <div class="mb-4">
                        <label class="form-label">{{ $setting->label }}</label>
                        @if($setting->type === 'textarea')
                        <textarea
                            class="form-control"
                            name="settings[{{ $setting->key }}]"
                            rows="3"
                        >{{ old('settings.' . $setting->key, $setting->value) }}</textarea>
                        @else
                        <input
                            type="text"
                            class="form-control"
                            name="settings[{{ $setting->key }}]"
                            value="{{ old('settings.' . $setting->key, $setting->value) }}"
                        >
                        @endif
                        @if($setting->key === 'meta_description')
                        <small class="text-muted">Default meta description for search engines (150-160 characters)</small>
                        @elseif($setting->key === 'meta_keywords')
                        <small class="text-muted">Default keywords separated by commas</small>
                        @elseif($setting->key === 'google_analytics')
                        <small class="text-muted">Your Google Analytics tracking ID (e.g., UA-XXXXX-Y or G-XXXXXXX)</small>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Contact Settings -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5><i class="fas fa-envelope me-2"></i> Contact Information</h5>
                </div>
                <div class="card-body">
                    @foreach($settings->where('group', 'contact') as $setting)
                    <div class="mb-4">
                        <label class="form-label">{{ $setting->label }}</label>
                        @if($setting->type === 'textarea')
                        <textarea
                            class="form-control"
                            name="settings[{{ $setting->key }}]"
                            rows="3"
                        >{{ old('settings.' . $setting->key, $setting->value) }}</textarea>
                        @else
                        <input
                            type="text"
                            class="form-control"
                            name="settings[{{ $setting->key }}]"
                            value="{{ old('settings.' . $setting->key, $setting->value) }}"
                        >
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Social Media Settings -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5><i class="fas fa-share-alt me-2"></i> Social Media Links</h5>
                </div>
                <div class="card-body">
                    @foreach($settings->where('group', 'social') as $setting)
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="fab fa-{{ str_replace('social_', '', $setting->key) }} me-2"></i>
                            {{ $setting->label }}
                        </label>
                        <input
                            type="url"
                            class="form-control"
                            name="settings[{{ $setting->key }}]"
                            value="{{ old('settings.' . $setting->key, $setting->value) }}"
                            placeholder="https://"
                        >
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-info-circle me-2"></i> About Settings</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">
                        Settings control various aspects of your website including appearance, SEO, and contact information.
                    </p>
                    <hr>
                    <h6 class="text-primary mb-3">Quick Tips:</h6>
                    <ul class="text-muted small">
                        <li class="mb-2">Update your site name and tagline for better branding</li>
                        <li class="mb-2">Add Google Analytics to track visitor statistics</li>
                        <li class="mb-2">Keep contact information up to date</li>
                        <li class="mb-2">Add social media links to connect with your audience</li>
                    </ul>
                </div>
            </div>

            <div class="d-grid gap-2 mt-3">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save me-2"></i> Save Settings
                </button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
                </a>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <div class="alert alert-warning mb-0" style="font-size: 13px;">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Note:</strong> Changes to settings will affect the entire website. Make sure to review before saving.
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
