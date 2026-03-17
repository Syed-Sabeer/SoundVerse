@extends('layouts.frontend.master')

@section('meta')
    <title>Certified Creators | SingWithMe</title>
    <meta name="description" content="Discover all verified and certified creators on SingWithMe. Browse authentic artists making waves in the music industry.">
    <meta name="keywords" content="certified creators, verified artists, music platform, singers">
    <meta property="og:title" content="Certified Creators | SingWithMe">
    <meta property="og:description" content="Discover all verified and certified creators on SingWithMe.">
@endsection

@section('css')
<style>
    .certified-creators-hero {
        background: linear-gradient(135deg, #b794f6 0%, #120b28 100%);
        color: white;
        padding: 60px 0;
        text-align: center;
        margin-bottom: 40px;
    }

    .certified-creators-hero h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .certified-creators-hero p {
        font-size: 1.1rem;
        opacity: 0.95;
        max-width: 600px;
        margin: 0 auto;
    }

    .filter-section {
        background: rgba(255, 255, 255, 0.05);
        padding: 25px;
        border-radius: 12px;
        margin-bottom: 35px;
        backdrop-filter: blur(10px);
    }

    .filter-section .form-control {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
        padding: 10px 15px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .filter-section .form-control:focus {
        background: rgba(255, 255, 255, 0.15);
        border-color: #b794f6;
        box-shadow: 0 0 10px rgba(183, 148, 246, 0.3);
        color: #fff;
    }

    .filter-section .form-control::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .certified-creators-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    .certified-creator-card {
        background: linear-gradient(135deg, rgba(183, 148, 246, 0.1) 0%, rgba(18, 11, 40, 0.5) 100%);
        border: 1px solid rgba(183, 148, 246, 0.3);
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .certified-creator-card:hover {
        transform: translateY(-8px);
        border-color: #b794f6;
        box-shadow: 0 15px 40px rgba(183, 148, 246, 0.2);
    }

    .creator-image-wrapper {
        position: relative;
        width: 100%;
        height: 220px;
        overflow: hidden;
        background: #1a1a2e;
    }

    .creator-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .certified-creator-card:hover .creator-image {
        transform: scale(1.05);
    }

    .certified-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: linear-gradient(135deg, #0a5c49 0%, #0d7f73 100%);
        color: white;
        padding: 8px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 5px;
        box-shadow: 0 4px 15px rgba(10, 92, 73, 0.3);
    }

    .certified-badge svg {
        width: 14px;
        height: 14px;
    }

    .creator-info {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .creator-name {
        font-size: 1.2rem;
        font-weight: 700;
        color: white;
        margin-bottom: 5px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .creator-username {
        color: #b794f6;
        font-size: 0.9rem;
        margin-bottom: 12px;
    }

    .creator-stats {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }

    .stat {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .stat-value {
        color: white;
        font-weight: 700;
        font-size: 1.1rem;
    }

    .stat-label {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.8rem;
    }

    .creator-actions {
        display: flex;
        gap: 10px;
        margin-top: auto;
    }

    .action-btn {
        flex: 1;
        padding: 10px 12px;
        border: none;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
        text-align: center;
    }

    .view-profile-btn {
        background: linear-gradient(135deg, #b794f6 0%, #7f5fa8 100%);
        color: white;
    }

    .view-profile-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(183, 148, 246, 0.3);
    }

    .no-creators {
        text-align: center;
        padding: 60px 20px;
        color: rgba(255, 255, 255, 0.6);
    }

    .no-creators svg {
        width: 80px;
        height: 80px;
        margin-bottom: 20px;
        opacity: 0.5;
    }

    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 40px;
    }

    .pagination {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .pagination a,
    .pagination span {
        padding: 10px 15px;
        border-radius: 8px;
        background: rgba(183, 148, 246, 0.1);
        color: #b794f6;
        text-decoration: none;
        border: 1px solid rgba(183, 148, 246, 0.3);
        transition: all 0.3s ease;
    }

    .pagination a:hover {
        background: #b794f6;
        color: white;
        border-color: #b794f6;
    }

    .pagination .active span {
        background: #b794f6;
        color: white;
        border-color: #b794f6;
    }

    @media (max-width: 768px) {
        .certified-creators-hero h1 {
            font-size: 1.8rem;
        }

        .certified-creators-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }

        .creator-image-wrapper {
            height: 180px;
        }
    }
</style>
@endsection

@section('content')

<!-- Hero Section -->
<div class="certified-creators-hero">
    <div class="container">
        <h1>✓ Certified Creators</h1>
        <p>Discover verified artists who are making waves in the music industry with their unique sounds and authentic voices.</p>
    </div>
</div>

<!-- Main Content -->
<div class="container" style="margin-bottom: 60px;">
    <!-- Filter Section -->
    <div class="filter-section">
        <div class="row align-items-end">
            <div class="col-md-6">
                <label style="color: #b794f6; font-weight: 600; margin-bottom: 8px; display: block;">Search Certified Creators</label>
                <input type="text" class="form-control" placeholder="Search by name, username..." id="searchInput">
            </div>
            <div class="col-md-6 text-end mt-3 mt-md-0">
                <small style="color: rgba(255,255,255,0.7);">Found <strong style="color: #b794f6;">{{ $certified_artists->total() }}</strong> certified creators</small>
            </div>
        </div>
    </div>

    <!-- Certified Creators Grid -->
    @if($certified_artists->count() > 0)
        <div class="certified-creators-grid">
            @foreach($certified_artists as $artist)
                @php
                    $profile = $artist->profile;
                    $avatar = $profile && $profile->picture
                        ? asset('storage/' . $profile->picture)
                        : 'https://img.freepik.com/premium-photo/musician-recording-song-home-studio_919955-56272.jpg';
                    $name = $artist->name ?? $artist->username ?? 'Artist';
                    $username = '@' . ($artist->username ?? 'unknown');
                @endphp
                <a href="{{ route('artist-profile', ['artist' => $artist->id]) }}" style="text-decoration: none; color: inherit;">
                    <div class="certified-creator-card">
                        <div class="creator-image-wrapper">
                            <img src="{{ $avatar }}" alt="{{ $name }}" class="creator-image">
                            <div class="certified-badge">
                                <svg fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Certified
                            </div>
                        </div>
                        <div class="creator-info">
                            <h3 class="creator-name" title="{{ $name }}">{{ $name }}</h3>
                            <div class="creator-username">{{ $username }}</div>
                            <div class="creator-stats">
                                <div class="stat" style="flex: 1; text-align: center;">
                                    <div class="stat-value">0</div>
                                    <div class="stat-label">Followers</div>
                                </div>
                                <div class="stat" style="flex: 1; text-align: center;">
                                    <div class="stat-value">0</div>
                                    <div class="stat-label">Listeners</div>
                                </div>
                            </div>
                            <div class="creator-actions">
                                <button class="action-btn view-profile-btn">View Profile</button>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($certified_artists->hasPages())
            <div class="pagination-wrapper">
                {{ $certified_artists->links() }}
            </div>
        @endif
    @else
        <!-- No Creators Message -->
        <div class="no-creators">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
            </svg>
            <h3 style="color: white; margin-bottom: 10px;">No Certified Creators Yet</h3>
            <p>Artists are working on their certification. Check back soon for verified creators!</p>
        </div>
    @endif
</div>

@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const cards = document.querySelectorAll('.certified-creator-card');

        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();

                cards.forEach(card => {
                    const name = card.querySelector('.creator-name').textContent.toLowerCase();
                    const username = card.querySelector('.creator-username').textContent.toLowerCase();

                    if (name.includes(searchTerm) || username.includes(searchTerm)) {
                        card.closest('a').style.display = 'block';
                    } else {
                        card.closest('a').style.display = 'none';
                    }
                });
            });
        }
    });
</script>
@endsection
