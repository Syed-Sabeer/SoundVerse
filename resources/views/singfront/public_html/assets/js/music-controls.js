document.addEventListener('DOMContentLoaded', function () {
    const next = document.querySelector('#next');
    const play = document.querySelector('#play');
    const singlealbumsplay = document.querySelector('.music-controls-single-albums .music-controls-item');
    const prev = document.querySelector('#prev');
    const progressBar = document.querySelector('#progress-bar');
    const musicTitle = document.querySelector('.music-name');
    const musicCard = document.querySelector('.music-card');
    const musicArtist = document.querySelector('.music-artist');
    const musicCover = document.querySelector('.music-image');
    const musicCurrentTime = document.querySelector('.music-current-time');
    const musicDurationTime = document.querySelector('.music-duration-time');
    const music = document.querySelector('audio');
    const progressZone = document.querySelector('.music-progress');

    let isPlaying = false;
    let selectedMusic = 0;

    const playList = [
        { artist: 'nick karvounis', cover: './assets/images/nick-karvounis.jpg', musicName: 'Frau Power', musicPath: './assets/songs/Frau-Power.mp3' },
        { artist: 'austin neill', cover: './assets/images/austin-neill.jpg', musicName: 'Broken Song', musicPath: './assets/songs/Broken-Song.mp3' },
        { artist: 'joshua fuller', cover: './assets/images/joshua-fuller.jpg', musicName: 'Blue Ghost', musicPath: './assets/songs/Blue-Ghost.mp3' },
        { artist: 'slim emcee', cover: './assets/images/slim-emcee.jpg', musicName: 'Altered Song', musicPath: './assets/songs/Altered-Song.mp3' },
        { artist: 'felipe portella', cover: './assets/images/felipe-portella.jpg', musicName: 'Paranoia Overflow', musicPath: './assets/songs/Paranoia-Overflow.mp3' },
        { artist: 'minh pham', cover: './assets/images/minh-pham.jpg', musicName: 'Black Hole', musicPath: './assets/songs/Black-Hole-Sun.mp3' }
    ];

    const playMusic = () => {
        if (!music) return;
        music.play();
        const icon = document.querySelector('.play-icon');
        if (icon) icon.classList.replace('fa-play', 'fa-pause');
        isPlaying = true;
        fadeInCover();
        if (musicCard) {
            musicCard.classList.add('middle-weight');
            setTimeout(() => musicCard.classList.remove('middle-weight'), 200);
        }
    };

    const pauseMusic = () => {
        if (!music) return;
        music.pause();
        const icon = document.querySelector('.play-icon');
        if (icon) icon.classList.replace('fa-pause', 'fa-play');
        isPlaying = false;
        if (musicCard) {
            musicCard.classList.add('middle-weight');
            setTimeout(() => musicCard.classList.remove('middle-weight'), 200);
        }
    };

    const loadMusic = (track) => {
        if (!track) return;
        musicArtist.textContent = track.artist;
        musicTitle.textContent = track.musicName;
        music.src = track.musicPath;
        musicCover.src = track.cover;
    };

    const singleloadMusic = loadMusic;

    const nextMusic = () => {
        selectedMusic = (selectedMusic + 1) % playList.length;
        loadMusic(playList[selectedMusic]);
        if (isPlaying) music.play();
        if (musicCard) {
            musicCard.classList.add('right-weight');
            setTimeout(() => musicCard.classList.remove('right-weight'), 200);
        }
        progressBar.style.width = '0%';
    };

    const prevMusic = () => {
        selectedMusic = (selectedMusic - 1 + playList.length) % playList.length;
        loadMusic(playList[selectedMusic]);
        if (isPlaying) music.play();
        if (musicCard) {
            musicCard.classList.add('left-weight');
            setTimeout(() => musicCard.classList.remove('left-weight'), 200);
        }
        progressBar.style.width = '0%';
    };

    const updateProgress = (e) => {
        const { duration, currentTime } = e.srcElement;
        const progressPercent = (currentTime / duration) * 100;
        progressBar.style.width = `${progressPercent}%`;
        if (progressPercent >= 100) {
            setTimeout(nextMusic, 500);
        }
    };

    const setProgress = (e) => {
        const width = progressZone.clientWidth;
        const setPoint = e.offsetX;
        const duration = music.duration;
        music.currentTime = (setPoint / width) * duration;
    };

    const setMusicTime = (e) => {
        const { duration, currentTime } = e.srcElement;
        calcSongTime(duration, musicDurationTime);
        calcSongTime(currentTime, musicCurrentTime);
    };

    const calcSongTime = (time, selectTime) => {
        const m = Math.floor(time / 60);
        const s = Math.floor(time % 60);
        selectTime.textContent = `${m < 10 ? '0' + m : m}:${s < 10 ? '0' + s : s}`;
    };

    const fadeInCover = () => {
        musicCover.classList.add('animate');
        setTimeout(() => musicCover.classList.remove('animate'), 300);
    };

    if (play) {
        play.addEventListener('click', () => isPlaying ? pauseMusic() : playMusic());
    }

    if (next) next.addEventListener('click', nextMusic);
    if (prev) prev.addEventListener('click', prevMusic);
    if (music) {
        music.addEventListener('timeupdate', updateProgress);
        music.addEventListener('timeupdate', setMusicTime);
    }
    if (progressZone) progressZone.addEventListener('click', setProgress);

    // jQuery Event Binding (unchanged logic)
    // You can paste all jQuery `on("click")` handlers here — no syntax issues found in them
});

// jQuery(".music-list-box").on("click", ".pause_btn", function() {



