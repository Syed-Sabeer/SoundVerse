@extends('layouts.app.master')

@section('title', 'Tracks Management')

@section('css')
<style>
    .track-thumb {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        object-fit: cover;
    }
    .featured-badge {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        padding: 3px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
    }
</style>
@endsection

@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Tracks Management</h3>
                    <p class="text-muted">View all uploaded songs and mark featured tracks for the homepage.</p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Tracks</li>
                        <li class="breadcrumb-item active">All Songs</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid list-product-view product-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="text-muted mb-1">Total Tracks</h6>
                                <h3 class="mb-0">{{ $totalSongs }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="text-muted mb-1">Featured Tracks</h6>
                                <h3 class="mb-0 text-primary">{{ $featuredCount }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header card-no-border">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h5 class="mb-0">All Songs</h5>
                            </div>
                            <div class="col-md-6 text-end">
                                <form method="GET" action="{{ route('admin.songs.index') }}" class="d-inline-flex gap-2">
                                    <input type="text"
                                           name="search"
                                           class="form-control form-control-sm"
                                           placeholder="Search by song or artist..."
                                           value="{{ request('search') }}">
                                    <select name="featured" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="">All</option>
                                        <option value="1" {{ request('featured') === '1' ? 'selected' : '' }}>Featured only</option>
                                        <option value="0" {{ request('featured') === '0' ? 'selected' : '' }}>Not featured</option>
                                    </select>
                                    @if(request('search') || request('featured') !== null)
                                        <a href="{{ route('admin.songs.index') }}" class="btn btn-sm btn-outline-secondary">Clear</a>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card-body px-0 pt-0">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show m-3">
                                {{ session('success') }}
                                <button class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show m-3">
                                {{ $errors->first() }}
                                <button class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="list-product">
                            <div class="recent-table table-responsive custom-scrollbar product-list-table">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Cover</th>
                                            <th>Title</th>
                                            <th>Artist</th>
                                            <th>ISRC Code</th>
                                            <th>Plays</th>
                                            <th>Featured</th>
                                            <th>Uploaded At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($songs as $song)
                                            <tr>
                                                <td>{{ $loop->iteration + ($songs->currentPage() - 1) * $songs->perPage() }}</td>
                                                <td>
                                                    @php
                                                        $thumb = $song->thumbnail_image_url
                                                            ?? 'https://img.freepik.com/premium-photo/headphones-neon-light_102957-920.jpg';
                                                    @endphp
                                                    <img src="{{ $thumb }}" alt="{{ $song->name }}" class="track-thumb">
                                                </td>
                                                <td>{{ $song->name }}</td>
                                                <td>{{ $song->user->name ?? 'Unknown Artist' }}</td>
                                                <td>
                                                    @if($song->isrc_code)
                                                        <code style="color: #b794f6; font-size: 0.85rem; background: rgba(183, 148, 246, 0.1); padding: 4px 8px; border-radius: 4px;">{{ $song->isrc_code }}</code>
                                                    @else
                                                        <span class="text-muted" style="font-size: 0.85rem;">—</span>
                                                    @endif
                                                </td>
                                                <td>{{ number_format($song->listeners) }}</td>
                                                <td>
                                                    <form method="POST"
                                                          action="{{ route('admin.songs.toggleFeatured', $song->id) }}"
                                                          style="display:inline;">
                                                        @csrf
                                                        <div class="form-check form-switch form-check-inline">
                                                            <input class="form-check-input"
                                                                   type="checkbox"
                                                                   name="is_featured"
                                                                   value="1"
                                                                   {{ $song->is_featured ? 'checked' : '' }}
                                                                   onchange="this.form.submit()">
                                                        </div>
                                                    </form>
                                                    @if($song->is_featured)
                                                        <span class="featured-badge">Featured</span>
                                                    @endif
                                                </td>
                                                <td>{{ $song->created_at->format('M d, Y') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-4 text-muted">
                                                    No songs found.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="p-3">
                            {{ $songs->links() }}
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

