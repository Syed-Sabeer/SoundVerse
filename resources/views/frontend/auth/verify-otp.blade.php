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
    text-align: center;
    letter-spacing: 5px;
    font-size: 24px;
    font-weight: bold;
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

.otp-info {
    background-color: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    border-left: 4px solid #667eea;
    font-size: 14px;
}

.resend-otp {
    text-align: center;
    margin-top: 20px;
    font-size: 14px;
}

.resend-otp a {
    color: #667eea;
    text-decoration: none;
}

.resend-otp a:hover {
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
                <h2>Verify OTP Code</h2>
                <p>Enter the 4-digit code sent to <strong>{{ session('reset_email') ?? old('email') }}</strong></p>
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

            <div class="otp-info">
                <strong>📧 Check your email</strong><br>
                We've sent a verification code to your email address. The code will expire in 10 minutes.
            </div>

            <a href="{{ route('password.forgot') }}" class="back-link">← Back</a>

            <form id="verifyOtpForm" method="POST" action="{{ route('password.verify-otp.post') }}">
                @csrf
                <input type="hidden" name="email" value="{{ session('reset_email') ?? old('email') }}">
                <input type="hidden" name="is_artist" id="is_artist" value="{{ session('reset_is_artist') ?? request('is_artist', 0) }}">
                
                <div class="form-group">
                    <input type="text" name="otp" id="otp" class="form-input" placeholder="0000" maxlength="4" pattern="[0-9]{4}" required autofocus>
                </div>

                <button type="submit" class="sign_up_btn" id="submitBtn">
                    Verify OTP
                </button>
            </form>

            <div class="resend-otp">
                <p>Didn't receive the code? <a href="#" id="resendOtpLink">Resend OTP</a></p>
            </div>
        </div>
    </div>
</div>

@include('partials.frontend.newsletter')

@endsection

@section('script')
<script>
// Auto-focus and format OTP input
const otpInput = document.getElementById('otp');
otpInput.addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
    if (this.value.length === 4) {
        document.getElementById('verifyOtpForm').submit();
    }
});

// Resend OTP
document.getElementById('resendOtpLink').addEventListener('click', function(e) {
    e.preventDefault();
    const email = '{{ session('reset_email') ?? old('email') }}';
    
    fetch('{{ route('password.forgot') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            email: email,
            is_artist: {{ request('is_artist', 0) }}
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('OTP code has been resent to your email.');
        } else {
            alert(data.message || 'Failed to resend OTP. Please try again.');
        }
    })
    .catch(error => {
        alert('An error occurred. Please try again.');
    });
});

document.getElementById('verifyOtpForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.textContent = 'Verifying...';
});
</script>
@endsection
