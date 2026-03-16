<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SingWithMe | Complete Label Command Center</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #9d50bb; 
            --primary-light: #be93c5;
            --accent: #00f2fe;
            --bg-body: #0f0c29; 
            --bg-sidebar: #131130;
            --bg-card: #1b1840;
            --border: rgba(157, 80, 187, 0.2);
            --text-main: #e0e0e0;
            --text-dim: #948fb5;
            --danger: #ff4b2b;
            --success: #00f2fe;
            --warning: #f1c40f;
            --sidebar-width: 280px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        
        body { 
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            color: var(--text-main);
            height: 100vh;
            overflow: hidden;
        }
        a {
            text-decoration:none;
        }
        /* --- LAYOUT & CORE --- */
.singwithme_dashboard .layout { display: flex; height: 100vh; position: relative; }

/* --- SIDEBAR --- */
.singwithme_dashboard .sidebar {
    width: var(--sidebar-width); 
    background: var(--bg-sidebar);
    border-right: 1px solid var(--border);
    display: flex; flex-direction: column; z-index: 2000;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

@media (max-width: 1024px) {
    .singwithme_dashboard .sidebar { position: absolute; left: -280px; height: 100%; }
    .singwithme_dashboard .sidebar.active { left: 0; box-shadow: 20px 0 50px rgba(0,0,0,0.8); }
}

.singwithme_dashboard .brand {
    padding: 30px; font-size: 22px; font-weight: 800;
    background: linear-gradient(to right, #fff, var(--primary-light));
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    display: flex; align-items: center; gap: 10px;
}

.singwithme_dashboard .nav-group { padding: 10px 20px; flex: 1; overflow-y: auto; }
.singwithme_dashboard .nav-label { color: var(--text-dim); font-size: 11px; text-transform: uppercase; letter-spacing: 1.5px; margin: 20px 0 10px 10px; }

.singwithme_dashboard .nav-link {
    display: flex; align-items: center; gap: 12px; padding: 14px 18px;
    color: var(--text-dim); text-decoration: none; border-radius: 12px;
    margin-bottom: 5px; cursor: pointer; transition: 0.3s;
}

.singwithme_dashboard .nav-link:hover, 
.singwithme_dashboard .nav-link.active {
    background: rgba(157, 80, 187, 0.15);
    color: #fff; box-shadow: inset 4px 0 0 var(--primary);
}

/* --- HEADER --- */
.singwithme_dashboard .main { flex: 1; display: flex; flex-direction: column; overflow: hidden; min-width: 0; }
.singwithme_dashboard .header {
    height: 80px; padding: 0 25px; display: flex; align-items: center;
    justify-content: space-between; background: rgba(19, 17, 48, 0.5);
    backdrop-filter: blur(10px); border-bottom: 1px solid var(--border);
}

.singwithme_dashboard .mobile-toggle {
    display: none; background: none; border: none; color: white;
    font-size: 20px; cursor: pointer; margin-right: 15px;
}
@media (max-width: 1024px) { .singwithme_dashboard .mobile-toggle { display: block; } }

.singwithme_dashboard .header-actions { display: flex; align-items: center; gap: 20px; position: relative; }

/* --- NOTIFICATION --- */
.singwithme_dashboard .notif-wrapper { position: relative; cursor: pointer; padding: 5px; }
.singwithme_dashboard .badge {
    position: absolute; top: 0; right: 0; background: var(--danger);
    width: 18px; height: 18px; border-radius: 50%; font-size: 10px;
    display: grid; place-items: center; border: 2px solid var(--bg-sidebar);
}
.singwithme_dashboard .notif-dropdown {
    position: absolute; top: 55px; right: -10px; width: 280px;
    background: var(--bg-card); border: 1px solid var(--primary);
    border-radius: 15px; box-shadow: 0 15px 35px rgba(0,0,0,0.6);
    display: none; z-index: 5000; backdrop-filter: blur(20px);
}
.singwithme_dashboard .notif-dropdown.show { display: block; }
.singwithme_dashboard .notif-item { padding: 12px 15px; border-bottom: 1px solid var(--border); font-size: 13px; }
.singwithme_dashboard .notif-item:last-child { border-bottom: none; }

/* --- CONTENT & GRID --- */
.singwithme_dashboard .content { padding: 25px; overflow-y: auto; flex: 1; }
.singwithme_dashboard .grid-4 { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 30px; }
.singwithme_dashboard .grid-2 { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 30px; }

.singwithme_dashboard .glass-card {
    background: var(--bg-card); padding: 20px; border-radius: 20px;
    border: 1px solid var(--border); transition: 0.3s;
}
.singwithme_dashboard .glass-card:hover { transform: translateY(-5px); border-color: var(--primary); }

.singwithme_dashboard .tab-content { display: none; animation: slideUp 0.4s ease; }
.singwithme_dashboard .tab-content.active { display: block; }

@keyframes slideUp { 
    from { opacity: 0; transform: translateY(15px); } 
    to { opacity: 1; transform: translateY(0); } 
}

/* --- TABLES --- */
.singwithme_dashboard .table-container { width: 100%; overflow-x: auto; margin-top: 15px; }
.singwithme_dashboard table { width: 100%; border-collapse: collapse; min-width: 600px; }
.singwithme_dashboard th { text-align: left; padding: 12px; color: var(--text-dim); font-size: 11px; border-bottom: 1px solid var(--border); text-transform: uppercase; }
.singwithme_dashboard td { padding: 12px; border-bottom: 1px solid var(--border); font-size: 14px; }

/* --- UI ELEMENTS --- */
.singwithme_dashboard .stat-value { font-size: 26px; font-weight: 800; margin: 8px 0; }
.singwithme_dashboard .progress-bar { width: 100%; height: 8px; background: rgba(255,255,255,0.1); border-radius: 10px; margin: 10px 0; overflow: hidden;}
.singwithme_dashboard .progress-fill { height: 100%; background: var(--accent); }

.singwithme_dashboard .btn { padding: 10px 20px; border-radius: 10px; border: none; cursor: pointer; font-weight: 600; transition: 0.3s; }
.singwithme_dashboard .btn-primary { background: var(--primary); color: white; }

/* --- MODALS & OVERLAYS --- */
.singwithme_dashboard .modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.85); display: none; align-items: center; justify-content: center; z-index: 6000; }
.singwithme_dashboard .modal-box { background: var(--bg-card); width: 90%; max-width: 450px; padding: 25px; border-radius: 20px; border: 1px solid var(--primary); }
.singwithme_dashboard input, 
.singwithme_dashboard select { width: 100%; padding: 10px; background: rgba(0,0,0,0.3); border: 1px solid var(--border); color: white; border-radius: 8px; margin-top: 5px; }

