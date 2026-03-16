@extends('layouts.frontend.master')

@section('css')
<style>
    .favorites-detail-container {
        min-height: 100vh;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 20px 0;
    }

    .favorites-header {
        background: #16002d !important;
         border: 3px solid #9f54f5 !important;
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 30px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .favorites-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .favorites-subtitle {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 20px;
    }

    .favorites-stats {
        display: flex;
        gap: 30px;
        flex-wrap: wrap;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        display: block;
    }

    .stat-label {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.7);
        margin-top: 5px;
    }

    .songs-container {
        background: #16002d !important;
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 20px;
        border: 3px solid rgb(159 84 245);
    }

    .songs-header {
        display: grid;
        grid-template-columns: 40px 1fr 1fr 100px 60px 120px;
        gap: 15px;
        padding: 15px 20px;
        background: #9d6af5;
        border-radius: 10px;
        margin-bottom: 15px;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .song-item {
        display: grid;
        grid-template-columns: 40px 1fr 1fr 100px 60px 120px;
        gap: 15px;
        padding: 15px 20px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
        margin-bottom: 10px;
        transition: all 0.3s ease;
        cursor: pointer;
        align-items: center;
    }

    .song-item:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: translateX(5px);
    }

    .song-number {
        color: rgba(255, 255, 255, 0.6);
        font-weight: 500;
        text-align: center;
    }

    .song-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .song-thumbnail {
        width: 40px;
        height: 40px;
        border-radius: 6px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .song-details h4 {
        color: white;
        font-size: 1rem;
        font-weight: 600;
        margin: 0 0 4px 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .song-details p {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
        margin: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .song-artist {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .song-duration {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.9rem;
        text-align: center;
    }

    .song-added {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.8rem;
        text-align: center;
        font-style: italic;
    }

    .song-actions {
        display: flex;
        gap: 8px;
        align-items: center;
        justify-content: flex-end;
        height: 100%;
    }

    .song-actions .btn {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 12px;
        padding: 0;
    }

    .song-like-button {
        background: #e74c3c;
        color: white;
    }

    .song-like-button:hover {
        background: #c0392b;
        transform: scale(1.1);
    }

    .song-like-button.liked {
        background: #e74c3c;
    }

    .song-more-button {
        background: rgba(255, 255, 255, 0.2);
        color: white;
    }

    .song-more-button:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: scale(1.1);
    }

    .play-button {
        background: #1db954;
        color: white;
        width: 40px;
        height: 40px;
        font-size: 14px;
    }

    .play-button:hover {
        background: #1ed760;
        transform: scale(1.1);
    }

    .no-songs {
        text-align: center;
        padding: 60px 20px;
        color: rgba(255, 255, 255, 0.7);
    }

    .no-songs i {
        font-size: 1rem;
        margin-bottom: 0;
        opacity: 0.5;
    }

    .no-songs h3 {
        color: white;
        margin-bottom: 10px;
    }

    .no-songs p {
        margin-bottom: 30px;
    }

    .loading-spinner {
        text-align: center;
        padding: 40px;
        color: rgba(255, 255, 255, 0.7);
    }

    .spinner {
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-top: 3px solid white;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
        margin: 0 auto;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 30px;
    }

    .pagination {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .pagination button {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .pagination button:hover:not(:disabled) {
        background: rgba(255, 255, 255, 0.2);
    }

    .pagination button:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .pagination .current-page {
        background: rgba(255, 255, 255, 0.2);
        font-weight: 600;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .favorites-title {
            font-size: 2rem;
            flex-direction: column;
            text-align: center;
        }

        .favorites-stats {
            justify-content: center;
        }

        .songs-header,
        .song-item {
                    gap: 10px;
                padding: 12px 15px;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
        }

        .song-artist,
        .song-added {
            display: none;
        }

        .song-actions {
            gap: 4px;
        }

        .song-actions .btn {
            width: 28px;
            height: 28px;
            font-size: 10px;
        }

        .play-button {
            width: 32px;
            height: 32px;
            font-size: 12px;
        }
    }
</style>
@endsection

@section('content')
<div class="favorites-detail-container">
    <div class="container">
        <!-- Header Section -->
        <div class="favorites-header">
            <h1 class="favorites-title">
                <i class="fas fa-heart"></i>
                My Favorite Songs
            </h1>
            <p class="favorites-subtitle">All your favorite songs in one place</p>
            
            <div class="favorites-stats">
                <div class="stat-item">
                    <span class="stat-number" id="totalSongs">0</span>
                    <div class="stat-label">Total Songs</div>
                </div>
                <div class="stat-item">
                    <span class="stat-number" id="totalDuration">0:00</span>
                    <div class="stat-label">Total Duration</div>
                </div>
                <div class="stat-item">
                    <span class="stat-number" id="totalArtists">0</span>
                    <div class="stat-label">Unique Artists</div>
                </div>
            </div>
        </div>

        <!-- Songs Container -->
        <div class="songs-container">
            <div class="songs-header">
                <div>#</div>
                <div>Title</div>
                <div>Artist</div>
                <div>Duration</div>
                <div>Added</div>
                <div>Actions</div>
            </div>

            <div id="songsList">
                <div class="loading-spinner">
                    <div class="spinner"></div>
                    <p>Loading your favorite songs...</p>
                </div>
            </div>

            <div class="pagination-container" id="paginationContainer" style="display: none;">
                <div class="pagination" id="pagination"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
let currentPage = 1;
let totalPages = 1;
let allSongs = [];

// Load favorites on page load
document.addEventListener('DOMContentLoaded', function() {
    loadFavorites();
});

// Load favorites with pagination
async function loadFavorites(page = 1) {
    try {
        const response = await fetch(`/api/favorites?page=${page}&per_page=20`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            allSongs = data.data;
            currentPage = data.pagination.current_page;
            totalPages = data.pagination.last_page;
            
            displaySongs(data.data);
            updateStats(data.data);
            updatePagination();
        } else {
            showError('Failed to load favorites: ' + data.message);
        }
    } catch (error) {
        console.error('Error loading favorites:', error);
        showError('Error loading favorites. Please try again.');
    }
}

// Display songs in the list
function displaySongs(songs) {
    const container = document.getElementById('songsList');
    
    if (songs.length === 0) {
        container.innerHTML = `
            <div class="no-songs">
                <i class="fas fa-heart"></i>
                <h3>No favorite songs yet</h3>
                <p>Start adding songs to your favorites to see them here!</p>
                <button class="btn btn-primary" onclick="window.location.href='/songs-library'">
                    <i class="fas fa-plus me-2"></i>Browse Songs
                </button>
            </div>
        `;
        return;
    }

    container.innerHTML = songs.map((song, index) => {
        const escapedISRC = song.isrc_code ? song.isrc_code.replace(/'/g, "\\'") : '';
        return `
        <div class="song-item" onclick="playSong(${song.id}, '${song.name.replace(/'/g, "\\'")}', '${song.artist.replace(/'/g, "\\'")}', '${song.thumbnail}', '${song.music_file}', '${escapedISRC}')">
            <div class="song-number">${((currentPage - 1) * 20) + index + 1}</div>
            <div class="song-info">
                <img src="${song.thumbnail || 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0xNiAxMkgxNlYyOEgxNlYxMloiIGZpbGw9IiM5Q0EzQUYiLz4KPHBhdGggZD0iTTI0IDEySDI0VjI4SDI0VjEyWiIgZmlsbD0iIzlDQTNBRiIvPgo8L3N2Zz4K'}" 
                     alt="Album Cover" 
                     class="song-thumbnail" 
                     onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0xNiAxMkgxNlYyOEgxNlYxMloiIGZpbGw9IiM5Q0EzQUYiLz4KPHBhdGggZD0iTTI0IDEySDI0VjI4SDI0VjEyWiIgZmlsbD0iIzlDQTNBRiIvPgo8L3N2Zz4K'">
                <div class="song-details">
                    <h4>${song.name}</h4>
                    <p>${song.artist}</p>
                </div>
            </div>
            <div class="song-artist">${song.artist}</div>
            <div class="song-duration">${song.duration || '0:00'}</div>
            <div class="song-added">${formatDate(song.added_at)}</div>
            <div class="song-actions" onclick="event.stopPropagation()">
                <button class="btn play-button" onclick="playSong(${song.id}, '${song.name.replace(/'/g, "\\'")}', '${song.artist.replace(/'/g, "\\'")}', '${song.thumbnail}', '${song.music_file}', '${escapedISRC}')" title="Play song">
                    <i class="fas fa-play"></i>
                </button>
                <button class="btn song-like-button liked" onclick="removeFromFavorites(${song.id})" title="Remove from favorites">
                    <i class="fas fa-heart"></i>
                </button>
                <button class="btn song-more-button" onclick="showSongOptions(${song.id})" title="More options">
                    <i class="fas fa-ellipsis-h"></i>
                </button>
            </div>
        </div>
    `;
    }).join('');
}

// Update statistics
function updateStats(songs) {
    const totalSongs = songs.length;
    const totalDuration = calculateTotalDuration(songs);
    const uniqueArtists = new Set(songs.map(song => song.artist)).size;
    
    document.getElementById('totalSongs').textContent = totalSongs;
    document.getElementById('totalDuration').textContent = totalDuration;
    document.getElementById('totalArtists').textContent = uniqueArtists;
}

// Calculate total duration
function calculateTotalDuration(songs) {
    let totalSeconds = 0;
    songs.forEach(song => {
        if (song.duration) {
            const parts = song.duration.split(':');
            if (parts.length === 2) {
                totalSeconds += parseInt(parts[0]) * 60 + parseInt(parts[1]);
            }
        }
    });
    
    const hours = Math.floor(totalSeconds / 3600);
    const minutes = Math.floor((totalSeconds % 3600) / 60);
    
    if (hours > 0) {
        return `${hours}h ${minutes}m`;
    } else {
        return `${minutes}m`;
    }
}

// Update pagination
function updatePagination() {
    const container = document.getElementById('paginationContainer');
    const pagination = document.getElementById('pagination');
    
    if (totalPages <= 1) {
        container.style.display = 'none';
        return;
    }
    
    container.style.display = 'flex';
    
    let paginationHTML = '';
    
    // Previous button
    paginationHTML += `
        <button onclick="loadFavorites(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''}>
            <i class="fas fa-chevron-left"></i>
        </button>
    `;
    
    // Page numbers
    const startPage = Math.max(1, currentPage - 2);
    const endPage = Math.min(totalPages, currentPage + 2);
    
    for (let i = startPage; i <= endPage; i++) {
        paginationHTML += `
            <button class="${i === currentPage ? 'current-page' : ''}" onclick="loadFavorites(${i})">
                ${i}
            </button>
        `;
    }
    
    // Next button
    paginationHTML += `
        <button onclick="loadFavorites(${currentPage + 1})" ${currentPage === totalPages ? 'disabled' : ''}>
            <i class="fas fa-chevron-right"></i>
        </button>
    `;
    
    pagination.innerHTML = paginationHTML;
}

// Play song
function playSong(songId, name, artist, thumbnail, musicFile, isrcCode = null) {
    console.log('Playing song:', { songId, name, artist, thumbnail, musicFile, isrcCode });
    
    if (window.MusicPlayer) {
        const track = {
            id: songId,
            name: name,
            artist: artist,
            thumbnail: thumbnail,
            music_file: musicFile,
            isrc_code: isrcCode || null // Include ISRC if provided
        };
        
        window.MusicPlayer.loadTrack(track);
        window.MusicPlayer.play();
    }
}

// Remove from favorites
async function removeFromFavorites(songId) {
    try {
        const response = await fetch('/api/favorites/remove', {
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
            showNotification('Song removed from favorites', 'success');
            loadFavorites(currentPage); // Reload current page
        } else {
            showNotification('Error removing song: ' + data.message, 'error');
        }
    } catch (error) {
        console.error('Error removing from favorites:', error);
        showNotification('Error removing song from favorites', 'error');
    }
}

// Show song options
function showSongOptions(songId) {
    // You can implement a dropdown menu here
    console.log('Show options for song:', songId);
}

// Format date helper
function formatDate(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const diffTime = Math.abs(now - date);
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
    
    if (diffDays === 1) {
        return 'yesterday';
    } else if (diffDays < 7) {
        return `${diffDays} days ago`;
    } else if (diffDays < 30) {
        const weeks = Math.floor(diffDays / 7);
        return `${weeks} week${weeks > 1 ? 's' : ''} ago`;
    } else {
        return date.toLocaleDateString();
    }
}

// Show error message
function showError(message) {
    const container = document.getElementById('songsList');
    container.innerHTML = `
        <div class="no-songs">
            <i class="fas fa-exclamation-triangle"></i>
            <h3>Error Loading Favorites</h3>
            <p>${message}</p>
            <button class="btn btn-primary" onclick="loadFavorites()">Try Again</button>
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
</script>
@endsection
