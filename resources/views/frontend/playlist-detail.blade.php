@extends('layouts.frontend.master')

@section('css')
<style>
    .playlist-header {
        background: linear-gradient(135deg, #26163e 0%, #764ba2 100% 100%) !important;
        padding: 2rem 0;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .playlist-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.3);
        z-index: 1;
    }
    
    .playlist-header-content {
        position: relative;
        z-index: 2;
    }
    
    .playlist-cover {
        width: 200px;
        height: 200px;
        border-radius: 8px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        margin-bottom: 1rem;
    }
    
    .playlist-info h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    
    .playlist-meta {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-bottom: 1.5rem;
    }
    
    .playlist-actions {
        display: flex;
        gap: 1rem;
        align-items: center;
    }
    
    .btn-play {
        background: #1db954;
        color: white;
        border: none;
        border-radius: 50px;
        padding: 12px 32px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .btn-play:hover {
        background: #1ed760;
        transform: scale(1.05);
    }
    
    .btn-secondary {
        background: transparent;
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 50px;
        padding: 12px 24px;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .btn-secondary:hover {
        background: rgba(255, 255, 255, 0.1);
    }
    
    .songs-list {
        background: #121212;
        padding: 0;
    }
    
    .songs-header {
        background: rgba(255, 255, 255, 0.05);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        padding: 16px 24px;
        display: grid;
        grid-template-columns: 40px 1fr 1fr 100px 60px 120px;
        gap: 16px;
        align-items: center;
        color: #b3b3b3;
        font-size: 0.875rem;
        font-weight: 400;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .songs-container {
        padding: 0;
    }
    
    .song-item {
            display: grid;
            grid-template-columns: 40px 1fr 1fr 100px 60px 120px;
            gap: 16px;
            align-items: center;
            padding: 12px 24px;
            transition: background-color 0.2s;
            cursor: pointer;
            border-radius: 4px;
            margin: 0 8px;
            position: relative;
            min-height: 60px;
            background: #1b0d2d !important;
            border: 2px solid #9d6af5;
            margin: 4px 0;
            border-radius: 12px;
    }
    
    .song-item:hover {
        background: rgba(255, 255, 255, 0.1);
    }
    
    .song-item:hover .song-number {
        display: none;
    }
    
    .song-item:hover .song-play-button {
        display: block;
    }
    
    .song-number {
        text-align: center;
        color: #b3b3b3;
        font-size: 0.9rem;
        font-weight: 400;
    }
    
    .song-play-button {
        display: none;
        text-align: center;
        color: white;
        font-size: 1.2rem;
        cursor: pointer;
    }
    
    .song-play-button:hover {
        transform: scale(1.1);
    }
    
    .song-main-info {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }
    
    .song-thumbnail {
        width: 40px;
        height: 40px;
        border-radius: 4px;
        object-fit: cover;
        flex-shrink: 0;
    }
    
    .song-text-info {
        min-width: 0;
        flex: 1;
    }
    
    .song-name {
        font-weight: 400;
        color: white;
        margin-bottom: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-size: 1rem;
    }
    
    .song-artist {
        color: #b3b3b3;
        font-size: 0.875rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .song-album {
        color: #b3b3b3;
        font-size: 0.875rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .song-date-added {
        color: #b3b3b3;
        font-size: 0.875rem;
    }
    
    .song-duration {
        color: #b3b3b3;
        font-size: 0.875rem;
        text-align: right;
    }
    
    .song-actions {
        display: flex;
        gap: 8px;
        align-items: center;
        justify-content: flex-end;
        height: 100%;
    }
    
    .song-actions .btn {
        padding: 6px 8px;
        font-size: 0.8rem;
        opacity: 0;
        transition: all 0.2s;
        border-radius: 4px;
        min-width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .song-item:hover .song-actions .btn {
        opacity: 1;
    }
    
    .song-like-button {
        background: none;
        border: none;
        color: #b3b3b3;
        font-size: 1rem;
        cursor: pointer;
        padding: 6px;
        border-radius: 50%;
        transition: all 0.2s;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
    }
    
    .song-item:hover .song-like-button {
        opacity: 1;
    }
    
    .song-like-button:hover {
        color: #1db954;
        background: rgba(29, 185, 84, 0.1);
    }
    
    .song-like-button.liked {
        color: #1db954;
        opacity: 1;
    }
    
    .song-more-button {
        background: none;
        border: none;
        color: #b3b3b3;
        font-size: 1.2rem;
        cursor: pointer;
        padding: 6px;
        border-radius: 50%;
        transition: all 0.2s;
        opacity: 0;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .song-item:hover .song-more-button {
        opacity: 1;
    }
    
    .song-more-button:hover {
        color: white;
        background: rgba(255, 255, 255, 0.1);
    }
    
    .loading-spinner {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 200px;
    }
    
    .spinner {
        width: 40px;
        height: 40px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #1db954;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #b3b3b3;
    }
    
    .empty-state h3 {
        color: white;
        margin-bottom: 1rem;
    }
    
    /* Mobile responsiveness */
    @media (max-width: 768px) {
        .songs-header {
            grid-template-columns: 30px 1fr 80px 60px 100px;
            gap: 8px;
            padding: 12px 16px;
            font-size: 0.75rem;
        }
        
        .songs-header div:nth-child(3) {
            display: none; /* Hide album column on mobile */
        }
        
        .song-item {
            grid-template-columns: 30px 1fr 80px 60px 100px;
            gap: 8px;
            padding: 8px 16px;
            min-height: 50px;
        }
        
        .song-item .song-album {
            display: none; /* Hide album column on mobile */
        }
        
        .song-actions {
            gap: 4px;
        }
        
        .song-like-button,
        .song-more-button {
            width: 28px;
            height: 28px;
            font-size: 0.9rem;
        }
        
        .song-actions .btn {
            min-width: 28px;
            height: 28px;
            font-size: 0.7rem;
        }
        
        .playlist-header-content {
            flex-direction: column;
            text-align: center;
        }
        
        .playlist-cover {
            width: 150px;
            height: 150px;
            margin: 0 auto 1rem;
        }
        
        .playlist-info h1 {
            font-size: 2rem;
        }
    }
    #addSongsModal .modal-dialog {
        height: 100vh;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    /* Play button animation */
    .song-play-button i {
        transition: transform 0.2s ease;
    }
    
    .song-play-button:hover i {
        transform: scale(1.1);
    }
    
    /* Song item selection */
    .song-item.selected {
            background: rgb(137 137 137 / 22%) !important;
    }
    
    .song-item.selected .song-name {
        color: #1db954;
    }
    
    /* Smooth transitions */
    .song-item * {
        transition: all 0.2s ease;
    }

    /* Songs Grid for Modal */
    .songs-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
        margin-top: 16px;
    }

    .song-card {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(229, 209, 250, 0.3);
        border-radius: 8px;
        padding: 16px;
        transition: all 0.2s ease;
        cursor: pointer;
        backdrop-filter: blur(10px);
    }

    .song-card:hover {
        border-color: rgba(229, 209, 250, 0.5);
        box-shadow: 0 4px 12px rgba(17, 10, 92, 0.2);
        background: rgba(255, 255, 255, 0.15);
    }

    .song-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 8px;
    }

    .song-card-thumbnail {
        width: 48px;
        height: 48px;
        border-radius: 6px;
        object-fit: cover;
        flex-shrink: 0;
        background: rgba(229, 209, 250, 0.2);
    }

    .song-card-info {
        flex: 1;
        min-width: 0;
    }

    .song-card-title {
        font-size: 15px;
        font-weight: 600;
        color: white;
        margin: 0 0 2px 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .song-card-artist {
        font-size: 13px;
        color: rgba(229, 209, 250, 0.8);
        margin: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .song-card-actions {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .song-card-btn {
        background: rgba(229, 209, 250, 0.2);
        border: 1px solid rgba(229, 209, 250, 0.3);
        border-radius: 6px;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(229, 209, 250, 0.8);
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 12px;
    }

    .song-card-btn:hover {
        background: rgba(229, 209, 250, 0.3);
        color: white;
    }

    .song-card-btn.play-btn {
        background: #1db954;
        border-color: #1db954;
        color: white;
    }

    .song-card-btn.play-btn:hover {
        background: #1ed760;
        border-color: #1ed760;
    }

    .song-card-btn.add-btn {
        background: rgba(198, 156, 244, 0.8);
        border-color: rgba(198, 156, 244, 0.8);
        color: white;
    }

    .song-card-btn.add-btn:hover {
        background: #c69cf4;
        border-color: #c69cf4;
    }

    .song-card-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 11px;
        color: rgba(229, 209, 250, 0.6);
        margin-top: 8px;
        padding-top: 8px;
        border-top: 1px solid rgba(229, 209, 250, 0.2);
    }

    .no-songs-found {
        text-align: center;
        padding: 40px 20px;
        color: rgba(229, 209, 250, 0.8);
    }

    .no-songs-found i {
        font-size: 40px;
        margin-bottom: 12px;
        opacity: 0.5;
        color: rgba(229, 209, 250, 0.5);
    }

    .no-songs-found h4 {
        margin-bottom: 8px;
        color: white;
        font-size: 16px;
    }

    .no-songs-found p {
        margin-bottom: 0;
        font-size: 14px;
    }

    /* Mobile Responsive for Modal */
    @media (max-width: 768px) {
        .song-card {
            padding: 12px;
        }

        .song-card-thumbnail {
            width: 40px;
            height: 40px;
        }

        .song-card-title {
            font-size: 14px;
        }

        .song-card-artist {
            font-size: 12px;
        }

        .song-card-btn {
            width: 28px;
            height: 28px;
            font-size: 11px;
        }

        .song-card-meta {
            font-size: 10px;
        }
    }
</style>
@endsection

@section('content')
<div class="playlist-header">
    <div class="container">
        <div class="playlist-header-content d-flex align-items-end">
            <div class="me-4">
                <img id="playlistCover" src="" alt="Playlist Cover" class="playlist-cover">
            </div>
            <div class="flex-grow-1">
                <h1 id="playlistName">Loading...</h1>
                <div class="playlist-meta" id="playlistMeta">Loading...</div>
        <div class="playlist-actions">
            <button class="btn-play" onclick="playPlaylist()">▶ Play</button>
            <button class="btn-secondary" onclick="shufflePlaylist()"><svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24" fill="white">
                <path d="M16.7751 9.79734C16.4792 10.0873 16.4744 10.5621 16.7643 10.8579C17.0543 11.1538 17.5291 11.1586 17.8249 10.8687L16.7751 9.79734ZM19.5249 9.20266C19.8208 8.91274 19.8256 8.43789 19.5357 8.14205C19.2457 7.84622 18.7709 7.84142 18.4751 8.13134L19.5249 9.20266ZM18.4749 9.2025C18.7706 9.49251 19.2455 9.48786 19.5355 9.19211C19.8255 8.89636 19.8209 8.42151 19.5251 8.1315L18.4749 9.2025ZM17.8251 6.4645C17.5294 6.17449 17.0545 6.17914 16.7645 6.47489C16.4745 6.77064 16.4791 7.24549 16.7749 7.5355L17.8251 6.4645ZM18.9735 9.41653C19.3875 9.43115 19.7349 9.10742 19.7495 8.69346C19.7641 8.27951 19.4404 7.93208 19.0265 7.91747L18.9735 9.41653ZM5 14.583C4.58579 14.583 4.25 14.9188 4.25 15.333C4.25 15.7472 4.58579 16.083 5 16.083V14.583ZM17.8249 13.1313C17.5291 12.8414 17.0543 12.8462 16.7643 13.1421C16.4744 13.4379 16.4792 13.9127 16.7751 14.2027L17.8249 13.1313ZM18.4751 15.8687C18.7709 16.1586 19.2457 16.1538 19.5357 15.8579C19.8256 15.5621 19.8208 15.0873 19.5249 14.7973L18.4751 15.8687ZM19.5251 15.8685C19.8209 15.5785 19.8255 15.1036 19.5355 14.8079C19.2455 14.5121 18.7706 14.5075 18.4749 14.7975L19.5251 15.8685ZM16.7749 16.4645C16.4791 16.7545 16.4745 17.2294 16.7645 17.5251C17.0545 17.8209 17.5294 17.8255 17.8251 17.5355L16.7749 16.4645ZM19.0265 16.0825C19.4404 16.0679 19.7641 15.7205 19.7495 15.3065C19.7349 14.8926 19.3875 14.5689 18.9735 14.5835L19.0265 16.0825ZM5 7.917C4.58579 7.917 4.25 8.25279 4.25 8.667C4.25 9.08121 4.58579 9.417 5 9.417V7.917ZM17.8249 10.8687L19.5249 9.20266L18.4751 8.13134L16.7751 9.79734L17.8249 10.8687ZM19.5251 8.1315L17.8251 6.4645L16.7749 7.5355L18.4749 9.2025L19.5251 8.1315ZM19.0265 7.91747C16.0086 7.81093 13.9537 8.17906 12.4743 8.84951C10.9717 9.53046 10.1311 10.4927 9.49687 11.4203C9.21681 11.83 8.89561 12.3629 8.67258 12.7002C8.41581 13.0886 8.16957 13.414 7.8797 13.6833C7.33706 14.1873 6.54721 14.583 5 14.583V16.083C6.84679 16.083 8.02744 15.5933 8.90055 14.7823C9.31855 14.394 9.6415 13.9545 9.92383 13.5275C10.2399 13.0495 10.4277 12.7166 10.7351 12.2669C11.2759 11.476 11.9243 10.7456 13.0935 10.2158C14.2858 9.67544 16.0854 9.31457 18.9735 9.41653L19.0265 7.91747ZM16.7751 14.2027L18.4751 15.8687L19.5249 14.7973L17.8249 13.1313L16.7751 14.2027ZM18.4749 14.7975L16.7749 16.4645L17.8251 17.5355L19.5251 15.8685L18.4749 14.7975ZM18.9735 14.5835C16.0854 14.6854 14.2858 14.3246 13.0935 13.7842C11.9243 13.2544 11.2759 12.524 10.7351 11.7331C10.4277 11.2834 10.2399 10.9505 9.92383 10.4725C9.6415 10.0455 9.31855 9.60595 8.90055 9.21769C8.02744 8.4067 6.84679 7.917 5 7.917V9.417C6.54721 9.417 7.33706 9.81268 7.8797 10.3167C8.16957 10.586 8.41581 10.9114 8.67258 11.2998C8.89561 11.6371 9.21681 12.17 9.49687 12.5797C10.1311 13.5073 10.9717 14.4695 12.4743 15.1505C13.9537 15.8209 16.0086 16.1891 19.0265 16.0825L18.9735 14.5835Z" fill="white"/>
            </svg>
            Shuffle</button>
            <button class="btn-secondary" onclick="openAddSongsModal()"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="white">
            <path d="M19 13H13V19H11V13H5V11H11V5H13V11H19V13Z"/>
            </svg>
            Add Songs</button>
        </div>
            </div>
        </div>
    </div>
</div>

<div class="songs-list">
    <div class="container">
        <!-- Songs Search -->
        <div class="songs-search" style="padding: 16px 24px; background: rgba(255, 255, 255, 0.05); border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
            <input type="text" id="songsSearchInput" class="form-control" placeholder="Search in playlist..." style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); color: white; border-radius: 20px; padding: 8px 16px;">
        </div>
        
        <!-- Songs Header -->
        <div class="songs-header">
            <div>#</div>
            <div>Title</div>
            <div>Album</div>
            <div>Date added</div>
            <div>Duration</div>
            <div>Actions</div>
        </div>
        
        <!-- Songs Container -->
        <div class="songs-container" id="songsContainer">
            <div class="loading-spinner">
                <div class="spinner"></div>
            </div>
        </div>
    </div>
</div>

<!-- Add Songs Modal -->
<div class="modal fade" id="addSongsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border: none; border-radius: 12px; box-shadow: 0 10px 40px rgba(17, 10, 92, 0.2); background:#290d46">
            <div class="modal-header" style="border-bottom: 1px solid rgba(229, 209, 250, 0.3); padding: 20px 24px;">
                <h5 class="modal-title text-white" style="font-size: 1.25rem; font-weight: 600;">
                    <i class="fas fa-plus-circle me-2" style="color: #e5d1fa;"></i>Add Songs to Playlist
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="padding: 24px;">
                <!-- Search Section -->
                <div class="search-section mb-4">
                    <div class="form-group position-relative">
                        <input type="text" 
                               class="form-control" 
                               id="songSearchInput" 
                               placeholder="Search songs to add to playlist..." 
                               style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(229, 209, 250, 0.3); border-radius: 8px; padding: 12px 16px; font-size: 14px; color: white; backdrop-filter: blur(10px);">
                        <i class="fas fa-search position-absolute" style="right: 16px; top: 50%; transform: translateY(-50%); color: rgba(229, 209, 250, 0.7);"></i>
                    </div>
                </div>

                <!-- Songs Grid -->
                <div id="availableSongs" class="songs-grid" style="max-height: 400px; overflow-y: auto;">
                    <div class="loading-spinner text-center py-5">
                        <div class="spinner-border text-light" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="text-white mt-3">Searching for songs...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let playlistData = null;

// Get playlist name from URL
const urlParams = new URLSearchParams(window.location.search);
const playlistName = urlParams.get('name');

if (!playlistName) {
    window.location.href = '/user-portal';
}

// Load playlist details
async function loadPlaylistDetails() {
    try {
        const response = await fetch(`/api/playlist/${encodeURIComponent(playlistName)}`);
        const data = await response.json();
        
        if (data.success) {
            playlistData = data.data;
            displayPlaylistDetails();
        } else {
            showError('Failed to load playlist: ' + data.message);
        }
    } catch (error) {
        console.error('Error loading playlist:', error);
        showError('Error loading playlist. Please try again.');
    }
}

function displayPlaylistDetails() {
    // Update header
    document.getElementById('playlistName').textContent = playlistData.playlist_name;
    document.getElementById('playlistMeta').textContent = 
        `${playlistData.songs_count} songs • calculating...`;
    
    // Update cover image
    const coverImg = document.getElementById('playlistCover');
    if (playlistData.thumbnail) {
        coverImg.src = playlistData.thumbnail;
    } else {
        coverImg.src = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaD0iMjAwIiB2aWV3Qm94PSIwIDAgMjAwIDIwMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjIwMCIgaGVpZ2h0PSIyMDAiIGZpbGw9IiMxMjEyMTIiLz4KPHBhdGggZD0iTTgwIDgwSDgwVjEyMEg4MFY4MFoiIGZpbGw9IiM2NjZFRUEiLz4KPHBhdGggZD0iTTEyMCA4MEgxMjBWMTIwSDEyMFY4MFoiIGZpbGw9IiM2NjZFRUEiLz4KPC9zdmc+Cg==';
    }
    
    // Display songs
    displaySongs();
}

function displaySongs() {
    const container = document.getElementById('songsContainer');
    
    if (playlistData.songs.length === 0) {
        container.innerHTML = `
            <div class="empty-state">
                <h3>No songs in this playlist</h3>
                <p>Add some songs to get started!</p>
            </div>
        `;
        return;
    }
    
    container.innerHTML = playlistData.songs.map((song, index) => {
        const addedDate = new Date(song.added_at || Date.now());
        const timeAgo = getTimeAgo(addedDate);
        
        return `
            <div class="song-item" onclick="playSong(${song.id})">
                <div class="song-number">${index + 1}</div>
                <div class="song-play-button" onclick="event.stopPropagation(); playSong(${song.id})">
                    <i class="fas fa-play"></i>
                </div>
                
                <div class="song-main-info">
                    <img src="${song.thumbnail || 'default-song.png'}" style="width:15%">
                    <div class="song-text-info">
                        <div class="song-name">${song.name}</div>
                        <div class="song-artist">${song.artist}</div>
                    </div>
                </div>
                
                <div class="song-album">${song.album || 'Unknown Album'}</div>
                <div class="song-date-added">${timeAgo}</div>
                <div class="song-duration" id="song-duration-${song.id}">--:--</div>
                
                <div class="song-actions">
                    <button class="song-like-button" onclick="event.stopPropagation(); toggleLike(${song.id})" title="Add to your Liked Songs">
                        <i class="far fa-heart"></i>
                    </button>
                    <button class="song-more-button" onclick="event.stopPropagation(); showSongMenu(${song.id})" title="More options">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-danger" onclick="event.stopPropagation(); removeSongFromPlaylist(${song.id})" title="Remove from playlist">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `;
    }).join('');

    // After rendering, compute real durations from audio metadata
    computeAndRenderDurations();
    
    // Load favorite status for all songs
    loadFavoriteStatus();
}

// Format seconds into M:SS
function formatDuration(totalSeconds) {
    if (!isFinite(totalSeconds) || totalSeconds <= 0) return '--:--';
    const minutes = Math.floor(totalSeconds / 60);
    const seconds = Math.floor(totalSeconds % 60).toString().padStart(2, '0');
    return `${minutes}:${seconds}`;
}

// Get time ago string
function getTimeAgo(date) {
    const now = new Date();
    const diffInSeconds = Math.floor((now - date) / 1000);
    
    if (diffInSeconds < 60) {
        return `${diffInSeconds} seconds ago`;
    } else if (diffInSeconds < 3600) {
        const minutes = Math.floor(diffInSeconds / 60);
        return `${minutes} minute${minutes > 1 ? 's' : ''} ago`;
    } else if (diffInSeconds < 86400) {
        const hours = Math.floor(diffInSeconds / 3600);
        return `${hours} hour${hours > 1 ? 's' : ''} ago`;
    } else {
        const days = Math.floor(diffInSeconds / 86400);
        return `${days} day${days > 1 ? 's' : ''} ago`;
    }
}

// Toggle like for a song
async function toggleLike(songId) {
    console.log('Toggling like for song:', songId);
    
    const likeButton = document.querySelector(`button[onclick*="toggleLike(${songId})"]`);
    const icon = likeButton.querySelector('i');
    
    try {
        const response = await fetch('/api/favorites/toggle', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                music_id: songId
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Update UI based on response
            if (data.is_favorited) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                likeButton.classList.add('liked');
                likeButton.title = 'Remove from Liked Songs';
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                likeButton.classList.remove('liked');
                likeButton.title = 'Add to your Liked Songs';
            }
            
            // Show success message
            showNotification(data.message, 'success');
        } else {
            showNotification(data.message, 'error');
        }
    } catch (error) {
        console.error('Error toggling favorite:', error);
        showNotification('Error updating favorite status', 'error');
    }
}

// Show song menu
function showSongMenu(songId) {
    console.log('Showing menu for song:', songId);
    // Add your menu functionality here
    alert('Song menu for song ID: ' + songId);
}

// Compute per-song durations and total playlist duration
async function computeAndRenderDurations() {
    if (!playlistData || !Array.isArray(playlistData.songs)) return;

    let totalSeconds = 0;
    const loadPromises = playlistData.songs.map(song => new Promise(resolve => {
        if (!song.music_file) return resolve(0);
        const audio = new Audio();
        const onLoaded = () => {
            const dur = isFinite(audio.duration) ? audio.duration : 0;
            const el = document.getElementById(`song-duration-${song.id}`);
            if (el) el.textContent = formatDuration(dur);
            totalSeconds += dur;
            cleanup();
            resolve(dur);
        };
        const onError = () => {
            const el = document.getElementById(`song-duration-${song.id}`);
            if (el) el.textContent = '--:--';
            cleanup();
            resolve(0);
        };
        function cleanup() {
            audio.removeEventListener('loadedmetadata', onLoaded);
            audio.removeEventListener('error', onError);
        }
        audio.addEventListener('loadedmetadata', onLoaded);
        audio.addEventListener('error', onError);
        // Use absolute or relative path as provided
        audio.src = song.music_file || '';
        // Hint browser to load metadata only
        audio.preload = 'metadata';
    }));

    try {
        await Promise.all(loadPromises);
    } catch (_) {}

    // Update header meta with computed total
    const totalText = formatDuration(totalSeconds);
    const meta = document.getElementById('playlistMeta');
    if (meta) meta.textContent = `${playlistData.songs.length} songs • ${totalText}`;
}

function playSong(songId) {
    console.log('Playing song:', songId);
    
    // Remove selection from all songs
    document.querySelectorAll('.song-item').forEach(item => {
        item.classList.remove('selected');
    });
    
    // Add selection to current song
    const songItem = document.querySelector(`.song-item[onclick*="playSong(${songId})"]`);
    if (songItem) {
        songItem.classList.add('selected');
    }
    
    // Play the song using the global music player
    if (window.MusicPlayer) {
        // Set the current playlist
        window.MusicPlayer.setPlaylist(playlistData.songs);
        // Play the specific track
        window.MusicPlayer.playTrack(songId);
    }
    
    const song = playlistData.songs.find(s => s.id === songId);
    if (song) {
        console.log(`Now playing: ${song.name} by ${song.artist}`);
    }
}

function playPlaylist() {
    console.log('Playing playlist:', playlistData.playlist_name);
    
    if (window.MusicPlayer && playlistData.songs.length > 0) {
        // Set the playlist and start playing from the first song
        window.MusicPlayer.setPlaylist(playlistData.songs, 0);
        window.MusicPlayer.play();
        
        // Update visual selection
        document.querySelectorAll('.song-item').forEach(item => {
            item.classList.remove('selected');
        });
        const firstSongItem = document.querySelector('.song-item');
        if (firstSongItem) {
            firstSongItem.classList.add('selected');
        }
    }
}

function shufflePlaylist() {
    console.log('Shuffling playlist:', playlistData.playlist_name);
    
    if (window.MusicPlayer && playlistData.songs.length > 0) {
        // Create a shuffled copy of the playlist
        const shuffledSongs = [...playlistData.songs].sort(() => Math.random() - 0.5);
        
        // Set the shuffled playlist and start playing
        window.MusicPlayer.setPlaylist(shuffledSongs, 0);
        window.MusicPlayer.play();
        
        // Update visual selection
        document.querySelectorAll('.song-item').forEach(item => {
            item.classList.remove('selected');
        });
        const firstSongItem = document.querySelector('.song-item');
        if (firstSongItem) {
            firstSongItem.classList.add('selected');
        }
    }
}

function showError(message) {
    document.getElementById('songsContainer').innerHTML = `
        <div class="empty-state">
            <h3>Error</h3>
            <p>${message}</p>
        </div>
    `;
}

function openAddSongsModal() {
    const modal = new bootstrap.Modal(document.getElementById('addSongsModal'));
    modal.show();
    
    // Initialize search functionality
    initializeSongSearch();
}

async function loadAvailableSongs() {
    try {
        const response = await fetch('/api/songs?per_page=50');
        const data = await response.json();
        
        if (data.success) {
            displayAvailableSongs(data.data.songs);
        } else {
            showAvailableSongsError('Failed to load songs: ' + data.message);
        }
    } catch (error) {
        console.error('Error loading available songs:', error);
        showAvailableSongsError('Error loading songs. Please try again.');
    }
}

function displayAvailableSongs(songs) {
    const container = document.getElementById('availableSongs');
    
    // Filter out songs that are already in the playlist
    const playlistSongIds = playlistData ? playlistData.songs.map(song => song.id) : [];
    const availableSongs = songs.filter(song => !playlistSongIds.includes(song.id));
    
    if (availableSongs.length === 0) {
        container.innerHTML = `
            <div class="empty-state">
                <h5>No songs available</h5>
                <p>All songs are already in this playlist</p>
            </div>
        `;
        return;
    }
    
    container.innerHTML = availableSongs.map(song => `
        <div class="song-item">
            <img src="${song.thumbnail || 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIiBmaWxsPSIjMTIxMjEyIi8+CjxwYXRoIGQ9Ik0xNiAxMkgxNlYyOEgxNlYxMloiIGZpbGw9IiM2NjZFRUEiLz4KPHBhdGggZD0iTTI0IDEySDI0VjI4SDI0VjEyWiIgZmlsbD0iIzY2NkVFQSIvPgo8L3N2Zz4K'}" alt="Song Cover" class="song-thumbnail" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIiBmaWxsPSIjMTIxMjEyIi8+CjxwYXRoIGQ9Ik0xNiAxMkgxNlYyOEgxNlYxMloiIGZpbGw9IiM2NjZFRUEiLz4KPHBhdGggZD0iTTI0IDEySDI0VjI4SDI0VjEyWiIgZmlsbD0iIzY2NkVFQSIvPgo8L3N2Zz4K'">
            <div class="song-info">
                <div class="song-name">${song.name}</div>
                <div class="song-artist">${song.artist}</div>
            </div>
            <div class="song-actions">
                <button class="btn btn-sm btn-success" onclick="addSongToPlaylist(${song.id})" title="Add to playlist">
                    <i class="fas fa-plus"></i> Add
                </button>
            </div>
        </div>
    `).join('');
}

async function addSongToPlaylist(songId) {
    try {
        const response = await fetch('/api/playlist/add-song', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                music_id: songId,
                playlist_name: playlistName
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            showNotification('Song added to playlist successfully!', 'success');
            // Refresh the playlist details
            loadPlaylistDetails();
            // Refresh search results if modal is open
            const searchInput = document.getElementById('songSearchInput');
            if (searchInput && searchInput.value.trim().length >= 2) {
                searchSongs(searchInput.value.trim());
            } else {
                showSearchPlaceholder();
            }
        } else {
            showNotification('Error: ' + data.message, 'error');
        }
    } catch (error) {
        console.error('Error adding song to playlist:', error);
        alert('Error adding song to playlist. Please try again.');
    }
}

async function removeSongFromPlaylist(songId) {
    if (!confirm('Remove this song from the playlist?')) {
        return;
    }
    
    try {
        const response = await fetch('/api/playlist/remove-song', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                music_id: songId,
                playlist_name: playlistName
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            alert('Song removed from playlist successfully!');
            // Refresh the playlist details
            loadPlaylistDetails();
        } else {
            alert('Error: ' + data.message);
        }
    } catch (error) {
        console.error('Error removing song from playlist:', error);
        alert('Error removing song from playlist. Please try again.');
    }
}

function showAvailableSongsError(message) {
    const container = document.getElementById('availableSongs');
    container.innerHTML = `
        <div class="empty-state">
            <h5>Error</h5>
            <p>${message}</p>
        </div>
    `;
}

// Initialize song search functionality
function initializeSongSearch() {
    const searchInput = document.getElementById('songSearchInput');
    let searchTimeout = null;
    
    // Clear previous timeout
    if (searchTimeout) {
        clearTimeout(searchTimeout);
    }
    
    // Add event listener for search
    searchInput.addEventListener('input', function() {
        const query = this.value.trim();
        
        // Clear previous timeout
        if (searchTimeout) {
            clearTimeout(searchTimeout);
        }
        
        if (query.length < 2) {
            showSearchPlaceholder();
            return;
        }
        
        // Debounce search
        searchTimeout = setTimeout(() => {
            searchSongs(query);
        }, 300);
    });
    
    // Show initial placeholder
    showSearchPlaceholder();
}

// Show search placeholder
function showSearchPlaceholder() {
    const container = document.getElementById('availableSongs');
    container.innerHTML = `
        <div class="no-songs-found">
            <i class="fas fa-search"></i>
            <h4>Search for songs</h4>
            <p>Type at least 2 characters to search for songs to add to your playlist</p>
        </div>
    `;
}

// Search songs function
async function searchSongs(query) {
    try {
        // Show loading
        const container = document.getElementById('availableSongs');
        container.innerHTML = `
            <div class="loading-spinner text-center py-5">
                <div class="spinner-border text-light" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="text-white mt-3">Searching for songs...</p>
            </div>
        `;
        
        console.log('Searching for songs:', query);
        
        const response = await fetch(`/api/music/search?q=${encodeURIComponent(query)}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const data = await response.json();
        console.log('Search response:', data);
        
        if (data.success && data.data.length > 0) {
            displaySearchResults(data.data);
        } else {
            showNoResults();
        }
    } catch (error) {
        console.error('Search error:', error);
        showSearchError('Error searching songs. Please try again.');
    }
}

// Display search results
function displaySearchResults(songs) {
    const container = document.getElementById('availableSongs');
    
    // Filter out songs that are already in the playlist
    const playlistSongIds = playlistData ? playlistData.songs.map(song => song.id) : [];
    const availableSongs = songs.filter(song => !playlistSongIds.includes(song.id));
    
    if (availableSongs.length === 0) {
        showNoResults('All search results are already in this playlist');
        return;
    }
    
    container.innerHTML = availableSongs.map(song => {
        // Escape special characters in song data
        const escapedName = song.name.replace(/'/g, "\\'").replace(/"/g, '\\"');
        const escapedArtist = song.artist.replace(/'/g, "\\'").replace(/"/g, '\\"');
        const escapedThumbnail = (song.thumbnail || '').replace(/'/g, "\\'").replace(/"/g, '\\"');
        
        return `
            <div class="song-card" onclick="playSongFromSearch(${song.id}, '${escapedName}', '${escapedArtist}', '${escapedThumbnail}', '${song.music_file || ''}')">
                <div class="song-card-header">
                    <img src="${song.thumbnail || 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDgiIGhlaWdodD0iNDgiIHZpZXdCb3g9IjAgMCA0OCA0OCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjQ4IiBoZWlnaHQ9IjQ4IiBmaWxsPSJyZ2JhKDIyOSwgMjA5LCAyNTAsIDAuMikiLz4KPHBhdGggZD0iTTE5IDEySDE5VjM2SDE5VjEyWiIgZmlsbD0icmdiYSgyMjksIDIwOSwgMjUwLCAwLjgpIi8+CjxwYXRoIGQ9Ik0yOSAxMkgyOVYzNkgyOVYxMloiIGZpbGw9InJnYmEoMjI5LCAyMDksIDI1MCwgMC44KSIvPgo8L3N2Zz4K'}" 
                         alt="Album Cover" 
                         class="song-card-thumbnail" 
                         onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDgiIGhlaWdodD0iNDgiIHZpZXdCb3g9IjAgMCA0OCA0OCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjQ4IiBoZWlnaHQ9IjQ4IiBmaWxsPSJyZ2JhKDIyOSwgMjA5LCAyNTAsIDAuMikiLz4KPHBhdGggZD0iTTE5IDEySDE5VjM2SDE5VjEyWiIgZmlsbD0icmdiYSgyMjksIDIwOSwgMjUwLCAwLjgpIi8+CjxwYXRoIGQ9Ik0yOSAxMkgyOVYzNkgyOVYxMloiIGZpbGw9InJnYmEoMjI5LCAyMDksIDI1MCwgMC44KSIvPgo8L3N2Zz4K'">
                    <div class="song-card-info">
                        <h4 class="song-card-title">${song.name}</h4>
                        <p class="song-card-artist">${song.artist}</p>
                    </div>
                    <div class="song-card-actions" onclick="event.stopPropagation()">
                        <button class="song-card-btn play-btn" onclick="playSongFromSearch(${song.id}, '${escapedName}', '${escapedArtist}', '${escapedThumbnail}', '${song.music_file || ''}')" title="Play song">
                            <i class="fas fa-play"></i>
                        </button>
                        <button class="song-card-btn add-btn" onclick="addSongToPlaylist(${song.id})" title="Add to playlist">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="song-card-meta">
                    <span class="song-duration">${song.duration || '0:00'}</span>
                    <span class="song-listeners">${song.listeners || 0} plays</span>
                </div>
            </div>
        `;
    }).join('');
}

// Play song from search results
function playSongFromSearch(songId, name, artist, thumbnail, musicFile) {
    console.log('Playing song from search:', { songId, name, artist, thumbnail, musicFile });
    
    if (window.MusicPlayer) {
        const track = {
            id: songId,
            name: name,
            artist: artist,
            thumbnail: thumbnail,
            music_file: musicFile
        };
        
        window.MusicPlayer.loadTrack(track);
        window.MusicPlayer.play();
    }
}

// Show no results
function showNoResults(message = 'No songs found') {
    const container = document.getElementById('availableSongs');
    container.innerHTML = `
        <div class="no-songs-found">
            <i class="fas fa-music"></i>
            <h4>${message}</h4>
            <p>Try searching with different keywords</p>
        </div>
    `;
}

// Show search error
function showSearchError(message) {
    const container = document.getElementById('availableSongs');
    container.innerHTML = `
        <div class="no-songs-found">
            <i class="fas fa-exclamation-triangle"></i>
            <h4>Search Error</h4>
            <p>${message}</p>
        </div>
    `;
}

// Show notification helper
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type === 'success' ? 'success' : type === 'error' ? 'danger' : 'info'} alert-dismissible fade show position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 3000);
}

function initializeSearch() {
    const searchInput = document.getElementById('songsSearchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            filterSongs(query);
        });
    }
}

function filterSongs(query) {
    const songItems = document.querySelectorAll('.song-item');
    
    songItems.forEach(item => {
        const songName = item.querySelector('.song-name').textContent.toLowerCase();
        const songArtist = item.querySelector('.song-artist').textContent.toLowerCase();
        const songAlbum = item.querySelector('.song-album').textContent.toLowerCase();
        
        const matches = songName.includes(query) || 
                       songArtist.includes(query) || 
                       songAlbum.includes(query);
        
        item.style.display = matches ? 'grid' : 'none';
    });
}

// Show notification
function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `alert alert-${type === 'success' ? 'success' : type === 'error' ? 'danger' : 'info'} alert-dismissible fade show position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(notification);
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            notification.parentNode.removeChild(notification);
        }
    }, 3000);
}

// Load favorite status for all songs
async function loadFavoriteStatus() {
    if (!playlistData || !playlistData.songs) return;
    
    try {
        const musicIds = playlistData.songs.map(song => song.id);
        const response = await fetch('/api/favorites/check', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                music_ids: musicIds
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            const favoritedIds = data.data;
            
            // Update UI for each song
            playlistData.songs.forEach(song => {
                const likeButton = document.querySelector(`button[onclick*="toggleLike(${song.id})"]`);
                if (likeButton) {
                    const icon = likeButton.querySelector('i');
                    if (favoritedIds.includes(song.id)) {
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                        likeButton.classList.add('liked');
                        likeButton.title = 'Remove from Liked Songs';
                    } else {
                        icon.classList.remove('fas');
                        icon.classList.add('far');
                        likeButton.classList.remove('liked');
                        likeButton.title = 'Add to your Liked Songs';
                    }
                }
            });
        }
    } catch (error) {
        console.error('Error loading favorite status:', error);
    }
}

// Ad Injection System for playlist detail page
const adInjectionSystem = {
    isEnabled: false,
    currentAd: null,
    adContainer: null,
    isShowingAd: false,
    showAdsBetweenSongs: true,
    showAdsDuringPlayback: true,
    adTimer: null,
    nextAdTime: 30, // Default 30 seconds
    midSongAdShown: false, // Flag to prevent multiple mid-song ads

    // Initialize the ad injection system
    init() {
        console.log('AdInjectionSystem: Initializing...');
        this.adContainer = document.getElementById('ad-container');
        this.checkAdStatus();
    },
    
    async checkAdStatus() {
        try {
            console.log('AdInjectionSystem: Checking ad status...');
            
            const response = await fetch('/api/ad-injection/data', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            });
            
            console.log('AdInjectionSystem: API response status:', response.status);
            
            // Check if response is HTML instead of JSON
            const responseText = await response.text();
            console.log('AdInjectionSystem: Raw response (first 200 chars):', responseText.substring(0, 200));
            
            if (responseText.includes('<!DOCTYPE')) {
                console.error('AdInjectionSystem: Response is HTML, not JSON!');
                throw new Error('API returned HTML instead of JSON');
            }
            
            const data = JSON.parse(responseText);
            console.log('AdInjectionSystem: API response data:', data);
            
            if (data.success && data.data && data.data.show_ads) {
                this.isEnabled = true;
                this.currentAd = data.data.ad;
                this.nextAdTime = data.data.next_ad_in_seconds || 30; // Default 30 seconds
                console.log('AdInjectionSystem: Ads enabled - will show during playback and between songs', {
                    ad: this.currentAd,
                    showAdsBetweenSongs: this.showAdsBetweenSongs,
                    showAdsDuringPlayback: this.showAdsDuringPlayback,
                    nextAdIn: this.nextAdTime
                });
                // Start timer for during-playback ads
                this.startAdTimer();
            } else {
                this.isEnabled = false;
                console.log('AdInjectionSystem: Ads disabled - Premium user or no ads available', {
                    success: data.success,
                    show_ads: data.data ? data.data.show_ads : 'no data',
                    message: data.message
                });
            }
        } catch (error) {
            console.error('AdInjectionSystem: Error checking ad status', error);
            this.isEnabled = false;
        }
    },
    
    // Start ad timer for during-playback ads
    startAdTimer() {
        if (!this.isEnabled || this.adTimer) return;
        
        // Random time between 10-60 seconds for during-playback ads
        const randomTime = Math.floor(Math.random() * 50) + 10; // 10-60 seconds
        console.log(`AdInjectionSystem: Starting ad timer for ${randomTime} seconds`);
        
        this.adTimer = setTimeout(() => {
            this.showAdDuringPlayback();
        }, randomTime * 1000);
    },
    
    // Show ad between songs
    showAdBetweenSongs() {
        if (!this.isEnabled || this.isShowingAd) return;
        console.log('AdInjectionSystem: Showing ad between songs');
        this.showAd();
    },
    
    // Show ad during playback
    showAdDuringPlayback() {
        if (!this.isEnabled || this.isShowingAd) return;
        console.log('AdInjectionSystem: Showing ad during playback');
        this.showAd();
    },
    
    // Show ad at specific song progress (e.g., 50% through song)
    showAdAtProgress(progressPercent) {
        if (!this.isEnabled || this.isShowingAd || this.midSongAdShown) return;
        console.log(`AdInjectionSystem: Showing ad at ${progressPercent}% progress`);
        this.midSongAdShown = true; // Prevent multiple mid-song ads
        this.showAd();
    },
    
    // Show the actual ad
    showAd() {
        if (!this.currentAd || this.isShowingAd) return;
        
        console.log('AdInjectionSystem: Displaying ad', this.currentAd);
        
        // Pause music player
        if (window.MusicPlayer && window.MusicPlayer.audio) {
            window.MusicPlayer.audio.pause();
        }
        
        this.isShowingAd = true;
        
        // Create ad overlay
        const adOverlay = document.createElement('div');
        adOverlay.id = 'ad-overlay';
        adOverlay.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.95);
            z-index: 10000;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            font-family: Arial, sans-serif;
        `;
        
        // Ad content
        const adContent = document.createElement('div');
        adContent.style.cssText = `
            text-align: center;
            max-width: 600px;
            padding: 2rem;
        `;
        
        // Ad title
        const adTitle = document.createElement('h2');
        adTitle.textContent = this.currentAd.title;
        adTitle.style.cssText = `
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #fff;
        `;
        
        // Ad media (if available)
        let adMedia = '';
        console.log('AdInjectionSystem: Creating ad media for:', this.currentAd);
        
        if (this.currentAd.file_url) {
            // Use file_url from API response
            const fileUrl = this.currentAd.file_url;
            const fileExtension = fileUrl.split('.').pop().toLowerCase();
            console.log('AdInjectionSystem: File URL detected:', fileUrl, 'Extension:', fileExtension);
            
            if (['mp4', 'webm', 'ogg', 'avi', 'mov'].includes(fileExtension)) {
                console.log('AdInjectionSystem: Creating video ad');
                adMedia = `<video controls autoplay muted loop style="max-width: 100%; height: 400px; margin-bottom: 1rem; border-radius: 8px; background: #000;">
                    <source src="${fileUrl}" type="video/${fileExtension}">
                    Your browser does not support the video tag.
                </video>`;
            } else if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(fileExtension)) {
                console.log('AdInjectionSystem: Creating image ad');
                adMedia = `<img src="${fileUrl}" alt="${this.currentAd.title}" style="max-width: 100%; height: 400px; object-fit: cover; margin-bottom: 1rem; border-radius: 8px;">`;
            }
        } else if (this.currentAd.file) {
            // Fallback to file field
            const fileExtension = this.currentAd.file.split('.').pop().toLowerCase();
            console.log('AdInjectionSystem: File field detected:', this.currentAd.file, 'Extension:', fileExtension);
            
            if (['mp4', 'webm', 'ogg', 'avi', 'mov'].includes(fileExtension)) {
                console.log('AdInjectionSystem: Creating video ad (fallback)');
                adMedia = `<video controls autoplay muted loop style="max-width: 100%; height: 400px; margin-bottom: 1rem; border-radius: 8px; background: #000;">
                    <source src="/storage/${this.currentAd.file}" type="video/${fileExtension}">
                    Your browser does not support the video tag.
                </video>`;
            } else if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(fileExtension)) {
                console.log('AdInjectionSystem: Creating image ad (fallback)');
                adMedia = `<img src="/storage/${this.currentAd.file}" alt="${this.currentAd.title}" style="max-width: 100%; height: 400px; object-fit: cover; margin-bottom: 1rem; border-radius: 8px;">`;
            }
        }
        
        console.log('AdInjectionSystem: Generated ad media HTML:', adMedia.substring(0, 100) + '...');
        
        // Countdown timer
        const countdown = document.createElement('div');
        countdown.id = 'ad-countdown';
        countdown.style.cssText = `
            font-size: 1.5rem;
            margin: 1rem 0;
            color: #ff6b6b;
        `;
        
        // Skip button (if allowed)
        const skipButton = document.createElement('button');
        skipButton.textContent = 'Skip Ad';
        skipButton.style.cssText = `
            background: #ff6b6b;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 1rem;
        `;
        skipButton.onclick = () => this.hideAd();
        
        // Click link (if available)
        const clickLink = this.currentAd.link ? 
            `<a href="${this.currentAd.link}" target="_blank" style="color: #4ecdc4; text-decoration: none; font-size: 1.1rem;">Visit ${this.currentAd.title}</a>` : '';
        
        adContent.innerHTML = `
            ${adMedia}
            <div>${clickLink}</div>
        `;
        
        adContent.appendChild(adTitle);
        adContent.appendChild(countdown);
        adContent.appendChild(skipButton);
        
        adOverlay.appendChild(adContent);
        document.body.appendChild(adOverlay);
        
        // Add event listeners for video ads
        const videoElement = adOverlay.querySelector('video');
        if (videoElement) {
            console.log('AdInjectionSystem: Setting up video event listeners');
            
            videoElement.addEventListener('loadstart', () => {
                console.log('AdInjectionSystem: Video started loading');
            });
            
            videoElement.addEventListener('canplay', () => {
                console.log('AdInjectionSystem: Video can start playing');
                videoElement.play().catch(e => console.error('AdInjectionSystem: Video play error:', e));
            });
            
            videoElement.addEventListener('error', (e) => {
                console.error('AdInjectionSystem: Video error:', e);
            });
            
            videoElement.addEventListener('ended', () => {
                console.log('AdInjectionSystem: Video ended, restarting');
                videoElement.currentTime = 0;
                videoElement.play().catch(e => console.error('AdInjectionSystem: Video restart error:', e));
            });
        }
        
        // Start countdown
        let timeLeft = 15; // 15 seconds countdown
        countdown.textContent = `Ad will end in ${timeLeft} seconds`;
        
        const countdownInterval = setInterval(() => {
            timeLeft--;
            countdown.textContent = `Ad will end in ${timeLeft} seconds`;
            
            if (timeLeft <= 0) {
                clearInterval(countdownInterval);
                this.hideAd();
            }
        }, 1000);
        
        // Store interval for cleanup
        this.countdownInterval = countdownInterval;
    },
    
    // Hide the ad
    hideAd() {
        console.log('AdInjectionSystem: Hiding ad');
        
        // Clear countdown
        if (this.countdownInterval) {
            clearInterval(this.countdownInterval);
            this.countdownInterval = null;
        }
        
        // Pause any playing video
        const videoElement = document.querySelector('#ad-overlay video');
        if (videoElement) {
            console.log('AdInjectionSystem: Pausing video ad');
            videoElement.pause();
        }
        
        // Remove ad overlay
        const adOverlay = document.getElementById('ad-overlay');
        if (adOverlay) {
            adOverlay.remove();
        }
        
        this.isShowingAd = false;
        
        // Resume music player
        if (window.MusicPlayer && window.MusicPlayer.audio) {
            window.MusicPlayer.audio.play().catch(e => console.error('Error resuming audio:', e));
        }
        
        // Reset mid-song ad flag for next song
        this.midSongAdShown = false;
        
        // Get next ad and restart timer
        this.getRandomAd();
        if (this.showAdsDuringPlayback) {
            this.startAdTimer();
        }
    },
    
    // Get random ad
    async getRandomAd() {
        try {
            const response = await fetch('/api/ad-injection/random-ad', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            });
            
            const data = await response.json();
            
            if (data.success && data.ad) {
                this.currentAd = data.ad;
                console.log('AdInjectionSystem: Got new random ad', this.currentAd);
            }
        } catch (error) {
            console.error('AdInjectionSystem: Error getting random ad', error);
        }
    },
    
    // Destroy the ad system
    destroy() {
        if (this.adTimer) {
            clearTimeout(this.adTimer);
            this.adTimer = null;
        }
        if (this.countdownInterval) {
            clearInterval(this.countdownInterval);
            this.countdownInterval = null;
        }
        this.isEnabled = false;
        this.isShowingAd = false;
        this.currentAd = null;
        this.adContainer = null;
    }
};

document.addEventListener('DOMContentLoaded', function() {
    loadPlaylistDetails();
    initializeSearch();
    
    // Initialize Ad Injection System
    if (typeof adInjectionSystem !== 'undefined') {
        console.log('Initializing Ad Injection System...');
        adInjectionSystem.init();
        
        // Make it globally available
        window.adInjectionSystem = adInjectionSystem;
        console.log('AdInjectionSystem: Made globally available');
    }
});
</script>
@endsection
