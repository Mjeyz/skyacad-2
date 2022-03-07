@extends(getTemplate().'.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/css/css-stars.css">
    <link rel="stylesheet" href="/assets/default/vendors/video/video-js.min.css">
@endpush


@section('content')
    <div class="container mt-50">
        <h2 class="custom-heading">{{trans('Course checkout')}}</h2>
        <div class="row mt-30">
            <div class="col-md-4">
                <div class="course-card-buy-page">
                    <img src="{{ $course->getImage() }}" alt="">
                    <div class="text-data">
                        @if(!empty($course->category))
                            <span class="d-block font-14 mt-10 pb-10"> <a href="{{ $course->category->getUrl() }}" target="_blank" class="home-course-category">{{ $course->category->title }}</a></span>
                        @endif
                        <script>
                        </script>
                        <h3>{{ $course->title }}</h3>
                        @if($course->price > 0)
                                    <span id="realPrice" data-value="{{ $course->price }}"
                                          data-special-offer="{{ !empty($activeSpecialOffer) ? $activeSpecialOffer->percent : ''}}"
                                          style="font-size: 20px"
                                          class="pb-10 @if(!empty($activeSpecialOffer)) text-gray text-decoration-line-through mr-15 @else text-primary @endif">{{ $currency }}{{ number_format($course->price,2) }}</span>
                                    <span style="font-size: 20px" id="priceWithDiscount" class="text-primary">{{ !empty($activeSpecialOffer) ? ($currency.number_format($course->price - ($course->price * $activeSpecialOffer->percent / 100),2)) : '' }}</span>
                            @else
                                    <span style="pb-10 font-size: 20px" class="text-primary">{{ trans('public.free') }}</span>
                            @endif
                        <p> {{trans('public.course_card_desc')}} </p>
                        <form action="/cart/store" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="webinar_id" value="{{ $course->id }}">
                            @php
                                $userHasBought = $course->checkUserHasBought();
                                $canSale = ($course->canSale() and !$userHasBought);
                            @endphp

                            <div class="mt-20 d-flex flex-column">
                                @if($course->price > 0)
                                    <button type="{{ $canSale ? 'submit' : 'button' }}" @if(!$canSale) disabled @endif class="btn btn-primary course-card-button">
                                        @if($userHasBought)
                                            {{ trans('panel.purchased') }}
                                        @else
                                            {{ trans('public.add_to_cart') }}
                                        @endif
                                    </button>
                                    {{--  --}}
                                @else
                                    <a href="{{ $canSale ? '/course/'. $course->slug .'/free' : '#' }}" class="btn btn-primary course-card-button @if(!$canSale) disabled @endif">{{ trans('public.enroll_on_webinar') }}</a>
                                @endif
                            </div>

                </form>
                        
                    </div>
                </div>
                <div class="cart-button-go mt-30">
                    <a href="/cart" id="reveal" class="btn btn-primary btn-lg btn-block">Go to cart</a>
                </div>
            </div>
            <div class="col-md-8">
                 @if(!empty($course->category))
                    <span class="d-block course-buy-page-rating mt-10 pb-10"> <a href="{{ $course->category->getUrl() }}" target="_blank" class="home-course-category">{{ $course->category->title }}</a></span>
                @endif
                <h3 class="course-buy-page-heading">{{ $course->title }}</h3>
                @if($course->price > 0)
                    <span id="realPrice" data-value="{{ $course->price }}"
                        data-special-offer="{{ !empty($activeSpecialOffer) ? $activeSpecialOffer->percent : ''}}"
                        class="course-buy-page-price pb-10 @if(!empty($activeSpecialOffer)) text-gray text-decoration-line-through mr-15 @else text-primary @endif">{{ $currency }}{{ number_format($course->price,2) }}</span>
                    <span style="font-size: 20px" id="priceWithDiscount" class="text-primary">{{ !empty($activeSpecialOffer) ? ($currency.number_format($course->price - ($course->price * $activeSpecialOffer->percent / 100),2)) : '' }}</span>
                @else
                    <span class="course-buy-page-price text-primary">{{ trans('public.free') }}</span>
                @endif
                @if($course->description)
                    <div class="mt-20 mb-40">
                        <p class="mt-15 course-buy-page-desc">
                            {!! $course->description !!}
                        </p>
                    </div>
                @endif

                <div class="row mt-10 mb-40 ">
                    <div class="col-md-4">
                        <div class="mt-20 d-flex align-items-center justify-content-between text-gray">
                            <div class="d-flex align-items-center">
                                {{-- <i data-feather="clock" width="20" height="20"></i> --}}
                                <span class="course-buy-page-bold ml-5 ">{{ trans('public.duration') }}:</span>
                            </div>
                            <span class="course-buy-page-next-p">{{ convertMinutesToHourAndMinute(!empty($course->duration) ? $course->duration : 0) }} {{ trans('home.hours') }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mt-20 d-flex align-items-center justify-content-between text-gray">
                            <div class="d-flex align-items-center">
                                {{-- <i data-feather="clock" width="20" height="20"></i> --}}
                                <span class="ml-5 course-buy-page-bold ">{{ trans('Location') }}:</span>
                            </div>
                            <span class="course-buy-page-next-p">{{ trans('Riyadh') }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mt-20 d-flex align-items-center justify-content-between text-gray">
                            <div class="d-flex align-items-center">
                                {{-- <i data-feather="users" width="20" height="20"></i> --}}
                                <span class="ml-5 course-buy-page-bold ">{{ trans('Trainer') }}:</span>
                            </div>
                            <span class="course-buy-page-next-p">{{ $course->sales_count }} {{ trans('quiz.students') }}</span>
                        </div>
                    </div>
                </div>
                
                <h4 style="font: normal normal bold 20px/24px Ubuntu; letter-spacing: 0px; color: #5C5D5C;" class="mb-20"> {{trans('Approved by')}} </h4>
                <div class="row">
                    <div class="col-md-3">
                        <img src="/assets/default/img/Image-105.png" alt="">
                    </div>
                    <div class="col-md-3">
                        <img style="height: 32px" src="/assets/default/img/Image-106.png" alt="">
                    </div>
                    <div class="col-md-3">
                        <img src="/assets/default/img/Image-107.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-50">
        <h2 class="custom-heading mt-50 mb-20"> {{trans('Course you may like')}} </h2>
        <div class="row mt-20">
            <div class="col-md-4">
                <div class="course-card-buy-page">
                    <img src="{{ $course->getImage() }}" alt="">
                    <div class="text-data">
                        @if(!empty($course->category))
                            <span class="d-block font-14 mt-10 pb-10"> <a href="{{ $course->category->getUrl() }}" target="_blank" class="home-course-category">{{ $course->category->title }}</a></span>
                        @endif
                        <h3>{{ $course->title }}</h3>
                        @if($course->price > 0)
                                    <span id="realPrice" data-value="{{ $course->price }}"
                                          data-special-offer="{{ !empty($activeSpecialOffer) ? $activeSpecialOffer->percent : ''}}"
                                          style="font-size: 20px"
                                          class="pb-10 @if(!empty($activeSpecialOffer)) text-gray text-decoration-line-through mr-15 @else text-primary @endif">{{ $currency }}{{ number_format($course->price,2) }}</span>
                                    <span style="font-size: 20px" id="priceWithDiscount" class="text-primary">{{ !empty($activeSpecialOffer) ? ($currency.number_format($course->price - ($course->price * $activeSpecialOffer->percent / 100),2)) : '' }}</span>
                            @else
                                    <span style="pb-10 font-size: 20px" class="text-primary">{{ trans('public.free') }}</span>
                            @endif
                        <p> {{trans('public.course_card_desc')}} </p>
                        <div class="mt-20 d-flex flex-column">
                            @if($course->price > 0)
                                <button type="{{ $canSale ? 'submit' : 'button' }}" @if(!$canSale) disabled @endif class="btn btn-primary course-card-button">
                                    @if($userHasBought)
                                        {{ trans('panel.purchased') }}
                                    @else
                                        {{ trans('public.add_to_cart') }}
                                    @endif
                                </button>

                                {{-- @if($canSale and $course->subscribe)
                                    <a href="{{ $canSale ? '/subscribes/apply/'. $course->slug : '#' }}" class="btn btn-outline-primary btn-subscribe mt-20 @if(!$canSale) disabled @endif">{{ trans('public.subscribe') }}</a>
                                @endif --}}
                            @else
                                <a href="{{ $canSale ? '/course/'. $course->slug .'/free' : '#' }}" class="btn btn-primary course-card-button @if(!$canSale) disabled @endif">{{ trans('public.enroll_on_webinar') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
                <style>
                    .reveal{
                        display: none
                    }
                </style>
                
            </div>
            <div class="col-md-4">
                <div class="course-card-buy-page">
                    <img src="{{ $course->getImage() }}" alt="">
                    <div class="text-data">
                        @if(!empty($course->category))
                            <span class="d-block font-14 mt-10 pb-10"> <a href="{{ $course->category->getUrl() }}" target="_blank" class="home-course-category">{{ $course->category->title }}</a></span>
                        @endif
                        <script>
                        </script>
                        <h3>{{ $course->title }}</h3>
                        @if($course->price > 0)
                                    <span id="realPrice" data-value="{{ $course->price }}"
                                          data-special-offer="{{ !empty($activeSpecialOffer) ? $activeSpecialOffer->percent : ''}}"
                                          style="font-size: 20px"
                                          class="pb-10 @if(!empty($activeSpecialOffer)) text-gray text-decoration-line-through mr-15 @else text-primary @endif">{{ $currency }}{{ number_format($course->price,2) }}</span>
                                    <span style="font-size: 20px" id="priceWithDiscount" class="text-primary">{{ !empty($activeSpecialOffer) ? ($currency.number_format($course->price - ($course->price * $activeSpecialOffer->percent / 100),2)) : '' }}</span>
                            @else
                                    <span style="pb-10 font-size: 20px" class="text-primary">{{ trans('public.free') }}</span>
                            @endif
                        <p> {{trans('public.course_card_desc')}} </p>
                        <form action="/cart/store" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="webinar_id" value="{{ $course->id }}">
                            @php
                                $userHasBought = $course->checkUserHasBought();
                                $canSale = ($course->canSale() and !$userHasBought);
                            @endphp

                            <div class="mt-20 d-flex flex-column">
                                @if($course->price > 0)
                                    <button type="{{ $canSale ? 'submit' : 'button' }}" @if(!$canSale) disabled @endif class="btn btn-primary course-card-button">
                                        @if($userHasBought)
                                            {{ trans('panel.purchased') }}
                                        @else
                                            {{ trans('public.add_to_cart') }}
                                        @endif
                                    </button>

                                    {{-- @if($canSale and $course->subscribe)
                                        <a href="{{ $canSale ? '/subscribes/apply/'. $course->slug : '#' }}" class="btn btn-outline-primary btn-subscribe mt-20 @if(!$canSale) disabled @endif">{{ trans('public.subscribe') }}</a>
                                    @endif --}}
                                @else
                                    <a href="{{ $canSale ? '/course/'. $course->slug .'/free' : '#' }}" class="btn btn-primary course-card-button @if(!$canSale) disabled @endif">{{ trans('public.enroll_on_webinar') }}</a>
                                @endif
                            </div>

                </form>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="course-card-buy-page">
                    <img src="{{ $course->getImage() }}" alt="">
                    <div class="text-data">
                        @if(!empty($course->category))
                            <span class="d-block font-14 mt-10 pb-10"> <a href="{{ $course->category->getUrl() }}" target="_blank" class="home-course-category">{{ $course->category->title }}</a></span>
                        @endif
                        <script>
                        </script>
                        <h3>{{ $course->title }}</h3>
                        @if($course->price > 0)
                                    <span id="realPrice" data-value="{{ $course->price }}"
                                          data-special-offer="{{ !empty($activeSpecialOffer) ? $activeSpecialOffer->percent : ''}}"
                                          style="font-size: 20px"
                                          class="pb-10 @if(!empty($activeSpecialOffer)) text-gray text-decoration-line-through mr-15 @else text-primary @endif">{{ $currency }}{{ number_format($course->price,2) }}</span>
                                    <span style="font-size: 20px" id="priceWithDiscount" class="text-primary">{{ !empty($activeSpecialOffer) ? ($currency.number_format($course->price - ($course->price * $activeSpecialOffer->percent / 100),2)) : '' }}</span>
                            @else
                                    <span style="pb-10 font-size: 20px" class="text-primary">{{ trans('public.free') }}</span>
                            @endif
                        <p> {{trans('public.course_card_desc')}} </p>
                        <form action="/cart/store" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="webinar_id" value="{{ $course->id }}">
                            @php
                                $userHasBought = $course->checkUserHasBought();
                                $canSale = ($course->canSale() and !$userHasBought);
                            @endphp

                            <div class="mt-20 d-flex flex-column">
                                @if($course->price > 0)
                                    <button type="{{ $canSale ? 'submit' : 'button' }}" @if(!$canSale) disabled @endif class="btn btn-primary course-card-button">
                                        @if($userHasBought)
                                            {{ trans('panel.purchased') }}
                                        @else
                                            {{ trans('public.add_to_cart') }}
                                        @endif
                                    </button>

                                    {{-- @if($canSale and $course->subscribe)
                                        <a href="{{ $canSale ? '/subscribes/apply/'. $course->slug : '#' }}" class="btn btn-outline-primary btn-subscribe mt-20 @if(!$canSale) disabled @endif">{{ trans('public.subscribe') }}</a>
                                    @endif --}}
                                @else
                                    <a href="{{ $canSale ? '/course/'. $course->slug .'/free' : '#' }}" class="btn btn-primary course-card-button @if(!$canSale) disabled @endif">{{ trans('public.enroll_on_webinar') }}</a>
                                @endif
                            </div>

                </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <section class="course-cover-container ">
        <img src="{{ $course->getImageCover() }}" class="img-cover course-cover-img" alt="{{ $course->title }}"/>
        <div class="cover-content pt-40">
            <div class="container position-relative">
                @if(!empty($activeSpecialOffer))
                    <div class="d-flex align-items-center justify-content-between rounded-lg shadow-xs bg-white p-30">
                        <div class="d-flex flex-column">
                            <strong class="font-16 text-dark-blue font-weight-bold">{{ trans('panel.special_offer') }}</strong>
                            <span class="font-14 text-gray">{{ $activeSpecialOffer->name }}</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </section> --}}

    {{-- <section class="container course-content-section">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="course-content-body user-select-none">
                    <div class="course-body-on-cover text-white">
                        <h1 class="font-30 course-title">
                            {{ $course->title }}
                        </h1>
                        <span class="d-block font-16 mt-10"> <a href="{{ $course->category->getUrl() }}" target="_blank" class="font-weight-500 text-decoration-underline text-white">{{ $course->category->title }}</a></span>

                        <div class="d-flex align-items-center">
                            @include('web.default.includes.webinar.rate',['rate' => $course->getRate()])
                            <span class="ml-10 mt-15 font-14">({{ $course->reviews->pluck('creator_id')->count() }} {{ trans('public.ratings') }})</span>
                        </div>

                        <div class="mt-15">
                            <span class="font-14">{{ trans('public.created_by') }}</span>
                            <a href="{{ $course->teacher->getProfileUrl() }}" target="_blank" class="text-decoration-underline text-white font-14 font-weight-500">{{ $course->teacher->full_name }}</a>
                        </div>

                        @if($hasBought or $course->isWebinar())
                            @php
                                $percent = $course->getProgress();
                            @endphp

                            <div class="mt-30 d-flex align-items-center">
                                <div class="progress course-progress flex-grow-1 shadow-xs rounded-sm">
                                    <span class="progress-bar rounded-sm bg-warning" style="width: {{ $percent }}%"></span>
                                </div>

                                <span class="ml-15 font-14 font-weight-500">
                                    @if($course->isWebinar())
                                        @if($hasBought and $course->isProgressing())
                                            {{ trans('public.course_learning_passed',['percent' => $percent]) }}
                                        @else
                                            {{ $course->sales_count }}/{{ $course->capacity }} {{ trans('quiz.students') }}
                                        @endif
                                    @else
                                        {{ trans('public.course_learning_passed',['percent' => $percent]) }}
                                    @endif
                            </span>
                            </div>
                        @endif
                    </div>

                    <div class="@if(!$course->isCourse()) mt-35 @else mt-40 pt-40 @endif">
                        <ul class="nav nav-tabs bg-secondary rounded-sm p-15 d-flex align-items-center justify-content-between" id="tabs-tab" role="tablist">
                            <li class="nav-item">
                                <a class="position-relative font-14 text-white {{ (empty(request()->get('tab','')) or request()->get('tab','') == 'information') ? 'active' : '' }}" id="information-tab"
                                   data-toggle="tab" href="#information" role="tab" aria-controls="information"
                                   aria-selected="true">{{ trans('product.information') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="position-relative font-14 text-white {{ (request()->get('tab','') == 'content') ? 'active' : '' }}" id="content-tab" data-toggle="tab"
                                   href="#content" role="tab" aria-controls="content"
                                   aria-selected="false">{{ trans('product.content') }} ({{ $webinarContentCount }})</a>
                            </li>
                            <li class="nav-item">
                                <a class="position-relative font-14 text-white {{ (request()->get('tab','') == 'reviews') ? 'active' : '' }}" id="reviews-tab" data-toggle="tab"
                                   href="#reviews" role="tab" aria-controls="reviews"
                                   aria-selected="false">{{ trans('product.reviews') }} ({{ $course->reviews->count() > 0 ? $course->reviews->pluck('creator_id')->count() : 0 }})</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade {{ (empty(request()->get('tab','')) or request()->get('tab','') == 'information') ? 'show active' : '' }} " id="information" role="tabpanel"
                                 aria-labelledby="information-tab">
                                @include(getTemplate().'.course.tabs.information')
                            </div>
                            <div class="tab-pane fade {{ (request()->get('tab','') == 'content') ? 'show active' : '' }}" id="content" role="tabpanel" aria-labelledby="content-tab">
                                @include(getTemplate().'.course.tabs.content')
                            </div>
                            <div class="tab-pane fade {{ (request()->get('tab','') == 'reviews') ? 'show active' : '' }}" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                @include(getTemplate().'.course.tabs.reviews')
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="course-content-sidebar col-12 col-lg-4 mt-25 mt-lg-0">
                <div class="rounded-lg shadow-sm">
                    <div class="course-img {{ $course->video_demo ? 'has-video' :'' }}">

                        <img src="{{ $course->getImage() }}" class="img-cover" alt="">

                        @if($course->video_demo)
                            <div id="webinarDemoVideoBtn"
                                 data-video-path="{{ config('app_url') . $course->video_demo }}"
                                 data-video-type="video/mp4"
                                 class="course-video-icon cursor-pointer d-flex align-items-center justify-content-center">
                                <i data-feather="play" width="25" height="25"></i>
                            </div>
                        @endif
                    </div>

                    <div class="px-20 pb-30">
                        <form action="/cart/store" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="webinar_id" value="{{ $course->id }}">

                            @if(!empty($course->tickets))
                                @foreach($course->tickets as $ticket)

                                    <div class="form-check mt-20">
                                        <input class="form-check-input" @if(!$ticket->isValid()) disabled @endif type="radio" data-discount="{{ $ticket->discount }}" value="{{ ($ticket->isValid()) ? $ticket->id : '' }}"
                                               name="ticket_id"
                                               id="courseOff{{ $ticket->id }}">
                                        <label class="form-check-label d-flex flex-column cursor-pointer" for="courseOff{{ $ticket->id }}">
                                            <span class="font-16 font-weight-500 text-dark-blue">{{ $ticket->title }} @if(!empty($ticket->discount)) ({{ $ticket->discount }}% {{ trans('public.off') }}) @endif</span>
                                            <span class="font-14 text-gray">{{ $ticket->getSubTitle() }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            @endif

                            @if($course->price > 0)
                                <div id="priceBox" class="d-flex align-items-center justify-content-center mt-20">
                                    <span id="realPrice" data-value="{{ $course->price }}"
                                          data-special-offer="{{ !empty($activeSpecialOffer) ? $activeSpecialOffer->percent : ''}}"
                                          class="@if(!empty($activeSpecialOffer)) font-16 text-gray text-decoration-line-through mr-15 @else font-30 text-primary @endif">{{ $currency }}{{ number_format($course->price,2) }}</span>
                                    <span id="priceWithDiscount" class="font-36 text-primary">{{ !empty($activeSpecialOffer) ? ($currency.number_format($course->price - ($course->price * $activeSpecialOffer->percent / 100),2)) : '' }}</span>
                                </div>
                            @else
                                <div class="d-flex align-items-center justify-content-center mt-20">
                                    <span class="font-36 text-primary">{{ trans('public.free') }}</span>
                                </div>
                            @endif

                            @php
                                $userHasBought = $course->checkUserHasBought();
                                $canSale = ($course->canSale() and !$userHasBought);
                            @endphp

                            <div class="mt-20 d-flex flex-column">
                                @if($course->price > 0)
                                    <button type="{{ $canSale ? 'submit' : 'button' }}" @if(!$canSale) disabled @endif class="btn btn-primary">
                                        @if($userHasBought)
                                            {{ trans('panel.purchased') }}
                                        @else
                                            {{ trans('public.add_to_cart') }}
                                        @endif
                                    </button>

                                    @if($canSale and $course->subscribe)
                                        <a href="{{ $canSale ? '/subscribes/apply/'. $course->slug : '#' }}" class="btn btn-outline-primary btn-subscribe mt-20 @if(!$canSale) disabled @endif">{{ trans('public.subscribe') }}</a>
                                    @endif
                                @else
                                    <a href="{{ $canSale ? '/course/'. $course->slug .'/free' : '#' }}" class="btn btn-primary @if(!$canSale) disabled @endif">{{ trans('public.enroll_on_webinar') }}</a>
                                @endif
                            </div>

                        </form>

                        <div class="mt-20 d-flex align-items-center justify-content-center text-gray">
                            <i data-feather="thumbs-up" width="20" height="20"></i>
                            <span class="ml-5 font-14">{{ trans('product.guarantee_text') }}</span>
                        </div>

                        <div class="mt-35">
                            <strong class="d-block text-secondary font-weight-bold">{{ trans('webinars.this_webinar_includes',['classes' => trans('webinars.'.$course->type)]) }}</strong>
                            @if($course->files->count() > 0)
                                <div class="mt-20 d-flex align-items-center text-gray">
                                    <i data-feather="download-cloud" width="20" height="20"></i>
                                    <span class="ml-5 font-14 font-weight-500">{{ trans('webinars.downloadable_content') }}</span>
                                </div>
                            @endif
                            @if($course->quizzes->where('certificate', 1)->count() > 0)
                                <div class="mt-20 d-flex align-items-center text-gray">
                                    <i data-feather="award" width="20" height="20"></i>
                                    <span class="ml-5 font-14 font-weight-500">{{ trans('webinars.official_certificate') }}</span>
                                </div>
                            @endif

                            @if($course->quizzes->where('status', \App\models\Quiz::ACTIVE)->count() > 0)
                                <div class="mt-20 d-flex align-items-center text-gray">
                                    <i data-feather="file-text" width="20" height="20"></i>
                                    <span class="ml-5 font-14 font-weight-500">{{ trans('webinars.online_quizzes_count',['quiz_count' => $course->quizzes->where('status', \App\models\Quiz::ACTIVE)->count()]) }}</span>
                                </div>
                            @endif

                            @if($course->support)
                                <div class="mt-20 d-flex align-items-center text-gray">
                                    <i data-feather="headphones" width="20" height="20"></i>
                                    <span class="ml-5 font-14 font-weight-500">{{ trans('webinars.instructor_support') }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="mt-40 p-10 rounded-sm border row align-items-center favorites-share-box">
                            @if($course->isWebinar())
                                <div class="col">
                                    <a href="{{ $course->addToCalendarLink() }}" target="_blank" class="d-flex flex-column align-items-center text-center text-gray">
                                        <i data-feather="calendar" width="20" height="20"></i>
                                        <span class="font-12">{{ trans('public.reminder') }}</span>
                                    </a>
                                </div>
                            @endif

                            <div class="col">
                                <a href="/favorites/{{ $course->slug }}/toggle" id="favoriteToggle" class="d-flex flex-column align-items-center text-gray">
                                    <i data-feather="heart" class="{{ !empty($isFavorite) ? 'favorite-active' : '' }}" width="20" height="20"></i>
                                    <span class="font-12">{{ trans('panel.favorite') }}</span>
                                </a>
                            </div>

                            <div class="col">
                                <a href="#" class="js-share-course d-flex flex-column align-items-center text-gray">
                                    <i data-feather="share-2" width="20" height="20"></i>
                                    <span class="font-12">{{ trans('public.share') }}</span>
                                </a>
                            </div>
                        </div>

                        <div class="mt-30 text-center">
                            <button type="button" id="webinarReportBtn" class="font-14 text-gray btn-transparent">{{ trans('webinars.report_this_webinar') }}</button>
                        </div>
                    </div>
                </div>

                @if($course->teacher->offline)
                    <div class="rounded-lg shadow-sm mt-35 d-flex">
                        <div class="offline-icon offline-icon-left d-flex align-items-stretch">
                            <div class="d-flex align-items-center">
                                <img src="/assets/default/img/profile/time-icon.png" alt="offline">
                            </div>
                        </div>

                        <div class="p-15">
                            <h3 class="font-16 text-dark-blue">{{ trans('public.instructor_is_not_available') }}</h3>
                            <p class="font-14 font-weight-500 text-gray mt-15">{{ $course->teacher->offline_message }}</p>
                        </div>
                    </div>
                @endif

                <div class="rounded-lg shadow-sm mt-35 px-25 py-20">
                    <h3 class="sidebar-title font-16 text-secondary font-weight-bold">{{ trans('webinars.'.$course->type) .' '. trans('webinars.specifications') }}</h3>

                    <div class="mt-30">
                        @if($course->isWebinar())
                            <div class="mt-20 d-flex align-items-center justify-content-between text-gray">
                                <div class="d-flex align-items-center">
                                    <i data-feather="calendar" width="20" height="20"></i>
                                    <span class="ml-5 font-14 font-weight-500">{{ trans('public.start_date') }}:</span>
                                </div>
                                <span class="font-14">{{ dateTimeFormat($course->start_date, 'j M Y | H:i') }}</span>
                            </div>

                            <div class="mt-20 d-flex align-items-center justify-content-between text-gray">
                                <div class="d-flex align-items-center">
                                    <i data-feather="user" width="20" height="20"></i>
                                    <span class="ml-5 font-14 font-weight-500">{{ trans('public.capacity') }}:</span>
                                </div>
                                <span class="font-14">{{ $course->capacity }} {{ trans('quiz.students') }}</span>
                            </div>
                        @endif

                        <div class="mt-20 d-flex align-items-center justify-content-between text-gray">
                            <div class="d-flex align-items-center">
                                <i data-feather="clock" width="20" height="20"></i>
                                <span class="ml-5 font-14 font-weight-500">{{ trans('public.duration') }}:</span>
                            </div>
                            <span class="font-14">{{ convertMinutesToHourAndMinute(!empty($course->duration) ? $course->duration : 0) }} {{ trans('home.hours') }}</span>
                        </div>

                        <div class="mt-20 d-flex align-items-center justify-content-between text-gray">
                            <div class="d-flex align-items-center">
                                <i data-feather="users" width="20" height="20"></i>
                                <span class="ml-5 font-14 font-weight-500">{{ trans('quiz.students') }}:</span>
                            </div>
                            <span class="font-14">{{ $course->sales_count }}</span>
                        </div>

                        @if($course->isWebinar())
                            <div class="mt-20 d-flex align-items-center justify-content-between text-gray">
                                <div class="d-flex align-items-center">
                                    <img src="/assets/default/img/icons/sessions.svg" width="20" alt="">
                                    <span class="ml-5 font-14 font-weight-500">{{ trans('public.sessions') }}:</span>
                                </div>
                                <span class="font-14">{{ $course->sessions->count() }}</span>
                            </div>
                        @endif

                        @if($course->isTextCourse())
                            <div class="mt-20 d-flex align-items-center justify-content-between text-gray">
                                <div class="d-flex align-items-center">
                                    <img src="/assets/default/img/icons/sessions.svg" width="20" alt="">
                                    <span class="ml-5 font-14 font-weight-500">{{ trans('webinars.text_lessons') }}:</span>
                                </div>
                                <span class="font-14">{{ $course->textLessons->count() }}</span>
                            </div>
                        @endif

                        @if($course->isCourse() or $course->isTextCourse())
                            <div class="mt-20 d-flex align-items-center justify-content-between text-gray">
                                <div class="d-flex align-items-center">
                                    <img src="/assets/default/img/icons/sessions.svg" width="20" alt="">
                                    <span class="ml-5 font-14 font-weight-500">{{ trans('public.files') }}:</span>
                                </div>
                                <span class="font-14">{{ $course->files->count() }}</span>
                            </div>

                            <div class="mt-20 d-flex align-items-center justify-content-between text-gray">
                                <div class="d-flex align-items-center">
                                    <img src="/assets/default/img/icons/sessions.svg" width="20" alt="">
                                    <span class="ml-5 font-14 font-weight-500">{{ trans('public.created_at') }}:</span>
                                </div>
                                <span class="font-14">{{ dateTimeFormat($course->created_at,'Y M j') }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                @if($course->creator_id != $course->teacher_id)
                    @include('web.default.course.sidebar_instructor_profile', ['courseTeacher' => $course->creator])
                @endif
                @include('web.default.course.sidebar_instructor_profile', ['courseTeacher' => $course->teacher])

                @if($course->webinarPartnerTeacher->count() > 0)
                    @foreach($course->webinarPartnerTeacher as $webinarPartnerTeacher)
                        @include('web.default.course.sidebar_instructor_profile', ['courseTeacher' => $webinarPartnerTeacher->teacher])
                    @endforeach
                @endif
                @if($course->tags->count() > 0)
                    <div class="rounded-lg tags-card shadow-sm mt-35 px-25 py-20">
                        <h3 class="sidebar-title font-16 text-secondary font-weight-bold">{{ trans('public.tags') }}</h3>

                        <div class="d-flex flex-wrap mt-10">
                            @foreach($course->tags as $tag)
                                <a href="" class="tag-item bg-gray200 p-5 font-14 text-gray font-weight-500 rounded">{{ $tag->title }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if(!empty($advertisingBannersSidebar) and count($advertisingBannersSidebar))
                    <div class="row">
                        @foreach($advertisingBannersSidebar as $sidebarBanner)
                            <div class="rounded-lg sidebar-ads mt-35 col-{{ $sidebarBanner->size }}">
                                <a href="{{ $sidebarBanner->link }}">
                                    <img src="{{ $sidebarBanner->image }}" class="img-cover rounded-lg" alt="{{ $sidebarBanner->title }}">
                                </a>
                            </div>
                        @endforeach
                    </div>

                @endif
            </div>
        </div>

        @if(!empty($advertisingBanners) and count($advertisingBanners))
            <div class="mt-30 mt-md-50">
                <div class="row">
                    @foreach($advertisingBanners as $banner)
                        <div class="col-{{ $banner->size }}">
                            <a href="{{ $banner->link }}">
                                <img src="{{ $banner->image }}" class="img-cover rounded-sm" alt="{{ $banner->title }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </section> --}}

    {{-- <div id="webinarReportModal" class="d-none">
        <h3 class="section-title after-line font-20 text-dark-blue">{{ trans('product.report_the_course') }}</h3>

        <form action="/course/{{ $course->id }}/report" method="post" class="mt-25">

            <div class="form-group">
                <label class="text-dark-blue font-14">{{ trans('product.reason') }}</label>
                <select id="reason" name="reason" class="form-control">
                    <option value="" selected disabled>{{ trans('product.select_reason') }}</option>

                    @foreach(getReportReasons() as $reason)
                        <option value="{{ $reason }}">{{ $reason }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-group">
                <label class="text-dark-blue font-14" for="message_to_reviewer">{{ trans('public.message_to_reviewer') }}</label>
                <textarea name="message" id="message_to_reviewer" class="form-control" rows="10"></textarea>
                <div class="invalid-feedback"></div>
            </div>
            <p class="text-gray font-16">{{ trans('product.report_modal_hint') }}</p>

            <div class="mt-30 d-flex align-items-center justify-content-end">
                <button type="button" class="js-course-report-submit btn btn-sm btn-primary">{{ trans('panel.report') }}</button>
                <button type="button" class="btn btn-sm btn-danger ml-10 close-swl">{{ trans('public.close') }}</button>
            </div>
        </form>
    </div> --}}

    @include('web.default.course.share_modal')
@endsection

@push('scripts_bottom')
    <script>
        function cartButtonReveal(){
            document.getElementById("reveal").style.display = 'block';
        }
    </script>
    <script src="/assets/default/js/parts/time-counter-down.min.js"></script>
    <script src="/assets/default/vendors/barrating/jquery.barrating.min.js"></script>
    <script src="/assets/default/vendors/video/video.min.js"></script>
    <script src="/assets/default/vendors/video/youtube.min.js"></script>
    <script src="/assets/default/vendors/video/vimeo.js"></script>

    <script>
        var webinarDemoLang = '{{ trans('webinars.webinar_demo') }}';
        var replyLang = '{{ trans('panel.reply') }}';
        var closeLang = '{{ trans('public.close') }}';
        var saveLang = '{{ trans('public.save') }}';
        var reportLang = '{{ trans('panel.report') }}';
        var reportSuccessLang = '{{ trans('panel.report_success') }}';
        var reportFailLang = '{{ trans('panel.report_fail') }}';
        var messageToReviewerLang = '{{ trans('public.message_to_reviewer') }}';
        var copyLang = '{{ trans('public.copy') }}';
        var copiedLang = '{{ trans('public.copied') }}';
        var learningToggleLangSuccess = '{{ trans('public.course_learning_change_status_success') }}';
        var learningToggleLangError = '{{ trans('public.course_learning_change_status_error') }}';
        var notLoginToastTitleLang = '{{ trans('public.not_login_toast_lang') }}';
        var notLoginToastMsgLang = '{{ trans('public.not_login_toast_msg_lang') }}';
        var notAccessToastTitleLang = '{{ trans('public.not_access_toast_lang') }}';
        var notAccessToastMsgLang = '{{ trans('public.not_access_toast_msg_lang') }}';
        var canNotTryAgainQuizToastTitleLang = '{{ trans('public.can_not_try_again_quiz_toast_lang') }}';
        var canNotTryAgainQuizToastMsgLang = '{{ trans('public.can_not_try_again_quiz_toast_msg_lang') }}';
        var canNotDownloadCertificateToastTitleLang = '{{ trans('public.can_not_download_certificate_toast_lang') }}';
        var canNotDownloadCertificateToastMsgLang = '{{ trans('public.can_not_download_certificate_toast_msg_lang') }}';
        var sessionFinishedToastTitleLang = '{{ trans('public.session_finished_toast_title_lang') }}';
        var sessionFinishedToastMsgLang = '{{ trans('public.session_finished_toast_msg_lang') }}';

        var player = undefined;
        $('body').on('click', '.js-play-video', function (e) {
            e.preventDefault();

            if (player !== undefined) {
                player.dispose();
            }

            const $modal = $('#playVideo');
            const $modalLoading = $modal.find('.loading-img');
            const $modalVideoContent = $modal.find('.js-modal-video-content');

            $modalLoading.removeClass('d-none');
            $modalVideoContent.addClass('d-none');

            const file_id = $(this).attr('data-id');
            const file_title = $(this).closest('.accordion-row').find('.file-title').text();
            $modal.find('.section-title').text(file_title);

            $modal.modal('show');

            $.post('/course/getFilePath', {file_id: file_id}, function (result) {
                if (result && result.code === 200) {
                    const storage = result.storage;
                    $modalLoading.addClass('d-none');
                    $modalVideoContent.removeClass('d-none');

                    let html = '';
                    if (storage === 'local') {
                        html = '<video id="my-video" class="video-js" controls preload="auto" width="870" height="364"><source src="' + result.path + '" type="video/mp4"/></video>';
                    } else {
                        html = '<video\n' +
                            '    id="my-video"\n' +
                            '    class="video-js"\n' +
                            '    controls\n' +
                            '    preload="auto"\n' +
                            '    width="870" height="364"\n' +
                            '    data-setup=\'{ "techOrder": ["' + result.storageService + '"], "sources": [{ "type": "video/' + result.storageService + '", "src": "' + result.path + '"}] }\'\n' +
                            '  >\n' +
                            '  </video>';
                    }


                    $modalVideoContent.html(html);

                    const options = {
                        autoplay: false,
                        preload: 'auto',
                    };

                    player = videojs('my-video', options);
                } else {
                    $.toast({
                        heading: notAccessToastTitleLang,
                        text: notAccessToastMsgLang,
                        bgColor: '#f63c3c',
                        textColor: 'white',
                        hideAfter: 10000,
                        position: 'bottom-right',
                        icon: 'error'
                    });
                }
            }).fail(err => {
                $.toast({
                    heading: notAccessToastTitleLang,
                    text: notAccessToastMsgLang,
                    bgColor: '#f63c3c',
                    textColor: 'white',
                    hideAfter: 10000,
                    position: 'bottom-right',
                    icon: 'error'
                });
            });

            $('#playVideo').on('hidden.bs.modal', function () {
                if (player !== undefined) {
                    player.pause();
                }
            })
        });
    </script>

    <script src="/assets/default/js/parts/comment.min.js"></script>
    <script src="/assets/default/js/parts/webinar_show.min.js"></script>
@endpush
