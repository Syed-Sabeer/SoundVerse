@extends('layouts.app.master')

@section('title', 'Add Support Networking Service')

@section('css')
@endsection

@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Add Support Networking Service</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-home') }}"></use>
                            </svg></a></li>
                        <li class="breadcrumb-item">CMS</li>
                        <li class="breadcrumb-item active">Add Support Networking Service</li>
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
                        <h5>Service Form</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-xl-5 g-3">
                            <div class="col-xxl-3 col-xl-4 box-col-4e sidebar-left-wrapper">
                                <ul class="sidebar-left-icons nav nav-pills" id="add-product-pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="detail-product-tab" data-bs-toggle="pill" href="#detail-product" role="tab" aria-controls="detail-product" aria-selected="false">
                                            <div class="nav-rounded">
                                                <div class="product-icons">
                                                    <svg class="stroke-icon">
                                                        <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#product-detail') }}"></use>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="product-tab-content">
                                                <h6>Add Service Details</h6>
                                                <p>Add service name & details</p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xxl-9 col-xl-8 box-col-8 position-relative">
                                <div class="tab-content custom-input" id="add-product-pills-tabContent">
                                    <div class="tab-pane fade show active" id="detail-product" role="tabpanel" aria-labelledby="detail-product-tab">
                                        <div class="sidebar-body">
                                            <form class="row g-3 common-form" method="POST" action="{{ route('admin.service.supportnetworking.store') }}">
                                                @csrf
                                                <div class="col-md-12">
                                                    <label class="form-label" for="validationServiceTitle">Service Title</label>
                                                    <input class="form-control" name="title" id="validationServiceTitle" type="text" placeholder="Service Title" value="{{ old('title') }}" required>
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="form-label" for="validationServiceDescription">Service Description</label>
                                                    <textarea id="service_description" name="description" class="form-control" rows="6" placeholder="Service Description" required>{{ old('description') }}</textarea>
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
</div>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.9.2/ckeditor.js" integrity="sha512-OF6VwfoBrM/wE3gt0I/lTh1ElROdq3etwAquhEm2YI45Um4ird+0ZFX1IwuBDBRufdXBuYoBb0mqXrmUA2VnOA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // CKEditor
    CKEDITOR.replace('service_description', {
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
</script>
@endsection

