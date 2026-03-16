@extends('layouts.frontend.master')


@section('css')
@endsection

@section('content')


        <!-- Start of InnerBanner -->
        <section class="inner-banner contact-banner">
            <div class="contact_child">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="h1-title wow fadeup-animation" data-wow-duration="0.8s" data-wow-delay="0.2s">
                                Music & Videos
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End of InnerBanner -->



        <section class="new_musicSec">
            <!-- Floating Vectors -->
            <div class="floating-vector vector-1">🎵</div>
            <div class="floating-vector vector-2">🎤</div>
            <div class="floating-vector vector-3">🎸</div>
            <div class="floating-vector vector-4">🎹</div>

            <div class="upload-section">
                <!-- Section Header -->
                <div class="section-header">
                    <h1 class="section-title">Upload Your Music & Videos</h1>
                    <p class="section-subtitle">
                        Share your creativity with the world. Upload your original music tracks and music videos to
                        reach a global audience and connect with fellow artists.
                    </p>
                </div>

                <!-- Cards Grid -->
                <div class="cards-grid">
                    <!-- Music Upload Card -->
                    <div class="upload-card">
                        <div class="music-wave">
                            <div class="wave-bar"></div>
                            <div class="wave-bar"></div>
                            <div class="wave-bar"></div>
                            <div class="wave-bar"></div>
                            <div class="wave-bar"></div>
                            <div class="wave-bar"></div>
                        </div>

                        <div class="card-icon">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 3V13.55C11.41 13.21 10.73 13 10 13C7.79 13 6 14.79 6 17S7.79 21 10 21 14 19.21 14 17V7H18V3H12Z" />
                            </svg>
                        </div>

                        <h3 class="card-title">Music Upload</h3>
                        <p class="card-description">
                            Upload your original tracks, beats, and compositions. Support for MP3, WAV, FLAC, and more
                            high-quality formats.
                        </p>

                        <ul class="card-features">
                            <li>High-quality audio processing</li>
                            <li>Automatic metadata extraction</li>
                            <li>Multiple format support</li>
                            <li>Instant preview and editing</li>
                            <li>Copyright protection</li>
                        </ul>
                        <a href="artist-portal-2.html">
                        <button class="upload-btn">Upload Music</button>
                        </a>
                    </div>

                    <!-- Video Upload Card -->
                    <div class="upload-card">
                        <div class="card-icon">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M17,10.5V7A1,1 0 0,0 16,6H4A1,1 0 0,0 3,7V17A1,1 0 0,0 4,18H16A1,1 0 0,0 17,17V13.5L21,17.5V6.5L17,10.5Z" />
                            </svg>
                        </div>

                        <h3 class="card-title">Video Upload</h3>
                        <p class="card-description">
                            Share your music videos, live performances, and behind-the-scenes content. Professional
                            video processing included.
                        </p>

                        <ul class="card-features">
                            <li>4K video support</li>
                            <li>Automatic compression</li>
                            <li>Thumbnail generation</li>
                            <li>Subtitle support</li>
                            <li>Social media optimization</li>
                        </ul>
                        <a href="artist-portal-2.html">
                        <button class="upload-btn">Upload Video</button>
                        </a>
                    </div>

                    <!-- Live Stream Card -->
                    <div class="upload-card">
                        <div class="card-icon">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12,2A3,3 0 0,1 15,5V11A3,3 0 0,1 12,14A3,3 0 0,1 9,11V5A3,3 0 0,1 12,2M19,11C19,14.53 16.39,17.44 13,17.93V21H11V17.93C7.61,17.44 5,14.53 5,11H7A5,5 0 0,0 12,16A5,5 0 0,0 17,11H19Z" />
                            </svg>
                        </div>

                        <h3 class="card-title">Live Streaming</h3>
                        <p class="card-description">
                            Stream live performances, jam sessions, and interact with your audience in real-time with
                            professional streaming tools.
                        </p>

                        <ul class="card-features">
                            <li>HD live streaming</li>
                            <li>Real-time chat integration</li>
                            <li>Multi-camera support</li>
                            <li>Stream recording</li>
                            <li>Audience analytics</li>
                        </ul>
                        <a href="artist-portal-2.html">
                        <button class="upload-btn">Start Streaming</button>
                        </a>
                    </div>

                    <!-- Collaboration Card -->
                    <div class="upload-card">
                        <div class="card-icon">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M16,4C18.21,4 20,5.79 20,8C20,10.21 18.21,12 16,12C15.67,12 15.34,11.95 15.04,11.85L14.6,12.68C15.11,13.12 15.5,13.73 15.67,14.42L16.96,15.71C17.3,15.37 17.74,15.12 18.24,15.03C19.04,14.9 19.83,15.11 20.45,15.56C21.07,16 21.5,16.63 21.64,17.35C21.92,18.78 20.83,20.14 19.4,20.42C18.64,20.56 17.87,20.35 17.28,19.86C16.69,19.37 16.32,18.66 16.22,17.9L15.29,16.97C14.6,17.33 13.81,17.5 13,17.5C12.19,17.5 11.4,17.33 10.71,16.97L9.78,17.9C9.68,18.66 9.31,19.37 8.72,19.86C8.13,20.35 7.36,20.56 6.6,20.42C5.17,20.14 4.08,18.78 4.36,17.35C4.5,16.63 4.93,16 5.55,15.56C6.17,15.11 6.96,14.9 7.76,15.03C8.26,15.12 8.7,15.37 9.04,15.71L10.33,14.42C10.5,13.73 10.89,13.12 11.4,12.68L10.96,11.85C10.66,11.95 10.33,12 10,12C7.79,12 6,10.21 6,8C6,5.79 7.79,4 10,4C11.25,4 12.37,4.58 13,5.5C13.63,4.58 14.75,4 16,4M10,6A2,2 0 0,0 8,8A2,2 0 0,0 10,10A2,2 0 0,0 12,8A2,2 0 0,0 10,6M16,6A2,2 0 0,0 14,8A2,2 0 0,0 16,10A2,2 0 0,0 18,8A2,2 0 0,0 16,6Z" />
                            </svg>
                        </div>

                        <h3 class="card-title">Collaboration Hub</h3>
                        <p class="card-description">
                            Connect with other artists for collaborations, remixes, and joint projects. Build your
                            musical network globally.
                        </p>

                        <ul class="card-features">
                            <li>Artist matching system</li>
                            <li>Project collaboration tools</li>
                            <li>Version control for tracks</li>
                            <li>Real-time feedback</li>
                            <li>Revenue sharing options</li>
                        </ul>
                        <a href="artist-portal-2.html">
                        <button class="upload-btn">Find Collaborators</button>
                        </a>
                    </div>

                    <!-- Distribution Card -->
                    <div class="upload-card">
                        <div class="card-icon">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4M12,6A6,6 0 0,0 6,12A6,6 0 0,0 12,18A6,6 0 0,0 18,12A6,6 0 0,0 12,6M12,8A4,4 0 0,1 16,12A4,4 0 0,1 12,16A4,4 0 0,1 8,12A4,4 0 0,1 12,8Z" />
                            </svg>
                        </div>

                        <h3 class="card-title">Global Distribution</h3>
                        <p class="card-description">
                            Distribute your music to Spotify, Apple Music, YouTube Music, and 150+ platforms worldwide
                            with one click.
                        </p>

                        <ul class="card-features">
                            <li>Instant global distribution</li>
                            <li>Royalty collection & tracking</li>
                            <li>Release scheduling</li>
                            <li>Performance analytics</li>
                            <li>Playlist pitching service</li>
                        </ul>
                        <a href="artist-portal-2.html">
                        <button class="upload-btn">Distribute Now</button>
                        </a>
                    </div>

                    <!-- Analytics Card -->
                    <div class="upload-card">
                        <div class="card-icon">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M22,21H2V3H4V19H6V17H10V19H12V16H16V19H18V17H22V21M16,8H18V15H16V8M12,2H14V15H12V2M8,9H10V15H8V9M4,11H6V15H4V11Z" />
                            </svg>
                        </div>

                        <h3 class="card-title">Advanced Analytics</h3>
                        <p class="card-description">
                            Get detailed insights into your music performance, audience demographics, and revenue
                            streams across all platforms.
                        </p>

                        <ul class="card-features">
                            <li>Real-time streaming data</li>
                            <li>Audience demographics</li>
                            <li>Revenue tracking</li>
                            <li>Geographic insights</li>
                            <li>Trend analysis & predictions</li>
                        </ul>
                        <a href="artist-portal-2.html">
                        <button class="upload-btn">View Analytics</button>
                        </a>
                    </div>
                </div>
            </div>

        </section>




        <section class="video_slider py-5 mt-5">
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



@endsection
