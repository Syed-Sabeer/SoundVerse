@extends('layouts.app.master')

@section('title', 'Share Your Music Section Management')

@section('css')
@endsection

@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Share Your Music Section Management</h3>
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
                        <li class="breadcrumb-item active">Share Your Music Section</li>
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
                        <h5>Share Your Music Section Content</h5>
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

                        <form method="POST" action="{{ route('admin.cms.shareyourmusic.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Main About Section -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h6 class="mb-3 text-primary">Main Share Your Music Section</h6>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" name="title" 
                                               value="{{ old('title', $shareyourmusic->title ?? '') }}" 
                                               placeholder="Enter Title">
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <div class="form-group">
                                        <label class="form-label">Description </label>
                                        <textarea class="form-control" name="description" rows="4" 
                                                  placeholder="Enter Description 1">{{ old('description', $shareyourmusic->description ?? '') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Heading</label>
                                        <input type="text" class="form-control" name="heading2" 
                                               value="{{ old('heading2', $shareyourmusic->heading2 ?? '') }}" 
                                               placeholder="Enter Heading">
                                    </div>
                                </div>


                                <div class="col-12 mt-3">
                                    <div class="form-group">
                                        <label class="form-label">Description 2</label>
                                        <textarea class="form-control" name="description2" rows="4" 
                                                    placeholder="Enter Description 2">{{ old('description2', $shareyourmusic->description2 ?? '') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Button Link</label>
                                        <input type="text" class="form-control" name="button_link" 
                                               value="{{ old('button_link', $shareyourmusic->button_link ?? '') }}" 
                                               placeholder="Enter Heading">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="form-group">
                                        <label class="form-label">Step 1 Title</label>
                                        <input type="text" class="form-control" name="step1_title" 
                                               value="{{ old('step1_title', $shareyourmusic->step1_title ?? '') }}" 
                                               placeholder="Enter Heading">
                                    </div>
                                </div>


                                <div class="col-12 mt-3">
                                    <div class="form-group">
                                        <label class="form-label">Step 1 Description</label>
                                        <textarea class="form-control" name="step1_description" rows="4" 
                                                    placeholder="Enter Description 2">{{ old('step1_description', $shareyourmusic->step1_description ?? '') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Step 2 Title</label>
                                        <input type="text" class="form-control" name="step2_title" 
                                               value="{{ old('step2_title', $shareyourmusic->step2_title ?? '') }}" 
                                               placeholder="Enter Heading">
                                    </div>
                                </div>


                                <div class="col-12 mt-3">
                                    <div class="form-group">
                                        <label class="form-label">Step 2 Description</label>
                                        <textarea class="form-control" name="step2_description" rows="4" 
                                                    placeholder="Enter Description 2">{{ old('step2_description', $shareyourmusic->step2_description ?? '') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Step 3 Title</label>
                                        <input type="text" class="form-control" name="step3_title" 
                                               value="{{ old('step3_title', $shareyourmusic->step3_title ?? '') }}" 
                                               placeholder="Enter Heading">
                                    </div>
                                </div>


                                <div class="col-12 mt-3">
                                    <div class="form-group">
                                        <label class="form-label">Step 3 Description</label>
                                        <textarea class="form-control" name="step3_description" rows="4" 
                                                    placeholder="Enter Description 2">{{ old('step3_description', $shareyourmusic->step3_description ?? '') }}</textarea>
                                    </div>
                                </div>


                               
                            </div>

                      
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save me-2"></i>Update Share Your Music Section
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