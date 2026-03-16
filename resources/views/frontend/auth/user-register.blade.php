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

.alert-success {
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
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
                <h2>Create User Account</h2>
                <p>Already have an account? <a href="{{ route('user.login') }}">Log in</a></p>
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

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('register.attempt') }}">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" class="form-input" placeholder="Full Name" value="{{ old('name') }}" required autocomplete="name">
                </div>

                <div class="form-group">
                    <input type="email" name="email" class="form-input" placeholder="Email Address" value="{{ old('email') }}" required autocomplete="email">
                </div>

                <div class="form-group">
                    <input type="password" name="password" class="form-input" placeholder="Password" required autocomplete="new-password" minlength="8">
                </div>

                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-input" placeholder="Confirm Password" required autocomplete="new-password">
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="updates" name="newsletter" value="1">
                    <label for="updates">Keep me up to date with music industry news and promotions</label>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="terms" name="terms" value="1" required>
                    <label for="terms">I have read and agree to SingWithMe's <a href="#">terms of service</a></label>
                </div>

                <button type="submit" class="sign_up_btn">Register</button>
            </form>

            <div class="disclaimer" style="margin-top: 20px; font-size: 12px; color: #666; text-align: center;">
                Protected by reCAPTCHA and subject to the Google Privacy Policy and Terms of Service.
            </div>
        </div>
    </div>
</div>

@include('partials.frontend.newsletter')

@endsection
