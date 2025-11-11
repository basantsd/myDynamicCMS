{{-- Contact Form Section --}}
<section class="contact-area space {{ $content['background_class'] ?? '' }}">
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
                <form action="{{ route('contact.submit') }}" method="POST" class="contact-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" class="form-control" name="name" placeholder="Your Name *" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="email" class="form-control" name="email" placeholder="Your Email *" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="tel" class="form-control" name="phone" placeholder="Phone Number">
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="text" class="form-control" name="subject" placeholder="Subject *" required>
                        </div>
                        <div class="col-12 form-group">
                            <textarea class="form-control" name="message" rows="6" placeholder="Your Message *" required></textarea>
                        </div>
                        <div class="col-12 form-group mb-0">
                            <button type="submit" class="th-btn">
                                Send Message <i class="fas fa-paper-plane ms-2"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
