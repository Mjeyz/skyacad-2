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

                            <form action="/search" method="get" class="d-inline-flex mt-30 mt-lg-30 w-100">
                                <div class="form-group d-flex align-items-center mt-45 slider-search p-10 bg-white w-100">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                    <input type="text" name="search" class="form-control border-0 mr-lg-50" placeholder="{{ trans('Search courses…') }}"/>
                                </div>
                            </form>
                            {{-- <a href="/classes?sort=newest"><button class="btn btn-primary heroButton">{{trans('Learn now')}}</button></a> --}}
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

                                <form action="/search" method="get" class="d-inline-flex mt-30 mt-lg-50 w-100 mb-lg-45">
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
                <h2 class="custom-heading">Sky Academy Features</h2>
                <p class="custom-p">What our academy features and what we look for in the future.</p>
           
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <div class="text-boxes mt-30">
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
    <div class="academy-partners">
        <div class="container">
            <h2 class="custom-heading  mb-45">Our Partners</h2>
        </div>
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
                <div class="mb-40">
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
                <div class="container mt-45">
                    <a href="/classes?sort=newest" class="btn btn-primary course-button">{{ trans('home.view_all') }}</a>
                </div>
<p>&nbsp;</p>
            </div>
        </section>
    @endif
  <div class="become-instructor">
    <div class="container">
        <h2 class="custom-heading">Become Instructor</h2>
        <p class="custom-p pt-10">Register now and be our team fill the form and we will contact you.</p>
        <a href="/login" class="btn btn-primary bcm-instructor mt-40">Register</a>
    </div>
  </div>
    <section class="container mt-30 pb-45 mt-md-50 contact-us-homepage-section">
        <div class="text-container mb-30">
            <h2 class="custom-heading">{{ trans('site.send_your_message_directly') }}</h2>
            <p class="custom-p">{{ trans('site.contact_subt') }}</p>
        </div>
        @if(!empty(session()->has('msg')))
            <div class="alert alert-success my-25 d-flex align-items-center">
                <i data-feather="check-square" width="50" height="50" class="mr-2"></i>
                {{ session()->get('msg') }}
            </div>
        @endif
        <div class="row mt-40">
            <div class="img-container col-md-5">
                <img src="/assets/default/img/HDR-featured-image-e1644397620392.png" alt="">
            </div>
            <div class="col-md-7">
                    <form action="/contact/store" method="post" class="mt-20">
                        {{ csrf_field() }}
                        <div class="d-flex flex-column">
                            <div class="">
                                <div class="form-group p-2">
                                    <input type="text" placeholder="{{ trans('site.your_name') }}" name="name" value="{{ old('name') }}" class="form-control @error('name')  is-invalid @enderror"/>
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group p-2">
                                    <input type="text" placeholder="{{ trans('public.email') }}" name="email" value="{{ old('email') }}" class="form-control @error('email')  is-invalid @enderror"/>
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group p-2">
                                    <input type="text" name="phone" placeholder="{{ trans('site.phone_number') }}" value="{{ old('phone') }}" class="form-control @error('phone')  is-invalid @enderror"/>
                                    @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group p-2" style="display: none" >
                                    <input type="text" placeholder="{{ trans('site.subject') }}" name="subject" value="New message from contact us " class="form-control @error('subject')  is-invalid @enderror"/>
                                    @error('subject')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group p-2">
                                    <textarea style=" margin-top: -16px; " name="message" placeholder="{{ trans('Your message here') }}" id="" rows="9" class="form-control @error('message')  is-invalid @enderror">{{ old('message') }}</textarea>
                                    @error('message')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            <button type="submit" class="btn btn-primary">{{ trans('site.send_message') }}</button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </section>
  

    <div class="custom-testomonials mt-45">
        <div class="container">
            <h2 class="custom-heading">What our trainer says</h2>
            <p class="custom-p">Find what our student say about us</p>
            <p>&nbsp;</p>
        </div>
        <div class="row">
            <div class="swiper-container testimonials-swiper px-12">
                <div class="swiper-wrapper">
                    @foreach($testimonials as $testimonial)
                        <div class="swiper-slide testmonial-box">
                            <i class="fa-regular fa-comment-dots mb-20"></i>
                            <h4 class="mb-10">{{ $testimonial->user_name }}</h4>
                            {{-- <span>{{ $testimonial->user_bio }}</span> --}}
                            <p>{!! nl2br($testimonial->comment) !!}</p>
                            {{-- @include('web.default.includes.webinar.rate',['rate' => $testimonial->rate, 'dontShowRate' => true]) --}}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
    </div>
    

    
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
