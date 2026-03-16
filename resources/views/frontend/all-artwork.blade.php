@extends('layouts.frontend.master')


@section('css')
    
    <style>
     .allUploaded-artworks {
        position:relative;
     }
          .allUploaded-artworks .detail-container {
  max-width: 1400px;
  margin: 0 auto;
  padding: 60px 20px;
}

.allUploaded-artworks .detail-header {
  margin-bottom: 50px;
  text-align: center;
}

.allUploaded-artworks .breadcrumb {
  display: flex;
  gap: 8px;
  align-items: center;
  margin-bottom: 20px;
  font-size: 0.9rem;
  color: #9d8fb8;
}

.allUploaded-artworks .breadcrumb a {
  color: #b794f6;
  text-decoration: none;
  transition: color 0.3s ease;
}

.allUploaded-artworks .breadcrumb a:hover {
  color: #d8b4fe;
}

.allUploaded-artworks .breadcrumb span {
  color: #6b5b7b;
}

.allUploaded-artworks .detail-title {
  font-size: 3.5rem;
  font-weight: 600;
  margin-bottom: 20px;
  background: -webkit-linear-gradient(#fbfbfb, #9e67e5, #c192ff);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  font-family: 'Poppins';
}

.allUploaded-artworks .detail-description {
  font-size: 1.2rem;
  color: #ffffff;
  line-height: 1.8;
  text-align: center;
  margin-bottom: 30px;
}

.allUploaded-artworks .detail-meta {
  display: flex;
  gap: 30px;
  flex-wrap: wrap;
}

.allUploaded-artworks .meta-item {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 1rem;
  color: #9d8fb8;
}

.allUploaded-artworks .meta-icon {
  width: 20px;
  height: 20px;
  color: #b794f6;
}

.allUploaded-artworks .section-divider {
  height: 1px;
  background: linear-gradient(90deg, transparent, rgba(183, 148, 246, 0.3), transparent);
  margin: 50px 0;
}

.allUploaded-artworks .gallery-section {
  margin-bottom: 60px;
  padding:1rem 0;
}

.allUploaded-artworks .gallery-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 20px;
}

.allUploaded-artworks .gallery-card {
  position: relative;
  overflow: hidden;
  border-radius: 12px;
  cursor: pointer;
  background: rgba(45, 27, 78, 0.5);
  border: 1px solid rgba(183, 148, 246, 0.2);
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  aspect-ratio: 1;
}

.allUploaded-artworks .gallery-card:hover {
  transform: translateY(-8px);
  border-color: rgba(183, 148, 246, 0.5);
  //box-shadow: 0 12px 40px rgba(183, 148, 246, 0.3);
}

.allUploaded-artworks .gallery-card img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.6s ease;
}

.allUploaded-artworks .gallery-card:hover img {
  transform: scale(1.1);
}

.allUploaded-artworks .card-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(to top, rgb(17 11 28) 0%, rgba(26, 11, 46, 0.4) 50%, transparent 100%);
  opacity: 0;
  transition: opacity 0.4s ease;
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  padding: 20px;
}

.allUploaded-artworks .gallery-card:hover .card-overlay {
  opacity: 1;
}

.allUploaded-artworks .card-title {
  font-size: 1.2rem;
  font-weight: 600;
  color: #ffffff;
  margin-bottom: 5px;
  transform: translateY(20px);
  transition: transform 0.4s ease;
}

.allUploaded-artworks .gallery-card:hover .card-title {
  transform: translateY(0);
}

.allUploaded-artworks .card-subtitle {
  font-size: 0.9rem;
  color: #b794f6;
  transform: translateY(20px);
  transition: transform 0.4s ease 0.1s;
}

.allUploaded-artworks .gallery-card:hover .card-subtitle {
  transform: translateY(0);
}

.allUploaded-artworks .content-section {
  margin-bottom: 50px;
}

.allUploaded-artworks .content-text {
  font-size: 1.1rem;
  color: #b8a8d0;
  line-height: 1.9;
  margin-bottom: 25px;
}

.allUploaded-artworks .features-list {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 20px;
  margin-top: 30px;
}

.allUploaded-artworks .feature-item {
  background: rgba(45, 27, 78, 0.4);
  border: 1px solid rgba(183, 148, 246, 0.2);
  border-radius: 12px;
  padding: 25px;
  transition: all 0.3s ease;
}

.allUploaded-artworks .feature-item:hover {
  border-color: rgba(183, 148, 246, 0.5);
  background: rgba(45, 27, 78, 0.6);
  transform: translateX(5px);
}

.allUploaded-artworks .feature-title {
  font-size: 1.2rem;
  font-weight: 600;
  color: #d8b4fe;
  margin-bottom: 10px;
}

.allUploaded-artworks .feature-description {
  color: #9d8fb8;
  font-size: 0.95rem;
  line-height: 1.6;
}

