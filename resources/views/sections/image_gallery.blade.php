{{-- Image Gallery Section --}}
<section class="gallery-area space {{ $content['background_class'] ?? '' }}">
    <div class="container">
        @if(isset($content['title']) || isset($content['subtitle']))
        <div class="title-area text-center">
            @if(isset($content['subtitle']))
            <span class="sub-title">{{ $content['subtitle'] }}</span>
            @endif
            @if(isset($content['title']))
            <h2 class="sec-title">{{ $content['title'] }}</h2>
            @endif
        </div>
        @endif

        <div class="row gy-4 gallery-row">
            @if(isset($content['images']) && is_array($content['images']))
                @foreach($content['images'] as $image)
                <div class="col-md-6 col-lg-4">
                    <div class="gallery-card">
                        <div class="gallery-img">
                            <img src="{{ asset('storage/' . $image['path']) }}" alt="{{ $image['caption'] ?? 'Gallery Image' }}">
                            <a href="{{ asset('storage/' . $image['path']) }}" class="icon-btn popup-image">
                                <i class="fas fa-search-plus"></i>
                            </a>
                        </div>
                        @if(isset($image['caption']))
                        <div class="gallery-content">
                            <p class="gallery-title">{{ $image['caption'] }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
