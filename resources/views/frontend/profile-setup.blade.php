@extends('layouts.frontend.master')


@section('css')
<style>

.secprofile_setup {
    position:relative;
    padding:4rem 0;
}

.secprofile_setup .header {
  text-align: center;
  margin-bottom: 40px;
  animation: fadeInDown 0.6s ease;
}

.secprofile_setup .header h1 {
  font-size: 2.5rem;
  background: -webkit-linear-gradient(#fbfbfb, #9e67e5, #c192ff);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  margin-bottom: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 15px;
  font-family: 'Poppins';
  font-weight: 600;
}

.secprofile_setup .header-icon {
  width: 40px;
  height: 40px;
}

.secprofile_setup .progress-bar {
  width: 100%;
  height: 6px;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 10px;
  overflow: hidden;
  margin: 20px 0;
}

.secprofile_setup .progress-fill {
  height: 100%;
      background: linear-gradient(90deg, #673AB7 0%, #9C27B0 100%);
  width: 0%;
  transition: width 0.5s ease;
  box-shadow: 0 0 20px rgba(167, 139, 250, 0.6);
}

.secprofile_setup .progress-text {
  text-align: center;
  margin-top: 10px;
  color: #a78bfa;
  font-weight: 500;
}

.glass-card {
  background: linear-gradient(135deg, #120b28 0%, #120b28 100%);
  backdrop-filter: blur(10px);
  border-radius: 20px;
  padding: 30px;
  margin-bottom: 30px;
  border: 1px solid rgba(255, 255, 255, 0.1);
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  animation: fadeInUp 0.6s ease;
}

.glass-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 40px rgb(146 85 255 / 0%) !important;
}

.card-title {
  font-size: 1.5rem;
  margin-bottom: 20px;
  color: #fff;
  display: flex;
  align-items: center;
  gap: 10px;
  font-family: 'Poppins';
  
}

.card-icon {
  width: 28px;
  height: 28px;
}

.profile-preview {
  display: flex;
  gap: 30px;
  align-items: flex-start;
  flex-wrap: wrap;
}

.image-upload-section {
  flex: 0 0 200px;
}

.image-preview {
  width: 200px;
  height: 200px;
  border-radius: 20px;
  background: linear-gradient(135deg, rgba(167, 139, 250, 0.2), rgb(52 33 85));
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 15px;
  overflow: hidden;
  border: 2px dashed rgba(167, 139, 250, 0.5);
  cursor: pointer;
  transition: all 0.3s ease;
  position: relative;
}

.image-preview:hover {
  border-color: #a78bfa;
  box-shadow: 0 0 20px rgba(167, 139, 250, 0.3);
}

.image-preview img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.image-placeholder {
  width: 80px;
  height: 80px;
  opacity: 0.3;
}

.circle-preview {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  background: linear-gradient(135deg, rgba(167, 139, 250, 0.2), rgb(52 33 85));
  overflow: hidden;
  border: 2px solid rgba(167, 139, 250, 0.5);
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: center;
}

.circle-preview img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.circle-preview svg {
  width: 40px;
  height: 40px;
  opacity: 0.3;
}

.profile-info {
  flex: 1;
  min-width: 300px;
}

.input-group {
  margin-bottom: 20px;
  display:block;
}

.input-label {
  display: block;
  margin-bottom: 8px;
  color: #a78bfa;
  font-weight: 500;
  font-size: 0.9rem;
}

.required {
  color: #ec4899;
}

.input-field {
  width: 100%;
  padding: 12px 16px;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 12px !important;
  color: #fff;
  font-size: 1rem;
  transition: all 0.3s ease;
  outline: none;
}

.input-field:focus {
  border-color: #a78bfa;
  box-shadow: 0 0 0 3px rgba(167, 139, 250, 0.2);
  background: rgba(255, 255, 255, 0.08);
}

textarea.input-field {
  resize: vertical;
  min-height: 100px;
}

.char-count {
  text-align: right;
  font-size: 0.8rem;
  color: rgba(255, 255, 255, 0.5);
  margin-top: 5px;
}

.badges-row {
  display: flex;
  gap: 15px;
  align-items: center;
  margin-top: 10px;
}

.toggle-switch {
  position: relative;
  width: 50px;
  height: 26px;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 15px;
  cursor: pointer;
  transition: background 0.3s ease;
}

.toggle-switch.active {
  background: -webkit-linear-gradient(#b087f9, #9e67e5, #c192ff);
}

.toggle-slider {
  position: absolute;
  top: 3px;
  left: 3px;
  width: 20px;
  height: 20px;
  background: #fff;
  border-radius: 50%;
  transition: transform 0.3s ease;
}

.toggle-switch.active .toggle-slider {
  transform: translateX(24px);
}

.verified-badge {
      display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 2px 12px !important;
    background: rgb(214 199 241) !important;
    border: 1px solid rgba(59, 130, 246, 0.5);
    border-radius: 20px;
    font-size: 0.85rem;
    color: #673AB7 !important;
}

.verified-badge svg {
  width: 16px;
  height: 16px;
}

.genre-pills {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-top: 15px;
}

.pill {
  padding: 8px 16px;
  background: rgba(167, 139, 250, 0.2);
  border: 0px solid rgba(167, 139, 250, 0.5);
  border-radius: 20px;
  color: #a78bfa;
  cursor: pointer;
  transition: all 0.3s ease;
  font-size: 0.9rem;
}

.pill:hover {
  background: rgba(167, 139, 250, 0.3);
  transform: translateY(-2px);
}

.pill.selected {
  background: -webkit-linear-gradient(#8354d7, #9645ff, #c192ff) !important;
  color: #fff;
  border-color: transparent;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
  gap: 20px;
}

.stat-card {
  background: rgba(255, 255, 255, 0.03);
  padding: 20px;
  border-radius: 15px;
  text-align: center;
  border: 1px solid rgba(255, 255, 255, 0.05);
  transition: all 0.3s ease;
}

.stat-card:hover {
  background: rgba(255, 255, 255, 0.05);
  transform: scale(1.05);
}

.stat-label {
  color: rgba(255, 255, 255, 0.6);
  font-size: 0.85rem;
  margin-top: 5px;
}

.details-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
}

.detail-card {
  background: rgba(255, 255, 255, 0.03);
  padding: 20px;
  border-radius: 15px;
  border: 1px solid rgba(255, 255, 255, 0.05);
}

.detail-icon {
  width: 32px;
  height: 32px;
  margin-bottom: 10px;
}

.social-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 15px;
}

.social-input {
  display: flex;
  align-items: center;
  gap: 10px;
  background: rgba(255, 255, 255, 0.03);
  padding: 12px;
  border-radius: 12px;
  border: 1px solid rgba(255, 255, 255, 0.1);
  transition: all 0.3s ease;
}

.social-input:focus-within {
  border-color: #a78bfa;
  box-shadow: 0 0 0 3px rgba(167, 139, 250, 0.2);
}

.social-icon {
  width: 24px;
  height: 24px;
  flex-shrink: 0;
}

.social-input input {
  flex: 1;
  background: transparent;
  border: none;
  color: #fff;
  outline: none;
}

.achievements-list {
  display: grid;
  gap: 15px;
}

.achievement-item {
  display: flex;
  align-items: center;
  gap: 15px;
  background: rgba(255, 255, 255, 0.03);
  padding: 15px;
  border-radius: 12px;
  border: 1px solid rgba(255, 255, 255, 0.05);
}

.achievement-icon {
  width: 40px;
  height: 40px;
  flex-shrink: 0;
}

.achievement-content {
  flex: 1;
}

.achievement-title {
  font-weight: 600;
  color: #fff;
  margin-bottom: 5px;
}

.achievement-desc {
  font-size: 0.85rem;
  color: rgba(255, 255, 255, 0.6);
}

.add-achievement-btn {
  margin-top: 1rem;
  width: 100%;
  padding: 12px;
  background: rgba(167, 139, 250, 0.1);
  border: 2px dashed rgba(167, 139, 250, 0.5);
  border-radius: 12px;
  color: #a78bfa;
  cursor: pointer;
  transition: all 0.3s ease;
  font-size: 1rem;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
}

.add-achievement-btn:hover {
  background: rgba(167, 139, 250, 0.2);
  border-color: #a78bfa;
}

.add-achievement-btn svg {
  width: 20px;
  height: 20px;
}

.privacy-toggles {
  display: grid;
  gap: 15px;
}

.privacy-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px;
  background: rgba(255, 255, 255, 0.03);
  border-radius: 12px;
}

.action-buttons {
  display: flex;
  gap: 15px;
  justify-content: center;
  flex-wrap: wrap;
  margin-top: 40px;
}

.btn {
  padding: 14px 30px;
  border: none;
  border-radius: 12px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  gap: 8px;
}

.btn svg {
  width: 20px;
  height: 20px;
}

.btn-primary {
      background: -webkit-linear-gradient(#8354d7, #9645ff, #8a3eef) !important;
  color: #fff;
  box-shadow: 0 4px 15px rgba(167, 139, 250, 0.4);
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(167, 139, 250, 0.6);
}

.btn-secondary {
  background: rgba(255, 255, 255, 0.05);
  color: #a78bfa;
  border: 1px solid rgba(167, 139, 250, 0.5);
}

.btn-secondary:hover {
  background: rgba(255, 255, 255, 0.1);
  transform: translateY(-2px);
}

.toast {
  position: fixed;
  top: 20px;
  right: 20px;
  padding: 16px 24px;
  border-radius: 12px;
  color: #fff;
  font-weight: 500;
  z-index: 1000;
  animation: slideInRight 0.3s ease;
  display: none;
  align-items: center;
  gap: 10px;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
}

.toast.show {
  display: flex;
}

.toast.success {
  background: linear-gradient(135deg, #10b981, #059669);
}

.toast.error {
  background: linear-gradient(135deg, #ef4444, #dc2626);
}

.toast svg {
  width: 20px;
  height: 20px;
}

@keyframes fadeInDown {
  from {
    opacity: 0;
    transform: translateY(-30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes slideInRight {
  from {
    transform: translateX(400px);
  }
  to {
    transform: translateX(0);
  }
}

.spinner {
  border: 3px solid rgba(255, 255, 255, 0.1);
  border-top: 3px solid #fff;
  border-radius: 50%;
  width: 20px;
  height: 20px;
  animation: spin 0.8s linear infinite;
}

@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}

@media (max-width: 768px) {
  .header h1 {
    font-size: 1.8rem;
  }
  
  .profile-preview {
    flex-direction: row !important;
        align-items: center !important;
        justify-content: center;
  }
  .badges-row {
    justify-content: center;
  }
  .card-title {
    justify-content: center;
  }
  .details-grid, .stats-grid, .social-grid {
    grid-template-columns: 1fr;
  }
  
  .action-buttons {
    flex-direction: column;
  }
  
  .btn {
    width: 100%;
    justify-content: center;
  }
}
@media (max-width: 476px) {
    .secprofile_setup .header h1 {
        font-size: 25px !important;
    }
}
</style>
@endsection

@section('content')

<section class="secprofile_setup">
        <div class="container">
        <div class="header">
            <h1>
            <svg class="header-icon" viewBox="0 0 24 24" fill="none" stroke="url(#gradient1)" stroke-width="2">
                <defs>
                <linearGradient id="gradient1" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#c652ff;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#fbfbfb;stop-opacity:1" />
                </linearGradient>
                </defs>
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
            </svg>
            Artist Profile Setup
            </h1>
            <p>Create your stunning artist profile and connect with your fans</p>
            <div class="progress-bar">
            <div class="progress-fill" id="progressFill"></div>
            </div>
            <div class="progress-text" id="progressText">Profile 0% complete</div>
        </div>

        <!-- Profile Header -->
        <div class="glass-card">
            <h2 class="card-title">
            <svg class="card-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
            Profile Header
            </h2>
            <div class="profile-preview">
            <div class="image-upload-section">
                <div class="image-preview" id="imagePreview" onclick="document.getElementById('imageUpload').click()">
                <svg class="image-placeholder" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                    <circle cx="8.5" cy="8.5" r="1.5"/>
                    <polyline points="21 15 16 10 5 21"/>
                </svg>
                </div>
                <input type="file" id="imageUpload" accept="image/*" style="display: none;">
                <div class="circle-preview" id="circlePreview">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
                </div>
            </div>
            
            <div class="profile-info">
                <div class="input-group">
                <label class="input-label">Artist / Stage Name <span class="required">*</span></label>
                <input type="text" class="input-field" id="artistName" placeholder="Enter your artist name" maxlength="50">
                </div>
                
                <div class="input-group">
                <label class="input-label">Username / Handle <span class="required">*</span></label>
                <input type="text" class="input-field" id="username" placeholder="@yourhandle" maxlength="30">
                </div>
                
                <div class="badges-row">
                <label class="input-label">Verified Badge (Admin Only)</label>
                <div class="toggle-switch" id="verifiedToggle">
                    <div class="toggle-slider"></div>
                </div>
                <span class="verified-badge" id="verifiedBadge" style="display: none;">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Verified
                </span>
                </div>
            </div>
            </div>
        </div>

        <!-- About Artist -->
        <div class="glass-card">
            <h2 class="card-title">
            <svg class="card-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
            </svg>
            About Artist
            </h2>
            
            <div class="input-group">
            <label class="input-label">Short Bio (Public Preview)</label>
            <input type="text" class="input-field" id="shortBio" placeholder="A catchy one-liner about you..." maxlength="160">
            <div class="char-count"><span id="bioCount">0</span>/160</div>
            </div>
            
            <div class="input-group">
            <label class="input-label">Full Biography</label>
            <textarea class="input-field" id="fullBio" placeholder="Tell your story..."></textarea>
            </div>
            
            <div class="input-group">
            <label class="input-label">Genres</label>
            <div class="genre-pills" id="genrePills">
                <div class="pill" data-genre="R&B">R&B</div>
                <div class="pill" data-genre="Pop">Pop</div>
                <div class="pill" data-genre="Hip-Hop">Hip-Hop</div>
                <div class="pill" data-genre="Rock">Rock</div>
                <div class="pill" data-genre="Jazz">Jazz</div>
                <div class="pill" data-genre="Electronic">Electronic</div>
                <div class="pill" data-genre="Soul">Soul</div>
                <div class="pill" data-genre="Country">Country</div>
            </div>
            </div>
        </div>

        <!-- Artist Stats -->
        <div class="glass-card">
            <h2 class="card-title">
            <svg class="card-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="20" x2="18" y2="10"/>
                <line x1="12" y1="20" x2="12" y2="4"/>
                <line x1="6" y1="20" x2="6" y2="14"/>
            </svg>
            Artist Stats
            </h2>
            <div class="stats-grid">
            <div class="stat-card">
                <input type="number" class="input-field" id="songsCount" placeholder="0" style="text-align: center;">
                <div class="stat-label">Songs</div>
            </div>
            <div class="stat-card">
                <input type="number" class="input-field" id="albumsCount" placeholder="0" style="text-align: center;">
                <div class="stat-label">Albums</div>
            </div>
            <div class="stat-card">
                <input type="number" class="input-field" id="listenersCount" placeholder="0" style="text-align: center;">
                <div class="stat-label">Monthly Listeners</div>
            </div>
            <div class="stat-card">
                <input type="number" class="input-field" id="streamsCount" placeholder="0" style="text-align: center;">
                <div class="stat-label">Total Streams</div>
            </div>
            </div>
        </div>

        <!-- Artist Details -->
        <div class="glass-card">
            <h2 class="card-title">
            <svg class="card-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="16" x2="12" y2="12"/>
                <line x1="12" y1="8" x2="12.01" y2="8"/>
            </svg>
            Artist Details
            </h2>
            <div class="details-grid">
            <div class="detail-card">
                <svg class="detail-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                <circle cx="12" cy="10" r="3"/>
                </svg>
                <div class="input-group">
                <label class="input-label">City</label>
                <input type="text" class="input-field" id="city" placeholder="Los Angeles">
                </div>
                <div class="input-group">
                <label class="input-label">Country</label>
                <input type="text" class="input-field" id="country" placeholder="United States">
                </div>
            </div>
            
            <div class="detail-card">
                <svg class="detail-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
                <div class="input-group">
                <label class="input-label">Career Start</label>
                <input type="month" class="input-field" id="careerStart">
                </div>
            </div>
            
            <div class="detail-card">
                <svg class="detail-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/>
                <line x1="7" y1="7" x2="7.01" y2="7"/>
                </svg>
                <div class="input-group">
                <label class="input-label">Record Label</label>
                <input type="text" class="input-field" id="recordLabel" placeholder="Your Label">
                </div>
                <div class="badges-row" style="margin-top: 10px;">
                <label class="input-label">Independent</label>
                <div class="toggle-switch" id="independentToggle">
                    <div class="toggle-slider"></div>
                </div>
                </div>
            </div>
            
            <div class="detail-card">
                <svg class="detail-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M9 18V5l12-2v13"/>
                <circle cx="6" cy="18" r="3"/>
                <circle cx="18" cy="16" r="3"/>
                </svg>
                <div class="input-group">
                <label class="input-label">Primary Genre</label>
                <select class="input-field" id="primaryGenre">
                    <option value="">Select Genre</option>
                    <option value="R&B">R&B</option>
                    <option value="Pop">Pop</option>
                    <option value="Hip-Hop">Hip-Hop</option>
                    <option value="Rock">Rock</option>
                    <option value="Jazz">Jazz</option>
                    <option value="Electronic">Electronic</option>
                </select>
                </div>
            </div>
            </div>
        </div>

        <!-- Social Media Links -->
        <div class="glass-card">
            <h2 class="card-title">
            <svg class="card-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
            </svg>
            Social Media & Streaming
            </h2>
            <div class="social-grid">
            <div class="social-input">
                <svg class="social-icon" viewBox="0 0 24 24" fill="currentColor">
                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                </svg>
                <input type="url" placeholder="https://twitter.com/yourhandle" id="twitter">
            </div>
            <div class="social-input">
                <svg class="social-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                </svg>
                <input type="url" placeholder="https://instagram.com/yourhandle" id="instagram">
            </div>
            <div class="social-input">
                <svg class="social-icon" viewBox="0 0 24 24" fill="currentColor">
                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                </svg>
                <input type="url" placeholder="https://youtube.com/yourchannel" id="youtube">
            </div>
            <div class="social-input">
                <svg class="social-icon" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.599-1.559.3z"/>
                </svg>
                <input type="url" placeholder="https://open.spotify.com/artist/..." id="spotify">
            </div>
            <div class="social-input">
                <svg class="social-icon" viewBox="0 0 24 24" fill="currentColor">
                <path d="M23.997 12c0 6.628-5.372 12-12 12s-12-5.372-12-12C-.003 5.372 4.369 0 11.997 0s12 5.372 12 12zm-13.477 7.383c.134 0 .268-.038.383-.113l9.229-5.77a.8.8 0 0 0 0-1.344l-9.229-5.77a.8.8 0 0 0-1.217.672v11.541a.8.8 0 0 0 .834.784z"/>
                </svg>
                <input type="url" placeholder="https://music.apple.com/..." id="appleMusic">
            </div>
            <div class="social-input">
                <svg class="social-icon" viewBox="0 0 24 24" fill="currentColor">
                <path d="M1.175 0A1.175 1.175 0 000 1.175V8.4c0 .648.527 1.175 1.175 1.175H8.4c.648 0 1.175-.527 1.175-1.175V1.175C9.575.527 9.048 0 8.4 0zm13.65 0a1.175 1.175 0 00-1.175 1.175V8.4c0 .648.527 1.175 1.175 1.175h7.225c.648 0 1.175-.527 1.175-1.175V1.175C23.225.527 22.698 0 22.05 0zm-13.65 14.4A1.175 1.175 0 000 15.575v7.225C0 23.448.527 24 1.175 24H8.4c.648 0 1.175-.527 1.175-1.175v-7.225c0-.648-.527-1.175-1.175-1.175zm13.65 0a1.175 1.175 0 00-1.175 1.175v7.225c0 .648.527 1.175 1.175 1.175h7.225c.648 0 1.175-.527 1.175-1.175v-7.225c0-.648-.527-1.175-1.175-1.175z"/>
                </svg>
                <input type="url" placeholder="https://soundcloud.com/yourhandle" id="soundcloud">
            </div>
            </div>
        </div>

        <!-- Achievements -->
        <div class="glass-card">
            <h2 class="card-title">
            <svg class="card-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"/>
                <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"/>
                <path d="M4 22h16"/>
                <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"/>
                <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"/>
                <path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"/>
            </svg>
            Artist Achievements
            </h2>
            <div class="achievements-list" id="achievementsList">
            <div class="achievement-item">
                <svg class="achievement-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z"/>
                <path d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z"/>
                </svg>
                <div class="achievement-content">
                <div class="achievement-title">Diamond Certified</div>
                <div class="achievement-desc">Over 10 million records sold worldwide</div>
                </div>
            </div>
            <div class="achievement-item">
                <svg class="achievement-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                <path d="M2 12h20"/>
                </svg>
                <div class="achievement-content">
                <div class="achievement-title">Global Streaming Leader</div>
                <div class="achievement-desc">Top 100 most streamed artists globally</div>
                </div>
            </div>
            </div>
            <button class="add-achievement-btn" onclick="addAchievement()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"/>
                <line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Add Achievement
            </button>
        </div>

        <!-- Privacy & Visibility -->
        <div class="glass-card">
            <h2 class="card-title">
            <svg class="card-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
            </svg>
            Privacy & Visibility
            </h2>
            <div class="privacy-toggles">
            <div class="privacy-item">
                <span>Public Profile</span>
                <div class="toggle-switch active" id="publicToggle">
                <div class="toggle-slider"></div>
                </div>
            </div>
            <div class="privacy-item">
                <span>Show Stats</span>
                <div class="toggle-switch active" id="showStatsToggle">
                <div class="toggle-slider"></div>
                </div>
            </div>
            <div class="privacy-item">
                <span>Show Achievements</span>
                <div class="toggle-switch active" id="showAchievementsToggle">
                <div class="toggle-slider"></div>
                </div>
            </div>
            <div class="privacy-item">
                <span>Allow Tips</span>
                <div class="toggle-switch" id="allowTipsToggle">
                <div class="toggle-slider"></div>
                </div>
            </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <button class="btn btn-secondary" onclick="saveDraft()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                <polyline points="17 21 17 13 7 13 7 21"/>
                <polyline points="7 3 7 8 15 8"/>
            </svg>
            Save Draft
            </button>
            <button class="btn btn-secondary" onclick="previewProfile()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                <circle cx="12" cy="12" r="3"/>
            </svg>
            Preview Profile
            </button>
            <button class="btn btn-primary" onclick="publishProfile()">
            <span id="publishText" style="display: flex; align-items: center; gap: 8px;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M5 12h14"/>
                <path d="M12 5l7 7-7 7"/>
                </svg>
                Publish Profile
            </span>
            <div class="spinner" id="publishSpinner" style="display: none;"></div>
            </button>
        </div>
        </div>

        <!-- Toast Notification -->
        <div class="toast" id="toast">
        <svg id="toastIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"></svg>
        <span id="toastMessage"></span>
        </div>
    </section>


    <script>
        // Profile Image Upload
        const imageUpload = document.getElementById('imageUpload');
        const imagePreview = document.getElementById('imagePreview');
        const circlePreview = document.getElementById('circlePreview');

            imageUpload.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                const img = `<img src="${event.target.result}" alt="Profile">`;
                imagePreview.innerHTML = img;
                circlePreview.innerHTML = img;
                updateProgress();
                };
                reader.readAsDataURL(file);
            }
            });

            // Character Counter
            const shortBio = document.getElementById('shortBio');
            const bioCount = document.getElementById('bioCount');

            shortBio.addEventListener('input', function() {
            bioCount.textContent = this.value.length;
            updateProgress();
            });

            // Toggle Switches
            function setupToggle(id) {
            const toggle = document.getElementById(id);
            toggle.addEventListener('click', function() {
                this.classList.toggle('active');
                updateProgress();
            });
            }

            setupToggle('verifiedToggle');
            setupToggle('independentToggle');
            setupToggle('publicToggle');
            setupToggle('showStatsToggle');
            setupToggle('showAchievementsToggle');
            setupToggle('allowTipsToggle');

            // Verified Badge Display
            document.getElementById('verifiedToggle').addEventListener('click', function() {
            const badge = document.getElementById('verifiedBadge');
            badge.style.display = this.classList.contains('active') ? 'inline-flex' : 'none';
            });

            // Genre Pills Selection
            const genrePills = document.querySelectorAll('.pill');
            genrePills.forEach(pill => {
            pill.addEventListener('click', function() {
                this.classList.toggle('selected');
                updateProgress();
            });
            });

            // Input Field Listeners
            const inputs = ['artistName', 'username', 'city', 'country', 'recordLabel', 'primaryGenre', 'twitter', 'instagram', 'youtube', 'spotify', 'appleMusic', 'soundcloud', 'fullBio', 'careerStart', 'songsCount', 'albumsCount', 'listenersCount', 'streamsCount'];

            inputs.forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                element.addEventListener('input', updateProgress);
            }
            });

            // Progress Calculation
            function updateProgress() {
            let completed = 0;
            let total = 15;
            
            if (imagePreview.querySelector('img')) completed++;
            if (document.getElementById('artistName').value) completed++;
            if (document.getElementById('username').value) completed++;
            if (document.getElementById('shortBio').value) completed++;
            if (document.getElementById('fullBio').value) completed++;
            if (document.querySelectorAll('.pill.selected').length > 0) completed++;
            if (document.getElementById('city').value) completed++;
            if (document.getElementById('country').value) completed++;
            if (document.getElementById('careerStart').value) completed++;
            if (document.getElementById('recordLabel').value) completed++;
            if (document.getElementById('primaryGenre').value) completed++;
            if (document.getElementById('twitter').value || document.getElementById('instagram').value) completed++;
            if (document.getElementById('spotify').value || document.getElementById('appleMusic').value) completed++;
            if (document.getElementById('songsCount').value) completed++;
            if (document.getElementById('listenersCount').value) completed++;
            
            const percentage = Math.round((completed / total) * 100);
            document.getElementById('progressFill').style.width = percentage + '%';
            document.getElementById('progressText').textContent = `Profile ${percentage}% complete`;
            }

            // Add Achievement
            function addAchievement() {
            const title = prompt('Achievement Title:');
            if (!title) return;
            
            const desc = prompt('Achievement Description:');
            if (!desc) return;
            
            const achievementsList = document.getElementById('achievementsList');
            const newAchievement = document.createElement('div');
            newAchievement.className = 'achievement-item';
            newAchievement.innerHTML = `
                <svg class="achievement-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                </svg>
                <div class="achievement-content">
                <div class="achievement-title">${title}</div>
                <div class="achievement-desc">${desc}</div>
                </div>
            `;
            achievementsList.appendChild(newAchievement);
            showToast('Achievement added successfully!', 'success');
            }

            // Toast Notification
            function showToast(message, type = 'success') {
            const toast = document.getElementById('toast');
            const toastIcon = document.getElementById('toastIcon');
            const toastMessage = document.getElementById('toastMessage');
            
            toast.className = `toast ${type}`;
            
            if (type === 'success') {
                toastIcon.innerHTML = '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>';
            } else {
                toastIcon.innerHTML = '<circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/>';
            }
            
            toastMessage.textContent = message;
            toast.classList.add('show');
            
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
            }

            // Save Draft
            function saveDraft() {
            showToast('Draft saved successfully!', 'success');
            }

            // Preview Profile
            function previewProfile() {
            const artistName = document.getElementById('artistName').value;
            if (!artistName) {
                showToast('Please enter an artist name first', 'error');
                return;
            }
            showToast('Opening preview...', 'success');
            }

            // Publish Profile
            function publishProfile() {
            const artistName = document.getElementById('artistName').value;
            const username = document.getElementById('username').value;
            
            if (!artistName || !username) {
                showToast('Please fill in required fields (Artist Name & Username)', 'error');
                return;
            }
            
            const publishText = document.getElementById('publishText');
            const publishSpinner = document.getElementById('publishSpinner');
            
            publishText.style.display = 'none';
            publishSpinner.style.display = 'block';
            
            setTimeout(() => {
                publishText.style.display = 'flex';
                publishSpinner.style.display = 'none';
                showToast('Profile published successfully!', 'success');
            }, 2000);
            }

            // Initialize progress on load
            updateProgress();
    </script>
@endsection
