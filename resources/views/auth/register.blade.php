@extends('layouts.auth.master')

@section('title', __('Login'))
@section('description', '')
@section('keywords', '')
@section('author', '')

@section('css')

@endsection

@section('content')

 <div class="container-fluid p-0"> 
      <div class="row m-0">
        <div class="col-xl-5"><img class="bg-img-cover bg-center" src="{{asset('AdminAssets/images/login/3.jpg')}}" alt="looginpage"></div>
        <div class="col-xl-7 p-0"> 
          <div class="login-card login-dark">
            <div>
              <div><a class="logo text-start" href="index.html"><img class="img-fluid for-light" src="{{asset('AdminAssets/images/logo/logo.png')}}" alt="looginpage"><img class="img-fluid for-dark" src="{{asset('AdminAssets/images/logo/logo_dark.png')}}" alt="looginpage"></a></div>
              <div class="login-main create-account"> 
                <form class="theme-form" action="{{route('register.attempt')}}" method="POST">
                    @csrf
                  <h4>{{__('Adventure starts here')}}</h4>
                  <p>{{__('Enter your personal details to create account')}}</p>
                  
                <div class="form-group">
                    <label for="name" class="col-form-label">{{__('Your Full Name')}}</label><span class="text-danger">*</span>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" 
                    name="name" value="{{ old('name') }}" placeholder="{{__('Enter your name')}} "autofocus required>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="email" class="col-form-label">{{__('Email Address')}}</label><span class="text-danger">*</span>
                    <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" 
                    name="email" value="{{ old('email') }}" placeholder="{{__('Enter your email')}}" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label class="col-form-label" for="password">{{__('Password')}}</label><span class="text-danger">*</span>
                    <div class="form-input position-relative">
                      <input  type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password"
                         placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" 
                         aria-describedby="password" required/>
                      <div class="show-hide"><span class="show"></span></div>
                    </div>
                     @error('password')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label class="col-form-label" for="confirm-password">{{__('Confirm Password')}}</label><span class="text-danger">*</span>
                    <div class="form-input position-relative">
                      <input  type="password" id="confirm-password" class="form-control @error('confirm-password') is-invalid @enderror" name="password_confirmation"
                         placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" 
                         aria-describedby="confirm-password" required/>
                      <div class="show-hide"><span class="show"></span></div>
                    </div>
                     @error('confirm-password')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                  </div>
                  <div class="form-group mb-0">
                    <div class="form-check">
                      <input class="checkbox-primary form-check-input @error('terms') is-invalid @enderror" id="terms-conditions" name="terms" required {{ old('terms') == 'on' ? 'checked' : ''  }} type="checkbox">
                      <label class="text-muted form-check-label" for="terms-conditions">{{__('I agree to the terms & conditions and')}} <a class="ms-2" href="#">{{__('privacy policy & terms')}}</a></label>
                    </div>
                     @error('terms')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                    <button class="btn btn-primary btn-block w-100" type="submit">{{__('Sign up')}}</button>
                  </div>
                  <h6 class="text-muted mt-4 or">Or create your account with</h6>
                  <div class="social mt-4">
                    <div class="btn-showcase"><a class="btn btn-light" href="https://www.linkedin.com/login" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a><a class="btn btn-light" href="https://twitter.com/login?lang=en" target="_blank"><i class="fa-brands fa-x-twitter"></i></a><a class="btn btn-light" href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a><a class="btn btn-light" href="https://www.google.com/" target="_blank"><i class="fa-brands fa-google"></i></a></div>
                  </div>
                  <p class="mt-4 mb-0 text-center">{{__('Already have an account?')}}<a class="ms-2" href="{{route('login')}}">{{__('Sign in')}}</a></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>



    @endsection

@section('script')
@endsection
