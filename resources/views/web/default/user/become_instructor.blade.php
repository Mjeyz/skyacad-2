@extends(getTemplate().'.layouts.app')


@section('content')
    <div class="container">

        <div class="row login-container justify-content-center align-items-center">
            <div class="col-12 col-md-8">
                <div class="login-card">
                    <div class="text-container text-center">
                        <h2 class="custom-heading">{{ trans('site.become_instructor') }}</h2>
                        <p class="custom-p">{{ trans('site.become_instructor_subt') }}</p>
                    </div>

                    <div class="garbage-data">
                        <input type="text" class="form-control custom-input mt-20" name="Name" id="" placeholder="Name">
                        <input type="text" class="form-control custom-input mt-20"  placeholder="Email address">
                        <input type="text" class="form-control custom-input mt-20"  placeholder="Phone Number">
                    </div>
                    <form method="Post" action="/become_instructor" class="">
                        {{ csrf_field() }}
                        
                        <div class="form-group" style="visibility: hidden" >
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    
                                </div>
                                <input type="text" name="certificate" id="certificate" value="{{ !empty($lastRequest) ? $lastRequest->certificate : old('certificate') }}" class="form-control "/>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary panel-file-manager btn-block custom-button" data-input="certificate" data-preview="holder">Upload your CV</button>
                        <button type="submit" class="btn btn-primary btn-block mt-20 custom-button">{{ trans('site.send_request') }}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts_bottom')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('body').on('click', '.panel-file-manager', function (e) {
            e.preventDefault();
            $(this).filemanager('file', {prefix: '/laravel-filemanager'})
        });
    </script>
@endpush
