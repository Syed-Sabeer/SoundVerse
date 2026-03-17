@extends('layouts.frontend.master')


@section('css')
<style>
/* Custom SweetAlert2 Styling */
.swal2-popup {
    font-family: inherit;
    border-radius: 15px;
}

.swal2-title {
    color: #333;
    font-weight: 600;
}

.swal2-content {
    color: #666;
    font-size: 16px;
    line-height: 1.5;
}

.swal2-confirm {
    border-radius: 25px !important;
    padding: 12px 30px !important;
    font-weight: 600 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    transition: all 0.3s ease !important;
}

.swal2-confirm:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2) !important;
}

/* Success modal styling */
.swal2-icon.swal2-success {
    border-color: #0a5c49 !important;
}

.swal2-icon.swal2-success [class^='swal2-success-line'] {
    background-color: #0a5c49 !important;
}

.swal2-icon.swal2-success .swal2-success-ring {
    border-color: #0a5c49 !important;
}

/* Error modal styling */
.swal2-icon.swal2-error {
    border-color: #dc3545 !important;
}

.swal2-icon.swal2-error [class^='swal2-x-mark-line'] {
    background-color: #dc3545 !important;
}

/* Loading animation for submit button */
.submit-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

/* Form validation styling */
.form-group.error input,
.form-group.error textarea,
.form-group.error select {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
}

.form-group.error .error-message {
    color: #dc3545;
    font-size: 12px;
    margin-top: 5px;
    display: block;
}
</style>
@endsection

@section('content')


  <!-- Start of Main Banner -->
  <section class="main-banner hero_sec ">
            <div class="child_hero py-4">
            <div class="container">
                <div class="row align-items-baseline">
                    <div class="col-lg-4 col-xxl-4 col-xl-4 col-md-5">
                        <div class="banner-content">
                            <!-- <h3 class="wow left-animation" data-wow-duration="0.8s" data-wow-delay="0.2s">One good thing about music,</h3> -->
                            <h1 class="h1-title wow left-animation" data-wow-duration="0.8s" data-wow-delay="0.3s">
                               <span class="span-heading"> Join </span>{{$hero_details->heading}}
                            </h1>
                            <p class="wow left-animation" data-wow-duration="0.8s" data-wow-delay="0.3s">
                              {{$hero_details->description}}
                            </p>
                            <div class="banner-btn">
                                <a href="/user-portal" title="Google Play" class="sec-btn wow left-animation"
                                    data-wow-duration="0.8s" data-wow-delay="0.4s">Exlpore More </a>
                                <!-- <a href="javascript:void(0);" title="Amazon Music"
                                    class="sec-btn hover-btn wow left-animation" data-wow-duration="0.8s"
                                    data-wow-delay="0.5s"> <span><i class="fa fa-search-plus"></i></span>Exlpore More</a> -->
                            </div>
                            <div class="pt-4 player-parent">
                            <div class="player-container">
  <div class="song-info">
    <div class="album-art" id="albumArt">
      <img src="{{ asset($hero_details->song_image) }}" alt="">
    </div>
    <div class="track-details">
      <div class="song-title" id="songTitle">{{ $hero_details->song_name }}</div>
      <div class="artist-album" id="artistAlbum">{{ $hero_details->song_album }}</div>
    </div>
    <div class="like-section">
      <button class="like-btn" id="likeBtn" onclick="toggleLike()">♡</button>
      <button class="add-btn" onclick="addToPlaylist()">+</button>
    </div>
  </div>

  <div class="progress-section">
    <div class="time-display">
      <span id="currentTime">0:00</span>
      <span id="totalTime">0:00</span>
    </div>
    <div class="progress-container" onclick="seekTo(event)">
      <div class="progress-bar" id="progressBar"></div>
    </div>
  </div>

  <div class="controls">
    <button class="control-btn" onclick="previousTrack()">⏮</button>
    <button class="control-btn play-pause-btn" id="playPauseBtn" onclick="togglePlayPause()">▶</button>
    <button class="control-btn" onclick="nextTrack()">⏭</button>
  </div>


<script>
  // Single song data from Laravel
  const track = {
    title: @json($hero_details->song_name),
    album: @json($hero_details->song_album),
    src: "{{ asset($hero_details->song) }}",
    img: "{{ asset($hero_details->song_image) }}"
  };

  let audio = new Audio(track.src);
  const playPauseBtn = document.getElementById("playPauseBtn");
  const songTitle = document.getElementById("songTitle");
  const artistAlbum = document.getElementById("artistAlbum");
  const albumArt = document.getElementById("albumArt").querySelector("img");
  const progressBar = document.getElementById("progressBar");
  const currentTimeEl = document.getElementById("currentTime");
  const totalTimeEl = document.getElementById("totalTime");

  // Format time mm:ss
  function formatTime(seconds) {
    let m = Math.floor(seconds / 60);
    let s = Math.floor(seconds % 60);
    return `${m}:${s < 10 ? "0" : ""}${s}`;
  }

  // Load track details dynamically
  function loadTrack() {
    audio.src = track.src;
    songTitle.textContent = track.title;
    artistAlbum.textContent = track.album;
    albumArt.src = track.img;

    audio.addEventListener("loadedmetadata", () => {
      totalTimeEl.textContent = formatTime(audio.duration);
    });
  }

  // Play/Pause
  function togglePlayPause() {
    if (audio.paused) {
      audio.play();
      playPauseBtn.textContent = "⏸";
    } else {
      audio.pause();
      playPauseBtn.textContent = "▶";
    }
  }

  // Progress bar update
  audio.addEventListener("timeupdate", () => {
    const progressPercent = (audio.currentTime / audio.duration) * 100;
    progressBar.style.width = `${progressPercent}%`;
    currentTimeEl.textContent = formatTime(audio.currentTime);
  });

  // Seek function
  function seekTo(event) {
    const progressContainer = event.currentTarget;
    const width = progressContainer.offsetWidth;
    const clickX = event.offsetX;
    const duration = audio.duration;
    audio.currentTime = (clickX / width) * duration;
  }

  // Dummy functions for UI
  function toggleLike() {
    const btn = document.getElementById("likeBtn");
    btn.textContent = btn.textContent === "♡" ? "❤️" : "♡";
  }
  function addToPlaylist() {
    alert("Added to playlist!");
  }

  // Load track on page load
  loadTrack();
