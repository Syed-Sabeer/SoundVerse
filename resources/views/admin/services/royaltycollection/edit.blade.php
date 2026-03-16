@extends('layouts.app.master')

@section('title', 'Edit Royalty Collection Service')

@section('css')
@endsection

@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Edit Royalty Collection Service</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-home') }}"></use>
                            </svg></a>
                        </li>
                        <li class="breadcrumb-item">CMS</li>
                        <li class="breadcrumb-item active">Edit Royalty Collection Service</li>
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
                        <form class="row g-3 common-form" method="POST" action="{{ route('admin.service.royaltycollection.update', $service->id) }}">
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

                            <div class="col-md-12">
                                <label class="form-label">Button Link</label>
                                <input class="form-control" name="button_link" type="text" value="{{ old('button_link', $service->button_link) }}" required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Includes</label>
                                <div id="includes-wrapper">
                                    @php
                                        $includes = json_decode($service->include, true) ?? [];
                                    @endphp
                                    @foreach($includes as $include)
                                        <div class="input-group mb-2">
                                            <input type="text" name="include[]" class="form-control" value="{{ $include }}" placeholder="Enter included item" required>
                                            <button type="button" class="btn btn-danger remove-include">Remove</button>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-success mt-2" id="add-include">Add More</button>
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

    const addIncludeBtn = document.getElementById('add-include');
    const includesWrapper = document.getElementById('includes-wrapper');

    addIncludeBtn.addEventListener('click', function () {
        const newInputGroup = document.createElement('div');
        newInputGroup.classList.add('input-group', 'mb-2');
        newInputGroup.innerHTML = `
            <input type="text" name="include[]" class="form-control" placeholder="Enter included item" required>
            <button type="button" class="btn btn-danger remove-include">Remove</button>
        `;
        includesWrapper.appendChild(newInputGroup);
    });

    includesWrapper.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-include')) {
            e.target.closest('.input-group').remove();
        }
    });
});
</script>
@endsection

