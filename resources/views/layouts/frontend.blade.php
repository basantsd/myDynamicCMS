<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>@yield('title', $settings['site_name'] ?? 'Accountant General\'s Department Government Of St. Kitts Nevis')</title>
    <meta name="author" content="vecuro" />
    <meta name="description" content="@yield('meta_description', $settings['meta_description'] ?? 'Accountant General\'s Department')" />
    <meta name="keywords" content="@yield('meta_keywords', $settings['meta_keywords'] ?? 'Accountant General\'s Department')" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Fonts -->
    <link href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@400;500;600;700&family=Fira+Sans:wght@400;500&display=swap" rel="stylesheet" />

    <!-- Favicon -->
    @if(isset($settings['site_favicon']) && $settings['site_favicon'])
    <link rel="icon" href="{{ asset('storage/' . $settings['site_favicon']) }}" />
    @else
    <link rel="icon" href="{{ asset('assets/img/favicon.jpg') }}" />
    @endif

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/layerslider.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/slick.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

    @stack('styles')
</head>
<body>
    <!-- Mobile Menu -->
    @include('components.mobile-menu')

    <!-- Header -->
    @include('components.header')

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    @include('components.footer')

    <!-- Scroll To Top -->
    <a href="#" class="scrollToTop scroll-btn"><i class="far fa-arrow-up"></i></a>

    <!-- JavaScript -->
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

    @stack('scripts')
</body>
</html>
