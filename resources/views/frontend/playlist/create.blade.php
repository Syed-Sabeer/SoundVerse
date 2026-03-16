@extends('layouts.frontend.master')

@section('css')
<style>
    /* Override any conflicting styles */
    .playlist-create-container {
        position: relative !important;
        z-index: 1 !important;
        min-height: 100vh !important;
        background: linear-gradient(135deg, #1a0a2e 0%, #290d46 100%) !important;
        padding: 120px 20px 40px 20px !important;
        margin-top: 0 !important;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .playlist-create-wrapper {
        position: relative !important;
        z-index: 10 !important;
        max-width: 800px !important;
        margin: 0 auto !important;
        background: linear-gradient(135deg, #290d46 0%, #1a0a2e 100%) !important;
        border-radius: 20px !important;
        padding: 30px !important;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5) !important;
        border: 2px solid #9d6af5 !important;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .page-header {
        position: relative !important;
        z-index: 100 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        margin-bottom: 30px !important;
        padding-bottom: 20px !important;
        border-bottom: 1px solid rgba(139, 92, 246, 0.3) !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .page-header h1 {
        color: white !important;
        font-size: 2rem !important;
        font-weight: 700 !important;
        margin: 0 !important;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

   
    .form-section {
        padding:0;
    }
    .back-btn:hover {
        background: rgba(139, 92, 246, 0.3);
        color: white;
        text-decoration: none;
    }

    .form-section {
        position: relative !important;
        z-index: 100 !important;
        margin-bottom: 30px !important;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .form-label {
        position: relative !important;
        z-index: 100 !important;
        color: #e5d1fa !important;
        font-size: 1rem !important;
        font-weight: 600 !important;
        margin-bottom: 10px !important;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .form-input {
        position: relative !important;
        z-index: 100 !important;
        width: 100% !important;
        padding: 12px 16px !important;
        background: rgba(255, 255, 255, 0.1) !important;
        border: 1px solid rgba(139, 92, 246, 0.3) !important;
        border-radius: 8px !important;
        color: white !important;
        font-size: 1rem !important;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .form-input:focus {
        outline: none;
        border-color: #8b5cf6;
        background: rgba(255, 255, 255, 0.15);
    }

    .form-input::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    .songs-grid {
        position: relative !important;
        z-index: 100 !important;
        display: grid !important;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)) !important;
        gap: 15px !important;
        margin-top: 15px !important;
        min-height: 100px !important;
        padding: 20px !important;
        background: rgba(0, 0, 0, 0.2) !important;
        border-radius: 12px !important;
        border: 1px solid rgba(139, 92, 246, 0.2) !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .selected-song-item {
        background: rgba(139, 92, 246, 0.2);
        border: 1px solid rgba(139, 92, 246, 0.4);
        border-radius: 8px;
        padding: 12px;
        display: flex;
        align-items: center;
        gap: 12px;
        position: relative;
    }

    .selected-song-item img {
        width: 50px;
        height: 50px;
        border-radius: 6px;
        object-fit: cover;
    }

    .selected-song-info {
        flex: 1;
    }

    .selected-song-info h5 {
        color: white;
        font-size: 14px;
        font-weight: 600;
        margin: 0 0 4px 0;
    }

    .selected-song-info p {
        color: #b8a8d0;
        font-size: 12px;
        margin: 0;
    }

    .remove-song-btn {
        background: rgba(220, 53, 69, 0.3);
        border: 1px solid rgba(220, 53, 69, 0.5);
        color: #dc3545;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .remove-song-btn:hover {
        background: rgba(220, 53, 69, 0.5);
    }

    .search-result-item {
        padding: 12px;
        border: 1px solid rgba(139, 92, 246, 0.3);
        border-radius: 8px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 12px;
        background: rgba(255, 255, 255, 0.05);
        transition: all 0.3s ease;
    }

    .search-result-item:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(139, 92, 246, 0.5);
    }

    .search-result-item img {
        width: 50px;
        height: 50px;
        border-radius: 6px;
        object-fit: cover;
    }

    .search-result-info {
        flex: 1;
    }

    .search-result-info h5 {
        color: white;
        font-size: 15px;
        font-weight: 600;
        margin: 0 0 4px 0;
    }

    .search-result-info p {
        color: #b8a8d0;
        font-size: 13px;
        margin: 0;
    }

    .add-song-btn {
        background: #8b5cf6;
        color: white;
        border: none;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .add-song-btn:hover {
        background: #7c3aed;
        transform: scale(1.1);
    }

    .form-actions {
        position: relative !important;
        z-index: 100 !important;
        display: flex !important;
        gap: 15px !important;
        justify-content: flex-end !important;
        margin-top: 30px !important;
        padding-top: 20px !important;
        border-top: 1px solid rgba(139, 92, 246, 0.3) !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .btn-secondary {
        position: relative !important;
        z-index: 100 !important;
        background: rgba(255, 255, 255, 0.1) !important;
        border: 1px solid rgba(139, 92, 246, 0.3) !important;
        color: white !important;
        padding: 12px 24px !important;
        border-radius: 8px !important;
        cursor: pointer !important;
        text-decoration: none !important;
        display: inline-block !important;
        transition: all 0.3s ease !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .btn-secondary:hover {
        background: rgba(255, 255, 255, 0.2) !important;
        color: white !important;
        text-decoration: none !important;
    }

    .btn-primary {
        position: relative !important;
        z-index: 100 !important;
        background: linear-gradient(135deg, #8b5cf6, #7c3aed) !important;
        border: none !important;
        color: white !important;
        padding: 12px 24px !important;
        border-radius: 8px !important;
        cursor: pointer !important;
        font-weight: 600 !important;
        transition: all 0.3s ease !important;
        display: inline-block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #7c3aed, #6d28d9);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.4);
    }

    .btn-primary:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .selected-count {
        color: #b794f6;
        font-weight: 600;
        margin-left: 10px;
    }

    .search-loading {
        text-align: center;
        padding: 20px;
        color: #b8a8d0;
    }

    .search-no-results {
        text-align: center;
        padding: 20px;
        color: #b8a8d0;
    }

    .alert {
        position: relative !important;
        z-index: 100 !important;
        padding: 12px 16px !important;
        border-radius: 8px !important;
        margin-bottom: 20px !important;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .alert-success {
        background: rgba(34, 197, 94, 0.2) !important;
        border: 1px solid rgba(34, 197, 94, 0.5) !important;
        color: #4ade80 !important;
    }

    .alert-danger {
        background: rgba(220, 53, 69, 0.2) !important;
        border: 1px solid rgba(220, 53, 69, 0.5) !important;
        color: #f87171 !important;
    }

    /* Ensure form is visible */
    #playlistForm {
        position: relative !important;
        z-index: 100 !important;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    /* Ensure all form elements are visible */
    #playlistForm * {
        position: relative !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    /* Override any global styles that might hide content */
    body .playlist-create-container,
    body .playlist-create-wrapper,
    body .playlist-create-container {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    /* Ensure search results are visible */
    #searchResults {
        position: relative !important;
        z-index: 100 !important;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    #searchResultsGrid {
        position: relative !important;
        z-index: 100 !important;
        visibility: visible !important;
        opacity: 1 !important;
        border: 2px solid #9d6af5 !important;
    }

    #selectedSongsGrid {
        position: relative !important;
        z-index: 100 !important;
        visibility: visible !important;
        opacity: 1 !important;
        border: 2px solid #9d6af5 !important;
    }
     .back-btn {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(139, 92, 246, 0.3);
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-flex !important;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }
    @media (max-width:767px) {
    .page-header {
        flex-direction: column;
    }
    .btn-primary, .btn-secondary {
        padding: 6px 12px !important;
    }
    
    }
</style>
@endsection

@section('content')
<div class="playlist-create-container">
    <div class="playlist-create-wrapper">
        <div class="page-header">
            <h1 class="pb-4">Create New Playlist</h1>
            <a href="{{ route('user.portal') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i> Back to Portal
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
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

        <form id="playlistForm" novalidate>
            @csrf
            <div class="form-section">
                <label class="form-label">Playlist Name *</label>
                <input type="text" id="playlistName" class="form-input" placeholder="My Awesome Playlist" required>
            </div>

            <div class="form-section">
                <label class="form-label">Search Song</label>
                <input type="text" id="musicSearchInput" class="form-input" placeholder="Search Songs..." autocomplete="off">
            </div>

            <div class="form-section">
                <label class="form-label">
                    Selected Songs
                    <span class="selected-count" id="selectedCount">0 selected</span>
                </label>
                <div id="selectedSongsGrid" class="songs-grid">
                    <div style="text-align: center; color: #b8a8d0; padding: 20px; width: 100% !important;">Start typing in the search box above to find songs...</div>
                </div>
            </div>

            <div id="searchResults" style="display: none;">
                <label class="form-label">Search Results</label>
                <div id="searchResultsGrid" class="songs-grid"></div>
            </div>

            <div class="form-actions">
                <a href="{{ route('user.portal') }}" class="btn-secondary">Cancel</a>
                <button type="submit" class="btn-primary" id="submitBtn">Create Playlist</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    // Global variable for selected songs
    let selectedSongs = new Map();
    let searchTimeout = null;

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        initializeMusicSearch();
        setupFormSubmission();
    });

    function initializeMusicSearch() {
        const searchInput = document.getElementById('musicSearchInput');
        const searchResultsGrid = document.getElementById('searchResultsGrid');
        const searchResults = document.getElementById('searchResults');

        if (!searchInput) return;

        searchInput.addEventListener('input', function(e) {
            const query = e.target.value.trim();

            if (query.length < 2) {
                searchResults.style.display = 'none';
                return;
            }

            // Debounce search
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                searchMusic(query);
            }, 300);
        });
    }

    async function searchMusic(query) {
        const searchResultsGrid = document.getElementById('searchResultsGrid');
        const searchResults = document.getElementById('searchResults');

        if (!searchResultsGrid || !searchResults) return;

        searchResults.style.display = 'block';
        searchResultsGrid.innerHTML = '<div class="search-loading">Searching...</div>';

        try {
            const response = await fetch(`${window.location.origin}/api/music/search?q=${encodeURIComponent(query)}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();

            if (data.success && data.data && Array.isArray(data.data) && data.data.length > 0) {
                displaySearchResults(data.data);
            } else {
                searchResultsGrid.innerHTML = '<div class="search-no-results">No songs found. Try a different search term.</div>';
            }
        } catch (error) {
            console.error('Search error:', error);
            searchResultsGrid.innerHTML = '<div class="search-no-results">Error searching songs. Please try again.</div>';
        }
    }

    function displaySearchResults(songs) {
        const searchResultsGrid = document.getElementById('searchResultsGrid');
        
        searchResultsGrid.innerHTML = songs.map(song => {
            const escapedName = String(song.name || '').replace(/'/g, "\\'").replace(/"/g, '\\"');
            const escapedArtist = String(song.artist || 'Unknown Artist').replace(/'/g, "\\'").replace(/"/g, '\\"');
            const escapedThumbnail = String(song.thumbnail || '').replace(/'/g, "\\'").replace(/"/g, '\\"');
            const isSelected = selectedSongs.has(song.id);

            return `
                <div class="search-result-item">
                    <img src="${escapedThumbnail || '/images/default-album.png'}" alt="Cover" onerror="this.src='/images/default-album.png'">
                    <div class="search-result-info">
                        <h5>${escapedName}</h5>
                        <p>${escapedArtist}</p>
                    </div>
                    <button onclick="addSongToPlaylist(${song.id}, '${escapedName}', '${escapedArtist}', '${escapedThumbnail}')" 
                            class="add-song-btn" 
                            ${isSelected ? 'disabled style="opacity:0.5; cursor:not-allowed;"' : ''}
                            title="${isSelected ? 'Already added' : 'Add to playlist'}">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            `;
        }).join('');
    }

    function addSongToPlaylist(musicId, name, artist, thumbnail) {
        if (selectedSongs.has(musicId)) {
            alert('This song is already in the playlist');
            return;
        }

        selectedSongs.set(musicId, {
            id: musicId,
            name: name || 'Unknown Song',
            artist: artist || 'Unknown Artist',
            thumbnail: thumbnail || ''
        });

        updateSelectedSongsGrid();
        updateSelectedCount();
        
        // Clear search input
        const searchInput = document.getElementById('musicSearchInput');
        if (searchInput) {
            searchInput.value = '';
        }
        
        // Hide search results
        const searchResults = document.getElementById('searchResults');
        if (searchResults) {
            searchResults.style.display = 'none';
        }
    }

    function removeSongFromPlaylist(musicId) {
        selectedSongs.delete(musicId);
        updateSelectedSongsGrid();
        updateSelectedCount();
    }

    function updateSelectedSongsGrid() {
        const grid = document.getElementById('selectedSongsGrid');
        if (!grid) return;

        if (selectedSongs.size === 0) {
            grid.innerHTML = '<div style="text-align: center; color: #b8a8d0; padding: 20px;">No songs selected. Start typing in the search box above to find songs...</div>';
            return;
        }

        grid.innerHTML = Array.from(selectedSongs.values()).map(song => {
            const escapedName = String(song.name || '').replace(/'/g, "\\'").replace(/"/g, '\\"');
            const escapedArtist = String(song.artist || 'Unknown Artist').replace(/'/g, "\\'").replace(/"/g, '\\"');
            const escapedThumbnail = String(song.thumbnail || '').replace(/'/g, "\\'").replace(/"/g, '\\"');

            return `
                <div class="selected-song-item">
                    <img src="${escapedThumbnail || '/images/default-album.png'}" alt="Cover" onerror="this.src='/images/default-album.png'">
                    <div class="selected-song-info">
                        <h5>${escapedName}</h5>
                        <p>${escapedArtist}</p>
                    </div>
                    <button onclick="removeSongFromPlaylist(${song.id})" class="remove-song-btn" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
        }).join('');
    }

    function updateSelectedCount() {
        const countElement = document.getElementById('selectedCount');
        if (countElement) {
            countElement.textContent = `${selectedSongs.size} selected`;
        }
    }

    function setupFormSubmission() {
        const form = document.getElementById('playlistForm');
        const submitBtn = document.getElementById('submitBtn');

        if (!form || !submitBtn) return;

        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            const playlistName = document.getElementById('playlistName').value.trim();

            if (!playlistName) {
                alert('Please enter a playlist name');
                return;
            }

            if (selectedSongs.size === 0) {
                alert('Please add at least one song to the playlist');
                return;
            }

            const musicIds = Array.from(selectedSongs.keys());

            submitBtn.disabled = true;
            submitBtn.textContent = 'Creating...';

            try {
                const response = await fetch('/api/playlist/create', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        playlist_name: playlistName,
                        music_ids: musicIds
                    })
                });

                const data = await response.json();

                if (data.success) {
                    alert('Playlist created successfully!');
                    window.location.href = '{{ route("user.portal") }}';
                } else {
                    alert(data.message || 'Failed to create playlist');
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Create Playlist';
                }
            } catch (error) {
                console.error('Error creating playlist:', error);
                alert('An error occurred. Please try again.');
                submitBtn.disabled = false;
                submitBtn.textContent = 'Create Playlist';
            }
        });
    }

    // Make functions globally available
    window.addSongToPlaylist = addSongToPlaylist;
    window.removeSongFromPlaylist = removeSongFromPlaylist;
</script>
@endsection
