@extends('layouts.app.master')

@section('title', 'Royalty Management')

@section('css')
<style>
    .stats-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .stats-card h5 {
        color: rgba(255,255,255,0.9);
        font-size: 0.9rem;
        margin-bottom: 10px;
    }
    .stats-card .value {
        font-size: 2rem;
        font-weight: 700;
    }
    .action-buttons {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }
</style>
@endsection

@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Royalty Management</h3>
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
                        <li class="breadcrumb-item">Royalty</li>
                        <li class="breadcrumb-item active">Management</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
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

        <!-- Summary Statistics -->
        <div class="row">
            <div class="col-md-3">
                <div class="stats-card">
                    <h5>Total Platform Revenue Set</h5>
                    <div class="value">${{ number_format($totalPlatformRevenueSet ?? 0, 2) }}</div>
                    <small style="opacity: 0.8;">From platform_revenue_tracking</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                    <h5>Total Platform Fees</h5>
                    <div class="value">${{ number_format($totalPlatformFee, 2) }}</div>
                    <small style="opacity: 0.8;">From royalty calculations</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                    <h5>Total Artist Payments</h5>
                    <div class="value">${{ number_format($totalArtistPayments, 2) }}</div>
                    <small style="opacity: 0.8;">From royalty calculations</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                    <h5>Pending Payments</h5>
                    <div class="value">${{ number_format($pendingPayments, 2) }}</div>
                    <small style="opacity: 0.8;">From royalty calculations</small>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Royalty Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="action-buttons">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#setRevenueModal">
                                Set Platform Revenue
                            </button>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#calculateModal">
                                Calculate Royalties
                            </button>
                            <a href="{{ route('admin.royalty.payout-requests') }}" class="btn btn-warning">
                                View Payout Requests
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Platform Revenue Tracking -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Platform Revenue Tracking</h5>
                    </div>
                    <div class="card-body">
                        @if(isset($platformRevenues) && $platformRevenues->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Period</th>
                                        <th>Revenue Amount</th>
                                        <th>Revenue Source</th>
                                        <th>Total Streams</th>
                                        <th>Total Downloads</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($platformRevenues as $revenue)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::create($revenue->period_year, $revenue->period_month, 1)->format('F Y') }}</td>
                                        <td><strong>${{ number_format($revenue->total_platform_revenue, 2) }}</strong></td>
                                        <td>{{ ucfirst($revenue->revenue_source ?? 'N/A') }}</td>
                                        <td>{{ number_format($revenue->total_platform_streams ?? 0) }}</td>
                                        <td>{{ number_format($revenue->total_platform_downloads ?? 0) }}</td>
                                        <td>
                                            <span class="badge badge-{{ $revenue->status == 'confirmed' ? 'success' : ($revenue->status == 'finalized' ? 'info' : 'warning') }}">
                                                {{ ucfirst($revenue->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <p class="text-center text-muted">No platform revenue set yet. Use "Set Platform Revenue" button above.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Royalty Calculations</h5>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.royalty.index') }}" class="row g-3 mb-3">
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
                            <div class="col-md-2">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="">All Status</option>
                                    <option value="calculated" {{ request('status') == 'calculated' ? 'selected' : '' }}>Calculated</option>
                                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Start Date</label>
                                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">End Date</label>
                                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
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
                                        <th>Period</th>
                                        <th>Artist</th>
                                        <th>Streams</th>
                                        <th>Downloads</th>
                                        <th>Gross Revenue</th>
                                        <th>Platform Fee</th>
                                        <th>Artist Share</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($calculations as $calc)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($calc->calculation_period)->format('M Y') }}</td>
                                        <td>{{ $calc->artist->name }}</td>
                                        <td>{{ number_format($calc->total_streams) }}</td>
                                        <td>{{ number_format($calc->total_downloads) }}</td>
                                        <td>${{ number_format($calc->total_gross_revenue, 2) }}</td>
                                        <td>${{ number_format($calc->platform_fee_amount, 2) }} ({{ $calc->platform_fee_percentage }}%)</td>
                                        <td><strong>${{ number_format($calc->artist_royalty_amount, 2) }}</strong></td>
                                        <td>
                                            <span class="badge badge-{{ $calc->status == 'paid' ? 'success' : ($calc->status == 'calculated' ? 'info' : 'warning') }}">
                                                {{ ucfirst($calc->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No royalty calculations found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{ $calculations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Set Revenue Modal -->
<div class="modal fade" id="setRevenueModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.royalty.set-platform-revenue') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Set Platform Revenue</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Month</label>
                        <select name="month" class="form-select" required>
                            @for($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ now()->month == $i ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create(null, $i, 1)->format('F') }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Year</label>
                        <input type="number" name="year" class="form-control" value="{{ now()->year }}" min="2020" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Revenue Amount ($)</label>
                        <input type="number" name="revenue" class="form-control" step="0.01" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Revenue Source</label>
                        <select name="revenue_source" class="form-select">
                            <option value="subscriptions">Subscriptions</option>
                            <option value="ads">Ads</option>
                            <option value="purchases">Purchases</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Set Revenue</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Calculate Royalties Modal -->
<div class="modal fade" id="calculateModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.royalty.calculate') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Calculate Royalties</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        This will calculate royalties for all artists based on their streams for the selected period.
                        Make sure you have set the platform revenue for this period first.
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Month</label>
                        <select name="month" class="form-select" required>
                            @for($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ now()->month == $i ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create(null, $i, 1)->format('F') }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Year</label>
                        <input type="number" name="year" class="form-control" value="{{ now()->year }}" min="2020" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Calculate Royalties</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
