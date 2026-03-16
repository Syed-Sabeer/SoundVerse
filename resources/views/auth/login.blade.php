@extends('layouts.auth.master')

@section('title', __('Login'))
@section('description', '')
@section('keywords', '')
@section('author', '')

@section('css')

@endsection

@section('content')

<div class="container-fluid">
      <div class="row">
        <div class="col-xl-3">
          
        </div>
        <div class="col-xl-6 p-0">
          <div class="login-card login-dark">
            <div>
              {{-- <div><a class="logo text-start" href=""><img class="img-fluid for-light" src="{{asset('AdminAssets/images/logo/logo.png')}}" alt="looginpage"><img class="img-fluid for-dark" src="{{asset('AdminAssets/images/logo/logo_dark.png')}}" alt="looginpage"></a></div> --}}
              <div class="login-main"> 
                <form class="theme-form" action="{{route('login.attempt')}}" method="POST">
                  @csrf
                  <h4>Sign in to account</h4>
                  <p>Enter your email & password to login</p>
                  <div class="form-group">
                    <label class="col-form-label">Email Address</label>
                    <input class="form-control @error('email_username') is-invalid @enderror" name="email_username" placeholder="Your Email" autofocus required type="email">
                    @error('email_username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="form-group">
                    {{-- <div class="text-end mb-2">
                        <a href="{{ route('password.forgot') }}" style="color: #667eea; text-decoration: none; font-size: 14px;">Forgot Password?</a>
                    </div> --}}
                    <label class="col-form-label">Password</label>
                    <div class="form-input position-relative">
                      <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" required/>

                      <div class="show-hide"><span class="show">                         </span></div>
                    </div>
                      @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                  </div>
                  <div class="form-group mb-0">
                    <div class="form-check">
                      <input class="checkbox-primary form-check-input" id="checkbox1" name="remember" type="checkbox">
                      <label class="text-muted form-check-label" for="checkbox1">Remember password</label>
                    </div>
                    <button class="btn btn-primary btn-block w-100 mt-3" type="submit">Sign in</button>
                  </div>
                  {{-- <h6 class="text-muted mt-4 or">Or Sign in with</h6>
                  <div class="social mt-4">
                    <div class="btn-showcase"><a class="btn btn-light" href="https://www.linkedin.com/login" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a><a class="btn btn-light" href="https://twitter.com/login?lang=en" target="_blank"><i class="fa-brands fa-x-twitter"></i></a><a class="btn btn-light" href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a><a class="btn btn-light" href="https://www.google.com/" target="_blank"><i class="fa-brands fa-google"></i></a></div>
                  </div> --}}
                  {{-- <p class="mt-4 mb-0 text-center">Don't have account?<a class="ms-2" href="{{route('register')}}">Create Account</a></p> --}}
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3">
          
        </div>
      </div>
      
    </div>

    @endsection

@section('script')
@endsection
