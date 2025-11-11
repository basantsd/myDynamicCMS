@extends('admin.layouts.app')

@section('title', 'Edit Menu')
@section('page-title', 'Edit Menu')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Edit {{ ucfirst($menu->location) }} Menu</h1>
            <p>Manage menu items and structure</p>
        </div>
        <a href="{{ route('admin.menus.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to Menus
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5><i class="fas fa-list me-2"></i> Menu Items</h5>
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addMenuItemModal">
                    <i class="fas fa-plus me-1"></i> Add Item
                </button>
            </div>
            <div class="card-body">
                @if($menu->items->where('parent_id', null)->count() > 0)
                <div id="menu-items-list">
                    @foreach($menu->items->where('parent_id', null)->sortBy('order') as $item)
                    <div class="menu-item-card card mb-3" data-item-id="{{ $item->id }}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center gap-3 mb-2">
                                        <i class="fas fa-grip-vertical text-muted" style="cursor: move;"></i>
                                        <div>
                                            <h6 class="mb-1">{{ $item->label }}</h6>
                                            <small class="text-muted">
                                                @if($item->type === 'page')
                                                <i class="fas fa-file-alt"></i> Page: {{ $item->page ? $item->page->title : 'N/A' }}
                                                @else
                                                <i class="fas fa-external-link-alt"></i> URL: {{ $item->url }}
                                                @endif
                                            </small>
                                        </div>
                                    </div>

                                    @if($item->children->count() > 0)
                                    <div class="ms-5 mt-2">
                                        @foreach($item->children->sortBy('order') as $child)
                                        <div class="menu-item-card card mb-2" data-item-id="{{ $child->id }}" style="background: #f8f9fa;">
                                            <div class="card-body py-2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <i class="fas fa-level-up-alt fa-rotate-90 text-muted"></i>
                                                            <div>
                                                                <small><strong>{{ $child->label }}</strong></small><br>
                                                                <small class="text-muted">
                                                                    @if($child->type === 'page')
                                                                    <i class="fas fa-file-alt"></i> {{ $child->page ? $child->page->title : 'N/A' }}
                                                                    @else
                                                                    <i class="fas fa-external-link-alt"></i> {{ $child->url }}
                                                                    @endif
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="btn-group btn-group-sm">
                                                        <button type="button" class="btn btn-outline-primary" onclick="editMenuItem({{ $child->id }})">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-outline-danger" onclick="deleteMenuItem({{ $child->id }})">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                                <div class="btn-group-vertical btn-group-sm">
                                    <button type="button" class="btn btn-outline-primary" onclick="editMenuItem({{ $item->id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger" onclick="deleteMenuItem({{ $item->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-5">
                    <i class="fas fa-bars text-muted" style="font-size: 48px; opacity: 0.3;"></i>
                    <p class="text-muted mt-3 mb-0">No menu items yet</p>
                    <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addMenuItemModal">
                        <i class="fas fa-plus me-2"></i> Add Your First Menu Item
                    </button>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-info-circle me-2"></i> Menu Information</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted d-block mb-1">Menu Name</small>
                    <strong>{{ ucfirst($menu->location) }} Menu</strong>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block mb-1">Location</small>
                    <code>{{ $menu->location }}</code>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block mb-1">Total Items</small>
                    <strong>{{ $menu->items->count() }}</strong>
                </div>
                <div>
                    <small class="text-muted d-block mb-1">Description</small>
                    <p class="mb-0">{{ $menu->description }}</p>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <div class="alert alert-info mb-0" style="font-size: 13px;">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Drag & Drop:</strong> You can reorder menu items by dragging them. Changes are saved automatically.
                    <hr class="my-2">
                    <strong>Nested Menus:</strong> Create submenu items by setting a parent when adding or editing items.
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Menu Item Modal -->
<div class="modal fade" id="addMenuItemModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addMenuItemForm" action="{{ route('admin.menu-items.store') }}" method="POST">
                @csrf
                <input type="hidden" name="menu_id" value="{{ $menu->id }}">

                <div class="modal-header">
                    <h5 class="modal-title">Add Menu Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Label <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="label" required placeholder="Menu item text">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Link Type</label>
                        <select class="form-select" name="type" id="linkType" required>
                            <option value="page">Link to Page</option>
                            <option value="url">Custom URL</option>
                        </select>
                    </div>

                    <div class="mb-3" id="pageSelectDiv">
                        <label class="form-label">Select Page</label>
                        <select class="form-select" name="page_id">
                            <option value="">- Select Page -</option>
                            @foreach($pages as $page)
                            <option value="{{ $page->id }}">{{ $page->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3" id="urlInputDiv" style="display: none;">
                        <label class="form-label">URL</label>
                        <input type="text" class="form-control" name="url" placeholder="https://example.com">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Parent Item</label>
                        <select class="form-select" name="parent_id">
                            <option value="">None (Top Level)</option>
                            @foreach($menu->items->where('parent_id', null) as $item)
                            <option value="{{ $item->id }}">{{ $item->label }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Create a submenu by selecting a parent</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Order</label>
                        <input type="number" class="form-control" name="order" value="0" min="0">
                        <small class="text-muted">Lower numbers appear first</small>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="target_blank" value="1" id="targetBlank">
                        <label class="form-check-label" for="targetBlank">
                            Open in new tab
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i> Add Item
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Link type toggle
    document.getElementById('linkType').addEventListener('change', function() {
        if (this.value === 'page') {
            document.getElementById('pageSelectDiv').style.display = 'block';
            document.getElementById('urlInputDiv').style.display = 'none';
        } else {
            document.getElementById('pageSelectDiv').style.display = 'none';
            document.getElementById('urlInputDiv').style.display = 'block';
        }
    });

    function editMenuItem(itemId) {
        alert('Edit menu item: ' + itemId + '\n\nThis will open a modal with the menu item details.');
        // TODO: Implement edit functionality
    }

    function deleteMenuItem(itemId) {
        if (confirm('Are you sure you want to delete this menu item?')) {
            fetch(`/admin/menu-items/${itemId}`, {
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
