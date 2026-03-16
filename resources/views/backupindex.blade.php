@extends('layouts.frontend.master')


@section('css')
@endsection

@section('content')



<div class="about-us">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <!-- About Image Start -->
                <div class="about-us-img">
                    <figure>
                        <img src="{{ asset($herosection->image ?? '') }}" alt="{{$herosection->heading ?? ''}}">
                    </figure>

                </div>
                <!-- <div class="about-content-body">

                        <div class="about-contact-box wow fadeInUp" data-wow-delay="0.8s">


                            <div class="about-contact-item">
                                <div class="icon-box">
                                    <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none" stroke="#0DBFFF" stroke-width="2"
                                      viewBox="0 0 24 24">
                                      <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" />
                                      <circle cx="12" cy="9" r="2.5" />
                                    </svg>
                                    </i>
                                </div>
                                <div class="about-contact-item-content">
                                    <p>Location</p>
                                    <h3>
                                      <a href="https://www.google.com/maps?q=Fort+McMurray+RPO+Plaza+11,+AB,+T9H+5B2,+CANADA" target="_blank">
                                        Fort McMurray RPO Plaza 11, AB, T9H 5B2 CANADA
                                      </a>
                                    </h3>
                                </div>
                            </div>

                        </div>

                </div> -->

            </div>
@php
    $words = explode(' ', $herosection->heading ?? '');
    $lastTwo = implode(' ', array_slice($words, -2));
    $firstPart = implode(' ', array_slice($words, 0, -2));
@endphp
            <div class="col-lg-6">
                <!-- About Us Content Start -->
                <div class="about-us-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <!-- <h3 class="wow fadeInUp">about us</h3> -->
                        <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque">{{ $firstPart ?? '' }} <span>{{ $lastTwo ?? '' }}</span></h2>
                        <p class="wow fadeInUp" data-wow-delay="0.4s"><span>{{$herosection->subheading ?? ''}}</span></p>
                        <p class="wow fadeInUp" data-wow-delay="0.6s">
  {!! $herosection->description ?? '' !!}

                        </p>

                    </div>
                    <!-- Section Title End -->

                    <div class="about-content-body">
                      <!-- About Contact Box Start -->
                      <div class="about-contact-box wow fadeInUp" data-wow-delay="0.8s">
                        <!-- About Contact Item Start -->
                        <div class="about-contact-item">
                          <div class="icon-box">
                            <img src="{{asset('FrontendAssets/images/iseeyouimages/icon-mail.svg')}}" alt="Email Icon">
                          </div>
                          <div class="about-contact-item-content">
                            <p>Email Us At</p>
                            <h3><a href="mailto:{{$herosection->email ?? ''}}">{{$herosection->email ?? ''}} </a></h3>
                          </div>
                        </div>
                        <!-- About Contact Item End -->

                        <!-- About Contact Item Start -->
                        <div class="about-contact-item">
                          <div class="icon-box">
                            <img src="{{asset('FrontendAssets/images/iseeyouimages/icon-phone.svg')}}" alt="Phone Icon">
                          </div>
                          <div class="about-contact-item-content">
                            <p>Phone Number</p>
                            <h3><a href="tel:{{$herosection->phone ?? ''}}">{{$herosection->phone ?? ''}}</a></h3>
                            <p>{{$herosection->phone_country ?? ''}}</p>
                          </div>
                        </div>
                        <!-- About Contact Item End -->
                        <div class="about-contact-item">
                          <div class="icon-box">
                            <i>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none" stroke="#0DBFFF" stroke-width="2"
                                                              viewBox="0 0 24 24">
                                                              <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" />
                                                              <circle cx="12" cy="9" r="2.5" />
                                                            </svg>
                                                            </i>
                          </div>
                          <div class="about-contact-item-content">
                            <p>Location</p>
                            <h3>
                              <a href="https://www.google.com/maps?q=Fort+McMurray+RPO+Plaza+11,+AB,+T9H+5B2,+CANADA" target="_blank">
                                {{$herosection->location ?? '' }}
                              </a>
                            </h3>
                          </div>
                        </div>
                      </div>
                      <!-- About Contact Box End -->

                      <!-- About Experience Box Start -->
                      <!-- <div class="about-experience-box">
                        <div class="about-experience-counter">
                          <h2><span class="counter">12</span>+</h2>
                          <p>years experience</p>
                        </div>

                      </div>-->
                      <!-- About Experience Box End -->
                    </div>
                <!-- About Us Content End -->
            </div>
        </div>
    </div>
</div>
        <!-- About Us Section End -->

    <!-- Scrolling Ticker Section Start -->

    <!-- Scrolling Ticker Section End -->




    <!-- Our Specialization Section Start -->

    <!-- Our Specialization Section End -->



    <!-- Our Facts Section Start -->
