@extends('layouts.frontend.master')


@section('css')
<style>
        :root {
            /* Color Palette */
            --bg-deep: #0a0a0c;
            --accent-red: #ff3344;
            --glass: rgba(255, 255, 255, 0.04);
            --glass-border: rgba(255, 255, 255, 0.1);
            --text-main: #ffffff;
            --text-dim: #a0a0a0;
        }

        .artistProfileSec {
            position:relative;
            padding:1rem 0;
        }
        .albums-section:after{
            display:none !important;
        }
        .artistProfileSec .artistcontainer {
        max-width: 1600px;
        width: 95vw;
        height: auto;
        display: grid;
        //grid-template-columns: 240px 1fr 300px;
        grid-template-columns: 240px 1fr;
        grid-template-rows: 1fr 100px;
        gap: 15px;
    }

/* --- Glass Effect Reusable --- */
.artistProfileSec .glass {
    background: var(--glass);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid var(--glass-border);
    border-radius: 24px;
}

/* --- Sidebar (Left) --- */
.artistProfileSec .sidebar {
    grid-row: 1 / 2;
    padding: 25px;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    overflow-y: auto;
    height: 700px;
}

.artistProfileSec .sidebar::-webkit-scrollbar {
    width: 0;
}

/* Hide scrollbar */
.artistProfileSec .logo {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 20px;
    color: var(--accent-red);
}

.artistProfileSec .logo img {
    width: 50%;
    margin: 0 auto;
    display: flex;
}

.artistProfileSec .nav-group {
    margin-bottom: 20px;
}

.artistProfileSec .nav-label {
    font-size: 11px;
    color: var(--text-dim);
    letter-spacing: 1.5px;
    margin-bottom: 10px;
    text-transform: uppercase;
}

.artistProfileSec .nav-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 5px 0;
    color: var(--text-dim);
    text-decoration: none;
    transition: 0.3s;
    cursor: pointer;
}

.artistProfileSec .nav-item:hover,
.artistProfileSec .nav-item.active {
    color: white;
}

.artistProfileSec .nav-item.active {
    border-right: 3px solid #9465e4;
    color: white;
}

/* Friend's Room Specific Styles */
.artistProfileSec .friend-card {
    display: flex;
    align-items: center;
    padding: 0px 10px;
    border-radius: 12px;
    margin-bottom: 10px;
    cursor: pointer;
    transition: 0.2s;
    background: rgba(255, 255, 255, 0.03);
}

.artistProfileSec .friend-card:hover {
    background: rgba(255, 255, 255, 0.08);
}

.artistProfileSec .friend-card img {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    margin-right: 10px;
}

.artistProfileSec .friend-card .info p {
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 0;
}

.artistProfileSec .friend-card .info small {
    font-size: 11px;
    color: var(--text-dim);
}

.artistProfileSec .friend-card i {
    margin-left: auto;
    font-size: 10px;
    color: #9465e4;
}

/* User Account Footer in Sidebar */
.artistProfileSec .user-account {
    margin-top: auto;
    padding: 15px;
    margin: 15px -15px -15px -15px;
    background: rgba(255, 255, 255, 0.08);
    border-radius: 0 0 24px 24px;
    border-top: 1px solid var(--glass-border);
    display: flex;
    align-items: center;
    gap: 10px;
}

.artistProfileSec .user-account img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}
.user-account p {
    margin-bottom:0;
    margin-bottom: 0;
    font-family: 'Poppins';
    font-weight: 400;
    color: white;
}

.artworkUploaded-Sec .gallery-grid {
        display: grid;
    grid-template-columns: repeat(3, 1fr 100%);
    gap: 6px;
    grid-auto-rows: 350px;
}

.album-art::before {
    position:unset !important;
}
.artistProfileSec .user-account .info small {
    font-size: 10px;
}

.artistProfileSec .user-account i {
    margin-left: auto;
}

/* --- Main Content Area --- */
.artistProfileSec .main-container {
    grid-column: 2 / 3;
    overflow-y: hidden;
}

.artistProfileSec .main-content {
    height: 100%;
    overflow-y: auto;
    padding-right: 10px;
    display: none;
    visibility: visible !important;
    opacity: 1 !important;
    position: relative;
    z-index: 1;
}
.main-content h2, .main-content h2 + p {
    color:white !important;
}
.artistProfileSec .main-content.active {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
}

/* Ensure all content sections are visible */
.artistProfileSec .main-content .secartistAbout,
.artistProfileSec .main-content .artworkUploaded-Sec,
.artistProfileSec .main-content .liked-songs-section {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
}

.artistProfileSec .main-content .bio-section,
.artistProfileSec .main-content .detail-card,
.artistProfileSec .main-content .social-section,
.artistProfileSec .main-content .artist-header,
.artistProfileSec .main-content .songs-table {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
}

.artistProfileSec .main-content .bio-section .section-title,
.artistProfileSec .main-content .bio-section .bio-text,
.artistProfileSec .main-content .artist-header .header-content,
.artistProfileSec .main-content .artist-header .artist-info {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
    color: #ffffff !important;
}

.artistProfileSec .main-content::-webkit-scrollbar {
    width: 5px;
}

.artistProfileSec .main-content::-webkit-scrollbar-thumb {
    background: var(--glass-border);
    border-radius: 10px;
}

/* Hero Banner */
.artistProfileSec .hero {
    height: 320px;
    background: linear-gradient(to right, rgba(0, 0, 0, 0.8), transparent),
        url('https://img.freepik.com/premium-photo/desk-with-collection-vintage-vinyl-records_974629-215719.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_hybrid&w=740&q=80') center/cover;
    border-radius: 24px;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 40px;
    margin-bottom: 25px;
    position: relative;
}

.artistProfileSec .artist-avatar {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    position: absolute;
    top: 20px;
    left: 30px;
    border: 3px solid #9665ec;
    z-index: 2;
}

.artistProfileSec .hero-title {
    font-size: 48px;
    margin-bottom: 20px;
    color:white;
}

.artistProfileSec .hero-btns {
    display: flex;
    gap: 15px;
}

.artistProfileSec .hero-btns .btn,
.artistProfileSec .liked-actions .btn {
    padding: 10px 20px;
    font-size: 14px;
    border-radius: 30px;
    cursor: pointer;
    border: none;
}

.artistProfileSec .btn-play {
    background: #673AB7;
    color: white;
    font-weight: 600;
}

.artistProfileSec .btn-outline {
        background: #0000006e !important;
    border: 1px solid var(--accent-red);
    color: #f9f9f9;
    font-weight: 600;
    backdrop-filter: blur(15px);
    border: 2px solid #ffffff91 !important;
}
.artistProfileSec .btn-outline:focus {
    box-shadow:unset;
    }
/* Song List (Track table) */
.artistProfileSec .songs-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 25px;
}

.artistProfileSec .songs-table th {
    text-align: left;
    color: var(--text-dim);
    font-size: 13px;
    padding-bottom: 15px;
}

.artistProfileSec .song-row {
    cursor: pointer;
    border-radius: 12px;
    transition: 0.2s;
}

.artistProfileSec .song-row:hover {
    background: rgba(255, 255, 255, 0.05);
}

.artistProfileSec .song-row td {
    padding: 12px;
    font-size: 14px;
}

.artistProfileSec .song-row .song-title-cell {
    display: flex;
    align-items: center;
    gap: 15px;
}

.artistProfileSec .song-row .song-img {
    width: 35px;
    height: 35px;
    border-radius: 8px;
    object-fit: cover;
}

