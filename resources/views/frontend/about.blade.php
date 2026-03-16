@extends('layouts.frontend.master')


@section('css')
@endsection

@section('content')


       <!-- Start of Main Banner -->
       <section class="hero_about">
            <div class="about-child">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Who We Are – SingWithMe Records Ltd</h2>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <!-- End of Main Banner -->

       
          <!-- about-sec -->
          <section class="secAbout">
            <!-- Floating elements for ambient animation -->
            <div class="parent-about">
                <div class="about-me">
                    <div class="floating-element"></div>
                    <div class="floating-element"></div>
                    <div class="floating-element"></div>

                    <div class="container">
                        <h1 class="title wow left-animation" data-wow-duration="0.8s" data-wow-delay="0.3s">
                            <div class='main mx-auto'>
                                <h2 class="first"> ABOUT US</h2>
                                <h2 class="second">ABOUT US</h2>
                            </div>
                        </h1>
                        <div class="music-vectors">
                              <img src="{{asset('FrontendAssets/images/singWithMe/music-2.png')}}" alt="">
                        </div>
                        <div class="content-grid">
                            <!-- First row -->
                            <div class="image-container delay-1">
                                <div class="image-1 wow left-animation" data-wow-duration="0.8s" data-wow-delay="0.3s">
                                    <img src="{{asset('storage/'.$about_details->about_image_1)}}" alt="Professional portrait">
                                </div>
                            </div>

                            <div class="text-section delay-2 wow right-animation" data-wow-duration="0.8s"
                                data-wow-delay="0.2s">
                                <div class="highlight-text">{{$about_details->about_heading}}</div>
                                <div class="text-content">{{$about_details->about_description_1}}
                                </div>
                               {{-- <a href="{{$about_details->about_button_link}}" class="sec-btn" title="view more">view more</a>--}}
                            </div>

                            <!-- Second row -->
                            <div class="text-section delay-3">
                                <div class="text-content">{{$about_details->about_description_2}}
                                </div>
                               
                            </div>

                            <div class="image-container delay-2">
                                <div class="image-2">
                                    <img src="{{asset('storage/'.$about_details->about_image_2)}}" alt="Casual portrait">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about-sec -->

        <!-- Start Of Music Controls -->
        <div class="lyrics-box" id="songs">
            <div class="lyrics-child">

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="song-Box">
                                <p>Play. Share. Repeat.</p>
                                <div>
                                    <lord-icon src="https://cdn.lordicon.com/cqefxcni.json" trigger="loop" delay="2000"
                                        colors="primary:#ffffff,secondary:#08a88a" style="width:70px;height:70px">
                                    </lord-icon>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="title">
                                <h2 class="h2-title wow fadeup-animation" data-wow-duration="0.8s"
                                    data-wow-delay="0.2s">
                                    <div class='main mx-auto'>
                                        <h2 class="first">Featured Tracks</h2>
                                        <h2 class="second">Featured Tracks</h2>
                                    </div>
                                    
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-lg-4">
                            <div class="music-card__wrapper wow left-animation" data-wow-duration="0.8s"
                                data-wow-delay="0.2s">
                                <div class="music-card">
                                    <div class="music-card__content">
                                        <img class="music-image" src="/public/FrontendAssets/images/singWithMe/song-img.jpg" alt="">
                                        <div class="music-info">
                                            <div>
                                            <h2 class="music-name">Frau Power</h2>
                                            <p class="music-artist">nick karvounis</p>
                                            </div>
                                            <div class="Parent-visualizerDots">
                                            <div class="music-visualizerDots">
                                                <li></li>
                                                <li></li>
                                                <li></li>
                                            </div>
                                            <div>
                                                <ul class="dropdown_Musicplaylist">
                                                <li> <a href="javascript:;">Add to Playlist</a></li>
                                                <li> <a href="javascript:;">Add to Favorites</a></li>
                                                <li> <a href="javascript:;">Share</a></li>
                                            </ul>
                                            </div>
                                            </div>
                                        </div>
                                        <audio id="audio1" src="/public/FrontendAssets/songs/Closer The Chainsmokers 128 Kbps.mp3"></audio>
                                        <div class="music-progress">
                                            <div id="progress-bar" class="music-progress-bar"></div>
                                            <div class="music-progress__time">
                                                <span class="music-progress__time-item music-current-time">00:00</span>
                                                <span class="music-progress__time-item music-duration-time">00:00</span>
                                            </div>
                                        </div>
                                        <div class="music-controls">
                                            <div id="prev" class="music-controls-item">
                                                <i class="fas fa-backward music-controls-item--icon"></i>
                                            </div>

                                            <div id="play" class="music-controls-item play">
                                                <i class="fas fa-play music-controls-item--icon play-icon"></i>
                                                <div class="play-icon-background"></div>
                                            </div>

                                            <div id="next" class="music-controls-item">
                                                <i class="fas fa-forward music-controls-item--icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="music-list-row">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="music-list-box wow right-animation" data-wow-duration="0.8s"
                                            data-wow-delay="0.2s">
                                            <div class="music-list-image">
                                                <div class="back-img"
                                                    style="background-image: url(/public/FrontendAssets/songs/Lady-Gaga-Die-With-a-Smile-Ft.-Bruno-Mars.webp);">
                                                </div>
                                            </div>
                                            <div class="music-list-info">
                                                <div class="music-info">
                                                    <h2 class="music-name">Die With a Smile</h2>
                                                    <p class="music-artist">Lady Gaga</p>
                                                </div>
                                            </div>
                                            <div class="music_controls">
                                                <div data-id="1" class="music-controls-item play play_btn">
                                                    <i class="fas fa-play music-controls-item--icon play-icon"></i>
                                                    <div class="play-icon-background"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="music-list-box wow right-animation" data-wow-duration="0.8s"
                                            data-wow-delay="0.3s">
                                            <div class="music-list-image">
                                                <div class="back-img"
                                                    style="background-image: url(/public/FrontendAssets/songs/dandelions.jpg);">
                                                </div>
                                            </div>
                                            <div class="music-list-info">
                                                <div class="music-info">
                                                    <h2 class="music-name">Dandelions</h2>
                                                    <p class="music-artist">Ruth B.</p>
                                                </div>
                                            </div>
                                            <div class="music_controls">
                                                <div data-id="2" class="music-controls-item play play_btn">
                                                    <i class="fas fa-play music-controls-item--icon play-icon"></i>
                                                    <div class="play-icon-background"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="music-list-box wow right-animation" data-wow-duration="0.8s"
                                            data-wow-delay="0.4s">
                                            <div class="music-list-image">
                                                <div class="back-img"
                                                    style="background-image: url(/public/FrontendAssets/songs/wanna\ be\ yours.jpeg);">
                                                </div>
                                            </div>
                                            <div class="music-list-info">
                                                <div class="music-info">
                                                    <h2 class="music-name">I wanna be yours</h2>
                                                    <p class="music-artist">Arctic Monkeys</p>
                                                </div>
                                            </div>
                                            <div class="music_controls">
                                                <div data-id="3" class="music-controls-item play_btn">
                                                    <i class="fas fa-play music-controls-item--icon play-icon"></i>
                                                    <div class="play-icon-background"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="music-list-box wow right-animation" data-wow-duration="0.8s"
                                            data-wow-delay="0.5s">
                                            <div class="music-list-image">
                                                <div class="back-img"
                                                    style="background-image: url(/public/FrontendAssets/songs/Señorita.jpeg);">
                                                </div>
                                            </div>
                                            <div class="music-list-info">
                                                <div class="music-info">
                                                    <h2 class="music-name">Señorita</h2>
                                                    <p class="music-artist">Shawn Mendes & Camila Cabello</p>
                                                </div>
                                            </div>
                                            <div class="music_controls">
                                                <div data-id="4" class="music-controls-item play_btn">
                                                    <i class="fas fa-play music-controls-item--icon play-icon"></i>
                                                    <div class="play-icon-background"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-12 col-md-12">
                                    <div class="music-list-box wow right-animation" data-wow-duration="0.8s"
                                        data-wow-delay="0.6s">
                                        <div class="music-list-image">
                                            <div class="back-img"
                                                style="background-image: url(assets/images/felipe-portella.jpg);">
                                            </div>
                                        </div>
                                        <div class="music-list-info">
                                            <div class="music-info">
                                                <h2 class="music-name">Paranoia Overflow</h2>
                                                <p class="music-artist">felipe portella</p>
                                            </div>
                                        </div>
                                        <div class="music_controls">
                                            <div data-id="4" class="music-controls-item play play_btn">
                                                <i class="fas fa-play music-controls-item--icon play-icon"></i>
                                                <div class="play-icon-background"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="music-list-box wow right-animation" data-wow-duration="0.8s"
                                        data-wow-delay="0.7s">
                                        <div class="music-list-image">
                                            <div class="back-img"
                                                style="background-image: url(assets/images/minh-pham.jpg);"></div>
                                        </div>
                                        <div class="music-list-info">
                                            <div class="music-info">
                                                <h2 class="music-name">Black Hole
                                                </h2>
                                                <p class="music-artist">minh pham</p>
                                            </div>
                                        </div>
                                        <div class="music_controls">
                                            <div data-id="5" class="music-controls-item play play_btn">
                                                <i class="fas fa-play music-controls-item--icon play-icon"></i>
                                                <div class="play-icon-background"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Of Music Controls -->

        <!-- Start Of Upcoming Section -->
        <section class="upcoming-section">
            <div class="container">
                <div class="row mt-4">
                    <div class="col-lg-12">
                        <div class="title">
                            <!-- <h2 class="h2-title wow fadeup-animation" data-wow-duration="0.8s" data-wow-delay="0.2s">
                                Upcoming</h2> -->
                                <div class="main mx-auto">
                                    <h2 class="first">Upcoming</h2>
                                    <h2 class="second">Upcoming</h2>
                                </div>
                        </div>
                        <div class="upcoming-box mt-5" style="margin-top: 8rem !important;">
                            <div class="row">
                                <div class="col-lg-3 col-6">
                                    <div class="countdown-box wow fadeup-animation" data-wow-duration="0.8s"
                                        data-wow-delay="0.2s">
                                        <p><span id="days"></span> Days</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <div class="countdown-box wow fadeup-animation" data-wow-duration="0.8s"
                                        data-wow-delay="0.3s">
                                        <p><span id="hours"></span> Hours</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <div class="countdown-box wow fadeup-animation" data-wow-duration="0.8s"
                                        data-wow-delay="0.4s">
                                        <p><span id="minutes"></span> Minutes</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <div class="countdown-box wow fadeup-animation" data-wow-duration="0.8s"
                                        data-wow-delay="0.5s">
                                        <p><span id="seconds"></span> Seconds</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- End Of Upcoming Section -->


        <!-- Start of Sponsor Section-->
        <div class="sponsor-section">
            <div class="container">
                <div class="sponsor-slider">
                    <div class="swiper-wrapper">


                    @foreach ($partners as $partner)
                        <div class="swiper-slide">
                            <div class="sponsor-boxs">
                                <img src="{{asset('storage/'.$partner->logo)}}    " alt="latin-music">
                            </div>
                        </div>
                    @endforeach                        


                    </div>
                </div>
            </div>
        </div>
        <!-- End of Sponsor Section-->

       

     
    @include('partials.frontend.newsletter')

     <script>
    document.addEventListener("DOMContentLoaded", () => {
    // === TRACKS DATA ===
    const tracks = [
        {
            id: 0,
            title: "Closer",
            artist: "The Chainsmokers, Halsey",
            image: "/public/FrontendAssets/songs/Closer-The-Chainsmokers-500-500.jpg",
            src: "/public/FrontendAssets/songs/Closer The Chainsmokers 128 Kbps.mp3"
        },
        {
            id: 1,
            title: "Die With a Smile",
            artist: "Lady Gaga",
            image: "/public/FrontendAssets/songs/Lady-Gaga-Die-With-a-Smile-Ft.-Bruno-Mars.webp",
            src: "/public/FrontendAssets/songs/Lady_Gaga_Ft_Bruno_Mars_-_Die_With_a_Smile_Offblogmedia.com.mp3"
        },
        {
            id: 2,
            title: "Dandelions",
            artist: "Ruth B.",
            image: "/public/FrontendAssets/songs/dandelions.jpg",
            src: "/public/FrontendAssets/songs/Ruth B. - Dandelions (Lyrics).mp3"
        },
        {
            id: 3,
            title: "I Wanna Be Yours",
            artist: "Arctic Monkeys",
            image: "/public/FrontendAssets/songs/wanna be yours.jpeg",
            src: "/public/FrontendAssets/songs/Arctic-Monkeys-I-Wanna-Be-Yours-(RawPraise.ng).mp3"
        },
        {
            id: 4,
            title: "Señorita",
            artist: "Shawn Mendes & Camila Cabello",
            image: "/public/FrontendAssets/songs/Señorita.jpeg",
            src: "/public/FrontendAssets/songs/Señorita - Shawn Mendes.mp3"
        }
    ];

    // === DOM ELEMENTS ===
    const audio = document.getElementById("audio1");
    const musicImage = document.querySelector(".music-image");
    const musicName = document.querySelector(".music-name");
    const musicArtist = document.querySelector(".music-artist");
    const playBtn = document.getElementById("play");
    const prevBtn = document.getElementById("prev");
    const nextBtn = document.getElementById("next");
    const progressBar = document.getElementById("progress-bar");
    const currentTimeEl = document.querySelector(".music-current-time");
    const durationEl = document.querySelector(".music-duration-time");

    let currentTrackIndex = 0;
    let isPlaying = false;

    // === LOAD TRACK ===
    function loadTrack(index) {
        const track = tracks[index];
        currentTrackIndex = index;
        musicImage.src = track.image;
        musicName.textContent = track.title;
        musicArtist.textContent = track.artist;
        audio.src = track.src;
        updatePlayButton(false);
        audio.currentTime = 0;
    }

    // === PLAY / PAUSE FUNCTION ===
    function playTrack() {
        audio.play();
        isPlaying = true;
        updatePlayButton(true);
    }

    function pauseTrack() {
        audio.pause();
        isPlaying = false;
        updatePlayButton(false);
    }

    function updatePlayButton(playing) {
        const icon = playBtn.querySelector("i");
        icon.classList = playing
            ? "fas fa-pause music-controls-item--icon play-icon"
            : "fas fa-play music-controls-item--icon play-icon";
    }

    // === NEXT / PREVIOUS TRACK ===
    function nextTrack() {
        currentTrackIndex = (currentTrackIndex + 1) % tracks.length;
        loadTrack(currentTrackIndex);
        playTrack();
    }

    function prevTrack() {
        currentTrackIndex = (currentTrackIndex - 1 + tracks.length) % tracks.length;
        loadTrack(currentTrackIndex);
        playTrack();
    }

    // === UPDATE PROGRESS BAR ===
    audio.addEventListener("timeupdate", () => {
        if (audio.duration) {
            const progressPercent = (audio.currentTime / audio.duration) * 100;
            progressBar.style.width = `${progressPercent}%`;
            updateTimes();
        }
    });

    function updateTimes() {
        currentTimeEl.textContent = formatTime(audio.currentTime);
        durationEl.textContent = formatTime(audio.duration);
    }

    function formatTime(time) {
        if (isNaN(time)) return "00:00";
        const minutes = Math.floor(time / 60);
        const seconds = Math.floor(time % 60);
        return `${minutes.toString().padStart(2, "0")}:${seconds
            .toString()
            .padStart(2, "0")}`;
    }

    // === SEEK FEATURE (CLICK ON PROGRESS BAR) ===
    progressBar.parentElement.addEventListener("click", (e) => {
        const width = progressBar.parentElement.clientWidth;
        const clickX = e.offsetX;
        audio.currentTime = (clickX / width) * audio.duration;
    });

    // === EVENT LISTENERS ===
    playBtn.addEventListener("click", () => {
        isPlaying ? pauseTrack() : playTrack();
    });

    nextBtn.addEventListener("click", nextTrack);
    prevBtn.addEventListener("click", prevTrack);

    // === MUSIC LIST CLICK EVENT ===
    document.querySelectorAll(".play_btn").forEach((btn) => {
        btn.addEventListener("click", (e) => {
            e.stopPropagation();
            const id = parseInt(btn.getAttribute("data-id"));
            loadTrack(id);
            playTrack();

            // Active class highlight
            document.querySelectorAll(".music-list-box").forEach((box) =>
                box.classList.remove("active-track")
            );
            btn.closest(".music-list-box").classList.add("active-track");
        });
    });

    // === INITIAL LOAD ===
    loadTrack(currentTrackIndex);
});
    </script>
@endsection
