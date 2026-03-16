@extends('layouts.app.master')

@section('title', 'Music Video Upload Services')

@section('css')
@endsection

@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Music Video Upload Services</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-home') }}"></use>
                            </svg></a></li>
                        <li class="breadcrumb-item">CMS</li>
                        <li class="breadcrumb-item active">Music Video Upload Services</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid list-product-view product-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-no-border text-end">
                        <div class="card-header-right-icon">
                            <a class="btn btn-primary f-w-500" href="{{ route('admin.service.musicvideo.add') }}">
                                <i class="fa fa-plus pe-2"></i>Add Service
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0">
                        <div class="list-product">
                            <div class="recent-table table-responsive custom-scrollbar product-list-table">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>No.</th>
                                            <th><span class="c-o-light f-w-600">Icon</span></th>
                                            <th><span class="c-o-light f-w-600">Title</span></th>
                                            <th><span class="c-o-light f-w-600">Description</span></th>
                                            <th><span class="c-o-light f-w-600">Button Link</span></th>
                                            <th><span class="c-o-light f-w-600">Actions</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($services as $service)
                                            <tr class="product-removes">
                                                <td></td>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                {!! $service->icon !!}

                                                </td>
                                                <td>
                                                    <p class="c-o-light">{{ $service->title }}</p>
                                                </td>
                                                <td>
                                                    <p class="c-o-light">{!! Str::limit($service->description, 14, '...') !!}</p>
                                                </td>
                                                <td>
                                                    <p class="c-o-light">{{ Str::limit($service->button_link, 14, '...') }}</p>
                                                </td>
                                                <td>
                                                    <div class="product-action">
                                                        <a class="square-white" href="{{ route('admin.service.musicvideo.edit', $service->id) }}">
                                                            <svg>
                                                                <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#edit-content') }}"></use>
                                                            </svg>
                                                        </a>

                                                        <form action="{{ route('admin.service.musicvideo.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service?');" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="square-white trash-3" style="border:none; background:none; padding:0;">
                                                                <svg>
                                                                    <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#trash1') }}"></use>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No services found. <a href="{{ route('admin.service.musicvideo.add') }}">Add your first service</a></td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
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
@endsection

