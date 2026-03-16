// Global music player object
window.MusicPlayer = {
    // Audio element
    audio: null,

    // UI elements
    playPauseButton: null,
    playPauseIcon: null,
    progressFill: null,
    volumeFill: null,
    progressBar: null,
    volumeBar: null,
    currentTimeDisplay: null,
    totalTimeDisplay: null,
    controlTitle: null,
    controlArtist: null,
    controlCover: null,

    // State
    isPlaying: false,
    currentProgress: 0,
    currentVolume: 66,
    currentTrack: null,
    playlist: [],
    currentTrackIndex: 0,

    // Initialize the music player
    init() {
        this.audio = document.getElementById('mainAudioPlayer');
        this.playPauseButton = document.querySelector('.play-pause-button');
        this.playPauseIcon = this.playPauseButton?.querySelector('i');
        this.progressFill = document.querySelector('.progress-fill');
        this.volumeFill = document.querySelector('.volume-fill');
        this.progressBar = document.querySelector('.progress-bar');
        this.volumeBar = document.querySelector('.volume-bar');
        this.currentTimeDisplay = document.querySelector('.current-time');
        this.totalTimeDisplay = document.querySelector('.total-time');
        this.controlTitle = document.querySelector('.control-title');
        this.controlArtist = document.querySelector('.control-artist');
        this.controlCover = document.querySelector('.control-cover');

        this.setupEventListeners();
        this.updateVolume(this.currentVolume);
    },

    // Setup event listeners
    setupEventListeners() {
        if (this.playPauseButton) {
            this.playPauseButton.addEventListener('click', () => this.togglePlayback());
        }

        // Navigation buttons
        const prevButton = document.getElementById('prevButton');
        const nextButton = document.getElementById('nextButton');

        if (prevButton) {
            prevButton.addEventListener('click', () => this.previousTrack());
        }

        if (nextButton) {
            nextButton.addEventListener('click', () => this.nextTrack());
        }

        if (this.progressBar) {
            this.progressBar.addEventListener('click', (e) => this.seekTo(e));
        }

        if (this.volumeBar) {
            this.volumeBar.addEventListener('click', (e) => this.setVolume(e));
        }

        if (this.audio) {
            this.audio.addEventListener('timeupdate', () => this.updateProgress());
            this.audio.addEventListener('loadedmetadata', () => this.updateDuration());
            this.audio.addEventListener('ended', () => this.onSongEnded());
            this.audio.addEventListener('play', () => this.onPlay());
            this.audio.addEventListener('pause', () => this.onPause());
        }
    },

    // Load and play a track
    loadTrack(track) {
        if (!this.audio || !track) return;

        this.currentTrack = track;

        // Reset mid-song ad flag for new song
        if (window.adInjectionSystem) {
            window.adInjectionSystem.midSongAdShown = false;
        }

        // Check if music file exists, if not use a fallback
        const musicFile = track.music_file || track.audio_url || '';

        // Check if user has HD audio feature and use appropriate quality
        if (window.userSubscriptionFeatures && window.userSubscriptionFeatures.high_quality && musicFile) {
            // For HD audio, use the original file (could be enhanced with quality parameter)
            this.audio.src = musicFile;
            if (this.audio) {
                // Set audio quality/preload for better quality
                this.audio.preload = 'auto';
            }
        } else if (musicFile && musicFile.includes('storage/')) {
            this.audio.src = musicFile;
        } else {
            // Use a silent audio data URL as fallback
            this.audio.src = 'data:audio/wav;base64,UklGRigAAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YQAAAAA=';
        }

        // Update UI
        if (this.controlTitle) this.controlTitle.textContent = track.name || 'Unknown Title';
        if (this.controlArtist) this.controlArtist.textContent = track.artist || 'Unknown Artist';
        const controlIsrc = document.getElementById('controlISRC');
        if (controlIsrc) {
            if (track.isrc_code) {
                controlIsrc.textContent = 'ISRC: ' + track.isrc_code;
                controlIsrc.style.display = 'block';
            } else {
                controlIsrc.textContent = '';
                controlIsrc.style.display = 'none';
            }
        }
        if (this.controlCover && track.thumbnail) {
            this.controlCover.src = track.thumbnail;
        } else if (this.controlCover) {
            // Use a fallback image
            this.controlCover.src = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIiBmaWxsPSIjMTIxMjEyIi8+CjxwYXRoIGQ9Ik0xNiAxMkgxNlYyOEgxNlYxMloiIGZpbGw9IiM2NjZFRUEiLz4KPHBhdGggZD0iTTI0IDEySDI0VjI4SDI0VjEyWiIgZmlsbD0iIzY2NkVFQSIvPgo8L3N2Zz4K';
        }

        // Update playlist visual selection
        this.updatePlaylistSelection(track.id);

        // Load metadata
        this.audio.load();
    },

    // Update playlist visual selection
    updatePlaylistSelection(trackId) {
        // Remove selection from all songs in any playlist
        document.querySelectorAll('.song-item').forEach(item => {
            item.classList.remove('selected');
        });

        // Add selection to current song
        const songItem = document.querySelector(`.song-item[onclick*="playSong(${trackId})"]`);
        if (songItem) {
            songItem.classList.add('selected');
        }
    },

    // Track play for monthly analytics and royalty calculation
    async trackPlay() {
        if (!this.currentTrack || !this.currentTrack.id) {
            console.log('MusicPlayer: No current track to track play');
            return;
        }

        try {
            console.log('MusicPlayer: Tracking play for song', {
                music_id: this.currentTrack.id,
                name: this.currentTrack.name,
                artist: this.currentTrack.artist
            });

            // Track initial play (0 duration - will be updated when song ends)
            const response = await fetch('/api/monthly-plays/track', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({
                    music_id: this.currentTrack.id,
                    stream_duration: 0 // Initial play, duration will be tracked on song end
                })
            });

            console.log('MusicPlayer: API response status:', response.status);

            // Check if response is HTML instead of JSON
            const responseText = await response.text();
            console.log('MusicPlayer: Raw response (first 200 chars):', responseText.substring(0, 200));

            if (responseText.includes('<!DOCTYPE')) {
                console.error('MusicPlayer: Response is HTML, not JSON!');
                throw new Error('API returned HTML instead of JSON');
            }

            const data = JSON.parse(responseText);

            if (data.success) {
                console.log('MusicPlayer: Play tracked successfully', {
                    monthly_play_id: data.data.monthly_play_id,
                    current_plays: data.data.current_plays,
                    month: data.data.month,
                    year: data.data.year,
                    stream_logged: data.data.stream_logged
                });
            } else {
                console.warn('MusicPlayer: Failed to track play', data.message);
            }

        } catch (error) {
            console.error('MusicPlayer: Error tracking play', error);
        }
    },

    // Track complete stream when song ends (for royalty calculation)
    async trackCompleteStream() {
        if (!this.currentTrack || !this.currentTrack.id || !this.audio) {
            return;
        }

        try {
            // Get actual played duration (currentTime when song ends or full duration)
            const streamDuration = Math.floor(this.audio.currentTime || this.audio.duration || 0);

            // Track ALL streams regardless of duration (for analytics)
            // Complete streams (30+ seconds) are used for royalty calculation
            console.log('MusicPlayer: Tracking stream completion', {
                music_id: this.currentTrack.id,
                duration: streamDuration,
                is_complete: streamDuration >= 30
            });

            const response = await fetch('/api/monthly-plays/track', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({
                    music_id: this.currentTrack.id,
                    stream_duration: streamDuration
                })
            });

            if (response.ok) {
                const data = await response.json();
                if (data.success) {
                    console.log('MusicPlayer: Stream tracked successfully', {
                        stream_logged: data.data.stream_logged,
                        is_complete: streamDuration >= 30,
                        duration: streamDuration
                    });
                }
            } else {
                console.error('MusicPlayer: Failed to track stream', response.status, response.statusText);
            }
        } catch (error) {
            console.error('MusicPlayer: Error tracking complete stream', error);
        }
    },

    // Play the current track
    play() {
        if (this.audio && this.currentTrack) {
            this.audio.play().catch(e => console.error('Error playing audio:', e));

            // Track the play for monthly analytics
            this.trackPlay();

            // Start ad timer for during-playback ads
            if (window.adInjectionSystem && window.adInjectionSystem.isEnabled) {
                console.log('MusicPlayer: Starting ad timer for during-playback ads');
                window.adInjectionSystem.startAdTimer();
            } else {
                console.log('MusicPlayer: Ad system not available for during-playback ads');
            }
        }
    },

    // Pause the current track
    pause() {
        if (this.audio) {
            this.audio.pause();

            // Stop ad timer when music is paused
            if (window.adInjectionSystem && window.adInjectionSystem.adTimer) {
                console.log('MusicPlayer: Stopping ad timer - music paused');
                clearTimeout(window.adInjectionSystem.adTimer);
                window.adInjectionSystem.adTimer = null;
            } else {
                console.log('MusicPlayer: Ad system not available for pause handling');
            }
        }
    },

    // Toggle play/pause
    togglePlayback() {
        if (this.isPlaying) {
            this.pause();
        } else {
            this.play();
        }
    },

    // Set playlist
    setPlaylist(playlist, startIndex = 0) {
        this.playlist = playlist;
        this.currentTrackIndex = startIndex;
        if (playlist.length > 0) {
            this.loadTrack(playlist[startIndex]);
        }
    },

    // Play specific track from playlist
    playTrack(trackId) {
        const trackIndex = this.playlist.findIndex(track => track.id === trackId);
        if (trackIndex !== -1) {
            this.currentTrackIndex = trackIndex;
            this.loadTrack(this.playlist[trackIndex]);
            this.play();
        }
    },

    // Handle song ended event
    onSongEnded() {
        console.log('MusicPlayer: Song ended, checking for ads...');
        console.log('MusicPlayer: Ad injection system available:', !!window.adInjectionSystem);
        console.log('MusicPlayer: Ad system enabled:', window.adInjectionSystem ? window.adInjectionSystem.isEnabled : 'N/A');

        // Track complete stream for royalty calculation
        this.trackCompleteStream();

        // Wait a bit for ad system to initialize if not available
        if (!window.adInjectionSystem) {
            console.log('MusicPlayer: Ad system not available, waiting 1 second...');
            setTimeout(() => {
                this.checkAdSystemAndProceed();
            }, 1000);
            return;
        }

        this.checkAdSystemAndProceed();
    },

    // Check ad system and proceed accordingly
    checkAdSystemAndProceed() {
        // Stop any running ad timer
        if (window.adInjectionSystem && window.adInjectionSystem.adTimer) {
            clearTimeout(window.adInjectionSystem.adTimer);
            window.adInjectionSystem.adTimer = null;
        }

        // Show ad between songs if ad system is enabled
        if (window.adInjectionSystem && window.adInjectionSystem.isEnabled) {
            console.log('MusicPlayer: Ad system enabled, checking for ad availability');

            // Check if there's an ad available
            if (window.adInjectionSystem.currentAd) {
                console.log('MusicPlayer: Showing ad between songs');
                // Pause the current track before showing ad
                if (this.audio) {
                    this.audio.pause();
                }
                window.adInjectionSystem.showAdBetweenSongs();
                // The ad system will handle proceeding to next track when ad is closed
            } else {
                console.log('MusicPlayer: Ad system enabled but no ad available, proceeding to next track');
                this.nextTrack();
            }
        } else {
            console.log('MusicPlayer: No ads enabled, proceeding to next track');
            this.nextTrack();
        }
    },

    // Next track
    nextTrack() {
        if (this.currentTrackIndex < this.playlist.length - 1) {
            this.currentTrackIndex++;
            this.loadTrack(this.playlist[this.currentTrackIndex]);
            this.play();
        }
    },

    // Previous track
    previousTrack() {
        if (this.currentTrackIndex > 0) {
            this.currentTrackIndex--;
            this.loadTrack(this.playlist[this.currentTrackIndex]);
            this.play();
        }
    },

    // Seek to position
    seekTo(event) {
        if (!this.audio || !this.progressBar) return;

        const rect = this.progressBar.getBoundingClientRect();
        const clickPosition = event.clientX - rect.left;
        const percent = (clickPosition / rect.width) * 100;

        if (this.audio.duration) {
            this.audio.currentTime = (percent / 100) * this.audio.duration;
        }
    },

    // Set volume
    setVolume(event) {
        if (!this.volumeBar) return;

        const rect = this.volumeBar.getBoundingClientRect();
        const clickPosition = event.clientX - rect.left;
        const percent = (clickPosition / rect.width) * 100;

        this.updateVolume(percent);
    },

    // Update volume
    updateVolume(percent) {
        this.currentVolume = Math.max(0, Math.min(100, percent));

        if (this.volumeFill) {
            this.volumeFill.style.width = `${this.currentVolume}%`;
        }

        if (this.audio) {
            this.audio.volume = this.currentVolume / 100;
        }
    },

    // Update progress bar
    updateProgress() {
        if (!this.audio || !this.progressFill) return;

        const duration = this.audio.duration;
        const currentTime = this.audio.currentTime;

        if (duration > 0) {
            const percent = (currentTime / duration) * 100;
            this.progressFill.style.width = `${percent}%`;

            if (this.currentTimeDisplay) {
                this.currentTimeDisplay.textContent = this.formatTime(currentTime);
            }

            // Show ad at 50% progress if ad system is available
            if (window.adInjectionSystem && window.adInjectionSystem.isEnabled &&
                !window.adInjectionSystem.isShowingAd &&
                percent >= 50 && percent < 51) {
                console.log('MusicPlayer: Song reached 50% - triggering mid-song ad');
                window.adInjectionSystem.showAdAtProgress(50);
            }
        }
    },

    // Update duration display
    updateDuration() {
        if (this.audio && this.totalTimeDisplay) {
            this.totalTimeDisplay.textContent = this.formatTime(this.audio.duration);
        }
    },

    // Format time
    formatTime(seconds) {
        if (!isFinite(seconds) || seconds < 0) return '0:00';
        const minutes = Math.floor(seconds / 60);
        const remainingSeconds = Math.floor(seconds % 60);
        return `${minutes}:${remainingSeconds.toString().padStart(2, '0')}`;
    },

    // On play event
    onPlay() {
        this.isPlaying = true;
        if (this.playPauseIcon) {
            this.playPauseIcon.classList.remove('fa-play');
            this.playPauseIcon.classList.add('fa-pause');
        }
        // Show bottom music player when song starts playing
        const bottomPlayer = document.querySelector('.bottom_fixedMucicPlayer');
        if (bottomPlayer) {
            bottomPlayer.classList.remove('is-hidden');
        }
    },

    // On pause event
    onPause() {
        this.isPlaying = false;
        if (this.playPauseIcon) {
            this.playPauseIcon.classList.remove('fa-pause');
            this.playPauseIcon.classList.add('fa-play');
        }
    }
};

