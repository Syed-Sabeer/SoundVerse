@extends('layouts.app.master')

@section('title', 'App Links Management')

@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>App Links</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item">CMS</li>
                        <li class="breadcrumb-item active">App Links</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h5>Update App Store Links</h5>
                        <p class="text-muted mb-0">These links will be displayed in the Download App section on the homepage.</p>
                    </div>
                    <div class="card-body add-post">
                        <form class="row g-3" method="POST" action="{{ route('admin.app-links.update') }}">
                            @csrf
                            @method('PUT')

                            <!-- Google Play Store -->
                            <div class="col-sm-12">
                                <div class="card border" style="border: 1px solid #dee2e6 !important; border-radius: 10px; overflow: hidden;">
                                    <div class="card-header d-flex align-items-center gap-3" style="background: linear-gradient(135deg, #34a853 0%, #2d8f47 100%); color: white; padding: 15px 20px;">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M3,20.5V3.5C3,2.91 3.34,2.39 3.84,2.15L13.69,12L3.84,21.85C3.34,21.61 3,21.09 3,20.5M16.81,15.12L6.05,21.34L14.54,12.85L16.81,15.12M20.16,10.81C20.5,11.08 20.75,11.5 20.75,12C20.75,12.5 20.53,12.9 20.18,13.18L17.89,14.5L15.39,12L17.89,9.5L20.16,10.81M6.05,2.66L16.81,8.88L14.54,11.15L6.05,2.66Z"/>
                                        </svg>
                                        <div>
                                            <h6 class="mb-0 fw-bold">Google Play Store</h6>
                                            <small style="opacity: 0.85;">Android app download link</small>
                                        </div>
                                    </div>
                                    <div class="card-body p-4">
                                        <label for="play_store_link" class="form-label fw-semibold">Play Store URL</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M3,20.5V3.5C3,2.91 3.34,2.39 3.84,2.15L13.69,12L3.84,21.85C3.34,21.61 3,21.09 3,20.5M16.81,15.12L6.05,21.34L14.54,12.85L16.81,15.12M20.16,10.81C20.5,11.08 20.75,11.5 20.75,12C20.75,12.5 20.53,12.9 20.18,13.18L17.89,14.5L15.39,12L17.89,9.5L20.16,10.81M6.05,2.66L16.81,8.88L14.54,11.15L6.05,2.66Z"/>
                                                </svg>
                                            </span>
                                            <input
                                                class="form-control @error('play_store_link') is-invalid @enderror"
                                                id="play_store_link"
                                                name="play_store_link"
                                                type="url"
                                                value="{{ old('play_store_link', $appLink->play_store_link ?? '') }}"
                                                placeholder="https://play.google.com/store/apps/details?id=your.app.id"
                                            >
                                            @error('play_store_link')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="text-muted mt-1 d-block">Example: https://play.google.com/store/apps/details?id=com.singwithme.app</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Apple App Store -->
                            <div class="col-sm-12">
                                <div class="card border" style="border: 1px solid #dee2e6 !important; border-radius: 10px; overflow: hidden;">
                                    <div class="card-header d-flex align-items-center gap-3" style="background: linear-gradient(135deg, #555 0%, #333 100%); color: white; padding: 15px 20px;">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M18.71,19.5C17.88,20.74 17,21.95 15.66,21.97C14.32,22 13.89,21.18 12.37,21.18C10.84,21.18 10.37,21.95 9.1,22C7.79,22.05 6.8,20.68 5.96,19.47C4.25,17 2.94,12.45 4.7,9.39C5.57,7.87 7.13,6.91 8.82,6.88C10.1,6.86 11.32,7.75 12.11,7.75C12.89,7.75 14.37,6.68 15.92,6.84C16.57,6.87 18.39,7.1 19.56,8.82C19.47,8.88 17.39,10.1 17.41,12.63C17.44,15.65 20.06,16.66 20.09,16.67C20.06,16.74 19.67,18.11 18.71,19.5M13,3.5C13.73,2.67 14.94,2.04 15.94,2C16.07,3.17 15.6,4.35 14.9,5.19C14.21,6.04 13.07,6.7 11.95,6.61C11.8,5.46 12.36,4.26 13,3.5Z"/>
                                        </svg>
                                        <div>
                                            <h6 class="mb-0 fw-bold">Apple App Store</h6>
                                            <small style="opacity: 0.85;">iOS app download link</small>
                                        </div>
                                    </div>
                                    <div class="card-body p-4">
                                        <label for="app_store_link" class="form-label fw-semibold">App Store URL</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M18.71,19.5C17.88,20.74 17,21.95 15.66,21.97C14.32,22 13.89,21.18 12.37,21.18C10.84,21.18 10.37,21.95 9.1,22C7.79,22.05 6.8,20.68 5.96,19.47C4.25,17 2.94,12.45 4.7,9.39C5.57,7.87 7.13,6.91 8.82,6.88C10.1,6.86 11.32,7.75 12.11,7.75C12.89,7.75 14.37,6.68 15.92,6.84C16.57,6.87 18.39,7.1 19.56,8.82C19.47,8.88 17.39,10.1 17.41,12.63C17.44,15.65 20.06,16.66 20.09,16.67C20.06,16.74 19.67,18.11 18.71,19.5M13,3.5C13.73,2.67 14.94,2.04 15.94,2C16.07,3.17 15.6,4.35 14.9,5.19C14.21,6.04 13.07,6.7 11.95,6.61C11.8,5.46 12.36,4.26 13,3.5Z"/>
                                                </svg>
                                            </span>
                                            <input
                                                class="form-control @error('app_store_link') is-invalid @enderror"
                                                id="app_store_link"
                                                name="app_store_link"
                                                type="url"
                                                value="{{ old('app_store_link', $appLink->app_store_link ?? '') }}"
                                                placeholder="https://apps.apple.com/app/idYOUR_APP_ID"
                                            >
                                            @error('app_store_link')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="text-muted mt-1 d-block">Example: https://apps.apple.com/us/app/singwithme/id123456789</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Preview -->
                            @if($appLink && ($appLink->play_store_link || $appLink->app_store_link))
                            <div class="col-sm-12">
                                <div class="card" style="background: #f8f9fa; border-radius: 10px;">
                                    <div class="card-header">
                                        <h6 class="mb-0">Current Active Links</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <strong>Play Store:</strong><br>
                                                @if($appLink->play_store_link)
                                                    <a href="{{ $appLink->play_store_link }}" target="_blank" class="text-success text-break">
                                                        {{ $appLink->play_store_link }}
                                                    </a>
                                                @else
                                                    <span class="text-muted">Not set</span>
                                                @endif
                                            </div>
                                            <div class="col-md-6 mt-3 mt-md-0">
                                                <strong>App Store:</strong><br>
                                                @if($appLink->app_store_link)
                                                    <a href="{{ $appLink->app_store_link }}" target="_blank" class="text-dark text-break">
                                                        {{ $appLink->app_store_link }}
                                                    </a>
                                                @else
                                                    <span class="text-muted">Not set</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Submit -->
                            <div class="col-sm-12 mt-4">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-save me-2"></i> Save App Links
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
