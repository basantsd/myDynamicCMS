{{-- Hero Banner Section --}}
<section class="hero-wrapper hero-1" style="background-image: url('{{ isset($content['background_image']) ? asset('storage/' . $content['background_image']) : asset('assets/img/hero/hero_bg_1_1.jpg') }}');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="hero-style1">
                    @if(isset($content['subtitle']) && $content['subtitle'])
                    <span class="sub-title">{{ $content['subtitle'] }}</span>
                    @endif

                    @if(isset($content['title']) && $content['title'])
                    <h1 class="hero-title">{{ $content['title'] }}</h1>
                    @endif

                    @if(isset($content['description']) && $content['description'])
                    <p class="hero-text">{{ $content['description'] }}</p>
                    @endif

                    @if(isset($content['button_text']) && $content['button_text'])
                    <a href="{{ $content['button_link'] ?? '#' }}" class="th-btn">
                        {{ $content['button_text'] }}
                        <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
