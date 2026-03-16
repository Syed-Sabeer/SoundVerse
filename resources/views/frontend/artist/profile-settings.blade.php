@extends('layouts.frontend.master')

@section('css')
<style>
    .profile-settings-wrapper {
        padding: 60px 0;
        background: radial-gradient(circle at top, #302b63 0, #0f0c29 45%, #000 100%);
        min-height: 100vh;
    }
    .profile-card {
        max-width: 900px;
        margin: 0 auto;
        background: rgba(15, 12, 41, 0.9);
        border-radius: 20px;
        border: 1px solid rgba(183, 148, 246, 0.3);
        box-shadow: 0 20px 40px rgba(0,0,0,0.5);
        overflow: visible !important;
        position: relative;
        z-index: 1;
    }
    .profile-banner-preview {
        height: 200px;
        background-size: cover;
        background-position: center;
        position: relative;
        border-radius: 20px 20px 0 0;
    }
    .profile-avatar-preview {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        border: 3px solid #fff;
        object-fit: cover;
        position: absolute;
        bottom: -55px;
        left: 40px;
        background: #111;
        z-index: 2;
    }
    .profile-header-content {
        padding: 70px 40px 20px 40px;
        color: #fff;
    }
    .profile-header-content h2 {
        margin-bottom: 5px;
        color: #fff;
    }
    .profile-header-content p {
        color: #b8a8d0;
        margin-bottom: 0;
        font-size: 0.95rem;
    }
    .profile-form {
        padding: 0 40px 30px 40px !important;
        color: #fff !important;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
        position: relative;
        z-index: 10;
    }
    .profile-form .form-label {
        color: #b8a8d0;
        font-weight: 500;
        margin-bottom: 8px;
        display: block;
    }
    .profile-form .form-control,
    .profile-form .form-control:focus {
        background: rgba(15, 12, 41, 0.9);
        border-color: rgba(183, 148, 246, 0.4);
        color: #fff;
        box-shadow: none;
        padding: 10px 15px;
    }
    .profile-form textarea {
        min-height: 120px;
        resize: vertical;
    }
    .profile-form .text-muted {
        color: #888 !important;
        font-size: 0.85rem;
    }
    .btn-save {
        background: linear-gradient(135deg, #b794f6, #9d50bb);
        color: #fff;
        border: none;
        border-radius: 999px;
        padding: 12px 32px;
        font-weight: 600;
        cursor: pointer;
        transition: opacity 0.3s;
    }
    .btn-save:hover {
        opacity: 0.95;
    }
    .alert {
        padding: 12px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    .alert-success {
        background: rgba(40, 167, 69, 0.2);
        border: 1px solid rgba(40, 167, 69, 0.5);
        color: #4ade80;
    }
    .alert-danger {
        background: rgba(220, 53, 69, 0.2);
        border: 1px solid rgba(220, 53, 69, 0.5);
        color: #f87171;
    }
    .alert ul {
        margin-bottom: 0;
        padding-left: 20px;
    }
    hr {
        border-color: rgba(255,255,255,0.1);
        margin: 30px 0;
    }
</style>
@endsection

@section('content')
<div class="profile-settings-wrapper">
    <div class="container">
        <div class="mb-4 text-center">
            <h1 style="color:#fff;">Artist Profile Settings</h1>
            <p style="color:#b8a8d0;">Update your account details, profile photo, banner and artist bio.</p>
        </div>

        <div class="profile-card">
            @php
                $profile = $profile ?? null;
                
                // Fix banner image path
                $banner = 'https://via.placeholder.com/1200x300?text=Artist+Banner';
                if ($profile && !empty($profile->banner_image)) {
                    if (strpos($profile->banner_image, 'http') === 0) {
                        $banner = $profile->banner_image;
                    } elseif (strpos($profile->banner_image, '/') === 0) {
                        // Already has leading slash
                        $banner = asset($profile->banner_image);
                    } elseif (strpos($profile->banner_image, 'storage/') === 0) {
                        $banner = asset($profile->banner_image);
                    } elseif (strpos($profile->banner_image, 'artist_banners/') === 0) {
                        $banner = asset('storage/' . $profile->banner_image);
                    } else {
                        $banner = asset('storage/' . $profile->banner_image);
                    }
                }
                
                // Fix avatar image path - ensure it uses storage path correctly
                $avatar = 'https://via.placeholder.com/200x200?text=Artist';
                if ($profile && !empty($profile->picture)) {
                    if (strpos($profile->picture, 'http') === 0) {
                        $avatar = $profile->picture;
                    } elseif (strpos($profile->picture, '/') === 0 && strpos($profile->picture, '/storage/') === 0) {
                        // Already has /storage/ prefix
                        $avatar = asset($profile->picture);
                    } elseif (strpos($profile->picture, 'storage/') === 0) {
                        $avatar = asset($profile->picture);
                    } elseif (strpos($profile->picture, 'artist_profiles/') === 0) {
                        // Path stored as artist_profiles/xxx.jpg
                        $avatar = asset('storage/' . $profile->picture);
                    } elseif (strpos($profile->picture, 'public/') === 0) {
                        // Remove public/ prefix if present
                        $avatar = asset(str_replace('public/', 'storage/', $profile->picture));
                    } else {
                        // Default: assume it needs storage/ prefix
                        $avatar = asset('storage/' . $profile->picture);
                    }
                }
                
                $displayName = $profile && ($profile->first_name || $profile->last_name)
                    ? trim($profile->first_name . ' ' . $profile->last_name)
                    : ($user->name ?? $user->username ?? 'Artist');
            @endphp

            <div class="profile-banner-preview" id="bannerPreview" style="background-image:url('{{ $banner }}');">
                <img src="{{ $avatar }}" alt="Artist avatar" id="avatarPreview" class="profile-avatar-preview">
            </div>

            <div class="profile-header-content">
                <h2>{{ $displayName }}</h2>
                <p>{{ $profile && $profile->about ? \Illuminate\Support\Str::limit($profile->about, 120) : 'Tell listeners who you are and what your music is about.' }}</p>
            </div>

            <form class="profile-form" method="POST" action="{{ route('artist.profile.update') }}" enctype="multipart/form-data">
                @csrf

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Account details --}}
                <div class="mb-4">
                    <h5 style="color:#fff; margin-bottom: 20px;">Account Details</h5>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Display Name</label>
                        <input type="text" name="name" class="form-control"
                               value="{{ old('name', $user->name ?? '') }}" placeholder="Enter your display name">
                        @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control"
                               value="{{ old('email', $user->email ?? '') }}" placeholder="Enter your email">
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">New Password</label>
                        <input type="password" name="password" class="form-control" autocomplete="new-password" placeholder="Enter new password">
                        <small class="text-muted">Leave blank to keep your current password.</small>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password" placeholder="Confirm new password">
                    </div>
                </div>

                <hr>

                <div class="mb-4">
                    <h5 style="color:#fff; margin-bottom: 20px;">Public Artist Profile</h5>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" 
                               value="{{ old('first_name', $profile->first_name ?? '') }}" 
                               placeholder="Enter your first name">
                        @error('first_name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" 
                               value="{{ old('last_name', $profile->last_name ?? '') }}" 
                               placeholder="Enter your last name">
                        @error('last_name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Artist Bio</label>
                    <textarea name="about" class="form-control" maxlength="1000" 
                              placeholder="Share your story, style, and what listeners can expect from your music.">{{ old('about', $profile->about ?? '') }}</textarea>
                    <small class="text-muted">Maximum 1000 characters.</small>
                    @error('about')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Profile Photo</label>
                        <input type="file" name="picture" class="form-control" 
                               accept="image/jpeg,image/png,image/jpg,image/webp,image/avif" 
                               onchange="previewImage(event, 'avatarPreview')">
                        <small class="text-muted">Recommended: square image, at least 400x400px. Max 4MB.</small>
                        @error('picture')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Banner Image</label>
                        <input type="file" name="banner_image" class="form-control" 
                               accept="image/jpeg,image/png,image/jpg,image/webp,image/avif" 
                               onchange="previewBanner(event, 'bannerPreview')">
                        <small class="text-muted">Recommended: wide image, at least 1200x300px. Max 6MB.</small>
                        @error('banner_image')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn-save">Save Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(event, targetId) {
    const file = event.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        const img = document.getElementById(targetId);
        if (img) {
            img.src = e.target.result;
        }
    };
    reader.readAsDataURL(file);
}

function previewBanner(event, targetId) {
    const file = event.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        const banner = document.getElementById(targetId);
        if (banner) {
            banner.style.backgroundImage = 'url(' + e.target.result + ')';
        }
    };
    reader.readAsDataURL(file);
}
</script>
@endsection
