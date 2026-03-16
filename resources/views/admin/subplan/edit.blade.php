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
          <h3>{{ isset($subplan) ? 'Edit' : 'Add' }} Subscription Plan</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
              <svg class="stroke-icon">
                <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
              </svg></a>
            </li>
            <li class="breadcrumb-item">Subscription Plan</li>
            <li class="breadcrumb-item active">{{ isset($subplan) ? 'Edit' : 'Add' }} Plan</li>
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
            <h5>Subscription Plan Form</h5>
          </div>
          <div class="card-body">
            <div class="row g-xl-5 g-3">
              <div class="col-xxl-3 col-xl-4 box-col-4e sidebar-left-wrapper">
                <ul class="sidebar-left-icons nav nav-pills" id="add-product-pills-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="detail-product-tab" data-bs-toggle="pill" href="#detail-product" role="tab">
                      <div class="nav-rounded">
                        <div class="product-icons">
                          <svg class="stroke-icon">
                            <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#product-detail') }}"></use>
                          </svg>
                        </div>
                      </div>
                      <div class="product-tab-content">
                        <h6>Plan Details</h6>
                        <p>Enter plan name, price, and duration</p>
                      </div>
                    </a>
                  </li>
                </ul>
              </div>

              <div class="col-xxl-9 col-xl-8 box-col-8 position-relative">
                <div class="tab-content custom-input" id="add-product-pills-tabContent">
                  <div class="tab-pane fade show active" id="detail-product" role="tabpanel">
                    <div class="sidebar-body">
                      @php $isEdit = isset($subplan); @endphp

                      <form method="POST" action="{{ $isEdit ? route('admin.subplan.update', $subplan->id) : route('admin.subplan.store') }}">
                        @csrf
                        @if ($isEdit)
                          @method('PUT')
                        @endif

                        <div class="mb-3">
                          <label class="form-label" for="title">Subscription Title</label>
                          <input
                            class="form-control"
                            name="title"
                            id="title"
                            type="text"
                            placeholder="Title"
                            value="{{ old('title', $subplan->title ?? '') }}"
                            required
                          >
                        </div>

                        <div class="mb-3">
                          <label class="form-label" for="amount">Subscription Amount</label>
                          <input
                            class="form-control"
                            name="amount"
                            id="amount"
                            type="number"
                            step="0.01"
                            placeholder="Amount (e.g. 29.99)"
                            value="{{ old('amount', $subplan->amount ?? '') }}"
                            required
                          >
                        </div>

                        <div class="mb-3">
                          <label class="form-label" for="duration">Subscription Duration</label>
                          <input
                            class="form-control"
                            name="duration"
                            id="duration"
                            type="text"
                            placeholder="Duration (e.g. Monthly, Yearly)"
                            value="{{ old('duration', $subplan->duration ?? '') }}"
                            required
                          >
                        </div>

                        <div class="mb-3">
                          <button class="btn btn-primary" type="submit">
                            {{ $isEdit ? 'Update Plan' : 'Create Plan' }}
                          </button>
                        </div>
                      </form>

                    </div>
                  </div>
                </div>
              </div>
            </div> <!-- row -->
          </div> <!-- card-body -->
        </div> <!-- card -->
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
@endsection