<!--<div class="our-facts">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <div class="our-facts-box">

                    <div class="our-facts-content">

                        <div class="section-title">
                            <h3 class="wow fadeInUp">Our Impact</h3>
                            <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque">Numbers that <span>tell our story</span></h2>
                        </div>

                        <div class="facts-counter-box">

                            <div class="facts-counter-item">
                                <h2>+<span class="counter">150</span></h2>
                                <p>Artists supported worldwide</p>
                            </div>

                            <div class="facts-counter-item">
                                <h2>+<span class="counter">30</span></h2>
                                <p>Scholarship programs delivered</p>
                            </div>

                            <div class="facts-counter-item">
                                <h2>+<span class="counter">20</span></h2>
                                <p>Global industry partners</p>
                            </div>

                            <div class="facts-counter-item">
                                <h2>+<span class="counter">50</span>K</h2>
                                <p>Streaming & media views</p>
                            </div>

                        </div>

                    </div>



                    <div class="our-facts-list">

                        <div class="facts-list-item wow fadeInUp">
                            <p><span>Artist Development:</span> We provide opportunities for dancers, musicians, models, and choreographers to showcase their talent on a global stage through live events, media, and partnerships.</p>
                        </div>

                        <div class="facts-list-item wow fadeInUp" data-wow-delay="0.25s">
                            <p><span>Scholarships & Access:</span> Through "Out of the Deposit" and I See You, we help schools and students set up direct deposits to participate in scholarships, submit work, and join professional productions worldwide.</p>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div> -->

    <!-- Our Facts Section End -->

    <!--<div class="viideroseccontainer">

        <section class="viiderosecvideo-section" id="section1">
        <video class="viiderosecvideo-background" autoplay muted loop>
            <source src="./images/iseeyouimages/Snippet 1.mp4" type="video/mp4">
        </video>
        <div class="dance-overlay"></div>

        <div class="videosecparticles" id="videosecparticles1"></div>

        <div class="floating-elements">
            <div class="floating-note"><i class="fas fa-music"></i></div>
            <div class="floating-note"><i class="fas fa-heart"></i></div>
            <div class="floating-note"><i class="fas fa-star"></i></div>
            <div class="floating-note"><i class="fas fa-peace"></i></div>
            <div class="floating-note"><i class="fas fa-microphone"></i></div>
            <div class="floating-note"><i class="fas fa-sparkles"></i></div>
        </div>

        <div class="content-wrapper">
            <div class="content-left">
            <div class="icon-orbit"></div>
            <div class="section-badge">
                <i class="fas fa-spa"></i> Wellness & Support
            </div>
            <h2 class="viiderosecsection-title">Empowering Artists with Wellness</h2>

            <p class="section-content">
                Our mission is to support every dancer and artist on their personal and professional journey. With a $6 monthly membership, gain access to over 100 wellness services including yoga, physiotherapy, nutrition advice, chiropractic care, acupuncture, and more. Scholarships and funding opportunities are also available to ensure your success and well-being.
            </p>
            <a href="#" class="cta-button">
                <i class="fas fa-rocket"></i> Join Our Community
            </a>

            <div class="performance-stats">
                <div class="stat-item">
                <span class="stat-number">$6</span>
                <span class="stat-label">Monthly</span>
                </div>
                <div class="stat-item">
                <span class="stat-number">100+</span>
                <span class="stat-label">Services</span>
                </div>
                <div class="stat-item">
                <span class="stat-number">24/7</span>
                <span class="stat-label">Support</span>
                </div>
            </div>
            </div>
        </div>
        </section>


        <section class="viiderosecvideo-section" id="section2">
        <video class="viiderosecvideo-background" autoplay muted loop>
            <source src="./images/iseeyouimages/Snippet 2.mp4" type="video/mp4">
        </video>
        <div class="dance-overlay"></div>

        <div class="videosecparticles" id="videosecparticles2"></div>

        <div class="floating-elements">
            <div class="floating-note"><i class="fas fa-music"></i></div>
            <div class="floating-note"><i class="fas fa-music"></i></div>
            <div class="floating-note"><i class="fas fa-trophy"></i></div>
            <div class="floating-note"><i class="fas fa-theater-masks"></i></div>
            <div class="floating-note"><i class="fas fa-microphone"></i></div>
            <div class="floating-note"><i class="fas fa-crown"></i></div>
        </div>

        <div class="content-wrapper">
            <div class="content-left">
            <div class="icon-orbit"></div>
            <div class="section-badge">
                <i class="fas fa-globe-americas"></i> Global Network
            </div>
            <h2 class="viiderosecsection-title">Connect with Artists Worldwide</h2>
            <p class="section-content">
                Be part of a truly global creative network with I See You and G.A.T.S.. We host events around the world, bringing together dancers, musicians, singers, choreographers, models, and fashion talent. From intimate showcases to major stadium tours, we provide the platform for your art to shine on an international stage.
            </p>
            <a href="#" class="cta-button">
                <i class="fas fa-expand-arrows-alt"></i> Explore Opportunities
            </a>

            <div class="performance-stats">
                <div class="stat-item">
                <span class="stat-number">50+</span>
                <span class="stat-label">Countries</span>
                </div>
                <div class="stat-item">
                <span class="stat-number">1000+</span>
                <span class="stat-label">Artists</span>
                </div>
                <div class="stat-item">
                <span class="stat-number">200+</span>
                <span class="stat-label">Events</span>
                </div>
            </div>
            </div>
        </div>
        </section>


        <section class="viiderosecvideo-section" id="section3">
        <video class="viiderosecvideo-background" autoplay muted loop>
            <source src="./images/iseeyouimages/Snippet 3.mp4" type="video/mp4">
        </video>
        <div class="dance-overlay"></div>

        <div class="videosecparticles" id="videosecparticles3"></div>

        <div class="floating-elements">
            <div class="icon-orbit"></div>
            <div class="floating-note"><i class="fas fa-video"></i></div>
            <div class="floating-note"><i class="fas fa-music"></i></div>
            <div class="floating-note"><i class="fas fa-film"></i></div>
            <div class="floating-note"><i class="fas fa-camera"></i></div>
            <div class="floating-note"><i class="fas fa-music"></i></div>
            <div class="floating-note"><i class="fas fa-satellite-dish"></i></div>
        </div>

        <div class="content-wrapper">
            <div class="content-left">
            <div class="section-badge">
                <i class="fas fa-play-circle"></i> Media Production
            </div>
            <h2 class="viiderosecsection-title">Showcase Your Talent Globally</h2>
            <p class="section-content">
                Our media production team helps you create professional-quality video and audio content, from documentaries to live performances. Through partnerships with Rogers Media and other leading broadcasters, your work can reach millions. We also collaborate with top advertising brands to amplify your message and grow your career.
            </p>
            <a href="#" class="cta-button">
                <i class="fas fa-play"></i> Start Creating
            </a>

            <div class="performance-stats">
                <div class="stat-item">
                <span class="stat-number">10M+</span>
                <span class="stat-label">Viewers</span>
                </div>
                <div class="stat-item">
                <span class="stat-number">500+</span>
                <span class="stat-label">Productions</span>
                </div>
                <div class="stat-item">
                <span class="stat-number">24/7</span>
                <span class="stat-label">Broadcasting</span>
                </div>
            </div>
            </div>
        </div>
        </section>

    </div> -->

    <section class="iseeyoubody">
      <div class="iseeyou-hero-container">
        <!-- Dancing Background -->
        <div class="iseeyou-dancing-bg">
          <div class="iseeyou-dance-particle"><i class="fas fa-music"></i></div>
          <div class="iseeyou-dance-particle"><i class="fas fa-heart"></i></div>
          <div class="iseeyou-dance-particle"><i class="fas fa-star"></i></div>
          <div class="iseeyou-dance-particle"><i class="fas fa-fire"></i></div>
          <div class="iseeyou-dance-particle"><i class="fas fa-bolt"></i></div>
          <div class="iseeyou-dance-particle"><i class="fas fa-gem"></i></div>
        </div>

        <!-- Floating Orbs -->
        <div class="iseeyou-floating-orbs">
          <div class="iseeyou-orb"></div>
          <div class="iseeyou-orb"></div>
          <div class="iseeyou-orb"></div>
          <div class="iseeyou-orb"></div>
        </div>

        <!-- Main Content -->
        <div class="iseeyou-main-wrapper">
          <!-- Video Section -->
          <div class="iseeyou-video-section" >
            <div class="iseeyou-video-container">
              <video class="iseeyou-video-player" id="mainVideo1" muted>
                <source src="{{ asset($iseeyousection->video ?? '') }}" type="video/mp4">
                Your browser does not support the video tag.
              </video>

              <!-- Video Overlay -->
              <div class="iseeyou-video-overlay" id="videoOverlay">
                <button class="iseeyou-play-button" id="playButton1">
                                    <i class="fas fa-play"></i>
                                </button>
              </div>

              <!-- Custom Video Controls -->
              <div class="iseeyou-video-controls">
                <div class="iseeyou-controls-row">
                  <button class="iseeyou-control-btn" id="playPauseBtn">
                                        <i class="fas fa-play"></i>
                                    </button>
                  <div class="iseeyou-progress-container" id="progressContainer">
                    <div class="iseeyou-progress-bar" id="progressBar1"></div>
                  </div>
                  <div class="iseeyou-time-display" id="timeDisplay1">0:00 / 0:00</div>
                </div>
                <div class="iseeyou-controls-row">
                  <div class="iseeyou-volume-container">
                    <button class="iseeyou-control-btn" id="muteBtn">
                                            <i class="fas fa-volume-up"></i>
                                        </button>
                    <input type="range" class="iseeyou-volume-slider" id="volumeSlider1" min="0" max="1" step="0.1" value="0.5">
                  </div>
                  <button class="iseeyou-control-btn" id="fullscreenBtn1">
                                        <i class="fas fa-expand"></i>
                                    </button>
                </div>
              </div>
            </div>

            <div class="iseeyou-talent-card">
              <i class="fas fa-crown iseeyou-talent-icon"></i>
              <span>Global Artist Talent Show</span>
            </div>
          </div>

          <!-- Content Section -->
          <div class="iseeyou-content-section">
            <h2 class="iseeyou-main-title">{{$iseeyousection->heading ?? ''}}</h2>
            <p class="iseeyou-description">
              {!! $iseeyousection->description ?? '' !!}
            </p>

            <a href="#" class="iseeyou-feature-link">
              <i class="fas fa-video"></i>
              Watch: Building Your Dance Career
            </a>

            <button class="iseeyou-cta-button">
                          {{$iseeyousection->button_text ?? ''}}
                            <i class="fas fa-arrow-right"></i>
                        </button>
          </div>
        </div>
      </div>
    </section>

<div class="format-main-container">
  <!-- Animated Background -->
  <div class="format-animated-background"></div>

  <!-- Floating Particles -->
  <div class="format-floating-particles">
    <div class="format-particle"></div>
    <div class="format-particle"></div>
    <div class="format-particle"></div>
    <div class="format-particle"></div>
    <div class="format-particle"></div>
    <div class="format-particle"></div>
    <div class="format-particle"></div>
    <div class="format-particle"></div>
    <div class="format-particle"></div>
  </div>

  <div class="format-content-wrapper">
    <!-- Section 1 -->
    <!-- <div class="format-feature-section">
        <div class="format-text-content">
          <h2 class="format-main-title">Partnership with Schools and Arts Studies</h2>
          <p class="format-description">
            I See You and G.A.T.S. (Global Artists Talent Show) can support students in their careers with a membership of $6 per month. This support includes a wide range of wellness offerings, such as yoga, physiotherapy, nutritional guidance, chiropractic care, acupuncture, and more. We also provide scholarships and funding to help dancers thrive both personally and professionally.
          </p>

              <button class="third-video-btn" id="format-new" title="Watch Another Video">
                <i class="fa-solid fa-play"></i>
              </button>


              <div class="video-modal" id="videoModal3">
                <div class="video-container">
                  <button class="close-video" id="closeVideo3">
                    <i class="fas fa-times"></i>
                  </button>
                  <video id="thirdVideo" autoplay controls muted>
                    <source src="images/iseeyouimages/Snippet 3.mp4" type="video/mp4" />
                    Your browser does not support the video tag.
                  </video>
                </div>
              </div>
        </div>

        <div class="format-image-container">
          <div class="format-seo-mockup">
            <div class="format-search-overlay">
              <div class="format-artist-images">
                <img src="./images/iseeyouimages/dancer02.png" alt="">
              </div>
              <div class="format-search-results">
                <div class="format-result-title">Partnership with Schools and Arts Studies</div>
                <div class="format-result-description">
                  I See You and G.A.T.S. (Global Artists Talent Show) can support students in their careers with a membership of $6 per month. This includes wellness offerings such as yoga, physiotherapy, nutritional guidance, chiropractic care, acupuncture, and more. We also provide scholarships and funding to help dancers thrive both personally and professionally.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> -->

    <div class="format-feature-section">
      <div class="format-text-content">
        <h2 class="format-main-title">{{$partnershipsection->heading ?? ''}}</h2>
        <p class="format-description">
          {!! $partnershipsection->description ?? '' !!}
        </p>
      </div>

      <div class="format-image-container">
        <div class="format-video-player">

          <div class="format-video-container">
            <div class="isyVideo-player">
              <div class="iseeyou-video-container">
                <video class="iseeyou-video-player" muted>
                  <source src="{{$partnershipsection->video ?? ''}}" type="video/mp4">
                  Your browser does not support the video tag.
                </video>

                <!-- Video Overlay -->
                <div class="iseeyou-video-overlay">
                  <button class="iseeyou-play-button">
        <i class="fas fa-play"></i>
      </button>
                </div>

                <!-- Custom Video Controls -->
                <div class="iseeyou-video-controls">
                  <div class="iseeyou-controls-row">
                    <button class="iseeyou-control-btn playPauseBtn">
          <i class="fas fa-play"></i>
        </button>
                    <div class="iseeyou-progress-container">
                      <div class="iseeyou-progress-bar"></div>
                    </div>
                    <div class="iseeyou-time-display">0:00 / 0:00</div>
                  </div>
                  <div class="iseeyou-controls-row">
                    <div class="iseeyou-volume-container">
                      <button class="iseeyou-control-btn muteBtn">
            <i class="fas fa-volume-up"></i>
          </button>
                      <input type="range" class="iseeyou-volume-slider" min="0" max="1" step="0.1" value="0.5">
                    </div>
                    <button class="iseeyou-control-btn fullscreenBtn">
          <i class="fas fa-expand"></i>
        </button>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="format-video-controls">
            <button class="format-play-button" id="playPauseBtn">
                <i class="fas fa-play"></i>
              </button>
            <div class="format-progress-bar" id="progressBar">
              <div class="format-progress-fill" id="progressFill"></div>
            </div>
            <div class="format-time-display" id="timeDisplay">0:00 / 0:00</div>
            <div class="format-volume-control">
              <button class="format-volume-button" id="volumeBtn">
                  <i class="fas fa-volume-up"></i>
                </button>
              <input type="range" class="format-volume-slider" id="volumeSlider" min="0" max="100" value="50">
            </div>
            <button class="format-fullscreen-button" id="fullscreenBtn">
                <i class="fas fa-expand"></i>
              </button>
          </div>
        </div>
      </div>
      <img src="{{asset('FrontendAssets/images/iseeyouimages/Dance 3.gif')}}"  class="gift-set" alt="">
    </div>

    <!-- Section 2 -->
    <!-- <div class="format-feature-section format-reverse">
      <div class="format-text-content">
        <h2 class="format-main-title">Supporting Events and Productions Worldwide</h2>
        <p class="format-description">
          When you work with I See You and G.A.T.S., you're joining a network that supports events across the country and around the
          world, collaborating with dancers, choreographers, musicians, singers, models, and fashion
          professionals. We aim to produce large-scale shows in big arenas, stadiums, and other grand venues,
          helping artists reach the pinnacle of their careers.
        </p>
        <p class="format-description">
          We also offer radio and video production, including documentary work and series in partnership with Rogers Media, and we
          broadcast productions from I See You Dance and G.A.T.S. Global Artists Talent Show. In addition, we work with the biggest
          companies for advertising, so we can build and grow our corporation together.
        </p>
      </div>

      <div class="format-image-container">
        <div class="format-seo-mockup">
          <div class="format-search-overlay">
            <div class="format-artist-images">
              <img src="./images/iseeyouimages/dancer01.png" alt="">
            </div>
            <div class="format-search-results">
              <div class="format-result-title">Supporting Events and Productions Worldwide</div>
              <div class="format-result-description">
                When you work with I See You and G.A.T.S., you're joining a network that supports events across the country
                and around the world, collaborating with dancers, choreographers, musicians, singers, and fashion
                professionals. We aim to produce large-scale shows in big arenas, stadiums, and other grand venues,
                helping artists reach the pinnacle of their careers. We also offer radio and video production, including
                documentary work and series in partnership with Rogers Media, and we broadcast productions from I See You
                Dance.
              </div>
            </div>
          </div>
        </div>
      </div>

      <img src="./images/iseeyouimages/Dance 3.gif"  class="gift-set" alt="">
    </div> -->
  </div>
