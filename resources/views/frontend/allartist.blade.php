@extends('layouts.frontend.master')


@section('css')
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
      a {
        color:white !important;
      }
    .artist_detailCss {
        position:relative;
    }
   .artist_detailCss .container {
    max-width: 1400px;
    margin: 0 auto;
}

/* Tabs */
.artist_detailCss .tabs {
    display: flex;
    gap: 20px;
    margin-bottom: 30px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.artist_detailCss .tab {
    background: none;
    border: none;
    color: #fff;
    font-size: 16px;
    font-weight: 600;
    padding: 15px 25px;
    cursor: pointer;
    position: relative;
    transition: all 0.3s ease;
    opacity: 0.6;
}

.artist_detailCss .tab:hover {
    opacity: 0.8;
}

.artist_detailCss .tab.active {
    opacity: 1;
}

.artist_detailCss .tab.active::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    height: 3px;
    background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    border-radius: 3px 3px 0 0;
}

/* Swiper */
.artist_detailCss .swiper {
    width: 100%;
    height: 100%;
    padding: 1rem 0 4rem 0 !important;
}

.artist_detailCss .swiper-slide {
    font-size: 18px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.artist_detailCss .swiper-slide img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.artist_detailCss .swiper-pagination-bullet {
    width: var(--swiper-pagination-bullet-width, var(--swiper-pagination-bullet-size, 13px));
    border-radius: 8px;
    transition: all .4s ease-in-out;
    background: #ffffff;
}

.artist_detailCss .swiper-pagination-bullet-active {
    width: 38px !important;
    background: #9768e9;
}

/* Section Header */
.artist_detailCss .section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.artist_detailCss .section-title {
   font-size: 40px !important;
    font-weight: 700;
    color: white;
}

.artist_detailCss .show-all {
    color: #ffffff;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s ease-in-out;
    background: #673AB7;
    padding: 2px 20px;
    border-radius: 10px;
    border: none;
}

.artist_detailCss .show-all:hover {
    color: #fff;
    background: #391a71 ;
}

/* Card */
.artist_detailCss .card {
    cursor: pointer;
    transition: transform 0.3s ease;
    background:transparent;
}

.artist_detailCss .card:hover {
    transform: translateY(-8px);
}

.artist_detailCss .card-image {
    width: 200px;
    height: 200px;
    border-radius: 12px;
    overflow: hidden;
    position: relative;
    margin-bottom: 12px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.artist_detailCss .card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.artist_detailCss .card-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background: rgba(0, 0, 0, 0.7);
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
    backdrop-filter: blur(10px);
}

.artist_detailCss .card-title {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 5px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    color: white;
}

.artist_detailCss .card-description {
    font-size: 15px;
    color: #b8b8b8;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Charts Grid */
.artist_detailCss .charts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 20px;
}

.artist_detailCss .chart-card {
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
    border-radius: 12px;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.05);
}

.artist_detailCss .chart-card:hover {
    transform: translateY(-5px);
    border-color: rgba(102, 126, 234, 0.3);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
}

.artist_detailCss .chart-image {
    width: 100%;
    height: 280px;
    background-size: cover !important;
    background-position: center !important;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 48px;
    font-weight: 900;
    color: rgba(255, 255, 255, 0.9);
    position: relative;
}

.artist_detailCss .chart-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    background: rgba(0, 0, 0, 0.7);
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 11px;
    backdrop-filter: blur(10px);
}

.artist_detailCss .chart-info {
    padding: 20px;
}

.artist_detailCss .chart-title {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 8px;
    color: white;
}

.artist_detailCss .chart-description {
    font-size: 13px;
    color: #b8b8b8;
    line-height: 1.5;
}

.artist_detailCss .tab-content {
    display: none;
}

.artist_detailCss .tab-content.active {
    display: block;
}

/* Slider Navigation */
.artist_detailCss .slider-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0, 0, 0, 0.5);
    border: none;
    color: #fff;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    z-index: 10;
}

.artist_detailCss .slider-nav:hover {
    background: rgba(102, 126, 234, 0.8);
    transform: translateY(-50%) scale(1.1);
}

