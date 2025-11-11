{{-- Testimonials Section --}}
<section class="testimonial-area space {{ $content['background_class'] ?? '' }}">
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
            @if(isset($content['testimonials']) && is_array($content['testimonials']))
                @foreach($content['testimonials'] as $testimonial)
                <div class="col-md-6 col-lg-4">
                    <div class="testimonial-card">
                        <div class="testimonial-rating">
                            @for($i = 1; $i <= ($testimonial['rating'] ?? 5); $i++)
                            <i class="fas fa-star"></i>
                            @endfor
                        </div>
                        @if(isset($testimonial['content']))
                        <p class="testimonial-text">{{ $testimonial['content'] }}</p>
                        @endif
                        <div class="testimonial-profile">
                            @if(isset($testimonial['image']))
                            <div class="testimonial-avater">
                                <img src="{{ asset('storage/' . $testimonial['image']) }}" alt="{{ $testimonial['name'] ?? 'Client' }}">
                            </div>
                            @endif
                            <div class="media-body">
                                @if(isset($testimonial['name']))
                                <h3 class="testimonial-name">{{ $testimonial['name'] }}</h3>
                                @endif
                                @if(isset($testimonial['designation']))
                                <span class="testimonial-desig">{{ $testimonial['designation'] }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
