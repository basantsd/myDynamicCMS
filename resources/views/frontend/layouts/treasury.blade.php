<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>@yield('title', 'Accountant General\'s Department Government Of St. Kitts Nevis')</title>
    <meta name="author" content="vecuro" />
    <meta name="description" content="@yield('meta_description', 'Accountant General\'s Department')" />
    <meta name="keywords" content="@yield('meta_keywords', 'Accountant General\'s Department')" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Fonts and Icons -->
    <link href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@400;500;600;700&family=Fira+Sans:wght@400;500&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@500&display=swap" rel="stylesheet" />

    <link rel="icon" href="{{ asset('assets/img/fav.jpg') }}" />

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/layerslider.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/slick.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

    @stack('styles')
</head>
<body>
    <!--==============================
        Mobile Menu
    ============================== -->
    <div class="vs-menu-wrapper">
        <div class="vs-menu-area text-center">
            <button class="vs-menu-toggle"><i class="fal fa-times"></i></button>
            <div class="mobile-logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Logo" class="logo" />
                </a>
            </div>
            <div class="vs-mobile-menu">
                @php
                    $mobileMenu = \App\Models\Menu::where('location', 'mobile')->first();
                @endphp
                @if($mobileMenu)
                <ul>
                    @foreach($mobileMenu->items as $item)
                    <li class="{{ $item->children->count() > 0 ? 'menu-item-has-children' : '' }}">
                        <a href="{{ $item->page_id ? url($item->page->slug) : ($item->url ?? '#') }}">
                            {{ $item->label }}
                        </a>
                        @if($item->children->count() > 0)
                        <ul class="sub-menu">
                            @foreach($item->children as $child)
                            <li>
                                <a href="{{ $child->page_id ? url($child->page->slug) : ($child->url ?? '#') }}">
                                    {{ $child->label }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
    </div>

    <!--==============================
        Header Area
    ==============================-->
    <header class="vs-header header-layout1">
        <div class="container">
            <div class="menu-top">
                <div class="row justify-content-between align-items-center gx-sm-0">
                    <div class="col-lg-12 d-flex justify-content-between align-items-center">
                        <div class="col"></div>
                        <div class="col">
                            <div class="header-logo">
                                <a href="{{ url('/') }}">
                                    <img src="{{ asset('assets/img/logo1.png') }}" alt="Logo" class="logo" />
                                </a>
                                <br />
                            </div>
                        </div>
                        <div class="col head-left">
                            <div class="topbar-one__right">
                                <a href="#" class="topbar-one__guide-btn" id="btn-increase" title="Increase font size">+A</a>
                                <a href="#" class="topbar-one__guide-btn" id="btn-origs" title="Reset font size">A</a>
                                <a href="#" class="topbar-one__guide-btn" id="btn-decrease" title="Decrease font size">-A</a>
                            </div>
                            <div class="js">
                                <div class="language-picker js-language-picker" data-trigger-class="btn btn--subtle">
                                    <form action="" class="language-picker__form">
                                        <label for="language-picker-select">Select your language</label>
                                        <select name="language-picker-select" id="language-picker-select">
                                            <option lang="de" value="deutsch">Deutsch</option>
                                            <option lang="en" value="english" selected>English</option>
                                            <option lang="fr" value="francais">Français</option>
                                            <option lang="it" value="italiano">Italiano</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Menu Area -->
        <div class="sticky-wrapper">
            <div class="sticky-active">
                <div class="container">
                    <div class="row custom-bdr align-items-center justify-content-between">
                        <div class="col-7 d-inline-block d-lg-none">
                            <img src="{{ asset('assets/img/logo1.png') }}" alt="Logo" class="logo" />
                        </div>
                        <div class="col-lg-12 col-3">
                            <nav class="main-menu new-menu menu-style1 d-none d-lg-block">
                                @php
                                    $headerMenu = \App\Models\Menu::where('location', 'header')->first();
                                @endphp
                                @if($headerMenu)
                                <ul>
                                    @foreach($headerMenu->items as $item)
                                    <li class="{{ $item->children->count() > 0 ? 'menu-item-has-children' : '' }}">
                                        <a href="{{ $item->page_id ? url($item->page->slug) : ($item->url ?? '#') }}">
                                            {{ $item->label }}
                                        </a>
                                        @if($item->children->count() > 0)
                                        <ul class="sub-menu">
                                            @foreach($item->children as $child)
                                            <li>
                                                <a href="{{ $child->page_id ? url($child->page->slug) : ($child->url ?? '#') }}">
                                                    {{ $child->label }}
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </nav>
                            <button class="vs-menu-toggle d-inline-block d-lg-none">
                                <i class="fal fa-bars"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    @yield('content')

    <!-- ========== FOOTER SECTION ========== -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <!-- Contact Us -->
                <div class="col-md-3 mb-4 cont-fot">
                    <h6>Contact Us</h6>
                    <p class="d-flex">
                        <span><i class="fas fa-phone-alt"></i></span>
                        <span>
                            Treasury Chambers<br>
                            Ministry of Finance<br>
                            Basseterre, St. Kitts<br>
                        </span>
                    </p>
                    <p>
                        <i class="fas fa-phone-alt"></i> +1 (869) 467-1293<br>
                        <i class="fas fa-envelope"></i> info@skntreasury.gov.kn
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="col-md-3 mb-4">
                    <h6>Quick Links</h6>
                    @php
                        $quickLinksMenu = \App\Models\Menu::where('location', 'footer-quick-links')->first();
                    @endphp
                    @if($quickLinksMenu)
                        @foreach($quickLinksMenu->allItems as $item)
                        <a href="{{ $item->page_id ? url($item->page->slug) : ($item->url ?? '#') }}">
                            {{ $item->label }}
                        </a>
                        @endforeach
                    @endif
                </div>

                <!-- Legal -->
                <div class="col-md-3 mb-4">
                    <h6>Legal</h6>
                    @php
                        $legalMenu = \App\Models\Menu::where('location', 'footer-legal')->first();
                    @endphp
                    @if($legalMenu)
                        @foreach($legalMenu->allItems as $item)
                        <a href="{{ $item->page_id ? url($item->page->slug) : ($item->url ?? '#') }}">
                            {{ $item->label }}
                        </a>
                        @endforeach
                    @endif
                </div>

                <!-- Related Links -->
                <div class="col-md-3 mb-4 cont-link">
                    <h6>Related Links</h6>
                    @php
                        $relatedLinksMenu = \App\Models\Menu::where('location', 'footer-related-links')->first();
                    @endphp
                    @if($relatedLinksMenu)
                        @foreach($relatedLinksMenu->allItems as $item)
                        <a href="{{ $item->url ?? '#' }}" {{ $item->target_blank ? 'target="_blank"' : '' }}>
                            {{ $item->label }}
                            @if($item->target_blank)
                            <i class="fa fa-external-link" aria-hidden="true"></i>
                            @endif
                        </a>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="footer-bottom">
                © {{ date('Y') }} Government of St. Kitts and Nevis - Accountant General's Department. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Scroll To Top -->
    <a href="#" class="scrollToTop scroll-btn">
        <i class="far fa-arrow-up"></i>
    </a>

    <!--==============================
        All Js File
    ============================== -->
    <script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/layerslider.utils.js') }}"></script>
    <script src="{{ asset('assets/js/layerslider.transitions.js') }}"></script>
    <script src="{{ asset('assets/js/layerslider.kreaturamedia.jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- News Ticker Script -->
    <script>
        jQuery.fn.liScroll = function(settings) {
            settings = jQuery.extend({
                travelocity: 0.02
            }, settings);
            return this.each(function() {
                var $strip = jQuery(this);
                $strip.addClass('newsticker');
                var stripHeight = 1;
                $strip.find('li').each(function(i) {
                    stripHeight += jQuery(this, i).outerHeight(true);
                });
                var $mask = $strip.wrap("<div class='mask'></div>");
                var $tickercontainer = $strip.parent().wrap("<div class='tickercontainer'></div>");
                var containerHeight = $strip.parent().parent().height();
                $strip.height(stripHeight);
                var totalTravel = stripHeight;
                var defTiming = totalTravel / settings.travelocity;

                function scrollnews(spazio, tempo) {
                    $strip.animate({
                        top: '-=' + spazio
                    }, tempo, 'linear', function() {
                        $strip.css('top', containerHeight);
                        scrollnews(totalTravel, defTiming);
                    });
                }
                scrollnews(totalTravel, defTiming);
                $strip.hover(
                    function() {
                        jQuery(this).stop();
                    },
                    function() {
                        var offset = jQuery(this).offset();
                        var residualSpace = offset.top + stripHeight;
                        var residualTime = residualSpace / settings.travelocity;
                        scrollnews(residualSpace, residualTime);
                    }
                );
            });
        };

        $(function() {
            $('ul#news-alerts').liScroll();
        });
    </script>

    @stack('scripts')
</body>
</html>
