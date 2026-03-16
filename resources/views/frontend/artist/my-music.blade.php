@extends('layouts.frontend.master')

@section('css')
<style>
    .my-music-wrapper {
        padding: 60px 0;
        background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
        min-height: 100vh;
    }
    .music-card {
        background: rgba(15, 12, 41, 0.9);
        border-radius: 16px;
        border: 1px solid rgba(183, 148, 246, 0.2);
        padding: 18px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 12px;
    }
    .music-card .info {
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .music-card .thumb {
        width: 64px;
        height: 64px;
        border-radius: 8px;
        background-size: cover;
        background-position: center;
        background-color: #111;
    }
    .music-card .title {
        color: #fff;
        margin: 0;
        font-size: 1rem;
        font-weight: 600;
    }
    .music-card .meta {
        color: #b8a8d0;
        font-size: 0.85rem;
        margin: 0;
    }
    .music-card .actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .music-card .actions .music-controls-item {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        background: rgba(183, 148, 246, 0.15);
    }
    .music-card .actions .music-controls-item--icon {
        color: #fff;
    }
</style>
@endsection

@section('content')
<div class="my-music-wrapper">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <div>
                    <h2 style="color:#fff;">My Uploaded Songs</h2>
                    <p style="color:#b8a8d0;">All tracks you’ve uploaded to SingWithMe.</p>
                </div>
                <a href="{{ route('artist.portal') }}" class="btn btn-outline-light">Back to Artist Portal</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @forelse($userMusics as $music)
                    @php
                        $thumb = $music->thumbnail_image_url
                            ?? 'https://via.placeholder.com/200x200?text=Track';
                    @endphp
                    <div class="music-card">
                        <div class="info">
                            <div class="thumb" style="background-image:url('{{ $thumb }}');"></div>
                            <div>
                                <p class="title">{{ $music->name }}</p>
                                <p class="meta">
                                    Uploaded {{ $music->created_at?->format('M d, Y') ?? '' }}
                                    @if($music->isrc_code)
                                        <br><span style="color: #b794f6; font-weight: 600;">ISRC: {{ $music->isrc_code }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="actions">
                            <div data-id="{{ $music->id }}" class="music-controls-item play play_btn">
                                <i class="fas fa-play music-controls-item--icon play-icon"></i>
                            </div>
                        </div>
                    </div>
                @empty
                    <p style="color:#b8a8d0;">You haven’t uploaded any songs yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
