@extends('layouts.app.master')

@section('title', 'Tip Details')

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
    .detail-card {
        background: #fff;
        border-radius: 10px;
        padding: 25px;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .detail-card h5 {
        color: #495057;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e9ecef;
    }
    .detail-row {
        display: flex;
        padding: 12px 0;
        border-bottom: 1px solid #f0f0f0;
    }
    .detail-row:last-child {
        border-bottom: none;
    }
    .detail-label {
        font-weight: 600;
        color: #495057;
        min-width: 200px;
    }
    .detail-value {
        color: #212529;
        flex: 1;
    }
</style>
@endsection

@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Tip Details</h3>
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
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.tips.index') }}">Tip Management</a>
                        </li>
                        <li class="breadcrumb-item active">Tip Details</li>
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
                        <h5>Tip Information</h5>
                        <a href="{{ route('admin.tips.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fa fa-arrow-left"></i> Back to Tips
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="detail-card">
                            <div class="detail-row">
                                <div class="detail-label">Tip ID</div>
                                <div class="detail-value"><strong>#{{ $tip->id }}</strong></div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">User</div>
                                <div class="detail-value">{{ $tip->user->name }} ({{ $tip->user->email }})</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Artist</div>
                                <div class="detail-value">{{ $tip->artist->name }} ({{ $tip->artist->email }})</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Tip Amount</div>
                                <div class="detail-value"><strong>£{{ number_format($tip->amount, 2) }}</strong></div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Platform Fee (5%)</div>
                                <div class="detail-value">£{{ number_format($tip->platform_fee, 2) }}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Total Paid</div>
                                <div class="detail-value"><strong>£{{ number_format($tip->total_amount, 2) }}</strong></div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Payment Method</div>
                                <div class="detail-value">{{ ucfirst(str_replace('-', ' ', $tip->payment_method)) }}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Payment ID</div>
                                <div class="detail-value">{{ $tip->payment_method_id ?? 'N/A' }}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Status</div>
                                <div class="detail-value">
                                    <span class="status-badge status-{{ $tip->status }}">
                                        {{ ucfirst(str_replace('_', ' ', $tip->status)) }}
                                    </span>
                                </div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Paid Date</div>
                                <div class="detail-value">{{ $tip->paid_at ? $tip->paid_at->format('M d, Y H:i') : '-' }}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Sent to Artist Date</div>
                                <div class="detail-value">{{ $tip->sent_to_artist_at ? $tip->sent_to_artist_at->format('M d, Y H:i') : '-' }}</div>
                            </div>
                            @if($tip->user_message)
                            <div class="detail-row">
                                <div class="detail-label">User Message</div>
                                <div class="detail-value">{{ $tip->user_message }}</div>
                            </div>
                            @endif
                            @if($tip->admin_notes)
                            <div class="detail-row">
                                <div class="detail-label">Admin Notes</div>
                                <div class="detail-value">{{ $tip->admin_notes }}</div>
                            </div>
                            @endif
                            <div class="detail-row">
                                <div class="detail-label">Created At</div>
                                <div class="detail-value">{{ $tip->created_at->format('M d, Y H:i') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
