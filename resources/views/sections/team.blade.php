{{-- Team Section --}}
<section class="team-area space {{ $content['background_class'] ?? '' }}">
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
            @if(isset($content['members']) && is_array($content['members']))
                @foreach($content['members'] as $member)
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="th-team team-card">
                        @if(isset($member['image']))
                        <div class="team-img">
                            <img src="{{ asset('storage/' . $member['image']) }}" alt="{{ $member['name'] ?? 'Team Member' }}">
                        </div>
                        @endif
                        <div class="team-content">
                            @if(isset($member['name']))
                            <h3 class="team-title"><a href="{{ $member['link'] ?? '#' }}">{{ $member['name'] }}</a></h3>
                            @endif
                            @if(isset($member['position']))
                            <span class="team-desig">{{ $member['position'] }}</span>
                            @endif
                            @if(isset($member['bio']))
                            <p class="team-text">{{ $member['bio'] }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
