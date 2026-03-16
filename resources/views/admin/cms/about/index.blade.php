@extends('layouts.app.master')

@section('title', 'About Section Management')

@section('css')
@endsection

@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>About Section Management</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item">CMS</li>
                        <li class="breadcrumb-item active">About Section</li>
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
                        <h5>About Section Content</h5>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa fa-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fa fa-exclamation-circle me-2"></i>
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.about.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Main About Section -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h6 class="mb-3 text-primary">Main About Section</h6>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Heading</label>
                                        <input type="text" class="form-control" name="about_heading" 
                                               value="{{ old('about_heading', $aboutSection->about_heading ?? '') }}" 
                                               placeholder="Enter Heading">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Button Link</label>
                                        <input type="text" class="form-control" name="about_button_link" 
                                               value="{{ old('about_button_link', $aboutSection->about_button_link ?? '') }}" 
                                               placeholder="Enter View More Button Link">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="form-group">
                                        <label class="form-label">About Image 1</label>
                                        <input type="file" class="form-control" name="about_image_1" accept="image/*">
                                        @if($aboutSection && $aboutSection->about_image_1)
                                            <div class="mt-2">
                                                <small class="text-muted">Current image:</small>
                                                <img src="{{ asset('storage/' . $aboutSection->about_image_1) }}" 
                                                     alt="About Image 1" class="img-thumbnail mt-1" style="max-height: 100px;">
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="form-group">
                                        <label class="form-label">About Image 2</label>
                                        <input type="file" class="form-control" name="about_image_2" accept="image/*">
                                        @if($aboutSection && $aboutSection->about_image_2)
                                            <div class="mt-2">
                                                <small class="text-muted">Current image:</small>
                                                <img src="{{ asset('storage/' . $aboutSection->about_image_2) }}" 
                                                     alt="About Image 2" class="img-thumbnail mt-1" style="max-height: 100px;">
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <div class="form-group">
                                        <label class="form-label">Description 1</label>
                                        <textarea class="form-control" name="about_description_1" rows="4" 
                                                  placeholder="Enter Description 1">{{ old('about_description_1', $aboutSection->about_description_1 ?? '') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <div class="form-group">
                                        <label class="form-label">Description 2</label>
                                        <textarea class="form-control" name="about_description_2" rows="4" 
                                                  placeholder="Enter Description 2">{{ old('about_description_2', $aboutSection->about_description_2 ?? '') }}</textarea>
                                    </div>
                                </div>

                               
                            </div>

                      
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save me-2"></i>Update About Section
                                    </button>
                                </div>
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
@endsection 