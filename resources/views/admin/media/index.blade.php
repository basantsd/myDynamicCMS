@extends('admin.layouts.app')

@section('title', 'Media Library')
@section('page-title', 'Media Library')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Media Library</h1>
            <p>Manage your images, documents, and files</p>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadMediaModal">
            <i class="fas fa-upload me-2"></i> Upload Files
        </button>
    </div>
</div>

<!-- Filters -->
<div class="card mb-4">
    <div class="card-body">
        <div class="row g-3 align-items-center">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" id="searchMedia" placeholder="Search files...">
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-select" id="filterType">
                    <option value="">All Types</option>
                    <option value="image">Images</option>
                    <option value="document">Documents</option>
                    <option value="video">Videos</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" id="sortBy">
                    <option value="newest">Newest First</option>
                    <option value="oldest">Oldest First</option>
                    <option value="name_asc">Name (A-Z)</option>
                    <option value="name_desc">Name (Z-A)</option>
                    <option value="size_desc">Largest Size</option>
                    <option value="size_asc">Smallest Size</option>
                </select>
            </div>
            <div class="col-md-2">
                <div class="btn-group w-100">
                    <button type="button" class="btn btn-outline-secondary active" id="gridView">
                        <i class="fas fa-th"></i>
                    </button>
                    <button type="button" class="btn btn-outline-secondary" id="listView">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Media Grid -->
@if($media->count() > 0)
<div class="row g-4" id="mediaGrid">
    @foreach($media as $item)
    <div class="col-lg-3 col-md-4 col-sm-6 media-item" data-type="{{ $item->type }}" data-name="{{ $item->title }}">
        <div class="card media-card h-100">
            <div class="media-preview">
                @if($item->type === 'image')
                <img src="{{ asset('storage/' . $item->file_path) }}" alt="{{ $item->alt_text }}" class="img-fluid">
                @else
                <div class="file-icon">
                    <i class="fas fa-file-{{ $item->type === 'document' ? 'pdf' : $item->type }} fa-3x"></i>
                </div>
                @endif
                <div class="media-overlay">
                    <button type="button" class="btn btn-sm btn-light" onclick="viewMedia({{ $item->id }})">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-primary" onclick="editMedia({{ $item->id }})">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteMedia({{ $item->id }})">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <h6 class="mb-1 text-truncate" title="{{ $item->title }}">{{ $item->title }}</h6>
                <small class="text-muted d-block mb-1">{{ $item->file_name }}</small>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="badge bg-secondary">{{ strtoupper($item->type) }}</span>
                    <small class="text-muted">{{ number_format($item->file_size / 1024, 2) }} KB</small>
                </div>
                <small class="text-muted d-block mt-2">
                    <i class="fas fa-clock me-1"></i> {{ $item->created_at->diffForHumans() }}
                </small>
            </div>
        </div>
    </div>
    @endforeach
</div>

@if($media->hasPages())
<div class="mt-4">
    {{ $media->links() }}
</div>
@endif
@else
<div class="card">
    <div class="card-body text-center py-5">
        <i class="fas fa-image text-muted" style="font-size: 64px; opacity: 0.3;"></i>
        <h4 class="mt-4 text-muted">No Media Files</h4>
        <p class="text-muted">Upload your first file to get started</p>
        <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#uploadMediaModal">
            <i class="fas fa-upload me-2"></i> Upload Files
        </button>
    </div>
</div>
@endif

<!-- Upload Media Modal -->
<div class="modal fade" id="uploadMediaModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="uploadMediaForm" action="{{ route('admin.media.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Upload Files</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Select Files</label>
                        <input type="file" class="form-control" name="files[]" multiple required>
                        <small class="text-muted">You can upload multiple files at once. Max size: 10MB per file.</small>
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Supported formats:</strong>
                        <ul class="mb-0 mt-2">
                            <li>Images: JPG, PNG, GIF, SVG, WEBP</li>
                            <li>Documents: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX</li>
                            <li>Videos: MP4, AVI, MOV, WMV</li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-upload me-2"></i> Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View/Edit Media Modal -->
<div class="modal fade" id="mediaDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Media Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="mediaDetailsContent">
                <!-- Content loaded via JavaScript -->
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .media-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .media-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
    }

    .media-preview {
        position: relative;
        height: 200px;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border-radius: 12px 12px 0 0;
    }

    .media-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .file-icon {
        color: #cbd5e1;
    }

    .media-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .media-card:hover .media-overlay {
        opacity: 1;
    }
</style>
@endpush

@push('scripts')
<script>
    // Search functionality
    document.getElementById('searchMedia').addEventListener('keyup', function() {
        filterMedia();
    });

    document.getElementById('filterType').addEventListener('change', function() {
        filterMedia();
    });

    function filterMedia() {
        const searchValue = document.getElementById('searchMedia').value.toLowerCase();
        const typeFilter = document.getElementById('filterType').value;
        const items = document.querySelectorAll('.media-item');

        items.forEach(item => {
            const name = item.dataset.name.toLowerCase();
            const type = item.dataset.type;
            const matchesSearch = name.includes(searchValue);
            const matchesType = !typeFilter || type === typeFilter;

            item.style.display = matchesSearch && matchesType ? '' : 'none';
        });
    }

    function viewMedia(mediaId) {
        alert('View media: ' + mediaId + '\n\nThis will show media details and preview.');
        // TODO: Implement view media
    }

    function editMedia(mediaId) {
        alert('Edit media: ' + mediaId + '\n\nThis will open a form to edit media details.');
        // TODO: Implement edit media
    }

    function deleteMedia(mediaId) {
        if (confirm('Are you sure you want to delete this file?')) {
            fetch(`/admin/media/${mediaId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        }
    }
</script>
@endpush
@endsection