document.addEventListener('DOMContentLoaded', () => {
    // Initialize the music player
    window.MusicPlayer.init();

    // Legacy code for other functionality
    const navButtons = document.querySelectorAll('.nav-button');
    const viewContents = document.querySelectorAll('.view-content');

    // Legacy variables for backward compatibility
    let currentProgress = 33;
    let currentVolume = 66;

    // Dados da música atual (legacy)
    const currentTrack = {
        title: "Midnight City",
        artist: "M83",
        album: "Hurry Up, We're Dreaming",
        duration: 225,
        currentTime: 83
    };

    // Função para alternar entre visualizações
    function switchView(viewId) {
        // Remover classe 'active' de todos os botões e views
        navButtons.forEach(button => button.classList.remove('active'));
        viewContents.forEach(view => view.classList.remove('active'));

        // Adicionar classe 'active' ao botão e view correspondente
        const selectedButton = document.querySelector(`[data-view="${viewId}"]`);
        const selectedView = document.getElementById(`${viewId}-view`);

        if (selectedButton && selectedView) {
            selectedButton.classList.add('active');
            selectedView.classList.add('active');
        }
    }

    // Alternar reprodução (play/pause)
    function togglePlayback() {
        isPlaying = !isPlaying;

        if (isPlaying) {
            playPauseIcon.classList.remove('fa-play');
            playPauseIcon.classList.add('fa-pause');
            // Aqui você adicionaria lógica para iniciar a reprodução do áudio
        } else {
            playPauseIcon.classList.remove('fa-pause');
            playPauseIcon.classList.add('fa-play');
            // Aqui você adicionaria lógica para pausar a reprodução do áudio
        }
    }

    // Atualizar a barra de progresso
    function updateProgress(percent) {
        progressFill.style.width = `${percent}%`;

        // Calcular e exibir o tempo atual baseado na porcentagem
        const timeInSeconds = Math.floor((percent / 100) * currentTrack.duration);
        currentTimeDisplay.textContent = formatTime(timeInSeconds);
    }

    // Atualizar o volume
    function updateVolume(percent) {
        volumeFill.style.width = `${percent}%`;
        currentVolume = percent;
        // Aqui você adicionaria lógica para alterar o volume real do áudio
    }

    // Formatar segundos em MM:SS
    function formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        const remainingSeconds = seconds % 60;
        return `${minutes}:${remainingSeconds.toString().padStart(2, '0')}`;
    }

    // Inicializar os displays de tempo
    function initTimeDisplays() {
        const currentTimeDisplay = window.MusicPlayer?.currentTimeDisplay || document.querySelector('.current-time');
        const totalTimeDisplay = window.MusicPlayer?.totalTimeDisplay || document.querySelector('.total-time');

        if (currentTimeDisplay && currentTrack) {
            currentTimeDisplay.textContent = formatTime(currentTrack.currentTime);
        }
        if (totalTimeDisplay && currentTrack) {
            totalTimeDisplay.textContent = formatTime(currentTrack.duration);
        }
    }

    // Simular progresso da música
    function simulateProgress() {
        if (isPlaying) {
            currentProgress += 0.1;
            if (currentProgress > 100) {
                currentProgress = 0;
                togglePlayback(); // Pausa quando a música termina
            }
            updateProgress(currentProgress);
        }
    }

    // Event listeners
    navButtons.forEach(button => {
        button.addEventListener('click', () => {
            const viewId = button.getAttribute('data-view');
            switchView(viewId);
        });
    });

    // Use MusicPlayer instance if available
    if (window.MusicPlayer && window.MusicPlayer.playPauseButton) {
        // Already set up in MusicPlayer.init()
    } else {
        // Fallback for standalone playPauseButton
        const playPauseButton = document.querySelector('.play-pause-button');
        if (playPauseButton) {
            playPauseButton.addEventListener('click', togglePlayback);
        }
    }

    // Event listeners para cliques nas barras de progresso e volume
    // Use MusicPlayer instance if available
    const progressBar = window.MusicPlayer?.progressBar || document.querySelector('.progress-bar');
    const volumeBar = window.MusicPlayer?.volumeBar || document.querySelector('.volume-bar');

    if (progressBar) {
        progressBar.addEventListener('click', (e) => {
            const rect = progressBar.getBoundingClientRect();
            const clickPosition = e.clientX - rect.left;
            const percent = (clickPosition / rect.width) * 100;
            if (window.MusicPlayer) {
                window.MusicPlayer.currentProgress = percent;
                window.MusicPlayer.updateProgress(percent);
            } else {
                currentProgress = percent;
                updateProgress(percent);
            }
        });
    }

    if (volumeBar) {
        volumeBar.addEventListener('click', (e) => {
            const rect = volumeBar.getBoundingClientRect();
            const clickPosition = e.clientX - rect.left;
            const percent = (clickPosition / rect.width) * 100;
            if (window.MusicPlayer) {
                window.MusicPlayer.updateVolume(percent);
            } else {
                updateVolume(percent);
            }
        });
    }

    // Inicializar a interface
    if (typeof initTimeDisplays === 'function') {
        initTimeDisplays();
    }
    if (typeof updateProgress === 'function') {
        updateProgress(currentProgress);
    }
    if (typeof updateVolume === 'function') {
        updateVolume(currentVolume);
    }

    // Adicionar interatividade aos elementos da biblioteca de música
    const cards = document.querySelectorAll('.playlist-card, .album-card, .genre-card');
    cards.forEach(card => {
        card.addEventListener('click', () => {
            // Aqui você adicionaria lógica para carregar e iniciar uma playlist ou álbum
            console.log('Card clicado:', card);
        });
    });

    // Botões de ação para a música atual
    const actionButtons = document.querySelectorAll('.action-button');
    actionButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Aqui você adicionaria lógica para favoritar, compartilhar, etc.
            console.log('Ação:', button);
        });
    });

    // Simular progresso da música a cada 100ms quando estiver tocando
    setInterval(simulateProgress, 100);
});


