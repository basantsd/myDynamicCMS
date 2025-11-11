<!-- Footer Area Start -->
<footer class="footer-wrapper footer-layout1">
    <div class="widget-area">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6 col-xl-3">
                    <div class="widget footer-widget">
                        <div class="th-widget-about">
                            <div class="about-logo">
                                <a href="{{ route('home') }}">
                                    @if(isset($settings['site_logo']))
                                    <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="{{ $settings['site_name'] ?? 'Logo' }}">
                                    @else
                                    <img src="{{ asset('assets/img/logo.svg') }}" alt="Logo">
                                    @endif
                                </a>
                            </div>
                            <p class="about-text">
                                {{ $settings['site_tagline'] ?? 'Your trusted government service provider' }}
                            </p>
                            <div class="th-social">
                                @if(isset($settings['social_facebook']) && $settings['social_facebook'])
                                <a href="{{ $settings['social_facebook'] }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                @endif
                                @if(isset($settings['social_twitter']) && $settings['social_twitter'])
                                <a href="{{ $settings['social_twitter'] }}" target="_blank"><i class="fab fa-twitter"></i></a>
                                @endif
                                @if(isset($settings['social_linkedin']) && $settings['social_linkedin'])
                                <a href="{{ $settings['social_linkedin'] }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                @endif
                                @if(isset($settings['social_instagram']) && $settings['social_instagram'])
                                <a href="{{ $settings['social_instagram'] }}" target="_blank"><i class="fab fa-instagram"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-auto">
                    <div class="widget widget_nav_menu footer-widget">
                        <h3 class="widget_title">Quick Links</h3>
                        <div class="menu-all-pages-container">
                            <ul class="menu">
                                @if(isset($footerMenu) && $footerMenu)
                                    @foreach($footerMenu->items->where('parent_id', null)->sortBy('order') as $item)
                                    <li>
                                        @if($item->type === 'page' && $item->page)
                                        <a href="{{ route('page.show', $item->page->slug) }}">{{ $item->label }}</a>
                                        @else
                                        <a href="{{ $item->url }}" {{ $item->target_blank ? 'target="_blank"' : '' }}>{{ $item->label }}</a>
                                        @endif
                                    </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-auto">
                    <div class="widget footer-widget">
                        <h3 class="widget_title">Contact Information</h3>
                        <div class="th-widget-contact">
                            @if(isset($settings['contact_address']) && $settings['contact_address'])
                            <div class="info-box_text">
                                <div class="icon"><i class="fas fa-location-dot"></i></div>
                                <div class="details">
                                    <p>{{ $settings['contact_address'] }}</p>
                                </div>
                            </div>
                            @endif
                            @if(isset($settings['contact_phone']) && $settings['contact_phone'])
                            <div class="info-box_text">
                                <div class="icon"><i class="fas fa-phone"></i></div>
                                <div class="details">
                                    <p><a href="tel:{{ $settings['contact_phone'] }}" class="info-box_link">{{ $settings['contact_phone'] }}</a></p>
                                </div>
                            </div>
                            @endif
                            @if(isset($settings['contact_email']) && $settings['contact_email'])
                            <div class="info-box_text">
                                <div class="icon"><i class="fas fa-envelope"></i></div>
                                <div class="details">
                                    <p><a href="mailto:{{ $settings['contact_email'] }}" class="info-box_link">{{ $settings['contact_email'] }}</a></p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-wrap">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-6">
                    <p class="copyright-text">
                        Copyright © {{ date('Y') }} <a href="{{ route('home') }}">{{ $settings['site_name'] ?? 'Government Website' }}</a>. All Rights Reserved.
                    </p>
                </div>
                <div class="col-md-6 text-end d-none d-md-block">
                    <div class="footer-links">
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms & Conditions</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Area End -->
