@extends('layouts.app.master')

@section('title', 'Artist Subscription Plans')

@section('css')
<style>
    .feature-badge {
        display: inline-block;
        padding: 4px 8px;
        background: #e3f2fd;
        color: #1976d2;
        border-radius: 4px;
        font-size: 0.85rem;
        margin: 2px;
    }
    .plan-status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
    }
    .status-active {
        background: #d4edda;
        color: #155724;
    }
    .status-inactive {
        background: #f8d7da;
        color: #721c24;
    }
</style>
@endsection

@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Artist Subscription Plans</h3>
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
                        <li class="breadcrumb-item">CMS</li>
                        <li class="breadcrumb-item active">Artist Subscription Plans</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Container-fluid starts-->
    <div class="container-fluid list-product-view product-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-no-border text-end">
                        <div class="card-header-right-icon">
                            <a class="btn btn-primary f-w-500" href="{{ route('admin.artist-subscription-plans.add') }}">
                                <i class="fa fa-plus pe-2"></i>Add Plan
                            </a>
                        </div>
                    </div>

                    <div class="card-body px-0 pt-0">
                        <div class="list-product">
                            <div class="recent-table table-responsive custom-scrollbar product-list-table">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Plan Name</th>
                                            <th>Monthly Fee</th>
                                            <th>Uploads</th>
                                            <th>Key Features</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($plans as $plan)
                                            <tr class="product-removes">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <p class="c-o-light f-w-600">{{ $plan->plan_name }}</p>
                                                    @if($plan->ideal_for)
                                                        <small class="text-muted">{{ Str::limit($plan->ideal_for, 50) }}</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    <p class="c-o-light f-w-600">
                                                        @if($plan->monthly_fee > 0)
                                                            {{ $plan->currency }} {{ number_format($plan->monthly_fee, 2) }}/month
                                                        @else
                                                            <span class="badge bg-success">Free</span>
                                                        @endif
                                                    </p>
                                                </td>
                                                <td>
                                                    @if($plan->is_unlimited_uploads)
                                                        <span class="badge bg-primary">Unlimited</span>
                                                    @elseif($plan->songs_per_month)
                                                        <span class="badge bg-info">{{ $plan->songs_per_month }} songs/month</span>
                                                    @else
                                                        <span class="badge bg-secondary">None</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div style="max-width: 300px;">
                                                        @php
                                                            $features = [];
                                                            if($plan->is_featured_rotation) $features[] = 'Featured Rotation';
                                                            if($plan->is_priority_search) $features[] = 'Priority Search';
                                                            if($plan->is_isrc_codes) $features[] = 'ISRC Codes';
                                                            if($plan->is_certified_badge) $features[] = 'Certified Badge';
                                                            if($plan->is_royalty_tracking) $features[] = 'Royalty Tracking';
                                                            if($plan->is_advanced_analytics) $features[] = 'Advanced Analytics';
                                                        @endphp
                                                        @foreach(array_slice($features, 0, 3) as $feature)
                                                            <span class="feature-badge">{{ $feature }}</span>
                                                        @endforeach
                                                        @if(count($features) > 3)
                                                            <span class="feature-badge">+{{ count($features) - 3 }} more</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($plan->is_active)
                                                        <span class="plan-status-badge status-active">Active</span>
                                                    @else
                                                        <span class="plan-status-badge status-inactive">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="product-action d-flex gap-2">
                                                        <a class="square-white" href="{{ route('admin.artist-subscription-plans.edit', $plan->id) }}" title="Edit">
                                                            <svg>
                                                                <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#edit-content') }}"></use>
                                                            </svg>
                                                        </a>

                                                        <form action="{{ route('admin.artist-subscription-plans.destroy', $plan->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this plan?');" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="square-white trash-3" style="border:none; background:none; padding:0;" title="Delete">
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
                                                <td colspan="7" class="text-center">No artist subscription plans found. <a href="{{ route('admin.artist-subscription-plans.add') }}">Add your first plan</a></td>
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
