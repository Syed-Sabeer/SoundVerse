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
                                Blog Detail
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End of InnerBanner -->

        <!-- blog-detail -->
        <section class="blog-detail">
                <div class="container">
            <div class="blog-hero mt-4">
            <img src="{{asset('storage/'.$blog->image)}}" alt="Musician with guitar on stage">
            <h1>{{$blog->title}}</h1>
            <div class="blog-meta">Published on {{ $blog->created_at->format('F d, Y') }}
            · by Team SingWithMe</div>
            </div>

            <div class="blog-content">
            {!! $blog->content !!}
         
            <a class="back-link" href="{{route('home')}}">← Back to Home</a>
            </div>
                </div>
        </section>
        <!-- blog-detail -->

@endsection