//     jQuery(this).find("i").addClass('fa-play');
//     jQuery(this).find("i").removeClass('fa-pause');
//     jQuery(this).addClass('play_btn');
//     jQuery(this).removeClass('pause_btn');
//     console.log("click event");
//     pauseMusic();
// });







// about music script 
class MusicPlayer {
    constructor() {
        this.isPlaying = false;
        this.currentTrack = 0;
        this.currentTime = 0;
        this.isLiked = false;
        this.progressInterval = null;

        this.tracks = [
            {
                title: "Give Me Some",
                artist: "Major Powell",
                duration: 352,
                cover: "/assets/images/singWithMe/Ceo-singwithme.jpeg",
                src: "/assets/songs/powelsong.aac"
            },
            {
                title: "Music Give Me",
                artist: "Major Powell",
                duration: 351,
                cover: "/assets/images/singWithMe/ceo-singwithme-3.jpeg",
                src: "/assets/songs/majorsong.aac"
            },
            // {
            //     title: "Don't Cry",
            //     artist: "Use Your Illusion 1",
            //     duration: 284,
            //     cover: "https://images.unsplash.com/photo-1571330735066-03aaa9429d89?w=120&h=120&fit=crop&crop=center",
            //     src: "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-2.mp3"
            // }
        ];

        this.initializeElements();
        this.bindEvents();
        this.updateDisplay();
    }

    initializeElements() {
        this.player = document.getElementById('musicPlayer');
        this.audio = document.getElementById('audioPlayer');
        this.playBtn = document.getElementById('playBtn');
        this.prevBtn = document.getElementById('prevBtn');
        this.nextBtn = document.getElementById('nextBtn');
        this.likeBtn = document.getElementById('likeBtn');
        this.progressContainer = document.getElementById('progressContainer');
        this.progressBar = document.getElementById('progressBar');
        this.currentTimeEl = document.getElementById('currentTime');
        this.totalTimeEl = document.getElementById('totalTime');
        this.songTitle = document.getElementById('songTitle');
        this.artistName = document.getElementById('artistName');
        this.albumCover = document.getElementById('albumCover');
        // this.playIcon = this.playBtn.querySelector('.play-icon');
        this.playIcon = this.playBtn.querySelector('.play-icon');
        this.pauseIcon = this.playBtn.querySelector('.pause-icon');

        this.audio.addEventListener('ended', () => this.nextTrack());
    }

    bindEvents() {
        this.playBtn.addEventListener('click', () => this.togglePlay());
        this.prevBtn.addEventListener('click', () => this.previousTrack());
        this.nextBtn.addEventListener('click', () => this.nextTrack());
        this.likeBtn.addEventListener('click', () => this.toggleLike());
        this.progressContainer.addEventListener('click', (e) => this.seekTo(e));
    }

    togglePlay() {
        if (this.audio.paused) {
            this.audio.play();
            this.player.classList.add('playing');
            this.playIcon.style.display = 'none';
            this.pauseIcon.style.display = 'inline';
            this.startProgress();
        } else {
            this.audio.pause();
            this.player.classList.remove('playing');
            this.playIcon.style.display = 'inline';
            this.pauseIcon.style.display = 'none';
            this.stopProgress();
        }
    }

    startProgress() {
        this.stopProgress();
        this.progressInterval = setInterval(() => {
            this.currentTime = this.audio.currentTime;
            this.updateProgress();
        }, 1000);
    }

    stopProgress() {
        if (this.progressInterval) {
            clearInterval(this.progressInterval);
            this.progressInterval = null;
        }
    }

    previousTrack() {
        this.stopProgress();
        this.currentTrack = (this.currentTrack - 1 + this.tracks.length) % this.tracks.length;
        this.updateDisplay();
        if (!this.audio.paused) {
            this.audio.play();
            this.startProgress();
        }
    }

    nextTrack() {
        this.stopProgress();
        this.currentTrack = (this.currentTrack + 1) % this.tracks.length;
        this.updateDisplay();
        if (!this.audio.paused) {
            this.audio.play();
            this.startProgress();
        }
    }

    toggleLike() {
        this.isLiked = !this.isLiked;
        this.likeBtn.classList.toggle('liked', this.isLiked);
    }

    seekTo(e) {
        const rect = this.progressContainer.getBoundingClientRect();
        const clickX = e.clientX - rect.left;
        const percentage = clickX / rect.width;
        this.audio.currentTime = percentage * this.audio.duration;
        this.updateProgress();
    }

    updateDisplay() {
        const track = this.tracks[this.currentTrack];
        this.songTitle.textContent = track.title;
        this.artistName.textContent = track.artist;
        this.albumCover.innerHTML = `<img src="${track.cover}" alt="${track.title}" onerror="this.style.display='none'; this.parentElement.style.background='linear-gradient(135deg, #ff6b6b, #4ecdc4)'; this.parentElement.innerHTML='♪';">`;
        this.audio.src = track.src;
        this.audio.currentTime = 0;
        this.totalTimeEl.textContent = this.formatTime(track.duration);
        this.updateProgress();

        // Reset icons to play mode
        this.playIcon.style.display = 'inline';
        this.pauseIcon.style.display = 'none';
    }

    updateProgress() {
        const percentage = (this.audio.currentTime / this.audio.duration) * 100;
        this.progressBar.style.width = `${percentage}%`;
        this.currentTimeEl.textContent = this.formatTime(this.audio.currentTime);
    }

    formatTime(seconds) {
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${mins}:${secs.toString().padStart(2, '0')}`;
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new MusicPlayer();
});
// about music script 