.artistProfileSec .song-row td:last-child {
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.artistProfileSec .song-row td:last-child:hover {
    transform: scale(1.2);
}

.artistProfileSec .song-row td:last-child i.fas.fa-heart {
    color: #ff3344;
}

.artistProfileSec .song-row.playing {
    color: #9465e4;
}

/* --- Albums Section --- */
.artistProfileSec .albums-section {
    margin-bottom: 20px;
     position: unset; 
     padding: unset; 
     overflow: unset;
}

.artistProfileSec .albums-section h3 {
    margin-bottom: 15px;
    font-size: 18px;
}

.artistProfileSec .albums-list {
    display: flex;
    gap: 20px;
    overflow-x: auto;
    padding-bottom: 10px;
    -ms-overflow-style: none;
    scrollbar-width: none;
    padding: 5px 0;
}

.artistProfileSec .albums-list::-webkit-scrollbar {
    display: none;
}

.artistProfileSec .album-card {
    flex-shrink: 0;
    width: 150px;
    cursor: pointer;
    transition: 0.3s;
}

.artistProfileSec .album-card:hover {
    transform: translateY(-5px);
}

.artistProfileSec .album-art {
    width: 150px;
    height: 150px;
    border-radius: 12px;
    object-fit: cover;
    margin-bottom: 10px;
    position: relative;
}

.artistProfileSec .album-art .duration {
    position: absolute;
    bottom: 5px;
    right: 5px;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 2px 6px;
    border-radius: 4px;
    font-size: 10px;
}

.artistProfileSec .album-card p {
    font-weight: 600;
    font-size: 14px;
    margin-bottom:0;
}

.artistProfileSec .album-card small {
    color: var(--text-dim);
    font-size: 12px;
}

/* --- Right Sidebar (Videos) --- */
.artistProfileSec .video-sidebar {
    grid-column: 3 / 4;
    padding: 20px;
}
h1,h2,h3 {
    color: unset;
     font-family: 'Inter', sans-serif;
     font-weight: 600; 
     position: unset; 
     pointer-events: unset;
}
.video-sidebar h3 {
     color: unset;
     font-family: unset; 
     font-weight: unset; 
     position: unset; 
     pointer-events: unset;
}
.artistProfileSec .video-card {
    background: rgba(255, 255, 255, 0.03);
    border-radius: 15px;
    padding: 10px;
    margin-bottom: 15px;
    display: flex;
    gap: 12px;
    transition: 0.3s;
    cursor: pointer;
}
.artistProfileSec .video-card p {
    margin-bottom:0px;
}
.artistProfileSec .video-card:hover {
    background: rgba(255, 255, 255, 0.08);
}

.artistProfileSec .v-thumb {
    width: 90px;
    height: 60px;
    background: #333;
    border-radius: 8px;
}

/* Liked Songs */
.artistProfileSec .liked-songs-section {
    padding: 20px 0;
}

.artistProfileSec .liked-songs-section h2 {
    font-size: 30px;
    margin-bottom: 5px;
}

.artistProfileSec .count-info {
    color: var(--text-dim);
    font-size: 14px;
    margin-bottom: 25px;
}

.artistProfileSec .liked-actions {
    display: flex;
    gap: 15px;
    margin-bottom: 30px;
}

/* Artist Cards */
.artistProfileSec .artist-cards-section {
    padding: 20px 0;
    margin-bottom: 20px;
}

.gallery-header .btn-play {
    margin-top:30px !important;
    font-weight: 500 !important;
    font-size: 14px;
    padding: 8px 30px;
    border-radius: 25px;
    border:2px solid transparent;
    transition: .4s all ease-in-out;
}
.gallery-header .btn-play:hover{
    background:transparent;
    border:2px solid white;
}
.gallery-header .btn-play:focus{
    box-shadow:none;
}
.artistProfileSec .artist-cards-section h2 {
    font-size: 24px;
    margin-bottom: 25px;
    color: var(--text-main);
}

.artistProfileSec .artist-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 20px;
}

.artistProfileSec .artist-card {
    position: relative;
    height: 300px;
    padding: 15px;
    border-radius: 20px;
    overflow: hidden;
    cursor: pointer;
    transition: transform 0.3s ease, background 0.3s ease;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
}

.artistProfileSec .artist-card:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.1);
}

.artistProfileSec .card-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    opacity: 0.5;
    transition: opacity 0.3s;
}

.artistProfileSec .artist-card:hover .card-background {
    opacity: 0.8;
}

.artistProfileSec .card-info {
    position: relative;
    z-index: 1;
    color: var(--text-main);
}

.artistProfileSec .card-info h3 {
    font-size: 24px;
    margin-bottom: 5px;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.8);
}

.artistProfileSec .card-info p {
    font-size: 14px;
    color: var(--text-dim);
    margin-bottom: 15px;
}

.artistProfileSec .follow-btn {
    padding: 8px 15px;
    border-radius: 20px;
    border: 1px solid white;
    background: transparent;
    color: white;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}

.artistProfileSec .follow-btn i {
    margin-right: 5px;
}

.artistProfileSec .follow-btn:hover {
    background: rgba(255, 255, 255, 0.2);
}

.artistProfileSec .follow-btn.active {
    background: var(--accent-red);
    border-color: var(--accent-red);
    color: white;
}

/* --- Player Bar --- */
.artistProfileSec .player-bar {
    grid-column: 1 / 4;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 8px 40px;
    position: fixed;
    z-index: 999999999999999999999;
    bottom: 10px;
    width: 94%;
}

.artistProfileSec .current-track {
    display: flex;
    align-items: center;
    gap: 15px;
    width: 300px;
}

.artistProfileSec .track-img {
    width: 55px;
    height: 55px;
    border-radius: 10px;
    background: #333;
}

.artistProfileSec .player-controls {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
}

.artistProfileSec .ctrl-btns {
    display: flex;
    align-items: center;
    gap: 25px;
    font-size: 18px;
}

.artistProfileSec .play-trigger {
    width: 45px;
    height: 45px;
    background: white;
    color: black;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
}

.artistProfileSec .progress-area {
    display: flex;
    align-items: center;
    gap: 10px;
    width: 100%;
    max-width: 600px;
}

.artistProfileSec .progress-bar {
    flex: 1;
    height: 4px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 2px;
    position: relative;
    cursor: pointer;
    margin:0;
}

.artistProfileSec .progress-fill {
    width: 0%;
    height: 100%;
    background: #9465e4;
    border-radius: 2px;
    transition: 0.1s;
}

.artworkUploaded-Sec .gallery-item img {
    height: 300px;
}

/* ================= RESPONSIVE ================= */

/* Large Tablets */
@media (max-width: 1200px) {
    .artistProfileSec .container {
        grid-template-columns: 220px 1fr;
        grid-template-rows: 1fr 100px;
    }

    .artistProfileSec .video-sidebar {
        display: none;
    }
}

/* Tablets */
@media (max-width: 992px) {
    .artistProfileSec {
        padding: 4rem 0 0 0 !important;
    }
    .artistProfileSec .container {
        grid-template-columns: 200px 1fr;
    }

    .artistProfileSec .sidebar {
        padding: 15px 10px;
    }

    .artistProfileSec .logo img {
        width: 60% !important;
    }

    .artistProfileSec .nav-label,
    .artistProfileSec .friend-card .info,
    .artistProfileSec .user-account .info {
        display: none;
    }
    .artistProfileSec .sidebar {
        overflow-x:hidden;
    }
    .artistProfileSec .nav-item {
        justify-content: flex-start;
    }

    .artistProfileSec .nav-item i {
        font-size: 18px;
    }

    .artistProfileSec .friend-card {
        justify-content: center;
        padding: 8px;
    }

    .artistProfileSec .user-account {
        justify-content: center;
    }
}

/* Mobile */
@media (max-width: 768px) {
    .artistProfileSec .container {
        grid-template-columns: 1fr;
        grid-template-rows: auto;
        height: auto;
    }
    .artistProfileSec {
        padding:4rem 0 0 0;
    }
    /* Sidebar becomes top menu */
    .artistProfileSec .sidebar {
        flex-direction: row;
        overflow-x: auto;
        overflow-y: hidden;
        padding: 10px;
        gap: 15px;
        margin: 0 auto;
    }
    .artistProfileSec .logo {
        display:none;
    }
    .artistProfileSec .nav-item.active {
         border-right: none;
    }
    .artistProfileSec .nav-group {
        display: flex;
        gap: 15px;
        margin-bottom: 0;
    }

    .artistProfileSec .friend-card,
    .artistProfileSec .user-account {
        display: none;
    }

    .artistProfileSec .main-container {
        grid-column: 1 / -1;
    }

    .artistProfileSec .hero {
        height: 240px;
        padding: 20px;
    }

    .artistProfileSec .hero-title {
        font-size: 28px;
    }

    .artistProfileSec .hero-btns {
        flex-wrap: wrap;
    }

    .artistProfileSec .albums-list {
        gap: 12px;
    }

    .artistProfileSec .album-card {
        width: 120px;
    }

    .artistProfileSec .album-art {
        width: 120px;
        height: 120px;
    }

    /* Artist cards */
    .artistProfileSec .artist-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    /* Player bar */
    .artistProfileSec .player-bar {
        width: 95%;
        left: 2.5%;
        padding: 10px 15px;
    }

    .artistProfileSec .current-track {
        display: none;
    }

    .artistProfileSec .player-controls {
        width: 100%;
    }
}

