<!-- Mobile Menu -->
<div class="th-menu-wrapper">
    <div class="th-menu-area text-center">
        <button class="th-menu-toggle"><i class="fal fa-times"></i></button>
        <div class="mobile-logo">
            <a href="{{ route('home') }}">
                @if(isset($settings['site_logo']) && $settings['site_logo'])
                <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="{{ $settings['site_name'] ?? 'Logo' }}">
                @else
                <img src="{{ asset('assets/img/Logo1.png') }}" alt="{{ $settings['site_name'] ?? 'Logo' }}">
                @endif
            </a>
        </div>
        <div class="th-mobile-menu">
            <ul>
                @if(isset($mobileMenu) && $mobileMenu)
                    @foreach($mobileMenu->items->where('parent_id', null)->sortBy('order') as $item)
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
        </div>
    </div>
</div>
<!-- Mobile Menu End -->
