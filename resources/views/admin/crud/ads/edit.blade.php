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
                  <h3>Edit Ad</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">CMS</li>
                    <li class="breadcrumb-item active">Edit Ad</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Ad Form</h5>
                  </div>
                  <div class="card-body">
                    <div class="row g-xl-5 g-3">
                      <div class="col-xxl-3 col-xl-4 box-col-4e sidebar-left-wrapper">
                        <ul class="sidebar-left-icons nav nav-pills" id="add-product-pills-tab" role="tablist">
                          <li class="nav-item"> <a class="nav-link active" id="detail-product-tab" data-bs-toggle="pill" href="#detail-product" role="tab" aria-controls="detail-product" aria-selected="false">
                              <div class="nav-rounded">
                                <div class="product-icons">
                                  <svg class="stroke-icon">
                                    <use href="{{asset('AdminAssets/svg/icon-sprite.svg#product-detail')}}"></use>
                                  </svg>
                                </div>
                              </div>
                              <div class="product-tab-content">
                                <h6>Edit Ad Details</h6>
                                <p>Edit Ad name & details</p>
                              </div></a></li>

                        </ul>
                      </div>
                      <div class="col-xxl-9 col-xl-8 box-col-8 position-relative">
                        <div class="tab-content custom-input" id="add-product-pills-tabContent">
                          <div class="tab-pane fade show active" id="detail-product" role="tabpanel" aria-labelledby="detail-product-tab">
                            <div class="sidebar-body">
@php
  $isEdit = isset($ad);
@endphp

<form method="POST" action="{{ $isEdit ? route('admin.ads.update', $ad->id) : route('admin.ads.store') }}" enctype="multipart/form-data">
  @csrf
  @if ($isEdit)
    @method('PUT')
  @endif

  <div class="col-md-12">
    <label class="form-label" for="validationProductTitle">Ad Title</label>
    <input
      class="form-control"
      name="title"
      id="validationProductTitle"
      type="text"
      placeholder="Title"
      value="{{ old('title', $ad->title ?? '') }}"
    >
  </div>

  <div class="col-md-12">
    <label class="form-label">Ad Link</label>
    <input class="form-control" name="link" type="url" placeholder="https://example.com" value="{{ old('link', $ad->link ?? '') }}">
  </div>

  <div class="col-md-6">
    <label class="form-label">Ad File</label>
    @if($ad->file)
      <div class="mb-2">
        @php
          $extension = pathinfo($ad->file, PATHINFO_EXTENSION);
          $isVideo = in_array(strtolower($extension), ['mp4', 'avi', 'mov', 'webm']);
        @endphp
        @if($isVideo)
          <video width="200" height="120" controls style="border-radius: 5px;">
            <source src="{{ $ad->file_url }}" type="video/{{ $extension }}">
            Your browser does not support the video tag.
          </video>
        @else
          <img src="{{ $ad->file_url }}" alt="Current File" style="max-width: 200px; height: auto; border-radius: 5px;">
        @endif
        <p class="text-muted small">Current file</p>
      </div>
    @endif
    <input class="form-control" name="file" type="file" accept="image/*,video/*">
    <small class="text-muted">Leave empty to keep current file</small>
  </div>

  <!-- <div class="col-md-6">
    <label class="form-label">Visibility</label>
    <div class="form-check form-switch">
      <input class="form-check-input" type="checkbox" name="visibility" value="1" {{ old('visibility', $ad->visibility ?? false) ? 'checked' : '' }}>
      <label class="form-check-label" for="visibility">Make this ad visible</label>
    </div>
  </div> -->

  <div class="col-md-6">
    <button class="btn btn-primary f-w-500" type="submit">
      {{ $isEdit ? 'Update' : 'Submit' }}
    </button>
  </div>
</form>

                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>

                @endsection

@section('script')
@endsection
