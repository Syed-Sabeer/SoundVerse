@extends('layouts.app.master')

@section('title', 'Tip Management')

@section('css')
<style>
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
    }
    .status-pending { background: #fff3cd; color: #856404; }
    .status-paid { background: #cfe2ff; color: #084298; }
    .status-sent_to_artist { background: #d1e7dd; color: #0f5132; }
    .status-failed { background: #f8d7da; color: #842029; }
    .status-cancelled { background: #e2e3e5; color: #383d41; }
    .stats-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .stats-card h5 {
        color: white;
        margin-bottom: 10px;
    }
    .stats-card .stat-value {
        font-size: 2em;
        font-weight: 700;
    }
</style>
@endsection

@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Tip Management</h3>
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
                        <li class="breadcrumb-item active">Tip Management</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Statistics -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stats-card">
                    <h5>Total Tips</h5>
                    <div class="stat-value">{{ $stats['total_tips'] }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                    <h5>Total Amount</h5>
                    <div class="stat-value">£{{ number_format($stats['total_amount'], 2) }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                    <h5>Pending Payment</h5>
                    <div class="stat-value">{{ $stats['pending_count'] }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                    <h5>Completed</h5>
                    <div class="stat-value">{{ $stats['sent_count'] }}</div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Tips</h5>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.tips.index') }}" class="row g-3 mb-3">
                            <div class="col-md-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="">All Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending Payment</option>
                                    <option value="sent_to_artist" {{ request('status') == 'sent_to_artist' ? 'selected' : '' }}>Completed</option>
                                    <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Artist</label>
                                <select name="artist_id" class="form-select">
                                    <option value="">All Artists</option>
                                    @foreach($artists as $artist)
                                        <option value="{{ $artist->id }}" {{ request('artist_id') == $artist->id ? 'selected' : '' }}>
                                            {{ $artist->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">User</label>
                                <select name="user_id" class="form-select">
                                    <option value="">All Users</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">&nbsp;</label>
                                <button type="submit" class="btn btn-primary d-block">Filter</button>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Artist</th>
                                        <th>Amount</th>
                                        <th>Platform Fee</th>
                                        <th>Total Paid</th>
                                        <th>Payment Method</th>
                                        <th>Status</th>
                                        <th>Paid Date</th>
                                        <th>Sent Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($tips as $tip)
                                    <tr>
                                        <td>#{{ $tip->id }}</td>
                                        <td>{{ $tip->user->name }}</td>
                                        <td>{{ $tip->artist->name }}</td>
                                        <td><strong>£{{ number_format($tip->amount, 2) }}</strong></td>
                                        <td>£{{ number_format($tip->platform_fee, 2) }}</td>
                                        <td>£{{ number_format($tip->total_amount, 2) }}</td>
                                        <td>{{ ucfirst(str_replace('-', ' ', $tip->payment_method)) }}</td>
                                        <td>
                                            <span class="status-badge status-{{ $tip->status }}">
                                                {{ ucfirst(str_replace('_', ' ', $tip->status)) }}
                                            </span>
                                        </td>
                                        <td>{{ $tip->paid_at ? $tip->paid_at->format('M d, Y H:i') : '-' }}</td>
                                        <td>{{ $tip->sent_to_artist_at ? $tip->sent_to_artist_at->format('M d, Y H:i') : '-' }}</td>
                                        <td>
                                            <a href="{{ route('admin.tips.show', $tip->id) }}" class="btn btn-sm btn-info">
                                                <i class="fa fa-eye"></i> Details
                                            </a>
                                        </td>
                                    </tr>

                                    @empty
                                    <tr>
                                        <td colspan="11" class="text-center">No tips found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{ $tips->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
