@extends(getTemplate().'.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/vendors/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/owl-carousel2/owl.carousel.min.css">
@endpush

@section('content')

    @if(!empty($heroSectionData))

        @if(!empty($heroSectionData['has_lottie']) and $heroSectionData['has_lottie'] == "1")
            @push('scripts_bottom')
                <script src="/assets/default/vendors/lottie/lottie-player.js"></script>
            @endpush
        @endif

        {{-- <section class="slider-container  {{ ($heroSection == "2") ? 'slider-hero-section2' : '' }}" style="background-image: url('{{ $heroSectionData['hero_background'] }}')"> --}}
        <section class="slider-container  {{ ($heroSection == "2") ? 'slider-hero-section2' : '' }}">

            @if($heroSection == "1")
                <div class="mask"></div>
            @endif

            <div class="container user-select-none">

                @if($heroSection == "2")
                    <div class="row slider-content align-items-center hero-section2 flex-column-reverse flex-md-row">
                        <div class="col-12 col-md-7 col-lg-6">
                            <h1 style="color: #000" class="font-weight-bold">{{ $heroSectionData['title'] }}</h1>
                            <p class="slide-hint text-gray mt-20">{!! nl2br($heroSectionData['description']) !!}</p>

                            {{-- <form action="/search" method="get" class="d-inline-flex mt-30 mt-lg-30 w-100">
                                <div class="form-group d-flex align-items-center m-0 slider-search p-10 bg-white w-100">
                                    <input type="text" name="search" class="form-control border-0 mr-lg-50" placeholder="{{ trans('home.slider_search_placeholder') }}"/>
                                    <button type="submit" class="btn btn-primary rounded-pill">{{ trans('home.find') }}</button>
                                </div>
                            </form> --}}
                            <button class="btn btn-primary heroButton">Learn now</button>
                        </div>
                        <div class="col-12 col-md-5 col-lg-6">
                            <img src="/assets/default/img/pilots.png" alt="{{ $heroSectionData['title'] }}" class="img-cover">
                        </div>
                    </div>
                @else
                    <div class="text-center slider-content">
                        <h1>{{ $heroSectionData['title'] }}</h1>
                        <div class="row h-100 align-items-center justify-content-center text-center">
                            <div class="col-12 col-md-9 col-lg-7">
                                <p class="mt-30 slide-hint">{!! nl2br($heroSectionData['description']) !!}</p>

                                <form action="/search" method="get" class="d-inline-flex mt-30 mt-lg-50 w-100">
                                    <div class="form-group d-flex align-items-center m-0 slider-search p-10 bg-white w-100">
                                        <input type="text" name="search" class="form-control border-0 mr-lg-50" placeholder="{{ trans('home.slider_search_placeholder') }}"/>
                                        <button type="submit" class="btn btn-primary rounded-pill">{{ trans('home.find') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    @endif

    <div class="container">
        <div class="academy-features">
            <div class="titles text-center" style="margin-bottom: 20px">
                <h2 class="custom-heading">Sky Academy Features</h2>
                <p class="custom-p">What our academy features and what we look for in the future.</p>
            </div>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <div class="text-boxes">
                    <div class="box">
                        <img src="/assets/default/img/icons/feature-icon-1.png" alt="">
                        <h6>Payment methods</h6>
                        <p>At Sky Academy, we relied on facilitating the payment process by using the most secure platforms, as well as on contracting with parties that allow beneficiaries to pay in installments.</p>
                    </div>
                    <div class="box">
                        <img src="/assets/default/img/icons/feature-icon-3.png" alt="">
                        <h6>Accreditations And Certificates</h6>
                        <p>At Sky Academy, we rely on contracting 
                        with the best international organizations
                        to provide strong accreditations acceptable
                        to local aviation legislators and airlines.</p>
                    </div>
                    <div class="box">
                        <img src="/assets/default/img/icons/feature-icon-2.png" alt="" style="width: 60px; height: 54px;">
                        <h6>Our Trainers</h6>
                        <p>At Sky Academy, we rely on selecting the most qualified trainers known in the aviation training sector and contracting with them to provide courses with world-class professional content and from accredited bodies.</p>
                    </div>
            </div>
        </div>
    </div>
    <div class="academy-partners text-center">
        <h2 class="custom-heading" style="padding-bottom: 30px">Our Partners</h2>
        <div class="row academy-clients-container">
            <div class=" client two columns"></div>
            <div class=" client two columns"></div>
            <div class=" client two columns"></div>
            <div class=" client two columns"></div>
            <div class=" client two columns"></div>
        </div>
  </div>

    @if(!empty($latestWebinars) and !$latestWebinars->isEmpty())
        <section class="home-sections home-sections-swiper container">
                <div class="text-center">
                    <h2 class="custom-heading">{{ trans('home.latest_classes') }}</h2>
                    <p class="custom-p">{{ trans('home.latest_webinars_hint') }}</p>
                </div>
            </div>
            <style>
                .swiper-container{
                    width: 80%;
                }
                @media (max-width: 320px) {
                    .swiper-container {
                        width: 100%;
                    }
                }
            </style>
            <div class="mt-10 position-relative">
                <div class="swiper-container latest-webinars-swiper px-12">
                    <div class="swiper-wrapper py-20">
                        @foreach($latestWebinars as $latestWebinar)
                            <div class="swiper-slide">
                                @include('web.default.includes.webinar.grid-card',['webinar' => $latestWebinar])
                            </div>
                        @endforeach

                    </div>
                </div>
<p>&nbsp;</p>
                <div style="display: flex;align-items: center;justify-content: center;">
                    
                    <a href="/classes?sort=newest" class="btn btn-primary heroButton">{{ trans('home.view_all') }}</a>
                </div>
<p>&nbsp;</p>
            </div>
        </section>
    @endif
  <div class="become-instructor">
    <div class="text-container-mobile mobile-display">
        <h3>Become Instructor</h3>
        <p>Register now and be our team fill the form and we will contact you.</p>
        <a href="/login" class="btn btn-primary heroButton bcm-instructor">Register</a>
    </div>
    <div class="layout-cont container">
    <div class="img-container">
        <div class="text-container desktop-display">
            <h3>Become Instructor</h3>
            <p>Register now and be our team fill the form and we will contact you.</p>
            <a href="/login" class="btn btn-primary heroButton bcm-instructor">Register</a>
        </div>
    </div>
    </div>
  </div>
  <div class="container">

    <div class="mobile-instructor">
        <h2 style="color: #fff;" class="custom-heading">Become Instructor</h2>
        <p>Register now and be our team fill the form and we will contact you.</p>
        <a href="/login" class="btn btn-primary heroButton bcm-instructor">Register</a>
    </div>
  </div>
  <div class="container" style="
    display: flex;
    align-items: center;
    justify-content: center;
">
       <section class="mt-30 mt-md-50 text-center contact-us-homepage-section">
            <h2 class="custom-heading">{{ trans('site.send_your_message_directly') }}</h2>
            <p class="custom-p">{{ trans('site.contact_subt') }}</p>

            @if(!empty(session()->has('msg')))
                <div class="alert alert-success my-25 d-flex align-items-center">
                    <i data-feather="check-square" width="50" height="50" class="mr-2"></i>
                    {{ session()->get('msg') }}
                </div>
            @endif

            <form action="/contact/store" method="post" class="mt-20">
                {{ csrf_field() }}

                        <div class="form-group">
                            <input type="text" name="name" placeholder="Name"  value="{{ old('name') }}" class="form-control @error('name')  is-invalid @enderror"/>
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" placeholder="Email address" value="{{ old('email') }}" class="form-control @error('email')  is-invalid @enderror"/>
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" name="phone" placeholder="Phone number" value="{{ old('phone') }}" class="form-control @error('phone')  is-invalid @enderror"/>
                            @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    {{-- <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label class="input-label font-weight-500">{{ trans('site.subject') }}</label>
                            <input type="text" name="subject" value="{{ old('subject') }}" class="form-control @error('subject')  is-invalid @enderror"/>
                            @error('subject')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div> --}}

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <textarea name="message" placeholder="Text here.." id="" rows="10" class="form-control @error('message')  is-invalid @enderror">{{ old('message') }}</textarea>
                            @error('message')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                    <button type="submit" style="width: 100%" class="btn btn-primary">{{ trans('site.send_message') }}</button>
            </form>
        </section>
  </div>

<div class="custom-testomonials mt-45">
    <h2 class="custom-heading">What our trainer says</h2>
    <p class="custom-p">Find what our student say about us</p>
    <p>&nbsp;</p>
    <div class="columns-container">
      <div class="column-boxes first">
        <div class="box">
          <i class="fa-regular fa-comment-dots"></i>
          <p>The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz,</p>
          <h6>Abdullah mohammed</h6>
        </div>
        <div class="box">
          <i class="fa-regular fa-comment-dots"></i>
          <p>The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs. Waltz, bad nymph, for quick jigs vex! Fox nymphs grab quick-jived waltz. Brick quiz whangs jumpy.</p>
          <h6>Abdullah mohammed</h6>
        </div>
      </div>
      <div class="column-boxes middle">
        <div class="box">
          <i class="fa-regular fa-comment-dots"></i>
          <p>The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs. Waltz, bad nymph, for quick jigs vex! Fox nymphs grab quick-jived waltz. Brick quiz whangs jumpy veldt fox. Bright vixens jump.</p>
          <p>&nbsp;</p>
          <h6>Abdullah mohammed</h6>
        </div>
        <div class="box">
          <i class="fa-regular fa-comment-dots"></i>
          <p>The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs. Waltz, bad nymph, for quick jigs vex! Fox nymphs grab quick-jived waltz.</p>
          <h6>Abdullah mohammed</h6>
        </div>
      </div>
      <div class="column-boxes first">
        <div class="box">
          <i class="fa-regular fa-comment-dots"></i>
          <p>The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs. Waltz, bad nymph, for quick jigs vex! Fox nymphs grab quick-jived waltz. Brick quiz whangs jumpy veldt fox. Bright vixens jump.The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs. Waltz, bad nymph, for quick jigs vex! Fox nymphs grab quick-jived waltz. Brick quiz whangs jumpy veldt fox. Bright vixens jump.The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs. Waltz, bad nymph, for quick jigs vex!</p>
          <h6>Abdullah mohammed</h6>
        </div>
      </div>
    </div>
  </div>
    

    {{-- @if(!empty($testimonials) and !$testimonials->isEmpty())
        <div class="position-relative testimonials-container">
            <section class="container home-sections home-sections-swiper">
                <div class="text-center">
                    <h2 class="section-title">{{ trans('home.testimonials') }}</h2>
                    <p class="section-hint">{{ trans('home.testimonials_hint') }}</p>
                </div>

                <div class="position-relative">
                    <div class="swiper-container testimonials-swiper px-12">
                        <div class="swiper-wrapper">
                            @foreach($testimonials as $testimonial)
                                <div class="swiper-slide">
                                    <div class="">
                                        <div class="">
                                            
                                            <i class="fa-regular fa-comment-dots"></i>
                                            <p class="mt-25 text-gray font-14">{!! nl2br($testimonial->comment) !!}</p>
                                            <h4 class="font-16 font-weight-bold text-secondary mt-30">{{ $testimonial->user_name }}</h4>
                                            <span class="d-block font-14 text-gray">{{ $testimonial->user_bio }}</span>
                                            @include('web.default.includes.webinar.rate',['rate' => $testimonial->rate, 'dontShowRate' => true])
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <div class="swiper-pagination testimonials-swiper-pagination"></div>
                    </div>
                </div>
            </section>
        </div>
    @endif --}}
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <div class="newslatter-home-section container">
        <div class="d-flex flex-column">
            <div class="p-2 text-container pb-30">
                <i class="fa-regular fa-comment-dots"></i>
                <h2 class="custom-heading">{{trans('Subscribe to our newsletter')}}</h2>
                <p class="custom-p">{{trans('Subscribe with our newsletter for a free courses')}}</p>
            </div>
            <div class="subscribe-input bg-white p-2 flex-grow-1 mt-30 mt-md-0" style="background: #FFFFFF 0% 0% no-repeat padding-box; box-shadow: 0px 4px 64px #13173D14;border-radius: 20px;">
                <form action="/newsletters" method="post">
                    {{ csrf_field() }}

                    <div class="form-group d-flex align-items-center m-0">
                        <div class="w-100">
                            <input type="text" name="newsletter_email" class="form-control border-0 @error('newsletter_email') is-invalid @enderror" placeholder="{{ trans('footer.enter_email_here') }}"/>
                            @error('newsletter_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" style="border-radius: 0 15px 15px 0">{{ trans('footer.join') }}</button>
                    </div>
                </form>
            </div>
        </div> 
  </div>

@endsection

@push('scripts_bottom')
    <script src="/assets/default/vendors/swiper/swiper-bundle.min.js"></script>
    <script src="/assets/default/vendors/owl-carousel2/owl.carousel.min.js"></script>
    <script src="/assets/default/js/parts/home.min.js"></script>
    <script src="/assets/default/vendors/parallax/parallax.min.js"></script>
    <script>
        $(document).ready(function () {
            for (var i = 1; i <= 6; i++) {
                new Parallax(document.getElementById('parallax' + i), {
                    relativeInput: true
                });
            }
        })
    </script>
@endpush