.artist_detailCss .slider-nav.prev {
    left: -20px;
}

.artist_detailCss .slider-nav.next {
    right: -20px;
}

/* ==== radio-grid / radio-card / play-overlay block (from music_collection) ==== */
.artist_detailCss .container {
    max-width: 1400px;
    margin: 0 auto;
}

/* Section Header (radio block) */
.artist_detailCss .section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.artist_detailCss .section-title {
    font-size: 40px !important;
    font-weight: 700;
    color: white;
}

/* Radio Grid */
.artist_detailCss .radio-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
}

.artist_detailCss .radio-card {
    background: transparent;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.3s ease;
    //border: 1px solid rgba(255, 255, 255, 0.05);
    position: relative;
}

.artist_detailCss .radio-card:hover {
    transform: translateY(-5px);
    //background: rgba(255, 255, 255, 0.05);
    border-color: rgba(102, 126, 234, 0.3);
    //box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
}

.artist_detailCss .radio-image-container {
    position: relative;
    width: 100%;
    padding-top: 100%;
    overflow: hidden;
}

.artist_detailCss .radio-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.artist_detailCss .radio-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(10px);
    padding: 6px 12px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 11px;
    font-weight: 600;
}

.artist_detailCss .radio-logo {
    font-size: 12px !important;
    border-radius: 4px;
        //background: linear-gradient(135deg, #ffffff 0%, #ffffff 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
}

.artist_detailCss .radio-info {
    padding: 4px;
}

.artist_detailCss .radio-category {
    font-size: 11px;
    color: #b8b8b8;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 6px;
}
.purpSpan {
    color:#9f54f5;
}
.artist_detailCss .radio-title {
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 6px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    color: white;
}