.allUploaded-artworks .modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: #120b28;
  backdrop-filter: blur(10px);
  z-index: 9999;
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  visibility: hidden;
  transition: all 0.4s ease;
}

.allUploaded-artworks .modal.active {
  opacity: 1;
  visibility: visible;
}

.allUploaded-artworks .modal-content {
  position: relative;
  max-width: 90vw;
  max-height: 90vh;
  width:40%;
  background:transparent;
  transform: scale(0.8);
  transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.allUploaded-artworks .modal.active .modal-content {
  transform: scale(1);
}

.allUploaded-artworks .modal-image {
  max-width: 100%;
  max-height: 85vh;
  border-radius: 12px;
  box-shadow: 0 20px 60px rgb(183 148 246 / 5%) !important;
  border: 2px solid rgba(183, 148, 246, 0.3);
}

.allUploaded-artworks .modal-info {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background: linear-gradient(to top, rgba(26, 11, 46, 0.98) 0%, transparent 100%);
  padding: 30px;
  border-radius: 0 0 12px 12px;
}

.allUploaded-artworks .modal-title {
  font-size: 2rem;
  font-weight: 700;
  color: #ffffff;
  margin-bottom: 8px;
}

.allUploaded-artworks .modal-subtitle {
  font-size: 1.1rem;
  color: #b794f6;
}

.allUploaded-artworks .close-button {
  position: fixed;
  top: 30px;
  right: 30px;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background: rgba(45, 27, 78, 0.8);
  border: 2px solid #b794f6;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease;
  z-index: 10000;
}

.allUploaded-artworks .close-button:hover {
  background: #b794f6;
  transform: rotate(90deg);
  box-shadow: 0 0 20px rgba(183, 148, 246, 0.6);
}

.allUploaded-artworks .close-button::before,
.allUploaded-artworks .close-button::after {
  content: '';
  position: absolute;
  width: 20px;
  height: 2px;
  background: #ffffff;
}

.allUploaded-artworks .close-button::before {
  transform: rotate(45deg);
}

.allUploaded-artworks .close-button::after {
  transform: rotate(-45deg);
}

.allUploaded-artworks .nav-button {
  position: fixed;
  top: 50%;
  transform: translateY(-50%);
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background: rgba(45, 27, 78, 0.8);
  border: 2px solid #b794f6;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease;
  z-index: 10000;
  opacity: 0;
  visibility: hidden;
}

.allUploaded-artworks .modal.active .nav-button {
  opacity: 1;
  visibility: visible;
}

.allUploaded-artworks .nav-button:hover {
  background: #b794f6;
  transform: translateY(-50%) scale(1.1);
  box-shadow: 0 0 20px rgba(183, 148, 246, 0.6);
}

.allUploaded-artworks .nav-button.prev {
  left: 30px;
}

.allUploaded-artworks .nav-button.next {
  right: 30px;
}

.allUploaded-artworks .nav-button::before {
  content: '';
  width: 12px;
  height: 12px;
  border-top: 2px solid #ffffff;
  border-right: 2px solid #ffffff;
}

.allUploaded-artworks .nav-button.prev::before {
  transform: rotate(-135deg);
  margin-left: 4px;
}

.allUploaded-artworks .nav-button.next::before {
  transform: rotate(45deg);
  margin-right: 4px;
}

.allUploaded-artworks .services-section {
  background: #07001c;
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 24px;
  padding: 60px 50px;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
}

.allUploaded-artworks .section-header {
  text-align: center;
  margin-bottom: 50px;
}

.allUploaded-artworks .section-title {
  font-size: 48px;
  font-weight: 600;
  color: #ffffff;
  margin-bottom: 16px;
  letter-spacing: -1px;
  font-family: 'Poppins';
}

.allUploaded-artworks .section-subtitle {
  font-size: 18px;
  color: rgba(255, 255, 255, 0.7);
  max-width: 700px;
  margin: 0 auto;
  line-height: 1.6;
}

.allUploaded-artworks .services-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: 30px;
  margin-top: 50px;
}

.allUploaded-artworks .service-card {
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 16px;
  padding: 35px;
  transition: all 0.4s ease;
  position: relative;
  overflow: hidden;
}

.allUploaded-artworks .service-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 4px;
  background: -webkit-linear-gradient(#fbfbfb, #9e67e5, #c192ff);
  transform: scaleX(0);
  transition: transform 0.4s ease;
}

.allUploaded-artworks .service-card:hover {
  background: rgba(255, 255, 255, 0.08);
  border-color: rgba(102, 126, 234, 0.5);
  transform: translateY(-5px);
  box-shadow: 0 15px 40px rgba(102, 126, 234, 0.2);
}

.allUploaded-artworks .service-card:hover::before {
  transform: scaleX(1);
}

