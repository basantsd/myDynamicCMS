{{-- Breadcrumb Section --}}
<div class="breadcumb-wrapper" style="background-image: url('{{ isset($content['background_image']) ? asset('storage/' . $content['background_image']) : asset('assets/img/bg/breadcumb-bg.jpg') }}');">
    <div class="container">
        <div class="breadcumb-content">
            @if(isset($content['title']))
            <h1 class="breadcumb-title">{{ $content['title'] }}</h1>
            @endif
            @if(isset($content['show_breadcrumb']) && $content['show_breadcrumb'])
            <ul class="breadcumb-menu">
                <li><a href="{{ route('home') }}">Home</a></li>
                @if(isset($content['links']) && is_array($content['links']))
                    @foreach($content['links'] as $link)
                    <li>
                        @if(isset($link['url']))
                        <a href="{{ $link['url'] }}">{{ $link['label'] }}</a>
                        @else
                        {{ $link['label'] }}
                        @endif
                    </li>
                    @endforeach
                @else
                <li>{{ $content['title'] ?? 'Page' }}</li>
                @endif
            </ul>
            @endif
        </div>
    </div>
</div>
