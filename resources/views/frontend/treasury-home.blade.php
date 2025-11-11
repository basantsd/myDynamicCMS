@extends('frontend.layouts.treasury')

@section('title', 'Home - Accountant General\'s Department')

@section('content')
<!-- Hero Carousel -->
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <!-- Dots -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
    </div>

    <!-- Slides -->
    <div class="carousel-inner">
        <div class="carousel-item active" style="background-image: url('{{ asset('assets/img/hero/hero_bg_1_1.jpg') }}');">
            <div class="carousel-caption">
                <h1>Accountant General's Department</h1>
                <h5>Treasury Chambers - St. Kitts and Nevis</h5>
                <p>Serving the people with transparency, professionalism, and confidentiality.</p>
                <a href="#" class="btn btn-red">Our Services <i class="fas fa-arrow-right ms-2"></i></a>
                <a href="#" class="btn btn-outline-light">Learn More</a>
            </div>
        </div>

        <div class="carousel-item" style="background-image: url('{{ asset('assets/img/hero/hero_bg_1_1.jpg') }}');">
            <div class="carousel-caption">
                <h1>Professional Expertise</h1>
                <h5>Experience Excellence in Financial Management</h5>
                <p>Dedicated to efficient and effective management of Government financial operations.</p>
                <a href="#" class="btn btn-red">Our Services <i class="fas fa-arrow-right ms-2"></i></a>
                <a href="#" class="btn btn-outline-light">Learn More</a>
            </div>
        </div>

        <div class="carousel-item" style="background-image: url('{{ asset('assets/img/hero/hero_bg_1_1.jpg') }}');">
            <div class="carousel-caption">
                <h1>Financial Transparency</h1>
                <h5>Accountability and Trust</h5>
                <p>Access reports, budgets, and financial statements with complete transparency.</p>
                <a href="#" class="btn btn-red">Our Services <i class="fas fa-arrow-right ms-2"></i></a>
                <a href="#" class="btn btn-outline-light">Learn More</a>
            </div>
        </div>
    </div>

    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
    </button>
</div>

<!-- Core Values Section -->
<section class="core-values-section">
    <div class="container">
        <h2 class="section-title">Our Core Values</h2>
        <p class="section-subtitle">Guiding principles that define how we serve the people of St. Kitts and Nevis</p>
        <div class="row justify-content-center">
            <div class="col-md-4 mb-4">
                <div class="core-card">
                    <i class="fas fa-shield-alt"></i>
                    <h5>Transparency</h5>
                    <p>Open and clear communication in all financial operations and reporting</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="core-card">
                    <i class="fas fa-user-tie"></i>
                    <h5>Professionalism</h5>
                    <p>Delivering services with expertise, integrity, and the highest standards</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="core-card">
                    <i class="fas fa-user-shield"></i>
                    <h5>Confidentiality</h5>
                    <p>Protecting sensitive information with strict security and privacy measures</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Quick Access Section -->
<section class="quick-access-section">
    <div class="container">
        <h2 class="section-title">Quick Access</h2>
        <p class="section-subtitle">Access our key services and resources</p>
        <div class="row justify-content-center">
            <div class="col-md-4 mb-4">
                <div class="quick-card">
                    <h6>Pension Administration</h6>
                    <p>Access pension services, pay dates, and life certificates</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="quick-card">
                    <h6>Government Savings Bank</h6>
                    <p>2% interest rate per annum on your savings</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="quick-card">
                    <h6>Treasury Bills</h6>
                    <p>Short term investment opportunities with competitive returns</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission Section -->
<section class="mission-section">
    <div class="container text-center">
        <h2 class="section-title">Our Mission</h2>
        <p class="mission-text">
            To ensure efficient and effective managing and reporting of Government's financial operations,
            in order to support and foster the achievements of the Government's goals and objectives with
            the highest level of proficiency, confidentiality and professionalism with the support of a
            well-trained and highly motivated staff.
        </p>
    </div>
</section>
@endsection
