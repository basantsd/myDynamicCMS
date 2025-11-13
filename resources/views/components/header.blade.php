<!-- Header Area Start -->
<header class="th-header header-layout1">
    <div class="sticky-wrapper">
        <div class="menu-area">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <div class="header-logo">
                            <a href="{{ route('home') }}">
                                @if(isset($settings['site_logo']) && $settings['site_logo'])
                                <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="{{ $settings['site_name'] ?? 'Logo' }}">
                                @else
                                <img src="{{ asset('assets/img/Logo1.png') }}" alt="{{ $settings['site_name'] ?? 'Logo' }}">
                                @endif
                            </a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <nav class="main-menu d-none d-lg-inline-block">
                            <ul>
                                @if(isset($headerMenu) && $headerMenu)
                                    @foreach($headerMenu->items->where('parent_id', null)->sortBy('order') as $item)
                                    <li class="{{ $item->children->count() > 0 ? 'menu-item-has-children' : '' }}">
                                        @if($item->type === 'page' && $item->page)
                                        <a href="{{ route('page.show', $item->page->slug) }}">{{ $item->label }}</a>
                                        @else
                                        <a href="{{ $item->url }}" {{ $item->target_blank ? 'target="_blank"' : '' }}>{{ $item->label }}</a>
                                        @endif

                                        @if($item->children->count() > 0)
                                        <ul class="sub-menu">
                                            @foreach($item->children->sortBy('order') as $child)
                                            <li>
                                                @if($child->type === 'page' && $child->page)
                                                <a href="{{ route('page.show', $child->page->slug) }}">{{ $child->label }}</a>
                                                @else
                                                <a href="{{ $child->url }}" {{ $child->target_blank ? 'target="_blank"' : '' }}>{{ $child->label }}</a>
                                                @endif
                                            </li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                    @endforeach
                                @else
                                <li><a href="{{ route('home') }}">Home</a></li>
                                @endif
                            </ul>
                        </nav>
                        <button type="button" class="th-menu-toggle d-block d-lg-none">
                            <i class="far fa-bars"></i>
                        </button>
                    </div>
                    <div class="col-auto d-none d-xl-block">
                        <div class="header-button">
                            <a href="{{ route('admin.login') }}" class="th-btn">
                                <i class="fas fa-user me-2"></i> Admin Login
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header Area End -->
