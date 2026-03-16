@extends('layouts.frontend.master')

@section('title', 'Songs Library')

@section('styles')

<style>
    .songs-library-container {
        padding: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .library-header {
        margin-bottom: 2rem;
        text-align: center;
        position:relative;
    }

    .library-title {
        color: white;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .library-subtitle {
        color: rgba(255, 255, 255, 0.8);
        font-size: 1.1rem;
        margin-bottom: 2rem;
    }

    .search-section {
        margin-bottom: 2rem;
        display: flex;
        justify-content: center;
        
    }

    .search-input {
        background: rgb(22 0 45) !important;
        border: 3px solid rgb(157 106 245);
        color: white;
        border-radius: 25px;
        padding: 12px 20px;
        width: 100%;
        max-width: 500px;
        font-size: 1rem;
        backdrop-filter: blur(10px);
        background-color: #1d0c2ec7;
        backdrop-filter: blur(12px);
    }

    .search-input::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .search-input:focus {
        outline: none;
        border-color: rgba(255, 255, 255, 0.4);
        box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1);
    }

    .results-meta {
        text-align: center;
        color: rgba(255, 255, 255, 0.85);
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
        min-height: 1.2rem;
    }

    .songs-container {
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background-color: #16002d;
            border: 3px solid #9d6af5;
            /* border-radius: 30px; */
            backdrop-filter: blur(12px);
    }

    .featured-scroller {
        margin: 0 auto 2rem;
        max-width: 900px;
        text-align: center;
        position:relative;
    }

    .featured-scroller h3 {
        color: white;
        font-size: 1.4rem;
        margin-bottom: 0.25rem;
        font-weight: 500;
    }

    .featured-scroller p {
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 1rem;
        font-size: 0.95rem;
    }

    .auto-scroll-wrapper {
        position: relative;
    background-color: #16002d;
    /* border: 2px solid red; */
    backdrop-filter: blur(12px);
    border-radius: 14px;
    padding: 1.25rem;
    border: 3px solid rgb(157 106 245);
    overflow: hidden;
    }

    .auto-scroll-track {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 1rem;
        transition: opacity 0.3s ease;
    }

    .auto-scroll-track--transition {
        opacity: 0;
    }

    .auto-scroll-card {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 12px;
        padding: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .auto-scroll-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
    }

    .auto-scroll-card__thumb {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        overflow: hidden;
        flex-shrink: 0;
        background: rgba(255, 255, 255, 0.08);
    }

    .auto-scroll-card__thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .auto-scroll-card__meta {
        text-align: left;
    }

    .auto-scroll-card__title {
        color: white;
        font-weight: 600;
        font-size: 0.95rem;
        margin: 0 0 0.2rem;
    }

    .auto-scroll-card__artist {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.85rem;
        margin: 0;
    }

    .auto-scroll-empty {
            color: rgb(255 255 255);
            width: 100%;
            text-align: center;
            padding: 1rem 0;
            font-weight: 500;
    }

    .songs-header {
        display: grid;
        grid-template-columns: 50px 1fr 1fr 120px 100px 120px;
        gap: 1rem;
        padding: 1rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        color: rgba(255, 255, 255, 0.7);
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .song-item {
        display: grid;
        grid-template-columns: 50px 1fr 1fr 120px 100px 120px;
        gap: 1rem;
        padding: 0.75rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        transition: all 0.2s ease;
        cursor: pointer;
        align-items: center;
    }

    .song-item:hover {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 8px;
        margin: 0 -0.5rem;
        padding: 0.75rem 0.5rem;
    }

    .song-item:hover .song-number {
        opacity: 0;
    }

    .song-item:hover .song-play-button {
        opacity: 1;
    }

    .song-number {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.875rem;
        font-weight: 500;
        text-align: center;
        transition: all 0.2s;
    }

    .song-play-button {
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: white;
        font-size: 1.2rem;
        cursor: pointer;
        opacity: 0;
        transition: all 0.2s;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    .song-play-button:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: translateY(-50%) scale(1.1);
    }

    .song-thumbnail {
        width: 40px;
        height: 40px;
        border-radius: 4px;
        object-fit: cover;
        background: rgba(255, 255, 255, 0.1);
    }

    .song-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        min-width: 0;
    }

    .song-details {
        min-width: 0;
        flex: 1;
    }

    .song-name {
        color: white;
        font-weight: 500;
        font-size: 0.95rem;
        margin: 0 0 0.25rem 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .song-artist {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.875rem;
        margin: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .song-album {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.875rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .song-date-added {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.875rem;
    }

    .song-duration {
        color: rgba(255, 255, 255, 0.7);
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
        color: rgba(255, 255, 255, 0.7);
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
        color: rgba(255, 255, 255, 0.7);
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
        border: 4px solid rgba(255, 255, 255, 0.1);
        border-left: 4px solid white;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .no-songs {
        text-align: center;
        padding: 3rem 1rem;
        color: rgba(255, 255, 255, 0.7);
    }

    .no-songs i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .no-songs h3 {
        color: white;
        margin-bottom: 0.5rem;
    }

    .song-item.selected {
        background: rgba(29, 185, 84, 0.1);
        border-left: 3px solid #1db954;
    }

    .song-item.selected .song-name {
        color: #1db954;
    }

    .load-more-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 1.5rem;
    }

    .load-more-wrapper.hidden {
        display: none;
    }

    .btn-load-more {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: 0.75rem 2rem;
        border-radius: 999px;
        font-weight: 600;
        transition: background 0.2s ease, border-color 0.2s ease;
    }

    .btn-load-more:hover:not(:disabled) {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.6);
    }

    .btn-load-more:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    /* Smooth transitions */
    .song-item * {
        transition: all 0.2s ease;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .songs-library-container {
            padding: 1rem;
        }

        .library-title {
            font-size: 2rem;
        }

        .songs-header {
            grid-template-columns: 40px 1fr 80px 60px;
            gap: 0.5rem;
            font-size: 0.75rem;
        }

        .songs-header div:nth-child(3) {
            display: none;
        }

        .song-item {
            grid-template-columns: 40px 1fr 80px 60px;
            gap: 0.5rem;
            padding: 0.5rem 0;
        }

        .song-item .song-album {
            display: none;
        }

        .song-thumbnail {
            width: 32px;
            height: 32px;
        }

        .song-name {
            font-size: 0.875rem;
        }

        .song-artist {
            font-size: 0.75rem;
        }

        .song-duration {
            font-size: 0.75rem;
        }

        .auto-scroll-card {
            flex-direction: column;
            text-align: center;
        }

        .auto-scroll-card__meta {
            text-align: center;
        }
    }
    @media (max-width: 476px) {
        .song-item {
            grid-template-columns: 22px 1fr 60px 30px;
        }
        .song-name {
            font-size: 12px;
            margin: 0;
        }
        .song-artist {
            font-size: 11px;
            margin: 0;
        }
        .song-date-added {
            font-size: 9px;
        }
    }
</style>

@endsection

@section('content')

<div class="songs-library-container">
    <!-- Library Header -->
    <div class="library-header">
        <h1 class="library-title">
            <i class="fas fa-music me-3"></i>Songs Library
        </h1>
        <p class="library-subtitle">Discover and play all available songs</p>
    </div>

    <!-- Search Section -->
    <div class="search-section">
        <input type="text" 
               id="songsSearchInput" 
               class="search-input" 
               placeholder="Search songs, artists, or albums...">
    </div>

    <p id="resultsMeta" class="results-meta"></p>

    <!-- Featured Auto-Scroller -->
    <div class="featured-scroller">
        <h3>Quick sneak peek</h3>
        <p>Auto-scrolls through 10 songs at a time so you can preview everything fast.</p>
        <div class="auto-scroll-wrapper">
            <div id="autoScrollTrack" class="auto-scroll-track">
                <div class="auto-scroll-empty">Loading songs...</div>
            </div>
        </div>
    </div>

    <!-- Songs Container -->
    <div class="songs-container">
        <!-- Songs Header -->
        <div class="songs-header">
            <div>#</div>
            <div>Title</div>
            <div>Artist</div>
            <div>Date added</div>
            <div>Duration</div>
            <div>Actions</div>
        </div>

        <!-- Songs List -->
        <div id="songsContainer">
            <div class="loading-spinner">
                <div class="spinner"></div>
            </div>
        </div>
    </div>

    <div class="load-more-wrapper hidden" id="loadMoreWrapper">
        <button type="button" id="loadMoreBtn" class="btn-load-more" onclick="loadMoreSongs()">
            Load more songs
        </button>
    </div>
</div>

<script>
let allSongs = [];
let filteredSongs = [];
let currentPage = 1;
let isLoading = false;

// Load all songs on page load
document.addEventListener('DOMContentLoaded', function() {
    loadAllSongs();
    initializeSearch();
});

// Load all songs from API
async function loadAllSongs() {
    try {
        isLoading = true;
        showLoading();
        
        console.log('Loading songs from API...');
        
        const response = await fetch('/api/music/all', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });

        console.log('Response status:', response.status);
        console.log('Response headers:', response.headers);

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        console.log('Response data:', data);
        
        if (data.success) {
            allSongs = data.data;
            filteredSongs = [...allSongs];
            console.log('Songs loaded:', allSongs.length);
            displaySongs();
        } else {
            console.error('API error:', data.message);
            showError(data.message || 'Failed to load songs');
        }
    } catch (error) {
        console.error('Error loading songs:', error);
        showError('Failed to load songs. Please try again.');
    } finally {
        isLoading = false;
    }
}

// Display songs in the list
function displaySongs() {
    const container = document.getElementById('songsContainer');
    console.log('Displaying songs, count:', filteredSongs.length);
    
    if (filteredSongs.length === 0) {
        console.log('No songs to display');
        container.innerHTML = `
            <div class="no-songs">
                <i class="fas fa-music"></i>
                <h3>No songs found</h3>
                <p>Try adjusting your search or check back later for new music.</p>
            </div>
        `;
        return;
    }

    const songsHTML = filteredSongs.map((song, index) => {
        const escapedName = song.name.replace(/'/g, "\\'").replace(/"/g, '\\"');
        const escapedArtist = song.artist.replace(/'/g, "\\'").replace(/"/g, '\\"');
        const escapedThumbnail = (song.thumbnail || '').replace(/'/g, "\\'").replace(/"/g, '\\"');
        
        return `
            <div class="song-item" onclick="playSong(${song.id}, '${escapedName}', '${escapedArtist}', '${escapedThumbnail}', '${song.music_file || ''}')">
                <div class="song-number">${index + 1}</div>
                <button class="song-play-button" onclick="event.stopPropagation(); playSong(${song.id}, '${escapedName}', '${escapedArtist}', '${escapedThumbnail}', '${song.music_file || ''}')">
                    <i class="fas fa-play"></i>
                </button>
                <div class="song-info">
                    <img src="${song.thumbnail || 'https://images.unsplash.com/photo-1614613535308-eb5fbd3d2c17?w=100&h=100&fit=crop'}" 
                         alt="Album Cover" 
                         class="song-thumbnail" 
                         onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIiBmaWxsPSJyZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMSkiLz4KPHBhdGggZD0iTTE2IDEySDE2VjI4SDE2VjEyWiIgZmlsbD0icmdiYSgyNTUsIDI1NSwgMjU1LCAwLjcpIi8+CjxwYXRoIGQ9Ik0yNCAxMkgyNFYyOEgyNFYxMloiIGZpbGw9InJnYmEoMjU1LCAyNTUsIDI1NSwgMjU1LCAwLjcpIi8+Cjwvc3ZnPgo='">
                    <div class="song-details">
                        <div class="song-name">${song.name}</div>
                        <div class="song-artist">${song.artist}</div>
                    </div>
                </div>
                <div class="song-album">${song.album || 'Artist'}</div>
                <div class="song-date-added">${formatDate(song.created_at || new Date())}</div>
                <div class="song-duration">${song.duration || '0:00'}</div>
                <div class="song-actions" onclick="event.stopPropagation()">
                    <button class="song-like-button" onclick="toggleLike(${song.id})" title="Add to favorites">
                        <i class="far fa-heart"></i>
                    </button>
                    <button class="song-more-button" onclick="showMoreOptions(${song.id})" title="More options">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                </div>
            </div>
        `;
    }).join('');

    container.innerHTML = songsHTML;
    
    // Load favorite status for all songs
    loadFavoriteStatus();
}

// Play song
function playSong(songId, name, artist, thumbnail, musicFile) {
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
        
        // Update visual selection
        updateSongSelection(songId);
    } else {
        console.error('Music player not available');
    }
}

// Update song selection visual
function updateSongSelection(songId) {
    // Remove previous selection
    document.querySelectorAll('.song-item.selected').forEach(item => {
        item.classList.remove('selected');
    });
    
    // Add selection to current song
    const songItem = document.querySelector(`[onclick*="playSong(${songId}"]`);
    if (songItem) {
        songItem.classList.add('selected');
    }
}

// Toggle like status
async function toggleLike(songId) {
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
            const button = document.querySelector(`[onclick*="toggleLike(${songId}"]`);
            const icon = button.querySelector('i');
            
            if (data.is_favorite) {
                icon.className = 'fas fa-heart';
                button.classList.add('liked');
                button.title = 'Remove from favorites';
            } else {
                icon.className = 'far fa-heart';
                button.classList.remove('liked');
                button.title = 'Add to favorites';
            }
            
            showNotification(data.message, 'success');
        } else {
            showNotification(data.message || 'Failed to update favorite status', 'error');
        }
    } catch (error) {
        console.error('Error toggling like:', error);
        showNotification('Failed to update favorite status', 'error');
    }
}

