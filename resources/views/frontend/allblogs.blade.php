@extends('layouts.frontend.master')


@section('css')
@endsection

@section('content')


       <!-- Start of Main Banner -->
       <section class="hero_about">
            <div class="about-child">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Our Inspiring Blogs</h2>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <!-- End of Main Banner -->

       
  
         <!-- blog-section -->

            <section class="secArtist_portal_blog py-5">
            <div class="container">
                <!-- Blog Section Hero -->
                <div class="hero text-center mb-5">
                <h2>Discover Music Insights on  <span class="un_Span">Our Blog</span></h2>
                <p>Explore industry tips, artist stories, and expert guidance to help you grow your music career. Learn from those who’ve been where you are now.</p>
                </div>

                <!-- Blog Cards Grid -->
                <div class="blog-grid">
                <!-- Blog Post 1 -->
                <div class="blog-card wow fadeup-animation" data-wow-duration="0.8s"
                                    data-wow-delay="0.2s">
                    <img src="/public/FrontendAssets/images/slim-emcee.jpg" alt="Blog Post" class="blog-img" />
                    <div class="blog-content">
                    <h3>How to Upload & Distribute Your Music Like a Pro</h3>
                    <p>Step-by-step guide to getting your tracks on Spotify, Apple Music, and more — without the headaches.</p>
                    <a href="/blog1.html" class="read-more">Read More →</a>
                    </div>
                </div>

                <!-- Blog Post 2 -->
                <div class="blog-card wow fadeup-animation" data-wow-duration="0.8s"
                                    data-wow-delay="0.2s">
                    <img src="/public/FrontendAssets/images/ricardo-nunes.jpg" alt="Blog Post" class="blog-img" />
                    <div class="blog-content">
                    <h3>Understanding Royalties in the Streaming Era</h3>
                    <p>Learn how music royalties work and how you can track your income with full transparency.</p>
                    <a href="/blog2.html" class="read-more">Read More →</a>
                    </div>
                </div>

                <!-- Blog Post 3 -->
                <div class="blog-card wow fadeup-animation" data-wow-duration="0.8s"
                                    data-wow-delay="0.2s">
                    <img src="/public/FrontendAssets/images/vidar-nordli-mathisen.jpg" alt="Blog Post" class="blog-img" />
                    <div class="blog-content">
                    <h3>Managing Your Artist Brand & Identity</h3>
                    <p>Your visuals, profile, and online presence matter. Here’s how to stand out in a crowded industry.</p>
                    <a href="/blog-detail.html" class="read-more">Read More →</a>
                    </div>
                </div>
                </div>

                <!-- CTA -->
                <!-- <div class="cta text-center mt-5">
                <a href="#" class="sec-btn" title="view more">view more</a>
                </div> -->
            </div>
            </section>

        <!-- blog-section -->
       

     
    @include('partials.frontend.newsletter')


@endsection
