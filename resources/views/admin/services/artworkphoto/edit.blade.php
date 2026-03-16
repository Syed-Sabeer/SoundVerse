@extends('layouts.app.master')

@section('title', 'Edit Artwork Photo Service')

@section('css')
@endsection

@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Edit Artwork Photo Service</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-home') }}"></use>
                            </svg></a>
                        </li>
                        <li class="breadcrumb-item">CMS</li>
                        <li class="breadcrumb-item active">Edit Artwork Photo Service</li>
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
                        <h5>Edit Service Form</h5>
                    </div>
                    <div class="card-body">
                        <form class="row g-3 common-form" method="POST" action="{{ route('admin.service.artworkphoto.update', $service->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="col-md-12">
                                <label class="form-label">Service Icon</label>
                                <input class="form-control" name="icon" type="text" value="{{ old('icon', $service->icon) }}" required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Service Title</label>
                                <input class="form-control" name="title" type="text" value="{{ old('title', $service->title) }}" required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Service Description</label>
                                <textarea id="service_description" name="description" class="form-control" rows="6" required>{{ old('description', $service->description) }}</textarea>
                            </div>

                            <div class="col-md-6 mt-3">
                                <button class="btn btn-primary f-w-500" type="submit">Update Service</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.9.2/ckeditor.js" integrity="sha512-OF6VwfoBrM/wE3gt0I/lTh1ElROdq3etwAquhEm2YI45Um4ird+0ZFX1IwuBDBRufdXBuYoBb0mqXrmUA2VnOA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
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

