@extends('layouts.app.master')

@section('title', 'Edit Ring')

@section('css')
@endsection

@section('content')
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-sm-6">
          <h3>Edit Ring</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ route('admin.dashboard') }}">
                <svg class="stroke-icon">
                  <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-home') }}"></use>
                </svg>
              </a>
            </li>
            <li class="breadcrumb-item">Rings</li>
            <li class="breadcrumb-item active">Edit Ring</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h5>Edit Ring Form</h5>
          </div>
          <div class="card-body">
            <form class="row g-3 common-form" method="POST" action="{{ route('admin.ring.update', $ring->id) }}">
              @csrf
              @method('PUT')

              <div class="col-md-12">
                <label class="form-label">Package Name</label>
                <input class="form-control" name="package_name" type="text" value="{{ old('package_name', $ring->package_name) }}" required>
              </div>

              <div id="subpackages-wrapper">
                @php
                  $names = json_decode($ring->sub_package_name, true) ?? [];
                  $prices = json_decode($ring->sub_package_price, true) ?? [];
                  $subtitles = json_decode($ring->sub_package_subtitle, true) ?? [];
                  $couples = json_decode($ring->sub_package_couples, true) ?? [];
                  $rings = json_decode($ring->sub_package_rings, true) ?? [];
                @endphp

                @foreach($names as $i => $name)
                <div class="subpackage-group border p-3 mb-3">
                  <div class="col-md-12">
                    <label class="form-label">Sub Package Name</label>
                    <input class="form-control" name="sub_package_name[]" type="text" value="{{ $name }}" required>
                  </div>
                  <div class="col-md-12">
                    <label class="form-label">Sub Package Price</label>
                    <input class="form-control" name="sub_package_price[]" type="text" value="{{ $prices[$i] ?? '' }}" required>
                  </div>
                  <div class="col-md-12">
                    <label class="form-label">Sub Package Subtitle</label>
                    <input class="form-control" name="sub_package_subtitle[]" type="text" value="{{ $subtitles[$i] ?? '' }}" required>
                  </div>
                  <div class="col-md-12">
                    <label class="form-label">Sub Package Couples</label>
                    <input class="form-control" name="sub_package_couples[]" type="text" value="{{ $couples[$i] ?? '' }}" required>
                  </div>
                  <div class="col-md-12">
                    <label class="form-label">Sub Package Rings</label>
                    <input class="form-control" name="sub_package_rings[]" type="text" value="{{ $rings[$i] ?? '' }}" required>
                  </div>
                  <hr>
                  <button type="button" class="btn btn-danger remove-subpackage">Remove Subpackage</button>
                </div>
                @endforeach
              </div>

              <button type="button" class="btn btn-primary" id="add-subpackage">Add More Package</button>

              <div class="col-md-6 mt-3">
                <button class="btn btn-primary f-w-500" type="submit">Update Ring</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const wrapper = document.getElementById('subpackages-wrapper');
    let subpackageIndex = wrapper.querySelectorAll('.subpackage-group').length;

    document.getElementById('add-subpackage').addEventListener('click', function () {
      const template = `
        <div class="subpackage-group border p-3 mb-3">
          <div class="col-md-12">
            <label class="form-label">Sub Package Name</label>
            <input class="form-control" name="sub_package_name[]" type="text" placeholder="Name" required>
          </div>
          <div class="col-md-12">
            <label class="form-label">Sub Package Price</label>
            <input class="form-control" name="sub_package_price[]" type="text" placeholder="Price" required>
          </div>
          <div class="col-md-12">
            <label class="form-label">Sub Package Subtitle</label>
            <input class="form-control" name="sub_package_subtitle[]" type="text" placeholder="Subtitle" required>
          </div>
          <div class="col-md-12">
            <label class="form-label">Sub Package Couples</label>
            <input class="form-control" name="sub_package_couples[]" type="text" placeholder="Couples" required>
          </div>
          <div class="col-md-12">
            <label class="form-label">Sub Package Rings</label>
            <input class="form-control" name="sub_package_rings[]" type="text" placeholder="Rings" required>
          </div>
          <hr>
          <button type="button" class="btn btn-danger remove-subpackage">Remove Subpackage</button>
        </div>
      `;
      wrapper.insertAdjacentHTML('beforeend', template);
      subpackageIndex++;
    });

    wrapper.addEventListener('click', function (e) {
      if (e.target.classList.contains('remove-subpackage')) {
        e.target.closest('.subpackage-group').remove();
      }
    });
  });
</script>
@endsection
