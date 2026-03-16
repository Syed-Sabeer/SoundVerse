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
                  <h3>Add Ring</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Rings</li>
                    <li class="breadcrumb-item active">Add Rings</li>
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
                    <h5>Product Form</h5>
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
                                <h6>Add Ring Details</h6>
                                <p>Add Ring name & details</p>
                              </div></a></li>




                        </ul>
                      </div>
                      <div class="col-xxl-9 col-xl-8 box-col-8 position-relative">
                        <div class="tab-content custom-input" id="add-product-pills-tabContent">
                          <div class="tab-pane fade show active" id="detail-product" role="tabpanel" aria-labelledby="detail-product-tab">
                            <div class="sidebar-body">
                              <form class="row g-3 common-form" method="POST" action="{{ route('admin.ring.store') }}" >
                                @csrf
                                <div class="col-md-12">
                                  <label class="form-label" for="validationProductTitle">Package Name</label>
                                  <input class="form-control" name="package_name" type="text" placeholder="Package Name" value="{{ old('package_name') }}" required>

                                </div>
                             <div id="subpackages-wrapper">
  <div class="subpackage-group border p-3 mb-3">
<div class="col-md-12">
  <label class="form-label">Sub Package Name</label>
  <input class="form-control" name="sub_package_name[]" type="text" placeholder="Name" value="{{ old('sub_package_name') }}" required>
</div>
<div class="col-md-12">
  <label class="form-label">Sub Package Price</label>
  <input class="form-control" name="sub_package_price[]" type="text" placeholder="Price" value="{{ old('sub_package_price') }}" required>
</div>
<div class="col-md-12">
  <label class="form-label">Sub Package Subtitle</label>
  <input class="form-control" name="sub_package_subtitle[]" type="text" placeholder="Subtitle" value="{{ old('sub_package_subtitle') }}" required>
</div>
<div class="col-md-12">
  <label class="form-label">Sub Package Couples</label>
  <input class="form-control" name="sub_package_couples[]" type="text" placeholder="Couples" value="{{ old('sub_package_couples') }}" required>
</div>
<div class="col-md-12">
  <label class="form-label">Sub Package Rings</label>
  <input class="form-control" name="sub_package_rings[]" type="text" placeholder="Rings" value="{{ old('sub_package_rings') }}" required>
</div> required

  
    <hr>
    <button type="button" class="btn btn-danger remove-subpackage">Remove Subpackage</button>
  </div>
</div>
<button type="button" class="btn btn-primary" id="add-subpackage">Add More Package</button>

                         


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


    let subpackageIndex = 1;

    // Add Subpackage
    document.getElementById('add-subpackage').addEventListener('click', function () {
      const wrapper = document.getElementById('subpackages-wrapper');

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
            <label class="form-label">Sub Package Subtitles</label>
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

    // Add/Remove Include in dynamic subpackage
    document.getElementById('subpackages-wrapper').addEventListener('click', function (e) {
  



      if (e.target.classList.contains('remove-subpackage')) {
        e.target.closest('.subpackage-group').remove();
      }
    });
  });
</script>

@endsection
