@extends('layouts.app.master')

@section('title', 'Dashboard')

@section('css')
<style>
    .stat-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        margin: 10px 0;
    }
    .stat-label {
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 5px;
    }
    .stat-subtext {
        font-size: 0.85rem;
        color: #868e96;
    }
    .section-title {
        font-size: 1.3rem;
        font-weight: 600;
        margin: 30px 0 20px 0;
        padding-bottom: 10px;
        border-bottom: 2px solid #e9ecef;
    }
    .chart-container {
        position: relative;
        height: 300px;
        margin-bottom: 30px;
    }
    .chart-card {
        background: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
    .chart-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: #495057;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@endsection

@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Admin Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Container-fluid starts-->
    <div class="container-fluid dashboard-09">
        
        <!-- Overview Section -->
        <h5 class="section-title">Overview</h5>
        <div class="row">
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card compare-order stat-card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <div class="compare-icon shadow-primary">
                                <svg class="fill-primary">
                                    <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#crm-user') }}"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <span class="stat-label">Total Artists</span>
                        <h4 class="stat-value mb-2">
                            <span class="counter" data-target="{{ $totalArtists }}"></span>
                        </h4>
                        <span class="stat-subtext">{{ $activeArtists }} Active • {{ $featuredArtists }} Featured</span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card compare-order stat-card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <div class="compare-icon shadow-success">
                                <svg class="fill-success">
                                    <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#crm-lead') }}"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <span class="stat-label">Total Customers</span>
                        <h4 class="stat-value mb-2">
                            <span class="counter" data-target="{{ $totalCustomers }}"></span>
                        </h4>
                        <span class="stat-subtext">{{ $activeCustomers }} Active</span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card compare-order stat-card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <div class="compare-icon shadow-warning">
                                <svg class="fill-warning">
                                    <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-music') }}"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <span class="stat-label">Total Songs</span>
                        <h4 class="stat-value mb-2">
                            <span class="counter" data-target="{{ $totalSongs }}"></span>
                        </h4>
                        <span class="stat-subtext">{{ $featuredSongs }} Featured</span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card compare-order stat-card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <div class="compare-icon shadow-info">
                                <svg class="fill-info">
                                    <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-image') }}"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <span class="stat-label">Total Artworks</span>
                        <h4 class="stat-value mb-2">
                            <span class="counter" data-target="{{ $totalArtworks }}"></span>
                        </h4>
                        <span class="stat-subtext">Uploaded by artists</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Financial Analytics Section -->
        <h5 class="section-title">Financial Analytics</h5>
        <div class="row">
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card compare-order stat-card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <div class="compare-icon shadow-success">
                                <svg class="fill-success">
                                    <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-ecommerce') }}"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <span class="stat-label">Total Royalty Earnings</span>
                        <h4 class="stat-value mb-2">${{ number_format($totalRoyaltyEarnings, 2) }}</h4>
                        <span class="stat-subtext">All time earnings</span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card compare-order stat-card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <div class="compare-icon shadow-warning">
                                <svg class="fill-warning">
                                    <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-ecommerce') }}"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <span class="stat-label">Pending Payouts</span>
                        <h4 class="stat-value mb-2">
                            <span class="counter" data-target="{{ $pendingPayouts }}"></span>
                        </h4>
                        <span class="stat-subtext">{{ $completedPayouts }} Completed</span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card compare-order stat-card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <div class="compare-icon shadow-info">
                                <svg class="fill-info">
                                    <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-ecommerce') }}"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <span class="stat-label">Total Payouts</span>
                        <h4 class="stat-value mb-2">${{ number_format($totalPayoutAmount, 2) }}</h4>
                        <span class="stat-subtext">Completed payouts</span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card compare-order stat-card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <div class="compare-icon shadow-primary">
                                <svg class="fill-primary">
                                    <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-ecommerce') }}"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <span class="stat-label">Total Tips</span>
                        <h4 class="stat-value mb-2">
                            <span class="counter" data-target="{{ $totalTips }}"></span>
                        </h4>
                        <span class="stat-subtext">${{ number_format($totalTipAmount, 2) }} • {{ $completedTips }} Completed</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Content Management Section -->
        <h5 class="section-title">Content Management</h5>
        <div class="row">
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card compare-order stat-card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <div class="compare-icon shadow-primary">
                                <svg class="fill-primary">
                                    <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-blog') }}"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <span class="stat-label">Total Blogs</span>
                        <h4 class="stat-value mb-2">
                            <span class="counter" data-target="{{ $totalBlogs }}"></span>
                        </h4>
                        <span class="stat-subtext">{{ $publishedBlogs }} Published</span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card compare-order stat-card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <div class="compare-icon shadow-success">
                                <svg class="fill-success">
                                    <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-faq') }}"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <span class="stat-label">Total FAQs</span>
                        <h4 class="stat-value mb-2">
                            <span class="counter" data-target="{{ $totalFaqs }}"></span>
                        </h4>
                        <span class="stat-subtext">{{ $publishedFaqs }} Published • {{ $totalFaqQuestions }} Questions</span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card compare-order stat-card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <div class="compare-icon shadow-warning">
                                <svg class="fill-warning">
                                    <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-ad') }}"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <span class="stat-label">Total Ads</span>
                        <h4 class="stat-value mb-2">
                            <span class="counter" data-target="{{ $totalAds }}"></span>
                        </h4>
                        <span class="stat-subtext">{{ $activeAds }} Active</span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card compare-order stat-card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <div class="compare-icon shadow-info">
                                <svg class="fill-info">
                                    <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-collaboration') }}"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <span class="stat-label">Collaborations</span>
                        <h4 class="stat-value mb-2">
                            <span class="counter" data-target="{{ $totalCollaborations }}"></span>
                        </h4>
                        <span class="stat-subtext">{{ $pendingCollaborations }} Pending</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Subscriptions & Engagement Section -->
        <h5 class="section-title">Subscriptions & Engagement</h5>
        <div class="row">
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card compare-order stat-card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <div class="compare-icon shadow-primary">
                                <svg class="fill-primary">
                                    <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-user') }}"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <span class="stat-label">User Subscriptions</span>
                        <h4 class="stat-value mb-2">
                            <span class="counter" data-target="{{ $activeUserSubscriptions }}"></span>
                        </h4>
                        <span class="stat-subtext">{{ $totalUserPlans }} Plans Available</span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card compare-order stat-card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <div class="compare-icon shadow-success">
                                <svg class="fill-success">
                                    <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-user') }}"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <span class="stat-label">Artist Subscriptions</span>
                        <h4 class="stat-value mb-2">
                            <span class="counter" data-target="{{ $activeArtistSubscriptions }}"></span>
                        </h4>
                        <span class="stat-subtext">{{ $totalArtistPlans }} Plans Available</span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card compare-order stat-card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <div class="compare-icon shadow-info">
                                <svg class="fill-info">
                                    <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-newsletter') }}"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <span class="stat-label">Newsletter Subscriptions</span>
                        <h4 class="stat-value mb-2">
                            <span class="counter" data-target="{{ $newsletterSubscriptions }}"></span>
                        </h4>
                        <span class="stat-subtext">Active subscribers</span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card compare-order stat-card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <div class="compare-icon shadow-warning">
                                <svg class="fill-warning">
                                    <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-contact') }}"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <span class="stat-label">Contact Submissions</span>
                        <h4 class="stat-value mb-2">
                            <span class="counter" data-target="{{ $totalContacts }}"></span>
                        </h4>
                        <span class="stat-subtext">Total inquiries</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Activity & Traffic Section -->
        <h5 class="section-title">Activity & Traffic</h5>
        <div class="row">
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card compare-order stat-card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <div class="compare-icon shadow-success">
                                <svg class="fill-success">
                                    <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#crm-lead') }}"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <span class="stat-label">Total Website Visits</span>
                        <h4 class="stat-value mb-2">
                            <span class="counter" data-target="{{ $totalVisits }}"></span>
                        </h4>
                        <span class="stat-subtext">Home page visits</span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card compare-order stat-card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <div class="compare-icon shadow-primary">
                                <svg class="fill-primary">
                                    <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#crm-user') }}"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <span class="stat-label">Recent Activity (30 Days)</span>
                        <h4 class="stat-value mb-2">
                            <span class="counter" data-target="{{ $recentArtists + $recentSongs + $recentUsers }}"></span>
                        </h4>
                        <span class="stat-subtext">{{ $recentArtists }} Artists • {{ $recentSongs }} Songs • {{ $recentUsers }} Users</span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card compare-order stat-card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <div class="compare-icon shadow-warning">
                                <svg class="fill-warning">
                                    <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-music') }}"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <span class="stat-label">Pending Tips</span>
                        <h4 class="stat-value mb-2">
                            <span class="counter" data-target="{{ $pendingTips }}"></span>
                        </h4>
                        <span class="stat-subtext">Awaiting processing</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Charts Section -->
        <h5 class="section-title">Analytics & Trends</h5>
        <div class="row">
            <!-- Monthly Revenue Trend -->
            <div class="col-md-6 mb-4">
                <div class="chart-card">
                    <h6 class="chart-title">Monthly Royalty Earnings Trend</h6>
                    <div class="chart-container">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>
            
            <!-- User Growth Chart -->
            <div class="col-md-6 mb-4">
                <div class="chart-card">
                    <h6 class="chart-title">User & Artist Growth (Last 6 Months)</h6>
                    <div class="chart-container">
                        <canvas id="userGrowthChart"></canvas>
                    </div>
                </div>
            </div>
            
            <!-- Payout Status Breakdown -->
            <div class="col-md-4 mb-4">
                <div class="chart-card">
                    <h6 class="chart-title">Payout Status Distribution</h6>
                    <div class="chart-container">
                        <canvas id="payoutStatusChart"></canvas>
                    </div>
                </div>
            </div>
            
            <!-- Tips Status Breakdown -->
            <div class="col-md-4 mb-4">
                <div class="chart-card">
                    <h6 class="chart-title">Tips Status Distribution</h6>
                    <div class="chart-container">
                        <canvas id="tipsStatusChart"></canvas>
                    </div>
                </div>
            </div>
            
            <!-- Song Uploads Trend -->
            <div class="col-md-4 mb-4">
                <div class="chart-card">
                    <h6 class="chart-title">Song Uploads Trend (Last 6 Months)</h6>
                    <div class="chart-container">
                        <canvas id="songsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- Container-fluid Ends-->
</div>

@endsection

@section('script')
<script>
    // Counter animation
    document.addEventListener('DOMContentLoaded', function() {
        const counters = document.querySelectorAll('.counter');
        const speed = 200;
        
        counters.forEach(counter => {
            const updateCount = () => {
                const target = parseInt(counter.getAttribute('data-target'));
                const count = parseInt(counter.innerText) || 0;
                const increment = target / speed;
                
                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(updateCount, 1);
                } else {
                    counter.innerText = target;
                }
            };
            
            updateCount();
        });
        
        // Initialize Charts
        initCharts();
    });
    
    function initCharts() {
        // Revenue Trend Chart
        const revenueCtx = document.getElementById('revenueChart');
        if (revenueCtx) {
            new Chart(revenueCtx, {
                type: 'line',
                data: {
                    labels: @json($monthlyLabels),
                    datasets: [{
                        label: 'Royalty Earnings ($)',
                        data: @json($monthlyRevenue),
                        borderColor: 'rgb(75, 192, 192)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '$' + value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
        }
        
        // User Growth Chart
        const userGrowthCtx = document.getElementById('userGrowthChart');
        if (userGrowthCtx) {
            new Chart(userGrowthCtx, {
                type: 'line',
                data: {
                    labels: @json($monthlyLabels),
                    datasets: [{
                        label: 'Users',
                        data: @json($monthlyUsers),
                        borderColor: 'rgb(54, 162, 235)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        tension: 0.4,
                        fill: true
                    }, {
                        label: 'Artists',
                        data: @json($monthlyArtists),
                        borderColor: 'rgb(255, 99, 132)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        }
        
        // Payout Status Chart
        const payoutStatusCtx = document.getElementById('payoutStatusChart');
        if (payoutStatusCtx) {
            new Chart(payoutStatusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Pending', 'Processing', 'Completed', 'Rejected'],
                    datasets: [{
                        data: @json($payoutStatusData),
                        backgroundColor: [
                            'rgba(255, 206, 86, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(75, 192, 192, 0.8)',
                            'rgba(255, 99, 132, 0.8)'
                        ],
                        borderColor: [
                            'rgba(255, 206, 86, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += context.parsed;
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        }
        
        // Tips Status Chart
        const tipsStatusCtx = document.getElementById('tipsStatusChart');
        if (tipsStatusCtx) {
            new Chart(tipsStatusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Pending', 'Paid', 'Sent to Artist'],
                    datasets: [{
                        data: @json($tipsStatusData),
                        backgroundColor: [
                            'rgba(255, 206, 86, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(75, 192, 192, 0.8)'
                        ],
                        borderColor: [
                            'rgba(255, 206, 86, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(75, 192, 192, 1)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += context.parsed;
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        }
        
        // Songs Upload Chart
        const songsCtx = document.getElementById('songsChart');
        if (songsCtx) {
            new Chart(songsCtx, {
                type: 'bar',
                data: {
                    labels: @json($monthlyLabels),
                    datasets: [{
                        label: 'Songs Uploaded',
                        data: @json($monthlySongs),
                        backgroundColor: 'rgba(153, 102, 255, 0.8)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        }
    }
</script>
@endsection