.singwithme_dashboard .sidebar-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.6); display: none; z-index: 1500; backdrop-filter: blur(4px); }
.singwithme_dashboard .sidebar-overlay.active { display: block; }
    </style>
</head>
<body>

<section class="singwithme_dashboard">
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <div class="layout">
        <aside class="sidebar" id="sidebar">
           <a href="/">
            <div class="brand"><i class="fa-solid fa-bolt"></i> SingWithMe</div>
            </a>
            <div class="nav-group">
                <div class="nav-label">Main</div>
                <div class="nav-link active" onclick="showTab('dash-tab')"><i class="fa-solid fa-chart-pie"></i> Dashboard</div>
                <div class="nav-link" onclick="showTab('tracks-tab')"><i class="fa-solid fa-music"></i> Tracks Catalog</div>
                <div class="nav-link" onclick="showTab('artists-tab')"><i class="fa-solid fa-microphone-lines"></i> Artists</div>
                
                <div class="nav-label">Label Operations</div>
                <div class="nav-link" onclick="showTab('royalties-tab')"><i class="fa-solid fa-sack-dollar"></i> Royalties & Payouts</div>
                <div class="nav-link" onclick="showTab('distro-tab')"><i class="fa-solid fa-globe"></i> Global Distribution</div>
                <div class="nav-link" onclick="showTab('marketing-tab')"><i class="fa-solid fa-bullhorn"></i> PR Campaigns</div>
                
                <div class="nav-label">Admin</div>
                <div class="nav-link" onclick="showTab('users-tab')"><i class="fa-solid fa-circle-user"></i> User Base</div>
                <div class="nav-link" onclick="showTab('analytics-tab')"><i class="fa-solid fa-chart-line"></i> Analytics</div>
                <div class="nav-link" onclick="showTab('settings-tab')"><i class="fa-solid fa-sliders"></i> Settings</div>
            </div>
        </aside>

        <main class="main">
            <header class="header">
                <div style="display:flex; align-items:center;">
                    <button class="mobile-toggle" onclick="toggleSidebar()"><i class="fa-solid fa-bars"></i></button>
                    <h2 id="view-title">Dashboard Overview</h2>
                </div>
                <div class="header-actions">
                    <div class="notif-wrapper" onclick="toggleNotif(event)">
                        <i class="fa-regular fa-bell" style="font-size: 22px;"></i>
                        <span class="badge">3</span>
                        <div class="notif-dropdown" id="notifBox">
                            <div class="notif-item"><b>New Artist:</b> Luna Ray joined.</div>
                            <div class="notif-item"><b>System:</b> Backup completed.</div>
                            <div class="notif-item"><b>Payouts:</b> 5 artists paid.</div>
                        </div>
                    </div>
                    <img src="https://i.pravatar.cc/150?u=admin" style="width: 40px; border-radius: 12px; border: 2px solid var(--primary);">
                </div>
            </header>

            <div class="content">
                <div id="dash-tab" class="tab-content active">
                    <div class="grid-4">
                        <div class="glass-card"><h4>Active Users</h4><div class="stat-value" style="color:var(--accent)">24,502</div></div>
                        <div class="glass-card"><h4>New Tracks</h4><div class="stat-value" style="color:var(--primary-light)">1,104</div></div>
                        <div class="glass-card"><h4>Total Revenue</h4><div class="stat-value" style="color:#00ff88">$84.2K</div></div>
                        <div class="glass-card"><h4>Uptime</h4><div class="stat-value">99.9%</div></div>
                    </div>
                    <div class="grid-2">
                        <div class="glass-card"><h3>Streaming Activity</h3><svg viewBox="0 0 500 100" style="width:100%; margin-top:15px;"><path d="M0,80 Q100,20 200,70 T400,30 L500,50" fill="none" stroke="var(--accent)" stroke-width="3"/></svg></div>
                        <div class="glass-card"><h3>Recent Events</h3><p style="margin-top:10px; font-size:13px; color:var(--text-dim)">• Luna Ray uploaded "Neon Nights"<br>• Payouts processed for Dec 2025</p></div>
                    </div>
                </div>

                <div id="tracks-tab" class="tab-content">
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <h2>Tracks Catalog</h2>
                        <button class="btn btn-primary" onclick="openModal()">+ Add New</button>
                    </div>
                    <div class="glass-card table-container">
                        <table id="trackList">
                            <thead><tr><th>Track</th><th>Artist</th><th>Genre</th><th>Status</th></tr></thead>
                            <tbody>
                                <tr><td>Neon Nights</td><td>Retro Wave</td><td>Electronic</td><td><span style="color:var(--success)">Live</span></td></tr>
                                <tr><td>Soul Echo</td><td>Misty G.</td><td>Jazz</td><td><span style="color:var(--success)">Live</span></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="artists-tab" class="tab-content">
                    <h2>Artist Management</h2>
                    <div class="glass-card table-container">
                        <table>
                            <thead><tr><th>Artist</th><th>Followers</th><th>Verified</th><th>Earnings</th></tr></thead>
                            <tbody>
                                <tr><td>Luna Ray</td><td>150,000</td><td><i class="fa-solid fa-check-circle" style="color:var(--accent)"></i></td><td>$4,500.00</td></tr>
                                <tr><td>Retro Wave</td><td>89,200</td><td><i class="fa-solid fa-check-circle" style="color:var(--accent)"></i></td><td>$2,100.00</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="royalties-tab" class="tab-content">
                    <h2>Financial Command</h2>
                    <div class="grid-4" style="margin-top:15px;">
                        <div class="glass-card"><h4>Pending</h4><h3 style="color:var(--warning)">$12,450</h3></div>
                        <div class="glass-card"><h4>Paid</h4><h3>$1.2M</h3></div>
                        <div class="glass-card"><h4>Label Fee</h4><h3>15%</h3></div>
                        <div class="glass-card"><h4>Tax Est.</h4><h3 style="color:var(--danger)">$3,735</h3></div>
                    </div>
                    <div class="glass-card table-container">
                        <h3>Recent Payouts</h3>
                        <table>
                            <thead><tr><th>Artist</th><th>Amount</th><th>Method</th><th>Status</th></tr></thead>
                            <tbody><tr><td>Luna Ray</td><td>$4,500</td><td>UK Bank</td><td><span style="color:var(--warning)">Pending</span></td></tr></tbody>
                        </table>
                    </div>
                </div>

                <div id="distro-tab" class="tab-content">
                    <h2>Global Distribution</h2>
                    <div class="glass-card" style="margin-top:15px;">
                        <b>Current Pipeline: Neon Nights</b>
                        <div class="progress-bar"><div class="progress-fill" style="width: 85%;"></div></div>
                        <p style="font-size:12px; color:var(--text-dim)">Delivering to Spotify, Apple Music, Tidal...</p>
                    </div>
                </div>

                <div id="marketing-tab" class="tab-content">
                    <h2>PR Campaigns</h2>
                    <div class="grid-2" style="margin-top:15px;">
                        <div class="glass-card"><h4>Active: Winter Tour</h4><div class="progress-bar"><div class="progress-fill" style="width:45%"></div></div></div>
                        <div class="glass-card"><h4>Media Reach</h4><div class="stat-value">+440K</div></div>
                    </div>
                </div>

                <div id="users-tab" class="tab-content">
                    <h2>User Base</h2>
                    <div class="glass-card table-container">
                        <table>
                            <thead><tr><th>User</th><th>Role</th><th>Plan</th><th>Joined</th></tr></thead>
                            <tbody>
                                <tr><td>Alex_99</td><td>Artist</td><td>Premium</td><td>Dec 2025</td></tr>
                                <tr><td>Sarah_Sky</td><td>Listener</td><td>Free</td><td>Nov 2025</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="analytics-tab" class="tab-content">
                    <h2>Platform Analytics</h2>
                    <div class="grid-4" style="margin-top:15px;">
                        <div class="glass-card"><h4>Sessions</h4><h3>14.2M</h3></div>
                        <div class="glass-card"><h4>Retention</h4><h3 style="color:var(--success)">88%</h3></div>
                        <div class="glass-card"><h4>Bounce</h4><h3 style="color:var(--danger)">12%</h3></div>
                        <div class="glass-card"><h4>Avg Time</h4><h3>4:20m</h3></div>
                    </div>
                </div>

                <div id="settings-tab" class="tab-content">
                    <h2>System Settings</h2>
                    <div class="grid-2" style="margin-top:15px;">
                        <div class="glass-card">
                            <h3>General</h3>
                            <label>Label Name</label><input type="text" value="SingWithMe Records">
                            <label style="margin-top:10px; display:block;">Admin Email</label><input type="email" value="admin@singwithmerecords.co.uk">
                            <button class="btn btn-primary" style="margin-top:15px;">Save</button>
                        </div>
                        <div class="glass-card">
                            <h3>Security</h3>
                            <label>API Key</label><input type="password" value="**********">
                            <label style="margin-top:10px; display:block;">2FA Status</label>
                            <select><option>Enabled</option><option>Disabled</option></select>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div class="modal-overlay" id="modal">
        <div class="modal-box">
            <h2>Upload New Track</h2>
            <form id="trackForm">
                <div style="margin:15px 0;"><label>Title</label><input type="text" id="t_title" required></div>
                <div style="margin:15px 0;"><label>Artist</label><input type="text" id="t_artist" required></div>
                <div style="margin:15px 0;"><label>Genre</label>
                    <select id="t_genre"><option>Electronic</option><option>Pop</option><option>Jazz</option></select>
                </div>
                <div style="display:flex; gap:10px; margin-top:20px;">
                    <button type="submit" class="btn btn-primary" style="flex:1">Publish</button>
                    <button type="button" class="btn" style="flex:1; background:#333; color:white;" onclick="closeModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('active');
        document.getElementById('sidebarOverlay').classList.toggle('active');
    }

    function toggleNotif(e) {
        e.stopPropagation();
        document.getElementById('notifBox').classList.toggle('show');
    }

    function showTab(tabId) {
        const titles = {
            'dash-tab': 'Dashboard Overview', 'tracks-tab': 'Tracks Catalog', 'artists-tab': 'Artist Management',
            'royalties-tab': 'Financial Command', 'distro-tab': 'Global Distribution', 'marketing-tab': 'PR Campaigns',
            'users-tab': 'User Base', 'analytics-tab': 'Analytics', 'settings-tab': 'Settings'
        };
        
        document.getElementById('view-title').innerText = titles[tabId];
        document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
        
        document.getElementById(tabId).classList.add('active');
        const activeLink = Array.from(document.querySelectorAll('.nav-link')).find(link => link.getAttribute('onclick').includes(tabId));
        if (activeLink) activeLink.classList.add('active');

        if(window.innerWidth <= 1024 && document.getElementById('sidebar').classList.contains('active')) toggleSidebar();
    }

    function openModal() { document.getElementById('modal').style.display = 'flex'; }
    function closeModal() { document.getElementById('modal').style.display = 'none'; }

    window.onclick = function(e) {
        if (!e.target.closest('.notif-wrapper')) {
            document.getElementById('notifBox').classList.remove('show');
        }
    }

    document.getElementById('trackForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const row = `<tr><td>${document.getElementById('t_title').value}</td><td>${document.getElementById('t_artist').value}</td><td>${document.getElementById('t_genre').value}</td><td><span style="color:var(--primary-light)">Processing</span></td></tr>`;
        document.querySelector('#trackList tbody').insertAdjacentHTML('beforeend', row);
        closeModal();
    });
</script>
</body>
</html>