</div>



    <div class="dance-popup-overlay" id="dancePopupOverlay">
        <div class="dance-popup-container">
            <div class="dance-popup-header">
                <h3 class="dance-popup-title">
                    <i class="fas fa-music"></i>
                    Join SingWithMe.
                </h3>
                <button class="dance-close-btn" onclick="closeDancePopup()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="dance-form-tabs">
                <button class="dance-tab-btn dance-active" onclick="showDanceSignupForm()">
                    <i class="fas fa-user-plus"></i>
                    Sign Up
                </button>
                <button class="dance-tab-btn" onclick="showDanceLoginForm()">
                    <i class="fas fa-sign-in-alt"></i>
                    Login
                </button>
            </div>

            <div id="danceSignupForm">
                <div class="dance-user-type-tabs">
                    <button class="dance-user-type-btn dance-active" onclick="selectDanceUserType('individual', event)">
                        <i class="fas fa-user"></i>
                        Individual
                    </button>
                    <button class="dance-user-type-btn" onclick="selectDanceUserType('company', event)">
                        <i class="fas fa-building"></i>
                        Company
                    </button>
                </div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form id="danceIndividualForm" class="dance-user-form" method="POST" action="{{ route('register.attempt') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="dance-form-group">
                        <label for="danceFirstName">
                            <i class="fas fa-user"></i>
                            First Name
                        </label>
                        <input type="text" id="danceFirstName" name="first_name" placeholder="Enter your first name" required>
                    </div>
                    <div class="dance-form-group">
                        <label for="danceLastName">
                            <i class="fas fa-user"></i>
                            Last Name
                        </label>
                        <input type="text" id="danceLastName" name="last_name" placeholder="Enter your last name" required>
                    </div>
                    <div class="dance-form-group">
                        <label for="danceEmail">
                            <i class="fas fa-envelope"></i>
                            Email Address
                        </label>
                        <input type="email" id="danceEmail" name="email" placeholder="Enter your email address" required>
                    </div>
                    <div class="dance-form-group">
                        <label for="dancePhone">
                            <i class="fas fa-phone"></i>
                            Phone Number
                        </label>
                        <input type="tel" id="dancePhone" name="phone" placeholder="Enter your phone number" required>
                    </div>
                    <div class="dance-form-group">
                        <label for="danceDanceStyle">
                            <i class="fas fa-music"></i>
                            Dance Style
                        </label>

                        <select id="danceDanceStyle" name="dance_style" required>
                            <option value="">Select your primary dance style</option>
                            <option value="classical-ballet">Classical Ballet</option>
                            <option value="contemporary-dance">Contemporary Dance</option>
                            <option value="folk-dance">Folk Dance</option>
                            <option value="urban-dance">Urban Dance</option>
                            <option value="jazz-dance">Jazz Dance</option>
                            <option value="salsa">Salsa</option>
                            <option value="bachata">Bachata</option>
                            <option value="merengue">Merengue</option>
                            <option value="mambo">Mambo</option>
                            <option value="cha-cha-cha">Cha Cha Cha</option>
                            <option value="rumba">Rumba</option>
                            <option value="tango">Tango</option>
                            <option value="waltz">Waltz</option>
                            <option value="swing">Swing</option>
                            <option value="lindy-hop">Lindy Hop</option>
                            <option value="charleston">Charleston</option>
                            <option value="blues">Blues</option>
                            <option value="rock-and-roll">Rock and Roll</option>
                            <option value="jive">Jive</option>
                            <option value="foxtrot">Foxtrot</option>
                            <option value="quickstep">Quickstep</option>
                            <option value="paso-doble">Paso Doble</option>
                            <option value="country-line-dance">Country Line Dance</option>
                            <option value="classical-indian-dance">Classical Indian Dance</option>
                            <option value="tap-dance">Tap Dance</option>
                            <option value="flamenco">Flamenco</option>
                            <option value="contemporary-ballet">Contemporary Ballet</option>
                            <option value="neoclassical-ballet">Neoclassical Ballet</option>
                            <option value="capoeira">Capoeira</option>
                            <option value="belly-dance">Belly Dance</option>
                            <option value="african-dance">African Dance</option>
                            <option value="hula">Hula</option>
                            <option value="krumping">Krumping</option>
                            <option value="krump">Krump</option>
                            <option value="breakdance">Breakdance / Breaking</option>
                            <option value="waacking">Waacking</option>
                            <option value="butoh">Butoh</option>
                            <option value="bhangra">Bhangra</option>
                            <option value="arabic-dance">Arabic Dance (K-Arab)</option>
                            <option value="kathak">Kathak</option>
                            <option value="bharatanatyam">Bharatanatyam</option>
                            <option value="odissi">Odissi</option>
                            <option value="uyghur-dance">Uyghur Dance</option>
                            <option value="persian-dance">Persian Dance</option>
                            <option value="uzbek-dance">Uzbek Dance</option>
                            <option value="sufi-dance">Sufi Dance</option>
                            <option value="maori-dance">Māori Dance</option>
                            <option value="fire-dance">Fire Dance</option>
                            <option value="tahitian-dance">Tahitian Dance</option>
                            <option value="gumboot-dance">Gumboot Dance</option>
                            <option value="zouk">Zouk</option>
                            <option value="kizomba">Kizomba</option>
                            <option value="forro">Forró</option>
                            <option value="lambada">Lambada</option>
                            <option value="milonga">Milonga</option>
                            <option value="cumbia">Cumbia</option>
                            <option value="reggaeton">Reggaeton</option>
                            <option value="samba">Samba</option>
                            <option value="cuban-son">Cuban Son</option>
                            <option value="bolero">Bolero</option>
                            <option value="acrobatic-dance">Acrobatic Dance</option>
                            <option value="highlife">Highlife</option>
                            <option value="juju">Jùjú</option>
                            <option value="semba">Semba</option>
                            <option value="axe">Axé</option>
                            <option value="maracatu">Maracatu</option>
                            <option value="frevo">Frevo</option>
                            <option value="baiao">Baião</option>
                            <option value="carimbo">Carimbó</option>
                            <option value="samba-de-gafieira">Samba de Gafieira</option>
                            <option value="maculele">Maculelê</option>
                            <option value="dance-of-saint-vitus">Dance of Saint Vitus (Danza de San Vito)</option>
                            <option value="rain-dance">Rain Dance</option>
                            <option value="sun-dance">Sun Dance</option>
                            <option value="snake-dance">Snake Dance</option>
                            <option value="k-pop">K-pop</option>
                            <option value="bollywood">Bollywood</option>
                            <option value="twerking">Twerking</option>
                            <option value="pole-dance">Pole Dance</option>
                            <option value="dancehall">Dancehall</option>
                            <option value="hip-hop-era">Hip-hop Era</option>
                            <option value="reggae">Reggae</option>
                            <option value="ska">Ska</option>
                            <option value="calypso">Calypso</option>
                            <option value="afrobeat">Afrobeat</option>
                            <option value="afrohouse">Afrohouse</option>
                            <option value="afrofusion">Afrofusion</option>
                            <option value="gwara-gwara">Gwara Gwara</option>
                            <option value="shaku-shaku">Shaku Shaku</option>
                            <option value="azonto">Azonto</option>
                            <option value="makossa">Makossa</option>
                            <option value="kuduro">Kuduro</option>
                            <option value="mapouka">Mapouka</option>
                            <option value="dandiya-raas">Dandiya Raas</option>
                            <option value="garba-raas">Garba Raas</option>

                        </select>
                    </div>


                      <div class="dance-form-group">
                        <label for="dancePicture">
                                                  <i class="fas fa-image"></i>
                                                  Upload Your Picture
                                              </label>
                        <input type="file" id="dancePicture" name="picture" accept="image/*">
                      </div>


                      <div class="dance-form-group">
                        <label for="danceVideo">
                                                  <i class="fas fa-video"></i>
                                                  Upload Dance Video
                                              </label>
                        <input type="file" id="danceVideo" name="dance_video" accept="video/*">
                      </div>


                      <div class="dance-form-group">
                        <label for="danceReview">
                                                  <i class="fas fa-comment-alt"></i>
                                                  Tell us about you
                                              </label>
                        <textarea id="danceReview" name="about" rows="4" placeholder="Tell us about you.."></textarea>
                      </div>
                    <div class="dance-form-group">
                        <label for="dancePassword">
                            <i class="fas fa-lock"></i>
                            Password
                        </label>
                        <input type="password" id="dancePassword" name="password" placeholder="Create a secure password" required>
                    </div>
                    <div class="dance-form-group">
                        <label for="dancePasswordConfirm">
                            <i class="fas fa-lock"></i>
                            Confirm Password
                        </label>
                        <input type="password" id="dancePasswordConfirm" name="password_confirmation" placeholder="Confirm your password" required>
                    </div>
                    <button type="submit" class="dance-submit-btn">
                        <i class="fas fa-user-plus"></i>
                        Create Individual Account
                    </button>
                </form>

