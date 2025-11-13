{{-- Rich Content Section --}}
<section class="space {{ $content['background_class'] ?? '' }}">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="rich-content">
                    {!! $content['content'] ?? '' !!}
                </div>
            </div>
        </div>
    </div>
</section>
