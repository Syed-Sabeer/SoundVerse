
<script src="{{asset('FrontendAssets/js/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('FrontendAssets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('FrontendAssets/js/popper.min.js')}}"></script>
<script src="{{asset('FrontendAssets/js/swiper-bundle.min.js')}}"></script>
<script src="{{asset('FrontendAssets/js/font-awesome.min.js')}}"></script>
<script src="{{asset('FrontendAssets/js/wow.min.js')}}"></script>
{{-- <script src="{{asset('FrontendAssets/js/music-controls.js')}}"></script> --}}
<script src="{{asset('FrontendAssets/js/jquery.fancybox.min.js')}}"></script>
<script src="{{asset('FrontendAssets/js/custom.js')}}"></script>
<script src="{{asset('FrontendAssets/js/artwork.js')}}"></script>
<script src="{{asset('FrontendAssets/js/bottommusicPlayer.js')}}"></script>

<script src="https://cdn.lordicon.com/lordicon.js"></script>



    {{--garph js--}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
    <script>
        const data6Months = {
            labels: ['July', 'August', 'September', 'October', 'November', 'December'],
            values: [6200, 6800, 7100, 7900, 8400, 9800]
        };

        const data3Months = {
            labels: ['October', 'November', 'December'],
            values: [7900, 8400, 9800]
        };

        const data12Months = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            values: [4200, 4800, 5100, 5500, 5900, 6000, 6200, 6800, 7100, 7900, 8400, 9800]
        };

        const dataAll = {
            labels: ['Q1 2024', 'Q2 2024', 'Q3 2024', 'Q4 2024'],
            values: [14200, 17400, 20100, 26100]
        };

        // Only initialize chart if canvas exists and no dynamic data is provided
        // Dynamic chart initialization is handled in auth-artist-portal.blade.php
        const ctxElement = document.getElementById('earningsChart');
        if (ctxElement && !window.hasDynamicEarningsChart) {
            const ctx = ctxElement.getContext('2d');
            
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(139, 92, 246, 0.4)');
            gradient.addColorStop(1, 'rgba(139, 92, 246, 0.01)');

            let chart = new Chart(ctx, {
                type: 'line',
                data: {
                labels: data6Months.labels,
                datasets: [{
                    label: 'Earnings ($)',
                    data: data6Months.values,
                    borderColor: '#8b5cf6',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#8b5cf6',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    pointHoverBackgroundColor: '#8b5cf6',
                    pointHoverBorderColor: '#fff',
                    pointHoverBorderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1a1830',
                        titleColor: '#a0a0c0',
                        bodyColor: '#ffffff',
                        borderColor: '#8b5cf6',
                        borderWidth: 1,
                        padding: 12,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return '$' + context.parsed.y.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        grid: {
                            color: 'rgba(139, 92, 246, 0.1)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#a0a0c0',
                            callback: function(value) {
                                return '$' + (value / 1000) + 'K';
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: '#a0a0c0'
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });

        // Filter buttons
        const filterBtns = document.querySelectorAll('.filter-btn');
        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                const period = this.dataset.period;
                let newData;
                
                switch(period) {
                    case '3':
                        newData = data3Months;
                        break;
                    case '6':
                        newData = data6Months;
                        break;
                    case '12':
                        newData = data12Months;
                        break;
                    case 'all':
                        newData = dataAll;
                        break;
                }
                
                chart.data.labels = newData.labels;
                chart.data.datasets[0].data = newData.values;
                chart.update('active');
            });
        });
    </script>

  

  <script>
        const CSRF_TOKEN = '{{ csrf_token() }}';
        let notificationsData = [];

        async function loadNotifications() {
            try {
                const response = await fetch('/api/notifications', {
                    headers: { 'Accept': 'application/json' }
                });
                if (!response.ok) return;
                const data = await response.json();
                if (!data.success || !Array.isArray(data.notifications)) return;

                notificationsData = data.notifications.map(n => {
                    const createdAt = n.created_at ? new Date(n.created_at) : new Date();
                    const time = createdAt.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                    const date = createdAt.toLocaleString();
                    // Map 'payment' type to 'tip' for tip-related notifications
                    let notificationType = n.notification_type || n.type || 'system';
                    if (notificationType === 'payment' && n.title && (n.title.includes('Tip') || n.message.includes('tip'))) {
                        notificationType = 'tip';
                    }
                    return {
                        id: n.id,
                        type: notificationType,
                        title: n.title || 'Notification',
                        message: n.message || '',
                        time,
                        date,
                        unread: !n.read_at && !n.is_read,
                        action_url: n.action_url || null,
                        metadata: n.metadata || null,
                    };
                });

                renderQuickNotifications();
                renderFullNotifications();
            } catch (e) {
                // fail silently
            }
        }

        // (Old static sample notifications removed; data now comes from /api/notifications)

        let currentFilter = 'all';

        // Get icon HTML based on type
        function getNotificationIcon(type) {
            const icons = {
                tip: '<svg fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>',
                payment: '<svg fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path></svg>',
                subscription: '<svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>',
                earnings: '<svg fill="currentColor" viewBox="0 0 20 20"><path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path></svg>',
                payout: '<svg fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path></svg>',
                system: '<svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>'
            };
            return icons[type] || icons.system;
        }

        // Render quick notifications (first 5)
        function renderQuickNotifications() {
            const quickList = document.getElementById('quickNotificationsList');
            const quickNotifications = notificationsData.slice(0, 5);
            
            quickList.innerHTML = quickNotifications.map(notif => {
                // Escape HTML to prevent XSS and syntax errors
                const escapedTitle = String(notif.title || '').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
                const escapedMessage = String(notif.message || '').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
                const escapedActionUrl = notif.action_url ? String(notif.action_url).replace(/"/g, '&quot;').replace(/'/g, '&#39;') : '';
                
                const clickHandler = notif.action_url 
                    ? `onclick="markAsRead(${notif.id}); window.location.href='${escapedActionUrl}';"`
                    : `onclick="markAsRead(${notif.id})"`;
                return `
                <div class="notification-item ${notif.unread ? 'unread' : ''}" ${clickHandler} tabindex="0" style="cursor: pointer;">
                    <div class="notification-content">
                        <div class="notification-icon ${notif.type}">
                            ${getNotificationIcon(notif.type)}
                        </div>
                        <div class="notification-body">
                            <div class="notification-title">${escapedTitle}</div>
                            <div class="notification-message" style="font-size: 0.85em; color: #b8b8d4; margin-top: 4px;">${escapedMessage}</div>
                            <div class="notification-time">
                                ${notif.unread ? '<span class="unread-dot"></span>' : ''}
                                ${notif.time}
                            </div>
                        </div>
                    </div>
                </div>
            `;
            }).join('');

            updateBadges();
        }

        // Render full notifications list
        function renderFullNotifications() {
            const fullList = document.getElementById('fullNotificationsList');
            if (!fullList) return;
            
            let filteredNotifications = notificationsData;

            if (currentFilter === 'unread') {
                filteredNotifications = notificationsData.filter(n => n.unread);
            }

            if (filteredNotifications.length === 0) {
                fullList.innerHTML = `
                    <div class="empty-state">
                        <div class="empty-state-icon">🔔</div>
                        <div class="empty-state-text">No notifications to display</div>
                    </div>
                `;
                return;
            }

            fullList.innerHTML = filteredNotifications.map(notif => {
                // Escape HTML to prevent XSS and syntax errors
                const escapedTitle = String(notif.title || '').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
                const escapedMessage = String(notif.message || '').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
                const escapedActionUrl = notif.action_url ? String(notif.action_url).replace(/"/g, '&quot;').replace(/'/g, '&#39;') : '';
                
                const clickHandler = notif.action_url 
                    ? `onclick="markAsRead(${notif.id}); window.location.href='${escapedActionUrl}';"`
                    : `onclick="markAsRead(${notif.id})"`;
                return `
                <div class="full-notification-item ${notif.unread ? 'unread' : ''}" ${clickHandler} tabindex="0" style="cursor: pointer;">
                    <div class="full-notification-content">
                        <div class="notification-icon ${notif.type}">
                            ${getNotificationIcon(notif.type)}
                        </div>
                        <div class="full-notification-body">
                            <div class="full-notification-header">
                                <div class="full-notification-title">${escapedTitle}</div>
                                ${notif.unread ? '<span class="unread-dot"></span>' : ''}
                            </div>
                            <div class="full-notification-message">${escapedMessage}</div>
                            <div class="full-notification-date">${notif.date}</div>
                        </div>
                    </div>
                </div>
            `;
            }).join('');
        }

        // Update badge counts
        function updateBadges() {
            const unreadCount = notificationsData.filter(n => n.unread).length;
            const badge = document.getElementById('notificationBadge');
            const headerBadge = document.getElementById('headerBadge');
            
            if (badge) {
                badge.textContent = unreadCount;
                badge.style.display = unreadCount > 0 ? 'flex' : 'none';
            }
            
            if (headerBadge) {
                headerBadge.textContent = unreadCount > 0 ? `${unreadCount} New` : '0 New';
            }
        }

        // Toggle quick notifications popup
        function toggleQuickNotifications() {
            const popup = document.getElementById('quickNotifications');
            const bell = document.querySelector('.notification-bell');
            const isActive = popup.classList.contains('active');
            
            popup.classList.toggle('active');
            bell.classList.toggle('active');
            bell.setAttribute('aria-expanded', !isActive);
        }

        // Open full notifications modal
        function openFullNotifications() {
            document.getElementById('quickNotifications').classList.remove('active');
            document.querySelector('.notification-bell').classList.remove('active');
            document.getElementById('fullNotificationsModal').classList.add('active');
            renderFullNotifications();
            document.body.style.overflow = 'hidden';
        }

        // Close full notifications modal
        function closeFullNotifications() {
            document.getElementById('fullNotificationsModal').classList.remove('active');
            document.body.style.overflow = '';
        }

        // Filter notifications
        function filterNotifications(filter) {
            currentFilter = filter;
            
            // Update active tab
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
                if (btn.dataset.filter === filter) {
                    btn.classList.add('active');
                }
            });
            
            renderFullNotifications();
        }

        // Mark single notification as read
        function markAsRead(id) {
            const notification = notificationsData.find(n => n.id === id);
            if (!notification) return;

            if (notification.unread) {
                notification.unread = false;
                fetch(`/api/notifications/${id}/read`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                        'Accept': 'application/json',
                    },
                }).catch(() => {});
            }

            renderQuickNotifications();
            renderFullNotifications();
        }

        // Mark all as read
        function markAllAsRead() {
            if (!notificationsData.length) return;

            notificationsData.forEach(n => n.unread = false);
            fetch('/api/notifications/read-all', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Accept': 'application/json',
                },
            }).catch(() => {});

            renderQuickNotifications();
            renderFullNotifications();
        }

        // Clear all notifications
        function clearAllNotifications() {
            if (!notificationsData.length) return;
            if (!confirm('Are you sure you want to clear all notifications?')) return;

            const ids = notificationsData.map(n => n.id);
            notificationsData = [];

            Promise.all(ids.map(id =>
                fetch(`/api/notifications/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                        'Accept': 'application/json',
                    },
                }).catch(() => {})
            )).finally(() => {
                renderQuickNotifications();
                renderFullNotifications();
                closeFullNotifications();
            });
        }

        // Handle keyboard navigation
        function handleKeyPress(event, callback) {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                callback();
            }
        }

        // Close popup when clicking outside
        document.addEventListener('click', function(e) {
            const popup = document.getElementById('quickNotifications');
            const bell = document.querySelector('.notification-bell');
            
            if (popup && bell && !popup.contains(e.target) && !bell.contains(e.target)) {
                popup.classList.remove('active');
                bell.classList.remove('active');
                bell.setAttribute('aria-expanded', 'false');
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modal = document.getElementById('fullNotificationsModal');
                if (modal && modal.classList.contains('active')) {
                    closeFullNotifications();
                }
                
                const popup = document.getElementById('quickNotifications');
                if (popup && popup.classList.contains('active')) {
                    popup.classList.remove('active');
                    const bell = document.querySelector('.notification-bell');
                    if (bell) {
                        bell.classList.remove('active');
                    }
                }
            }
        });

        // Initialize
        loadNotifications();
    </script>

    {{-- Global Ad Injection System Initialization --}}
    <script>
        // Global Ad Injection System (available on all pages)
        if (typeof window.adInjectionSystem === 'undefined') {
            window.adInjectionSystem = {
                isEnabled: false,
                currentAd: null,
                adContainer: null,
                isShowingAd: false,
                showAdsBetweenSongs: true,
                showAdsDuringPlayback: true,
                adTimer: null,
                nextAdTime: 30,
                midSongAdShown: false,
                countdownInterval: null,
                adShownBetweenSongs: false, // Track if ad was shown between songs

                // Initialize the ad injection system
                init() {
                    console.log('Global AdInjectionSystem: Initializing...');
                    this.checkAdStatus();
                },
                
                async checkAdStatus() {
                    try {
                        console.log('Global AdInjectionSystem: Checking ad status...');
                        
                        const response = await fetch('/api/ad-injection/data', {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                            }
                        });
                        
                        if (!response.ok) {
                            console.warn('Global AdInjectionSystem: Non-OK response', response.status);
                            this.isEnabled = false;
                            return;
                        }
                        
                        const data = await response.json();
                        console.log('Global AdInjectionSystem: API response data:', data);
                        
                        if (data.success && data.data && data.data.show_ads) {
                            this.isEnabled = true;
                            this.currentAd = data.data.ad;
                            this.nextAdTime = data.data.next_ad_in_seconds || 30;
                            
                            if (!this.currentAd) {
                                console.warn('Global AdInjectionSystem: Ads enabled but no ad available', {
                                    message: data.data.message || 'No ads available at the moment'
                                });
                                // Still enable the system, but we'll skip showing ads if none are available
                            }
                            
                            console.log('Global AdInjectionSystem: Ads enabled', {
                                ad: this.currentAd,
                                nextAdIn: this.nextAdTime,
                                hasAd: !!this.currentAd
                            });
                        } else {
                            this.isEnabled = false;
                            console.log('Global AdInjectionSystem: Ads disabled', {
                                success: data.success,
                                show_ads: data.data ? data.data.show_ads : 'no data',
                                message: data.data ? data.data.message : 'Unknown error'
                            });
                        }
                    } catch (error) {
                        console.error('Global AdInjectionSystem: Error checking ad status', error);
                        this.isEnabled = false;
                    }
                },
                
                // Start ad timer for during-playback ads
                startAdTimer() {
                    if (!this.isEnabled || this.adTimer) return;
                    
                    const randomTime = Math.floor(Math.random() * 50) + 10; // 10-60 seconds
                    console.log(`Global AdInjectionSystem: Starting ad timer for ${randomTime} seconds`);
                    
                    this.adTimer = setTimeout(() => {
                        this.showAdDuringPlayback();
                    }, randomTime * 1000);
                },
                
                // Show ad between songs
                showAdBetweenSongs() {
                    if (!this.isEnabled || this.isShowingAd) {
                        console.log('Global AdInjectionSystem: Cannot show ad - system disabled or already showing', {
                            isEnabled: this.isEnabled,
                            isShowingAd: this.isShowingAd
                        });
                        return;
                    }
                    
                    if (!this.currentAd) {
                        console.log('Global AdInjectionSystem: No ad available, skipping ad display');
                        // If no ad is available, trigger next track
                        if (window.MusicPlayer && typeof window.MusicPlayer.nextTrack === 'function') {
                            window.MusicPlayer.nextTrack();
                        }
                        return;
                    }
                    
                    console.log('Global AdInjectionSystem: Showing ad between songs');
                    this.adShownBetweenSongs = true; // Mark that this ad is between songs
                    this.showAd();
                },
                
                // Show ad during playback
                showAdDuringPlayback() {
                    if (!this.isEnabled || this.isShowingAd) return;
                    console.log('Global AdInjectionSystem: Showing ad during playback');
                    this.adShownBetweenSongs = false; // Mark that this is during playback, not between songs
                    this.showAd();
                },
                
                // Show ad at specific song progress
                showAdAtProgress(progressPercent) {
                    if (!this.isEnabled || this.isShowingAd || this.midSongAdShown) return;
                    console.log(`Global AdInjectionSystem: Showing ad at ${progressPercent}% progress`);
                    this.midSongAdShown = true;
                    this.showAd();
                },
                
                // Show the actual ad
                showAd() {
                    if (!this.currentAd || this.isShowingAd) return;
                    
                    console.log('Global AdInjectionSystem: Displaying ad', this.currentAd);
                    
                    // Pause music player
                    if (window.MusicPlayer && window.MusicPlayer.audio) {
                        window.MusicPlayer.audio.pause();
                    }
                    
                    this.isShowingAd = true;
                    
                    // Create ad overlay
                    const adOverlay = document.createElement('div');
                    adOverlay.id = 'ad-overlay';
                    adOverlay.style.cssText = `
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background: rgba(0, 0, 0, 0.95);
                        z-index: 10000;
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        justify-content: center;
                        color: white;
                        font-family: Arial, sans-serif;
                    `;
                    
                    const adContent = document.createElement('div');
                    adContent.style.cssText = `
                        text-align: center;
                        max-width: 600px;
                        padding: 2rem;
                    `;
                    
                    const adTitle = document.createElement('h2');
                    adTitle.textContent = this.currentAd.title || 'Advertisement';
                    adTitle.style.cssText = `
                        font-size: 2rem;
                        margin-bottom: 1rem;
                        color: #fff;
                    `;
                    
                    let adMedia = '';
                    if (this.currentAd.file_url) {
                        const fileUrl = this.currentAd.file_url;
                        const fileExtension = fileUrl.split('.').pop().toLowerCase();
                        const escapedFileUrl = String(fileUrl).replace(/"/g, '&quot;');
                        const escapedAdTitle = this.currentAd.title ? String(this.currentAd.title).replace(/"/g, '&quot;') : 'Advertisement';
                        
                        if (['mp4', 'webm', 'ogg', 'avi', 'mov'].includes(fileExtension)) {
                            adMedia = `<video controls autoplay muted loop style="max-width: 100%; height: 400px; margin-bottom: 1rem; border-radius: 8px; background: #000;">
                                <source src="${escapedFileUrl}" type="video/${fileExtension}">
                                Your browser does not support the video tag.
                            </video>`;
                        } else if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(fileExtension)) {
                            adMedia = `<img src="${escapedFileUrl}" alt="${escapedAdTitle}" style="max-width: 100%; height: 400px; object-fit: cover; margin-bottom: 1rem; border-radius: 8px;">`;
                        }
                    }
                    
                    const countdown = document.createElement('div');
                    countdown.id = 'ad-countdown';
                    countdown.style.cssText = `
                        font-size: 1.5rem;
                        margin: 1rem 0;
                        color: #ff6b6b;
                    `;
                    
                    const skipButton = document.createElement('button');
                    skipButton.textContent = 'Skip Ad';
                    skipButton.style.cssText = `
                        background: #ff6b6b;
                        color: white;
                        border: none;
                        padding: 0.5rem 1rem;
                        border-radius: 5px;
                        cursor: pointer;
                        font-size: 1rem;
                        margin-top: 1rem;
                    `;
                    skipButton.onclick = () => this.hideAd();
                    
                    const escapedLink = this.currentAd.link ? String(this.currentAd.link).replace(/"/g, '&quot;').replace(/'/g, '&#39;') : '';
                    const escapedAdTitle = this.currentAd.title ? String(this.currentAd.title).replace(/"/g, '&quot;').replace(/'/g, '&#39;') : 'Advertisement';
                    const clickLink = this.currentAd.link ? 
                        `<a href="${escapedLink}" target="_blank" style="color: #4ecdc4; text-decoration: none; font-size: 1.1rem; display: block; margin-top: 1rem;">Visit ${escapedAdTitle}</a>` : '';
                    
                    adContent.innerHTML = `
                        ${adMedia}
                        ${clickLink}
                    `;
                    adContent.appendChild(adTitle);
                    adContent.appendChild(countdown);
                    adContent.appendChild(skipButton);
                    adOverlay.appendChild(adContent);
                    document.body.appendChild(adOverlay);
                    
                    // Start countdown
                    let timeLeft = 15;
                    countdown.textContent = `Ad will end in ${timeLeft} seconds`;
                    
                    this.countdownInterval = setInterval(() => {
                        timeLeft--;
                        countdown.textContent = `Ad will end in ${timeLeft} seconds`;
                        
                        if (timeLeft <= 0) {
                            clearInterval(this.countdownInterval);
                            this.hideAd();
                        }
                    }, 1000);
                },
                
                // Hide the ad
                hideAd() {
                    console.log('Global AdInjectionSystem: Hiding ad');
                    
                    if (this.countdownInterval) {
                        clearInterval(this.countdownInterval);
                        this.countdownInterval = null;
                    }
                    
                    // Reset mid-song ad flag
                    this.midSongAdShown = false;
                    
                    const adOverlay = document.getElementById('ad-overlay');
                    if (adOverlay) {
                        adOverlay.remove();
                    }
                    
                    this.isShowingAd = false;
                    
                    // If ad was shown between songs, proceed to next track
                    // Otherwise, resume the current track
                    if (this.adShownBetweenSongs) {
                        console.log('Global AdInjectionSystem: Ad was between songs, proceeding to next track');
                        this.adShownBetweenSongs = false; // Reset flag
                        if (window.MusicPlayer && typeof window.MusicPlayer.nextTrack === 'function') {
                            setTimeout(() => {
                                window.MusicPlayer.nextTrack();
                            }, 300);
                        }
                    } else {
                        // Resume music if it was playing (during playback ad)
                        if (window.MusicPlayer && window.MusicPlayer.isPlaying) {
                            window.MusicPlayer.audio.play().catch(e => console.error('Error resuming audio:', e));
                        }
                    }
                }
            };
            
            // Initialize on DOM ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', () => {
                    window.adInjectionSystem.init();
                });
            } else {
                window.adInjectionSystem.init();
            }
        }
    </script>

    <!-- Scripts -->
    <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
    <script>
        // Chatbot functionality
        class ChatBot {
            constructor() {
                this.sessionId = this.generateSessionId();
                this.messages = [];
                this.isTyping = false;
                this.userName = null;
                this.userEmail = null;
                
                this.initializeElements();
                this.checkUserInfo();
                this.initializePusher();
                this.bindEvents();
            }
            
            initializeElements() {
                this.toggle = document.getElementById('chatbotToggle');
                this.widget = document.getElementById('chatbotWidget');
                this.closeBtn = document.getElementById('closeChatbot');
                this.closeBtnForm = document.getElementById('closeChatbotForm');
                this.userInfoForm = document.getElementById('userInfoForm');
                this.userInfoSection = document.getElementById('chatbotUserInfo');
                this.chatInterface = document.getElementById('chatbotChatInterface');
                this.body = document.getElementById('chatbotBody');
                this.messagesContainer = document.getElementById('chatMessages');
                this.input = document.getElementById('messageInput');
                this.sendBtn = document.getElementById('sendButton');
                this.typingIndicator = document.getElementById('typingIndicator');
            }

            checkUserInfo() {
                // Check if user info exists in sessionStorage
                const storedName = sessionStorage.getItem('chatbot_user_name');
                const storedEmail = sessionStorage.getItem('chatbot_user_email');
                
                if (storedName && storedEmail) {
                    this.userName = storedName;
                    this.userEmail = storedEmail;
                    this.showChatInterface();
                    this.loadChatHistory();
                } else {
                    this.showUserInfoForm();
                }
            }

            showUserInfoForm() {
                if (this.userInfoSection) {
                    this.userInfoSection.style.display = 'block';
                }
                if (this.chatInterface) {
                    this.chatInterface.style.display = 'none';
                }
            }

            showChatInterface() {
                if (this.userInfoSection) {
                    this.userInfoSection.style.display = 'none';
                }
                if (this.chatInterface) {
                    this.chatInterface.style.display = 'block';
                }
            }

            saveUserInfo(name, email) {
                sessionStorage.setItem('chatbot_user_name', name);
                sessionStorage.setItem('chatbot_user_email', email);
                this.userName = name;
                this.userEmail = email;
                this.showChatInterface();
                this.loadChatHistory();
            }
            
            initializePusher() {
                // Enable pusher logging - don't include this in production
                Pusher.logToConsole = true;
                
                this.pusher = new Pusher('09565a7631534c48bd0e', {
                    cluster: 'ap1'
                });
                
                this.channel = this.pusher.subscribe('chat-channel');
                this.channel.bind('new-message', (data) => {
                    this.handleNewMessage(data);
                });
            }
            
            bindEvents() {
                this.toggle.addEventListener('click', () => this.toggleChatbot());
                this.closeBtn.addEventListener('click', () => this.toggleChatbot());
                if (this.closeBtnForm) {
                    this.closeBtnForm.addEventListener('click', () => this.toggleChatbot());
                }
                
                if (this.userInfoForm) {
                    this.userInfoForm.addEventListener('submit', (e) => {
                        e.preventDefault();
                        const name = document.getElementById('userName').value.trim();
                        const email = document.getElementById('userEmail').value.trim();
                        
                        if (name && email) {
                            // Validate email format
                            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                            if (!emailRegex.test(email)) {
                                alert('Please enter a valid email address');
                                return;
                            }
                            this.saveUserInfo(name, email);
                        }
                    });
                }
                
                this.sendBtn.addEventListener('click', () => this.sendMessage());
                this.input.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') this.sendMessage();
                });
            }
            
            toggleChatbot() {
                // Check if user info exists before opening chat
                if (!this.userName || !this.userEmail) {
                    this.showUserInfoForm();
                }
                this.widget.classList.toggle('active');
                if (this.widget.classList.contains('active')) {
                    if (this.userName && this.userEmail && this.input) {
                        this.input.focus();
                    } else if (document.getElementById('userName')) {
                        document.getElementById('userName').focus();
                    }
                }
            }
            
            generateSessionId() {
                return 'session_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
            }
            
            async loadChatHistory() {
                try {
                    const response = await fetch(`/chat/history?session_id=${this.sessionId}`);
                    const data = await response.json();
                    
                    if (data.success && data.messages.length > 0) {
                        this.messages = data.messages;
                        this.renderMessages();
                    }
                } catch (error) {
                    console.error('Error loading chat history:', error);
                }
            }
            
            async sendMessage() {
                const message = this.input.value.trim();
                if (!message) return;
                
                // Disable input and button
                this.input.disabled = true;
                this.sendBtn.disabled = true;
                
                // Add user message to UI immediately
                this.addMessageToUI({
                    message: message,
                    type: 'user',
                    name: 'You',
                    created_at: new Date()
                });
                
                // Clear input
                this.input.value = '';
                
                // Show typing indicator
                this.showTypingIndicator();
                
                // Ensure user info is available
                if (!this.userName || !this.userEmail) {
                    alert('Please provide your name and email to continue chatting.');
                    this.showUserInfoForm();
                    this.widget.classList.add('active');
                    return;
                }

                try {
                    const response = await fetch('/chat/send', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            session_id: this.sessionId,
                            name: this.userName,
                            email: this.userEmail,
                            message: message
                        })
                    });
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        // Hide typing indicator
                        this.hideTypingIndicator();
                        
                        // Add bot message to UI
                        this.addMessageToUI({
                            message: data.bot_message.message,
                            type: data.bot_message.type,
                            name: data.bot_message.name,
                            created_at: new Date()
                        });
                    }
                } catch (error) {
                    console.error('Error sending message:', error);
                    this.hideTypingIndicator();
                    
                    // Show error message
                    this.addMessageToUI({
                        message: 'Sorry, there was an error sending your message. Please try again.',
                        type: 'bot',
                        name: 'ChatBot',
                        created_at: new Date()
                    });
                }
                
                // Re-enable input and button
                this.input.disabled = false;
                this.sendBtn.disabled = false;
                this.input.focus();
            }
            
            handleNewMessage(data) {
                // This will handle messages from other users in the same session
                // For now, we'll just add them to the UI
                if (data.user_message.session_id === this.sessionId) {
                    this.addMessageToUI({
                        message: data.user_message.message,
                        type: data.user_message.type,
                        name: data.user_message.name,
                        created_at: new Date(data.user_message.created_at)
                    });
                    
                    if (data.bot_message) {
                        this.addMessageToUI({
                            message: data.bot_message.message,
                            type: data.bot_message.type,
                            name: data.bot_message.name,
                            created_at: new Date(data.bot_message.created_at)
                        });
                    }
                }
            }
            
            addMessageToUI(messageData) {
                this.messages.push(messageData);
                this.renderMessages();
                this.scrollToBottom();
            }
            
            renderMessages() {
                this.messagesContainer.innerHTML = '';
                
                this.messages.forEach(message => {
                    const messageElement = document.createElement('div');
                    messageElement.className = `message ${message.type}`;
                    
                    if (message.type === 'bot') {
                        messageElement.innerHTML = message.message;
                    } else {
                        messageElement.textContent = message.message;
                    }
                    
                    this.messagesContainer.appendChild(messageElement);
                });
            }
            
            showTypingIndicator() {
                this.typingIndicator.style.display = 'block';
                this.scrollToBottom();
            }
            
            hideTypingIndicator() {
                this.typingIndicator.style.display = 'none';
            }
            
            scrollToBottom() {
                this.body.scrollTop = this.body.scrollHeight;
            }
        }
        
        // Initialize chatbot when page loads
        document.addEventListener('DOMContentLoaded', () => {
            new ChatBot();
        });
    </script>
@yield('script')
@yield('js')

