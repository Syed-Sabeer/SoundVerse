@extends('layouts.frontend.master')


@section('css')
@endsection

@section('content')


        <!-- about major powel -->
        <div class="parent_majorPowel">
            <div class="about-container">
                <h1 class="about-title">MAJOR<br>POWEL</h1>

                <div class="content-grid">
                    <div class="left-content">
                        <div class="service-item">
                            <h3>Ezekiel Eliazar Powell, also known as Major Powell,</h3>
                            <p>was born in St. Catherine Parish and raised in Charles Town, located in St. Mary Parish. He received his early education at Goshen All-Age School.</p>
                        </div>
                        <div class="powel_gif">
                            <img src="{{asset('FrontendAssets/images/singWithMe/video/header.gif')}}" alt="">
                        </div>
                    </div>

                    <div class="main-images">
                        <div class="image-large">
                            <!-- <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                            alt="Modern living room"> -->
                            <div class="powel_video">
                                <video autoplay controls loop playsinline>
                                    <source src="{{asset('FrontendAssets/images/singWithMe/video/major_powel.mp4')}}" type="video/mp4">
                                    <!-- Your browser does not support the video tag. -->
                                </video>
                            </div>
                        </div>
                        <div class="image-small un_marginn">
                            <img src="{{asset('FrontendAssets/images/singWithMe/Ceo-singwithme.jpeg')}}"
                                alt="Modern bedroom">
                        </div>
                        <div class="image-small">
                            <img src="{{asset('FrontendAssets/images/singWithMe/sond.jpeg')}}"
                                alt="Modern kitchen">
                        </div>
                    </div>

                    <div class="right-content">
                        <div class="philosophy-section">
                            <h2>Ezekiel Eliazar Powell AKA Major Powell</h2>
                            <p class="philosophy-text">
                                Born in the parish of St. Catherine, grew up in Charles Town in the parish of St. Mary, and attended Goshen All Age School.
                            </p>

                            <div class="corner-image">
                                <img src="{{asset('FrontendAssets/images/singWithMe/sound.jpeg')}}"
                                    alt="Interior design detail">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- about major powel -->


      <div class="about-section" id="aboutSection">
        <div class="about_inner">
        <div class="container">
            <div class="row">
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <div class="content">
                <h1 class="title">About the CEO of SingWithMe – <span class="span-heading">Major Powell</span></h1>
                <p class="subtitle">The Visionary Behind the Music Revolution</p>
                <p class="description">
                    Major Powell is the driving force behind SingWithMe, a music platform dedicated to empowering independent artists across the globe. With a career rooted in the music industry's grassroots, Major has transformed his passion for sound into a mission for social and creative impact.
                </p>
                <h2 class="songs_heading">The Man Behind the Music – Major Powell</h2>
                <div class="music-player" id="musicPlayer">
                    <div class="visualizer"></div>
                    
                    <div class="header">
                        <div class="song-info">
                            <div class="album-cover" id="albumCover">
                                <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=120&h=120&fit=crop&crop=center" alt="Sweet Child O' Mine" onerror="this.style.display='none'; this.parentElement.style.background='linear-gradient(135deg, #ff6b6b, #4ecdc4)'; this.parentElement.innerHTML='♪';">
                            </div>
                            <div class="track-details">
                                <h3 id="songTitle">Sweet Child O' Mine</h3>
                                <p id="artistName">Use Your Illusion 2</p>
                            </div>
                        </div>
                        <div class="action-buttons">
                            <button class="icon-btn" id="likeBtn">
                                <svg class="icon" viewBox="0 0 24 24">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                                </svg>
                            </button>
                            <button class="icon-btn" id="moreBtn">
                                <svg class="icon" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="1"/>
                                    <circle cx="12" cy="5" r="1"/>
                                    <circle cx="12" cy="19" r="1"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="progress-section">
                        <div class="time-info">
                            <span id="currentTime">0:00</span>
                            <span id="totalTime">0:00</span>
                        </div>
                        <div class="progress-container" id="progressContainer">
                            <div class="progress-bar" id="progressBar"></div>
                        </div>
                    </div>

                    <div class="controls">
                        <button class="control-btn" id="prevBtn">
                            <svg class="icon" viewBox="0 0 24 24">
                                <polygon points="19 20 9 12 19 4 19 20"/>
                                <line x1="5" y1="19" x2="5" y2="5"/>
                            </svg>
                        </button>

                        <button class="control-btn play-btn" id="playBtn">
                            <svg class="icon play-icon" viewBox="0 0 24 24">
                                <polygon points="5 3 19 12 5 21 5 3"/>
                            </svg>
                            <svg class="icon pause-icon" viewBox="0 0 24 24" style="display: none;">
                                <rect x="6" y="4" width="4" height="16"/>
                                <rect x="14" y="4" width="4" height="16"/>
                            </svg>
                        </button>

                        <button class="control-btn" id="nextBtn">
                            <svg class="icon" viewBox="0 0 24 24">
                                <polygon points="5 4 15 12 5 20 5 4"/>
                                <line x1="19" y1="5" x2="19" y2="19"/>
                            </svg>
                        </button>
                    </div>
                </div>
                    <!-- 🔊 Audio Element (Hidden) -->
                <audio id="audioPlayer"></audio>
                <!-- <a href="#" class="sec-btn" title="Exlpore more">Exlpore more</a> -->
                
                <!-- <div class="partnerships">
                    <div class="partner-logo">APA</div>
                    <div class="partner-logo">UCLA</div>
                    <div class="partner-logo">CERT</div>
                </div> -->
            </div>
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <div class="image-section">
                <!-- <div class="powel_video">
                    <video autoplay controls loop playsinline>
                        <source src="assets/images/singWithMe/video/major_powel.mp4" type="video/mp4">
                        
                    </video>
                </div> -->
                <div class="profile-container">
                    <img src="{{asset('FrontendAssets/images/singWithMe/chacha.png')}}" alt="Therapist" class="profile-image">
                </div>
                
                <!-- <div class="floating-elements">
                    <div class="floating-item">
                        <span class="stat-number" data-target="147">0</span>
                        <span class="stat-label">Happy Clients</span>
                    </div>
                    <div class="floating-item">
                        <span class="stat-number" data-target="50">0</span>
                        <span class="stat-label">Success Rate</span>
                    </div>
                    <div class="floating-item">
                        <span class="stat-number" data-target="138">0</span>
                        <span class="stat-label">Sessions Completed</span>
                    </div>
                </div> -->
            </div>
            </div>
            <div class="col-12">
                <div class="about-giff">
                    <img src="{{asset('FrontendAssets/images/singWithMe/video/header.gif')}}" alt="">
                </div>
            </div>
            </div>
        </div>
        </div>
      </div>

<section class="blog-detail">
                <div class="container">
            <div class="blog-hero mt-4">
            <!-- <img src="/assets/images/slim-emcee.jpg" alt="Musician with guitar on stage"> -->
            <h1>Ezekiel Eliazar Powell  AKA <span class="un_Span">Major Powell</span></h1>
            <!-- <div class="blog-meta">Published on July 11, 2025 · by Team SingWithMe</div> -->
            </div>

            <div class="blog-content">
            <p>Born in the parish of St. Catherine, grew up in Charles Town in the parish of St. Mary, and attended Goshen All Age School.</p>

            <!-- <h2>Why Distribution Matters</h2> -->
            <p>He started his musical journey singing on a small sound system named Village Vibration in Peter's Field district, St. Mary. A small village bar would host music sessions every weekend, where he and his brother would regularly perform on Friday and Saturday nights. Their talent quickly gained attention through word of mouth, and soon other sound system owners began inviting them to perform at their events.</p>

            <p>As they gained popularity, more opportunities came their way. In 1985, Major Powell recorded his first song at Channel One Recording Studio in Kingston. By 1987, he was touring and performing in numerous stage shows. Recognizing his talent, his fellow artists encouraged him to move to Kingston to pursue his career further.</p>

            <p>They frequently visited King Jammy's Recording Studio, where many upcoming artists gathered daily, hoping to make their mark. Every Tuesday, King Jammy hosted auditions led by Louise and Bravo. Powell passed his audition on the first try and was granted access to record at the studio whenever it was available. However, due to the high number of aspiring artists, he didn't stay around often.</p>
            <p>Despite the competition, Powell remained focused. He once owned a craft shop in Jamaica selling souvenirs such as keyrings, t-shirts, handcrafted birds, walking canes, and more.
            </p>

            <p>He traveled across all fourteen parishes of Jamaica performing reggae music. In 1996, he worked in Grand Cayman Island and in 1997 launched his own record label, Tennolitican Records. By 1998, he was producing albums for various artists. In 2000, Major Powell moved to the UK, where he remained active—singing at venues, including the Leicester Carnival, and continuing to produce for himself and other artists.</p>

            <p>
                Major Powell became well-known internationally for his musical talent, yet remained humble. He is regarded as one of the most respected artists in the music industry. Outside of music, he enjoyed spending time in his community—playing football and cricket, dancing, and helping those in need. Many younger artists sought his advice and received both encouragement and mentorship.
            </p>

            <p>
                After over two decades in the music industry, Major Powell committed to supporting up-and-coming talent, offering guidance and opportunities.
            </p>

            <p>
                He reflects with gratitude on his journey—from starting with no help, learning by observing, and sharpening his craft—to becoming one of the finest composers of his time.
            </p>
            <!-- <a class="back-link" href="/index.html">← Back to Blog</a> -->
            </div>
                </div>
        </section>


     
    @include('partials.frontend.newsletter')


@endsection