<form id="danceCompanyForm" class="dance-user-form" method="POST" action="{{ route('register.attempt') }}" enctype="multipart/form-data" style="display: none;">
                    @csrf
                    <div class="dance-form-group">
                        <label for="danceCompanyName">
                            <i class="fas fa-building"></i>
                            Company Name
                        </label>
                        <input type="text" id="danceCompanyName" name="company_name" placeholder="Enter your company name" required>
                    </div>
                    <div class="dance-form-group">
                        <label for="danceCompanyEmail">
                            <i class="fas fa-envelope"></i>
                            Company Email
                        </label>
                        <input type="email" id="danceCompanyEmail" name="email" placeholder="Enter company email address" required>
                    </div>
                    <div class="dance-form-group">
                        <label for="danceContactPerson">
                            <i class="fas fa-user-tie"></i>
                            Contact Person
                        </label>
                        <input type="text" id="danceContactPerson" name="contact_person" placeholder="Enter contact person name" required>
                    </div>
                    <div class="dance-form-group">
                        <label for="danceCompanyPhone">
                            <i class="fas fa-phone"></i>
                            Company Phone
                        </label>
                        <input type="tel" id="danceCompanyPhone" name="company_phone" placeholder="Enter company phone number" required>
                    </div>
                    <div class="dance-form-group">
                        <label for="danceCompanyType">
                            <i class="fas fa-tags"></i>
                            Company Type
                        </label>
                        <select id="danceCompanyType" name="company_type" required>
                            <option value="">Select company type</option>
                            <option value="dance-studio">Dance Studio</option>
                            <option value="dance-company">Dance Company</option>
                            <option value="production-company">Production Company</option>
                            <option value="talent-agency">Talent Agency</option>
                            <option value="event-organizer">Event Organizer</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="dance-form-group">
                      <label for="dancePicture">
                            <i class="fas fa-image"></i>
                            Upload Your Picture
                        </label>
                      <input type="file" id="dancePicture" name="picture" accept="image/*">
                    </div>

                    <div class="dance-form-group">
                      <label for="danceVideo">
                            <i class="fas fa-video"></i>
                            Upload Dance Video
                        </label>
                      <input type="file" id="danceVideo" name="dance_video" accept="video/*">
                    </div>



                    <div class="dance-form-group">
                      <label for="danceDanceStyle">
                                                <i class="fas fa-music"></i>
                                                Dance Style
                                            </label>
                      <select id="danceDanceStyletwo" name="dance_style" required>
                                                <option value="">Select your primary dance style</option>
                                                <option value="classical-ballet">Classical Ballet</option>
                                                <option value="contemporary-dance">Contemporary Dance</option>
                                                <option value="folk-dance">Folk Dance</option>
                                                <option value="urban-dance">Urban Dance</option>
                                                <option value="jazz-dance">Jazz Dance</option>
                                                <option value="salsa">Salsa</option>
                                                <option value="bachata">Bachata</option>
                                                <option value="merengue">Merengue</option>
                                                <option value="mambo">Mambo</option>
                                                <option value="cha-cha-cha">Cha Cha Cha</option>
                                                <option value="rumba">Rumba</option>
                                                <option value="tango">Tango</option>
                                                <option value="waltz">Waltz</option>
                                                <option value="swing">Swing</option>
                                                <option value="lindy-hop">Lindy Hop</option>
                                                <option value="charleston">Charleston</option>
                                                <option value="blues">Blues</option>
                                                <option value="rock-and-roll">Rock and Roll</option>
                                                <option value="jive">Jive</option>
                                                <option value="foxtrot">Foxtrot</option>
                                                <option value="quickstep">Quickstep</option>
                                                <option value="paso-doble">Paso Doble</option>
                                                <option value="country-line-dance">Country Line Dance</option>
                                                <option value="classical-indian-dance">Classical Indian Dance</option>
                                                <option value="tap-dance">Tap Dance</option>
                                                <option value="flamenco">Flamenco</option>
                                                <option value="contemporary-ballet">Contemporary Ballet</option>
                                                <option value="neoclassical-ballet">Neoclassical Ballet</option>
                                                <option value="capoeira">Capoeira</option>
                                                <option value="belly-dance">Belly Dance</option>
                                                <option value="african-dance">African Dance</option>
                                                <option value="hula">Hula</option>
                                                <option value="krumping">Krumping</option>
                                                <option value="krump">Krump</option>
                                                <option value="breakdance">Breakdance / Breaking</option>
                                                <option value="waacking">Waacking</option>
                                                <option value="butoh">Butoh</option>
                                                <option value="bhangra">Bhangra</option>
                                                <option value="arabic-dance">Arabic Dance (K-Arab)</option>
                                                <option value="kathak">Kathak</option>
                                                <option value="bharatanatyam">Bharatanatyam</option>
                                                <option value="odissi">Odissi</option>
                                                <option value="uyghur-dance">Uyghur Dance</option>
                                                <option value="persian-dance">Persian Dance</option>
                                                <option value="uzbek-dance">Uzbek Dance</option>
                                                <option value="sufi-dance">Sufi Dance</option>
                                                <option value="maori-dance">Māori Dance</option>
                                                <option value="fire-dance">Fire Dance</option>
                                                <option value="tahitian-dance">Tahitian Dance</option>
                                                <option value="gumboot-dance">Gumboot Dance</option>
                                                <option value="zouk">Zouk</option>
                                                <option value="kizomba">Kizomba</option>
                                                <option value="forro">Forró</option>
                                                <option value="lambada">Lambada</option>
                                                <option value="milonga">Milonga</option>
                                                <option value="cumbia">Cumbia</option>
                                                <option value="reggaeton">Reggaeton</option>
                                                <option value="samba">Samba</option>
                                                <option value="cuban-son">Cuban Son</option>
                                                <option value="bolero">Bolero</option>
                                                <option value="acrobatic-dance">Acrobatic Dance</option>
                                                <option value="highlife">Highlife</option>
                                                <option value="juju">Jùjú</option>
                                                <option value="semba">Semba</option>
                                                <option value="axe">Axé</option>
                                                <option value="maracatu">Maracatu</option>
                                                <option value="frevo">Frevo</option>
                                                <option value="baiao">Baião</option>
                                                <option value="carimbo">Carimbó</option>
                                                <option value="samba-de-gafieira">Samba de Gafieira</option>
                                                <option value="maculele">Maculelê</option>
                                                <option value="dance-of-saint-vitus">Dance of Saint Vitus (Danza de San Vito)</option>
                                                <option value="rain-dance">Rain Dance</option>
                                                <option value="sun-dance">Sun Dance</option>
                                                <option value="snake-dance">Snake Dance</option>
                                                <option value="k-pop">K-pop</option>
                                                <option value="bollywood">Bollywood</option>
                                                <option value="twerking">Twerking</option>
                                                <option value="pole-dance">Pole Dance</option>
                                                <option value="dancehall">Dancehall</option>
                                                <option value="hip-hop-era">Hip-hop Era</option>
                                                <option value="reggae">Reggae</option>
                                                <option value="ska">Ska</option>
                                                <option value="calypso">Calypso</option>
                                                <option value="afrobeat">Afrobeat</option>
                                                <option value="afrohouse">Afrohouse</option>
                                                <option value="afrofusion">Afrofusion</option>
                                                <option value="gwara-gwara">Gwara Gwara</option>
                                                <option value="shaku-shaku">Shaku Shaku</option>
                                                <option value="azonto">Azonto</option>
                                                <option value="makossa">Makossa</option>
                                                <option value="kuduro">Kuduro</option>
                                                <option value="mapouka">Mapouka</option>
                                                <option value="dandiya-raas">Dandiya Raas</option>
                                                <option value="garba-raas">Garba Raas</option>

                                            </select>
                    </div>

                    <div class="dance-form-group">
                        <label for="danceCompanySize">
                            <i class="fas fa-users"></i>
                            Company Size
                        </label>
                        <select id="danceCompanySize" name="company_size" required>
                            <option value="">Select company size</option>
                            <option value="1-10">1-10 employees</option>
                            <option value="11-50">11-50 employees</option>
                            <option value="51-200">51-200 employees</option>
                            <option value="200+">200+ employees</option>
                        </select>
                    </div>
                    <div class="dance-form-group">
                      <label for="danceReview">
                            <i class="fas fa-comment-alt"></i>
                            Tell us about you
                        </label>
                      <textarea id="danceReview" name="about" rows="4" placeholder="Tell us about you.."></textarea>
                    </div>
                    <div class="dance-form-group">
                        <label for="danceCompanyPassword">
                            <i class="fas fa-lock"></i>
                            Password
                        </label>
                        <input type="password" id="danceCompanyPassword" name="password" placeholder="Create a secure password" required>
                    </div>
                    <div class="dance-form-group">
                        <label for="danceCompanyPasswordConfirm">
                            <i class="fas fa-lock"></i>
                            Confirm Password
                        </label>
                        <input type="password" id="danceCompanyPasswordConfirm" name="password_confirmation" placeholder="Confirm your password" required>
                    </div>
                    <button type="submit" class="dance-submit-btn">
                        <i class="fas fa-building"></i>
                        Create Company Account
                    </button>
                </form>
            </div>

            <div id="danceLoginForm" style="display: none;">
                <form id="danceLoginFormElement" method="POST" action="{{ route('login.attempt') }}">
                    @csrf
                    <div class="dance-form-group">
                        <label for="danceLoginEmail">
                            <i class="fas fa-envelope"></i>
                            Email or Username
                        </label>
                        <input type="text" id="danceLoginEmail" name="email_username" placeholder="Enter your email or username" required>
                    </div>
                    <div class="dance-form-group">
                        <label for="danceLoginPassword">
                            <i class="fas fa-lock"></i>
                            Password
                        </label>
                        <input type="password" id="danceLoginPassword" name="password" placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="dance-submit-btn">
                        <i class="fas fa-sign-in-alt"></i>
                        Login to Account
                    </button>
                </form>
            </div>

            <div class="dance-success-message" id="danceSuccessMessage">
                <div class="dance-success-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3 style="color: var(--accent-color); margin-bottom: 20px; font-size: 1.5rem;">
                    Welcome to the Dance Community! 🎭
                </h3>
                <p style="position: relative; z-index: 2;">
                    Thank you for signing up! From this moment on, you are now eligible to receive partnerships, scholarships, and other benefits from I See You and G.A.T.S. You're taking the first step towards a future full of opportunities and growth in the artistic world.
                </p>
            </div>
        </div>
    </div>

