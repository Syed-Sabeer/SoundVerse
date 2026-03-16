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

.password-group {
    position: relative;
}

.password-group .form-input {
    padding-right: 42px;
}

.toggle-password {
    position: absolute;
    top: 40% !important;
    right: 12px;
    transform: translateY(-50%);
    cursor: pointer;
    color: #888;
}

.toggle-password:hover {
    color: #555;
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
                <h2>User Login</h2>
                <p>Don't have an account? <a href="{{ route('user.register') }}">Register as User</a></p>
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

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success" style="background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724;">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.attempt') }}">
                @csrf
                <div class="form-group">
                    <input type="text" name="email_username" class="form-input" placeholder="Email Address or Username" value="{{ old('email_username') }}" required autocomplete="username">
                </div>

                <div class="form-group password-group">
                <input 
                    type="password" 
                    name="password" 
                    id="password"
                    class="form-input" 
                    placeholder="Password" 
                    required 
                    autocomplete="current-password"
                >
                <span class="toggle-password" onclick="togglePassword()">
                    <i class="fa-solid fa-eye"></i>
                </span>
            </div>

                <div class="checkbox-group">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember me</label>
                </div>

                <div style="text-align: right; margin-bottom: 16px;">
                    <a href="{{ route('password.forgot') }}" style="color: #667eea; text-decoration: none; font-size: 14px;">Forgot Password?</a>
                </div>

                <button type="submit" class="sign_up_btn">Login</button>
            </form>
        </div>
    </div>
</div>

@include('partials.frontend.newsletter')

<script>
function togglePassword() {
    const passwordInput = document.getElementById("password");
    const icon = document.querySelector(".toggle-password i");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
</script>
@endsection