.allUploaded-artworks .service-icon {
  width: 60px;
  height: 60px;
  padding: 10px;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 28px;
  margin-bottom: 24px;
  box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
}

.allUploaded-artworks .service-title {
  font-size: 22px;
  font-weight: 600;
  color: #ffffff;
  margin-bottom: 12px;
}

.allUploaded-artworks .service-description {
  font-size: 15px;
  color: rgba(255, 255, 255, 0.65);
  line-height: 1.7;
}

.allUploaded-artworks .highlight-box {
  background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
  border: 1px solid rgba(102, 126, 234, 0.3);
  border-radius: 12px;
  padding: 30px;
  margin-top: 40px;
  text-align: center;
}

.allUploaded-artworks .highlight-text {
  font-size: 16px;
  color: rgba(255, 255, 255, 0.85);
  line-height: 1.7;
  margin-bottom: 20px;
     font-weight: unset; 
     background: unset; 
     background-clip: unset; 
    -webkit-background-clip: unset; 
     -webkit-text-fill-color: unset;
}

.allUploaded-artworks .cta-button {
  display: inline-block;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: #ffffff;
  padding: 14px 35px;
  border-radius: 8px;
  text-decoration: none;
  font-weight: 600;
  font-size: 15px;
  transition: all 0.3s ease;
  box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
}

.allUploaded-artworks .cta-button:hover {
  transform: translateY(-2px);
  box-shadow: 0 12px 30px rgba(102, 126, 234, 0.4);
}

@media (max-width: 768px) {
  .allUploaded-artworks .detail-title {
    font-size: 2.5rem;
  }

 .allUploaded-artworks .modal-content {
        width: 60%;
 }

    .allUploaded-artworks .modal-info {
        position: relative !important;
        padding: 20px;
    }
  .allUploaded-artworks .detail-description {
    font-size: 1rem;
  }

  .allUploaded-artworks .gallery-grid {
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 15px;
  }

  .allUploaded-artworks .features-list {
    grid-template-columns: 1fr;
  }

  .allUploaded-artworks .modal-title {
    font-size: 20px;
  }

.allUploaded-artworks .modal-subtitle {
        font-size: 16px;
        line-height: normal;
}
  .allUploaded-artworks .nav-button {
    width: 40px;
    height: 40px;
  }

  .allUploaded-artworks .services-section {
    padding: 40px 14px;
  }
  .allUploaded-artworks .service-card {
    padding: 20px;
  }
  .allUploaded-artworks .section-title {
    font-size: 36px;
  }

  .allUploaded-artworks .services-grid {
    grid-template-columns: 1fr;
  }
}

    </style>

@endsection

