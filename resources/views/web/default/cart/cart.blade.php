@extends(getTemplate().'.layouts.app')


@section('content')
    {{-- <section class="cart-banner position-relative text-center">
        <h1 class="font-30 text-white font-weight-bold">{{ trans('cart.shopping_cart') }}</h1>
        <span class="payment-hint font-20 text-white d-block"> {{'$' . $subTotal . ' ' . trans('cart.for_items',['count' => $carts->count()]) }}</span>
    </section> --}}

    <div class="container">
        <section class="mt-45">
            <h2 class="custom-heading mb-30">{{ trans('Course checkout') }}</h2>

            <div class="row">
                
            @foreach($carts as $cart)
                <div class="col-md-4">
                    <div class="course-card-buy-page">
                        <div class="image-box">
                            @php
                                $imgPath = '';

                                if (!empty($cart->webinar_id)) {
                                    $imgPath = $cart->webinar->getImage();
                                } elseif (!empty($cart->reserve_meeting_id)) {
                                    $imgPath = $cart->reserveMeeting->meeting->creator->getAvatar();
                                }
                            @endphp
                            <img src="{{ $imgPath }}" class="img-cover" alt="">
                        </div>
                        <div class="text-data">
                        @if(!empty($course->category))
                            <span class="d-block font-14 mt-10 pb-10">{{ trans('public.in') }} <a href="{{ $course->category->getUrl() }}" target="_blank" class="home-course-category">{{ $course->category->title }}</a></span>
                        @endif
                         @if(!empty($cart->webinar_id))
                            <a href="{{ $cart->webinar->getUrl() }}" target="_blank">
                                <h3 class="font-16 font-weight-bold text-dark-blue">{{ $cart->webinar->title }}</h3>
                            </a>
                        @elseif(!empty($cart->reserve_meeting_id))
                            <h3 class="font-16 font-weight-bold text-dark-blue">{{ trans('meeting.reservation_appointment') }}</h3>
                        @endif

                       
                        @if(!empty($cart->webinar_id))
                            @if($cart->webinar->getDiscount($cart->ticket))
                                <span class="text-gray text-decoration-line-through mx-10 mx-md-0">{{ $currency }}{{ $cart->webinar->price }}</span>
                                <span class="font-20 text-primary mt-0 mt-md-5 font-weight-bold">{{ $currency }}{{ $cart->webinar->price - $cart->webinar->getDiscount($cart->ticket) }}</span>
                            @else
                                <span class="font-20 text-primary mt-0 mt-md-5 font-weight-bold">{{ $currency }}{{ $cart->webinar->price }}</span>
                            @endif

                        @elseif(!empty($cart->reserve_meeting_id))
                            <span class="font-20 text-primary mt-0 mt-md-5 font-weight-bold">{{ $currency }}{{ $cart->reserveMeeting->paid_amount }}</span>
                            @endif
                        <p> {{trans('public.course_card_desc')}} </p>
                         <button type="button" onclick="window.history.back()" class="btn course-card-button btn-primary mt-25">{{ trans('cart.continue_shopping') }}</button>
                    </div>
                    </div>
                </div>
            @endforeach
            <div class="col-md-5 cart-page-padding">
                <div class="">
                {{-- <section class="mt-45">
                    <h3 class="section-title">{{ trans('cart.coupon_code') }}</h3>
                    <div class="rounded-sm shadow mt-20 py-25 px-20">
                        <p class="text-gray font-14">{{ trans('cart.coupon_code_hint') }}</p>

                        @if(!empty($userGroup) and !empty($userGroup->discount))
                            <p class="text-gray mt-25">{{ trans('cart.in_user_group',['group_name' => $userGroup->name , 'percent' => $userGroup->discount]) }}</p>
                        @endif

                        <form action="/carts/coupon/validate" method="Post">
                            {{ csrf_field() }}
                            <div class="form-group input-group mb-3">
                                <input type="text" name="coupon" id="coupon_input" class="form-control mt-25"
                                       placeholder="{{ trans('cart.enter_your_code_here') }}">
                                <span class="invalid-feedback">{{ trans('cart.coupon_invalid') }}</span>
                                <span class="valid-feedback">{{ trans('cart.coupon_valid') }}</span>
                            </div>

                            <button type="submit" id="checkCoupon"
                                    class="btn btn-sm btn-primary mt-50">{{ trans('cart.validate') }}</button>
                        </form>
                    </div>
                </section> --}}
                @if(!empty($course->category))
                            <span class="d-block font-14 mt-10 pb-10">{{ trans('public.in') }} <a href="{{ $course->category->getUrl() }}" target="_blank" class="home-course-category">{{ $course->category->title }}</a></span>
                        @endif
                         @if(!empty($cart->webinar_id))
                            <a href="{{ $cart->webinar->getUrl() }}" target="_blank">
                                <h3 class="cart-payment-heading">{{ $cart->webinar->title }}</h3>
                            </a>
                        @elseif(!empty($cart->reserve_meeting_id))
                            <h3 class="font-16 font-weight-bold text-dark-blue">{{ trans('meeting.reservation_appointment') }}</h3>
                        @endif

                       
                        @if(!empty($cart->webinar_id))
                            @if($cart->webinar->getDiscount($cart->ticket))
                                <span class="text-gray text-decoration-line-through mx-10 mx-md-0">{{ $currency }}{{ $cart->webinar->price }}</span>
                                <span class="mt-0 mt-md-5 cart-payment-price">{{ $currency }}{{ $cart->webinar->price - $cart->webinar->getDiscount($cart->ticket) }}</span>
                            @else
                                <span class="cart-payment-price mt-0 mt-md-5">{{ $currency }}{{ $cart->webinar->price }}</span>
                            @endif

                        @elseif(!empty($cart->reserve_meeting_id))
                            <span class="font-20 text-primary mt-0 mt-md-5 font-weight-bold">{{ $currency }}{{ $cart->reserveMeeting->paid_amount }}</span>
                            @endif

        
                @if(!empty($userGroup) and !empty($userGroup->discount))
                    <p class="text-gray mt-25">{{ trans('cart.in_user_group',['group_name' => $userGroup->name , 'percent' => $userGroup->discount]) }}</p>
                @endif

                <input type="text" class="form-control custom-cart-input mt-20" placeholder="Arabic name ( for certificate )">
                <input type="text" class="form-control custom-cart-input" placeholder="English name ( for certificate )">

                <form action="/carts/coupon/validate" method="Post">
                    {{ csrf_field() }}
                    <div class="input-group mb-3">
                        <input type="text" name="coupon" id="coupon_input"  class="form-control cart-page-inpuit" placeholder="{{ trans('cart.enter_your_code_here') }}" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button type="submit" id="checkCoupon" class="cart-page-buttonr">Apply</button>
                        </div>
                        <span class="invalid-feedback">{{ trans('cart.coupon_invalid') }}</span>
                        <span class="valid-feedback">{{ trans('cart.coupon_valid') }}</span>
                    </div>
                    
                </form>
                <div class="cart-payment-flex">
                    <h4 class="text-secondary font-14  font-weight-bold font-weight-500">{{ trans('public.discount') }}</h4>
                    <span class="font-14 text-gray  px-20">{{ $currency }}<span id="totalDiscount">{{ $totalDiscount }}</span></span>
                </div>
                <div class="cart-payment-flex">
                    <h4 class="text-secondary font-14  font-weight-bold font-weight-500">{{ trans('cart.total') }}</h4>
                    <span class="font-14 text-gray px-20">{{ $currency }}<span id="totalAmount">{{ $total }}  {{trans(' ( include VAT )')}} </span></span>
                </div>
                
                <form action="/cart/checkout" method="post" id="cartForm">
                    {{ csrf_field() }}
                    <input type="hidden" name="discount_id" value="">

                    <button style=" border-radius: 20px;" type="submit" class="btn btn-primary  course-cart-button mt-15 btn-lg btn-block">{{ trans('cart.checkout') }}</button>
                </form>
            </div>
            </div>
            </div>

        </section>
    </div>
@endsection

@push('scripts_bottom')
    <script>
        (function ($) {
            "use strict";

            $('body').on('click', '#checkCoupon', function (e) {
                e.preventDefault();
                var $this = $(this);
                var couponInput = $('#coupon_input');
                var coupon = couponInput.val();
                couponInput.removeClass('is-invalid is-valid');

                if (coupon) {
                    $this.addClass('loadingbar primary').prop('disabled', true);

                    $.post('/cart/coupon/validate', {coupon: coupon}, function (result) {
                        if (result && result.status == 200) {
                            $('#totalAmount').text(result.total_amount);
                            $('#taxPrice').text(result.total_tax);
                            $('#totalDiscount').text(result.total_discount);
                            $('#cartForm input[name="discount_id"]').val(result.discount_id);
                            $('#checkCoupon').prop('disabled', true);
                            couponInput.addClass('is-valid');
                        } else if (result && result.status == 422) {
                            couponInput.removeClass('is-valid');
                            couponInput.addClass('is-invalid');
                        }
                    }).always(() => {
                        $this.removeClass('loadingbar primary').prop('disabled', false);
                    });
                } else {
                    couponInput.addClass('is-invalid');
                }
            })
        })(jQuery);
    </script>
@endpush