.artist_detailCss .radio-description {
    font-size: 12px;
    color: #888;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Play button overlay */
.artist_detailCss .play-overlay {
    position: absolute;
    top: 50%;
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #000000 0%, #000000 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transform: scale(0.8);
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    transform: translate(-50%, -50%) !important;
    left: 50%;
}

.artist_detailCss .radio-card:hover .play-overlay {
    opacity: 1;
    transform: scale(1);
}

.artist_detailCss .play-icon {
    width: 0;
    height: 0;
    border-left: 12px solid #fff;
    border-top: 8px solid transparent;
    border-bottom: 8px solid transparent;
    margin-left: 3px;
}

@media (max-width:600px) {
    .artist_detailCss .section-header {
            display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    flex-direction: column;
    padding: 1rem;
    }
}

    </style>

@endsection

@section('content')




       <!-- Start of Main Banner -->
       <section class="inner-banner contact-banner">
            <div class="about-child">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Featured Artists</h2>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <!-- End of Main Banner -->

       
        <section class="artist_detailCss">
            <div class="container">
                <!-- Tabs -->
                <div class="tabs">
                    <button class="tab active" data-tab="all">All</button>
                    <button class="tab" data-tab="music">Music</button>
                </div>

                <div class="tab-content active" id="all">
                    <!-- Recommended Section -->
                    <div class="section-header">
                        <h2 class="section-title"><span class="purpSpan">Recommended</span> for you</h2>
                        {{--<button class="show-all">Show all</button>--}}
                    </div>

                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <a href="/songs-details">
                                <div class="card">
                                    <div class="card-image">
                                        <img src="https://img.freepik.com/premium-photo/musician-playing-guitar-evening-city-scene_486608-9327.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_se_enriched&w=740&q=80" alt="Ed Sheeran">
                                        <div class="card-badge">🎵 Featured</div>
                                    </div>
                                    <div class="card-title">Pop Essentials</div>
                                    <div class="card-description">The biggest pop hits. <br> Cover: Ed Sheeran</div>
                                </div>
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="/songs-details">
                            <div class="card">
                                <div class="card-image">
                                    <img src="https://img.freepik.com/premium-photo/physical-connection-bridging-gaps-musical-genres_889056-31283.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_se_enriched&w=740&q=80" alt="The Weeknd">
                                    <div class="card-badge">🎵 Featured</div>
                                </div>
                                <div class="card-title">Hot Hits</div>
                                <div class="card-description">The hottest tracks <br>trending globally 🔥</div>
                            </div>
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="/songs-details">
                            <div class="card">
                                <div class="card-image">
                                    <img src="https://img.freepik.com/premium-photo/woman-with-red-hair-microphone-front-her_917313-30721.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_se_enriched&w=740&q=80" alt="Taylor Swift">
                                    <div class="card-badge">🎵 Featured</div>
                                </div>
                                <div class="card-title">Best Hits</div>
                                <div class="card-description">Best of English Music. <br> Cover: Taylor Swift</div>
                            </div>
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="/songs-details">
                            <div class="card">
                                <div class="card-image">
                                    <img src="https://img.freepik.com/premium-photo/music-industry-visual-photo-album-full-rhythm-harmony-every-moments_563241-49684.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_se_enriched&w=740&q=80" alt="Billie Eilish">
                                    <div class="card-badge">🎵 Featured</div>
                                </div>
                                <div class="card-title">Indie Vibes</div>
                                <div class="card-description">Home to the greatest indie <br> hits 🎸 Cover: Billie Eilish</div>
                            </div>
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="/songs-details">
                            <div class="card">
                                <div class="card-image">
                                    <img src="https://img.freepik.com/premium-photo/man-with-guitar-that-says-guitar_1207067-11192.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_se_enriched&w=740&q=80" alt="Concert">
                                    <div class="card-badge">🎵 Featured</div>
                                </div>
                                <div class="card-title">Soirée</div>
                                <div class="card-description">Groovy, dancy, funky stuff. <br> When in doubt, dance it out</div>
                            </div>
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="/songs-details">
                            <div class="card">
                                <div class="card-image">
                                    <img src="https://img.freepik.com/premium-photo/arafed-man-with-long-hair-singing-into-microphone_974521-83426.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_se_enriched&w=740&q=80" alt="Electronic">
                                    <div class="card-badge">🎵 Featured</div>
                                </div>
                                <div class="card-title">Electronic Beats</div>
                                <div class="card-description">Electronic tunes to  <br>bring life to your day</div>
                            </div>
                            </a>
                        </div>
                        <div class="swiper-slide">
                        <a href="/songs-details">
                            <div class="card">
                                <div class="card-image">
                                    <img src="https://img.freepik.com/premium-photo/image-street-singer-performing-popular-songs-with-guitar-keyboard_1314467-46223.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_se_enriched&w=740&q=80" alt="Electronic">
                                    <div class="card-badge">🎵 Featured</div>
                                </div>
                                <div class="card-title">Chill Vibes</div>   
                        
                                <div class="card-description">Soft, relaxing beats to  <br> unlock your calm state.</div>
                            </div>
                            </a>
                        </div>
                        <div class="swiper-slide">
                        <a href="/songs-details">
                            <div class="card">
                                <div class="card-image">
                                    <img src="https://img.freepik.com/premium-photo/hd-digital-art-wallpaper-background_783884-116290.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_se_enriched&w=740&q=80" alt="Electronic">
                                    <div class="card-badge">🎵 Featured</div>
                                </div> 
                                <div class="card-title">Night Drive</div> 
                                
                        
                                <div class="card-description">Smooth electronic energy  <br> for your late-night cruise.</div>
                            </div>
                            </a>
                        </div>
                        
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>

                    <!-- Featured Charts Section -->
                    <div class="section-header">
                        <h2 class="section-title"><span class="purpSpan">Featured</span> Charts</h2>
                      {{--<button class="show-all">Show all</button>--}}
                    </div>

                    <div class="charts-grid">
                        <div class="chart-card">
                        <a href="/songs-details">
                            <div class="chart-image" style="background: url('https://img.freepik.com/premium-photo/european-migraine-day-action_605905-3990.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_se_enriched&w=740&q=80');">
                                <div style="text-align: center;">
                                    <!-- <div style="font-size: 32px; margin-bottom: 10px;">Top<br>Songs</div>
                                    <div style="font-size: 24px; opacity: 0.8;">Global</div> -->
                                </div>
                                <div class="chart-badge">🎵 Weekly Music Charts</div>
                            </div>
                            <div class="chart-info">
                                <div class="chart-title">Top Songs Global</div>
                                <div class="chart-description">Your weekly update of the most played tracks from around the world</div>
                            </div>
                             </a>
                        </div>

                        <div class="chart-card">
                        <a href="/songs-details">
                            <div class="chart-image" style="background: url('https://img.freepik.com/premium-photo/there-is-man-sitting-chair-playing-guitar_900814-104489.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_se_enriched&w=740&q=80')">
                                <div style="text-align: center;">
                                    <!-- <div style="font-size: 32px; margin-bottom: 10px;"></div>/ -->
                                    <!-- <div style="font-size: 20px; opacity: 0.8;">GLOBAL</div> -->
                                </div>
                                <div class="chart-badge">🎵 Weekly Music Charts</div>
                            </div>
                            <div class="chart-info">
                                <div class="chart-title">Viral 50 Global</div>
                                <div class="chart-description">Your daily update of the most viral tracks right now</div>
                            </div>
                            </a>
                        </div>

                        <div class="chart-card">
                        <a href="/songs-details">
                            <div class="chart-image" style="background: url('https://img.freepik.com/premium-photo/retro-man-leather-jacket-uses-portable-scale-near-motorcycle-woman-generative-ai_437323-45493.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_se_enriched&w=740&q=80');">
                                <div style="text-align: center;">
                                    <!-- <div style="font-size: 32px; margin-bottom: 10px;"></div> -->
                                    <!-- <div style="font-size: 20px; opacity: 0.8;">GLOBAL</div> -->
                                </div>
                                <div class="chart-badge">🎵 Weekly Music Charts</div>
                            </div>
                            <div class="chart-info">
                                <div class="chart-title">Top 50 Global</div>
                                <div class="chart-description">Your daily update of the most played tracks right now</div>
                            </div>
                            </a>
                        </div>

                        <div class="chart-card">
                        <a href="/songs-details">
                            <div class="chart-image" style="background: url('https://img.freepik.com/premium-photo/couple-standing-city-street-night_605905-132887.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_se_enriched&w=740&q=80');">
                                <div style="text-align: center;">
                                    <!-- <div style="font-size: 32px; margin-bottom: 10px;">Top 50</div>
                                    <div style="font-size: 20px; opacity: 0.8;">USA</div> -->
                                </div>
                                <div class="chart-badge">🎵 Weekly Music Charts</div>
                            </div>
                            <div class="chart-info">
                                <div class="chart-title">Top 50 USA</div>
                                <div class="chart-description">Your daily update of the most played tracks in the United States</div>
                            </div>
                            </a>
                        </div>

                        <div class="chart-card">
                        <a href="/songs-details">
                            <div class="chart-image" style="background: url('https://img.freepik.com/premium-photo/street-musician-playing-city-lights_1079150-347176.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_se_enriched&w=740&q=80');">
                                <div style="text-align: center;">
                                    <!-- <div style="font-size: 32px; margin-bottom: 10px;">Viral<br>50</div>
                                    <div style="font-size: 20px; opacity: 0.8;">USA</div> -->
                                </div>
                                <div class="chart-badge">🎵 Weekly Music Charts</div>
                            </div>
                            <div class="chart-info">
                                <div class="chart-title">Viral 50 USA</div>
                                <div class="chart-description">Your daily update of the most viral tracks in the United States</div>
                            </div>
                            </a>
                        </div>

                        <div class="chart-card">
                        <a href="/songs-details">
                            <div class="chart-image" style="background: url('https://img.freepik.com/premium-photo/handsome-man-red-jacket-posing-street_7023-421588.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_se_enriched&w=740&q=80')">
                                <div style="text-align: center;">
                                    <!-- <div style="font-size: 32px; margin-bottom: 10px;">Top 50</div>
                                    <div style="font-size: 20px; opacity: 0.8;">UK</div> -->
                                </div>
                                <div class="chart-badge">🎵 Weekly Music Charts</div>
                            </div>
                            <div class="chart-info">
                                <div class="chart-title">Top 50 UK</div>
                                <div class="chart-description">Your daily update of the most played tracks in the United Kingdom</div>
                            </div>
                            </a>
                        </div>

                        <div class="chart-card">
                        <a href="/songs-details">
                            <div class="chart-image" style="background: url('https://img.freepik.com/premium-photo/there-is-man-that-is-sitting-keyboard-front-computer_1035757-34082.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_hybrid&w=740&q=80')">
                                <div style="text-align: center;">
                                    <!-- <div style="font-size: 32px; margin-bottom: 10px;">Top 50</div>
                                    <div style="font-size: 20px; opacity: 0.8;">UK</div> -->
                                </div>
                                <div class="chart-badge">🎵 Weekly Hits UK</div>
                            </div>
                            <div class="chart-info">
                                <div class="chart-title">Top 50 Tracks</div>
                                <div class="chart-description">Your fresh update of the most streamed and trending songs across the United Kingdom.</div>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="music">
                    <div class="section-header">
                        <h2 class="section-title"><span class="purpSpan">Music</span> Collections</h2>
                    {{--<span class="show-all">Show all</span>--}}
                    </div>
                    <section class="music_collection">
                        <div class="container">
                            <!-- Recommended Section -->
                            {{--
                            <div class="section-header">
                                <h2 class="section-title">Recommended</h2>
                            </div>
                            --}}

                            <div class="radio-grid">
                                <!-- Radio 1 -->
                                <div class="radio-card">
                                <a href="/songs-details">
                                    <div class="radio-image-container">
                                        <img src="https://img.freepik.com/premium-photo/landscape-parking-lot-full-cars-with-movie-screen-background_1288286-7773.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_se_enriched&w=740&q=80" alt="Coldplay Radio" class="radio-image">
                                        <div class="radio-badge">
                                            <div class="radio-logo">🎵</div>
                                            <span>Coldplay Radio</span>
                                        </div>
                                        <div class="play-overlay">
                                            <div class="play-icon"></div>
                                        </div>
                                    </div>
                                    <div class="radio-info">
                                        <div class="radio-category">Radio</div>
                                        <div class="radio-title">Coldplay Radio</div>
                                        <div class="radio-description">With Coldplay, Imagine Dragons, OneRepublic and more</div>
                                    </div>
                                    </a>
                                </div>

                                <!-- Radio 2 -->
                                <div class="radio-card">
                                <a href="/songs-details">
                                    <div class="radio-image-container">
                                        <img src="https://img.freepik.com/premium-photo/guitarist-stage-background-soft-blur-concept_1028938-159228.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_se_enriched&w=740&q=80" alt="Ed Sheeran Radio" class="radio-image">
                                        <div class="radio-badge">
                                            <div class="radio-logo">🎵</div>
                                            <span>Sheeran Radio</span>
                                        </div>
                                        <div class="play-overlay">
                                            <div class="play-icon"></div>
                                        </div>
                                    </div>
                                    <div class="radio-info">
                                        <div class="radio-category">Radio</div>
                                        <div class="radio-title">Ed Sheeran Radio</div>
                                        <div class="radio-description">With Ed Sheeran, Shawn Mendes, Charlie Puth and more</div>
                                    </div>
                                    </a>
                                </div>

                                <!-- Radio 3 -->
                                <div class="radio-card">
                                <a href="/songs-details">
                                    <div class="radio-image-container">
                                        <img src="https://img.freepik.com/premium-photo/desert-echoes-futuristic-space-tribal-band-battling-postwar-wasteland_1000124-132554.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_se_enriched&w=740&q=80" alt="Taylor Swift Radio" class="radio-image">
                                        <div class="radio-badge">
                                            <div class="radio-logo">🎵</div>
                                            <span>Swift Radio</span>
                                        </div>
                                        <div class="play-overlay">
                                            <div class="play-icon"></div>
                                        </div>
                                    </div>
                                    <div class="radio-info">
                                        <div class="radio-category">Radio</div>
                                        <div class="radio-title">Taylor Swift Radio</div>
                                        <div class="radio-description">With Taylor Swift, Ariana Grande, Dua Lipa and more</div>
                                    </div>
                                    </a>
                                </div>

                                <!-- Radio 4 -->
                                <div class="radio-card">
                                <a href="/songs-details">
                                    <div class="radio-image-container">
                                        <img src="https://img.freepik.com/premium-photo/handsome-man-blue-jacket-posing-street_7023-67178.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_se_enriched&w=740&q=80" alt="The Weeknd Radio" class="radio-image">
                                        <div class="radio-badge">
                                            <div class="radio-logo">🎵</div>
                                            <span>Weeknd Radio</span>
                                        </div>
                                        <div class="play-overlay">
                                            <div class="play-icon"></div>
                                        </div>
                                    </div>
                                    <div class="radio-info">
                                        <div class="radio-category">Radio</div>
                                        <div class="radio-title">The Weeknd Radio</div>
                                        <div class="radio-description">With The Weeknd, Drake, Post Malone and more</div>
                                    </div>
                                    </a>
                                </div>

                                <!-- Radio 5 -->
                                <div class="radio-card">
                                <a href="/songs-details">
                                    <div class="radio-image-container">
                                        <img src="https://img.freepik.com/premium-photo/man-is-playing-music-is-answer-question_881941-10751.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_se_enriched&w=740&q=80" alt="Billie Eilish Radio" class="radio-image">
                                        <div class="radio-badge">
                                            <div class="radio-logo">🎵</div>
                                            <span>Billie Radio</span>
                                        </div>
                                        <div class="play-overlay">
                                            <div class="play-icon"></div>
                                        </div>
                                    </div>
                                    <div class="radio-info">
                                        <div class="radio-category">Radio</div>
                                        <div class="radio-title">Billie Eilish Radio</div>
                                        <div class="radio-description">With Billie Eilish, Lana Del Rey, Lorde and more</div>
                                    </div>
                                    </a>
                                </div>

                                <!-- Radio 6 -->
                                <div class="radio-card">
                                <a href="/songs-details">
                                    <div class="radio-image-container">
                                        <img src="https://img.freepik.com/premium-photo/hd-digital-art-wallpaper-background_783884-116268.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_se_enriched&w=740&q=80" alt="Bruno Mars Radio" class="radio-image">
                                        <div class="radio-badge">
                                            <div class="radio-logo">🎵</div>
                                            <span>Bruno Radio</span>
                                        </div>
                                        <div class="play-overlay">
                                            <div class="play-icon"></div>
                                        </div>
                                    </div>
                                    <div class="radio-info">
                                        <div class="radio-category">Radio</div>
                                        <div class="radio-title">Bruno Mars Radio</div>
                                        <div class="radio-description">With Bruno Mars, Jason Derulo, Justin Timberlake and more</div>
                                    </div>
                                    </a>
                                </div>

                                <!-- Radio 7 -->
                                <div class="radio-card">
                                <a href="/songs-details">
                                    <div class="radio-image-container">
                                        <img src="https://img.freepik.com/premium-photo/asian-indian-female-musician-singing-into-microphone-recording-song-music-studio_1281490-7955.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_se_enriched&w=740&q=80" alt="Daft Punk Radio" class="radio-image">
                                        <div class="radio-badge">
                                            <div class="radio-logo">🎵</div>
                                            <span>Electronic Radio</span>
                                        </div>
                                        <div class="play-overlay">
                                            <div class="play-icon"></div>
                                        </div>
                                    </div>
                                    <div class="radio-info">
                                        <div class="radio-category">Radio</div>
                                        <div class="radio-title">Daft Punk Radio</div>
                                        <div class="radio-description">With Daft Punk, The Chainsmokers, Calvin Harris and more</div>
                                    </div>
                                    </a>
                                </div>

                                <!-- Radio 8 -->
                                <div class="radio-card">
                                <a href="/songs-details">
                                    <div class="radio-image-container">
                                        <img src="https://img.freepik.com/premium-photo/stock-photo-wallpaper_1037184-11293.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_hybrid&w=740&q=80" alt="Maroon 5 Radio" class="radio-image">
                                        <div class="radio-badge">
                                            <div class="radio-logo">🎵</div>
                                            <span>Maroon 5 Radio</span>
                                        </div>
                                        <div class="play-overlay">
                                            <div class="play-icon"></div>
                                        </div>
                                    </div>
                                    <div class="radio-info">
                                        <div class="radio-category">Radio</div>
                                        <div class="radio-title">Maroon 5 Radio</div>
                                        <div class="radio-description">With Maroon 5, OneRepublic, Train and more</div>
                                    </div>
                                    </a>
                                </div>

                                <!-- Radio 9 -->
                                <div class="radio-card">
                                <a href="/songs-details">
                                    <div class="radio-image-container">
                                        <img src="https://img.freepik.com/premium-photo/man-wearing-sunglasses-jacket-with-guitar-his-hands_1276913-13501.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_se_enriched&w=740&q=80" alt="Harry Styles Radio" class="radio-image">
                                        <div class="radio-badge">
                                            <div class="radio-logo">🎵</div>
                                            <span>Harry Radio</span>
                                        </div>
                                        <div class="play-overlay">
                                            <div class="play-icon"></div>
                                        </div>
                                    </div>
                                    <div class="radio-info">
                                        <div class="radio-category">Radio</div>
                                        <div class="radio-title">Harry Styles Radio</div>
                                        <div class="radio-description">With Harry Styles, Niall Horan, Zayn and more</div>
                                    </div>
                                    </a>
                                </div>

                                <!-- Radio 10 -->
                                <div class="radio-card">
                                <a href="/songs-details">
                                    <div class="radio-image-container">
                                        <img src="https://img.freepik.com/premium-photo/modern-adaptation-classic-work-stage_1104763-33337.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_se_enriched&w=740&q=80" alt="Adele Radio" class="radio-image">
                                        <div class="radio-badge">
                                            <div class="radio-logo">🎵</div>
                                            <span>Adele Radio</span>
                                        </div>
                                        <div class="play-overlay">
                                            <div class="play-icon"></div>
                                        </div>
                                    </div>
                                    <div class="radio-info">
                                        <div class="radio-category">Radio</div>
                                        <div class="radio-title">Adele Radio</div>
                                        <div class="radio-description">With Adele, Sam Smith, Lewis Capaldi and more</div>
                                    </div>
                                    </a>
                                </div>

                                <!-- Radio 11 -->
                                <div class="radio-card">
                                <a href="/songs-details">
                                    <div class="radio-image-container">
                                        <img src="https://img.freepik.com/premium-photo/hd-digital-art-wallpaper-background_783884-194332.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_se_enriched&w=740&q=80" alt="Rap Radio" class="radio-image">
                                        <div class="radio-badge">
                                            <div class="radio-logo">🎵</div>
                                            <span>RAP91 Radio</span>
                                        </div>
                                        <div class="play-overlay">
                                            <div class="play-icon"></div>
                                        </div>
                                    </div>
                                    <div class="radio-info">
                                        <div class="radio-category">Radio</div>
                                        <div class="radio-title">RAP91</div>
                                        <div class="radio-description">Top hip hop and rap tracks from around the world</div>
                                    </div>
                                    </a>
                                </div>

                                <!-- Radio 12 -->
                                <div class="radio-card">
                                <a href="/songs-details">
                                    <div class="radio-image-container">
                                        <img src="https://img.freepik.com/premium-photo/woman-dress-with-word-word-it_919955-61764.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_se_enriched&w=740&q=80" alt="Artists Radio" class="radio-image">
                                        <div class="radio-badge">
                                            <div class="radio-logo">🎵</div>
                                            <span>Best of 2025</span>
                                        </div>
                                        <div class="play-overlay">
                                            <div class="play-icon"></div>
                                        </div>
                                    </div>
                                    <div class="radio-info">
                                        <div class="radio-category">Radio</div>
                                        <div class="radio-title">Top Artists of 2025 Pakistan</div>
                                        <div class="radio-description">Featuring the biggest artists and hits of the year</div>
                                    </div>
                                    </a>
                                </div>
                            </div>

                            <!-- Featured Charts Section -->
                            <div class="section-header">
                                <h2 class="section-title">Popular <span class="purpSpan">Playlists</span></h2>
                            </div>

                            <div class="radio-grid">
                                <!-- Playlist 1 -->
                                <div class="radio-card">
                                <a href="/songs-details">
                                    <div class="radio-image-container">
                                        <img src="https://img.freepik.com/premium-photo/male-musician-holding-guitar_1092689-41602.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_se_enriched&w=740&q=80" alt="Pop Hits" class="radio-image">
                                        <div class="radio-badge">
                                            <div class="radio-logo">🎵</div>
                                            <span>Playlist</span>
                                        </div>
                                        <div class="play-overlay">
                                            <div class="play-icon"></div>
                                        </div>
                                    </div>
                                    <div class="radio-info">
                                        <div class="radio-category">Playlist</div>
                                        <div class="radio-title">Today's Top Hits</div>
                                        <div class="radio-description">Ed Sheeran is on top of the Hottest 50!</div>
                                    </div>
                                    </a>
                                </div>

                                <!-- Playlist 2 -->
                                <div class="radio-card">
                                <a href="/songs-details">
                                    <div class="radio-image-container">
                                        <img src="https://img.freepik.com/premium-photo/moody-portrait-man-leather-jacket-by-neon-lights-urban-nightlife-aesthetic_1066399-730.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_se_enriched&w=740&q=80" alt="RapCaviar" class="radio-image">
                                        <div class="radio-badge">
                                            <div class="radio-logo">🎵</div>
                                            <span>Playlist</span>
                                        </div>
                                        <div class="play-overlay">
                                            <div class="play-icon"></div>
                                        </div>
                                    </div>
                                    <div class="radio-info">
                                        <div class="radio-category">Playlist</div>
                                        <div class="radio-title">RapCaviar</div>
                                        <div class="radio-description">New music from Drake, Travis Scott and more</div>
                                    </div>
                                    </a>
                                </div>

                                <!-- Playlist 3 -->
                                <div class="radio-card">
                                <a href="/songs-details">
                                    <div class="radio-image-container">
                                        <img src="https://img.freepik.com/premium-photo/woman-is-wearing-scarf-scarf-with-word-it_917313-30749.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_se_enriched&w=740&q=80" alt="Rock Classics" class="radio-image">
                                        <div class="radio-badge">
                                            <div class="radio-logo">🎵</div>
                                            <span>Playlist</span>
                                        </div>
                                        <div class="play-overlay">
                                            <div class="play-icon"></div>
                                        </div>
                                    </div>
                                    <div class="radio-info">
                                        <div class="radio-category">Playlist</div>
                                        <div class="radio-title">Rock Classics</div>
                                        <div class="radio-description">Rock legends & epic songs that continue to inspire</div>
                                    </div>
                                    </a>
                                </div>

                                <!-- Playlist 4 -->
                                <div class="radio-card">
                                <a href="/songs-details">
                                    <div class="radio-image-container">
                                        <img src="https://img.freepik.com/premium-photo/two-women-stage-with-guitar-red-star-top_1076783-3144.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_se_enriched&w=740&q=80" alt="Chill Hits" class="radio-image">
                                        <div class="radio-badge">
                                            <div class="radio-logo">🎵</div>
                                            <span>Playlist</span>
                                        </div>
                                        <div class="play-overlay">
                                            <div class="play-icon"></div>
                                        </div>
                                    </div>
                                    <div class="radio-info">
                                        <div class="radio-category">Playlist</div>
                                        <div class="radio-title">Chill Hits</div>
                                        <div class="radio-description">Kick back to the best new and recent chill hits</div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
     
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
     <script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 1,
      spaceBetween: 10,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
          spaceBetween: 10,
        },
        450: {
          slidesPerView: 2,
          spaceBetween: 10,
        },
        640: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 4,
          spaceBetween: 40,
        },
        1024: {
          slidesPerView: 6,
          spaceBetween: 10,
        },
      },
    });


     // Tab functionality
        const tabs = document.querySelectorAll('.tab');
        const tabContents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const targetTab = tab.getAttribute('data-tab');
                
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                
                tabContents.forEach(content => {
                    content.classList.remove('active');
                });
                
                document.getElementById(targetTab).classList.add('active');
            });
        });
  </script>

    @include('partials.frontend.newsletter')


@endsection
