<section class="bottom_fixedMucicPlayer is-hidden">
        <!-- Hidden audio element for actual playback -->
        <audio id="mainAudioPlayer" preload="metadata">
            <source src="" type="audio/mpeg">
            <source src="" type="audio/ogg">
            Your browser does not support the audio element.
        </audio>

        <div class="music-player">
            <!-- Controles do player fixados na parte inferior -->
            <div class="player-controls">
                <!-- Informações da faixa -->
                <div class="control-track-info">
                    <img src="https://img.freepik.com/free-photo/turn-page-collage_23-2149876302.jpg?t=st=1758015322~exp=1758018922~hmac=1f34868efde685f4bab0ea4dd3ba8053156fc6893e569c6612d45e75ae84330e&w=1060" alt="Pequena capa do álbum" class="control-cover">
                    <div>
                        <p class="control-title">Midnight City</p>
                        <p class="control-artist">M83</p>
                        <p class="control-isrc" id="controlISRC" style="display:none;font-size:0.7rem;color:#b794f6;margin:0;"></p>
                    </div>
                    <div class="player_dots">
                        <div class="music-player">
                            <div class="controls">
                                <div style="flex: 1;"></div>
                                <button class="menu-button" id="menuButton">
                                    <div class="dots">
                                        <div class="dot"></div>
                                        <div class="dot"></div>
                                        <div class="dot"></div>
                                    </div>
                                </button>
                            </div>
                        </div>

                        <div class="popup-overlay" id="popupOverlay">
                            <div class="popup">
                                <button class="close-button" id="closeButton">&times;</button>

                                <div class="popup-header">
                                    <div class="popup-title">Music Options</div>
                                    <div class="popup-subtitle">Choose an action</div>
                                </div>

                                <div class="popup-options">
                                    <button class="option" id="shareOption">
                                        <div class="option-icon">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8" />
                                                <polyline points="16,6 12,2 8,6" />
                                                <line x1="12" y1="2" x2="12" y2="15" />
                                            </svg>
                                        </div>
                                        <div class="option-text">
                                            <div class="option-title">Share Music</div>
                                            <div class="option-description">Share this song with friends</div>
                                        </div>
                                    </button>

                                    <button class="option" id="saveOption">
                                        <div class="option-icon">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z" />
                                            </svg>
                                        </div>
                                        <div class="option-text">
                                            <div class="option-title">Save to List</div>
                                            <div class="option-description">Add to your playlist or favorites</div>
                                        </div>
                                    </button>

                                    <button class="option" id="downloadOption">
                                        <div class="option-icon">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                                <polyline points="7,10 12,15 17,10" />
                                                <line x1="12" y1="15" x2="12" y2="3" />
                                            </svg>
                                        </div>
                                        <div class="option-text">
                                            <div class="option-title">Download</div>
                                            <div class="option-description">Save offline for later</div>
                                        </div>
                                    </button>

                                    <button class="option" id="infoOption">
                                        <div class="option-icon">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <circle cx="12" cy="12" r="10" />
                                                <path d="M12 16v-4" />
                                                <path d="M12 8h.01" />
                                            </svg>
                                        </div>
                                        <div class="option-text">
                                            <div class="option-title">Song Info</div>
                                            <div class="option-description">View details and lyrics</div>
                                        </div>
                                    </button>
                                    <a href="/tip-artist">
                                    <button class="option" id="infoOption">
                                        <div class="option-icon">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M20.8 4.6c-1.7-1.6-4.4-1.5-6 .2L12 7.6l-2.8-2.8c-1.6-1.7-4.3-1.8-6-.2-1.8 1.7-1.9 4.5-.2 6.3L12 21l9-10.1c1.7-1.8 1.6-4.6-.2-6.3z"/>
                                            </svg>

                                        </div>
                                        <div class="option-text">
                                            <div class="option-title">Artist Tip</div>
                                            <div class="option-description">View details for Artist Tip</div>
                                        </div>
                                    </button>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="notification" id="notification"></div>
                    </div>
                </div>

                <!-- Song Info Modal -->
                <div class="song-info-modal" id="songInfoModal" style="display: none;">
                    <div class="song-info-overlay" onclick="closeSongInfoModal()"></div>
                    <div class="song-info-content">
                        <button class="song-info-close" onclick="closeSongInfoModal()">&times;</button>
                        <div class="song-info-header">
                            <img id="songInfoCover" src="" alt="Album Cover" class="song-info-cover">
                            <div class="song-info-title-section">
                                <h2 id="songInfoTitle">Song Title</h2>
                                <p id="songInfoArtist">Artist Name</p>
                            </div>
                        </div>
                        <div class="song-info-body">
                            <div class="song-info-item">
                                <span class="song-info-label">ISRC Code:</span>
                                <span class="song-info-value" id="songInfoISRC">—</span>
                            </div>
                            <div class="song-info-item">
                                <span class="song-info-label">Duration:</span>
                                <span class="song-info-value" id="songInfoDuration">—</span>
                            </div>
                            <div class="song-info-item">
                                <span class="song-info-label">Plays:</span>
                                <span class="song-info-value" id="songInfoPlays">—</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Controles de reprodução -->
                <div class="playback-controls">
                    <div class="playback-buttons">
                        <button class="control-button" id="prevButton">
                            <i class="fas fa-step-backward"></i>
                        </button>
                        <button class="play-pause-button">
                            <i class="fas fa-play"></i>
                        </button>
                        <button class="control-button" id="nextButton">
                            <i class="fas fa-step-forward"></i>
                        </button>
                    </div>

                    <!-- Barra de progresso -->
                    <div class="progress-container">
                        <span class="time current-time">1:23</span>
                        <div class="progress-bar">
                            <div class="progress-fill"></div>
                        </div>
                        <span class="time total-time">3:45</span>
                    </div>
                </div>

                <!-- Controle de volume -->
                <div class="volume-control">
                    <i class="fas fa-volume-up"></i>
                    <div class="volume-bar">
                        <div class="volume-fill"></div>
                    </div>
                </div>
            </div>
        </div>
       </section>

