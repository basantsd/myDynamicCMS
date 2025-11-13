{{-- Data Table Section --}}
<section class="table-area space {{ $content['background_class'] ?? '' }}">
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

        <div class="table-responsive">
            <table class="table table-bordered">
                @if(isset($content['headers']) && is_array($content['headers']))
                <thead>
                    <tr>
                        @foreach($content['headers'] as $header)
                        <th>{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                @endif
                @if(isset($content['rows']) && is_array($content['rows']))
                <tbody>
                    @foreach($content['rows'] as $row)
                    <tr>
                        @foreach($row as $cell)
                        <td>{{ $cell }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
                @endif
            </table>
        </div>
    </div>
</section>
