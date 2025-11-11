{{-- FAQ Section --}}
<section class="faq-area space {{ $content['background_class'] ?? '' }}">
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

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="accordion" id="faqAccordion{{ $loop->index ?? rand() }}">
                    @if(isset($content['items']) && is_array($content['items']))
                        @foreach($content['items'] as $index => $item)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $index }}">
                                <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                                    {{ $item['question'] ?? '' }}
                                </button>
                            </h2>
                            <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" data-bs-parent="#faqAccordion{{ $loop->parent->index ?? rand() }}">
                                <div class="accordion-body">
                                    {{ $item['answer'] ?? '' }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
