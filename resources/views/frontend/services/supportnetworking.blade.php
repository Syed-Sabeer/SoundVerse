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
                                Growth Support & Artist Networking
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End of InnerBanner -->

        <section class="support_networking">
            <div class="container">
                <!-- Hero Section -->
                <div class="hero">
                    <h2>Support & <span class="un_Span">Networking</span></h2>
                    <p>Get support from our dedicated team and connect with other artists through our community portal.
                        We're here to help you grow, collaborate, and succeed.</p>
                </div>

                <!-- Support Options -->
                <div class="grid">
                 
                    @foreach($supportnetworkings as $supportnetworking)
                    <div class="card">
                        <h3>{{ $supportnetworking->title }}</h3>
                        <p>{!! $supportnetworking->description !!}
                           </p>
                    </div>
                    @endforeach
                </div>

                <!-- Testimonials -->
                <div class="testimonials pt-5">
                    <h3><span class="un_Span">What Artists</span> Are Saying</h3>
                    <div class="quote">“The support I received during my album release was amazing — it felt like I had
                        a real team behind me.”</div>
                    <div class="quote">“I connected with a producer in the community forum who helped take my music to
                        the next level!”</div>
                </div>
            </div>
        </section>


        @include('partials.frontend.newsletter')

@endsection
