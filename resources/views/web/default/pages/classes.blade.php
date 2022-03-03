@extends(getTemplate().'.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/vendors/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
@endpush

@section('content')

    <div class="container mt-30">
        <div class="text-left">
            <h2 class="custom-heading">{{ trans('panel.top_heading') }}</h2>
        </div>
        <section class="mt-lg-50 pt-lg-20 mt-md-40 pt-md-40">
            <form action="/classes" method="get" id="filtersForm">

                @include('web.default.pages.includes.top_filters')

                <div class="row mt-20">
                    <div class="col-12 col-lg-12">

                        @if(empty(request()->get('card')) or request()->get('card') == 'grid')
                            <div class="row">
                                @foreach($webinars as $webinar)
                                    <div class="col-12 col-lg-4 mt-20">
                                        @include('web.default.includes.webinar.grid-card',['webinar' => $webinar])
                                    </div>
                                @endforeach
                            </div>

                        @elseif(!empty(request()->get('card')) and request()->get('card') == 'list')

                            @foreach($webinars as $webinar)
                                @include('web.default.includes.webinar.list-card',['webinar' => $webinar])
                            @endforeach
                        @endif

                    </div>


                    {{-- <div class="col-12 col-lg-4">
                        <div class="mt-20 p-20 rounded-sm shadow-lg border border-gray300 filters-container">

                            <div class="">
                                <h3 class="category-filter-title font-20 font-weight-bold text-dark-blue">{{ trans('public.type') }}</h3>

                                <div class="pt-10">
                                    @foreach(['webinar','course','text_lesson'] as $typeOption)
                                        <div class="d-flex align-items-center justify-content-between mt-20">
                                            <label class="cursor-pointer" for="filterLanguage{{ $typeOption }}">{{ trans('webinars.'.$typeOption) }}</label>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="type[]" id="filterLanguage{{ $typeOption }}" value="{{ $typeOption }}" @if(in_array($typeOption, request()->get('type', []))) checked="checked" @endif class="custom-control-input">
                                                <label class="custom-control-label" for="filterLanguage{{ $typeOption }}"></label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mt-25 pt-25 border-top border-gray300">
                                <h3 class="category-filter-title font-20 font-weight-bold text-dark-blue">{{ trans('site.more_options') }}</h3>

                                <div class="pt-10">
                                    @foreach(['subscribe','certificate_included','with_quiz','featured'] as $moreOption)
                                        <div class="d-flex align-items-center justify-content-between mt-20">
                                            <label class="cursor-pointer" for="filterLanguage{{ $moreOption }}">{{ trans('webinars.show_only_'.$moreOption) }}</label>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="moreOptions[]" id="filterLanguage{{ $moreOption }}" value="{{ $moreOption }}" @if(in_array($moreOption, request()->get('moreOptions', []))) checked="checked" @endif class="custom-control-input">
                                                <label class="custom-control-label" for="filterLanguage{{ $moreOption }}"></label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>


                            <button type="submit" class="btn btn-sm btn-primary btn-block mt-30">{{ trans('site.filter_items') }}</button>
                        </div>
                    </div> --}}
                </div>

            </form>
            <div class="mt-50 pt-30">
                {{ $webinars->links('vendor.pagination.panel') }}
            </div>
        </section>
    </div>

@endsection

@push('scripts_bottom')
    <script src="/assets/default/vendors/select2/select2.min.js"></script>
    <script src="/assets/default/vendors/swiper/swiper-bundle.min.js"></script>

    <script>

        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 16,
            loop: false,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                991: {
                    slidesPerView: 3,
                },

                660: {
                    slidesPerView: 2,
                },
            }
        });

        $('body').on('change', '#topFilters input,#topFilters select', function (e) {
            e.preventDefault();
            $('#filtersForm').submit();
        });
    </script>
@endpush