<section class="futuristic-vision-wrapper">
  <div class="vision-bg-overlay"></div>
  <div class="vision-ambient-glow"></div>

  <div class="vision-neural-network" id="neuralNetwork"></div>

  <div class="vision-content-container">
    <div class="vision-inner-content">
      <div class="vision-badge">Our Vision</div>

      <!--<h1 class="vision-main-title">Empowering Artistic Dreams</h1>

      <h2 class="vision-subtitle">Through Global Collaboration & Support</h2>

      <p class="vision-description">
        We envision a world where artists everywhere have access to resources, wellness, funding, and global stages. By uniting talents through I See You and G.A.T.S., we aim to create opportunities, foster meaningful partnerships, and elevate creative expression worldwide.
      </p>

      <div class="vision-features-grid">
        <div class="vision-feature-card">
          <div class="vision-feature-icon">
            <i class="fas fa-hands-helping"></i>
          </div>
          <h3 class="vision-feature-title">Artist Support</h3>
          <p class="vision-feature-desc">
            Providing scholarships, wellness programs, and professional guidance to help artists thrive both personally and professionally.
          </p>
        </div>

        <div class="vision-feature-card">
          <div class="vision-feature-icon">
            <i class="fas fa-users"></i>
          </div>
          <h3 class="vision-feature-title">Global Collaboration</h3>
          <p class="vision-feature-desc">
            Connecting dancers, musicians, choreographers, and creatives around the world to produce large-scale shows and meaningful partnerships.
          </p>
        </div>

        <div class="vision-feature-card">
          <div class="vision-feature-icon">
            <i class="fas fa-film"></i>
          </div>
          <h3 class="vision-feature-title">Creative Innovation</h3>
          <p class="vision-feature-desc">
            Expanding our platform with live streaming, documentaries, and media partnerships to showcase artists and inspire audiences globally.
          </p>
        </div>
      </div>

      <div class="vision-cta-section">
        <a href="#" class="vision-cta-button">Join Our Vision</a>
      </div>-->
    </div>
  </div>
</section>

<section class="container promo-section-wrapper">
  <div class="promo-left-column">
    <div class="promo-geometric-shapes">
      <div class="promo-shape"></div>
      <div class="promo-shape"></div>
      <div class="promo-shape"></div>
    </div>

    <h2>{{$autodepositsection->heading ?? ''}}</h2>
    <!-- <p>
            With this vision, I See You and G.A.T.S. work hand in hand to create a lasting impact in the artistic industry, with the goal of developing our own platforms, where, through live streaming, we will present documentaries and showcase our artists, integrating I See You and G.A.T.S. in every step of the way.
        </p>-->
    <p>
      {!! $autodepositsection->description ?? '' !!}
    </p>
    <p>
      To make a deposit, you can use the email: <a
        href="mailto:{{$autodepositsection->deposit_email ?? ''}}">{{$autodepositsection->deposit_email ?? ''}}</a>.
    </p>
  </div>

  <!--<div class="promo-right-column">

    <div class="iseeyou-video-section" id="width-videosec">
      <div class="iseeyou-video-container">
        <video class="iseeyou-video-player" id="mainVideo1" muted>
          <source src="images/iseeyouimages/Snippet 3.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>


        <div class="iseeyou-video-overlay" id="videoOverlay">
          <button class="iseeyou-play-button" id="playButton1">
                                        <i class="fas fa-play"></i>
                                    </button>
        </div>


        <div class="iseeyou-video-controls">
          <div class="iseeyou-controls-row">
            <button class="iseeyou-control-btn" id="playPauseBtn">
                                            <i class="fas fa-play"></i>
                                        </button>
            <div class="iseeyou-progress-container" id="progressContainer">
              <div class="iseeyou-progress-bar" id="progressBar1"></div>
            </div>
            <div class="iseeyou-time-display" id="timeDisplay1">0:00 / 0:00</div>
          </div>
          <div class="iseeyou-controls-row">
            <div class="iseeyou-volume-container">
              <button class="iseeyou-control-btn" id="muteBtn">
                                                <i class="fas fa-volume-up"></i>
                                            </button>
              <input type="range" class="iseeyou-volume-slider" id="volumeSlider1" min="0" max="1" step="0.1" value="0.5">
            </div>
            <button class="iseeyou-control-btn" id="fullscreenBtn1">
                                            <i class="fas fa-expand"></i>
                                        </button>
          </div>
        </div>
      </div>

      <div class="iseeyou-talent-card">
        <i class="fas fa-crown iseeyou-talent-icon"></i>
        <span>Global Artist Talent Show</span>
      </div>
    </div>




    <div class="promo-image-grid">
      <div class="promo-grid-item"></div>
      <div class="promo-grid-item"></div>
      <div class="promo-grid-item"></div>
      <div class="promo-grid-item"></div>
      <div class="promo-grid-item"></div>
      <div class="promo-grid-item"></div>
      <div class="promo-grid-item"></div>
      <div class="promo-grid-item"></div>
      <div class="promo-grid-item"></div>
    </div>
  </div> -->
</section>

<div class="our-scrolling-ticker">
  <!-- Scrolling Ticker Start -->
  <div class="scrolling-ticker-box">
    <div class="scrolling-content">
      <span><img src="images/star-icon.svg" alt="">Artist Collaborations</span>
      <span><img src="images/star-icon.svg" alt="">Scholarship Programs</span>
      <span><img src="images/star-icon.svg" alt="">Radio Broadcasting</span>
      <span><img src="images/star-icon.svg" alt="">Live Events</span>
      <span><img src="images/star-icon.svg" alt="">Audiovisual Media</span>
      <span><img src="images/star-icon.svg" alt="">Global Partnerships</span>
      <span><img src="images/star-icon.svg" alt="">Choreography Support</span>
      <span><img src="images/star-icon.svg" alt="">Music Promotion</span>
      <span><img src="images/star-icon.svg" alt="">Model Management</span>
      <span><img src="images/star-icon.svg" alt="">Artist Development</span>
    </div>

    <div class="scrolling-content">
@foreach ($newsletters as $newsletter)

    <span><img src="{{asset('FrontendAssets/images/star-icon.svg')}}" alt="">{{$newsletter->title}}</span>
@endforeach


    </div>
  </div>
  <!-- Scrolling Ticker End -->
</div>

    <!-- Our Faqs Section Start -->
<div class="our-faqs">
  <div class="container">
    <div class="row section-row">
      <div class="col-lg-12">
        <!-- Section Title Start -->
        <div class="section-title section-title-center">
          <h3 class="wow fadeInUp">Frequently asked questions</h3>
          <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque">Need more info? here's what <span>you're looking for</span></h2>
        </div>
        <!-- Section Title End -->
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4">
        <!-- Faqs Content Start -->
        <div class="faqs-content wow fadeInUp" data-wow-delay="0.4s">
          <!-- Faqs CTA Box Start -->
          <div class="faq-cta-box">
            <div class="icon-box">
              <img src="images/iseeyouimages/dancing-new.png" alt="">
            </div>
            <div class="faq-cta-content">
              <h3>Still have questions? We're here to help!</h3>
              <p>Connect with our team and become part of a growing global movement.</p>
            </div>
            <div class="faq-cta-btn">
              <a href="#" class="btn-default">contact us now</a>
            </div>
          </div>
          <!-- Faqs CTA Box End -->
        </div>
        <!-- Faqs Content End -->
      </div>

      <div class="col-lg-8">
        <!-- FAQ Accordion Start -->
        <div class="faq-accordion" id="faqaccordion">
          <!-- FAQ Item Start -->

