@extends('layouts.app.master')

@section('title', 'Add Customer')

@section('css')
@endsection

@section('content')

<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Add Customer</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Customers</li>
                    <li class="breadcrumb-item active">Add Customer</li>
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
                    <h5>Customer Form</h5>
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
                                <h6>Add Customer Details</h6>
                                <p>Add customer information</p>
                              </div></a></li>

                        </ul>
                      </div>
                      <div class="col-xxl-9 col-xl-8 box-col-8 position-relative">
                        <div class="tab-content custom-input" id="add-product-pills-tabContent">
                          <div class="tab-pane fade show active" id="detail-product" role="tabpanel" aria-labelledby="detail-product-tab">
                            <div class="sidebar-body">
                              <form class="row g-3 common-form" method="POST" action="{{ route('admin.customer.store') }}">
                                @csrf
                                
                                <div class="col-md-6">
                                  <label class="form-label" for="name">Full Name</label>
                                  <input class="form-control" name="name" id="name" type="text" placeholder="Enter full name" value="{{ old('name') }}" required>
                                </div>

                                <div class="col-md-6">
                                  <label class="form-label" for="email">Email Address</label>
                                  <input class="form-control" name="email" id="email" type="email" placeholder="Enter email address" value="{{ old('email') }}" required>
                                </div>

                                <div class="col-md-6">
                                  <label class="form-label" for="password">Password</label>
                                  <input class="form-control" name="password" id="password" type="password" placeholder="Enter password" required>
                                </div>

                                <div class="col-md-6">
                                  <label class="form-label" for="phone">Phone Number</label>
                                  <input class="form-control" name="phone" id="phone" type="text" placeholder="Enter phone number" value="{{ old('phone') }}">
                                </div>

                                <div class="col-md-12">
                                  <label class="form-label" for="address">Address</label>
                                  <textarea class="form-control" name="address" id="address" rows="3" placeholder="Enter address">{{ old('address') }}</textarea>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                      Active Status
                                    </label>
                                  </div>
                                </div>

                                <div class="col-md-6">
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
@endsection



