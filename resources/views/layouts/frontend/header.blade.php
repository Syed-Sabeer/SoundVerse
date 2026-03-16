
<style>
    .site-header {
        position: relative;
        width: 100%;
        top: 0;
        z-index: 1000;
        transition: all 0.5s ease-in-out;
    }

    .site-header.fixed {
        position: fixed;
        top: 0;
        left: 0;
        background: linear-gradient(135deg, #a66bef, #4d3d7e, #1d0c2e);
        /* match your nav bar bg */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }
    .un_header .container-fluid {
        padding-bottom: 30px;
        position: relative;
        z-index: 11112;
    }
    


    
</style>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
            integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />


        <header class="site-header un_header">
            <div class="container-fluid">
                <div class="row align-items-center navROW">
                    <div class="col-md-12 col-lg-1 col-xl-1 col-xxl-2">
                        <div class="site-branding">
                            <a href="/" title="SingWithMe Records Ltd.">
                                <img src="{{asset('FrontendAssets/images/singWithMe/logo-trans.png')}}" alt="Logo New">
                                 <!-- SingWithMe -->
                                <!-- sound track -->
                            </a>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-11 col-xl-11 col-xxl-10">
                        <div class="main-navigation">
                            <button class="hamburger for-mob">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <div class="header-menu">
                                <div class="menu-main-menu-container">
                                    <ul>
                                        <li><a href="{{route('home')}}" title="Home">Home</a></li>
                                        <li class="un_dropdown">
                                        <a href="{{route('about')}}" title="About Us">About Us</a>
                                        <ul class="service_drop">
                                                <li><a href="{{route('about')}}">About Us</a></li>
                                                <li><a href="{{route('about.majorpowel')}}">About Major Powel</a></li>
                                            </ul>
                                        </li>
                                        <li class="un_dropdown">
                                            <a href="#" title="Services">Services</a>
                                            <ul class="service_drop service_drop_2">
                                                <li><a href="{{route('service.musicvideo')}}">Music & Video Upload</a></li>
                                                <li><a href="{{route('service.royaltycollection')}}">Royalty Collection</a></li>
                                                <li><a href="{{route('service.artisitsubscription')}}">Artist Subscription Plan</a></li>
                                                <li><a href="{{route('service.artworkphoto')}}">Artwork & Photo Upload</a></li>
                                                <li><a href="{{route('service.supportnetworking')}}">Support & Networking</a></li>
                                                <li><a href="/privacy-policy">Privacy Policy</a></li>
                                                <li><a href="/artist-agreement">Digital Artist Agreement</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="{{route('share.music')}}" title="Artist Portal">Share Your Music </a></li>
                                        <li><a href="{{ route('user.portal') }}" title="Artist Portal">User Portal </a></li>
                                        <li><a href="{{ route('artist.portal') }}" title="Artist Portal">Artist Portal </a></li>
                                        <li><a href="{{route('contact')}}" title="Contact Form">Contact Form</a></li>
                                        <!-- <li><a href="index-2.html#songs" title="Songs">Songs</a></li>
                                        <li><a href="contact-us.html" title="Contact Us">Contact Us</a></li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                         {{-- <div class="navSearchBar">
                        <div class="search-box">
                            <button class="btn-search"><i class="fas fa-search"></i></button>
                            <input type="text" class="input-search" placeholder="Search...">
                        </div>
                        </div> --}}
                        <div class="notification-parent">
                                        <div class="nav-actions">
                                            <!-- Notification Bell -->
                                            <div class="notification-bell" onclick="toggleQuickNotifications()" 
                                                role="button" 
                                                aria-label="Notifications" 
                                                aria-expanded="false"
                                                tabindex="0"
                                                onkeydown="handleKeyPress(event, toggleQuickNotifications)">
                                                <svg class="bell-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                                </svg>
                                                <div class="notification-badge" id="notificationBadge">0</div>
                                            </div>
                                        </div>

                                        <!-- Quick Notifications Popup (Popup 1) -->
                                        <div class="quick-notifications" id="quickNotifications" role="dialog" aria-label="Quick Notifications">
                                            <div class="quick-notifications-header">
                                                <h3>Notifications</h3>
                                                <span class="header-badge" id="headerBadge">0 New</span>
                                            </div>

                                            <div class="notifications-list" id="quickNotificationsList">
                                                <!-- Notifications will be inserted here by JavaScript -->
                                            </div>

                                            <button class="view-all-btn" onclick="openFullNotifications()" tabindex="0">
                                                <span>View All Notifications</span>
                                            </button>
                                        </div>
                                    


                                        <!-- Full Notifications Modal (Popup 2) -->
                                        <div class="full-notifications-modal" id="fullNotificationsModal" role="dialog" aria-label="All Notifications">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2>All Notifications</h2>
                                                    <button class="close-btn" onclick="closeFullNotifications()" aria-label="Close" tabindex="0">
                                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                    </button>
                                                </div>

                                                <div class="filter-tabs">
                                                    <button class="tab-btn active" data-filter="all" onclick="filterNotifications('all')" tabindex="0">
                                                        All Notifications
                                                    </button>
                                                    <button class="tab-btn" data-filter="unread" onclick="filterNotifications('unread')" tabindex="0">
                                                        Unread
                                                    </button>
                                                </div>

                                                <div class="action-buttons">
                                                    <button class="action-btn" onclick="markAllAsRead()" tabindex="0">
                                                        Mark All as Read
                                                    </button>
                                                    <button class="action-btn" onclick="clearAllNotifications()" tabindex="0">
                                                        Clear All
                                                    </button>
                                                </div>

                                                <div class="full-notifications-list" id="fullNotificationsList">
                                                    <!-- Full notifications will be inserted here by JavaScript -->
                                                </div>
                                            </div>
                                        </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="newsbar">
        <span class="news-label">Latest News:</span>
        <div class="news-ticker">
            <div class="news-items">
                @foreach ($news as $news)
                <span>{{$news->title}}</span>
                @endforeach



            </div>
        </div>
    </div>
        </header>

         <a href="https://wa.me/441234567890" target="_blank" class="whatsapp-button">
            <i class="fab fa-whatsapp"></i>
        </a>


            <div class="mobile-nav2">
                <ul class="mobile-nav2-ul">

                    <!-- item 7 -->
                    <li class="relative group li-icon">
                        <a href="{{ route('artist.portal') }}" class="text-lg xl:text-15px 2xl:text-lg hover:text-secondary-color font-semibold whitespace-nowrap d-flex"><i class="fa-solid fa-music"></i>
                            Artist</a>
                    </li>

                    <!-- item 4 -->
                    <li class="relative group li-icon">
                        <a id="chatbotTogglelivechat" href="#" class="text-lg xl:text-15px 2xl:text-lg hover:text-secondary-color font-semibold whitespace-nowrap d-flex"><i class="fa-regular fa-comments"></i>
                            Live Chat</a>
                    </li>

                    <!-- item 6 -->
                    <li class="relative group li-icon">
                        <a href="https://wa.me/441234567890" class="text-lg xl:text-15px 2xl:text-lg hover:text-secondary-color font-semibold whitespace-nowrap d-flex whtsp"><img class="whatsApp-logo" src="{{asset('FrontendAssets/images/singWithMe/ws-icon.png')}}" alt="" width="50px">
                            Ask US</a>
                    </li>

                    <!-- item 8 -->
                    <li class="relative group li-icon">
                        <a href="tel:+44(0)1234567890" class="text-lg xl:text-15px 2xl:text-lg hover:text-secondary-color font-semibold whitespace-nowrap d-flex"><i class="fa-solid fa-phone-volume"></i>
                            Call</a>
                    </li>

                    <!-- item 5 -->
                    <li class="relative group li-icon">
                        <a href="/artist/login" class="text-lg xl:text-15px 2xl:text-lg hover:text-secondary-color font-semibold whitespace-nowrap d-flex"><i class="fa-solid fa-user"></i>
                            Login</a>
                    </li>
                </ul>
            </div>


            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const triggertwo = document.getElementById('chatbotTogglelivechat');
                    const widgettwo = document.getElementById('chatbotWidget');

                    triggertwo.addEventListener('click', function (e) {
                        e.preventDefault();

                        if (widgettwo.classList.contains('active')) {
                            widgettwo.classList.remove('active');
                        } else {
                            widgettwo.classList.add('active');
                        }
                    });
                });
            </script>




            {{-- <div class="parent-chatBot"> --}}
                {{-- <img id="chatbotGif" onclick="showBox()" style="cursor:pointer;" src="{{asset('FrontendAssets/images/singWithMe/chatbott.gif')}}" alt="" width="100px"> --}}

                {{-- <div class="chat-box" id="chatBox" style="display: none;">
                    <div class="chat-header">
                        <div class="title">
                            <img src="{{asset('FrontendAssets/images/singWithMe/bot.png')}}" alt="bot" />
                            <div style="text-align: left;">
                                <div>Customer Support</div>
                                <div class="status">• Online</div>
                            </div>
                        </div>
                        <div style="cursor: pointer;" onclick="hideBox()">✖</div>
                    </div>

                    <div class="chat-body">
                        <div class="chat-message">Hello how can I help you?</div>
                        <div class="chat-time">5:13pm</div>

                        <div class="quick-replies">
                            <button>About Us?</button>
                            <button>Your Location?</button>
                            <button>Your Timings?</button>
                            <button>About Your Services?</button>
                        </div>
                    </div>

                    <div class="chat-input">
                        <input type="text" placeholder="Type Message" />
                        <div class="emoji">😊</div>
                    </div>

                    <div class="chat-footer">
                        <button>End Chat</button>
                    </div>
                </div>
            </div> --}}


