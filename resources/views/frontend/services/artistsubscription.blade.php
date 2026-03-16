@extends('layouts.frontend.master')


@section('css')
<style>
    /* Subscription Popup Styles */
    .subscription-popup {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 9999999;
    }

    .subscription-popup .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .subscription-popup .popup {
        background: linear-gradient(135deg, #1a0b2e 0%, #2d1b4e 100%);
        border-radius: 20px;
        padding: 30px;
        max-width: 500px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        border: 1px solid rgba(183, 148, 246, 0.3);
    }

    .subscription-popup .popup-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .subscription-popup .popup-title {
        color: white;
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0;
    }

    .subscription-popup .close-btn {
        background: none;
        border: none;
        color: white;
        font-size: 2rem;
        cursor: pointer;
        padding: 0;
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: background 0.3s;
    }

    .subscription-popup .close-btn:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .subscription-popup .plan-info {
        text-align: center;
        margin-bottom: 30px;
        padding: 20px;
        background: rgba(183, 148, 246, 0.1);
        border-radius: 15px;
    }

    .subscription-popup .plan-info h3 {
        color: white;
        font-size: 1.5rem;
        margin: 0 0 10px 0;
    }

    .subscription-popup .plan-price {
        font-size: 3rem;
        font-weight: 800;
        color: #b379f5;
        margin: 0 0 8px 0;
    }

    .subscription-popup .plan-period {
        font-size: 1rem;
        color: rgba(229, 209, 250, 0.8);
        margin: 0;
    }

    .subscription-popup .payment-methods {
        margin-bottom: 30px;
    }

    .subscription-popup .payment-methods h4 {
        color: white;
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 15px;
        text-align: center;
    }

    .subscription-popup .payment-method {
        display: flex;
        align-items: center;
        padding: 20px;
        border: 2px solid rgba(229, 209, 250, 0.3);
        border-radius: 15px;
        margin-bottom: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.05);
    }

    .subscription-popup .payment-method:hover {
        border-color: rgba(229, 209, 250, 0.6);
        background: rgba(255, 255, 255, 0.1);
        transform: translateY(-2px);
    }

    .subscription-popup .payment-method.selected {
        border-color: #1db954;
        background: rgba(29, 185, 84, 0.1);
        box-shadow: 0 0 20px rgba(29, 185, 84, 0.3);
    }

    .subscription-popup .payment-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: 700;
        margin-right: 20px;
    }

    .subscription-popup .payment-icon.stripe {
        background: linear-gradient(135deg, #635bff 0%, #4f46e5 100%);
        color: white;
    }

    .subscription-popup .payment-icon.google-pay {
        background: linear-gradient(135deg, #4285f4 0%, #34a853 100%);
        color: white;
    }

    .subscription-popup .payment-icon.apple-pay {
        background: linear-gradient(135deg, #000000 0%, #333333 100%);
        color: white;
    }

    .subscription-popup .payment-icon.paypal {
        background: linear-gradient(135deg, #0070ba 0%, #009cde 100%);
        color: white;
    }

    .subscription-popup .payment-icon.square {
        background: linear-gradient(135deg, #00a86b 0%, #00d4aa 100%);
        color: white;
    }

    .subscription-popup .payment-info h3 {
        font-size: 1.1rem;
        font-weight: 600;
        color: white;
        margin: 0 0 5px 0;
    }

    .subscription-popup .payment-info p {
        font-size: 0.9rem;
        color: rgba(229, 209, 250, 0.7);
        margin: 0;
    }

    .subscription-popup .payment-form {
        margin-top: 20px;
        padding: 20px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
    }

    .subscription-popup .form-group {
        margin-bottom: 15px;
    }

    .subscription-popup .form-group label {
        color: white;
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 10px;
        display: block;
    }

    .subscription-popup .subscription-terms {
        margin: 25px 0;
    }

    .subscription-popup .checkbox-container {
        display: flex;
        align-items: center;
        color: rgba(229, 209, 250, 0.9);
        font-size: 0.9rem;
        cursor: pointer;
    }

    .subscription-popup .checkbox-container input[type="checkbox"] {
        margin-right: 10px;
        width: 18px;
        height: 18px;
        cursor: pointer;
    }

    .subscription-popup .terms-link {
        color: #b794f6;
        text-decoration: underline;
    }

    .subscription-popup .popup-actions {
        display: flex;
        gap: 15px;
        margin-top: 25px;
    }

    .subscription-popup .btn-cancel,
    .subscription-popup .btn-confirm {
        flex: 1;
        padding: 15px;
        border: none;
        border-radius: 10px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .subscription-popup .btn-cancel {
        background: rgba(255, 255, 255, 0.1);
        color: white;
    }

    .subscription-popup .btn-cancel:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    .subscription-popup .btn-confirm {
        background: linear-gradient(135deg, #b794f6, #9d50bb);
        color: white;
    }

    .subscription-popup .btn-confirm:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(183, 148, 246, 0.4);
    }

    .stripe-card-element,
    .square-card-element {
        padding: 15px;
        background: white;
        border-radius: 8px;
        margin-top: 10px;
    }

    .stripe-card-errors,
    .square-card-errors,
    .payment-errors {
        color: #ef4444;
        font-size: 0.85rem;
        margin-top: 10px;
    }
</style>
@endsection

@section('content')



       <!-- Start of InnerBanner -->
       <section class="inner-banner contact-banner">
            <div class="contact_child">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="h1-title wow fadeup-animation" data-wow-duration="0.8s" data-wow-delay="0.2s">
                                Artist Pro Membership
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End of InnerBanner -->

        <section class="subscriptioin py-5" style="background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);">
            <div class="container">
                <!-- Hero -->
                <div class="hero text-center mb-5">
                    <h2 style="color: #fbfbfb; font-size: 2.5rem; margin-bottom: 15px;">Artist <span class="un_Span" style="color: #b794f6;">Subscription</span> Plans</h2>
                    <p style="color: #b8a8d0; font-size: 1.1rem; max-width: 800px; margin: 0 auto;">Choose the perfect plan to grow your music career. Upgrade anytime to unlock more features and reach a wider audience.</p>
                </div>

                <!-- Subscription Plans Grid -->
                <div class="row justify-content-center mb-5">
                    @foreach($artist_plans as $index => $plan)
                        @php
                            $isPopular = $plan->plan_slug == 'pro-artist';
                        @endphp
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="plan-card-artist" style="background: rgba(45, 27, 78, 0.6); border: 1px solid rgba(183, 148, 246, 0.3); border-radius: 15px; padding: 30px; height: 100%; position: relative; transition: transform 0.3s ease, box-shadow 0.3s ease; {{ $isPopular ? 'border: 2px solid #b794f6; transform: scale(1.05);' : '' }}">
                                @if($isPopular)
                                    <div style="position: absolute; top: -15px; right: 20px; background: linear-gradient(135deg, #b794f6, #9d50bb); color: white; padding: 8px 20px; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">Most Popular</div>
                                @endif
                                
                                <div class="text-center mb-4">
                                    <h3 style="color: #fbfbfb; font-size: 1.8rem; margin-bottom: 10px;">{{ $plan->plan_name }}</h3>
                                    <div style="color: #b8a8d0; font-size: 0.95rem; margin-bottom: 15px;">{{ $plan->ideal_for }}</div>
                                    <div style="color: #b794f6; font-size: 2.5rem; font-weight: bold; margin-bottom: 5px;">
                                        @if($plan->monthly_fee > 0)
                                            {{ $plan->currency }} {{ number_format($plan->monthly_fee, 2) }}
                                        @else
                                            Free
                                        @endif
                                    </div>
                                    <div style="color: #b8a8d0; font-size: 0.9rem;">per month</div>
                                </div>

                                <ul style="list-style: none; padding: 0; margin: 25px 0;">
                                    @if($plan->songs_per_month)
                                        <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                            <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                            Upload up to {{ $plan->songs_per_month }} songs per month
                                        </li>
                                    @elseif($plan->is_unlimited_uploads)
                                        <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                            <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                            Unlimited song uploads
                                        </li>
                                    @endif
                                    
                                    <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                        <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                        Access to community feed & comments
                                    </li>
                                    
                                    <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                        <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                        Basic analytics (plays, likes, shares)
                                    </li>
                                    
                                    <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                        <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                        Profile customization tools
                                    </li>
                                    
                                    @if($plan->is_featured_rotation)
                                        <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                            <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                            Featured on front page rotation ({{ $plan->featured_rotation_weeks }} week{{ $plan->featured_rotation_weeks > 1 ? 's' : '' }} per month)
                                        </li>
                                    @endif
                                    
                                    @if($plan->is_priority_search)
                                        <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                            <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                            Priority placement in search results
                                        </li>
                                    @endif
                                    
                                    @if($plan->is_custom_banner)
                                        <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                            <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                            Custom banner/profile cover
                                        </li>
                                    @endif
                                    
                                    @if($plan->is_isrc_codes)
                                        <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                            <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                            ISRC codes assigned to each release
                                        </li>
                                    @endif
                                    
                                    @if($plan->is_early_access_insights)
                                        <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                            <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                            Early access to platform insights & music trends
                                        </li>
                                    @endif
                                    
                                    @if($plan->is_certified_badge)
                                        <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                            <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                            "Certified Creator" badge on profile
                                        </li>
                                    @endif
                                    
                                    @if($plan->is_showcase_placement)
                                        <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                            <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                            Placement in Certified Creators Showcase
                                        </li>
                                    @endif
                                    
                                    @if($plan->is_royalty_tracking)
                                        <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                            <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                            Official royalty tracking with ISRC integration
                                        </li>
                                    @endif
                                    
                                    @if($plan->is_playlist_highlighted)
                                        <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                            <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                            Highlighted inclusion in curated playlists
                                        </li>
                                    @endif
                                    
                                    @if($plan->is_advanced_analytics)
                                        <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                            <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                            Advanced analytics (listener demographics, regional data)
                                        </li>
                                    @endif
                                    
                                    @if($plan->is_showcase_invitations)
                                        <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                            <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                            Invitations to online showcases, collaborations & promo campaigns
                                        </li>
                                    @endif
                                </ul>

                                <div class="text-center mt-4">
                                    <button onclick="openArtistSubscriptionPopup('{{ $plan->id }}', '{{ $plan->plan_name }}', '{{ $plan->monthly_fee }}', 'per month')" class="btn" style="background: {{ $isPopular ? 'linear-gradient(135deg, #b794f6, #9d50bb)' : 'rgba(183, 148, 246, 0.3)' }}; color: white; border: 1px solid rgba(183, 148, 246, 0.5); padding: 12px 30px; border-radius: 8px; text-decoration: none; display: inline-block; font-weight: 600; width: 100%; cursor: pointer;">
                                        {{ $plan->monthly_fee > 0 ? 'Subscribe Now' : 'Get Started' }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Service Features Info -->
                @if($artistsubscriptions->count() > 0)
                <div class="mt-5">
                    <h3 style="color: #fbfbfb; text-align: center; margin-bottom: 30px; font-size: 2rem;">What's Included in All Plans</h3>
                    <div class="features-grid">
                        @foreach($artistsubscriptions as $artistsubscription)
                            <div class="feature-card" style="background: rgba(45, 27, 78, 0.6); border: 1px solid rgba(183, 148, 246, 0.3); border-radius: 15px; padding: 25px;">
                                <h3 style="color: #b794f6; margin-bottom: 15px;">{{ $artistsubscription->title }}</h3>
                                <p style="color: #b8a8d0; line-height: 1.8;">{!! $artistsubscription->description !!}</p>
                            </div>
                        @endforeach               
                    </div>
                </div>
                @endif
            </div>
        </section>


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

                    <!-- Artist 1 -->
                    <a href="/allartist">
                    <div class="artist-card">
                        <div class="artist-image-wrapper">
                            <img class="artist-image" src="https://img.freepik.com/premium-photo/musician-recording-song-home-studio_919955-56272.jpg" alt="">
                            <div class="play-button"></div>
                        </div>
                        <div class="artist-info">
                            <div class="artist-name">Jay Nova</div>
                            <div class="artist-genre">Electronic, Hip-Hop</div>
                            <div class="artist-stats">
                                <span>2.4M Followers</span>
                                <span>5.8M Monthly Listeners</span>
                            </div>
                            <span class="genre-tag">Trending</span>
                        </div>
                    </div>
                    </a>

                    <!-- Artist 2 -->
                    <a href="/allartist">
                    <div class="artist-card">
                        <div class="artist-image-wrapper">
                            <img class="artist-image" src="https://img.freepik.com/premium-photo/person-with-headphones-guitar-their-hands_1276913-11243.jpg" alt="">
                            <div class="play-button"></div>
                        </div>
                        <div class="artist-info">
                            <div class="artist-name">Sarah Chen</div>
                            <div class="artist-genre">Alternative Rock</div>
                            <div class="artist-stats">
                                <span>1.8M Followers</span>
                                <span>4.2M Monthly Listeners</span>
                            </div>
                            <span class="genre-tag">Rising</span>
                        </div>
                    </div>
                    </a>
                    <!-- Artist 3 -->
                    <a href="/allartist">
                    <div class="artist-card">
                        <div class="artist-image-wrapper">
                            <img class="artist-image" src="https://img.freepik.com/premium-photo/young-musician-making-sound-new-song_73070-3466.jpg" alt="">
                            <div class="play-button"></div>
                        </div>
                        <div class="artist-info">
                            <div class="artist-name">Marcus Steel</div>
                            <div class="artist-genre">Rock, Metal</div>
                            <div class="artist-stats">
                                <span>3.2M Followers</span>
                                <span>7.1M Monthly Listeners</span>
                            </div>
                            <span class="genre-tag">Top Artist</span>
                        </div>
                    </div>
                    </a>
                    <!-- Artist 4 -->
                    <a href="/allartist">
                    <div class="artist-card">
                        <div class="artist-image-wrapper">
                            <img class="artist-image" src="https://img.freepik.com/premium-photo/drums-lights-all-energy-studio-rehearsal_1092689-79439.jpg" alt="">
                            <div class="play-button"></div>
                        </div>
                        <div class="artist-info">
                            <div class="artist-name">Austin Rivers</div>
                            <div class="artist-genre">IN Pop</div>
                            <div class="artist-stats">
                                <span>1.5M Followers</span>
                                <span>3.6M Monthly Listeners</span>
                            </div>
                            <span class="genre-tag">New</span>
                        </div>
                    </div>
                    </a>
                    <!-- Artist 5 -->
                    <a href="/allartist">
                    <div class="artist-card">
                        <div class="artist-image-wrapper">
                            <img class="artist-image" src="https://img.freepik.com/premium-photo/man-wearing-goggles-microphone-is-playing-music_1276913-10156.jpg" alt="">
                            <div class="play-button"></div>
                        </div>
                        <div class="artist-info">
                            <div class="artist-name">Alex Jordan</div>
                            <div class="artist-genre">R&B, Soul</div>
                            <div class="artist-stats">
                                <span>2.1M Followers</span>
                                <span>4.9M Monthly Listeners</span>
                            </div>
                            <span class="genre-tag">Featured</span>
                        </div>
                    </div>
                    </a>
                    <!-- Artist 6 -->
                    <a href="/allartist">
                    <div class="artist-card">
                        <div class="artist-image-wrapper">
                            <img class="artist-image" src="https://img.freepik.com/premium-photo/recording-studio-bathed-moody_1036891-2233.jpg" alt="">
                            <div class="play-button"></div>
                        </div>
                        <div class="artist-info">
                            <div class="artist-name">Echo Martinez</div>
                            <div class="artist-genre">Electronic, Ambient</div>
                            <div class="artist-stats">
                                <span>989K Followers</span>
                                <span>2.3M Monthly Listeners</span>
                            </div>
                            <span class="genre-tag">Discovery</span>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-12">
                                <div class="btn-part wow fadeup-animation" data-wow-duration="0.8s" data-wow-delay="0.6s">
                                    <a href="/allartist" class="sec-btn" title="view more">view more</a>
                                </div>
                            </div>
            </div>
        </section>
        <!-- End of Artist Section -->


        @include('partials.frontend.newsletter')

        <!-- Artist Subscription Purchase Popup -->
        <div class="subscription-popup" id="artistSubscriptionPopup" style="z-index: 9999999; display: none;">
            <div class="overlay" onclick="closeArtistSubscriptionPopup(event)">
                <div class="popup" onclick="event.stopPropagation()">
                    <div class="popup-header">
                        <h2 class="popup-title">Purchase Artist Subscription</h2>
                        <button class="close-btn" onclick="closeArtistSubscriptionPopup()">&times;</button>
                    </div>

                    <div class="subscription-details">
                        <div class="plan-info">
                            <h3 id="selectedArtistPlanName">Pro Artist</h3>
                            <div class="plan-price" id="selectedArtistPlanPrice">£9.99</div>
                            <div class="plan-period" id="selectedArtistPlanPeriod">per month</div>
                        </div>

                        <div class="payment-methods">
                            <h4>Choose Payment Method</h4>
                            
                            <div class="payment-method" onclick="selectArtistPaymentMethod(this, 'stripe')">
                                <div class="payment-icon stripe">S</div>
                                <div class="payment-info">
                                    <h3>Stripe</h3>
                                    <p>Pay securely with Stripe</p>
                                </div>
                            </div>

                            <div class="payment-method" onclick="selectArtistPaymentMethod(this, 'google-pay')">
                                <div class="payment-icon google-pay">G</div>
                                <div class="payment-info">
                                    <h3>Google Pay</h3>
                                    <p>Quick and secure payment via Stripe</p>
                                </div>
                            </div>

                            <div class="payment-method" onclick="selectArtistPaymentMethod(this, 'apple-pay')">
                                <div class="payment-icon apple-pay">AP</div>
                                <div class="payment-info">
                                    <h3>Apple Pay</h3>
                                    <p>Pay with Touch ID or Face ID via Stripe</p>
                                </div>
                            </div>

                            <div class="payment-method" onclick="selectArtistPaymentMethod(this, 'paypal')">
                                <div class="payment-icon paypal">P</div>
                                <div class="payment-info">
                                    <h3>PayPal</h3>
                                    <p>Pay with your PayPal account</p>
                                </div>
                            </div>

                            <div class="payment-method" onclick="selectArtistPaymentMethod(this, 'square')">
                                <div class="payment-icon square">Sq</div>
                                <div class="payment-info">
                                    <h3>Square</h3>
                                    <p>Secure payment processing</p>
                                </div>
                            </div>
                        </div>

                        <!-- Stripe Payment Form (Hidden by default) -->
                        <div id="artist-stripe-payment-form" class="payment-form" style="display: none;">
                            <div class="form-group">
                                <label>Card Details</label>
                                <div id="artist-stripe-card-element" class="stripe-card-element">
                                    <!-- Stripe Elements will create form elements here -->
                                </div>
                                <div id="artist-stripe-card-errors" class="stripe-card-errors"></div>
                            </div>
                        </div>

                        <!-- PayPal Payment Button (Hidden by default) -->
                        <div id="artist-paypal-payment-button" class="payment-form" style="display: none;">
                            <div id="artist-paypal-button-container"></div>
                        </div>

                        <!-- Google Pay Payment Form (Hidden by default) -->
                        <div id="artist-google-pay-payment-form" class="payment-form" style="display: none;">
                            <div class="form-group">
                                <label>Google Pay</label>
                                <div id="artist-google-pay-button-container" class="google-pay-container">
                                    <!-- Google Pay button will be rendered here -->
                                </div>
                                <div id="artist-google-pay-errors" class="payment-errors"></div>
                            </div>
                        </div>

                        <!-- Apple Pay Payment Form (Hidden by default) -->
                        <div id="artist-apple-pay-payment-form" class="payment-form" style="display: none;">
                            <div class="form-group">
                                <label>Apple Pay</label>
                                <div class="payment-info-text">
                                    <p>Apple Pay will be processed securely through Stripe. Click "Purchase Now" to proceed.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Square Payment Form (Hidden by default) -->
                        <div id="artist-square-payment-form" class="payment-form" style="display: none;">
                            <div class="form-group">
                                <label>Card Details</label>
                                <div class="square-card-container">
                                    <div id="artist-square-card-element" class="square-card-element">
                                        <p style="text-align: center; color: #666; padding: 20px;">Loading card input...</p>
                                    </div>
                                    <div id="artist-square-card-errors" class="square-card-errors"></div>
                                </div>
                            </div>
                        </div>

                        <div class="subscription-terms">
                            <label class="checkbox-container">
                                <input type="checkbox" id="agreeArtistTerms" required>
                                <span class="checkmark"></span>
                                I agree to the <a href="#" class="terms-link">Terms of Service</a> and <a href="#" class="terms-link">Privacy Policy</a>
                            </label>
                        </div>
                    </div>

                    <div class="popup-actions">
                        <button class="btn-cancel" onclick="closeArtistSubscriptionPopup()">Cancel</button>
                        <button class="btn-confirm" onclick="purchaseArtistSubscription()">Purchase Now</button>
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID', 'YOUR_CLIENT_ID') }}&currency=GBP"></script>
<script src="https://sandbox.web.squarecdn.com/v1/square.js"></script>
<script>
let selectedArtistPlan = null;
let selectedArtistPaymentMethod = null;
let stripe = null;
let stripeCardElement = null;
let paypalButtons = null;
let squareCard = null;

// Initialize Stripe
document.addEventListener('DOMContentLoaded', function() {
    const stripeKey = '{{ env("STRIPE_KEY", "") }}';
    if (stripeKey) {
        stripe = Stripe(stripeKey);
    }
});

function openArtistSubscriptionPopup(planId, planTitle, planPrice, planDuration) {
    selectedArtistPlan = planId;
    selectedArtistPaymentMethod = null;
    
    const popup = document.getElementById('artistSubscriptionPopup');
    const planName = document.getElementById('selectedArtistPlanName');
    const priceEl = document.getElementById('selectedArtistPlanPrice');
    const periodEl = document.getElementById('selectedArtistPlanPeriod');
    
    // Reset payment method selection
    document.querySelectorAll('#artistSubscriptionPopup .payment-method').forEach(method => {
        method.classList.remove('selected');
    });
    
    // Hide all payment forms
    document.querySelectorAll('#artistSubscriptionPopup .payment-form').forEach(form => {
        form.style.display = 'none';
    });
    
    // Reset terms checkbox
    document.getElementById('agreeArtistTerms').checked = false;
    
    // Update plan details
    planName.textContent = planTitle;
    if (planPrice == '0' || planPrice == 0) {
        priceEl.textContent = 'Free';
        periodEl.textContent = 'forever';
    } else {
        priceEl.textContent = '£' + parseFloat(planPrice).toFixed(2);
        periodEl.textContent = planDuration;
    }
    
    popup.style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function closeArtistSubscriptionPopup(event) {
    if (event && event.target !== event.currentTarget) return;
    
    const popup = document.getElementById('artistSubscriptionPopup');
    popup.style.display = 'none';
    document.body.style.overflow = '';
    
    selectedArtistPlan = null;
    selectedArtistPaymentMethod = null;
}

function selectArtistPaymentMethod(element, method) {
    // Remove selection from all payment methods
    document.querySelectorAll('#artistSubscriptionPopup .payment-method').forEach(m => {
        m.classList.remove('selected');
    });
    
    // Hide all payment forms
    document.querySelectorAll('#artistSubscriptionPopup .payment-form').forEach(form => {
        form.style.display = 'none';
    });
    
    // Add selection to clicked method
    element.classList.add('selected');
    selectedArtistPaymentMethod = method;
    
    // Show appropriate payment form
    if (method === 'stripe') {
        showArtistStripeForm();
    } else if (method === 'paypal') {
        showArtistPayPalForm();
    } else if (method === 'google-pay') {
        showArtistGooglePayForm();
    } else if (method === 'apple-pay') {
        showArtistApplePayForm();
    } else if (method === 'square') {
        showArtistSquareForm();
    }
}

function showArtistStripeForm() {
    const stripeForm = document.getElementById('artist-stripe-payment-form');
    stripeForm.style.display = 'block';
    
    if (!stripeCardElement && stripe) {
        const elements = stripe.elements();
        stripeCardElement = elements.create('card', {
            style: {
                base: {
                    fontSize: '16px',
                    color: '#424770',
                },
            },
        });
        
        stripeCardElement.mount('#artist-stripe-card-element');
        
        stripeCardElement.on('change', function(event) {
            const displayError = document.getElementById('artist-stripe-card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
    }
}

function showArtistPayPalForm() {
    const paypalForm = document.getElementById('artist-paypal-payment-button');
    paypalForm.style.display = 'block';
    
    if (!paypalButtons && typeof paypal !== 'undefined') {
        const planPriceEl = document.getElementById('selectedArtistPlanPrice');
        const planPriceText = planPriceEl.textContent.replace('£', '').replace('Free', '0');
        const planPrice = parseFloat(planPriceText) || 0;
        
        paypalButtons = paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: planPrice.toString()
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    processArtistPaymentWithMethod('paypal', details.id);
                });
            },
            onError: function(err) {
                alert('PayPal payment failed: ' + err.message);
            }
        });
        
        paypalButtons.render('#artist-paypal-button-container');
    }
}

function showArtistGooglePayForm() {
    document.getElementById('artist-google-pay-payment-form').style.display = 'block';
}

function showArtistApplePayForm() {
    document.getElementById('artist-apple-pay-payment-form').style.display = 'block';
}

function showArtistSquareForm() {
    document.getElementById('artist-square-payment-form').style.display = 'block';
}

async function purchaseArtistSubscription() {
    if (!selectedArtistPlan || selectedArtistPlan === 'free') {
        alert('Please select a valid plan');
        return;
    }
    
    if (!selectedArtistPaymentMethod) {
        alert('Please select a payment method');
        return;
    }
    
    if (!document.getElementById('agreeArtistTerms').checked) {
        alert('Please agree to the terms and conditions');
        return;
    }
    
    // Handle different payment methods
    if (selectedArtistPaymentMethod === 'stripe') {
        await processArtistStripePayment();
    } else if (selectedArtistPaymentMethod === 'paypal') {
        alert('Please complete the PayPal payment above');
        return;
    } else if (selectedArtistPaymentMethod === 'google-pay' || selectedArtistPaymentMethod === 'apple-pay') {
        await processArtistPaymentWithMethod(selectedArtistPaymentMethod);
    } else if (selectedArtistPaymentMethod === 'square') {
        await processArtistSquarePayment();
    } else {
        await processArtistPaymentWithMethod(selectedArtistPaymentMethod);
    }
}

async function processArtistStripePayment() {
    if (!stripe || !stripeCardElement) {
        alert('Stripe not initialized');
        return;
    }
    
    try {
        const { paymentMethod, error } = await stripe.createPaymentMethod({
            type: 'card',
            card: stripeCardElement,
        });
        
        if (error) {
            alert('Card error: ' + error.message);
            return;
        }
        
        await processArtistPaymentWithMethod('stripe', paymentMethod.id);
    } catch (error) {
        console.error('Stripe payment error:', error);
        alert('Payment failed: ' + error.message);
    }
}

async function processArtistSquarePayment() {
    await processArtistPaymentWithMethod('square', 'mock_token');
}

async function processArtistPaymentWithMethod(method, paymentMethodId = null) {
    try {
        const planNameEl = document.getElementById('selectedArtistPlanName');
        const planPriceEl = document.getElementById('selectedArtistPlanPrice');
        const planPriceText = planPriceEl.textContent.replace('£', '').replace('Free', '0');
        const planPrice = parseFloat(planPriceText) || 0;
        
        const paymentMethodNames = {
            'stripe': 'Stripe',
            'google-pay': 'Google Pay (via Stripe)',
            'apple-pay': 'Apple Pay (via Stripe)',
            'paypal': 'PayPal',
            'square': 'Square'
        };
        
        const response = await fetch('/api/artist-subscription/purchase', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                plan_id: selectedArtistPlan,
                plan_type: planNameEl.textContent.toLowerCase().replace(/\s+/g, '-'),
                price: planPrice,
                duration: 30,
                payment_method: method,
                payment_method_name: paymentMethodNames[method] || method,
                payment_method_id: paymentMethodId
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            alert('Artist subscription purchased successfully!');
            closeArtistSubscriptionPopup();
            window.location.reload();
        } else {
            alert(data.message || 'Failed to purchase subscription');
        }
    } catch (error) {
        console.error('Subscription purchase error:', error);
        alert('Failed to purchase subscription. Please try again.');
    }
}
</script>
@endsection