/* Small Mobile */
@media (max-width: 480px) {
    .artistProfileSec .artist-grid {
        grid-template-columns: 1fr;
    }
    .artistProfileSec .nav-group {
        flex-wrap: wrap;
        gap: 5px;
    }
    .artistProfileSec .nav-item {
        font-size: 12px;
        gap: 5px;
    }
    .main-content {
        overflow: clip !important;
        width: 100% !important;
    }
    .artistProfileSec .songs-table {
        width: 500px !important;
        overflow-x: hidden;
    }
    .liked-songs-section .songs-table {
        width: 700px !important;
    }
    .container, .container-fluid {
        padding: 0px 0px;
    }
    .artistProfileSec .song-row td {
        padding: 0px;
        font-size: 11px;
    }
    .artistProfileSec .song-row .song-title-cell {
        gap: 5px;
    }
    .artistProfileSec .sidebar {
        gap: 0px ;
    }
    .artistProfileSec .nav-item i {
        font-size: 14px;
    }
    .artistProfileSec .hero-title {
        font-size: 22px;
    }

    .artistProfileSec .hero-btns .btn {
        font-size: 12px;
        padding: 8px 14px;
    }

    .artistProfileSec .player-bar {
        bottom: 5px;
    }
}
.album-card a {
        color: inherit;
}

    </style>
@endsection

