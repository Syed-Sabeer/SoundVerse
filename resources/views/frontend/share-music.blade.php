@extends('layouts.frontend.master')


@section('css')
@endsection

@section('content')

      <!-- Start of InnerBanner -->
      <section class="inner-banner contact-banner">
            <div class="contact_child">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="h1-title wow fadeup-animation" data-wow-duration="0.8s" data-wow-delay="0.2s">
                                Share Your Music
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End of InnerBanner -->


        <div class="parent-features">
            <div class="features_heading">
              
                    <h2>{{$shareyourmusic->title}}</h2>
                    <p>{{$shareyourmusic->description}}</p>
            </div>
            <div class="swiper brand-slider mt-5">
                <div class="swiper-wrapper">
               
                @foreach ($socialShareMusic as $socialShareMusic)
                    <div class="swiper-slide">
                        <div class="brand-inner">
                            <h3>{{$socialShareMusic->title}}</h3>
                            <a href="{{$socialShareMusic->link}}" class="share_btn">Share Now<lord-icon src="https://cdn.lordicon.com/jjqwsavk.json"
                                    trigger="loop" colors="primary:#6c16c7,secondary:#8930e8">
                                </lord-icon></a>
                            <img src="{{ asset('storage/' . $socialShareMusic->image) }}" alt="" style="border-radius: 12px;">
                        </div>
                    </div>
            @endforeach              
                </div>
            </div>
        </div>


        <div class="music-release-section">
        <div class="container">
            <div class="floating-particles" id="particles"></div>
            
            <div class="main-content">
                <div class="left-section">
                    <h1 class="main-title">{{$shareyourmusic->heading2}}</h1>
                    <p class="subtitle">
                        {{$shareyourmusic->description2}}
                    </p>
                    <!-- <button class="cta-button glow-on-hover" onclick="handleRelease()">
                        <span class="music-icon">🎵</span>
                        Release Your Music
                    </button> -->
                    <a href="/artist/artisit-portal" class="sec-btn" title="view more">Release Your Music</a>
                </div>

                <div class="right-section">
                    <div class="features-list">
                        <div class="feature-item" onclick="animateFeature(this)">
                            <div class="feature-number">1</div>
                            <div class="feature-content">
                                <h3>{{$shareyourmusic->step1_title}}</h3>
                                <p>
                                    {{$shareyourmusic->step1_description}}
                                </p>
                            </div>
                        </div>

                        <div class="feature-item" onclick="animateFeature(this)">
                            <div class="feature-number">2</div>
                            <div class="feature-content">
                                <h3>{{$shareyourmusic->step2_title}}</h3>
                                <p>{{$shareyourmusic->step2_description}}</p>
                            </div>
                        </div>

                        <div class="feature-item" onclick="animateFeature(this)">
                            <div class="feature-number">3</div>
                            <div class="feature-content">
                                <h3>{{$shareyourmusic->step3_title}}</h3>
                                <p>{{$shareyourmusic->step3_description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
<script src="https://cdn.lordicon.com/lordicon.js"></script>
<script>
        // Create floating particles
        function createParticles() {
            const particlesContainer = document.querySelector('.music-release-section #particles');
            const particleCount = 20;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                
                // Random positioning
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                
                // Random animation delay
                particle.style.animationDelay = Math.random() * 6 + 's';
                
                // Random animation duration
                particle.style.animationDuration = (Math.random() * 4 + 4) + 's';
                
                particlesContainer.appendChild(particle);
            }
        }

        // Handle release button click
        function handleRelease() {
            const button = document.querySelector('.music-release-section .cta-button');
            button.style.transform = 'scale(0.95)';
            
            setTimeout(() => {
                button.style.transform = 'translateY(-2px)';
                // Add some visual feedback
                showNotification('🎉 Ready to start your music journey!');
            }, 150);
        }

        // Animate feature items on click
        function animateFeature(element) {
            element.style.transform = 'scale(0.98)';
            
            setTimeout(() => {
                element.style.transform = 'translateY(-5px)';
                
                // Add a subtle shake animation to the number
                const number = element.querySelector('.feature-number');
                number.style.animation = 'music-pulse 0.6s ease-in-out';
                
                setTimeout(() => {
                    number.style.animation = '';
                }, 600);
            }, 100);
        }

        // Show notification
        function showNotification(message) {
            const notification = document.createElement('div');
            notification.textContent = message;
            notification.style.cssText = `
                position: fixed;
                top: 30px;
                right: 30px;
                background: linear-gradient(135deg, #6c5ce7 0%, #a29bfe 100%);
                color: white;
                padding: 15px 25px;
                border-radius: 50px;
                font-weight: 600;
                box-shadow: 0 10px 30px rgba(108, 92, 231, 0.4);
                z-index: 1000;
                transform: translateX(400px);
                transition: transform 0.5s ease;
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);
            
            setTimeout(() => {
                notification.style.transform = 'translateX(400px)';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 500);
            }, 3000);
        }

        // Add scroll-triggered animations
        function handleScroll() {
            const elements = document.querySelectorAll('.music-release-section .feature-item');
            elements.forEach((element, index) => {
                const rect = element.getBoundingClientRect();
                const isVisible = rect.top < window.innerHeight * 0.8;
                
                if (isVisible) {
                    element.style.animationDelay = (index * 0.2) + 's';
                    element.classList.add('fade-in');
                }
            });
        }

        // Add mouse movement effect
        function handleMouseMove(e) {
            const particles = document.querySelectorAll('.music-release-section .particle');
            const mouseX = e.clientX / window.innerWidth;
            const mouseY = e.clientY / window.innerHeight;
            
            particles.forEach((particle, index) => {
                const speed = (index % 3 + 1) * 0.5;
                const x = (mouseX - 0.5) * speed;
                const y = (mouseY - 0.5) * speed;
                
                particle.style.transform = `translate(${x}px, ${y}px)`;
            });
        }

        // Initialize everything
        document.addEventListener('DOMContentLoaded', () => {
            createParticles();
            
            // Add event listeners
            window.addEventListener('scroll', handleScroll);
            document.addEventListener('mousemove', handleMouseMove);
            
            // Initial scroll check
            handleScroll();
        });
    </script>

@endsection