// Load favorite status for all songs
async function loadFavoriteStatus() {
    try {
        const songIds = filteredSongs.map(song => song.id);
        
        const response = await fetch('/api/favorites/check', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                music_ids: songIds
            })
        });

        const data = await response.json();
        
        if (data.success) {
            data.favorites.forEach(favorite => {
                const button = document.querySelector(`[onclick*="toggleLike(${favorite.music_id}"]`);
                if (button) {
                    const icon = button.querySelector('i');
                    if (favorite.is_favorite) {
                        icon.className = 'fas fa-heart';
                        button.classList.add('liked');
                        button.title = 'Remove from favorites';
                    } else {
                        icon.className = 'far fa-heart';
                        button.classList.remove('liked');
                        button.title = 'Add to favorites';
                    }
                }
            });
        }
    } catch (error) {
        console.error('Error loading favorite status:', error);
    }
}

// Show more options
function showMoreOptions(songId) {
    // This could open a dropdown menu with options like:
    // - Add to playlist
    // - Download
    // - Share
    // - View details
    console.log('Show more options for song:', songId);
}

// Initialize search functionality
function initializeSearch() {
    const searchInput = document.getElementById('songsSearchInput');
    
    if (searchInput) {
        let searchTimeout;
        
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                searchSongs(this.value);
            }, 300);
        });
    }
}

// Search songs
function searchSongs(query) {
    if (!query.trim()) {
        filteredSongs = [...allSongs];
    } else {
        const searchTerm = query.toLowerCase();
        filteredSongs = allSongs.filter(song => 
            song.name.toLowerCase().includes(searchTerm) ||
            song.artist.toLowerCase().includes(searchTerm) ||
            (song.album && song.album.toLowerCase().includes(searchTerm))
        );
    }
    
    displaySongs();
}

// Show loading state
function showLoading() {
    const container = document.getElementById('songsContainer');
    container.innerHTML = `
        <div class="loading-spinner">
            <div class="spinner"></div>
        </div>
    `;
}

// Show error state
function showError(message) {
    const container = document.getElementById('songsContainer');
    container.innerHTML = `
        <div class="no-songs">
            <i class="fas fa-exclamation-triangle"></i>
            <h3>Error</h3>
            <p>${message}</p>
        </div>
    `;
}

// Format date
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', { 
        year: 'numeric', 
        month: 'short', 
        day: 'numeric' 
    });
}

// Show notification
function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `alert alert-${type === 'error' ? 'danger' : type} alert-dismissible fade show position-fixed`;
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
</script>
@endsection