<style>
.bottom_fixedMucicPlayer.is-hidden {
    display: none;
}

/* Song Info Modal Styles */
.song-info-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 10000;
    display: flex;
    align-items: center;
    justify-content: center;
}

.song-info-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(5px);
}

.song-info-content {
    position: relative;
    background: linear-gradient(135deg, #1a1a2e, #16213e, #0f3460);
    border-radius: 20px;
    padding: 30px;
    max-width: 500px;
    width: 90%;
    max-height: 90vh;
    overflow-y: auto;
    border: 1px solid rgba(183, 148, 246, 0.3);
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
    z-index: 10001;
}

.song-info-close {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(183, 148, 246, 0.2);
    border: none;
    color: #fff;
    font-size: 28px;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.3s;
}

.song-info-close:hover {
    background: rgba(183, 148, 246, 0.4);
}

.song-info-header {
    display: flex;
    gap: 20px;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid rgba(183, 148, 246, 0.2);
}

.song-info-cover {
    width: 120px;
    height: 120px;
    border-radius: 12px;
    object-fit: cover;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
}

.song-info-title-section {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.song-info-title-section h2 {
    color: #fff;
    font-size: 24px;
    font-weight: 700;
    margin: 0 0 10px 0;
}

.song-info-title-section p {
    color: #b8a8d0;
    font-size: 16px;
    margin: 0;
}

.song-info-body {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.song-info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px;
    background: rgba(183, 148, 246, 0.1);
    border-radius: 10px;
    border: 1px solid rgba(183, 148, 246, 0.2);
}

.song-info-label {
    color: #b8a8d0;
    font-size: 14px;
    font-weight: 600;
}

.song-info-value {
    color: #fff;
    font-size: 16px;
    font-weight: 600;
}

.song-info-value code {
    background: rgba(183, 148, 246, 0.2);
    color: #b794f6;
    padding: 4px 12px;
    border-radius: 6px;
    font-size: 14px;
    font-family: 'Courier New', monospace;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var bottomPlayer = document.querySelector('.bottom_fixedMucicPlayer');
    if (!bottomPlayer) return;

    // If MusicPlayer already exists, wrap its onPlay to reveal the bar
    if (window.MusicPlayer) {
        var originalOnPlay = window.MusicPlayer.onPlay ? window.MusicPlayer.onPlay.bind(window.MusicPlayer) : null;
        window.MusicPlayer.onPlay = function () {
            bottomPlayer.classList.remove('is-hidden');
            if (originalOnPlay) originalOnPlay();
        };
    }
});
</script>
