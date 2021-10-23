<div x-data="{open:'login','poll':false}" style="font-weight: bolder">
    <div class="">
        <div>
            <div class="float-left w-50">
                <button style="font-size: 20px" class="btn btn-block shadow"
                    :class="{'site-bg-orange text-white':open=='login'}" x-on:click="open='login'">Sign in</button>
            </div>
            <div class="float-right w-50">
                <button style="font-size: 20px" class="btn btn-block shadow"
                    :class="{'site-bg-orange text-white':open=='signup'}" x-on:click="open='signup'">Sign up</button>
            </div>
        </div>
    </div>
    <br>
    <br>
    <hr>
    {{-- Login form start --}}


    <div class="mt-2" x-show="open=='login'">
        <div class="mb-3 text-center">

            <img src="{{ asset('images/login.svg') }}" style="margin-top: -15px" alt="" width="40"
                class="img img-responsive shadow rounded-circle">
            <span class="ml-3 font-weight-bold" style="font-size: 30px">Sign in</span>
        </div>
        <form wire:submit.prevent="login()">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" wire:model.defer="login_email">
                @error('login_email')
                     <small  class="text-danger">{{ $message }}</small>
                @enderror

            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" wire:model.defer="login_password">
                  @error('login_password')
                     <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="text-right mb-3">
                <a target="_blank" href="" class="site-text-orange ">Forgot your password?</a>
            </div>
            <div class="clearfix mb-3">
                <button class=" btn w-50 site-bg-orange text-white float-right" wire:loading.attr="disabled"

              type="submit">

                    <span wire:loading wire:target="login" class="">
                        <div class="spinner-grow mr-1" role="status">

                        </div>
                    </span>
                    Sign in
                    <span class="fa fa-arrow-right ml-4"></span>

                </button>
            </div>
            <hr>


        </form>
    </div>
    {{-- Login form ends --}}

    {{-- signup form start --}}


    <div class="mt-2" x-show="open=='signup'">
        <div class="mb-3 text-center">

            <img src="{{ asset('images/sign-up.svg') }}" style="margin-top: -15px" alt="" width="40"
                class="img img-responsive ">
            <span class="ml-3 font-weight-bold" style="font-size: 30px">Sign up</span>
        </div>
        @if ($avatar)
            <div class="mb-2">
                <img src="{{ $avatar }}" style="" alt="" width="40"
                    class="img img-responsive d-block ml-auto mr-auto rounded-circle">
            </div>


        @endif
        <form wire:submit.prevent="signup">
            {{-- first --}}
            @csrf

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <label>Stage Name</label>
                        <input type="text" class="form-control" wire:model="stage_name">
                        @error('stage_name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" wire:model="email">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Unique username/Url</label>
                        <input type="text" class="form-control" wire:model="url"
                            placeholder=" Used as the Url to your songs ">
                        @error('url')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Who are you?</label>
                        <select class="form-control" wire:model.defer="who">
                            <option value=""></option>
                            <option value="artist">Artist</option>
                            <option value="manager">Label Manager/Boss</option>
                            <option value="dj">DJ</option>
                        </select>
                        @error('who')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Phone number</label>
                        <input type="text" class="form-control" wire:model="phone">
                        @error('phone')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" wire:model="password">
                        @error('password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

            </div>
             {{-- <div class="g-recaptcha mb-4 w-100" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
            @if ($errors->has('g-recaptcha-response'))
                <span class="invalid-feedback" style="display: block;">
                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                </span>
            @endif --}}


                 {{-- data-sitekey="{{env('RECAPTCHA_SITE_KEY')}}"
              data-callback='handle'
              data-action='submit' --}}
            <div class="clearfix">

                <button class=" btn w-50 site-bg-orange text-white float-right" wire:loading.attr="disabled"

              type="submit">

                    <span wire:loading wire:target="signup" class="">
                        <div class="spinner-grow mr-1" role="status">

                        </div>
                    </span>
                    Sign up
                    <span class="fa fa-arrow-right ml-4"></span>

                </button>
            </div>

            {{-- first ends --}}
        </form>
    </div>
        {{-- <h3 class="text-center mt-3 mb-3">OR</h3> --}}
    <div class="row pl-md-5 pr-md-5">
        <div class="col-4 mb-4">
            <a target="_blank" x-on:click="open='signup'" href="{{ route('social', ['social' => 'twitter']) }}" wire:click="$toggle('poll')"
                class="shadow-lg rounded p-md-1  text-white  ">
                {{-- <span class="fa fa-twitter "></span>
                <span> Use Twitter</span> --}}
                <img src="{{ asset('images/twitter.svg') }}" alt="" width="50">
            </a>
        </div>
        <div class="col-4 mb-4">
            <a target="_blank" x-on:click="open='signup'" href="{{ route('social', ['social' => 'google']) }}" wire:click="$toggle('poll')"
                class="shadow-lg rounded p-md-1   text-white  ">
                {{-- <span class="fa fa-google "></span>
                <span> Use Google</span> --}}
                 <img src="{{ asset('images/google-plus.svg') }}" alt="" width="50">
            </a>
        </div>
        {{-- wire:click="socialLogin('facebook')" --}}
        <div class="col-4 mb-4">
            <a target="_blank" x-on:click="open='signup'" href="{{ route('social', ['social' => 'facebook']) }}" wire:click="$toggle('poll')"
                class="shadow-lg rounded p-md-1 text-white  ">
                {{-- <span class="fa fa-facebook "></span>
                <span> Use Facebook</span> --}}
                 <img src="{{ asset('images/facebook.svg') }}" alt="" width="50">
            </a>

        </div>
        <div @if ($poll) wire:poll="social" @endif>
        </div>

    </div>
    @push('cap')
         {{-- <script >
     function handle(e) {
            grecaptcha.ready(function () {
                grecaptcha.execute('{{env('CAPTCHA_SITE_KEY')}}', {action: 'submit'})
                    .then(function (token) {
                        @this.set('captcha', token);
                    });
            })
        }
  </script> --}}
    @endpush
    {{-- signup form ends --}}
</div>