@section('content')


 <section class="allUploaded-artworks">
  <div class="detail-container">
    <div class="detail-header">
      <!-- <div class="breadcrumb">
        <a href="#">Home</a>
        <span>›</span>
        <a href="#">Services</a>
        <span>›</span>
        <span>Engine Diagnostics</span>
      </div> -->

      <h1 class="detail-title">Everything We Create, In One Place</h1>
      
      <p class="detail-description">
        All our services and creative work, thoughtfully crafted for you.
      </p>

     
    </div>

    <div class="section-divider"></div>

    <div class="gallery-section">
      <h2 class="section-title">
        All Artwork Gallery
      </h2>

      <div class="gallery-grid">
        @forelse($artworkPhotos as $index => $artwork)
          <div class="gallery-card" data-index="{{ $index }}">
            <img src="{{ $artwork->image_url }}" alt="Artwork {{ $index + 1 }}" onerror="this.src='https://via.placeholder.com/400x400?text=Image+Not+Found'">
          </div>
        @empty
          <div class="col-12 text-center py-5">
            <p class="text-muted" style="color: #9d8fb8; font-size: 1.2rem;">No artwork available yet.</p>
            @if(auth()->check() && auth()->user()->is_artist)
              <a href="{{ route('artist.portal') }}" class="btn btn-primary mt-3">Upload Artwork</a>
            @endif
          </div>
        @endforelse
      </div>
    </div>

    <div class="section-divider"></div>

       <div class="container">
        <div class="services-section">
            <div class="section-header">
                <h1 class="section-title">What We Offer</h1>
                <p class="section-subtitle">
                    Our comprehensive music distribution service includes a thorough examination of your artistic portfolio, 
                    royalty management systems, and all critical creative components. We use industry-specific platforms and 
                    analytics to ensure accurate tracking and precise audience identification.
                </p>
            </div>

            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 18V5l12-2v13M9 18c0 1.657-1.343 3-3 3s-3-1.343-3-3 1.343-3 3-3 3 1.343 3 3zm12-2c0 1.657-1.343 3-3 3s-3-1.343-3-3 1.343-3 3-3 3 1.343 3 3z"/>
                        </svg>
                    </div>
                    <h3 class="service-title">Music & Video Distribution</h3>
                    <p class="service-description">
                        Complete analysis and distribution of your music catalog across all major streaming platforms. 
                        Our system ensures optimal metadata configuration and maximum discoverability for your releases.
                    </p>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M12 6v6l4 2"/>
                            <path d="M16 8h3M16 16h3M8 8H5M8 16H5"/>
                        </svg>
                    </div>
                    <h3 class="service-title">Royalty Collection & Analytics</h3>
                    <p class="service-description">
                        Comprehensive royalty tracking service with detailed breakdowns of streaming revenue, mechanical 
                        royalties, and performance rights. Keep 80% of your earnings with complete transparency.
                    </p>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="18" height="18" rx="2"/>
                            <circle cx="8.5" cy="8.5" r="1.5"/>
                            <path d="M21 15l-5-5L5 21"/>
                        </svg>
                    </div>
                    <h3 class="service-title">Artwork & Visual Content</h3>
                    <p class="service-description">
                        Professional artwork upload and management system ensuring your visual identity meets platform 
                        specifications. High-resolution asset storage with instant deployment capabilities.
                    </p>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 3v18h18"/>
                            <path d="M18 17V9M13 17V5M8 17v-3"/>
                        </svg>
                    </div>
                    <h3 class="service-title">Artist Dashboard & Reporting</h3>
                    <p class="service-description">
                        Real-time monitoring of your music's performance with detailed analytics. Track listener demographics, 
                        geographic data, and engagement metrics across all distribution channels.
                    </p>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                            <path d="M2 12h20"/>
                        </svg>
                    </div>
                    <h3 class="service-title">Global Platform Integration</h3>
                    <p class="service-description">
                        Seamless distribution to Spotify, Apple Music, YouTube Music, TikTok, Amazon Music, and 150+ digital 
                        service providers worldwide. One upload reaches millions of potential listeners.
                    </p>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <h3 class="service-title">Support & Artist Networking</h3>
                    <p class="service-description">
                        Dedicated artist support team with industry expertise. Connect with fellow independent artists, 
                        collaborate on projects, and access exclusive networking opportunities and resources.
                    </p>
                </div>
            </div>

            <div class="highlight-box">
                <p class="highlight-text">
                    <strong>Industry-Leading Service:</strong> We utilize manufacturer-grade distribution tools and 
                    proprietary analytics systems to deliver accurate performance data and maximum revenue potential. 
                    Our artist-first approach ensures you maintain creative control while we handle the technical complexity.
                </p>
                <a href="/contact" class="cta-button">Start Your Journey Today</a>
            </div>
        </div>
    </div>
  </div>

  <div class="modal" id="modal">
    <div class="close-button" id="closeBtn"></div>
    <div class="nav-button prev" id="prevBtn"></div>
    <div class="nav-button next" id="nextBtn"></div>
    <div class="modal-content">
      <img class="modal-image" id="modalImage" src="" alt="">
      <div class="modal-info">
        <div class="modal-title" id="modalTitle"></div>
        <div class="modal-subtitle" id="modalSubtitle"></div>
      </div>
    </div>
  </div>
  </section>

  

@include('partials.frontend.newsletter')

      <script>
    const modal = document.getElementById('modal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalSubtitle = document.getElementById('modalSubtitle');
    const closeBtn = document.getElementById('closeBtn');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const galleryCards = document.querySelectorAll('.gallery-card');

    let currentIndex = 0;

    galleryCards.forEach((card, index) => {
      card.addEventListener('click', () => openModal(index));
    });

    function openModal(index) {
      currentIndex = index;
      updateModalContent();
      modal.classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    function closeModal() {
      modal.classList.remove('active');
      document.body.style.overflow = '';
    }

    function updateModalContent() {
      const currentCard = galleryCards[currentIndex];
      const img = currentCard.querySelector('img');

      modalImage.src = img.src;
      modalTitle.textContent = 'Artwork ' + (currentIndex + 1);
      modalSubtitle.textContent = '';
    }

    function showNext() {
      currentIndex = (currentIndex + 1) % galleryCards.length;
      updateModalContent();
    }

    function showPrev() {
      currentIndex = (currentIndex - 1 + galleryCards.length) % galleryCards.length;
      updateModalContent();
    }

    closeBtn.addEventListener('click', closeModal);
    prevBtn.addEventListener('click', showPrev);
    nextBtn.addEventListener('click', showNext);

    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        closeModal();
      }
    });

    document.addEventListener('keydown', (e) => {
      if (!modal.classList.contains('active')) return;
      
      if (e.key === 'Escape') {
        closeModal();
      } else if (e.key === 'ArrowLeft') {
        showPrev();
      } else if (e.key === 'ArrowRight') {
        showNext();
      }
    });
  </script>
@endsection
