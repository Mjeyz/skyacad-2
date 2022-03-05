@extends(getTemplate().'.layouts.app')

@section('content')
    <div class="container cust-login-container">
        @if(!empty(session()->has('msg')))
            <div class="alert alert-info alert-dismissible fade show mt-30" role="alert">
                {{ session()->get('msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="login-container cust-login ">
            <div class="">
                <div class="login-card">
                    <div class="text-center">
                        <h2 class="custom-heading">{{ trans('auth.login_h1') }}</h2>
                        <p> {{trans('auth.login_p')}} </p>
                    </div>

                    <form method="Post" action="/login" class="mt-35">
                        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
                        @csrf
                        <div class="form-group">
                            <input placeholder="Email address" name="username" type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                                   value="{{ old('username') }}" aria-describedby="emailHelp">
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input placeholder="Password" name="password" type="password" class="form-control @error('password')  is-invalid @enderror" id="password" aria-describedby="passwordHelp">

                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-block mt-20">{{ trans('auth.login') }}</button>
                    </form>

                    <div class="text-center mt-20">
                        <span class="badge badge-circle-gray300 text-secondary d-inline-flex align-items-center justify-content-center">{{ trans('auth.or') }}</span>
                    </div>

                    <div class="mt-20 text-center">
                        <a href="/register" class="text-secondary font-weight-bold">
                            <button style="background: #707070;" class="btn btn-primary btn-block mt-20">{{ trans('auth.signup') }}</button>
                        </a>
                    </div>
                    <div class="mt-30 text-center">
                        <a href="/forget-password" target="_blank">{{ trans('auth.forget_your_password') }}</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
