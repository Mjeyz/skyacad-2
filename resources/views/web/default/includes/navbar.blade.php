@php
    if (empty($authUser) and auth()->check()) {
        $authUser = auth()->user();
    }
@endphp

<nav id="navbar" class="navbar navbar-expand-lg">
    <div class="{{ (!empty($isPanel) and $isPanel) ? 'container-fluid' : 'container'}}">
        <div class="d-flex align-items-center justify-content-between w-100">

            <a class="navbar-brand navbar-order mr-0" href="/">
                @if(!empty($generalSettings['logo']))
                    <img style="height: 50px;" src="{{ $generalSettings['logo'] }}" class="img-cover" alt="site logo">
                @endif
            </a>

            {{-- <button class="navbar-toggler navbar-order" type="button" id="navbarToggle">
                <span class="navbar-toggler-icon"></span>
            </button> --}}
            {{-- <form action="/search" method="get">
                <div class="header-search">
                    <input type="search" name="search" placeholder="Search" value="{{ request()->get('search','') }}">
                    <i class="fa fa-search"></i>
                </div>
            </form> --}}
            {{-- <div class="mx-lg-30 d-none d-lg-flex flex-grow-1 navbar-toggle-content " id="navbarContent">
                <form action="/search" method="get" class="form-inline my-2 my-lg-0 navbar-search position-relative">
                    <input class="form-control mr-5 rounded" type="text" name="search" placeholder="{{ trans('navbar.search_anything') }}" aria-label="Search">
                </form>
            </div> --}}

            <div class="nav-icons-or-start-live navbar-order">
                <div class="xs-w-100 d-flex align-items-center justify-content-between ">
                    @if(!empty($authUser))
                    <div class="d-flex align-items-center ml-md-50">
                        <a class="py-5 px-10 mr-10 navBarLoginLink" href="/logout">{{ trans('panel.log_out') }}</a>
                        <a class="btn btn-primary navbarButton" href="{{ $authUser->isAdmin() ? '/admin' : '/panel' }}">
                            {{-- <img src="/assets/default/img/icons/sidebar/dashboard.svg" width="25" alt="nav-icon"> --}}
                            <span class="font-14 text-white">{{ trans('public.my_panel') }}</span>
                        </a>
                        @if($authUser->isTeacher() or $authUser->isOrganization())
                            <a class="btn btn-primary navbarButton" href="{{ $authUser->getProfileUrl() }}">
                                {{-- <img src="/assets/default/img/icons/profile.svg" width="25" alt="nav-icon"> --}}
                                <span class="font-14 text-white">{{ trans('public.my_profile') }}</span>
                            </a>
                        @endif
                                
                    </div>
                    @else
                        <div class="d-flex align-items-center ml-md-50">
                            <a href="/login" class="py-5 px-10 mr-10 text-dark-blue navBarLoginLink">{{ trans('auth.login') }}</a>
                            <a href="/register" class="btn btn-primary navbarButton">{{ trans('auth.register') }}</a>
                        </div>
                    @endif
            </div>
            </div>
        </div>
    </div>
</nav>

@push('scripts_bottom')
    <script src="/assets/default/js/parts/navbar.min.js"></script>
@endpush
