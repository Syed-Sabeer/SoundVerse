@extends('layouts.app.master')

@section('title', 'Artists Management')

@section('css')
<style>
    .featured-badge {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
    }
    .artist-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
    }
</style>
@endsection

@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Artists Management</h3>
                    <p class="text-muted">Manage artists and set featured creators for homepage display</p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                            <svg class="stroke-icon">
                                <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg></a></li>
                        <li class="breadcrumb-item">Artists</li>
                        <li class="breadcrumb-item active">Artists List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid list-product-view product-wrapper">
        <div class="row">
            <div class="col-12">
                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="text-muted mb-2">Total Artists</h6>
                                <h3 class="mb-0">{{ $totalArtists }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="text-muted mb-2">Featured Artists</h6>
                                <h3 class="mb-0 text-primary">{{ $featuredCount }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="text-muted mb-2">Regular Artists</h6>
                                <h3 class="mb-0">{{ $totalArtists - $featuredCount }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header card-no-border">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h5 class="mb-0">All Artists</h5>
                            </div>
                            <div class="col-md-6 text-end">
                                <!-- Search and Filter -->
                                <form method="GET" action="{{ route('admin.artist.index') }}" class="d-inline-flex gap-2">
                                    <input type="text" name="search" class="form-control form-control-sm" 
                                           placeholder="Search artists..." 
                                           value="{{ request('search') }}">
                                    <select name="featured" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="">All Artists</option>
                                        <option value="1" {{ request('featured') == '1' ? 'selected' : '' }}>Featured Only</option>
                                        <option value="0" {{ request('featured') == '0' ? 'selected' : '' }}>Not Featured</option>
                                    </select>
                                    @if(request('search') || request('featured'))
                                        <a href="{{ route('admin.artist.index') }}" class="btn btn-sm btn-outline-secondary">Clear</a>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="list-product">
                            <div class="recent-table table-responsive custom-scrollbar product-list-table">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>No.</th>
                                            <th><span class="c-o-light f-w-600">Avatar</span></th>
                                            <th><span class="c-o-light f-w-600">Name</span></th>
                                            <th><span class="c-o-light f-w-600">Email</span></th>
                                            <th><span class="c-o-light f-w-600">Username</span></th>
                                            <th><span class="c-o-light f-w-600">Status</span></th>
                                            <th><span class="c-o-light f-w-600">Featured</span></th>
                                            <th><span class="c-o-light f-w-600">Created At</span></th>
                                            <th><span class="c-o-light f-w-600">Actions</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($artists as $artist)
                                            <tr class="product-removes">
                                                <td></td>
                                                <td>{{ $loop->iteration + ($artists->currentPage() - 1) * $artists->perPage() }}</td>
                                                <td>
                                                    @php
                                                        $avatar = $artist->profile && $artist->profile->picture
                                                            ? asset('storage/' . $artist->profile->picture)
                                                            : 'https://via.placeholder.com/50?text=' . substr($artist->name ?? 'A', 0, 1);
                                                    @endphp
                                                    <img src="{{ $avatar }}" alt="{{ $artist->name }}" class="artist-avatar">
                                                </td>
                                                <td>
                                                    <p class="c-o-light mb-0">{{ $artist->name ?? 'N/A' }}</p>
                                                </td>
                                                <td>
                                                    <p class="c-o-light mb-0">{{ $artist->email }}</p>
                                                </td>
                                                <td>
                                                    <p class="c-o-light mb-0">{{ $artist->username ?? 'N/A' }}</p>
                                                </td>
                                                <td>
                                                    <form method="POST" action="{{ route('admin.customer.toggleStatus', $artist->id) }}" style="display:inline;">
                                                        @csrf
                                                        <div class="form-check form-switch form-check-inline">
                                                            <input class="form-check-input switch-primary check-size" 
                                                                   type="checkbox" 
                                                                   role="switch" 
                                                                   name="status" 
                                                                   value="1" 
                                                                   {{ $artist->is_active ? 'checked' : '' }} 
                                                                   onchange="this.form.submit()">
                                                        </div>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form method="POST" action="{{ route('admin.artist.toggleFeatured', $artist->id) }}" style="display:inline;">
                                                        @csrf
                                                        <div class="form-check form-switch form-check-inline">
                                                            <input class="form-check-input" 
                                                                   type="checkbox" 
                                                                   name="is_featured" 
                                                                   value="1" 
                                                                   {{ $artist->is_featured ? 'checked' : '' }} 
                                                                   onchange="this.form.submit()"
                                                                   style="background-color: {{ $artist->is_featured ? '#667eea' : '' }};">
                                                        </div>
                                                    </form>
                                                    @if($artist->is_featured)
                                                        <span class="featured-badge ms-2">Featured</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <p class="c-o-light mb-0">{{ $artist->created_at->format('M d, Y') }}</p>
                                                </td>
                                                <td>
                                                    <div class="product-action">
                                                        <a class="square-white" href="{{ route('admin.customer.edit', $artist->id) }}" title="Edit">
                                                            <svg>
                                                                <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#edit-content') }}"></use>
                                                            </svg>
                                                        </a>
                                                        <a class="square-white" href="{{ route('artist-profile', ['artist' => $artist->id]) }}" target="_blank" title="View Profile">
                                                            <svg>
                                                                <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-eye') }}"></use>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center py-5">
                                                    <p class="text-muted">No artists found.</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="pagination-wrapper p-3">
                            {{ $artists->links() }}
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
