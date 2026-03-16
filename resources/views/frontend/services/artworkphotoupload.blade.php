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
                                Media & Artwork Submission
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End of InnerBanner -->

        <section class="artWork">
            <div class="floating-elements">
                <div class="floating-shape"></div>
                <div class="floating-shape"></div>
                <div class="floating-shape"></div>
            </div>

            <div class="background-pattern"></div>

            <div class="container">
                <!-- <div class="header">
                    <h1>Artwork & Photo Upload</h1>
                    <p>Upload your album artwork, promotional photos, and graphics, so your visual identity shines just
                        as brightly as your music.</p>
                </div>

                <div class="upload-area" id="uploadArea">
                    <div class="upload-icon">📁</div>
                    <div class="upload-text">Drag & drop your files here or</div>
                    <div class="upload-subtext">Support for multiple files</div>
                    <input type="file" id="fileInput" accept="image/*" multiple style="display: none;" />
                    <button type="button" class="browse-btn" onclick="document.getElementById('fileInput').click();">
                        Browse Files
                    </button>

                    <div class="preview-gallery" id="previewGallery"></div>
                </div> -->

                <div class="guidelines-section">
                    <h2 class="guidelines-title">Upload Guidelines</h2>

                    <div class="guidelines-grid">
                      
@foreach($artworkphotos as $artworkphoto)
                        <div class="guideline-item">
                            <div class="guideline-icon">{!! $artworkphoto->icon !!}</div>
                            <div class="guideline-content">
                                <h4>{{ $artworkphoto->title }}</h4>
                                <p>{!! $artworkphoto->description !!}
                                </p>
                            </div>
                        </div>
@endforeach
                  
                    </div>
                    <div class="upload-stats">
                        <div class="stat-item">
                            <div class="stat-number">5MB</div>
                            <div class="stat-label">Max File Size</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">1000px</div>
                            <div class="stat-label">Min Resolution</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">Multiple</div>
                            <div class="stat-label">File Upload</div>
                        </div>
                    </div>
                    <div class="cta">
                        <a href="/artist/artisit-portal">
                            <button>Explore More</button>
                        </a>
                    </div>
                </div>


            </div>
        </section>


        @include('partials.frontend.newsletter')



@endsection