@foreach ($faqs as $faq)
<!-- FAQ Item Start -->
<div class="accordion-item wow fadeInUp" data-wow-delay="{{ $loop->iteration * 0.2 }}s">
  <h2 class="accordion-header" id="heading{{ $loop->iteration }}">
    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->iteration }}" aria-expanded="{{ $loop->iteration == 1 ? 'true' : 'false' }}" aria-controls="collapse{{ $loop->iteration }}">
      {{ $faq->title }}
    </button>
  </h2>

  <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse {{ $loop->iteration == 1 ? 'show' : '' }}" aria-labelledby="heading{{ $loop->iteration }}" data-bs-parent="#faqaccordion">
    <div class="accordion-body">
      <p>{!! $faq->description !!}</p>
    </div>
  </div>
</div>
<!-- FAQ Item End -->
@endforeach

        <!-- FAQ Accordion End -->
      </div>
    </div>
  </div>
</div>


    <!-- Contact Us Section Start -->
<div class="contact-us-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <!-- Contact Us Content Start -->
        <div class="contact-us-content">
          <!-- Section Title Start -->
          <div class="section-title">
            @php
    $contactcleanText = strip_tags($contactsection->heading ?? '');
    $contactwords = explode(' ', $contactcleanText);
    $contactlastTwo = implode(' ', array_slice($contactwords, -2));
    $contactfirstPart = implode(' ', array_slice($contactwords, 0, -2));
@endphp
            <h3 class="wow fadeInUp">contact us</h3>
            <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-cursor="-opaque">{{$contactfirstPart}} <span> {{$contactlastTwo}}</span></h2>
            <p class="wow fadeInUp" data-wow-delay="0.4s">{!! $contactsection->description ?? '' !!}</p>
          </div>
          <!-- Section Title End -->

          <!-- Contact Us Body Start -->
          <div class="contact-us-body">
            <!-- Contact Info List Start -->
            <div class="contact-info-list">
              <!-- Contact Info Item Start -->
              <div class="contact-info-item wow fadeInUp" data-wow-delay="0.6s">
                <div class="icon-box">
                  <img src="images/icon-location-black.svg" alt="">
                </div>
                <div class="contact-info-content">
                  <h3>Address</h3>
                  <p><a href="https://www.google.com/maps?q=Fort+McMurray+RPO+Plaza+11,+AB,+T9H+5B2,+CANADA" target="_blank">
                    {{$contactsection->address ?? ''}}
                  </a></p>
                </div>
              </div>
              <!-- Contact Info Item End -->

              <!-- Contact Info Item Start -->
              <div class="contact-info-item wow fadeInUp" data-wow-delay="0.8s">
                <div class="icon-box">
                  <img src="images/icon-phone-black.svg" alt="">
                </div>
                <div class="contact-info-content">
                  <h3>Email</h3>
                  <p><a href="mailto:{{$contactsection->email ?? ''}}">{{$contactsection->email ?? ''}}</a></p>
                </div>
              </div>
              <!-- Contact Info Item End -->
            </div>
            <!-- Contact Info List End -->
          </div>
          <!-- Contact Us Body End -->
        </div>
        <!-- Contact Us Content End -->
      </div>

      <div class="col-lg-6">
        <!-- Contact Form Start -->
        <div class="contact-form">
          <p class="wow fadeInUp">Fill out the form below to connect with our team. We'll help you get set up with membership, funding opportunities, or answer any questions about joining our global artist network.</p>

          <form id="contactForm" action="{{route('contact.store')}}" method="POST" class="wow fadeInUp" data-wow-delay="0.2s">
            @csrf
            <div class="row">
              <div class="form-group col-md-6 mb-4">
                <input type="text" name="firstname" class="form-control" id="fname" placeholder="First Name" required>
                <div class="help-block with-errors"></div>
              </div>

              <div class="form-group col-md-6 mb-4">
                <input type="text" name="lastname" class="form-control" id="lname" placeholder="Last Name" required>
                <div class="help-block with-errors"></div>
              </div>

              <div class="form-group col-md-6 mb-4">
                <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                <div class="help-block with-errors"></div>
              </div>

              <div class="form-group col-md-6 mb-4">
                <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone Number" required>
                <div class="help-block with-errors"></div>
              </div>

              <div class="form-group col-md-12 mb-4">
                <textarea name="message" class="form-control" id="message" rows="6" placeholder="Tell us how we can help you get started"></textarea>
                <div class="help-block with-errors"></div>
              </div>

              <div class="col-md-12">
                <button type="submit" class="btn-default">submit message</button>
                <div id="msgSubmit" class="h3 hidden"></div>
              </div>
            </div>
          </form>
        </div>
        <!-- Contact Form End -->
      </div>
    </div>
  </div>
</div>

    <!-- Contact Us Section End -->




@endsection






@section('script')
    @parent
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
          });
        @endif
        // Debug: log form submission
        var form = document.getElementById('contactForm');
        if (form) {
          form.addEventListener('submit', function(e) {
            console.log('Contact form submitted!');
          });
        }
      });
    </script>

    <script>
  const header = document.getElementById("stickyHeader");

  window.addEventListener("scroll", () => {
    if (window.scrollY > 80) {
      header.classList.add("scrolled");
    } else {
      header.classList.remove("scrolled");
    }
  });
