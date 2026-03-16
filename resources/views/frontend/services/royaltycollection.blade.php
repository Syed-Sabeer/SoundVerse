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
                                Royalty Collection
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End of InnerBanner -->

        <!-- secRoyalty -->

        <section class="secRoyalties">
            <div class="floating-elements">
                <div class="floating-circle"></div>
                <div class="floating-circle"></div>
                <div class="floating-circle"></div>
            </div>

            <div class="background-pattern"></div>

            <div class="container">
                <div class="header">
                    <h1>Royalty Management</h1>
                    <p>Maximize your earnings with comprehensive royalty collection services. Track, collect, and
                        distribute your
                        music royalties from all platforms worldwide.</p>
                </div>

                <div class="cards-grid">
                  
                    @foreach($royalty_collections as $royalty_collection)
                    <div class="card" style="animation-delay: 0.2s;">
                        <div class="card-icon">
                            {!! $royalty_collection->icon !!}
                        </div>
                        <h3 class="card-title">{{ $royalty_collection->title }}</h3>
                        <p class="card-description">{!! $royalty_collection->description !!}</p>
                        <ul class="features-list">
                        @foreach(json_decode($royalty_collection->include, true) as $include)
    <li>{{ $include }}</li>
@endforeach


                        </ul>
                        <a href="{{ $royalty_collection->button_link }}">
                        <button class="cta-button">Setup Collection</button>
                        </a>
                    </div>

                    @endforeach
                </div>

                <div class="stats-section">
                    <div class="stat-card">
                        <div class="stat-number">{{ $royalty_collections_cms->value }} </div>
                        <div class="stat-label">{{ $royalty_collections_cms->title }}</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">{{ $royalty_collections_cms->value2 }}</div>
                        <div class="stat-label">{{ $royalty_collections_cms->title2 }}</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">{{ $royalty_collections_cms->value3 }}</div>
                        <div class="stat-label">{{ $royalty_collections_cms->title3 }}</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">{{ $royalty_collections_cms->value4 }}</div>
                        <div class="stat-label">{{ $royalty_collections_cms->title4 }}</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- secRoyalty -->

        @include('partials.frontend.newsletter')

@endsection


@section('script')
<script>
         // Add smooth scroll animations for elements entering viewport
    const observerOptions  = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }
      });
    }, observerOptions);

    // Observe all cards
    document.querySelectorAll('.card').forEach(card => {
      observer.observe(card);
    });

    // Add interactive hover effects
    document.querySelectorAll('.card').forEach(card => {
      card.addEventListener('mouseenter', () => {
        card.style.transform = 'translateY(-10px) scale(1.02)';
      });

      card.addEventListener('mouseleave', () => {
        card.style.transform = 'translateY(0) scale(1)';
      });
    });

    // Button click animations
    document.querySelectorAll('.cta-button').forEach(button => {
      button.addEventListener('click', (e) => {
        // Create ripple effect
        const ripple = document.createElement('span');
        const rect = button.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;

        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = x + 'px';
        ripple.style.top = y + 'px';
        ripple.style.position = 'absolute';
        ripple.style.borderRadius = '50%';
        ripple.style.background = 'rgba(255, 255, 255, 0.3)';
        ripple.style.transform = 'scale(0)';
        ripple.style.animation = 'ripple 0.6s linear';
        ripple.style.pointerEvents = 'none';

        button.appendChild(ripple);

        setTimeout(() => {
          ripple.remove();
        }, 600);
      });
    });

    // Add CSS for ripple animation
    const style = document.createElement('style');
    style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
    document.head.appendChild(style);

    // Parallax effect for floating elements
    document.addEventListener('mousemove', (e) => {
      const mouseX = e.clientX / window.innerWidth;
      const mouseY = e.clientY / window.innerHeight;

      document.querySelectorAll('.floating-circle').forEach((circle, index) => {
        const speed = (index + 1) * 0.5;
        const x = (mouseX - 0.5) * speed * 20;
        const y = (mouseY - 0.5) * speed * 20;

        circle.style.transform = `translate(${x}px, ${y}px)`;
      });
    });

    // Counter animation for stats
    const animateCounter = (element, target) => {
      let current = 0;
      const increment = target / 50;
      const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
          current = target;
          clearInterval(timer);
        }

        if (target >= 1000000) {
          element.textContent = (current / 1000000).toFixed(1) + 'M+';
        } else if (target >= 1000) {
          element.textContent = (current / 1000).toFixed(0) + 'K+';
        } else if (target < 100) {
          element.textContent = current.toFixed(1) + '%';
        } else {
          element.textContent = Math.floor(current) + '+';
        }
      }, 50);
    };

    // Trigger counter animations when stats come into view
    const statsObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const numberElement = entry.target.querySelector('.stat-number');
          const text = numberElement.textContent;
          let target;

          if (text.includes('M+')) {
            target = parseFloat(text) * 1000000;
          } else if (text.includes('K+')) {
            target = parseFloat(text) * 1000;
          } else if (text.includes('%')) {
            target = parseFloat(text);
          } else {
            target = parseInt(text);
          }

          animateCounter(numberElement, target);
          statsObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.5 });

    document.querySelectorAll('.stat-card').forEach(card => {
      statsObserver.observe(card);
    });
    </script>
@endsection