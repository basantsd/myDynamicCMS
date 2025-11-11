@extends('admin.layouts.app')

@section('title', 'Menus')
@section('page-title', 'Menu Management')

@section('content')
<div class="page-header">
    <h1>Menu Management</h1>
    <p>Manage your website navigation menus</p>
</div>

<div class="row g-4">
    @foreach($menus as $menu)
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-bars me-2"></i> {{ ucfirst($menu->location) }} Menu
                    </h5>
                    <span class="badge bg-primary">{{ $menu->items->count() }} items</span>
                </div>
            </div>
            <div class="card-body">
                <p class="text-muted mb-3">{{ $menu->description }}</p>

                @if($menu->items->count() > 0)
                <div class="menu-preview mb-3">
                    <small class="text-muted d-block mb-2"><strong>Menu Structure:</strong></small>
                    <ul class="list-unstyled ms-2">
                        @foreach($menu->items->where('parent_id', null) as $item)
                        <li class="mb-2">
                            <i class="fas fa-link text-primary me-2"></i>
                            <strong>{{ $item->label }}</strong>
                            @if($item->children->count() > 0)
                            <ul class="list-unstyled ms-4 mt-1">
                                @foreach($item->children as $child)
                                <li class="text-muted">
                                    <i class="fas fa-level-up-alt fa-rotate-90 me-2"></i>
                                    {{ $child->label }}
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
                @else
                <div class="text-center py-4">
                    <i class="fas fa-bars text-muted" style="font-size: 32px; opacity: 0.3;"></i>
                    <p class="text-muted mt-2 mb-0 small">No menu items yet</p>
                </div>
                @endif

                <a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn btn-primary w-100">
                    <i class="fas fa-edit me-2"></i> Edit Menu
                </a>
            </div>
            <div class="card-footer text-muted small">
                <i class="fas fa-info-circle me-1"></i>
                Location: <code>{{ $menu->location }}</code>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="card mt-4">
    <div class="card-header">
        <h5><i class="fas fa-info-circle me-2"></i> About Menu Management</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <h6 class="text-primary"><i class="fas fa-check-circle me-2"></i> Header Menu</h6>
                <p class="text-muted small">Main navigation menu displayed in the website header. Visible on all pages.</p>
            </div>
            <div class="col-md-4">
                <h6 class="text-primary"><i class="fas fa-check-circle me-2"></i> Footer Menu</h6>
                <p class="text-muted small">Links displayed in the website footer. Great for legal pages and resources.</p>
            </div>
            <div class="col-md-4">
                <h6 class="text-primary"><i class="fas fa-check-circle me-2"></i> Mobile Menu</h6>
                <p class="text-muted small">Optimized menu for mobile devices. Shown in the mobile hamburger menu.</p>
            </div>
        </div>
        <hr>
        <div class="alert alert-info mb-0">
            <i class="fas fa-lightbulb me-2"></i>
            <strong>Tip:</strong> You can create nested menus with unlimited levels. Simply set a parent item when creating or editing menu items.
        </div>
    </div>
</div>
@endsection
