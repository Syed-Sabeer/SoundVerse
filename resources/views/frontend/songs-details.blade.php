@extends('layouts.frontend.master')


@section('css')
<style>
      
      .musicPlayer_detailSec {
        position:relative;
      }
        /* ============ PLAYLIST HEADER ============ */
.musicPlayer_detailSec .playlist-header {
    background: linear-gradient(180deg, #2b1256 0%, #100d10 100%);
    padding: 60px 40px 24px;
    display: flex;
    gap: 24px;
    align-items: flex-end;
}

.musicPlayer_detailSec .playlist-cover {
    width: 232px;
    height: 232px;
    box-shadow: 0 4px 60px rgba(0, 0, 0, 0.5);
    border-radius: 4px;
    overflow: hidden;
    flex-shrink: 0;
}

.musicPlayer_detailSec .playlist-cover img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.musicPlayer_detailSec .playlist-info {
    flex: 1;
}

.musicPlayer_detailSec .playlist-type {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 8px;
    letter-spacing: 1px;
}

.musicPlayer_detailSec .playlist-title {
    font-size: 72px;
    font-weight: 900;
    margin-bottom: 16px;
    line-height: 1.1;
}

.musicPlayer_detailSec .playlist-description {
    font-size: 14px;
    color: #b3b3b3;
    margin-bottom: 8px;
}

.musicPlayer_detailSec .playlist-meta {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    margin-top: 12px;
}

.musicPlayer_detailSec .spotify-logo {
    width: 24px;
    height: 24px;
    background: #1DB954;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 12px;
}

.musicPlayer_detailSec .meta-dot {
    width: 4px;
    height: 4px;
    background: #b3b3b3;
    border-radius: 50%;
}

/* ============ PLAYLIST CONTROLS ============ */
.musicPlayer_detailSec .playlist-controls {
    background: transparent;
    padding: 24px 40px;
    display: flex;
    align-items: center;
    gap: 32px;
}

.musicPlayer_detailSec .play-button {
    width: 56px;
    height: 56px;
    background: #1DB954;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.musicPlayer_detailSec .play-button:hover {
    transform: scale(1.06);
    background: #1ed760;
}

.musicPlayer_detailSec .play-icon {
    width: 0;
    height: 0;
    border-left: 18px solid #000;
    border-top: 11px solid transparent;
    border-bottom: 11px solid transparent;
    margin-left: 4px;
}

.musicPlayer_detailSec .control-btn {
    width: 32px;
    height: 32px;
    background: none;
    border: none;
    color: #b3b3b3;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: color 0.2s;
    font-size: 28px;
}

.musicPlayer_detailSec .control-btn:hover {
    color: #fff;
}

/* ============ PLAYLIST CONTENT ============ */
.musicPlayer_detailSec .playlist-content {
    padding: 0 40px 40px;
}

.musicPlayer_detailSec .list-header {
    display: flex;
    align-items: center;
    padding: 8px 16px;
    border-bottom: 1px solid #282828;
    color: #b3b3b3;
    font-size: 12px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 16px;
}

.musicPlayer_detailSec .list-view-toggle {
    margin-left: auto;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 4px 8px;
    border-radius: 4px;
    transition: background 0.2s;
}

.musicPlayer_detailSec .list-view-toggle:hover {
    background: rgba(255, 255, 255, 0.1);
}

.musicPlayer_detailSec .col-number {
    width: 40px;
    text-align: center;
}

.musicPlayer_detailSec .col-title {
    flex: 1;
}

.musicPlayer_detailSec .col-album {
    flex: 0.8;
}

.musicPlayer_detailSec .col-date {
    width: 150px;
}

.musicPlayer_detailSec .col-duration {
    width: 60px;
    text-align: right;
}

/* ============ SONG ROWS ============ */
.musicPlayer_detailSec .song-row {
    display: flex;
    align-items: center;
    padding: 8px 16px;
    border-radius: 4px;
    transition: background 0.2s;
    cursor: pointer;
    position: relative;
}

.musicPlayer_detailSec .song-row:hover {
    background: rgba(255, 255, 255, 0.1);
}

.musicPlayer_detailSec .song-row.playing {
    background: rgba(29, 185, 84, 0.1);
}

.musicPlayer_detailSec .song-number {
    width: 40px;
    text-align: center;
    color: #b3b3b3;
    font-size: 14px;
}

.musicPlayer_detailSec .song-row:hover .song-number {
    display: none;
}

.musicPlayer_detailSec .song-play-icon {
    width: 40px;
    text-align: center;
    color: #fff;
    font-size: 18px;
    display: none;
}

.musicPlayer_detailSec .song-row:hover .song-play-icon {
    display: block;
}

.musicPlayer_detailSec .song-info {
    flex: 1;
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom:0;
}

.musicPlayer_detailSec .song-thumbnail {
    width: 40px;
    height: 40px;
    border-radius: 2px;
    overflow: hidden;
    flex-shrink: 0;
}

.musicPlayer_detailSec .song-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.musicPlayer_detailSec .song-details {
    flex: 1;
    overflow: hidden;
}

.musicPlayer_detailSec .song-title {
    font-size: 16px;
    font-weight: 400;
    color: #fff;
    margin-bottom: 4px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.musicPlayer_detailSec .song-row.playing .song-title {
    color: #1DB954;
}

.musicPlayer_detailSec .song-artist {
    font-size: 14px;
    color: #b3b3b3;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.musicPlayer_detailSec .song-album {
    flex: 0.8;
    font-size: 14px;
    color: #b3b3b3;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    padding-right: 16px;
}

.musicPlayer_detailSec .song-date {
    width: 150px;
    font-size: 14px;
    color: #b3b3b3;
}

.musicPlayer_detailSec .song-duration {
    width: 60px;
    text-align: right;
    font-size: 14px;
    color: #b3b3b3;
}

.musicPlayer_detailSec .playing-indicator {
    display: none;
    width: 14px;
    height: 14px;
    margin-left: 8px;
}

.musicPlayer_detailSec .song-row.playing .playing-indicator {
    display: block;
}

.musicPlayer_detailSec .bar {
    width: 3px;
    height: 100%;
    background: #1DB954;
    display: inline-block;
    margin: 0 1px;
    animation: wave 1s infinite ease-in-out;
}

.musicPlayer_detailSec .bar:nth-child(2) {
    animation-delay: 0.1s;
}

.musicPlayer_detailSec .bar:nth-child(3) {
    animation-delay: 0.2s;
}

.musicPlayer_detailSec .bar:nth-child(4) {
    animation-delay: 0.3s;
}

@keyframes wave {
    0%, 100% { transform: scaleY(0.5); }
    50% { transform: scaleY(1); }
}

/* ============ NOW PLAYING BAR ============ */
.musicPlayer_detailSec .now-playing-bar {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    height: 90px;
    background: #181818;
    border-top: 1px solid #282828;
    display: flex;
    align-items: center;
    padding: 0 16px;
    z-index: 9999999999;
}

.musicPlayer_detailSec .now-playing-left {
    display: flex;
    align-items: center;
    gap: 12px;
    flex: 0.3;
    min-width: 180px;
}

.musicPlayer_detailSec .now-playing-thumbnail {
    width: 56px;
    height: 56px;
    border-radius: 4px;
    overflow: hidden;
    flex-shrink: 0;
}

.musicPlayer_detailSec .now-playing-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.musicPlayer_detailSec .now-playing-info {
    flex: 1;
    overflow: hidden;
}

.musicPlayer_detailSec .now-playing-title {
    font-size: 14px;
    color: #fff;
    margin-bottom: 4px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.musicPlayer_detailSec .now-playing-artist {
    font-size: 11px;
    color: #b3b3b3;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.musicPlayer_detailSec .heart-btn {
    background: none;
    border: none;
    color: #b3b3b3;
    font-size: 18px;
    cursor: pointer;
    padding: 8px;
    transition: color 0.2s;
}

.musicPlayer_detailSec .heart-btn:hover {
    color: #fff;
}

/* ============ CENTER CONTROLS ============ */
.musicPlayer_detailSec .now-playing-center {
    flex: 0.4;
    display: flex;
    flex-direction: column;
    align-items: center;
    //gap: 8px;
    max-width: 722px;
}

.musicPlayer_detailSec .playback-controls {
    display: flex;
    align-items: center;
    gap: 16px;
}

.musicPlayer_detailSec .playback-btn {
    background: none;
    border: none;
    color: #b3b3b3;
    font-size: 16px;
    cursor: pointer;
    padding: 8px;
    transition: color 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.musicPlayer_detailSec .playback-btn:hover {
    color: #fff;
}

.musicPlayer_detailSec .play-pause-btn {
    width: 32px;
    height: 32px;
    background: #fff;
    border-radius: 50%;
    color: #000;
}

.musicPlayer_detailSec .play-pause-btn:hover {
    transform: scale(1.06);
}

.musicPlayer_detailSec .pause-icon {
    width: 10px;
    height: 10px;
    border-left: 3px solid #000;
    border-right: 3px solid #000;
}

.musicPlayer_detailSec .progress-bar-container {
    display: flex;
    align-items: center;
    gap: 8px;
    width: 100%;
}

.musicPlayer_detailSec .time-label {
    font-size: 11px;
    color: #b3b3b3;
    min-width: 40px;
    text-align: center;
}

.musicPlayer_detailSec .progress-bar {
    flex: 1;
    height: 4px;
    background: #4d4d4d;
    border-radius: 2px;
    cursor: pointer;
    position: relative;
}

.musicPlayer_detailSec .progress-bar:hover {
    height: 6px;
}

.musicPlayer_detailSec .progress-fill {
    height: 100%;
    background: #1DB954;
    border-radius: 2px;
    transition: width 0.1s linear;
}

.musicPlayer_detailSec .progress-bar:hover .progress-fill {
    background: #1ed760;
}

/* ============ VOLUME ============ */
.musicPlayer_detailSec .now-playing-right {
    flex: 0.3;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 8px;
}

.musicPlayer_detailSec .volume-btn {
    background: none;
    border: none;
    color: #b3b3b3;
    font-size: 16px;
    cursor: pointer;
    padding: 8px;
    transition: color 0.2s;
}

.musicPlayer_detailSec .volume-btn:hover {
    color: #fff;
}

.musicPlayer_detailSec .volume-slider {
    width: 93px;
    flex: unset;
     height: unset; 
     background: unset; 
     border-radius:unset; 
     position: unset; 
     cursor: unset;
}

.musicPlayer_detailSec .volume-slider input[type="range"] {
    width: 100%;
    height: 4px;
    background: #4d4d4d;
    border-radius: 2px;
    outline: none;
    cursor: pointer;
}

.musicPlayer_detailSec .volume-slider input[type="range"]::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 12px;
    height: 12px;
    background: #fff;
    border-radius: 50%;
    cursor: pointer;
    opacity: 0;
    transition: opacity 0.2s;
}

.musicPlayer_detailSec .volume-slider:hover input[type="range"]::-webkit-slider-thumb {
    opacity: 1;
}

.musicPlayer_detailSec .volume-slider input[type="range"]::-moz-range-thumb {
    width: 12px;
    height: 12px;
    background: #fff;
    border-radius: 50%;
    border: none;
    cursor: pointer;
    opacity: 0;
    transition: opacity 0.2s;
}

.musicPlayer_detailSec .volume-slider:hover input[type="range"]::-moz-range-thumb {
    opacity: 1;
}

/* ============ RESPONSIVE ============ */
@media (max-width: 768px) {
    .musicPlayer_detailSec .playlist-title {
        font-size: 48px;
    }

    .musicPlayer_detailSec .playlist-header {
        padding: 75px 24px 24px;
    }

    .musicPlayer_detailSec .playlist-content {
        padding: 0 24px 24px;
    }

    .musicPlayer_detailSec .col-album,
    .musicPlayer_detailSec .song-album {
        display: none;
    }

    .musicPlayer_detailSec .col-date,
    .musicPlayer_detailSec .song-date {
        display: none;
    }

    .musicPlayer_detailSec .now-playing-right {
        display: none;
    }
}

    </style>
@endsection

@section('content')



 <section class="musicPlayer_detailSec">
    <!-- ============ PLAYLIST HEADER SECTION ============ -->
    <div class="playlist-header">
        <div class="playlist-cover">
            <img src="https://img.freepik.com/premium-photo/person-with-headphones-guitar-their-hands_1276913-11243.jpg" alt="Hollywood Hits">
        </div>

        <div class="playlist-info">
            <div class="playlist-type">Public Playlist</div>
            <h1 class="playlist-title">Hollywood Hits</h1>
            <p class="playlist-description">The biggest hits from Hollywood 🎵 Cover: Various Artists</p>

            <div class="playlist-meta">
                <div class="spotify-logo">♫</div>
                <span><strong>SingWithMe</strong></span>
                <div class="meta-dot"></div>
                <span>1,234,567 saves</span>
                <div class="meta-dot"></div>
                <span>50 songs, about 3 hr</span>
            </div>
        </div>
    </div>

    <!-- ============ PLAYLIST CONTROLS ============ -->
    <div class="playlist-controls">
        <button class="play-button" onclick="togglePlay(1)">
            <div class="play-icon"></div>
        </button>
        <button class="control-btn" title="Shuffle">⤨</button>
        <button class="control-btn" title="Add to playlist">+</button>
        <button class="control-btn" title="More options">⋯</button>
    </div>

    <!-- ============ PLAYLIST CONTENT ============ -->
    <div class="playlist-content">

        <div class="list-header">
            <div class="col-number">#</div>
            <div class="col-title">Title</div>
            <div class="col-album">Album</div>
            <div class="col-date">Date added</div>
            <div class="col-duration">Duration</div>
        </div>

        <!-- SONG ROW (REUSABLE STRUCTURE) -->
        <!-- Add unlimited using same structure -->

        <!-- Song 1 -->
        <div class="song-row"
            data-id="1"
            data-title="Shape of You"
            data-artist="Ed Sheeran"
            data-image="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=100"
            data-audio="audios/Lady_Gaga_Ft_Bruno_Mars_-_Die_With_a_Smile_Offblogmedia.com.mp3"
            onclick="togglePlay(1)">

            <div class="song-number">1</div>
            <div class="song-play-icon">▶</div>

            <div class="song-info">
                <div class="song-thumbnail">
                    <img src="/public/FrontendAssets/songs/Lady-Gaga-Die-With-a-Smile-Ft.-Bruno-Mars.webp">
                </div>
                <div class="song-details">
                    <div class="song-title">Die With a Smile</div>
                    <div class="song-artist">Lady Gaga</div>
                </div>
            </div>

            <div class="song-album">÷ (Divide)</div>
            <div class="song-date">5 days ago</div>
            <div class="song-duration">3:53</div>
        </div>


        <!-- Song 2 -->
        <div class="song-row"
            data-id="2"
            data-title="wanna be yours"
            data-artist="Arctic Monkeys"
            data-image="/public/FrontendAssets/songs/wanna be yours.jpeg"
            data-audio="/public/FrontendAssets/songs/Arctic-Monkeys-I-Wanna-Be-Yours-(RawPraise.ng).mp3"
            onclick="togglePlay(2)">

            <div class="song-number">2</div>
            <div class="song-play-icon">▶</div>

            <div class="song-info">
                <div class="song-thumbnail">
                    <img src="/public/FrontendAssets/songs/wanna be yours.jpeg">
                </div>
                <div class="song-details">
                    <div class="song-title">Wanna Be Yours</div>
                    <div class="song-artist">Arctic Monkeys</div>
                </div>
            </div>

            <div class="song-album">After Hours</div>
            <div class="song-date">5 days ago</div>
            <div class="song-duration">3:20</div>
        </div>

        <!-- Song 3 -->
        <div class="song-row"
            data-id="3"
            data-title="Anti-Hero"
            data-artist="Taylor Swift"
            data-image="https://images.unsplash.com/photo-1508700929628-666bc8bd84ea?w=100"
            data-audio="audios/anti-hero.mp3"
            onclick="togglePlay(3)">

            <div class="song-number">3</div>
            <div class="song-play-icon">▶</div>

            <div class="song-info">
                <div class="song-thumbnail">
                    <img src="/public/FrontendAssets/songs/Closer-The-Chainsmokers-500-500.jpg">
                </div>
                <div class="song-details">
                    <div class="song-title">Closer</div>
                    <div class="song-artist">Taylor Swift</div>
                </div>
            </div>

            <div class="song-album">Midnights</div>
            <div class="song-date">5 days ago</div>
            <div class="song-duration">3:20</div>
        </div>

        <!-- Add more songs as needed -->
    </div>

    <!-- ============ NOW PLAYING BAR ============ -->
    <div class="now-playing-bar">

        <!-- LEFT -->
        <div class="now-playing-left">
            <div class="now-playing-thumbnail">
                <img id="currentSongImage" src="">
            </div>

            <div class="now-playing-info">
                <div class="now-playing-title" id="currentSongTitle">Select a song</div>
                <div class="now-playing-artist" id="currentSongArtist"></div>
            </div>

            <button class="heart-btn" onclick="toggleLike()">♡</button>
        </div>

        <!-- CENTER -->
        <div class="now-playing-center">

            <div class="playback-controls">
                <button class="playback-btn" onclick="previousSong()">⏮</button>

                <button class="playback-btn play-pause-btn" onclick="togglePlayback()" id="mainPlayBtn">
                    ▶
                </button>

                <button class="playback-btn" onclick="nextSong()">⏭</button>
            </div>

            <div class="progress-bar-container">
                <span id="currentTime" class="time-label">0:00</span>
                <div class="progress-bar" onclick="seekSong(event)">
                    <div id="progressFill" class="progress-fill"></div>
                </div>
                <span id="totalTime" class="time-label">0:00</span>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="now-playing-right">
            <button class="volume-btn" onclick="toggleMute()">🔊</button>
            <div class="volume-slider">
                <input type="range" min="0" max="100" value="70" id="volumeControl" oninput="changeVolume(this.value)">
            </div>
        </div>

    </div>

    <!-- Global Audio Player -->
    <audio id="audioPlayer"></audio>
    </section>
       



        <script>
    // ==========================================================
    // GLOBAL VARIABLES
    // ==========================================================
    let currentPlaying = null;
    let isPlaying = false;
    let currentTime = 0;
    let progressInterval = null;

    const audio = new Audio(); // HTML audio object
    audio.volume = 0.7;

    // ==========================================================
    // SONG DATABASE (Local + Image + Time)
    // ==========================================================
    const songs = [
        { 
            title: "Die With a Smile",
            artist: "Lady Gaga",
            album: "÷ (Divide)",
            duration: "3:53",
            seconds: 233,
            image: "/public/FrontendAssets/songs/Lady-Gaga-Die-With-a-Smile-Ft.-Bruno-Mars.webp",
            file: "/public/FrontendAssets/songs/Lady_Gaga_Ft_Bruno_Mars_-_Die_With_a_Smile_Offblogmedia.com.mp3"
        },
        { 
            title: "Wanna Be Yours",
            artist: "Arctic Monkeys",
            album: "After Hours",
            duration: "3:20",
            seconds: 200,
            image: "/public/FrontendAssets/songs/wanna be yours.jpeg",
            file: "/public/FrontendAssets/songs/Arctic-Monkeys-I-Wanna-Be-Yours-(RawPraise.ng).mp3"
        },
        { 
            title: "Closer",
            artist: "Taylor Swift",
            album: "Future Nostalgia",
            duration: "3:23",
            seconds: 203,
            image: "/public/FrontendAssets/songs/Closer-The-Chainsmokers-500-500.jpg",
            file: "/public/FrontendAssets/songs/Closer The Chainsmokers 128 Kbps.mp3"
        },
        { 
            title: "Dandelions",
            artist: "Ruth B",
            album: "When We All Fall Asleep",
            duration: "3:14",
            seconds: 194,
            image: "/public/FrontendAssets/songs/dandelions.jpg",
            file: "/public/FrontendAssets/songs/Ruth B. - Dandelions (Lyrics).mp3"
        }
    ];

    // ==========================================================
    // PLAY / PAUSE SONG
    // ==========================================================
    function togglePlay(songNumber) {
        const rows = document.querySelectorAll(".song-row");

        // Clicking same song → toggle pause/play
        if (currentPlaying === songNumber) {
            togglePlayback();
            return;
        }

        // New song selected
        rows.forEach(r => r.classList.remove("playing"));
        rows[songNumber - 1].classList.add("playing");

        currentPlaying = songNumber;
        currentTime = 0;

        const song = songs[songNumber - 1];

        audio.src = song.file;
        audio.play();
        isPlaying = true;

        // Update UI
        document.getElementById("currentSongTitle").textContent = song.title;
        document.getElementById("currentSongArtist").textContent = song.artist;
        document.getElementById("currentSongImage").src = song.image;
        document.getElementById("totalTime").textContent = song.duration;

        startProgress();

        document.getElementById("mainPlayBtn").innerHTML = `<div class="pause-icon"></div>`;
    }

    // ==========================================================
    // PLAYBACK TOGGLE
    // ==========================================================
    function togglePlayback() {
        const playBtn = document.getElementById("mainPlayBtn");

        isPlaying = !isPlaying;

        if (isPlaying) {
            audio.play();
            playBtn.innerHTML = `<div class='pause-icon'></div>`;
            startProgress();
        } else {
            audio.pause();
            playBtn.innerHTML = `<div class='play-icon'></div>`;
            stopProgress();
        }
    }

    // ==========================================================
    // AUTO UPDATE PROGRESS
    // ==========================================================
    function startProgress() {
        stopProgress();

        progressInterval = setInterval(() => {
            document.getElementById("currentTime").textContent = formatTime(audio.currentTime);
            
            const percent = (audio.currentTime / audio.duration) * 100;
            document.getElementById("progressFill").style.width = percent + "%";

            if (audio.currentTime >= audio.duration) {
                nextSong();
            }
        }, 500);
    }

    function stopProgress() {
        if (progressInterval) {
            clearInterval(progressInterval);
            progressInterval = null;
        }
    }

    // ==========================================================
    // SEEK SONG
    // ==========================================================
    function seekSong(event) {
        const bar = event.currentTarget;
        const rect = bar.getBoundingClientRect();
        const percent = (event.clientX - rect.left) / rect.width;

        audio.currentTime = percent * audio.duration;
    }

    // ==========================================================
    // TIME FORMAT
    // ==========================================================
    function formatTime(sec) {
        if (isNaN(sec)) return "0:00";
        const m = Math.floor(sec / 60);
        const s = Math.floor(sec % 60);
        return `${m}:${s.toString().padStart(2, "0")}`;
    }

    // ==========================================================
    // NEXT / PREVIOUS
    // ==========================================================
    function nextSong() {
        if (!currentPlaying) return;
        if (currentPlaying < songs.length) {
            togglePlay(currentPlaying + 1);
        } else {
            togglePlay(1);
        }
    }

    function previousSong() {
        if (!currentPlaying) return;
        if (currentPlaying > 1) {
            togglePlay(currentPlaying - 1);
        } else {
            togglePlay(songs.length);
        }
    }

    // ==========================================================
    // VOLUME CONTROL
    // ==========================================================
    function changeVolume(val) {
        audio.volume = val / 100;
    }

    function toggleMute() {
        audio.muted = !audio.muted;
    }

    // ==========================================================
    // LIKE BUTTON
    // ==========================================================
    function toggleLike() {
        const btn = document.querySelector(".heart-btn");
        btn.textContent = btn.textContent === "♡" ? "♥" : "♡";
        btn.style.color = btn.textContent === "♥" ? "#1DB954" : "#b3b3b3";
    }

    // ==========================================================
    // ON PAGE LOAD → play first song
    // ==========================================================
    window.addEventListener("DOMContentLoaded", () => {
        togglePlay(1);
    });
</script>
     
@include('partials.frontend.newsletter')


@endsection
