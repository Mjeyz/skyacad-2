<section>
    {{-- <h2 class="before-line section-title after-line">{{ trans('financial.account') }}</h2> --}}
    <div class="text-content-area text-center">
        <h2 class="custom-heading" style="font-size: 30px">{{trans('Profile')}}</h2>
        <p class="custom-p mt-5" style="font-size: 17px">{{trans('Edit your profile and change your information ')}}</p>
    </div>
    <div class="user-custom-panel row mt-20 align-items-center justify-content-center">
        
        <div class="col-12 col-lg-6">
            <div class="user-img row justify-content-center mt-10 mb-20">
                <img src="{{ $authUser->getAvatar() }}" class="img-cover" alt="{{ $authUser->full_name }}">
            </div>
            
            <div class="form-group">
                {{-- <label class="input-label">{{ trans('auth.name') }}</label> --}}
                <input class="my-custom-input" disabled type="text" name="full_name" value="{{ (!empty($user) and empty($new_user)) ? $user->full_name : old('full_name') }}" class="form-control @error('full_name')  is-invalid @enderror" placeholder=""/>
                @error('full_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                {{-- <label class="input-label">{{ trans('public.email') }}</label> --}}
                <input class="my-custom-input" type="text" name="email" value="{{ (!empty($user) and empty($new_user)) ? $user->email : old('email') }}" class="form-control @error('email')  is-invalid @enderror" placeholder=""/>
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>


            {{-- <div class="form-group">
                <label class="input-label">{{ trans('auth.password') }}</label>
                <input type="password" name="password" value="{{ old('password') }}" class="form-control @error('password')  is-invalid @enderror" placeholder=""/>
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label class="input-label">{{ trans('auth.password_repeat') }}</label>
                <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control @error('password_confirmation')  is-invalid @enderror" placeholder=""/>
                @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div> --}}

            <div class="form-group">
                {{-- <label class="input-label">{{ trans('public.mobile') }}</label> --}}
                <input class="my-custom-input" placeholder="Phone number" type="tel" name="mobile" value="{{ (!empty($user) and empty($new_user)) ? $user->mobile : old('mobile') }}" class="form-control @error('mobile')  is-invalid @enderror" placeholder=""/>
                @error('mobile')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- <div class="form-group">
                <label class="input-label">{{ trans('auth.language') }}</label>
                <select name="language" class="form-control">
                    @foreach($userLanguages as $lang => $language)
                        <option value="{{ $lang }}" @if(!empty($user) and $user->language == $lang) selected @endif>{{ $language }}</option>
                    @endforeach
                </select>
                @error('language')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div> --}}

            {{-- <div class="form-group mt-30 d-flex align-items-center justify-content-between">
                <label class="cursor-pointer input-label" for="newsletterSwitch">{{ trans('auth.join_newsletter') }}</label>
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="join_newsletter" class="custom-control-input" id="newsletterSwitch" {{ (!empty($user) and $user->newsletter) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="newsletterSwitch"></label>
                </div>
            </div>

            <div class="form-group mt-30 d-flex align-items-center justify-content-between">
                <label class="cursor-pointer input-label" for="publicMessagesSwitch">{{ trans('auth.public_messages') }}</label>
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="public_messages" class="custom-control-input" id="publicMessagesSwitch" {{ (!empty($user) and $user->public_message) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="publicMessagesSwitch"></label>
                </div>
            </div> --}}
        </div>
    </div>

</section>