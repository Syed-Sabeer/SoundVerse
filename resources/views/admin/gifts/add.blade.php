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
                  <h3>Add Gift</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">CMS</li>
                    <li class="breadcrumb-item active">Add Gift</li>
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
                    <h5>Gift Form</h5>
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
                                <h6>Add Gift Details</h6>
                                <p>Add Gift name & details</p>
                              </div></a></li>




                        </ul>
                      </div>
                      <div class="col-xxl-9 col-xl-8 box-col-8 position-relative">
                        <div class="tab-content custom-input" id="add-product-pills-tabContent">
                          <div class="tab-pane fade show active" id="detail-product" role="tabpanel" aria-labelledby="detail-product-tab">
                            <div class="sidebar-body">
                              <form class="row g-3 common-form" method="POST" action="{{ route('admin.gift.store') }}" >
                                @csrf
                                <div class="col-md-12">
                                  <label class="form-label" for="validationProductTitle">Gift Icon</label>
                                  <input class="form-control" name="icon" id="validationProductTitle" type="text" placeholder="Gift Icon" value="{{ old('icon') }}">
                                </div>
                                <div class="col-md-12">
                                  <label class="form-label" for="validationProductTitle">Gift Title</label>
                                  <input class="form-control" name="title" id="validationProductTitle" type="text" placeholder="Gift Title" value="{{ old('title') }}">
                                </div>
                                <div class="col-md-12">
                                  <label class="form-label" for="validationProductTitle">Gift Rings</label>
                                  <input class="form-control" name="rings_count" id="validationProductTitle" type="text" placeholder="Gift Rings" value="{{ old('rings_count') }}">
                                </div>
                                 <div class="col-md-12">
                                  <label class="form-label" for="validationProductTitle">Gift Couples Connected</label>
                                  <input class="form-control" name="couples_connected" id="validationProductTitle" type="text" placeholder="Gift Couples Connected" value="{{ old('couples_connected') }}">
                                </div>
                                <div class="col-md-12">
                                  <label class="form-label" for="validationProductTitle">Price</label>
                                  <input class="form-control" name="price" id="validationProductTitle" type="text" placeholder="Price" value="{{ old('price') }}">
                                </div>
                                <div class="col-md-12">
  <label class="form-label">Includes</label>
  <div id="includes-wrapper">
    <div class="input-group mb-2">
      <input type="text" name="includes[]" class="form-control" placeholder="Enter included item">
      <button type="button" class="btn btn-danger remove-include">Remove</button>
    </div>
  </div>
  <button type="button" class="btn btn-success" id="add-include">Add More</button>
</div>




<div class="col-md-12">
    <label class="form-label">Gift Description</label>
    <textarea id="gift_description" name="description" class="form-control" rows="6">{{ old('description') }}</textarea>
</div>
<div class="col-md-6 ">
<button class="btn btn-primary f-w-500" type="submit">Submit</button>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.9.2/ckeditor.js" integrity="sha512-OF6VwfoBrM/wE3gt0I/lTh1ElROdq3etwAquhEm2YI45Um4ird+0ZFX1IwuBDBRufdXBuYoBb0mqXrmUA2VnOA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // CKEditor (already provided)
    CKEDITOR.replace('gift_description', {
      toolbar: [
        { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
        { name: 'paragraph', items: ['NumberedList', 'BulletedList'] },
        { name: 'styles', items: ['Format', 'FontSize'] },
        { name: 'links', items: ['Link', 'Unlink'] }
      ],
      removePlugins: 'elementspath',
      resize_enabled: false
    });

    // Add more includes
    const addIncludeBtn = document.getElementById('add-include');
    const includesWrapper = document.getElementById('includes-wrapper');

    addIncludeBtn.addEventListener('click', function () {
      const newInputGroup = document.createElement('div');
      newInputGroup.classList.add('input-group', 'mb-2');
      newInputGroup.innerHTML = `
        <input type="text" name="includes[]" class="form-control" placeholder="Enter included item">
        <button type="button" class="btn btn-danger remove-include">Remove</button>
      `;
      includesWrapper.appendChild(newInputGroup);
    });

    // Remove include field
    includesWrapper.addEventListener('click', function (e) {
      if (e.target && e.target.classList.contains('remove-include')) {
        e.target.parentElement.remove();
      }
    });
  });
</script>
@endsection
