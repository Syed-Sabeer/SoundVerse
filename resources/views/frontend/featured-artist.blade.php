@extends('layouts.frontend.master')


@section('css')

<style>
       
.secFeaturedArtist {
    position:relative;
}
        /* Header Section */
.secFeaturedArtist .header {
    text-align: center;
    padding: 80px 20px 40px;
}
.secFeaturedArtist a {
    color: inherit
    }
.secFeaturedArtist .header h1 {
    font-size: 3.5rem;
    font-weight: 700;
    background: linear-gradient(45deg, #a877ff, #ffffff);
    font-family: 'Poppins';
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 15px;
    //text-shadow: 0 0 40px rgba(168, 85, 247, 0.3);
    animation: glow 2s ease-in-out infinite alternate;
}

@keyframes glow {
    from { filter: drop-shadow(0 0 20px rgba(168, 85, 247, 0.3)); }
    to { filter: drop-shadow(0 0 40px rgba(168, 85, 247, 0.6)); }
}

.secFeaturedArtist .header p {
    font-size: 1.2rem;
    color: #f7f7f7 !important;
    margin-bottom: 10px;
}

.secFeaturedArtist .header .artist-count {
    font-size: 1rem;
    color: #f7f7f7 !important;
    margin-top: 10px;
    display:block;
}
#totalCount {
    #f7f7f7 !important
}
/* Sticky Filter Bar */
.secFeaturedArtist .filter-bar {
    background: #16002dc7 ;
    backdrop-filter: blur(10px);
    padding: 25px 0;
    position: sticky;
   top: 0;
    z-index: 100;
   border-bottom: 1px solid rgba(168, 85, 247, 0.2);
    //box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

.secFeaturedArtist .filter-container {
    display: flex;
    gap: 15px;
    align-items: center;
    flex-wrap: wrap;
}

.secFeaturedArtist .search-box {
    flex: 1;
    min-width: 250px;
    position: relative;
}

.secFeaturedArtist .search-box input {
    width: 100%;
    padding: 9px 20px 8px 45px;
    background: rgba(255, 255, 255, 0.05);
    border: 2px solid rgba(168, 85, 247, 0.3);
    border-radius: 12px;
    color: #fff;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.secFeaturedArtist .search-box input:focus {
    outline: none;
    border-color: #a855f7;
    box-shadow: 0 0 20px rgba(168, 85, 247, 0.4);
    background: rgba(255, 255, 255, 0.08);
}

.secFeaturedArtist .search-box::before {
    content: "🔍";
    position: absolute;
    left: 18px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 1.2rem;
    color: transparent;
    text-shadow: 0 0 0 #ffffff7d;
}

.secFeaturedArtist .filter-group {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.secFeaturedArtist select {
    padding: 9px 40px 14px 18px;
    background: rgba(255, 255, 255, 0.05);
    border: 2px solid rgba(168, 85, 247, 0.3);
    border-radius: 12px;
    color: #fff;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23a855f7' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 15px center;
    width:unset;
}

.secFeaturedArtist select:hover,
.secFeaturedArtist select:focus {
    outline: none;
    border-color: #a855f7;
    background-color: rgba(255, 255, 255, 0.08);
    box-shadow: 0 0 15px rgba(168, 85, 247, 0.3);
}

/* Artist Grid */
.secFeaturedArtist .artists-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 15px;
    padding: 50px 0;
    min-height: 600px;
}

/* Artist Card */
.secFeaturedArtist .artist-card {
    background: #16002dc7;
    border-radius: 20px;
    padding: 25px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    border: 2px solid rgba(168, 85, 247, 0.2);
    position: relative;
    overflow: hidden;
}

.secFeaturedArtist .artist-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(168, 85, 247, 0.1) 0%, rgba(236, 72, 153, 0.1) 100%);
    opacity: 0;
    transition: opacity 0.4s ease;
    pointer-events: none;
}

.secFeaturedArtist .artist-card:hover {
    transform: translateY(-10px);
    border-color: #a855f7;
    box-shadow: 0 20px 40px rgba(168, 85, 247, 0.3), 
                0 0 60px rgba(168, 85, 247, 0.2);
}

.secFeaturedArtist .artist-card:hover::before {
    opacity: 1;
}

