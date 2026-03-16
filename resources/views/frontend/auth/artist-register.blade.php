@extends('layouts.frontend.master')


@section('css')
<style>
.alert {
    padding: 12px 16px;
    margin-bottom: 20px;
    border-radius: 8px;
    font-size: 14px;
}

.alert-danger {
    background-color: #fee;
    border: 1px solid #fcc;
    color: #c33;
}

.alert ul {
    margin: 0;
    padding-left: 20px;
}

.form-input {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 16px;
    margin-bottom: 16px;
}

.form-input:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
}

.sign_up_btn {
    width: 100%;
    padding: 12px 16px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    text-align: center;
    transition: background-color 0.3s;
}

.sign_up_btn:hover {
    background-color: #0056b3;
    color: white;
    text-decoration: none;
}

.checkbox-group {
    display: flex;
    align-items: flex-start;
    margin-bottom: 16px;
}

.checkbox-group input[type="checkbox"] {
    margin-right: 8px;
    margin-top: 2px;
}

.checkbox-group label {
    font-size: 14px;
    line-height: 1.4;
    color: #666;
}

.checkbox-group a {
    color: #007bff;
    text-decoration: none;
}

.checkbox-group a:hover {
    text-decoration: underline;
}
</style>
@endsection

@section('content')


<div class="signup-app mt-5">
            <div class="bg-dots"></div>
            <div class="crowd-silhouette"></div>

            <div class="container">
                <div class="left-section">
                    <div class="logo">SINGWITHME</div>
                    <div class="tagline">
                        Start your <span class="free-trial">30-day free trial</span> now
                    </div>
                    <div class="music-platforms">
                        <div class="platform-logo">
                            <img src="{{ asset('FrontendAssets/images/singWithMe/spotify_img.jpeg')}}" alt="" style="border-radius: 15px;">
                        </div>
                        <div class="platform-logo">
                            <img src="{{ asset('FrontendAssets/images/singWithMe/amazon_img.jpeg')}}" alt="" style="border-radius: 15px;">
                        </div>
                        <div class="platform-logo">
                            <img src="{{ asset('FrontendAssets/images/singWithMe/youtube.jpg')}}" alt="" style="border-radius: 15px;">
                        </div>
                        <div class="platform-logo">
                            <img src="{{ asset('FrontendAssets/images/singWithMe/tiktok.webp')}}" alt="" style="border-radius: 15px;">
                        </div>
                        <div class="platform-logo">
                           <img src="{{ asset('FrontendAssets/images/singWithMe/vevo_img.jpeg')}}" alt="" style="border-radius: 15px;">
                        </div>
                        <div class="platform-logo">
                            <img src="{{ asset('FrontendAssets/images/singWithMe/insta_img.jpeg')}}" alt="" style="border-radius: 15px;">
                        </div>
                    </div>
                </div>

                <div class="right-section">
                    <div class="form-header">
                        <h2>Create Artist Account</h2>
                        <p>Already have an account? <a href="{{ route('artist.login') }}">Log in as Artist</a></p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register.attempt') }}">
                        @csrf
                        <input type="hidden" name="is_artist" value="1">
                        <div class="form-group">
                            <input type="text" name="name" class="form-input" placeholder="Full Name" value="{{ old('name') }}" required>
                        </div>

                        <div class="form-group">
                            <input type="email" name="email" class="form-input" placeholder="Email Address" value="{{ old('email') }}" required>
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" class="form-input" placeholder="Password" required>
                        </div>

                        <div class="form-group">
                            <input type="password" name="password_confirmation" class="form-input" placeholder="Confirm Password" required>
                        </div>

                        <div class="checkbox-group">
                            <input type="checkbox" id="updates" name="newsletter" value="1">
                            <label for="updates">Keep me up to date with music industry news and promotions</label>
                        </div>

                        <div class="checkbox-group">
                            <input type="checkbox" id="terms" name="terms" value="1" required>
                            <label for="terms">I have read and agree to SingWithMe's <a href="#">terms of
                                    service</a></label>
                        </div>

                        <button type="submit" class="sign_up_btn">Register as Artist</button>
                    </form>

                    {{-- <div class="divider">
                        <span>OR</span>
                    </div>

                    <button class="google-btn">
                        <svg class="google-icon" viewBox="0 0 24 24">
                            <path fill="#4285F4"
                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                            <path fill="#34A853"
                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                            <path fill="#FBBC05"
                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                            <path fill="#EA4335"
                                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                        </svg>
                        Continue with Google
                    </button> --}}

                    <div class="disclaimer">
                        Protected by reCAPTCHA and subject to the Google Privacy Policy and Terms of Service.
                    </div>
                </div>
            </div>
        </div>





@include('partials.frontend.newsletter')


@endsection
