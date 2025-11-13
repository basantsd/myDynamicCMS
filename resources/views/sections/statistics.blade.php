{{-- Statistics Counter Section --}}
<section class="counter-area space {{ $content['background_class'] ?? 'bg-theme' }}">
    <div class="container">
        <div class="row gy-40 justify-content-center">
            @if(isset($content['counters']) && is_array($content['counters']))
                @foreach($content['counters'] as $counter)
                <div class="col-sm-6 col-lg-3">
                    <div class="counter-card">
                        @if(isset($counter['icon']))
                        <div class="counter-card_icon">
                            <i class="{{ $counter['icon'] }}"></i>
                        </div>
                        @endif
                        <div class="media-body">
                            @if(isset($counter['number']))
                            <h2 class="counter-card_number">
                                <span class="counter-number">{{ $counter['number'] }}</span>{{ $counter['suffix'] ?? '' }}
                            </h2>
                            @endif
                            @if(isset($counter['label']))
                            <p class="counter-card_text">{{ $counter['label'] }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
