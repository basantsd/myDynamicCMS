{{-- Services Grid Section --}}
<section class="service-area space {{ $content['background_class'] ?? '' }}">
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

        <div class="row gy-4">
            @if(isset($content['services']) && is_array($content['services']))
                @foreach($content['services'] as $service)
                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        @if(isset($service['icon']))
                        <div class="service-card_icon">
                            <i class="{{ $service['icon'] }}"></i>
                        </div>
                        @endif
                        @if(isset($service['title']))
                        <h3 class="service-card_title">
                            <a href="{{ $service['link'] ?? '#' }}">{{ $service['title'] }}</a>
                        </h3>
                        @endif
                        @if(isset($service['description']))
                        <p class="service-card_text">{{ $service['description'] }}</p>
                        @endif
                        @if(isset($service['link']))
                        <a href="{{ $service['link'] }}" class="th-btn btn-sm">Read More <i class="fas fa-arrow-right ms-2"></i></a>
                        @endif
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
