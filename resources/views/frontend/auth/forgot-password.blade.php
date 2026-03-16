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

.form-input {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #ddd;
    border-radius: 8px;
    font-size: 16px;
    margin-bottom: 16px;
    transition: border-color 0.3s;
}

.form-input:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.sign_up_btn {
    width: 100%;
    padding: 12px 16px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}

.sign_up_btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
}

.sign_up_btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

.back-link {
    color: #667eea;
    text-decoration: none;
    display: inline-block;
    margin-bottom: 20px;
    font-size: 14px;
}

.back-link:hover {
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
                <h2>Forgot Password</h2>
                <p>Enter your email address and we'll send you an OTP code to reset your password</p>
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
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('artist.login') }}" class="back-link">← Back to Login</a>

            <form id="forgotPasswordForm" method="POST" action="{{ route('password.send-otp') }}">
                @csrf
                <input type="hidden" name="is_artist" id="is_artist" value="{{ request('is_artist', 0) }}">
                
                <div class="form-group">
                    <input type="email" name="email" id="email" class="form-input" placeholder="Email Address" value="{{ old('email') }}" required>
                </div>

                <button type="submit" class="sign_up_btn" id="submitBtn">
                    Send OTP Code
                </button>
            </form>

            <div style="text-align: center; margin-top: 20px; font-size: 14px; color: #666;">
                <p>Remember your password? <a href="{{ route('artist.login') }}" style="color: #667eea;">Login here</a></p>
            </div>
        </div>
    </div>
</div>

@include('partials.frontend.newsletter')

@endsection

@section('script')
<script>
document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.textContent = 'Sending OTP...';
});
</script>
@endsection