@section('content')

    @php
        /** @var \App\Models\User|null $artist */
        /** @var \App\Models\Profile|null $profile */

        $artistUser = $artist ?? null;
        $profileModel = $profile ?? ($artistUser?->profile ?? null);

        $displayName = $profileModel && ($profileModel->first_name || $profileModel->last_name)
            ? trim(($profileModel->first_name ?? '') . ' ' . ($profileModel->last_name ?? ''))
            : ($artistUser->name ?? $artistUser->username ?? 'Artist');

        $username = $artistUser?->username ?? Str::slug($displayName, '_');

        $avatar = $profileModel && $profileModel->picture
            ? asset('storage/' . $profileModel->picture)
            : 'https://img.freepik.com/premium-vector/eps-urban-character-tshirt_888481-23.jpg';

        $heroBanner = $profileModel && !empty($profileModel->banner_image ?? null)
            ? asset('storage/' . $profileModel->banner_image)
            : "https://img.freepik.com/premium-photo/desk-with-collection-vintage-vinyl-records_974629-215719.jpg?auto=compress&cs=tinysrgb&w=1200";

        $aboutText = $profileModel && $profileModel->about
            ? $profileModel->about
            : 'This artist has not added an about section yet. Check back soon for more details about their story, influences, and musical journey.';

        $songCount = isset($songs) ? $songs->count() : 0;
        $artworkCount = isset($artworks) ? $artworks->count() : 0;

        // Build a lightweight playlist array for the JS player
        $playlist = isset($songs)
            ? $songs->map(function ($song) use ($displayName) {
                  /** @var \App\Models\ArtistMusic $song */
                  // Get thumbnail with proper path handling
                  $thumb = 'https://via.placeholder.com/150x150?text=Track';
                  if ($song->thumbnail_image) {
                      // Remove any existing storage/ or public/ prefix
                      $thumbPath = $song->thumbnail_image;
                      $thumbPath = preg_replace('#^(storage/|public/storage/|public/)#', '', $thumbPath);
                      
                      // Ensure it starts with storage/ for proper asset generation
                      if (strpos($thumbPath, 'storage/') !== 0) {
                          $thumbPath = 'storage/' . $thumbPath;
                      }
                      $thumb = asset($thumbPath);
                  } elseif ($song->thumbnail_image_url) {
                      $thumb = $song->thumbnail_image_url;
                  }
                  
                  // Format duration
                  $duration = '0:00';
                  if ($song->duration && $song->duration > 0) {
                      $minutes = floor($song->duration / 60);
                      $seconds = $song->duration % 60;
                      $duration = sprintf('%d:%02d', $minutes, $seconds);
                  }
                  
                  return [
                      'id' => $song->id,
                      'title' => $song->name,
                      'album' => $displayName,
                      'isrc_code' => $song->isrc_code,
                      'duration' => $song->duration ?? null, // Duration in seconds
                      'time' => $duration, // Formatted duration
                      'img' => $thumb,
                      'music_file' => $song->music_file_url, // Add music file URL for playback
                  ];
              })->values()
            : collect();
    @endphp

    <section class="artistProfileSec">
        <div class="container artistcontainer">
            <aside class="sidebar glass">
                <div class="logo"><img
                        src="https://singwithmewebsite.thevisionbrands.com/public/FrontendAssets/images/singWithMe/logo-trans.png"
                        alt=""></div>

                <div class="nav-group">
                    <p class="nav-label">Menu</p>
                    <div class="nav-item tab-link active" data-target="home-content"><i class="fa-solid fa-house"></i> Home
                    </div>
                    <div class="nav-item tab-link " data-target="about-content"><i class="fa-solid fa-circle-info"></i> About
                    </div>
                    <div class="nav-item tab-link" data-target="discover-content"><i class="fa-solid fa-paint-brush"></i>
                        Artwork</div>
                    <div class="nav-item tab-link" data-target="likes-content"><i class="fa-solid fa-heart"></i> Songs</div>
                    <!-- <div class="nav-item"><i class="fa-solid fa-podcast"></i> Podcast</div> -->
                    <!-- <div class="nav-item"><i class="fa-solid fa-radio"></i> Radio</div> -->
                    {{-- <div class="nav-item tab-link" data-target="Profile-content"><i class="fa-solid fa-user"></i> Profile <i
                            class="fa-solid fa-circle" style="font-size: 8px; color: #9465e4;"></i></div> --}}
                </div>

                <div class="nav-group d-none" style="flex: 1;">
                    <p class="nav-label">Friend's Room</p>
                    <div class="friend-card">
                        <img src="https://i.pravatar.cc/100?img=1" alt="Friend">
                        <div class="info">
                            <p>The Plan</p><small>Travis Scott</small>
                        </div>
                        <i class="fa-solid fa-signal"></i>
                    </div>
                    <div class="friend-card">
                        <img src="https://i.pravatar.cc/100?img=2" alt="Friend">
                        <div class="info">
                            <p>In My Feel...</p><small>Drake</small>
                        </div>
                        <i class="fa-solid fa-signal"></i>
                    </div>
                    <div class="friend-card">
                        <img src="https://i.pravatar.cc/100?img=3" alt="Friend">
                        <div class="info">
                            <p>Solid ft</p><small>Drake</small>
                        </div>
                        <i class="fa-solid fa-signal"></i>
                    </div>
                    <div class="friend-card">
                        <img src="https://i.pravatar.cc/100?img=4" alt="Friend">
                        <div class="info">
                            <p>Levitating</p><small>Dua Lipa</small>
                        </div>
                        <i class="fa-solid fa-signal"></i>
                    </div>
                </div>

                <div class="user-account">
                    <img src="{{ $avatar }}" alt="{{ $displayName }}">
                    <div class="info">
                        <p>{{ $displayName }}</p><small>{{ '@' . $username }}</small>
                    </div>
                    <i class="fa-solid fa-chevron-right" style="color: var(--text-dim);"></i>
                </div>
            </aside>

            <div class="main-container">
                <main class="main-content active" id="home-content">
                    <header class="hero" style="background: linear-gradient(to right, rgba(0, 0, 0, 0.8), transparent), url('{{ $heroBanner }}') center/cover;">
                        <img src="{{ $avatar }}"
                            alt="{{ $displayName }}" class="artist-avatar">
                        <h1 class="hero-title">{{ $displayName }}</h1>
                        <div class="hero-btns">
                            <button class="btn btn-play" id="hero-play">Play</button>
                            <button class="btn btn-outline {{ isset($isSubscribed) && $isSubscribed ? 'following' : '' }}" id="subscribeBtnHero" type="button">
                                @if(isset($isSubscribed) && $isSubscribed)
                                    <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18">
                                        <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/>
                                    </svg>
                                    <span>Subscribed</span>
                                @else
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18">
                                        <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/>
                                    </svg>
                                    <span>Subscribe</span>
                                @endif
                            </button>
                            {{-- <a href="/tip-artist">
                                <button class="btn btn-outline" type="button">Artist Tip</button>
                            </a> --}}
                        </div>
                    </header>

                    <h3 style="margin-bottom: 15px;">Musics</h3>

                    <table class="songs-table">
                        <thead>
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>Title</th>
                                <th>Album</th>
                                <th style="width: 80px;">Time</th>
                                <th style="width: 50px;"></th>
                            </tr>
                        </thead>
                        <tbody id="song-list">
                        </tbody>
                    </table>

                    <div class="albums-section d-none">
                        <h3>Albums & Releases</h3>
                        <div class="albums-list">
                            <div class="album-card">
                                <a href="/songs-details">
                                    <div class="album-art"
                                        style="background: url('{{ 
                                            ($songs->first() && $songs->first()->thumbnail_image) 
                                                ? asset('storage/' . preg_replace('#^(storage/|public/storage/|public/)#', '', $songs->first()->thumbnail_image))
                                                : 'https://via.placeholder.com/300x300?text=Release' 
                                        }}') center/cover;">
                                        <span class="duration">{{ $songCount }} tracks</span>
                                    </div>
                                    <p>THE HIGHLIGHTS</p>
                                    <small>Album - 2021</small>
                                </a>
                            </div>
                            <div class="album-card">
                                <a href="/songs-details">
                                <div class="album-art"
                                    style="background: url('https://upload.wikimedia.org/wikipedia/en/3/39/The_Weeknd_-_Starboy.png') center/cover;">
                                </div>
                                <p>STARBOY</p>
                                <small>Album - 2016</small>
                                </a>
                            </div>
                            <div class="album-card">
                                <a href="/songs-details">
                                <div class="album-art"
                                    style="background: url('https://img.freepik.com/premium-photo/live-performance-retro-vinyl-store_910054-131.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_hybrid&w=740&q=80') center/cover;">
                                </div>
                                <p>AFTER HOURS</p>
                                <small>Album - 2020</small>
                                </a>
                            </div>
                            <div class="album-card">
                                <a href="/songs-details">
                                <div class="album-art"
                                    style="background: url('https://img.freepik.com/premium-photo/man-with-beard-stands-front-dj-equipment_1204495-24857.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_hybrid&w=740&q=80') center/cover;">
                                </div>
                                <p>BEAUTY BEHIND</p>
                                <small>Album - 2015</small>
                                </a>
                            </div>
                            <div class="album-card">
                                <a href="/songs-details">
                                <div class="album-art"
                                    style="background: url('https://img.freepik.com/premium-photo/man-wearing-goggles-microphone-is-playing-music_1276913-12049.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_hybrid&w=740&q=80') center/cover;">
                                </div>
                                <p>DAWN FM</p>
                                <small>Album - 2022</small>
                                </a>
                            </div>
                        </div>
                    </div>
                </main>

                <div class="main-content" id="about-content">
                    
                    <div style="padding: 20px 0;">
                    <section class="secartistAbout">
                        <div class="container">
                            <!-- Artist Header -->
                            <div class="artist-header">
                                <div class="header-content">
                                    <img src="{{ $avatar }}" alt="{{ $displayName }}" class="artist-image">
                                    <div class="artist-info">
                                        <h1 class="artist-name">{{ $displayName }}</h1>
                                        <p class="artist-username">{{ '@' . $username }}</p>
                                        
                                        <div class="artist-stats">
                                            <div class="stat-item">
                                                <span class="stat-number">{{ $songCount }}</span>
                                                <span class="stat-label">Songs</span>
                                            </div>
                                            <div class="stat-item">
                                                <span class="stat-number">{{ $artworkCount }}</span>
                                                <span class="stat-label">Albums</span>
                                            </div>
                                            <div class="stat-item">
                                                <span class="stat-number">—</span>
                                                <span class="stat-label">Listeners</span>
                                            </div>
                                            <div class="stat-item">
                                                <span class="stat-number">—</span>
                                                <span class="stat-label">Streams</span>
                                            </div>
                                        </div>

                                        <div class="action-buttons">
                                            <!-- <button class="btn btn-primary" id="playBtn">
                                                <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18">
                                                    <path d="M8 5v14l11-7z"/>
                                                </svg>
                                                <span>Play All</span>
                                            </button> -->
                                            <button class="btn btn-secondary {{ isset($isSubscribed) && $isSubscribed ? 'following' : '' }}" id="subscribeBtn">
                                                @if(isset($isSubscribed) && $isSubscribed)
                                                    <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18">
                                                        <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/>
                                                    </svg>
                                                    <span>Subscribed</span>
                                                @else
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18">
                                                        <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/>
                                                    </svg>
                                                    <span>Subscribe</span>
                                                @endif
                                            </button>
                                            <div class="dropdown">
                                                {{-- <button class="btn btn-secondary" id="moreBtn">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18">
                                                        <circle cx="12" cy="12" r="1"/>
                                                        <circle cx="19" cy="12" r="1"/>
                                                        <circle cx="5" cy="12" r="1"/>
                                                    </svg>
                                                    <span>More</span>
                                                </button> --}}
                                                <div class="dropdown-menu" id="dropdownMenu">
                                                    <a href="#" class="dropdown-item" data-action="share">
                                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                            <circle cx="18" cy="5" r="3"/>
                                                            <circle cx="6" cy="12" r="3"/>
                                                            <circle cx="18" cy="19" r="3"/>
                                                            <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/>
                                                            <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/>
                                                        </svg>
                                                        Share Profile
                                                    </a>
                                                    <a href="#" class="dropdown-item" data-action="report">
                                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                                                            <line x1="12" y1="9" x2="12" y2="13"/>
                                                            <line x1="12" y1="17" x2="12.01" y2="17"/>
                                                        </svg>
                                                        Report Artist
                                                    </a>
                                                    <a href="#" class="dropdown-item" data-action="block">
                                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                            <circle cx="12" cy="12" r="10"/>
                                                            <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/>
                                                        </svg>
                                                        Block Artist
                                                    </a>
                                                    <a href="#" class="dropdown-item" data-action="copy">
                                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"/>
                                                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/>
                                                        </svg>
                                                        Copy Profile Link
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Bio Section -->
                            <div class="bio-section">
                                <h2 class="section-title">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                        <circle cx="12" cy="7" r="4"/>
                                    </svg>
                                    About Artist
                                </h2>
                                <p class="bio-text">
                                    {!! nl2br(e($aboutText)) !!}
                                </p>
                            </div>

                            <!-- Artist Details -->
                            {{-- <div class="details-grid">
                                <div class="detail-card">
                                    <div class="detail-label">Primary Genre</div>
                                    <div class="detail-value">Various</div>
                                    <div class="genre-tags">
                                        <span class="genre-tag">R&B</span>
                                        <span class="genre-tag">Pop</span>
                                        <span class="genre-tag">Alternative</span>
                                        <span class="genre-tag">Hip-Hop</span>
                                    </div>
                                </div>

                                <div class="detail-card">
                                    <div class="detail-label">Location</div>
                                    <div class="detail-value">—</div>
                                </div>

                                <div class="detail-card">
                                    <div class="detail-label">Member Since</div>
                                    <div class="detail-value">{{ optional($artistUser->created_at)->format('F Y') ?? '—' }}</div>
                                </div>

                                <div class="detail-card">
                                    <div class="detail-label">Record Label</div>
                                    <div class="detail-value">SingWithMe Records</div>
                                </div>
                            </div> --}}

                            <!-- Social Links -->
                            {{-- <div class="social-section">
                                <h2 class="section-title">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10"/>
                                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                                        <path d="M2 12h20"/>
                                    </svg>
                                    Social Media & Links
                                </h2>
                                <div class="social-grid">
                                    <a href="javascript:;"  class="social-link">
                                        <div class="social-icon">
                                            <svg viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                                            </svg>
                                        </div>
                                        <div class="social-info">
                                            <span class="social-name">Twitter</span>
                                            <span class="social-handle">@theweeknd</span>
                                        </div>
                                    </a>

                                    <a href="javascript:;"  class="social-link">
                                        <div class="social-icon">
                                            <svg viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                                            </svg>
                                        </div>
                                        <div class="social-info">
                                            <span class="social-name">Instagram</span>
                                            <span class="social-handle">@theweeknd</span>
                                        </div>
                                    </a>

                                    <a href="javascript:;"  class="social-link">
                                        <div class="social-icon">
                                            <svg viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                            </svg>
                                        </div>
                                        <div class="social-info">
                                            <span class="social-name">YouTube</span>
                                            <span class="social-handle">@TheWeeknd</span>
                                        </div>
                                    </a>

                                    <a href="javascript:;"  class="social-link">
                                        <div class="social-icon">
                                            <svg viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.599-1.559.3z"/>
                                            </svg>
                                        </div>
                                        <div class="social-info">
                                            <span class="social-name">Spotify</span>
                                            <span class="social-handle">The Weeknd</span>
                                        </div>
                                    </a>
                                </div>
                            </div> --}}

                            {{-- <div class="achievements-section">
                                <h2 class="section-title">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"/>
                                        <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"/>
                                        <path d="M4 22h16"/>
                                        <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"/>
                                        <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"/>
                                        <circle cx="12" cy="10" r="6"/>
                                    </svg>
                                    Artist Achievements
                                </h2>
                                <div class="achievement-list">
                                    <div class="achievement-item">
                                        <div class="achievement-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                        </div>
                                        <div class="achievement-text">
                                            <div class="achievement-title">Diamond Certified</div>
                                            <div class="achievement-desc">Multiple singles with over 10 million units sold.</div>
                                        </div>
                                    </div>
                                    <div class="achievement-item">
                                        <div class="achievement-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>
                                        </div>
                                        <div class="achievement-text">
                                            <div class="achievement-title">Global Streaming Leader</div>
                                            <div class="achievement-desc">Maintained #1 spot on monthly listeners for 12 consecutive months.</div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>

                        <div id="toast" class="toast">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <span id="toastMessage">Action completed</span>
                        </div>
                    </section>
                    </div>
                </div>

                <div class="main-content" id="discover-content">
                    
                    <div style="padding: 20px 0;">
                    <section class="artworkUploaded-Sec">
                        <div style="margin-left:18px">
                            <h2>Uploaded Artwork</h2>
                            <p class="count-info">
                                @if($artworkCount > 0)
                                    {{ $artworkCount }} artwork item{{ $artworkCount === 1 ? '' : 's' }} uploaded.
                                @else
                                    No artwork uploaded yet.
                                @endif
                            </p>
                        </div>
                        <div class="container">
                            <div class="gallery-header">
                                <div class="">
                                    <div class="row">
                                        @forelse($artworks as $index => $artwork)
                                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 py-3">
                                                <div class="gallery-item gallery-item22" data-index="{{ $index }}">
                                                    <img src="{{ $artwork->image_url ?? 'https://via.placeholder.com/600x400?text=Artwork' }}"
                                                         alt="Artwork {{ $index + 1 }}">
                                                    <div class="gallery-overlay">
                                                        <div class="gallery-title">Artwork {{ $index + 1 }}</div>
                                                        <div class="gallery-subtitle">
                                                            Artwork uploaded by {{ $displayName }}.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12 py-4">
                                                <p class="text-muted" style="color:#b8a8d0;">
                                                    This artist has not uploaded any artwork yet.
                                                </p>
                                            </div>
                                        @endforelse
                                        @if($artworkCount > 0)
                                            <div class="col-12">
                                                <div>
                                                    <a href="{{ route('all-artwork') }}">
                                                        <button class="btn btn-play"> View All</button>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal" id="modal22">
                            <div class="close-button" id="closeBtn22"></div>
                            <div class="nav-button prev" id="prevBtn22"></div>
                            <div class="nav-button next" id="nextBtn22"></div>
                            <div class="modal-content">
                            <img class="modal-image" id="modalImage22" src="" alt="">
                            <div class="modal-info">
                                <div class="modal-title" id="modalTitle22"></div>
                                <div class="modal-subtitle" id="modalSubtitle22"></div>
                            </div>
                            </div>
                        </div>
                    </section>
                    </div>
                </div>

                <div class="main-content" id="likes-content">
                    <div class="liked-songs-section">
                        <h2>All Songs</h2>
                        <p class="count-info">
                            @if($songCount > 0)
                                Currently holding {{ $songCount }} song{{ $songCount === 1 ? '' : 's' }}.
                            @else
                                No songs uploaded yet.
                            @endif
                        </p>

                        <div class="liked-actions">
                            <button class="btn btn-play" onclick="playAllSongs()"><i class="fa-solid fa-play"></i> Play All</button>
                            {{--<button class="btn btn-outline"><i class="fa-solid fa-shuffle"></i> Shuffle</button>--}}
                            @if(isset($canTipArtist) && $canTipArtist && isset($artist))
                                <a href="{{ route('tip-artist', ['artist' => $artist->id]) }}"><button class="btn btn-outline"><i class="fa-solid fa-sack-dollar"></i> Artist Tip</button></a>
                            @elseif(auth()->check())
                                <button class="btn btn-outline" onclick="alert('This feature is only available for Super Listener subscribers. Please upgrade your plan to tip artists.');" title="Upgrade to Super Listener to tip artists">
                                    <i class="fa-solid fa-sack-dollar"></i> Artist Tip
                                </button>
                            @else
                                @if(isset($artist))
                                    <a href="{{ route('tip-artist', ['artist' => $artist->id]) }}"><button class="btn btn-outline"><i class="fa-solid fa-sack-dollar"></i> Artist Tip</button></a>
                                @else
                                    <a href="{{ route('user.portal') }}"><button class="btn btn-outline"><i class="fa-solid fa-sack-dollar"></i> Artist Tip</button></a>
                                @endif
                            @endif
                        </div>

                        <table class="songs-table">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">#</th>
                                    <th>Title</th>
                                    <th>Artist</th>
                                    <th>Album</th>
                                    <th style="width: 80px;">Time</th>
                                    <th style="width: 50px;"><i class="fa-solid fa-heart"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($songs as $index => $song)
                                    @php
                                        /** @var \App\Models\ArtistMusic $song */
                                        // Get thumbnail with proper path handling
                                        $thumb = 'https://via.placeholder.com/100x100?text=Track';
                                        if ($song->thumbnail_image) {
                                            // Remove any existing storage/ or public/ prefix
                                            $thumbPath = $song->thumbnail_image;
                                            $thumbPath = preg_replace('#^(storage/|public/storage/|public/)#', '', $thumbPath);
                                            
                                            // Ensure it starts with storage/ for proper asset generation
                                            if (strpos($thumbPath, 'storage/') !== 0) {
                                                $thumbPath = 'storage/' . $thumbPath;
                                            }
                                            $thumb = asset($thumbPath);
                                        } elseif ($song->thumbnail_image_url) {
                                            $thumb = $song->thumbnail_image_url;
                                        }
                                    @endphp
                                    @php
                                        // Get music file URL
                                        $musicFileUrl = '#';
                                        if ($song->music_file) {
                                            $musicPath = $song->music_file;
                                            $musicPath = preg_replace('#^(storage/|public/storage/|public/)#', '', $musicPath);
                                            if (strpos($musicPath, 'storage/') !== 0) {
                                                $musicPath = 'storage/' . $musicPath;
                                            }
                                            $musicFileUrl = asset($musicPath);
                                        } elseif ($song->music_file_url) {
                                            $musicFileUrl = $song->music_file_url;
                                        }
                                        
                                        // Get duration
                                        $duration = '0:00';
                                        if ($song->duration && $song->duration > 0) {
                                            $minutes = floor($song->duration / 60);
                                            $seconds = $song->duration % 60;
                                            $duration = sprintf('%d:%02d', $minutes, $seconds);
                                        }
                                    @endphp
                                    <tr class="song-row" onclick="playSongFromTable({{ $index }}, {{ $song->id }}, '{{ addslashes($song->name) }}', '{{ addslashes($displayName) }}', '{{ $thumb }}', '{{ $musicFileUrl }}', '{{ $song->isrc_code ?? '' }}');" style="cursor: pointer;">
                                        <td>{{ $index + 1 }}</td>
                                        <td class="song-title-cell">
                                            <img src="{{ $thumb }}" class="song-img">
                                            <div>
                                                <div>{{ $song->name }}</div>
                                                @if($song->isrc_code)
                                                    <small style="color: #b794f6; font-size: 0.75rem;">ISRC: {{ $song->isrc_code }}</small>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $displayName }}</td>
                                        <td>Single</td>
                                        <td>{{ $duration }}</td>
                                        <td onclick="event.stopPropagation(); if(typeof toggleLike==='function'){toggleLike({{ $song->id }});}else{console.error('toggleLike function not found');}" style="cursor: pointer;">
                                            <i class="fa-regular fa-heart favorite-icon-{{ $song->id }}" data-song-id="{{ $song->id }}" title="Add to favorites" onclick="event.stopPropagation(); if(typeof toggleLike==='function'){toggleLike({{ $song->id }});}"></i>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" style="color:#b8a8d0;">No songs uploaded yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="main-content" id="Profile-content">
                    <div class="artist-cards-section">
                        <h2>Popular Artists</h2>
                        <div class="artist-grid">

                            <div class="artist-card glass">
                                <div class="card-background"
                                    style="background-image: url('https://img.freepik.com/premium-photo/male-models-visual-photo-album-full-menly-vibes-collected-from-all-world_563241-45540.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_hybrid&w=740&q=80');">
                                </div>
                                <div class="card-info">
                                    <h3>Drake</h3>
                                    <p>35M Monthly Listeners</p>
                                    <button class="follow-btn" id="followBtn"><i class="fa-solid fa-user-plus"></i> Follow</button>
                                </div>
                            </div>

                            <div class="artist-card glass">
                                <div class="card-background"
                                    style="background-image: url('https://img.freepik.com/premium-photo/woman-with-red-lip-green-eye-shadow-is-reflected-mirror_1189844-26422.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_hybrid&w=740&q=80');">
                                </div>
                                <div class="card-info">
                                    <h3>Dua Lipa</h3>
                                    <p>28M Monthly Listeners</p>
                                    <button class="follow-btn active" id="followBtn"><i class="fa-solid fa-check"></i> Following</button>
                                </div>
                            </div>

                            <div class="artist-card glass">
                                <div class="card-background"
                                    style="background-image: url('https://img.freepik.com/premium-photo/model-with-long-red-hair-wearing-oversized-dark-red-shirt-baggy-pants-runway-pari_1325692-11062.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_hybrid&w=740&q=80');">
                                </div>
                                <div class="card-info">
                                    <h3>Billie Eilish</h3>
                                    <p>22M Monthly Listeners</p>
                                    <button class="follow-btn" id="followBtn"><i class="fa-solid fa-user-plus"></i> Follow</button>
                                </div>
                            </div>

                            <div class="artist-card glass">
                                <div class="card-background"
                                    style="background-image: url('https://img.freepik.com/premium-vector/eps-urban-character-tshirt_888481-23.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_hybrid&w=740&q=80');">
                                </div>
                                <div class="card-info">
                                    <h3>Travis Scott</h3>
                                    <p>30M Monthly Listeners</p>
                                    
                                    <button class="follow-btn" id="followBtn"><i class="fa-solid fa-user-plus"></i> Follow</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <aside class="video-sidebar glass d-none">
                <h3 style="margin-bottom: 15px; font-size: 18px;">Videos</h3>
                <div class="video-card">
                    <div class="v-thumb"
                        style="background: url('https://i.ytimg.com/vi/yzTuBuRdAyA/mqdefault.jpg') center/cover;"></div>
                    <div>
                        <p style="font-size: 13px; font-weight: 600;">Die For You</p><small
                            style="color: var(--text-dim);">Official Music Video</small>
                    </div>
                </div>
                <div class="video-card">
                    <div class="v-thumb"
                        style="background: url('https://img.freepik.com/free-photo/gen-z-person-exploring-absurdist-fashion-beauty_23-2151104066.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_hybrid&w=740&q=80') center/cover;">
                    </div>
                    <div>
                        <p style="font-size: 13px; font-weight: 600;">Moth To A Flame</p><small
                            style="color: var(--text-dim);">Official Video</small>
                    </div>
                </div>
                <div class="video-card">
                    <div class="v-thumb"
                        style="background: url('https://img.freepik.com/premium-photo/man-with-headphones-that-has-word-head-it_7023-377760.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_hybrid&w=740&q=80') center/cover;">
                    </div>
                    <div>
                        <p style="font-size: 13px; font-weight: 600;">Save Your Tears</p><small
                            style="color: var(--text-dim);">Official Music Video</small>
                    </div>
                </div>
            </aside>

            <footer class="player-bar glass">
                <div class="current-track">
                    <div class="track-img" id="player-img"></div>
                    <div>
                        <p id="player-title" style="font-weight: 600;">Select a song</p>
                        <p id="player-artist" style="font-size: 12px; color: var(--text-dim);">{{ $displayName }}</p>
                    </div>
                    <i class="fa-solid fa-arrow-up-right-from-square" style="color: var(--text-dim);"></i>
                </div>

                <div class="player-controls">
                    <div class="ctrl-btns">
                        <i class="fa-solid fa-shuffle" style="color: var(--text-dim); font-size: 14px;"></i>
                        <i class="fa-solid fa-step-backward" id="prev-btn"></i>
                        <div class="play-trigger" id="master-play"><i class="fa-solid fa-play"></i></div>
                        <i class="fa-solid fa-step-forward" id="next-btn"></i>
                        <i class="fa-solid fa-repeat" style="color: var(--text-dim); font-size: 14px;"></i>
                    </div>
                    <div class="progress-area">
                        <span id="curr-time">0:00</span>
                        <div class="progress-bar">
                            <div class="progress-fill" id="progress-fill"></div>
                        </div>
                        <span id="total-time">0:00</span>
                    </div>
                </div>

                <div style="width: 300px; display: flex; justify-content: flex-end; gap: 20px; align-items: center;">
                    <i class="fa-solid fa-volume-high"></i>
                    <div style="width: 80px; height: 4px; background: rgba(255,255,255,0.1); border-radius: 2px;"></div>
                    <i class="fa-solid fa-up-down-left-right" style="color: var(--text-dim);"></i>
                </div>
            </footer>
        </div>
    </section>
 

       
     
