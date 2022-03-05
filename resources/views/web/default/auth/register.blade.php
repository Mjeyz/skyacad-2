@extends(getTemplate().'.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
    <style>
        .select2-results__option {
            font-size: 12px;
        }
    </style>
@endpush

@section('content')
    @php
        $registerMethod = getGeneralSettings('register_method') ?? 'mobile';
    @endphp

    <div class="container cust-login-container">
        <div class="login-container cust-login">
            <div class="">
                <div class="login-card">
                    <div class="text-center">
                        <h2 class="custom-heading">{{ trans('auth.signup') }}</h2>
                        <p> {{trans('auth.signup_p')}} </p>
                    </div>
                    <form method="post" action="/register" class="mt-35">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        @if($registerMethod == 'mobile')
                            <div class="row">
                                <div class="col-5">
                                    <div class="form-group">
                                        <select name="country_code" class="form-control select2">
                                            @foreach(getCountriesMobileCode() as $country => $code)
                                                <option value="{{ $code }}" @if($code == old('country_code')) selected @endif>{{ $country }}</option>
                                            @endforeach
                                        </select>

                                        @error('mobile')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-7">
                                    <div class="form-group">
                                        <label class="input-label" for="mobile">{{ trans('auth.'.$registerMethod) }}:</label>
                                        <input name="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror"
                                               value="{{ old('mobile') }}" id="mobile" aria-describedby="mobileHelp">

                                        @error('mobile')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="form-group">

                                <input placeholder="Email address" name="email" type="text" class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}" id="email" aria-describedby="emailHelp">

                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        @endif
                            <div class="form-group">
                                <input placeholder="Phone number" name="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror"
                                        value="{{ old('mobile') }}" id="mobile" aria-describedby="mobileHelp">

                                @error('mobile')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        <div class="form-group">
                            <input placeholder="Name" name="full_name" type="text" value="{{ old('full_name') }}" class="form-control @error('full_name') is-invalid @enderror">
                            @error('full_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input name="password" type="password"
                                    placeholder="Password"
                                   class="form-control @error('password') is-invalid @enderror" id="password"
                                   aria-describedby="passwordHelp">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group ">
                            <input name="password_confirmation" type="password" placeholder="Re-password"
                                   class="form-control @error('password_confirmation') is-invalid @enderror" id="confirm_password"
                                   aria-describedby="confirmPasswordHelp">
                            @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="term" value="1" class="custom-control-input @error('term') is-invalid @enderror" id="term">
                            <label class="custom-control-label font-14" for="term">{{ trans('auth.i_agree_with') }}
                                <a href="pages/terms" target="_blank" class="text-secondary font-weight-bold font-14">{{ trans('auth.terms_and_rules') }}</a>
                            </label>

                            @error('term')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        @error('term')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        <button type="submit"
                                class="btn btn-primary btn-block mt-20">{{ trans('auth.signup') }}</button>
                    </form>
                    
                    <div class="text-center mt-20">
                        <span class="badge badge-circle-gray300 text-secondary d-inline-flex align-items-center justify-content-center">{{ trans('auth.or') }}</span>
                    </div>
                     <div class="mt-20 text-center">
                        <a href="/login" class="text-secondary font-weight-bold">
                            <button style="background: #707070;" class="btn btn-primary btn-block mt-20">{{ trans('Sign in') }}</button>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts_bottom')
    <script src="/assets/default/vendors/select2/select2.min.js"></script>
@endpush