</script>

    <script>
        // Smooth sticky sections management
        let currentSection = 1;
        const totalSections = 3;

        function handleSectionTransition() {
            const scrolled = window.pageYOffset;
            const windowHeight = window.innerHeight;

            // Calculate which section should be visible
            const sectionHeight = windowHeight;
            const newSection = Math.min(Math.floor(scrolled / sectionHeight) + 1, totalSections);

            if (newSection !== currentSection) {
                // Hide previous section
                const prevSection = document.getElementById(`section${currentSection}`);
                if (prevSection) {
                    prevSection.classList.add('section-hidden');
                    prevSection.classList.remove('section-visible');
                }

                // Show new section
                const nextSection = document.getElementById(`section${newSection}`);
                if (nextSection) {
                    nextSection.classList.add('section-visible');
                    nextSection.classList.remove('section-hidden');
                }

                currentSection = newSection;
            }

            // Apply parallax effect to visible section
            const visibleSection = document.getElementById(`section${currentSection}`);
            if (visibleSection) {
                const video = visibleSection.querySelector('.viiderosecvideo-background');
                const overlay = visibleSection.querySelector('.dance-overlay');

                if (video) {
                    const rate = (scrolled % windowHeight) * 0.1;
                    video.style.transform = `scale(1.1) translateY(${rate}px)`;
                }

                if (overlay) {
                    const overlayRate = (scrolled % windowHeight) * 0.05;
                    overlay.style.transform = `translateY(${overlayRate}px)`;
                }
            }
        }

        // Animate videosecparticles
        function createvideosecparticles(viideroseccontainerId, count = 40) {
            const viideroseccontainer = document.getElementById(viideroseccontainerId);
            if (!viideroseccontainer) return;

            for (let i = 0; i < count; i++) {
                const videosecparticle = document.createElement('div');
                videosecparticle.classList.add('videosecparticle');

                const x = Math.random() * 100;
                const y = Math.random() * 100;
                const size = Math.random() * 3 + 1;
                const delay = Math.random() * 15;
                const duration = Math.random() * 10 + 10;

                videosecparticle.style.left = `${x}%`;
                videosecparticle.style.top = `${y}%`;
                videosecparticle.style.width = `${size}px`;
                videosecparticle.style.height = `${size}px`;
                videosecparticle.style.animationDelay = `${delay}s`;
                videosecparticle.style.animationDuration = `${duration}s`;

                viideroseccontainer.appendChild(videosecparticle);
            }
        }

        // Initial load
        window.addEventListener('load', () => {
            ['videosecparticles1', 'videosecparticles2', 'videosecparticles3'].forEach(id => createvideosecparticles(id));
            handleSectionTransition(); // ensure correct section visibility on load
        });

        // Scroll listener
        window.addEventListener('scroll', () => {
            window.requestAnimationFrame(handleSectionTransition);
        });
    </script>

    <script>
    // Add interactive hover effects
    document.querySelectorAll('.iseeyou-stack-img').forEach(img => {
      img.addEventListener('mouseenter', function() {
        this.style.transform = 'scale(1.1) rotate(0deg)';
        this.style.zIndex = '10';
      });

      img.addEventListener('mouseleave', function() {
        this.style.transform = '';
        this.style.zIndex = '';
      });
    });

    // Add click animation to CTA button
    document.querySelector('.iseeyou-cta-button').addEventListener('click', function() {
      this.style.transform = 'scale(0.95)';
      setTimeout(() => {
        this.style.transform = '';
      }, 150);
    });

    // Add dynamic background movement
    function createDancingElement() {
      const element = document.createElement('div');
      element.innerHTML = '<i class="fas fa-music"></i>';
      element.className = 'iseeyou-dance-particle';
      element.style.position = 'fixed';
      element.style.left = Math.random() * 100 + '%';
      element.style.top = Math.random() * 100 + '%';
      element.style.color = 'var(--accent-color)';
      element.style.opacity = '0.1';
      element.style.fontSize = '1.5rem';
      element.style.zIndex = '1';
      element.style.pointerEvents = 'none';

      document.body.appendChild(element);

      setTimeout(() => {
        element.remove();
      }, 6000);
    }

    setInterval(createDancingElement, 3000);
    </script>

    <script>
        let danceCurrentUserType = 'individual';
        let danceCurrentFormType = 'signup';

        function openDancePopup() {
            document.getElementById('dancePopupOverlay').classList.add('dance-active');
            document.body.style.overflow = 'hidden';
        }

        function closeDancePopup() {
            document.getElementById('dancePopupOverlay').classList.remove('dance-active');
            document.body.style.overflow = 'auto';
            // Reset form
            document.getElementById('danceSuccessMessage').classList.remove('dance-show');
            showDanceSignupForm();
        }

        function showDanceSignupForm() {
            danceCurrentFormType = 'signup';
            document.getElementById('danceSignupForm').style.display = 'block';
            document.getElementById('danceLoginForm').style.display = 'none';
            document.getElementById('danceSuccessMessage').classList.remove('dance-show');

            // Update tab buttons
            const tabs = document.querySelectorAll('.dance-tab-btn');
            tabs.forEach(tab => tab.classList.remove('dance-active'));
            tabs[0].classList.add('dance-active');
        }

        function showDanceLoginForm() {
            danceCurrentFormType = 'login';
            document.getElementById('danceSignupForm').style.display = 'none';
            document.getElementById('danceLoginForm').style.display = 'block';
            document.getElementById('danceSuccessMessage').classList.remove('dance-show');

            // Update tab buttons
            const tabs = document.querySelectorAll('.dance-tab-btn');
            tabs.forEach(tab => tab.classList.remove('dance-active'));
            tabs[1].classList.add('dance-active');
        }

        function selectDanceUserType(type, event) {
            console.log('selectDanceUserType called with type:', type);
            danceCurrentUserType = type;
            // Update button states
            const buttons = document.querySelectorAll('.dance-user-type-btn');
            buttons.forEach(btn => btn.classList.remove('dance-active'));
            if (event && event.target) {
                event.target.classList.add('dance-active');
            } else {
                // fallback: activate the correct button
                if (type === 'individual') {
                    buttons[0].classList.add('dance-active');
                } else {
                    buttons[1].classList.add('dance-active');
                }
            }
            // Show/hide appropriate form
            const individualForm = document.getElementById('danceIndividualForm');
            const companyForm = document.getElementById('danceCompanyForm');
            if (type === 'individual') {
                companyForm.style.display = 'none';
                individualForm.style.display = 'block';
            } else {
                individualForm.style.display = 'none';
                companyForm.style.display = 'block';
            }
        }

        function showDanceSuccessMessage() {
            document.getElementById('danceSignupForm').style.display = 'none';
            document.getElementById('danceLoginForm').style.display = 'none';
            document.getElementById('danceSuccessMessage').classList.add('dance-show');
        }

        // Form submission handlers
        // document.getElementById('danceIndividualForm').addEventListener('submit', function(e) {
        //     e.preventDefault();

        //     // Add loading state
        //     const submitBtn = this.querySelector('.dance-submit-btn');
        //     const originalText = submitBtn.innerHTML;
        //     submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating Account...';
        //     submitBtn.disabled = true;

        //     setTimeout(() => {
        //         submitBtn.innerHTML = originalText;
        //         submitBtn.disabled = false;
        //         showDanceSuccessMessage();
        //     }, 2000);
        // });

        // document.getElementById('danceCompanyForm').addEventListener('submit', function(e) {
        //     e.preventDefault();

        //     // Add loading state
        //     const submitBtn = this.querySelector('.dance-submit-btn');
        //     const originalText = submitBtn.innerHTML;
        //     submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating Account...';
        //     submitBtn.disabled = true;

        //     setTimeout(() => {
        //         submitBtn.innerHTML = originalText;
        //         submitBtn.disabled = false;
        //         showDanceSuccessMessage();
        //     }, 2000);
        // });

        // document.getElementById('danceLoginFormElement').addEventListener('submit', function(e) {
        //     e.preventDefault();

        //     // Add loading state
        //     const submitBtn = this.querySelector('.dance-submit-btn');
        //     const originalText = submitBtn.innerHTML;
        //     submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Logging In...';
        //     submitBtn.disabled = true;

        //     setTimeout(() => {
        //         submitBtn.innerHTML = originalText;
        //         submitBtn.disabled = false;
        //         showDanceSuccessMessage();
        //     }, 1500);
        // });

        // Close popup on overlay click
        document.getElementById('dancePopupOverlay').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDancePopup();
            }
        });

        // Close popup on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && document.getElementById('dancePopupOverlay').classList.contains('dance-active')) {
                closeDancePopup();
            }
        });

        // Add smooth focus animations to form inputs
        document.querySelectorAll('.dance-form-group input, .dance-form-group select').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });

        // Add floating labels effect
        document.querySelectorAll('.dance-form-group input').forEach(input => {
            input.addEventListener('input', function() {
                if (this.value) {
                    this.style.paddingTop = '20px';
                    this.style.paddingBottom = '12px';
                } else {
                    this.style.paddingTop = '16px';
                    this.style.paddingBottom = '16px';
                }
            });
        });

        // Add particle effect on button hover
        document.querySelectorAll('.dance-signup-btn, .dance-submit-btn').forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-3px) scale(1.02)';
            });

            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Add ripple effect to buttons
        document.querySelectorAll('.dance-signup-btn, .dance-submit-btn, .dance-tab-btn, .dance-user-type-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                let ripple = document.createElement('span');
                ripple.style.position = 'absolute';
                ripple.style.borderRadius = '50%';
                ripple.style.background = 'rgba(255, 255, 255, 0.3)';
                ripple.style.transform = 'scale(0)';
                ripple.style.animation = 'ripple-effect 0.6s linear';
                ripple.style.left = (e.clientX - e.target.offsetLeft) + 'px';
                ripple.style.top = (e.clientY - e.target.offsetTop) + 'px';
                ripple.style.width = ripple.style.height = '20px';

                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add CSS for ripple effect
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple-effect {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>

        <script>
        // Create neural network effect
        function createNeuralNetwork() {
            const network = document.getElementById('neuralNetwork');
            const nodeCount = 25;
            const nodes = [];

            // Create nodes
            for (let i = 0; i < nodeCount; i++) {
                const node = document.createElement('div');
                node.className = 'neural-node';
                node.style.left = Math.random() * 100 + '%';
                node.style.top = Math.random() * 100 + '%';
                node.style.animationDelay = Math.random() * 3 + 's';
                network.appendChild(node);
                nodes.push({
                    element: node,
                    x: parseFloat(node.style.left),
                    y: parseFloat(node.style.top)
                });
            }

            // Create connections between nearby nodes
            for (let i = 0; i < nodes.length; i++) {
                for (let j = i + 1; j < nodes.length; j++) {
                    const distance = Math.sqrt(
                        Math.pow(nodes[i].x - nodes[j].x, 2) +
                        Math.pow(nodes[i].y - nodes[j].y, 2)
                    );

                    if (distance < 30) {
                        const connection = document.createElement('div');
                        connection.className = 'neural-connection';

                        const angle = Math.atan2(nodes[j].y - nodes[i].y, nodes[j].x - nodes[i].x);
                        const length = distance * (window.innerWidth / 100);

                        connection.style.width = length + 'px';
                        connection.style.left = nodes[i].x + '%';
                        connection.style.top = nodes[i].y + '%';
                        connection.style.transform = `rotate(${angle}rad)`;
                        connection.style.animationDelay = Math.random() * 4 + 's';

                        network.appendChild(connection);
                    }
                }
            }
        }

        // Animate stats with enhanced effects
        function animateVisionStats() {
            const stats = document.querySelectorAll('.vision-stat-number');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const target = entry.target;
                        const finalValue = target.textContent;
                        const isPercentage = finalValue.includes('%');
                        const isMillion = finalValue.includes('M+');
                        const isPlus = finalValue.includes('+');

                        let numValue;
                        if (isMillion) {
                            numValue = parseInt(finalValue.replace(/[^\d]/g, '')) * 1000000;
                        } else if (isPercentage) {
                            numValue = parseFloat(finalValue.replace('%', '')) * 10;
                        } else {
                            numValue = parseInt(finalValue.replace(/[^\d]/g, ''));
                        }

                        let current = 0;
                        const increment = numValue / 60;
                        const timer = setInterval(() => {
                            current += increment;
                            if (current >= numValue) {
                                current = numValue;
                                clearInterval(timer);
                            }

                            if (isMillion) {
                                target.textContent = Math.floor(current / 1000000) + 'M+';
                            } else if (isPlus) {
                                target.textContent = Math.floor(current) + '+';
                            } else if (isPercentage) {
                                target.textContent = (current / 10).toFixed(1) + '%';
                            } else {
                                target.textContent = Math.floor(current);
                            }
                        }, 40);
                    }
                });
            });

            stats.forEach(stat => observer.observe(stat));
        }

        // Enhanced parallax effects
        function initParallaxEffects() {
            let ticking = false;

            function updateParallax() {
                const scrolled = window.pageYOffset;
                const rate = scrolled * -0.5;

                // Background parallax
                document.querySelector('.futuristic-vision-wrapper').style.backgroundPosition = `center ${rate}px`;

                // Neural network parallax
                const nodes = document.querySelectorAll('.neural-node');
                const connections = document.querySelectorAll('.neural-connection');

                nodes.forEach((node, index) => {
                    const speed = 0.3 + (index % 3) * 0.1;
                    node.style.transform = `translateY(${scrolled * speed}px)`;
                });

                connections.forEach((connection, index) => {
                    const speed = 0.2 + (index % 2) * 0.05;
                    connection.style.transform += ` translateY(${scrolled * speed}px)`;
                });

                ticking = false;
            }

            function requestTick() {
                if (!ticking) {
                    requestAnimationFrame(updateParallax);
                    ticking = true;
                }
            }

            window.addEventListener('scroll', requestTick);
        }

        // Initialize all effects
        document.addEventListener('DOMContentLoaded', function() {
            createNeuralNetwork();
            animateVisionStats();
            initParallaxEffects();
        });

        // Responsive neural network update
        window.addEventListener('resize', function() {
            const network = document.getElementById('neuralNetwork');
            network.innerHTML = '';
            createNeuralNetwork();
        });
    </script>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const input = document.querySelector('#danceDanceStyle[type="text"]');
        const select = document.querySelector('#danceDanceStyle[name="danceStyle"]');

        const selectedValues = [];

        select.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const value = selectedOption.text;

            // Prevent empty/duplicate/more than 5 selections
            if (!value || selectedValues.includes(value) || selectedValues.length >= 5) {
                this.selectedIndex = 0; // reset selection to default
                return;
            }

            selectedValues.push(value);
            input.value = selectedValues.join(', '); // Show in input
            this.selectedIndex = 0; // reset after selection
        });
    });
    </script>

        <script>
          document.addEventListener('DOMContentLoaded', function () {
                const inputtwo = document.querySelector('#danceDanceStyletwo[type="text"]');
                const select = document.querySelector('#danceDanceStyletwo[name="danceStyle"]');

                const selectedValues = [];

                select.addEventListener('change', function () {
                    const selectedOption = this.options[this.selectedIndex];
                    const value = selectedOption.text;

                    // Prevent empty/duplicate/more than 5 selections
                    if (!value || selectedValues.includes(value) || selectedValues.length >= 5) {
                        this.selectedIndex = 0; // reset selection to default
                        return;
                    }

                    selectedValues.push(value);
                    inputtwo.value = selectedValues.join(', '); // Show in input
                    this.selectedIndex = 0; // reset after selection
                });
            });
        </script>

        <!--<script>
          const playButton = document.querySelector(".promo-play-button");
          const modal = document.getElementById("videoModal");
          const closeButton = document.getElementById("closeVideo");
          const video = document.getElementById("promoVideo");

          playButton.addEventListener("click", () => {
            modal.style.display = "flex";
            video.play();
          });

          closeButton.addEventListener("click", () => {
            video.pause();
            modal.style.display = "none";
          });
        </script> -->
        <!-- <script>
          const playBtn2 = document.querySelector(".iseeyou-action-btn");
          const modal2 = document.getElementById("videoModal2");
          const closeBtn2 = document.getElementById("closeVideo2");
          const secondVideo = document.getElementById("secondVideo");

          playBtn2.addEventListener("click", () => {
            modal2.style.display = "flex";
            secondVideo.play();
          });

          closeBtn2.addEventListener("click", () => {
            secondVideo.pause();
            modal2.style.display = "none";
          });
        </script> -->

        <!-- <script>
          const playBtn3 = document.querySelector(".third-video-btn");
          const modal3 = document.getElementById("videoModal3");
          const closeBtn3 = document.getElementById("closeVideo3");
          const thirdVideo = document.getElementById("thirdVideo");

          playBtn3.addEventListener("click", () => {
            modal3.style.display = "flex";
            thirdVideo.play();
          });

          closeBtn3.addEventListener("click", () => {
            thirdVideo.pause();
            modal3.style.display = "none";
          });
        </script> -->