</script>



                        </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xxl-4 col-xl-4 col-md-4 ">
                        <div>
                            <div class="search-container">
                            <input type="text" class="search-bar" placeholder="Search Song" />
                            <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xxl-4 col-xl-4 col-md-3 ">
                        <div class="banner-video">
                            <!-- <video id="bgVideo" width="100%" height="100%" autoplay muted loop>
                             <source src="{{asset('FrontendAssets/images/singWithMe/video/header.webm')}}" type="video/mp4">
                            </video> -->
                        <div>
                            <div class="vector_1">
                            <lord-icon
                                src="https://cdn.lordicon.com/gcupmfyg.json"
                                trigger="loop"
                                delay="2000"
                                colors="primary:#121331,secondary:#ffffff">
                            </lord-icon>
                            </div>
                            <div class="vector_2 d-none">
                                <lord-icon
                                    src="https://cdn.lordicon.com/rzgcaxjz.json"
                                    trigger="loop"
                                    colors="primary:#121331,secondary:#ffffff">
                                </lord-icon>
                            </div>
                            <!-- <div class="vector_3">
                                <lord-icon
                                    src="https://cdn.lordicon.com/qfwgmyhc.json"
                                    trigger="loop"
                                    delay="2000"
                                    colors="primary:#121331,secondary:#ffffff">
                                </lord-icon>
                            </div> -->
                        </div>
                        </div>

                        <div class="populor-corner">
                            <div>
                                <h3>Popular Corner</h3>
                            </div>
                            <div class="popular-images">
                            <div class="row">
                            <div class="col-6 mt-2">
                                <div>
                                <img src="{{ asset($hero_details->pc_image_1) }}" alt="">
                                </div>
                            </div>
                            <div class="col-6 mt-2">
                                <div>
                                <img src="{{ asset($hero_details->pc_image_2) }}" alt="">
                                </div>
                            </div>
                            <div class="col-6 my-2">
                                <div>
                                <img src="{{ asset($hero_details->pc_image_3) }}" alt="">
                                </div>
                            </div>
                            <div class="col-6 my-2">
                                <div>
                                <img src="{{ asset($hero_details->pc_image_4) }}" alt="">
                                </div>
                            </div>
                            </div>
                            </div>
                        </div>
                        <!-- <div class="wrapper">
                        <span class="bubble"></span>
                        <span class="bubble"></span>
                        <span class="bubble"></span>
                        <span class="bubble"></span>
                        <span class="bubble"></span>
                        <span class="bubble"></span>
                        <span class="bubble"></span>
                        <span class="bubble"></span>
                        <span class="bubble"></span>
                        <span class="bubble"></span>
                        </div> -->
                    </div>
                </div>
            </div>
            </div>
        </section>

        <!-- End of Main Banner -->

        <!-- Start of Artist Section -->


        <section class="secnewArtist">
            <div class="container">
            <div class="row pt-5">
                        <div class="col-lg-12">
                            <div class="title">
                                <div class="mobile-vectors">
                                    <img src="{{asset('FrontendAssets/images/singWithMe/mobile-vector.png')}}" alt="">
                                </div>
                                <h2 class="h2-title wow fadeup-animation" data-wow-duration="0.8s" data-wow-delay="0.2s">
                                    <div class='main'>
                                    <h2 class="first"> Artist</h2>
                                    <h2 class="second">Artist</h2>
                                    </div>
                                    </h2>
                                <h4 class="h4-title wow fadeup-animation mt-4" data-wow-duration="0.8s" data-wow-delay="0.2s">
                                    Fresh Sounds, New Vibes – Meet Our Latest Artist</h4>
                            </div>
                            <div class="parent-loader">
                                <div class="loader">
                                    <div class="box1"></div>
                                    <div class="box2"></div>
                                    <div class="box3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="artists-grid">
                    @if(isset($recent_artists) && $recent_artists->count() > 0)
                        @foreach($recent_artists as $artist)
                            @php
                                $profile = $artist->profile;
                                $avatar = $profile && $profile->picture
                                    ? asset('storage/' . $profile->picture)
                                    : 'https://img.freepik.com/premium-photo/musician-recording-song-home-studio_919955-56272.jpg';
                                $name = $artist->name ?? $artist->username ?? 'Artist';
                                $genre = 'Various';

                                // Get total songs count
                                $totalSongs = \App\Models\ArtistMusic::where('driver_id', $artist->id)->count();

                                // Get subscribers count
                                $subscribers = $artist->artistFollowers()->count();
                            @endphp
                            <a href="{{ route('artist-profile', ['artist' => $artist->id]) }}">
                                <div class="artist-card">
                                    <div class="artist-image-wrapper">
                                        <img class="artist-image" src="{{ $avatar }}" alt="{{ $name }}">
                                        <div class="play-button"></div>
                                    </div>
                                    <div class="artist-info">
                                        <div class="artist-name">{{ $name }}</div>
                                        <div class="artist-genre">{{ $genre }}</div>
                                        <div class="artist-stats">
                                            <span>{{ $totalSongs }} {{ $totalSongs == 1 ? 'Song' : 'Songs' }}</span>
                                            <span>{{ $subscribers }} {{ $subscribers == 1 ? 'Subscriber' : 'Subscribers' }}</span>
                                        </div>
                                        <span class="genre-tag">New</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @endif
                </div>
                <div class="col-lg-12">
                                {{--<div class="btn-part wow fadeup-animation" data-wow-duration="0.8s" data-wow-delay="0.6s">
                                    <a href="/featured-artist" class="sec-btn" title="view more">view more</a>
                                </div>--}}
                            </div>
            </div>
        </section>
        <!-- End of Artist Section -->
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
                                <a href="/about" class="sec-btn" title="view more">view more</a>
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

        <!-- Start of Artworks Section -->
        <section class="albums-section mt-5">
            <div class="music3_vectors">
                <img src="{{asset('FrontendAssets/images/singWithMe/music-3.png')}}" alt="">
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="title">
                            <h2 class="h2-title wow fadeup-animation" data-wow-duration="0.8s" data-wow-delay="0.1s">
                            <div class='main mx-auto'>
                                <h2 class="first"> Artworks</h2>
                                <h2 class="second">Artworks</h2>
                            </div>

                            </h2>
                            <h4 class="h4-title wow fadeup-animation" data-wow-duration="0.8s" data-wow-delay="0.2s">
                                Check out our Latest Artworks</h4>
                        </div>

                    </div>
                </div>
                <div class="albums-row">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="album-box-row">
                                <div class="row">
                                    @forelse($latest_artworks as $artwork)
                                        @php
                                            $imageUrl = $artwork->image_url
                                                ?? 'https://img.freepik.com/premium-photo/musician-recording-song-home-studio_919955-56272.jpg';
                                            $artistName = $artwork->user->name ?? 'Unknown Artist';
                                        @endphp
                                        <div class="col-lg-4">
                                            <a href="{{ route('all-artwork') }}" title="{{ $artistName }}" class="album-box wow fadeup-animation"
                                                data-wow-duration="0.8s" data-wow-delay="0.2s">
                                                <div class="back-img"
                                                    style="background-image: url('{{ $imageUrl }}');">
                                                </div>
                                                <h3 class="h3-title">Artwork</h3>
                                                <h4 class="singer-name">
                                                    <span>{{ $artistName }}</span>
                                                </h4>
                                            </a>
                                        </div>
                                    @empty
                                        <div class="col-lg-12 text-center py-5">
                                            <p class="text-muted">No artworks uploaded yet.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            <div class="btn-part wow fadeup-animation" data-wow-duration="0.8s" data-wow-delay="0.5s">
                                <a href="{{ route('all-artwork') }}" class="sec-btn" title="view more">view more</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End of Artworks Section -->

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
                                        <img class="music-image" id="featured-track-image" src="/public/FrontendAssets/images/singWithMe/song-img.jpg" alt="Track Image">
                                        <div class="music-info">
                                            <div>
                                            <h2 class="music-name" id="featured-track-name">Select a track to play</h2>
                                            <p class="music-artist" id="featured-track-artist">Artist name will appear here</p>
                                            </div>
                                            <div class="Parent-visualizerDots">
                                            <div class="music-visualizerDots">
                                                <li></li>
                                                <li></li>
                                                <li></li>
                                            </div>
                                            <div>
                                                <ul class="dropdown_Musicplaylist">
                                                <li> <a href="javascript:;" onclick="addCurrentTrackToPlaylist()">Add to Playlist</a></li>
                                                <li> <a href="javascript:;" onclick="addCurrentTrackToFavorites()">Add to Favorites</a></li>
                                                <li> <a href="javascript:;" onclick="shareCurrentTrack()">Share</a></li>
                                                <li> <a href="javascript:;" id="current-track-tip-link" onclick="tipCurrentTrackArtist()">Artist Tip</a></li>
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
                                    @if(isset($featured_tracks) && $featured_tracks->count() > 0)
                                        @foreach($featured_tracks->take(4) as $index => $track)
                                            @php
                                                $artist = $track->user;
                                                $isCertifiedCreator = $artist && $artist->isCertifiedCreator();
                                                $showEarlyAccess = isset($userFeatures['has_early_access']) && $userFeatures['has_early_access'] && $isCertifiedCreator;
                                                $thumbnail = $track->thumbnail_image ? asset('storage/' . $track->thumbnail_image) : asset('FrontendAssets/images/default-music.jpg');
                                            @endphp
                                            <div class="col-lg-12 col-md-12">
                                                <div class="music-list-box wow right-animation" data-wow-duration="0.8s"
                                                    data-wow-delay="{{ 0.2 + ($index * 0.1) }}s">
                                                    <div class="music-list-image" style="position: relative;">
                                                        <div class="back-img"
                                                            style="background-image: url('{{ $thumbnail }}');">
                                                        </div>
                                                        @if($showEarlyAccess)
                                                            <span class="early-access-badge" style="position: absolute; top: 10px; right: 10px; background: linear-gradient(135deg, #fbbf24, #f59e0b); color: #fff; font-size: 0.7rem; padding: 4px 8px; border-radius: 12px; font-weight: 600; z-index: 10; box-shadow: 0 2px 8px rgba(0,0,0,0.3);">
                                                                ⭐ Early Access
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="music-list-info">
                                                        <div class="music-info">
                                                            <h2 class="music-name">{{ $track->name }}</h2>
                                                            <p class="music-artist">{{ $artist->name ?? 'Unknown Artist' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="music_controls">
                                                        <div data-id="{{ $track->id }}" class="music-controls-item play play_btn"
                                                            onclick="playFeaturedTrack({{ $track->id }}, '{{ addslashes($track->name) }}', '{{ addslashes($artist->name ?? 'Unknown') }}', '{{ $thumbnail }}', '{{ $track->music_file_url ?? '' }}', '{{ $track->isrc_code ?? '' }}', {{ $artist->id ?? 'null' }})">
                                                            <i class="fas fa-play music-controls-item--icon play-icon"></i>
                                                            <div class="play-icon-background"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-lg-12 col-md-12">
                                            <div class="text-center py-4 text-muted">
                                                No featured tracks available at this time.
                                            </div>
                                        </div>
                                    @endif
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

  <section class="creators-section">
        <div class="section-header">
            <h2 class="section-title">Certified <span class="un_Span">Creators</span></h2>
            <p class="section-subtitle">Discover our verified artists making waves in the music industry with their unique sounds and authentic voices.</p>
        </div>

        <div class="creators-grid">
           @forelse($featured_artists->where('is_certified_creator', 1)->take(3) as $artist)
                @php
                    $profile = $artist->profile;
                    $avatar = $profile && $profile->picture
                        ? asset('storage/' . $profile->picture)
                        : 'https://img.freepik.com/premium-photo/musician-recording-song-home-studio_919955-56272.jpg';
                    $name      = $artist->name ?? $artist->username ?? 'Artist';
                    $genre     = 'Various';
                    $followers = '0';
                    $listeners = '0';
                @endphp
                <a href="{{ route('artist-profile', ['artist' => $artist->id]) }}">
                    <div class="artist-card">
                        <div class="artist-image-wrapper">
                            <img class="artist-image" src="{{ $avatar }}" alt="{{ $name }}">
                            <div class="play-button"></div>
                        </div>
                        <div class="artist-info">
                            <div class="artist-name">{{ $name }}</div>
                            <div class="artist-genre">{{ $genre }}</div>
                            <div class="artist-stats">
                                <span>{{ $followers }} Followers</span>
                                <span>{{ $listeners }} Monthly Listeners</span>
                            </div>
                            <span class="genre-tag">✓ Certified</span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">No certified creators yet. Artists can apply through their portal.</p>
                </div>
            @endforelse
        </div>

        <!-- View All Certified Creators Button -->
        <div class="cta text-center mt-5">
            <a href="{{ route('certified-creators') }}" class="sec-btn" title="View all certified creators">View All Certified Creators</a>
        </div>
    </section>



        <section class="creators-section">
        <div class="section-header">
            <h2 class="section-title">Featured <span class="un_Span">Artists</span></h2>
            <p class="section-subtitle">Discover our verified artists making waves in the music industry with their unique sounds and authentic voices.</p>
        </div>

        <div class="creators-grid">
            @forelse($featured_artists as $artist)
                @php
                    $profile = $artist->profile;
                    $avatar = $profile && $profile->picture
                        ? asset('storage/' . $profile->picture)
                        : 'https://img.freepik.com/premium-photo/musician-recording-song-home-studio_919955-56272.jpg';
                    $name      = $artist->name ?? $artist->username ?? 'Artist';
                    $genre     = 'Various';
                    $followers = '0';
                    $listeners = '0';
                @endphp
                <a href="{{ route('artist-profile', ['artist' => $artist->id]) }}">
                    <div class="artist-card">
                        <div class="artist-image-wrapper">
                            <img class="artist-image" src="{{ $avatar }}" alt="{{ $name }}">
                            <div class="play-button"></div>
                        </div>
                        <div class="artist-info">
                            <div class="artist-name">{{ $name }}</div>
                            <div class="artist-genre">{{ $genre }}</div>
                            <div class="artist-stats">
                                <span>{{ $followers }} Followers</span>
                                <span>{{ $listeners }} Monthly Listeners</span>
                            </div>
                            <span class="genre-tag">Featured</span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">No featured artists selected yet. Set featured artists from the admin panel.</p>
                </div>
            @endforelse
        </div>
    </section>

        <!-- blog-section -->

         <section class="secArtist_portal_blog py-5">
            <div class="container">
                <!-- Blog Section Hero -->
                <div class="hero text-center mb-5">
                <h2>Discover Music Insights on  <span class="un_Span">Our Blog</span></h2>
                <p>Explore industry tips, artist stories, and expert guidance to help you grow your music career. Learn from those who’ve been where you are now.</p>
                </div>

                <!-- Blog Cards Grid -->
                <div class="blog-grid">
                  @foreach ($blogs as $blog)
                <!-- Blog Post 1 -->
                <div class="blog-card wow fadeup-animation" data-wow-duration="0.8s"
                                    data-wow-delay="0.2s">
                    <img src="{{asset('storage/'.$blog->image)}}" alt="Blog Post" class="blog-img" />
                    <div class="blog-content">
                    <h3>{{$blog->title}}</h3>
                    <p>{!! \Illuminate\Support\Str::words(strip_tags($blog->content), 15) !!}</p>

                    <a href="{{ route('blog.detail', $blog->slug) }}" class="read-more">Read More →</a>
                    </div>
                </div>
@endforeach


                </div>

                <!-- CTA -->
                <div class="cta text-center mt-5">
                <a href="/allblogs" class="sec-btn" title="view more">view more</a>
                </div>
            </div>
            </section>

        <!-- blog-section -->

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

        <!-- Start of Event Section -->
        <section class="event-section" id="events">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="title">
                            <h2 class="h2-title wow fadeup-animation" data-wow-duration="0.8s" data-wow-delay="0.2s">
                                </h2>
                                <div class="main mx-auto">
                                    <h2 class="first">Our Services</h2>
                                    <h2 class="second">Our Services</h2>
                                </div>
                            <h4 class="h4-title  wow fadeup-animation" data-wow-duration="0.8s" data-wow-delay="0.3s">
                                Empowering independent artists through powerful tools, distribution, and creative
                                support.</h4>
                        </div>
                    </div>
                </div>
                <div class="event-row">
                    <div class="event-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="event-box">
                                    <!-- <span class="date-tag">20 <span>nov</span></span> -->
                                    <div class="back-img"
                                        style="background-image: url({{asset('FrontendAssets/images/singWithMe/Music-Upload.jpg')}});"></div>
                                    <div class="event-content">
                                        <a href="#" title="karsten Winegeart">Music & Video Upload</a>
                                        <!-- <span>Wakestock Festival</span> -->
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="event-box">
                                    <!-- <span class="date-tag">30 <span>jul</span></span> -->
                                    <div class="back-img"
                                        style="background-image: url({{asset('FrontendAssets/images/singWithMe/royalty.avif')}});">
                                    </div>
                                    <div class="event-content">
                                        <a href="#" title="Colin Lloyd">Royalty Collection</a>
                                        <!-- <span>Wakestock Festival</span> -->
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="event-box">
                                    <!-- <span class="date-tag">7 <span>feb</span></span> -->
                                    <div class="back-img" style="background-image: url({{asset('FrontendAssets/images/dimitri.jpg')}});">
                                    </div>
                                    <div class="event-content">
                                        <a href="#" title="AfterHills Festival">Artist Subscription Plan</a>
                                        <!-- <span>Wakestock Festival</span> -->
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="event-box">
                                    <!-- <span class="date-tag">31 <span>dec</span></span> -->
                                    <div class="back-img"
                                        style="background-image: url({{asset('FrontendAssets/images/jesse-ramirez.jpg')}});"></div>
                                    <div class="event-content">
                                        <a href="#" title="AfterHills Festival">Artwork & Photo Upload</a>
                                        <!-- <span>Wakestock Festival</span> -->
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="event-box">
                                    <!-- <span class="date-tag">31 <span>dec</span></span> -->
                                    <div class="back-img"
                                        style="background-image: url({{asset('FrontendAssets/images/singWithMe/Support-Networking.avif')}});">
                                    </div>
                                    <div class="event-content">
                                        <a href="#" title="AfterHills Festival">Support & Networking</a>
                                        <!-- <span>Wakestock Festival</span> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- End of Event Section -->


        <!-- Start of Sponsor Section-->
        <div class="sponsor-section">
            <div class="container">
                <di v class="sponsor-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="sponsor-boxs">
                                <img src="{{asset('FrontendAssets/images/latin-music.svg')}}" alt="latin-music">
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="sponsor-boxs">
                                <img src="{{asset('FrontendAssets/images/jazz-music.svg')}}" alt="jazz-music">
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="sponsor-boxs">
                                <img src="{{asset('FrontendAssets/images/relax-music.svg')}}" alt="relax-music">
                            </div>

                        </div>
                        <div class="swiper-slide">
                            <div class="sponsor-boxs">
                                <img src="{{asset('FrontendAssets/images/classical-music.svg')}}" alt="classical-music">
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="sponsor-boxs">
                                <img src="{{asset('FrontendAssets/images/electronic-music.svg')}}" alt="electronic-music">
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="sponsor-boxs">
                                <img src="{{asset('FrontendAssets/images/rock-roll.svg')}}" alt="rock-roll">

                            </div>

                        </div>
                    </div>
                </di>
            </div>
        </div>
        <!-- End of Sponsor Section-->

        <section class="video_slider py-5">
         <div class="container">
            <div class="section-header">
                <!-- <div class="section-icon"></div> -->
                <!-- <h2 class="section-title">Recent LIVE Videos</h2> -->
                <div class="main mx-auto">
                    <h2 class="first">Recent Live Videos</h2>
                    <h2 class="second">Recent Live Videos</h2>
                </div>
            </div>

            <div class="swiper video-slider">
                <div class="swiper-wrapper">

            @foreach($live_videos as $live_video)
                    <!-- Slide 4 -->
                    <div class="swiper-slide">
                        <video id="bgVideo" width="100%" height="100%" autoplay muted loop>
                            <source src="{{asset('storage/'.$live_video->video)}}" type="video/mp4">
                        </video>
                        <div class="video-thumbnail video-4">
                            <div class="live-badge">
                                <div class="live-dot"></div>
                                LIVE
                            </div>
                        </div>
                        <div class="video-info">
                            <!-- <div class="video-category">T-Series</div> -->
                            <div class="video-title">{{$live_video->title}}</div>
                            <div class="video-stats">
                                <div class="stats-left">
                                    <div class="viewers">
                                        <div class="viewer-dot"></div>
                                        {{$live_video->views}} views
                                    </div>
                                    <span>{{$live_video->created_at->diffForHumans()}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach

                </div>
            </div>
         </div>
         </section>
        <!-- End of Video Gallery -->

        <section class="secQR_code">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-12 col-sm-12">
                        <div class="content_QR">
                            <h2>Download <span class="un_Span">SingWithMe</span> Free App</h2>
                            <p>Get Access To Exclusive Offers!</p>
                            <div class="store_button">
                                  <!-- App Store Button -->
                            <a href="#" class="store-btn app-store">
                                <div class="store-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M18.71,19.5C17.88,20.74 17,21.95 15.66,21.97C14.32,22 13.89,21.18 12.37,21.18C10.84,21.18 10.37,21.95 9.1,22C7.79,22.05 6.8,20.68 5.96,19.47C4.25,17 2.94,12.45 4.7,9.39C5.57,7.87 7.13,6.91 8.82,6.88C10.1,6.86 11.32,7.75 12.11,7.75C12.89,7.75 14.37,6.68 15.92,6.84C16.57,6.87 18.39,7.1 19.56,8.82C19.47,8.88 17.39,10.1 17.41,12.63C17.44,15.65 20.06,16.66 20.09,16.67C20.06,16.74 19.67,18.11 18.71,19.5M13,3.5C13.73,2.67 14.94,2.04 15.94,2C16.07,3.17 15.6,4.35 14.9,5.19C14.21,6.04 13.07,6.7 11.95,6.61C11.8,5.46 12.36,4.26 13,3.5Z"/>
                                    </svg>
                                </div>
                                <div class="store-text">
                                    <div class="store-subtitle">Download on the</div>
                                    <div class="store-name">App Store</div>
                                </div>
                            </a>

                            <!-- Google Play Button -->
                            <a href="#" class="store-btn google-play">
                                <div class="store-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M3,20.5V3.5C3,2.91 3.34,2.39 3.84,2.15L13.69,12L3.84,21.85C3.34,21.61 3,21.09 3,20.5M16.81,15.12L6.05,21.34L14.54,12.85L16.81,15.12M20.16,10.81C20.5,11.08 20.75,11.5 20.75,12C20.75,12.5 20.53,12.9 20.18,13.18L17.89,14.5L15.39,12L17.89,9.5L20.16,10.81M6.05,2.66L16.81,8.88L14.54,11.15L6.05,2.66Z"/>
                                    </svg>
                                </div>
                                <div class="store-text">
                                    <div class="store-subtitle">Get it on</div>
                                    <div class="store-name">Google Play</div>
                                </div>
                            </a>
                            </div>
                            <div>
                                <img src="/assets/images/singWithMe/QR_code.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </section>


             @include('partials.frontend.contact')

@include('partials.frontend.newsletter')

@endsection

@section('script')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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


<script>
        function handleSubmit(event) {
            event.preventDefault();

            const successMessage = document.getElementById('successMessage');
            const form = document.getElementById('contactForm');

            // Show success message with animation
            successMessage.classList.add('show');

            // Reset form
            form.reset();

            // Hide success message after 6 seconds
            setTimeout(() => {
                successMessage.classList.remove('show');
            }, 6000);
        }

        function closeForm() {
            if (confirm('Are you sure you want to close the contact form?')) {
                document.querySelector('.contact-wrapper').style.transform = 'scale(0.8)';
                document.querySelector('.contact-wrapper').style.opacity = '0';
                setTimeout(() => {
                    document.body.innerHTML = '<div style="display: flex; align-items: center; justify-content: center; height: 100vh; font-family: Arial; color: white; font-size: 1.5rem;">Contact form closed</div>';
                }, 300);
            }
        }

        // Enhanced form interactions
        document.addEventListener('DOMContentLoaded', function () {
            const inputs = document.querySelectorAll('input, textarea, select');

            inputs.forEach(input => {
                // Add floating label effect
                input.addEventListener('focus', function () {
                    this.parentElement.style.transform = 'scale(1.02)';
                });

                input.addEventListener('blur', function () {
                    this.parentElement.style.transform = 'scale(1)';
                });

                // Add typing animation to buttons
                input.addEventListener('input', function () {
                    const submitBtn = document.querySelector('.submit-btn');
                    submitBtn.style.transform = 'scale(1.02)';
                    setTimeout(() => {
                        submitBtn.style.transform = 'scale(1)';
                    }, 100);
                });
            });

            // Animate secondary images
            const secondaryImages = document.querySelectorAll('.secondary-image');
            secondaryImages.forEach((img, index) => {
                setTimeout(() => {
                    img.style.animation = `float 3s ease-in-out infinite ${index * 0.5}s`;
                }, index * 200);
            });

            // Contact form submission with SweetAlert2
            const contactForm = document.getElementById('contactForm');
            if (contactForm) {
                contactForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    // Show loading state
                    const submitBtn = contactForm.querySelector('.submit-btn');
                    const originalText = submitBtn.textContent;
                    submitBtn.textContent = 'Sending...';
                    submitBtn.disabled = true;

                    // Get form data
                    const formData = new FormData(contactForm);

                    // Make AJAX request
                    fetch(contactForm.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Show SweetAlert2 based on response
                        if (data.status === 'success') {
                            Swal.fire({
                                title: data.title,
                                text: data.message,
                                icon: data.icon,
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#0a5c49',
                                timer: 5000,
                                timerProgressBar: true
                            });

                            // Reset form on success
                            contactForm.reset();
                        } else {
                            // Handle validation errors
                            let errorMessage = data.message;
                            if (data.errors) {
                                const errorList = Object.values(data.errors).flat().join('\n');
                                errorMessage = errorMessage + '\n\n' + errorList;
                            }

                            Swal.fire({
                                title: data.title,
                                text: errorMessage,
                                icon: data.icon,
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#dc3545'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Network Error!',
                            text: 'Please check your internet connection and try again.',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#dc3545'
                        });
                    })
                    .finally(() => {
                        // Reset button state
                        submitBtn.textContent = originalText;
                        submitBtn.disabled = false;
                    });
                });
            }
        });

        // Add parallax effect to main image
window.addEventListener('scroll', function () {
    const mainImage = document.querySelector('.main-image');
    if (mainImage) {
        const scrolled = window.pageYOffset;
        mainImage.style.transform = `translateY(${scrolled * 0.1}px)`;
    }
});


        const video = document.getElementById('bgVideo');
        video.addEventListener('ended', () => {
            video.currentTime = 0;
            video.play();
        });


        // js library

    </script>
    <script>
  // Playlist (add more songs if you want)
  const playlist = [
  {
    title: "SoundHelix Song 1",
    artist: "SoundHelix",
    album: "Demo Album",
    src: "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3",
    img: "/assets/images/singWithMe/artist2.jpg"
  },

];

  let currentTrackIndex = 0;
  const audio = new Audio(playlist[currentTrackIndex].src);

  // DOM elements
  const playPauseBtn = document.getElementById("playPauseBtn");
  const songTitle = document.getElementById("songTitle");
  const artistAlbum = document.getElementById("artistAlbum");
  const albumArt = document.getElementById("albumArt").querySelector("img");

  // Load track info
  function loadTrack(index) {
    const track = playlist[index];
    audio.src = track.src;
    songTitle.textContent = track.title;
    artistAlbum.textContent = track.album;
    albumArt.src = track.img;
  }

  // Play/Pause toggle
  function togglePlayPause() {
    if (audio.paused) {
      audio.play();
      playPauseBtn.textContent = "⏸"; // pause icon
    } else {
      audio.pause();
      playPauseBtn.textContent = "▶"; // play icon
    }
  }

  // Next track
  function nextTrack() {
    currentTrackIndex = (currentTrackIndex + 1) % playlist.length;
    loadTrack(currentTrackIndex);
    audio.play();
    playPauseBtn.textContent = "⏸";
  }

  // Previous track
  function previousTrack() {
    currentTrackIndex = (currentTrackIndex - 1 + playlist.length) % playlist.length;
    loadTrack(currentTrackIndex);
    audio.play();
    playPauseBtn.textContent = "⏸";
  }

  // Load first track initially
  loadTrack(currentTrackIndex);
</script>



<script>
    // certified section

        //function playPreview(artistName) {
         //   console.log(`Playing preview for ${artistName}`);
         //   alert(`🎵 Playing preview for ${artistName}`);
        //}

       // function viewProfile(artistName) {
        //    console.log(`Viewing profile for ${artistName}`);
        //    alert(`👤 Opening profile for ${artistName}`);
       // }

      //  function tipArtist(artistName) {
       //     console.log(`Tipping ${artistName}`);
        ///    alert(`💰 Tip ${artistName} - Feature coming soon!`);
       // }

        // Add fade-in animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.artist-card').forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = `all 0.6s ease ${index * 0.1}s`;
            observer.observe(card);
        });

        // certified section

        // Store current track info for dropdown menu actions
        let currentFeaturedTrack = {
            id: null,
            name: null,
            artist: null,
            thumbnail: null,
            musicFile: null,
            artistId: null
        };

        // Play featured track function
        function playFeaturedTrack(trackId, name, artist, thumbnail, musicFile, isrcCode, artistId) {
            // Store current track info
            currentFeaturedTrack = {
                id: trackId,
                name: name,
                artist: artist,
                thumbnail: thumbnail,
                musicFile: musicFile,
                isrcCode: isrcCode || null,
                artistId: artistId || null
            };

            // Update the music card UI with track details
            const trackImage = document.getElementById('featured-track-image');
            const trackName = document.getElementById('featured-track-name');
            const trackArtist = document.getElementById('featured-track-artist');

            if (trackImage) {
                trackImage.src = thumbnail || '/public/FrontendAssets/images/singWithMe/song-img.jpg';
                trackImage.alt = name || 'Track Image';
                trackImage.onerror = function() {
                    // Fallback to default image if thumbnail fails to load
                    this.src = '/public/FrontendAssets/images/singWithMe/song-img.jpg';
                };
            }

            if (trackName) {
                trackName.textContent = name || 'Unknown Track';
            }

            if (trackArtist) {
                trackArtist.textContent = artist || 'Unknown Artist';
            }

            // Update visualizer dots to show playing state
            const visualizerDots = document.querySelector('.music-visualizerDots');
            if (visualizerDots) {
                visualizerDots.classList.add('playing');
            }

            // Update play button state
            const playButton = document.querySelector('#play');
            const playIcon = playButton?.querySelector('.play-icon');
            if (playButton && playIcon) {
                playButton.classList.add('playing');
                playIcon.classList.remove('fa-play');
                playIcon.classList.add('fa-pause');
            }

            // Update all play buttons in the featured tracks list
            document.querySelectorAll('.play_btn').forEach(btn => {
                btn.classList.remove('playing');
                const icon = btn.querySelector('.play-icon');
                if (icon) {
                    icon.classList.remove('fa-pause');
                    icon.classList.add('fa-play');
                }
            });

            // Mark the clicked button as playing
            const clickedButton = document.querySelector(`.play_btn[data-id="${trackId}"]`);
            if (clickedButton) {
                clickedButton.classList.add('playing');
                const clickedIcon = clickedButton.querySelector('.play-icon');
                if (clickedIcon) {
                    clickedIcon.classList.remove('fa-play');
                    clickedIcon.classList.add('fa-pause');
                }
            }

            // Update artist tip link if artist ID is available
            const tipLink = document.getElementById('current-track-tip-link');
            if (tipLink && artistId) {
                tipLink.href = `/tip-artist?artist=${artistId}`;
            }

            // Load and play track in global music player
            if (window.MusicPlayer) {
                const track = {
                    id: trackId,
                    name: name,
                    artist: artist,
                    thumbnail: thumbnail,
                    music_file: musicFile,
                    isrc_code: isrcCode || null
                };
                window.MusicPlayer.loadTrack(track);
                window.MusicPlayer.play();
            } else {
                console.error('Music player not available');
            }
        }
        window.playFeaturedTrack = playFeaturedTrack;

        // Add current track to playlist
        async function addCurrentTrackToPlaylist() {
            if (!currentFeaturedTrack.id) {
                alert('Please select a track first');
                return;
            }

            // Check if user is logged in
            @auth
                // Open playlist modal or show playlist selection
                if (typeof window.openPlaylistModal === 'function') {
                    window.openPlaylistModal(event);
                    // Store track ID to add after playlist selection
                    window.pendingTrackToAdd = currentFeaturedTrack.id;
                } else {
                    alert('Playlist feature is not available. Please go to your user portal to add songs to playlists.');
                }
            @else
                alert('Please log in to add songs to playlists');
            @endauth
        }
        window.addCurrentTrackToPlaylist = addCurrentTrackToPlaylist;

        // Add current track to favorites
        async function addCurrentTrackToFavorites() {
            if (!currentFeaturedTrack.id) {
                alert('Please select a track first');
                return;
            }

            @auth
                try {
                    const response = await fetch('/api/favorites/toggle', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            music_id: currentFeaturedTrack.id
                        })
                    });

                    const data = await response.json();

                    if (data.success) {
                        if (typeof showNotification === 'function') {
                            showNotification(data.message, 'success');
                        } else {
                            alert(data.message);
                        }
                    } else {
                        if (typeof showNotification === 'function') {
                            showNotification(data.message || 'Failed to update favorites', 'error');
                        } else {
                            alert(data.message || 'Failed to update favorites');
                        }
                    }
                } catch (error) {
                    console.error('Error toggling favorite:', error);
                    alert('Error updating favorite status. Please try again.');
                }
            @else
                alert('Please log in to add songs to favorites');
            @endauth
        }
        window.addCurrentTrackToFavorites = addCurrentTrackToFavorites;

        // Share current track
        function shareCurrentTrack() {
            if (!currentFeaturedTrack.id) {
                alert('Please select a track first');
                return;
            }

            const shareUrl = `${window.location.origin}/songs-details?id=${currentFeaturedTrack.id}`;
            const shareText = `Check out "${currentFeaturedTrack.name}" by ${currentFeaturedTrack.artist} on SingWithMe!`;

            if (navigator.share) {
                navigator.share({
                    title: currentFeaturedTrack.name,
                    text: shareText,
                    url: shareUrl
                }).catch(err => {
                    console.log('Error sharing:', err);
                    copyToClipboard(shareUrl);
                });
            } else {
                copyToClipboard(shareUrl);
            }
        }
        window.shareCurrentTrack = shareCurrentTrack;

        // Copy to clipboard helper
        function copyToClipboard(text) {
            const textarea = document.createElement('textarea');
            textarea.value = text;
            textarea.style.position = 'fixed';
            textarea.style.opacity = '0';
            document.body.appendChild(textarea);
            textarea.select();
            try {
                document.execCommand('copy');
                if (typeof showNotification === 'function') {
                    showNotification('Link copied to clipboard!', 'success');
                } else {
                    alert('Link copied to clipboard!');
                }
            } catch (err) {
                console.error('Failed to copy:', err);
                alert('Failed to copy link. Please copy manually: ' + text);
            }
            document.body.removeChild(textarea);
        }

        // Tip current track artist
        function tipCurrentTrackArtist() {
            if (!currentFeaturedTrack.artistId) {
                alert('Artist information not available');
                return;
            }

            window.location.href = `/tip-artist?artist=${currentFeaturedTrack.artistId}`;
        }
        window.tipCurrentTrackArtist = tipCurrentTrackArtist;
    </script>
@endsection
