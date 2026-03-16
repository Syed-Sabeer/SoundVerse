@extends('layouts.app.master')

@section('title', 'Royalty Collection Section Management')

@section('css')
@endsection

@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Royalty Collection Section Management</h3>
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
                        <li class="breadcrumb-item active">Royalty Collection Section</li>
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
                        <h5>Royalty Collection Section Content</h5>
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

                        <form method="POST" action="{{ route('admin.royalty.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Main Royalty Collection Section -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h6 class="mb-3 text-primary">Main Royalty Collection Section</h6>
                                </div>
                                
                                <div class="col-md-6 mt-3">
                                    <div class="form-group">
                                        <label class="form-label">Title 1</label>
                                        <input type="text" class="form-control" name="title" 
                                               value="{{ old('title', $aboutSection->title ?? '') }}" 
                                               placeholder="Enter Title 1">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="form-group">
                                        <label class="form-label">Value 1</label>
                                        <input type="text" class="form-control" name="value" 
                                               value="{{ old('value', $aboutSection->value ?? '') }}" 
                                               placeholder="Enter Value 1">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="form-group">
                                        <label class="form-label">Title 2</label>
                                        <input type="text" class="form-control" name="title2" 
                                               value="{{ old('title2', $aboutSection->title2 ?? '') }}" 
                                               placeholder="Enter Title 2">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="form-group">
                                        <label class="form-label">Value 2</label>
                                        <input type="text" class="form-control" name="value2" 
                                               value="{{ old('value2', $aboutSection->value2 ?? '') }}" 
                                               placeholder="Enter Value 2">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="form-group">
                                        <label class="form-label">Title 3</label>
                                        <input type="text" class="form-control" name="title3" 
                                               value="{{ old('title3', $aboutSection->title3 ?? '') }}" 
                                               placeholder="Enter Title 3">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="form-group">
                                        <label class="form-label">Value 3</label>
                                        <input type="text" class="form-control" name="value3" 
                                               value="{{ old('value3', $aboutSection->value3 ?? '') }}" 
                                               placeholder="Enter Value 3">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="form-group">
                                        <label class="form-label">Title 4</label>
                                        <input type="text" class="form-control" name="title4" 
                                               value="{{ old('title4', $aboutSection->title4 ?? '') }}" 
                                               placeholder="Enter Title 4">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="form-group">
                                        <label class="form-label">Value 4</label>
                                        <input type="text" class="form-control" name="value4" 
                                               value="{{ old('value4', $aboutSection->value4 ?? '') }}" 
                                               placeholder="Enter Value 4">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save me-2"></i>Update Royalty Collection Section
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