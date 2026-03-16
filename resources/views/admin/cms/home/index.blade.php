@extends('layouts.app.master')

@section('title', 'Dashboard')

@section('css')
@endsection

@section('content')

     <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Website Sections Management</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">CMS</li>
                    <li class="breadcrumb-item active">Website Sections</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Update All Website Sections</h5>
                  </div>
                  <div class="card-body add-post">
                    <form class="row g-3" method="POST" action="{{ route('admin.website.sections.update') }}" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')

                      <!-- Hero Section -->
                      <div class="col-sm-12">
                        <h3>Hero Section</h3>
                        <div class="mb-3 mt-3">
                          <label for="heading">Heading:</label>
                          <input class="form-control" id="heading" name="heading" type="text" value="{{ old('heading', $hero->heading ?? '') }}" placeholder="Hero Heading">
                        </div>
                       
                        <div class="col-12 mt-3">
                          <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="4" 
                                      placeholder="Enter Description">{{ old('description', $hero->description ?? '') }}</textarea>
                          </div>
                        </div>

                        <div class="mb-3 mt-3">
                          <label for="button_link">Button Link:</label>
                          <input class="form-control" id="button_link" name="button_link" type="text" value="{{ old('button_link', $hero->button_link ?? '') }}" placeholder="Button Link">
                        </div>

                        <div class="mb-3 mt-3">
                          <label for="bg_image">Background Image:</label>
                          <input class="form-control" id="bg_image" name="bg_image" type="file" accept="image/*">
                          @if (!empty($hero->bg_image))
                            <div class="mt-2"><img src="{{ asset($hero->bg_image) }}" alt="Current Background Image" style="max-width: 200px;"></div>
                          @endif
                        </div>

                        <div class="mb-3 mt-3">
                          <label for="song_image">Song Image:</label>
                          <input class="form-control" id="song_image" name="song_image" type="file" accept="image/*">
                          @if (!empty($hero->song_image))
                            <div class="mt-2"><img src="{{ asset($hero->song_image) }}" alt="Current Song Image" style="max-width: 200px;"></div>
                          @endif
                        </div>

                        <div class="mb-3 mt-3">
                          <label for="song_name">Song Name:</label>
                          <input class="form-control" id="song_name" name="song_name" type="text" value="{{ old('song_name', $hero->song_name ?? '') }}" placeholder="Song Name">
                        </div>

                        <div class="mb-3 mt-3">
                          <label for="song_album">Song Album:</label>
                          <input class="form-control" id="song_album" name="song_album" type="text" value="{{ old('song_album', $hero->song_album ?? '') }}" placeholder="Song Album">
                        </div>

                        <div class="mb-3 mt-3">
                          <label for="song">Song File:</label>
                          <input class="form-control" id="song" name="song" type="file" accept="audio/*">
                          @if (!empty($hero->song))
                            <div class="mt-2">
                              <small class="text-muted">Current song:</small>
                              <audio controls style="max-width: 300px;">
                                <source src="{{ asset($hero->song) }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                              </audio>
                            </div>
                          @endif
                        </div>

                        <div class="row">
                          <div class="col-lg-3">
                            <div class="mb-3 mt-3">
                              <label for="pc_image_1">Popular Corner Image 1:</label>
                              <input class="form-control" id="pc_image_1" name="pc_image_1" type="file" accept="image/*">
                              @if (!empty($hero->pc_image_1))
                                <div class="mt-2"><img src="{{ asset($hero->pc_image_1) }}" alt="Popular Corner Image 1" style="max-width: 150px;"></div>
                              @endif
                            </div>
                          </div>
                          <div class="col-lg-3">
                            <div class="mb-3 mt-3">
                              <label for="pc_image_2">Popular Corner Image 2:</label>
                              <input class="form-control" id="pc_image_2" name="pc_image_2" type="file" accept="image/*">
                              @if (!empty($hero->pc_image_2))
                                <div class="mt-2"><img src="{{ asset($hero->pc_image_2) }}" alt="Popular Corner Image 2" style="max-width: 150px;"></div>
                              @endif
                            </div>
                          </div>
                          <div class="col-lg-3">
                            <div class="mb-3 mt-3">
                              <label for="pc_image_3">Popular Corner Image 3:</label>
                              <input class="form-control" id="pc_image_3" name="pc_image_3" type="file" accept="image/*">
                              @if (!empty($hero->pc_image_3))
                                <div class="mt-2"><img src="{{ asset($hero->pc_image_3) }}" alt="Popular Corner Image 3" style="max-width: 150px;"></div>
                              @endif
                            </div>
                          </div>
                          <div class="col-lg-3">
                            <div class="mb-3 mt-3">
                              <label for="pc_image_4">Popular Corner Image 4:</label>
                              <input class="form-control" id="pc_image_4" name="pc_image_4" type="file" accept="image/*">
                              @if (!empty($hero->pc_image_4))
                                <div class="mt-2"><img src="{{ asset($hero->pc_image_4) }}" alt="Popular Corner Image 4" style="max-width: 150px;"></div>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>

          

        

         

                      <div class="common-flex justify-content-end mt-3">
                        <button class="btn btn-primary" type="submit">Update All Sections</button>
                        <input class="btn btn-secondary" type="reset" value="Discard">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.9.2/ckeditor.js" integrity="sha512-OF6VwfoBrM/wE3gt0I/lTh1ElROdq3etwAquhEm2YI45Um4ird+0ZFX1IwuBDBRufdXBuYoBb0mqXrmUA2VnOA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.ckeditor').forEach(function (el) {
      CKEDITOR.replace(el, {
        toolbar: [
          { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
          { name: 'paragraph', items: ['NumberedList', 'BulletedList'] },
          { name: 'styles', items: ['Format', 'FontSize'] },
          { name: 'links', items: ['Link', 'Unlink'] }
        ],
        removePlugins: 'elementspath',
        resize_enabled: false
      });
    });
  });
</script>
@endsection