// Initialize popup functionality when DOM is loaded
document.addEventListener('DOMContentLoaded', function () {
    // dots Js
    const menuButton = document.getElementById('menuButton');
    const popupOverlay = document.getElementById('popupOverlay');
    const closeButton = document.getElementById('closeButton');
    const notification = document.getElementById('notification');

    if (menuButton && popupOverlay && closeButton && notification) {
        const actions = {
            share: 'Music shared successfully!',
            save: 'Song saved to your list!',
            download: 'Download started!',
            info: 'Opening song information...'
        };

        const openPopup = () => {
            popupOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        };

        const closePopup = () => {
            popupOverlay.classList.remove('active');
            document.body.style.overflow = '';
        };

        const showNotification = (msg) => {
            notification.textContent = msg;
            notification.classList.add('show');
            setTimeout(() => notification.classList.remove('show'), 3000);
        };

        menuButton.onclick = openPopup;
        closeButton.onclick = closePopup;
        popupOverlay.onclick = (e) => e.target === popupOverlay && closePopup();
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && popupOverlay.classList.contains('active')) {
                closePopup();
            }
        });

        ['share', 'save', 'download', 'info'].forEach(id => {
            const element = document.getElementById(id + 'Option');
            if (element) {
                element.onclick = () => {
                    closePopup();
                    if (id === 'info') {
                        // Open song info modal instead of notification
                        openSongInfoModal();
                    } else if (id === 'download') {
                        // Handle download with subscription check
                        handleDownload();
                    } else {
                        showNotification(actions[id]);
                        if (id === 'share' && navigator.share) {
                            const track = window.MusicPlayer?.currentTrack;
                            navigator.share({
                                title: track?.name || 'Beautiful Song',
                                text: `Check out "${track?.name || 'this song'}" by ${track?.artist || 'Amazing Artist'}!`,
                                url: location.href
                            }).catch(() => { });
                        } else if (id === 'share') {
                            const track = window.MusicPlayer?.currentTrack;
                            navigator.clipboard.writeText(`Check out "${track?.name || 'this song'}" by ${track?.artist || 'Amazing Artist'}: ${location.href}`);
                        }
                    }
                };
            }
        });
    }

    // Song Info Modal Functions
    function openSongInfoModal() {
        const modal = document.getElementById('songInfoModal');
        if (!modal) return;

        const track = window.MusicPlayer?.currentTrack;
        if (!track) {
            alert('No song is currently playing.');
            return;
        }

        // Update modal content
        const coverImg = document.getElementById('songInfoCover');
        const titleEl = document.getElementById('songInfoTitle');
        const artistEl = document.getElementById('songInfoArtist');
        const isrcEl = document.getElementById('songInfoISRC');
        const durationEl = document.getElementById('songInfoDuration');
        const playsEl = document.getElementById('songInfoPlays');

        if (coverImg) coverImg.src = track.thumbnail || coverImg.src;
        if (titleEl) titleEl.textContent = track.name || 'Unknown Title';
        if (artistEl) artistEl.textContent = track.artist || 'Unknown Artist';

        // Display ISRC
        if (isrcEl) {
            if (track.isrc_code) {
                isrcEl.innerHTML = `<code>${track.isrc_code}</code>`;
            } else {
                isrcEl.textContent = '—';
            }
        }

        // Display duration
        if (durationEl && window.MusicPlayer?.audio) {
            const audio = window.MusicPlayer.audio;
            if (audio.duration && !isNaN(audio.duration)) {
                const minutes = Math.floor(audio.duration / 60);
                const seconds = Math.floor(audio.duration % 60);
                durationEl.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            } else {
                durationEl.textContent = '—';
            }
        }

        // Display plays/listeners
        if (playsEl) {
            playsEl.textContent = track.listeners ? number_format(track.listeners) : '—';
        }

        // Show modal
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeSongInfoModal() {
        const modal = document.getElementById('songInfoModal');
        if (modal) {
            modal.style.display = 'none';
            document.body.style.overflow = '';
        }
    }

    // Helper function for number formatting
    function number_format(num) {
        if (!num) return '0';
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    // Close modal on Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeSongInfoModal();
        }
    });

    // Make functions globally available
    window.openSongInfoModal = openSongInfoModal;
    window.closeSongInfoModal = closeSongInfoModal;

    // Download handler with subscription check
    async function handleDownload() {
        const track = window.MusicPlayer?.currentTrack;
        if (!track || !track.id) {
            showNotification('No song selected for download', 'error');
            return;
        }

        try {
            // Check download stats first
            const statsResponse = await fetch('/api/download/stats', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                }
            });

            if (statsResponse.ok) {
                const stats = await statsResponse.json();
                if (!stats.can_download) {
                    alert(stats.message || 'You have reached your download limit. Please upgrade your plan for more downloads.');
                    return;
                }
            }

            // Proceed with download - use fetch but check content-type before parsing
            const downloadUrl = `/api/download/${track.id}`;
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

            try {
                const response = await fetch(downloadUrl, {
                    method: 'GET',
                    headers: {
                        'Accept': 'audio/mpeg, application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                // Check content type to determine if it's a file or JSON error
                const contentType = response.headers.get('content-type') || '';

                if (response.ok && (contentType.includes('audio/mpeg') || contentType.includes('application/octet-stream'))) {
                    // Success - it's a binary file, create blob and download
                    const blob = await response.blob();
                    const url = window.URL.createObjectURL(blob);
                    const link = document.createElement('a');
                    link.href = url;
                    link.download = `${track.name}.mp3`;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    window.URL.revokeObjectURL(url);

                    showNotification(`Downloaded: ${track.name}`, 'success');

                    // Reload downloads if on user portal
                    if (typeof loadMyDownloads === 'function') {
                        setTimeout(() => loadMyDownloads(), 1000);
                    }
                } else {
                    // Error response - try to parse as JSON
                    const text = await response.text();
                    try {
                        const data = JSON.parse(text);
                        showNotification(data.message || 'Download failed', 'error');
                    } catch (jsonError) {
                        // If JSON parsing fails, show generic error
                        console.error('Failed to parse error response:', jsonError, 'Response text:', text.substring(0, 100));
                        showNotification('Download failed. Please try again.', 'error');
                    }
                }
            } catch (error) {
                console.error('Download error:', error);
                showNotification('Error downloading song. Please try again.', 'error');
            }
        } catch (error) {
            console.error('Download error:', error);
            showNotification('Error downloading song. Please try again.', 'error');
        }
    }

    window.handleDownload = handleDownload;
});