<script>
  // Universal video player script for all video sections

// Handle iseeyou-video-container sections
document.querySelectorAll('.iseeyou-video-container').forEach((container) => {
    const video = container.querySelector('.iseeyou-video-player');
    const videoOverlay = container.querySelector('.iseeyou-video-overlay');
    const playButton = container.querySelector('.iseeyou-play-button');
    const playPauseBtn = container.querySelector('.playPauseBtn, #playPauseBtn');
    const progressContainer = container.querySelector('.iseeyou-progress-container');
    const progressBar = container.querySelector('.iseeyou-progress-bar');
    const timeDisplay = container.querySelector('.iseeyou-time-display');
    const muteBtn = container.querySelector('.muteBtn, #muteBtn');
    const volumeSlider = container.querySelector('.iseeyou-volume-slider');
    const fullscreenBtn = container.querySelector('.fullscreenBtn, #fullscreenBtn1');

    setupVideoControls(video, videoOverlay, playButton, playPauseBtn, progressContainer, progressBar, timeDisplay, muteBtn, volumeSlider, fullscreenBtn);
});

// Handle format-video-controls sections (for Snippet 1.mp4)
document.querySelectorAll('.format-video-controls').forEach((controlsContainer) => {
    // Find the closest video container
    const videoContainer = controlsContainer.closest('.format-video-player') || controlsContainer.parentElement;
    const video = videoContainer.querySelector('.iseeyou-video-player');

    if (video) {
        const playPauseBtn = controlsContainer.querySelector('#playPauseBtn');
        const progressBar = controlsContainer.querySelector('#progressBar');
        const progressFill = controlsContainer.querySelector('#progressFill');
        const timeDisplay = controlsContainer.querySelector('#timeDisplay');
        const volumeBtn = controlsContainer.querySelector('#volumeBtn');
        const volumeSlider = controlsContainer.querySelector('#volumeSlider');
        const fullscreenBtn = controlsContainer.querySelector('#fullscreenBtn');

        // Also find overlay and play button from the video container
        const videoOverlay = videoContainer.querySelector('.iseeyou-video-overlay');
        const playButton = videoContainer.querySelector('.iseeyou-play-button');

        setupVideoControls(video, videoOverlay, playButton, playPauseBtn, progressBar, progressFill, timeDisplay, volumeBtn, volumeSlider, fullscreenBtn);
    }
});

function setupVideoControls(video, videoOverlay, playButton, playPauseBtn, progressContainer, progressBar, timeDisplay, muteBtn, volumeSlider, fullscreenBtn) {
    let isPlaying = false;
    let hasAutoPlayed = false;

    // Auto-play when in view
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !hasAutoPlayed) {
                autoPlayWithAudio();
                hasAutoPlayed = true;
            } else if (!entry.isIntersecting && isPlaying) {
                video.pause();
                if (playPauseBtn) playPauseBtn.innerHTML = '<i class="fas fa-play"></i>';
                isPlaying = false;
            }
        });
    }, { threshold: 0.5 });

    observer.observe(video.parentElement);

    async function autoPlayWithAudio() {
        try {
            video.muted = false;
            video.volume = 0.7;
            if (volumeSlider) {
                if (volumeSlider.type === 'range') {
                    volumeSlider.value = 0.7;
                } else {
                    volumeSlider.value = 70; // For format controls that use 0-100
                }
            }
            await video.play();
            if (playPauseBtn) playPauseBtn.innerHTML = '<i class="fas fa-pause"></i>';
            if (videoOverlay) videoOverlay.classList.add('hidden');
            isPlaying = true;
            updateMuteIcon();
        } catch {
            try {
                video.muted = true;
                await video.play();
                if (playPauseBtn) playPauseBtn.innerHTML = '<i class="fas fa-pause"></i>';
                if (videoOverlay) videoOverlay.classList.add('hidden');
                isPlaying = true;
                updateMuteIcon();
            } catch (e) {
                console.warn('Auto-play failed:', e);
            }
        }
    }

    function togglePlayPause() {
        if (isPlaying) {
            video.pause();
            if (playPauseBtn) playPauseBtn.innerHTML = '<i class="fas fa-play"></i>';
            isPlaying = false;
        } else {
            video.play();
            if (playPauseBtn) playPauseBtn.innerHTML = '<i class="fas fa-pause"></i>';
            if (videoOverlay) videoOverlay.classList.add('hidden');
            isPlaying = true;
        }
    }

    function updateMuteIcon() {
        if (!muteBtn) return;
        if (video.muted || video.volume === 0) {
            muteBtn.innerHTML = '<i class="fas fa-volume-mute"></i>';
        } else if (video.volume < 0.5) {
            muteBtn.innerHTML = '<i class="fas fa-volume-down"></i>';
        } else {
            muteBtn.innerHTML = '<i class="fas fa-volume-up"></i>';
        }
    }

    function formatTime(seconds) {
        if (isNaN(seconds)) return '0:00';
        const minutes = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60).toString().padStart(2, '0');
        return `${minutes}:${secs}`;
    }

    // Event Listeners
    if (playButton) playButton.addEventListener('click', togglePlayPause);
    if (playPauseBtn) playPauseBtn.addEventListener('click', togglePlayPause);
    if (videoOverlay) videoOverlay.addEventListener('click', togglePlayPause);

    video.addEventListener('timeupdate', () => {
        if (progressBar) {
            const progress = (video.currentTime / video.duration) * 100;
            if (progressBar.classList.contains('iseeyou-progress-bar')) {
                progressBar.style.width = `${progress}%`;
            } else if (progressBar.classList.contains('format-progress-bar')) {
                const progressFill = progressBar.querySelector('.format-progress-fill');
                if (progressFill) progressFill.style.width = `${progress}%`;
            }
        }
        if (timeDisplay) {
            timeDisplay.textContent = `${formatTime(video.currentTime)} / ${formatTime(video.duration)}`;
        }
    });

    if (progressContainer) {
        progressContainer.addEventListener('click', (e) => {
            const rect = progressContainer.getBoundingClientRect();
            const clickX = e.clientX - rect.left;
            const width = rect.width;
            video.currentTime = (clickX / width) * video.duration;
        });
    }

    if (volumeSlider) {
        volumeSlider.addEventListener('input', (e) => {
            if (volumeSlider.type === 'range') {
                if (volumeSlider.max === '1') {
                    video.volume = e.target.value;
                } else {
                    video.volume = e.target.value / 100;
                }
            }
            video.muted = false;
            updateMuteIcon();
        });
    }

    if (muteBtn) {
        muteBtn.addEventListener('click', () => {
            video.muted = !video.muted;
            updateMuteIcon();
        });
    }

    if (fullscreenBtn) {
        fullscreenBtn.addEventListener('click', () => {
            if (video.requestFullscreen) {
                video.requestFullscreen();
            } else if (video.webkitRequestFullscreen) {
                video.webkitRequestFullscreen();
            } else if (video.mozRequestFullScreen) {
                video.mozRequestFullScreen();
            }
        });
    }

    video.addEventListener('ended', () => {
        isPlaying = false;
        if (playPauseBtn) playPauseBtn.innerHTML = '<i class="fas fa-play"></i>';
        if (videoOverlay) videoOverlay.classList.remove('hidden');
    });

    // Initial volume/mute
    video.volume = 0.7;
    video.muted = true;
    updateMuteIcon();
}
</script>


@endsection