.secFeaturedArtist .artist-image {
    width: 100%;
    aspect-ratio: 1;
    border-radius: 15px;
    object-fit: cover;
    margin-bottom: 20px;
    background: linear-gradient(135deg, #2a1a4a 0%, #3a2a5a 100%);
    transition: all 0.4s ease;
}

.secFeaturedArtist .artist-card:hover .artist-image {
    transform: scale(1.05);
    box-shadow: 0 10px 30px rgba(168, 85, 247, 0.4);
}

.secFeaturedArtist .artist-info {
    position: relative;
    z-index: 1;
}

.secFeaturedArtist .artist-name {
        font-size: 20px ;
    font-weight: 600 ;
    margin-bottom: 8px;
    color: #fff;
    font-family: 'Poppins';
}

.secFeaturedArtist .genre-tag {
    display: inline-block;
    padding: 2px 14px;
    background: rgba(168, 85, 247, 0.2);
    border: 1px solid rgba(168, 85, 247, 0.4);
    border-radius: 20px;
    font-size: 0.85rem;
    color: #c084fc;
    margin-bottom: 0px;
    font-family: 'Poppins'
}

.secFeaturedArtist .stats-row {
    display: flex;
    justify-content: space-between;
    margin: 15px 0;
    padding: 12px 0;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.secFeaturedArtist .stat {
    text-align: center;
}

.secFeaturedArtist .stat-value {
    font-size: 1.1rem;
    font-weight: 700;
    color: #a855f7;
    display: block;
}

.secFeaturedArtist .stat-label {
    font-size: 0.8rem;
    color: #7c7c9c;
    margin-top: 3px;
}

/* Status Badges */
.secFeaturedArtist .status-badge {
    position: absolute;
    top: 20px;
    right: 20px;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    z-index: 2;
}

.secFeaturedArtist .badge-trending {
    background: linear-gradient(135deg, #ec4899 0%, #f43f5e 100%);
    box-shadow: 0 4px 15px rgba(236, 72, 153, 0.4);
}

.secFeaturedArtist .badge-featured {
    background: linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%);
    box-shadow: 0 4px 15px rgba(168, 85, 247, 0.4);
}

.secFeaturedArtist .badge-rising {
    background: linear-gradient(135deg, #06b6d4 0%, #3b82f6 100%);
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
}

.secFeaturedArtist .badge-new {
    background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
}

/* View Profile Button */
.secFeaturedArtist .view-profile-btn {
    width: 100%;
    padding: 14px;
    background: linear-gradient(135deg, #a855f7 0%, #6e2db9 100%);
    border: none;
    border-radius: 12px;
    color: #fff;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 15px;
    position: relative;
    overflow: hidden;
}

.secFeaturedArtist .view-profile-btn::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.secFeaturedArtist .view-profile-btn:hover::before {
    width: 300px;
    height: 300px;
}

.secFeaturedArtist .view-profile-btn:hover {
    box-shadow: 0 8px 25px rgba(168, 85, 247, 0.5);
    transform: translateY(-2px);
}

/* Load More */
.secFeaturedArtist .load-more-section {
    text-align: center;
    padding: 0px 0 0px !important;
    display: flex;
    justify-content: center;
}

.secFeaturedArtist .load-more-btn {
    padding: 16px 50px;
    background: rgba(168, 85, 247, 0.2);
    border: 2px solid #a855f7;
    border-radius: 12px;
    color: #fff;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.secFeaturedArtist .load-more-btn:hover {
    background: linear-gradient(135deg, #a855f7 0%, #6e2db9 100%);
    box-shadow: 0 8px 25px rgba(168, 85, 247, 0.5);
    transform: translateY(-2px);
}

.secFeaturedArtist .load-more-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* Skeleton Loading */
.secFeaturedArtist .skeleton-card {
    background: linear-gradient(135deg, rgba(26, 10, 46, 0.7) 0%, rgba(22, 33, 62, 0.7) 100%);
    border-radius: 20px;
    padding: 25px;
    border: 2px solid rgba(168, 85, 247, 0.2);
    animation: pulse 1.5s ease-in-out infinite;
}

.secFeaturedArtist .skeleton-image {
    width: 100%;
    aspect-ratio: 1;
    border-radius: 15px;
    background: linear-gradient(90deg, rgba(168, 85, 247, 0.1) 25%, rgba(168, 85, 247, 0.2) 50%, rgba(168, 85, 247, 0.1) 75%);
    background-size: 200% 100%;
    animation: shimmer 1.5s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

@keyframes shimmer {
    0% { background-position: -200% 0; }
    100% { background-position: 200% 0; }
}

.secFeaturedArtist .skeleton-text {
    height: 20px;
    background: linear-gradient(90deg, rgba(168, 85, 247, 0.1) 25%, rgba(168, 85, 247, 0.2) 50%, rgba(168, 85, 247, 0.1) 75%);
    background-size: 200% 100%;
    animation: shimmer 1.5s infinite;
    border-radius: 4px;
    margin: 15px 0;
}

/* Responsive */
@media (max-width: 1024px) {
    .secFeaturedArtist .artists-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 25px;
    }
}

@media (max-width: 768px) {
    .secFeaturedArtist .header h1 {
        font-size: 2.5rem;
    }

    .secFeaturedArtist .filter-container {
        flex-direction: column;
    }

    .secFeaturedArtist .search-box,
    .secFeaturedArtist .filter-group {
        width: 100%;
    }

    .secFeaturedArtist .filter-group select {
        flex: 1;
    }

    .secFeaturedArtist .artists-grid {
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
    }
}

@media (max-width: 480px) {
    .secFeaturedArtist .header h1 {
        font-size: 2rem;
    }

    .secFeaturedArtist .artists-grid {
        grid-template-columns: 1fr;
    }
}

/* No Results */
.secFeaturedArtist .no-results {
    text-align: center;
    padding: 80px 20px;
    color: #7c7c9c;
}

.secFeaturedArtist .no-results h3 {
    font-size: 2rem;
    margin-bottom: 15px;
    color: #a0a0c0;
}

    </style>

@endsection

@section('content')


 <section class="secFeaturedArtist">
    <div class="header">
        <h1>All Artists</h1>
        <p>Discover music creators from every genre</p>
        <div class="artist-count"><span id="totalCount">{{ count($artists ?? []) }}</span> artists available</div>
    </div>

    <div class="filter-bar">
        <div class="container">
            <div class="filter-container">
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Search by artist name...">
                </div>
                <div class="filter-group">
                    <select id="genreFilter">
                        <option value="all">All Genres</option>
                        <option value="Pop">Pop</option>
                        <option value="Hip-Hop">Hip-Hop</option>
                        <option value="Rock">Rock</option>
                        <option value="Electronic">Electronic</option>
                        <option value="R&B">R&B</option>
                        <option value="Jazz">Jazz</option>
                        <option value="Country">Country</option>
                    </select>
                    <select id="statusFilter">
                        <option value="all">All Status</option>
                        <option value="Trending">Trending</option>
                        <option value="Featured">Featured</option>
                        <option value="Rising">Rising</option>
                        <option value="New">New</option>
                    </select>
                    <select id="sortFilter">
                        <option value="subscribers" selected>Most Subscribers</option>
                        <option value="listeners">Most Monthly Listeners</option>
                        <option value="newest">Newly Added</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="artists-grid" id="artistsGrid"></div>
        <div class="load-more-section">
            <button class="load-more-btn" id="loadMoreBtn">Load More Artists</button>
        </div>
    </div>
    </section>


    <script>
        const artists = [
            { name: "Jay Nova", genre: "Pop", followers: "2.4M", listeners: "8.9M", status: "Trending", img: "https://img.freepik.com/premium-photo/musician-recording-song-home-studio_919955-56272.jpg" },
            { name: "Sarah Chen", genre: "Alternative Rock", followers: "3.1M", listeners: "12.3M", status: "Featured", img: "	https://img.freepik.com/premium-photo/person-with-headphones-guitar-their-hands_1276913-11243.jpg" },
            { name: "Marcus Steel", genre: "Rock, Metal", followers: "1.8M", listeners: "6.5M", status: "Rising", img: "	https://img.freepik.com/premium-photo/young-musician-making-sound-new-song_73070-3466.jpg" },
            { name: "Austin Rivers", genre: "Hip-Hop", followers: "4.2M", listeners: "15.7M", status: "Trending", img: "https://img.freepik.com/premium-photo/drums-lights-all-energy-studio-rehearsal_1092689-79439.jpg" },
            { name: "Alex Jordan", genre: "R&B, Soul", followers: "2.1M", listeners: "7.8M", status: "Featured", img: "	https://img.freepik.com/premium-photo/man-wearing-…les-microphone-is-playing-music_1276913-10156.jpg" },
            { name: "Echo Martinez", genre: "Jazz", followers: "1.5M", listeners: "5.2M", status: "New", img: "	https://img.freepik.com/premium-photo/recording-studio-bathed-moody_1036891-2233.jpg" },
            { name: "River Banks", genre: "Country", followers: "2.9M", listeners: "10.4M", status: "Featured", img: "https://img.freepik.com/premium-photo/jazz-musician-playing-bass-guitar-studio-black-wall_926199-3446432.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_hybrid&w=740&q=80" },
            { name: "Neon Pulse", genre: "Electronic", followers: "3.5M", listeners: "13.1M", status: "Trending", img: "https://img.freepik.com/premium-photo/man-with-band-playing-accordion-front-building_1276913-11402.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_hybrid&w=740&q=80" },
            { name: "Jensan Mitchel", genre: "Pop", followers: "2.7M", listeners: "9.6M", status: "Rising", img: "https://img.freepik.com/premium-photo/high-quality-digital-image-wallpaper_783884-175373.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_hybrid&w=740&q=80" },
            { name: "James Smith", genre: "Rock", followers: "1.9M", listeners: "6.8M", status: "New", img: "https://img.freepik.com/premium-photo/man-character-design_961307-31255.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_hybrid&w=740&q=80" },
            { name: "Rhythm Soul", genre: "Hip-Hop", followers: "3.8M", listeners: "14.2M", status: "Featured", img: "https://img.freepik.com/premium-photo/girl-with-blonde-hair-is-working-dj_1204450-27322.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_hybrid&w=740&q=80" },
            { name: "Crystal Voice", genre: "R&B", followers: "2.3M", listeners: "8.1M", status: "Rising", img: "https://img.freepik.com/premium-photo/girl-wearing-headphones-jacket-with-word-dj-it_1204450-27968.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_hybrid&w=740&q=80" },
            { name: "Sunset Beats", genre: "Electronic", followers: "1.6M", listeners: "5.9M", status: "New", img: "https://img.freepik.com/premium-photo/man-with-laptop-front-laptop-with-smoke-coming-out-it_1308175-258945.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_hybrid&w=740&q=80" },
            { name: "Harmony Fields", genre: "Country", followers: "2.5M", listeners: "9.2M", status: "Featured", img: "https://img.freepik.com/premium-photo/man-operating-sound-mixing-console_1376201-3482.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_hybrid&w=740&q=80" },
            { name: "Urban Legend", genre: "Hip-Hop", followers: "4.1M", listeners: "15.3M", status: "Trending", img: "https://img.freepik.com/premium-photo/person-with-var-headset-advertising-photo_1096167-139032.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_hybrid&w=740&q=80" },
            { name: "Dream Catcher", genre: "Pop", followers: "3.2M", listeners: "11.8M", status: "Featured", img: "https://img.freepik.com/premium-photo/girl-with-headphones-djs-head-set_1204450-26577.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_hybrid&w=740&q=80" },
            { name: "Midnight Jazz", genre: "Jazz", followers: "1.4M", listeners: "4.8M", status: "Rising", img: "https://img.freepik.com/premium-photo/high-quality-digital-image-wallpaper_783884-173174.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_hybrid&w=740&q=80" },
            { name: "Electric Soul", genre: "R&B", followers: "2.6M", listeners: "9.4M", status: "Trending", img: "https://img.freepik.com/premium-photo/girl-dj-stage-playing-turntables_1278587-16983.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_hybrid&w=740&q=80" },
            { name: "Rock Fusion", genre: "Rock", followers: "3.3M", listeners: "12.6M", status: "Featured", img: "https://img.freepik.com/premium-photo/visual-spectacle-singer-nightclub-with-colorful-lights-vibrant-crowd_675864-739.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_hybrid&w=740&q=80" },
            { name: "Velvet Sound", genre: "Electronic", followers: "2.0M", listeners: "7.2M", status: "New", img: "https://img.freepik.com/premium-photo/radio-host-engaging-with-listeners-by-taking-calls-live-show_1327465-56938.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_hybrid&w=740&q=80" },
            { name: "Phoenix Rise", genre: "Pop", followers: "3.6M", listeners: "13.5M", status: "Trending", img: "https://img.freepik.com/premium-photo/young-woman-with-long-blue-hair-wearing-headphones_1274264-9944.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_hybrid&w=740&q=80" },
            { name: "Soul Train", genre: "R&B", followers: "1.7M", listeners: "6.1M", status: "Rising", img: "https://img.freepik.com/premium-photo/photo-young-girl-boy-man-listen-music-by-headphones_763111-45516.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_hybrid&w=740&q=80" },
            { name: "Thunder Road", genre: "Rock", followers: "2.8M", listeners: "10.7M", status: "Featured", img: "https://img.freepik.com/premium-photo/man-sits-chair-piano-keyboard_1276913-11602.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_hybrid&w=740&q=80" },
            { name: "Digital Dreams", genre: "Electronic", followers: "3.4M", listeners: "12.9M", status: "Trending", img: "https://img.freepik.com/premium-photo/passionate-musician-photo-man-singing-playing-guitar-with-intensity_1088041-58655.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_hybrid&w=740&q=80" }
        ];

        let displayedArtists = [];
        let filteredArtists = [];
        let currentPage = 1;
        const artistsPerPage = 12;

        function formatNumber(num) {
            if (num >= 1000000) {
                return (num / 1000000).toFixed(1) + 'M';
            } else if (num >= 1000) {
                return (num / 1000).toFixed(1) + 'K';
            }
            return num.toString();
        }

        function createArtistCard(artist) {
            return `
            <a href="/artist-profile">
                <div class="artist-card" onclick="viewProfile('${artist.name}')">
                    <span class="status-badge badge-${artist.status.toLowerCase()}">${artist.status}</span>
                    <img src="${artist.img}" alt="${artist.name}" class="artist-image" loading="lazy">
                    <div class="artist-info">
                        <h3 class="artist-name">${artist.name}</h3>
                        <span class="genre-tag">${artist.genre}</span>
                        <div class="stats-row">
                            <div class="stat">
                                <span class="stat-value">${artist.followers}</span>
                                <span class="stat-label">Followers</span>
                            </div>
                            <div class="stat">
                                <span class="stat-value">${artist.listeners}</span>
                                <span class="stat-label">Monthly Listeners</span>
                            </div>
                        </div>
                        <button class="view-profile-btn">View Profile</button>
                    </div>
                </div>
            </a>
            `;
        }

        function createSkeletonCard() {
            return `
                <div class="skeleton-card">
                    <div class="skeleton-image"></div>
                    <div class="skeleton-text"></div>
                    <div class="skeleton-text" style="width: 60%;"></div>
                </div>
            `;
        }

        function renderArtists(showSkeleton = false) {
            const grid = document.getElementById('artistsGrid');
            
            if (showSkeleton) {
                grid.innerHTML = Array(6).fill(createSkeletonCard()).join('');
                setTimeout(() => renderArtists(false), 800);
                return;
            }

            if (filteredArtists.length === 0) {
                grid.innerHTML = `
                    <div class="no-results" style="grid-column: 1 / -1;">
                        <h3>No artists found</h3>
                        <p>Try adjusting your filters or search terms</p>
                    </div>
                `;
                document.getElementById('loadMoreBtn').style.display = 'none';
                return;
            }

            const endIndex = currentPage * artistsPerPage;
            displayedArtists = filteredArtists.slice(0, endIndex);
            
            grid.innerHTML = displayedArtists.map(artist => createArtistCard(artist)).join('');

            const loadMoreBtn = document.getElementById('loadMoreBtn');
            if (endIndex >= filteredArtists.length) {
                loadMoreBtn.style.display = 'none';
            } else {
                loadMoreBtn.style.display = 'block';
            }

            document.getElementById('totalCount').textContent = filteredArtists.length;
        }

        function filterAndSort() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const genreFilter = document.getElementById('genreFilter').value;
            const statusFilter = document.getElementById('statusFilter').value;
            const sortFilter = document.getElementById('sortFilter').value;

            filteredArtists = artists.filter(artist => {
                const matchSearch = artist.name.toLowerCase().includes(searchTerm);
                const matchGenre = genreFilter === 'all' || artist.genre === genreFilter;
                const matchStatus = statusFilter === 'all' || artist.status === statusFilter;
                return matchSearch && matchGenre && matchStatus;
            });

            filteredArtists.sort((a, b) => {
                if (sortFilter === 'subscribers') {
                    return (b.subscribers || 0) - (a.subscribers || 0);
                } else if (sortFilter === 'listeners') {
                    return (b.listeners || 0) - (a.listeners || 0);
                } else if (sortFilter === 'newest') {
                    // For newest, we'd need a created_at field, but for now just keep original order
                    return 0;
                }
                return 0;
            });

            currentPage = 1;
            renderArtists(true);
        }

        function loadMore() {
            currentPage++;
            renderArtists();
        }

       // function viewProfile(artistName) {
          //  alert(`Opening profile for ${artistName}`);
        //}

        document.getElementById('searchInput').addEventListener('input', filterAndSort);
        document.getElementById('genreFilter').addEventListener('change', filterAndSort);
        document.getElementById('statusFilter').addEventListener('change', filterAndSort);
        document.getElementById('sortFilter').addEventListener('change', filterAndSort);
        document.getElementById('loadMoreBtn').addEventListener('click', loadMore);

        filteredArtists = [...artists];
        renderArtists();
    </script>
@endsection
