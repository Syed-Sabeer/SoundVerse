@extends('layouts.frontend.master')


@section('css')


<style>
      .player-controls {
        display:none !important;
    } 

   .dashboard-container {
    max-width: 1400px;
    margin: 3rem auto;
    position:relative;
    //background: linear-gradient(135deg, #01000c, #151140, #000000);
}

.dashboard-container .dashboard-header {
    margin-bottom: 40px;
    animation: fadeInDown 0.6s ease;
}

.dashboard-container .header-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 20px;
}

.dashboard-container .dashboard-title h1 {
    font-size: 2.5em;
    font-weight: 700;
    background: linear-gradient(45deg, #a877ff, #ffffff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-family: 'Poppins';
}

.dashboard-container .dashboard-title p {
    color: #b8b8d4;
    font-size: 1.1em;
    margin-top: 8px;
}

.dashboard-container .header-actions {
    display: flex;
    gap: 12px;
}

.dashboard-container .btn {
    padding: 12px 24px;
    border: none;
    border-radius: 10px;
    font-size: 0.95em;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.dashboard-container .btn svg {
    width: 18px;
    height: 18px;
}

.dashboard-container .btn-primary {
    background: linear-gradient(135deg, #9f54f5, #ac5aff);
    color: #fff;
}

.dashboard-container .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
}

.dashboard-container .btn-secondary {
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.dashboard-container .btn-secondary:hover {
    background: rgba(255, 255, 255, 0.15);
}

.dashboard-container .time-filter {
    display: flex;
    gap: 8px;
    background: #2e1b4e !important;
    padding: 6px;
    border-radius: 12px;
}

.dashboard-container .time-filter button {
    padding: 10px 20px;
    background: transparent;
    border: none;
    color: #b8b8d4;
    font-weight: 600;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.dashboard-container .time-filter button.active {
    background: linear-gradient(135deg, #9f54f5, #ac5aff);
    color: #fff;
}

.dashboard-container .stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
    animation: fadeInUp 0.6s ease;
}

.dashboard-container .stat-card {
    background: rgb(37 20 53) !important;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    padding: 24px;
    transition: all 0.3s ease;
}

.dashboard-container .stat-card:hover {
    transform: translateY(-5px);
    border-color: rgb(155 98 255 / 49%);
    box-shadow: 0 10px 30px rgb(190 153 255 / 15%);
}

.dashboard-container .stat-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.dashboard-container .stat-icon {
    width: 40px;
    height: 40px;
}

.dashboard-container .stat-growth {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 0.85em;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 20px;
}

.dashboard-container .stat-growth.positive {
    background: rgba(67, 233, 123, 0.2);
    color: #43e97b;
}

.dashboard-container .stat-growth svg {
    width: 12px;
    height: 12px;
}

.dashboard-container .stat-label {
    font-size: 0.9em;
    color: #b8b8d4;
    margin-bottom: 8px;
}

.dashboard-container .stat-value {
    font-size: 2em;
    font-weight: 700;
    color: #fff;
}

.dashboard-container .stat-subtext {
    font-size: 0.85em;
    color: #8989ab;
    margin-top: 8px;
}

.dashboard-container .section {
    background: #16002dc7;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 30px;
    animation: fadeIn 0.8s ease;
}

.dashboard-container .section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    flex-wrap: wrap;
    gap: 15px;
}

.dashboard-container .section-title {
    font-size: 1.5em;
    font-weight: 700;
    font-family: 'Poppins';
    color: white;
}

.dashboard-container .tabs {
    display: flex;
    gap: 8px;
    background: rgba(255, 255, 255, 0.05);
    padding: 6px;
    border-radius: 10px;
}

.dashboard-container .tab-btn {
    padding: 10px 20px;
    background: transparent;
    border: none;
    color: #b8b8d4;
    font-weight: 600;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.9em;
}

.dashboard-container .tab-btn.active {
    background: rgba(102, 126, 234, 0.3);
    color: #fff;
}

.dashboard-container .tab-content {
    display: none;
}

.dashboard-container .tab-content.active {
    display: block;
}

.dashboard-container .platform-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.dashboard-container .platform-card {
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    transition: all 0.3s ease;
}

.dashboard-container .platform-card img {
    width: 50px;
    height: 50px;
    margin-bottom: 12px;
    border-radius: 50%;
}

.dashboard-container .platform-card:hover {
    transform: scale(1.05);
    border-color: rgba(255, 255, 255, 0.3);
}

.dashboard-container .platform-icon {
    width: 50px;
    height: 50px;
    margin: 0 auto 12px;
}

.dashboard-container .platform-name {
    font-size: 1em;
    color: #b8b8d4;
    margin-bottom: 8px;
}

.dashboard-container .platform-streams {
    font-size: 1.8em;
    font-weight: 700;
    color: #fff;
}

.dashboard-container .platform-change {
    font-size: 0.85em;
    color: #43e97b;
    margin-top: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 4px;
}

.dashboard-container .platform-change svg {
    width: 12px;
    height: 12px;
}

/* Track list */
.dashboard-container .track-list {
    margin-top: 20px;
}

.dashboard-container .track-item {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 15px;
    display: flex;
    gap: 20px;
    align-items: center;
    transition: all 0.3s ease;
}

.dashboard-container .track-item:hover {
    background: rgba(255, 255, 255, 0.08);
        border-color: rgb(103 58 183 / 68%);
}

.dashboard-container .track-cover {
    width: 80px;
    height: 80px;
    border-radius: 8px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.dashboard-container .track-cover svg {
    width: 40px;
    height: 40px;
}

.dashboard-container .track-info {
    flex: 1;
}

.dashboard-container .track-name {
    font-size: 1.1em;
    font-weight: 700;
    margin-bottom: 6px;
}

.dashboard-container .track-meta {
    display: flex;
    gap: 20px;
    font-size: 0.9em;
    color: #b8b8d4;
}

.dashboard-container .track-meta span {
    display: flex;
    align-items: center;
    gap: 6px;
}

.dashboard-container .track-meta svg {
    width: 14px;
    height: 14px;
}

.dashboard-container .track-stats {
    display: flex;
    gap: 30px;
    align-items: center;
}

.dashboard-container .track-stat {
    text-align: center;
}

.dashboard-container .track-stat-value {
    font-size: 1.3em;
    font-weight: 700;
    color: #fff;
}

.dashboard-container .track-stat-label {
    font-size: 0.8em;
    color: #b8b8d4;
    margin-top: 4px;
}

/* Audience grid */
.dashboard-container .audience-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.dashboard-container .audience-card {
    background: #260f3ec7;
    border-radius: 12px;
    padding: 20px;
}

.dashboard-container .audience-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.dashboard-container .audience-item:last-child {
    border-bottom: none;
}

.dashboard-container .audience-label {
    color: #b8b8d4;
    font-size: 0.95em;
}

.dashboard-container .audience-bar-wrapper {
    flex: 1;
    margin: 0 15px;
    height: 8px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 4px;
    overflow: hidden;
}

.dashboard-container .audience-bar {
    height: 100%;
    background: linear-gradient(90deg, #667eea, #764ba2);
    border-radius: 4px;
    transition: width 1s ease;
}

.dashboard-container .audience-value {
    font-weight: 600;
    color: #fff;
    min-width: 50px;
    text-align: right;
}

/* Chart container */
.dashboard-container .chart-container {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
    padding: 20px;
    margin-top: 20px;
    height: 300px;
    display: flex;
    align-items: flex-end;
    justify-content: space-around;
    gap: 8px;
}

.dashboard-container .chart-bar {
    flex: 1;
    background: linear-gradient(to top, #667eea, #764ba2);
    border-radius: 8px 8px 0 0;
    position: relative;
    transition: all 0.3s ease;
    cursor: pointer;
    min-height: 20px;
}

.dashboard-container .chart-bar:hover {
    background: linear-gradient(to top, #8c57df, #9ea6ff);
    transform: scaleY(1.05);
}

.dashboard-container .chart-label {
    position: absolute;
    bottom: -25px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 0.8em;
    color: #b8b8d4;
    white-space: nowrap;
}

.dashboard-container .chart-value {
    position: absolute;
    top: -25px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 0.85em;
    font-weight: 600;
    color: #fff;
    white-space: nowrap;
}

/* Progress ring */
.dashboard-container .progress-ring {
    width: 60px;
    height: 60px;
    position: relative;
}

.dashboard-container .progress-ring svg {
    transform: rotate(-90deg);
}

.dashboard-container .progress-ring-circle {
    fill: none;
    stroke: rgba(255, 255, 255, 0.1);
    stroke-width: 4;
}

.dashboard-container .progress-ring-circle-fill {
    fill: none;
    stroke: #43e97b;
    stroke-width: 4;
    stroke-linecap: round;
    transition: stroke-dashoffset 1s ease;
}

.dashboard-container .progress-ring-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 0.9em;
    font-weight: 700;
}

/* Map container */
.dashboard-container .map-container {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
    padding: 20px;
    margin-top: 20px;
    min-height: 250px;
}

/* Country list */
.dashboard-container .country-list {
    width: 100%;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 15px;
}

.dashboard-container .country-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
}

.dashboard-container .country-flag {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2em;
}

.dashboard-container .country-info {
    flex: 1;
}

.dashboard-container .country-name {
    font-size: 0.9em;
    color: #b8b8d4;
}

.dashboard-container .country-listeners {
    font-size: 1.1em;
    font-weight: 700;
    color: #fff;
}

/* Keyframes */
 @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

 @keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

 @keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Media queries */
 @media (max-width: 991px) {
    .dashboard-container {
         margin: 5rem auto;
    }
 }
 @media (max-width: 768px) {
    .dashboard-container .dashboard-title h1 {
        font-size: 2em;
    }

    .dashboard-container .stats-grid {
        grid-template-columns: 1fr;
    }

    .dashboard-container .header-actions {
        width: 100%;
        flex-direction: column;
    }

    .dashboard-container .btn {
        width: 100%;
        justify-content: center;
    }

    .dashboard-container .track-item {
        flex-direction: column;
        text-align: center;
    }

    .dashboard-container .track-stats {
        width: 100%;
        justify-content: space-around;
    }

    .dashboard-container .time-filter {
        width: 100%;
    }

    .dashboard-container .time-filter button {
        flex: 1;
        padding: 10px 8px;
        font-size: 0.85em;
    }
}
 @media (max-width: 476px) { 
    .dashboard-container .section-header {
        justify-content: center;
    }
    .dashboard-container .tab-btn {
        padding: 10px 14px;
    }
    .dashboard-container .audience-label {
        font-size: 14px;
    }
    .dashboard-container .section {
        padding: 10px;
    }
}

    </style>
@endsection

@section('content')

 <div class="dashboard-container container">
        <!-- Header -->
        <div class="dashboard-header">
            <div class="header-top">
                <div class="dashboard-title">
                    <h1>Analytics & Insights</h1>
                    <p>Track your music performance and grow your audience</p>
                </div>
                <div class="header-actions">
                    <button class="btn btn-secondary" onclick="exportPDF()">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6.414A2 2 0 0016.414 5L14 2.586A2 2 0 0012.586 2H9z"/>
                            <path d="M3 8a2 2 0 012-2v10h8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/>
                        </svg>
                        Export PDF
                    </button>
                    <button class="btn btn-primary" onclick="exportCSV()">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"/>
                        </svg>
                        Download CSV
                    </button>
                </div>
            </div>
            <div class="time-filter">
                <button class="active" onclick="setTimeFilter(this, '7d')">7 Days</button>
                <button onclick="setTimeFilter(this, '30d')">30 Days</button>
                <button onclick="setTimeFilter(this, '90d')">90 Days</button>
                <button onclick="setTimeFilter(this, '1y')">1 Year</button>
            </div>
        </div>

        <!-- Overview Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <svg class="stat-icon" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.37 4.37 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/>
                    </svg>
                    <span class="stat-growth positive">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"/>
                        </svg>
                        12.5%
                    </span>
                </div>
                <div class="stat-label">Total Streams</div>
                <div class="stat-value">2.4M</div>
                <div class="stat-subtext">+264K from last week</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <svg class="stat-icon" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                    </svg>
                    <span class="stat-growth positive">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"/>
                        </svg>
                        8.3%
                    </span>
                </div>
                <div class="stat-label">Monthly Listeners</div>
                <div class="stat-value">342K</div>
                <div class="stat-subtext">+26K new listeners</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <svg class="stat-icon" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                    </svg>
                    <span class="stat-growth positive">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"/>
                        </svg>
                        24%
                    </span>
                </div>
                <div class="stat-label">Top Track</div>
                <div class="stat-value">856K</div>
                <div class="stat-subtext">Electric Dreams</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <svg class="stat-icon" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"/>
                    </svg>
                    <span class="stat-growth positive">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"/>
                        </svg>
                        15.2%
                    </span>
                </div>
                <div class="stat-label">Estimated Earnings</div>
                <div class="stat-value">£1,250</div>
                <div class="stat-subtext">This month</div>
            </div>
        </div>

        <!-- Streaming Performance -->
        <div class="section">
            <div class="section-header">
                <h2 class="section-title">Platform Performance</h2>
                <div class="tabs">
                    <button class="tab-btn active" onclick="switchTab(this, 'overview')">Overview</button>
                    <button class="tab-btn" onclick="switchTab(this, 'trends')">Trends</button>
                    <button class="tab-btn" onclick="switchTab(this, 'regions')">Regions</button>
                </div>
            </div>

            <div id="tab-overview" class="tab-content active">
                <div class="platform-grid">
                    <div class="platform-card">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/19/Spotify_logo_without_text.svg/2048px-Spotify_logo_without_text.svg.png" alt="">
                        <div class="platform-name">Spotify</div>
                        <div class="platform-streams">1.2M</div>
                        <div class="platform-change">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"/>
                            </svg>
                            14% this week
                        </div>
                    </div>
                    <div class="platform-card">
                        <img src="https://www.pngmart.com/files/23/Apple-Music-Logo-PNG-Picture.png" alt="">
                        <div class="platform-name">Apple Music</div>
                        <div class="platform-streams">680K</div>
                        <div class="platform-change">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"/>
                            </svg>
                            9% this week
                        </div>
                    </div>
                    <div class="platform-card">
                        <img src="https://images.vexels.com/media/users/3/137425/isolated/preview/f2ea1ded4d037633f687ee389a571086-youtube-icon-logo.png" alt="">
                        <div class="platform-name">YouTube Music</div>
                        <div class="platform-streams">420K</div>
                        <div class="platform-change">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"/>
                            </svg>
                            18% this week
                        </div>
                    </div>
                    <div class="platform-card">
                       <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSwruIJKv-fF17I1EXNO_vXD12USuWidPQn9A&s" alt="">
                        <div class="platform-name">TikTok</div>
                        <div class="platform-streams">158K</div>
                        <div class="platform-change">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"/>
                            </svg>
                            32% this week
                        </div>
                    </div>
                </div>
            </div>

            <div id="tab-trends" class="tab-content">
                <h3 style="margin-bottom: 15px;    font-family: 'Poppins'; font-weight: 500;font-size: 20px;">Stream Trends (Last 7 Days)</h3>
                <div class="chart-container" id="streamChart"></div>
            </div>

            <div id="tab-regions" class="tab-content">
                <h3 style="margin-bottom: 15px;">Top Countries</h3>
                <div class="map-container">
                    <div class="country-list">
                        <div class="country-item">
                            <span class="country-flag">GB</span>
                            <div class="country-info">
                                <div class="country-name">United Kingdom</div>
                                <div class="country-listeners">124K</div>
                            </div>
                        </div>
                        <div class="country-item">
                            <span class="country-flag">US</span>
                            <div class="country-info">
                                <div class="country-name">United States</div>
                                <div class="country-listeners">98K</div>
                            </div>
                        </div>
                        <div class="country-item">
                            <span class="country-flag">DE</span>
                            <div class="country-info">
                                <div class="country-name">Germany</div>
                                <div class="country-listeners">76K</div>
                            </div>
                        </div>
                        <div class="country-item">
                            <span class="country-flag">FR</span>
                            <div class="country-info">
                                <div class="country-name">France</div>
                                <div class="country-listeners">54K</div>
                            </div>
                        </div>
                        <div class="country-item">
                            <span class="country-flag">CA</span>
                            <div class="country-info">
                                <div class="country-name">Canada</div>
                                <div class="country-listeners">42K</div>
                            </div>
                        </div>
                        <div class="country-item">
                            <span class="country-flag">AU</span>
                            <div class="country-info">
                                <div class="country-name">Australia</div>
                                <div class="country-listeners">38K</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Audience Insights -->
        <div class="section">
            <div class="section-header">
                <h2 class="section-title">Audience Insights</h2>
            </div>
            <div class="audience-grid">
                <div class="audience-card">
                    <h3 style="margin-bottom: 15px; font-size: 1.1em;">Age Groups</h3>
                    <div class="audience-item">
                        <span class="audience-label">18-24</span>
                        <div class="audience-bar-wrapper">
                            <div class="audience-bar" style="width: 45%"></div>
                        </div>
                        <span class="audience-value">45%</span>
                    </div>
                    <div class="audience-item">
                        <span class="audience-label">25-34</span>
                        <div class="audience-bar-wrapper">
                            <div class="audience-bar" style="width: 32%"></div>
                        </div>
                        <span class="audience-value">32%</span>
                    </div>
                    <div class="audience-item">
                        <span class="audience-label">35-44</span>
                        <div class="audience-bar-wrapper">
                            <div class="audience-bar" style="width: 15%"></div>
                        </div>
                        <span class="audience-value">15%</span>
                    </div>
                    <div class="audience-item">
                        <span class="audience-label">45+</span>
                        <div class="audience-bar-wrapper">
                            <div class="audience-bar" style="width: 8%"></div>
                        </div>
                        <span class="audience-value">8%</span>
                    </div>
                </div>

                <div class="audience-card">
                    <h3 style="margin-bottom: 15px; font-size: 1.1em;">Listener Type</h3>
                    <div class="audience-item">
                        <span class="audience-label">Returning</span>
                        <div class="audience-bar-wrapper">
                            <div class="audience-bar" style="width: 68%"></div>
                        </div>
                        <span class="audience-value">68%</span>
                    </div>
                    <div class="audience-item">
                        <span class="audience-label">New</span>
                        <div class="audience-bar-wrapper">
                            <div class="audience-bar" style="width: 32%"></div>
                        </div>
                        <span class="audience-value">32%</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Track Analytics -->
        <div class="section">
            <div class="section-header">
                <h2 class="section-title">Track Performance</h2>
            </div>
            <div class="track-list">
                <div class="track-item">
                    <div class="track-cover">
                        <svg fill="#fff" viewBox="0 0 24 24">
                            <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/>
                        </svg>
                    </div>
                    <div class="track-info">
                        <div class="track-name">Electric Dreams</div>
                        <div class="track-meta">
                            <span>
                                <svg fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"/>
                                </svg>
                                3:42
                            </span>
                            <span>
                                <svg fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"/>
                                </svg>
                                Released 2 months ago
                            </span>
                        </div>
                    </div>
                    <div class="track-stats">
                        <div class="track-stat">
                            <div class="track-stat-value">856K</div>
                            <div class="track-stat-label">Streams</div>
                        </div>
                        <div class="track-stat">
                            <div class="track-stat-value">5.2%</div>
                            <div class="track-stat-label">Skip Rate</div>
                        </div>
                        <div class="progress-ring">
                            <svg width="60" height="60">
                                <circle class="progress-ring-circle" cx="30" cy="30" r="26"></circle>
                                <circle class="progress-ring-circle-fill" cx="30" cy="30" r="26" 
                                        stroke-dasharray="163.36" stroke-dashoffset="16.34"></circle>
                            </svg>
                            <div class="progress-ring-text">90%</div>
                        </div>
                    </div>
                </div>

                <div class="track-item">
                    <div class="track-cover" style="background: linear-gradient(135deg, #f093fb, #f5576c);">
                        <svg fill="#fff" viewBox="0 0 24 24">
                            <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/>
                        </svg>
                    </div>
                    <div class="track-info">
                        <div class="track-name">Midnight Serenade</div>
                        <div class="track-meta">
                            <span>
                                <svg fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"/>
                                </svg>
                                4:15
                            </span>
                            <span>
                                <svg fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"/>
                                </svg>
                                Released 4 months ago
                            </span>
                        </div>
                    </div>
                    <div class="track-stats">
                        <div class="track-stat">
                            <div class="track-stat-value">624K</div>
                            <div class="track-stat-label">Streams</div>
                        </div>
                        <div class="track-stat">
                            <div class="track-stat-value">7.8%</div>
                            <div class="track-stat-label">Skip Rate</div>
                        </div>
                        <div class="progress-ring">
                            <svg width="60" height="60">
                                <circle class="progress-ring-circle" cx="30" cy="30" r="26"></circle>
                                <circle class="progress-ring-circle-fill" cx="30" cy="30" r="26" 
                                        stroke-dasharray="163.36" stroke-dashoffset="28.58"></circle>
                            </svg>
                            <div class="progress-ring-text">82%</div>
                        </div>
                    </div>
                </div>

                <div class="track-item">
                    <div class="track-cover" style="background: linear-gradient(135deg, #4facfe, #00f2fe);">
                        <svg fill="#fff" viewBox="0 0 24 24">
                            <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/>
                        </svg>
                    </div>
                    <div class="track-info">
                        <div class="track-name">Neon Nights</div>
                        <div class="track-meta">
                            <span>
                                <svg fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"/>
                                </svg>
                                3:28
                            </span>
                            <span>
                                <svg fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"/>
                                </svg>
                                Released 6 months ago
                            </span>
                        </div>
                    </div>
                    <div class="track-stats">
                        <div class="track-stat">
                            <div class="track-stat-value">512K</div>
                            <div class="track-stat-label">Streams</div>
                        </div>
                        <div class="track-stat">
                            <div class="track-stat-value">6.4%</div>
                            <div class="track-stat-label">Skip Rate</div>
                        </div>
                        <div class="progress-ring">
                            <svg width="60" height="60">
                                <circle class="progress-ring-circle" cx="30" cy="30" r="26"></circle>
                                <circle class="progress-ring-circle-fill" cx="30" cy="30" r="26" 
                                        stroke-dasharray="163.36" stroke-dashoffset="24.50"></circle>
                            </svg>
                            <div class="progress-ring-text">85%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
       

      <script>
        // Generate stream chart
        function generateStreamChart() {
            const chartContainer = document.getElementById('streamChart');
            if (!chartContainer) return;
            
            const days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
            const streams = [34200, 38500, 42100, 45800, 41200, 52300, 48900];
            const maxStream = Math.max(...streams);

            chartContainer.innerHTML = '';

            streams.forEach(function(stream, index) {
                const heightPercent = (stream / maxStream) * 100;
                const bar = document.createElement('div');
                bar.className = 'chart-bar';
                bar.style.height = heightPercent + '%';
                
                const label = document.createElement('div');
                label.className = 'chart-label';
                label.textContent = days[index];
                
                const value = document.createElement('div');
                value.className = 'chart-value';
                value.textContent = (stream / 1000).toFixed(1) + 'K';
                
                bar.appendChild(label);
                bar.appendChild(value);
                chartContainer.appendChild(bar);
            });
        }

        // Switch tabs
        function switchTab(btn, tabName) {
            // Remove active class from all tab buttons
            const tabButtons = document.querySelectorAll('.tab-btn');
            tabButtons.forEach(function(button) {
                button.classList.remove('active');
            });
            
            // Add active class to clicked button
            btn.classList.add('active');
            
            // Hide all tab contents
            const tabContents = document.querySelectorAll('.tab-content');
            tabContents.forEach(function(content) {
                content.classList.remove('active');
            });
            
            // Show selected tab content
            const selectedTab = document.getElementById('tab-' + tabName);
            if (selectedTab) {
                selectedTab.classList.add('active');
            }
            
            // Generate chart if trends tab is selected
            if (tabName === 'trends') {
                setTimeout(generateStreamChart, 100);
            }
        }

        // Time filter
        function setTimeFilter(btn, period) {
            const buttons = document.querySelectorAll('.time-filter button');
            buttons.forEach(function(b) {
                b.classList.remove('active');
            });
            btn.classList.add('active');
            
            console.log('Filter changed to:', period);
        }

        // Export functions
        function exportPDF() {
            alert('📄 Generating PDF report...\n\nYour analytics report will be downloaded shortly.');
        }

        function exportCSV() {
            alert('📊 Preparing CSV export...\n\nYour data will be downloaded as a CSV file.');
        }

        // Initialize on page load
        window.addEventListener('load', function() {
            generateStreamChart();
        });

        // Animate bars on scroll
        const observerOptions = {
            threshold: 0.5
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    const bars = entry.target.querySelectorAll('.audience-bar');
                    bars.forEach(function(bar) {
                        const width = bar.style.width;
                        bar.style.width = '0%';
                        setTimeout(function() {
                            bar.style.width = width;
                        }, 100);
                    });
                }
            });
        }, observerOptions);

        const audienceCards = document.querySelectorAll('.audience-card');
        audienceCards.forEach(function(card) {
            observer.observe(card);
        });
    </script>



@endsection