{{--@include('partials.frontend.newsletter')--}}

    <script>
        // --- Data and Player Logic (Reused for functionality) ---
        const songs = @json($playlist);

        let currentSongIndex = -1;
        let isPlaying = false;
        let timer;

        const songListBody = document.getElementById('song-list');
        const masterPlay = document.getElementById('master-play');
        const progressFill = document.getElementById('progress-fill');

        function playSong(index) {
            if (!songs || !songs[index]) {
                console.error('Song not found at index:', index);
                return;
            }
            
            currentSongIndex = index;
            const song = songs[index];

            // Update Player Bar UI
            const playerTitle = document.getElementById('player-title');
            const playerImg = document.getElementById('player-img');
            const totalTime = document.getElementById('total-time');
            
            if (playerTitle) playerTitle.innerText = song.title || song.name || 'Unknown';
            if (playerImg) playerImg.style.background = `url('${song.img || song.thumbnail || ''}') center/cover`;
            if (totalTime) totalTime.innerText = song.time || '0:00';

            // Visual updates on song list
            document.querySelectorAll('.song-row').forEach(r => r.classList.remove('playing'));
            const songRows = document.querySelectorAll('.song-row');
            if (songRows[index]) {
                songRows[index].classList.add('playing');
            }

            // Use global MusicPlayer (same as home page)
            const musicFile = song.music_file || song.music_file_url;
            if (window.MusicPlayer && musicFile) {
                const track = {
                    id: song.id,
                    name: song.title || song.name,
                    artist: song.album || song.artist,
                    thumbnail: song.img || song.thumbnail,
                    music_file: musicFile,
                    isrc_code: song.isrc_code || null
                };
                window.MusicPlayer.loadTrack(track);
                window.MusicPlayer.play();
            } else {
                console.error('MusicPlayer not available or music_file missing:', {
                    hasMusicPlayer: !!window.MusicPlayer,
                    musicFile: musicFile
                });
                // Fallback to local playback
                startPlayback();
            }
        }
        
        // Function to play song from table click (for Songs tab)
        function playSongFromTable(index, songId, songName, artistName, thumbnail, musicFile, isrcCode) {
            console.log('playSongFromTable called:', { index, songId, songName, musicFile });
            
            // Find the song in the songs array or create a track object
            let track = null;
            if (songs && songs[index]) {
                track = songs[index];
            } else {
                // Create track object from parameters
                track = {
                    id: songId,
                    name: songName,
                    title: songName,
                    artist: artistName,
                    album: artistName,
                    thumbnail: thumbnail,
                    img: thumbnail,
                    music_file: musicFile,
                    music_file_url: musicFile,
                    isrc_code: isrcCode || null,
                    time: '0:00'
                };
            }
            
            // Update Player Bar UI
            const playerTitle = document.getElementById('player-title');
            const playerImg = document.getElementById('player-img');
            const totalTime = document.getElementById('total-time');
            
            if (playerTitle) playerTitle.innerText = track.name || track.title || 'Unknown';
            if (playerImg) playerImg.style.background = `url('${track.thumbnail || track.img || ''}') center/cover`;
            if (totalTime) totalTime.innerText = track.time || '0:00';

            // Visual updates on song list
            document.querySelectorAll('.song-row').forEach(r => r.classList.remove('playing'));
            const songRows = document.querySelectorAll('.song-row');
            if (songRows[index]) {
                songRows[index].classList.add('playing');
            }
            
            // Update current song index
            currentSongIndex = index;

            // Use global MusicPlayer
            if (window.MusicPlayer && (track.music_file || track.music_file_url)) {
                const musicFileUrl = track.music_file || track.music_file_url;
                const trackObj = {
                    id: track.id,
                    name: track.name || track.title,
                    artist: track.artist || track.album,
                    thumbnail: track.thumbnail || track.img,
                    music_file: musicFileUrl,
                    isrc_code: track.isrc_code || null
                };
                console.log('Loading track:', trackObj);
                window.MusicPlayer.loadTrack(trackObj);
                window.MusicPlayer.play();
            } else {
                console.error('MusicPlayer not available or music_file missing');
                alert('Audio file not available for this song');
            }
        }
        
        // Make it globally accessible
        window.playSongFromTable = playSongFromTable;

        function startPlayback() {
            if (currentSongIndex < 0 || currentSongIndex >= songs.length) return;
            
            const song = songs[currentSongIndex];
            if (!song.music_file) {
                console.error('No music file available for song:', song.title);
                alert('Audio file not available for this song');
                return;
            }
            
            isPlaying = true;
            if (masterPlay) {
                masterPlay.innerHTML = '<i class="fa-solid fa-pause"></i>';
            }

            // Always use the global MusicPlayer (same as home page)
            if (window.MusicPlayer && song.music_file) {
                const track = {
                    id: song.id,
                    name: song.title,
                    artist: song.album,
                    thumbnail: song.img,
                    music_file: song.music_file,
                    isrc_code: song.isrc_code || null
                };
                window.MusicPlayer.loadTrack(track);
                window.MusicPlayer.play();
            } else {
                console.error('MusicPlayer not available or music_file missing');
            }
        }
        
        function formatTime(seconds) {
            const mins = Math.floor(seconds / 60);
            const secs = Math.floor(seconds % 60);
            return `${mins}:${secs < 10 ? "0" + secs : secs}`;
        }

        masterPlay.onclick = () => {
            if (!songs.length) return;
            if (currentSongIndex === -1) {
                playSong(0);
            } else {
                isPlaying = !isPlaying;
                masterPlay.innerHTML = isPlaying ? '<i class="fa-solid fa-pause"></i>' : '<i class="fa-solid fa-play"></i>';
                
                if (window.MusicPlayer) {
                    if (isPlaying) {
                        window.MusicPlayer.play();
                    } else {
                        window.MusicPlayer.pause();
                    }
                } else {
                    const localAudio = document.getElementById('local-audio-player');
                    if (localAudio) {
                        if (isPlaying) {
                            localAudio.play();
                        } else {
                            localAudio.pause();
                        }
                    }
                }
            }
        };

        document.getElementById('hero-play').onclick = () => {
            if (!songs.length) return;
            playSong(0);
        };

        // Function to calculate duration if not available
        function calculateDurationIfNeeded(song, index) {
            if (song.duration && song.duration > 0) {
                return; // Duration already available
            }
            
            if (!song.music_file) {
                return; // No file to calculate from
            }
            
            const audio = new Audio();
            audio.preload = 'metadata';
            
            audio.addEventListener('loadedmetadata', () => {
                if (audio.duration && isFinite(audio.duration)) {
                    const minutes = Math.floor(audio.duration / 60);
                    const seconds = Math.floor(audio.duration % 60);
                    const formatted = `${minutes}:${seconds < 10 ? "0" + seconds : seconds}`;
                    
                    // Update song object
                    songs[index].duration = audio.duration;
                    songs[index].time = formatted;
                    
                    // Update display
                    const row = document.querySelector(`.song-row[data-song-index="${index}"]`);
                    if (row) {
                        const timeCell = row.querySelector('.song-duration');
                        if (timeCell) {
                            timeCell.textContent = formatted;
                        }
                    }
                    
                    // Update player time if this is the current song
                    if (currentSongIndex === index) {
                        document.getElementById('total-time').innerText = formatted;
                    }
                }
            });
            
            audio.src = song.music_file;
        }

        // Initial Song List Setup (top "Musics" table)
        songs.forEach((song, index) => {
            const row = document.createElement('tr');
            row.classList.add('song-row');
            row.setAttribute('data-song-index', index);
            row.innerHTML = `
                <td>${index + 1}</td>
                <td class="song-title-cell">
                    <img src="${song.img}" class="song-img">
                    <div>
                        <div>${song.title}</div>
                        ${song.isrc_code ? `<small style="color:#b794f6;font-size:0.75rem;">ISRC: ${song.isrc_code}</small>` : ''}
                    </div>
                </td>
                <td>${song.album}</td>
                <td class="song-duration">${song.time}</td>
                <td onclick="event.stopPropagation(); if(typeof toggleLike==='function'){toggleLike(${song.id});}else{console.error('toggleLike function not found');}" style="cursor: pointer;">
                    <i class="fa-regular fa-heart favorite-icon-${song.id}" data-song-id="${song.id}" title="Add to favorites" onclick="event.stopPropagation(); if(typeof toggleLike==='function'){toggleLike(${song.id});}"></i>
                </td>
            `;
            row.onclick = () => {
                if (typeof playSong === 'function') {
                    playSong(index);
                } else if (typeof window.playSongFromTable === 'function') {
                    window.playSongFromTable(index, song.id, song.title || song.name, song.album || song.artist, song.img || song.thumbnail, song.music_file || song.music_file_url, song.isrc_code || '');
                } else {
                    console.error('playSong function not found');
                }
            };
            songListBody.appendChild(row);
            
            // Calculate duration if not available
            calculateDurationIfNeeded(song, index);
        });
        
        // Load favorite status for all songs
        loadFavoriteStatus();
        
        // Play All function
        function playAllSongs() {
            if (songs.length > 0) {
                playSong(0);
            } else {
                alert('No songs available to play');
            }
        }
        window.playAllSongs = playAllSongs;

        // --- Menu Tab Functionality ---
        const tabLinks = document.querySelectorAll('.tab-link');
        const contentSections = document.querySelectorAll('.main-content');

        function switchTab(targetId) {
            tabLinks.forEach(link => link.classList.remove('active'));
            contentSections.forEach(section => section.classList.remove('active'));

            const activeLink = document.querySelector(`.tab-link[data-target="${targetId}"]`);
            if (activeLink) activeLink.classList.add('active');

            const activeContent = document.getElementById(targetId);
            if (activeContent) activeContent.classList.add('active');
        }

        tabLinks.forEach(link => {
            link.addEventListener('click', function () {
                const target = this.getAttribute('data-target');
                switchTab(target);
            });
        });

        // Ensure the Home tab is active on load
        switchTab('home-content');
        
        // Toggle like status
        async function toggleLike(songId) {
            if (!songId) {
                console.error('toggleLike: songId is required');
                return;
            }
            
            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                if (!csrfToken) {
                    console.error('CSRF token not found');
                    alert('Unable to update favorite. Please refresh the page.');
                    return;
                }
                
                console.log('Toggling like for song:', songId);
                
                const response = await fetch('/api/favorites/toggle', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken.getAttribute('content')
                    },
                    body: JSON.stringify({
                        music_id: songId
                    })
                });

                if (!response.ok) {
                    const errorText = await response.text();
                    console.error('Toggle like error response:', errorText);
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    console.error('Response is not JSON:', contentType);
                    throw new Error('Invalid response format');
                }

                let data;
                try {
                    const responseText = await response.text();
                    console.log('Toggle like raw response:', responseText.substring(0, 200));
                    
                    // Check if response is HTML instead of JSON
                    if (responseText.trim().startsWith('<!DOCTYPE') || responseText.trim().startsWith('<html')) {
                        console.error('Received HTML instead of JSON');
                        throw new Error('Server returned HTML instead of JSON');
                    }
                    
                    data = JSON.parse(responseText);
                    console.log('Toggle like response:', data);
                } catch (parseError) {
                    console.error('JSON parse error:', parseError);
                    throw new Error('Invalid JSON response from server');
                }
                
                if (data.success) {
                    // Update all favorite icons for this song (both tables)
                    const icons = document.querySelectorAll(`.favorite-icon-${songId}, [data-song-id="${songId}"]`);
                    
                    icons.forEach(icon => {
                        if (data.is_favorite) {
                            icon.className = 'fas fa-heart favorite-icon-' + songId;
                            icon.style.color = '#ff3344';
                            icon.title = 'Remove from favorites';
                        } else {
                            icon.className = 'fa-regular fa-heart favorite-icon-' + songId;
                            icon.style.color = '';
                            icon.title = 'Add to favorites';
                        }
                    });
                    
                    // Show notification
                    const toast = document.getElementById('toast');
                    const toastMessage = document.getElementById('toastMessage');
                    if (typeof showNotification === 'function') {
                        showNotification(data.message, 'success');
                    } else if (toast && toastMessage) {
                        toastMessage.textContent = data.message;
                        toast.classList.add('show');
                        setTimeout(() => {
                            if (toast) toast.classList.remove('show');
                        }, 3000);
                    } else {
                        console.log(data.message);
                    }
                } else {
                    const toast = document.getElementById('toast');
                    const toastMessage = document.getElementById('toastMessage');
                    if (typeof showNotification === 'function') {
                        showNotification(data.message || 'Failed to update favorite status', 'error');
                    } else if (toast && toastMessage) {
                        toastMessage.textContent = data.message || 'Failed to update favorite status';
                        toast.classList.add('show');
                        setTimeout(() => {
                            if (toast) toast.classList.remove('show');
                        }, 3000);
                    } else {
                        alert(data.message || 'Failed to update favorite status');
                    }
                }
            } catch (error) {
                console.error('Error toggling like:', error);
                const toast = document.getElementById('toast');
                const toastMessage = document.getElementById('toastMessage');
                if (typeof showNotification === 'function') {
                    showNotification('Failed to update favorite status', 'error');
                } else if (toast && toastMessage) {
                    toastMessage.textContent = 'Failed to update favorite status';
                    toast.classList.add('show');
                    setTimeout(() => toast.classList.remove('show'), 3000);
                } else {
                    alert('Failed to update favorite status');
                }
            }
        }

        // Load favorite status for all songs
        async function loadFavoriteStatus() {
            try {
                const response = await fetch('/api/favorites', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    }
                });

                if (!response.ok) {
                    console.warn('Failed to load favorites:', response.status);
                    return;
                }

                const data = await response.json();
                
                if (data.success && data.data && Array.isArray(data.data)) {
                    const favoriteIds = data.data.map(fav => fav.id || fav.music_id).filter(id => id);
                    
                    // Update icons for all favorited songs
                    favoriteIds.forEach(songId => {
                        const icons = document.querySelectorAll(`.favorite-icon-${songId}, [data-song-id="${songId}"]`);
                        icons.forEach(icon => {
                            icon.className = 'fas fa-heart favorite-icon-' + songId;
                            icon.style.color = '#ff3344';
                            icon.title = 'Remove from favorites';
                        });
                    });
                }
            } catch (error) {
                console.error('Error loading favorite status:', error);
            }
        }
        
        // Load favorites when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', loadFavoriteStatus);
        } else {
            loadFavoriteStatus();
        }
        
        window.toggleLike = toggleLike;
        window.loadFavoriteStatus = loadFavoriteStatus;
    </script>



    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const subscribeBtn = document.getElementById('subscribeBtn');
            const subscribeBtnHero = document.getElementById('subscribeBtnHero');
            const playBtn = document.getElementById('playBtn');
            const moreBtn = document.getElementById('moreBtn');
            const dropdownMenu = document.getElementById('dropdownMenu');
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toastMessage');

            // --- Subscribe / Unsubscribe to artist updates ---
            function handleSubscribeClick(button) {
                if (!button) return;
                button.disabled = true;
                    fetch("{{ route('artist.subscribe') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            artist_id: {{ $artistUser->id ?? ($artist->id ?? 'null') }},
                        }),
                    })
                        .then(async res => {
                            // Check content type
                            const contentType = res.headers.get('content-type');
                            if (!contentType || !contentType.includes('application/json')) {
                                const text = await res.text();
                                console.error('Non-JSON response:', text.substring(0, 200));
                                throw new Error('Invalid response format');
                            }
                            return res.json();
                        })
                        .then(data => {
                            console.log('Subscription response:', data);
                            
                            if (!data.success) {
                                showToast(data.message || 'Unable to update subscription.');
                                return;
                            }

                            const isSubscribed = data.status === 'subscribed';
                            
                            // Update both buttons to keep them in sync
                            const allSubscribeButtons = [subscribeBtn, subscribeBtnHero].filter(btn => btn !== null);
                            allSubscribeButtons.forEach(btn => {
                                if (isSubscribed) {
                                    btn.classList.add('following');
                                    btn.innerHTML = `
                                        <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18">
                                            <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/>
                                        </svg>
                                        <span>Subscribed</span>`;
                                } else {
                                    btn.classList.remove('following');
                                    btn.innerHTML = `
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18">
                                            <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/>
                                        </svg>
                                        <span>Subscribe</span>`;
                                }
                            });

                            showToast(data.message || (isSubscribed
                                ? 'Subscribed to artist updates.'
                                : 'Unsubscribed from artist updates.'));
                        })
                        .catch((error) => {
                            console.error('Subscription error:', error);
                            showToast('Unable to update subscription right now. Please try again.');
                        })
                        .finally(() => {
                            button.disabled = false;
                        });
            }

            // Initialize subscription button state on page load
            function initializeSubscriptionButtons() {
                const buttons = [subscribeBtn, subscribeBtnHero].filter(btn => btn !== null);
                const isSubscribed = @json(isset($isSubscribed) && $isSubscribed);
                
                console.log('Initializing subscription buttons, isSubscribed:', isSubscribed);
                
                buttons.forEach(button => {
                    if (isSubscribed) {
                        button.classList.add('following');
                        button.innerHTML = `
                            <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18">
                                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/>
                            </svg>
                            <span>Subscribed</span>`;
                    } else {
                        button.classList.remove('following');
                        button.innerHTML = `
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18">
                                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/>
                            </svg>
                            <span>Subscribe</span>`;
                    }
                });
            }
            
            // Initialize buttons on page load
            initializeSubscriptionButtons();

            if (subscribeBtn) {
                subscribeBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    handleSubscribeClick(subscribeBtn);
                });
            }

            if (subscribeBtnHero) {
                subscribeBtnHero.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    handleSubscribeClick(subscribeBtnHero);
                });
            }

            // --- Dropdown Menu Logic ---
            moreBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdownMenu.classList.toggle('active');
            });

            document.addEventListener('click', () => {
                dropdownMenu.classList.remove('active');
            });

            // --- Action Items ---
            document.querySelectorAll('.dropdown-item').forEach(item => {
                item.addEventListener('click', (e) => {
                    const action = e.currentTarget.dataset.action;
                    if (action === 'copy') {
                        navigator.clipboard.writeText(window.location.href);
                        showToast('Profile link copied!');
                    } else if (action === 'share') {
                        showToast('Sharing interface opened');
                    } else {
                        showToast('Action successful');
                    }
                });
            });

            if (playBtn) {
                playBtn.addEventListener('click', () => {
                    showToast('Playing artist radio...');
                });
            }

            // --- Toast Function ---
            function showToast(message) {
                toastMessage.textContent = message;
                toast.classList.add('show');
                setTimeout(() => {
                    toast.classList.remove('show');
                }, 3000);
            }
        });
    </script>
@endsection
