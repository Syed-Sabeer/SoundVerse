@extends('layouts.app.master')

@section('title', 'Payout Request Details')

@section('css')
<style>
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
    }
    .status-pending { background: #fff3cd; color: #856404; }
    .status-processing { background: #cfe2ff; color: #084298; }
    .status-completed { background: #d1e7dd; color: #0f5132; }
    .status-rejected { background: #f8d7da; color: #842029; }
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
        min-width: 250px;
    }
    .detail-value {
        color: #212529;
        flex: 1;
    }
    .account-details-display {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 5px;
        margin: 0;
    }
    .account-details-display p {
        margin-bottom: 8px;
        font-size: 0.95rem;
    }
    .account-details-display p:last-child {
        margin-bottom: 0;
    }
    .account-details-display strong {
        color: #495057;
        min-width: 150px;
        display: inline-block;
    }
</style>
@endsection

@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Payout Request Details</h3>
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
                            <a href="{{ route('admin.royalty.index') }}">Royalty</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.royalty.payout-requests') }}">Payout Requests</a>
                        </li>
                        <li class="breadcrumb-item active">Payout Details</li>
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
                        <h5>Payout Request Information</h5>
                        <a href="{{ route('admin.royalty.payout-requests') }}" class="btn btn-secondary btn-sm">
                            <i class="fa fa-arrow-left"></i> Back to Payout Requests
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="detail-card">
                            <div class="detail-row">
                                <div class="detail-label">Request ID</div>
                                <div class="detail-value"><strong>#{{ $payoutRequest->id }}</strong></div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Artist</div>
                                <div class="detail-value">{{ $payoutRequest->artist->name }}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Requested Amount</div>
                                <div class="detail-value"><strong>${{ number_format($payoutRequest->requested_amount, 2) }}</strong></div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Available Balance (at request)</div>
                                <div class="detail-value">${{ number_format($payoutRequest->available_balance, 2) }}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Payment Method</div>
                                <div class="detail-value">{{ ucfirst(str_replace('_', ' ', $payoutRequest->payout_method)) }}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Account Details</div>
                                <div class="detail-value">
                                    @php
                                        $accountDetails = json_decode($payoutRequest->account_details, true);
                                    @endphp
                                    @if($accountDetails && is_array($accountDetails))
                                        @if($payoutRequest->payout_method === 'bank_transfer')
                                            <div class="account-details-display">
                                                <p><strong>Account Holder Name:</strong> {{ $accountDetails['account_name'] ?? 'N/A' }}</p>
                                                <p><strong>Bank Name:</strong> {{ $accountDetails['bank_name'] ?? 'N/A' }}</p>
                                                <p><strong>Account Number:</strong> {{ $accountDetails['account_number'] ?? 'N/A' }}</p>
                                                @if(!empty($accountDetails['routing_number']))
                                                    <p><strong>Routing/SWIFT Code:</strong> {{ $accountDetails['routing_number'] }}</p>
                                                @endif
                                            </div>
                                        @elseif($payoutRequest->payout_method === 'paypal')
                                            <div class="account-details-display">
                                                <p><strong>PayPal Email:</strong> {{ $accountDetails['paypal_email'] ?? 'N/A' }}</p>
                                            </div>
                                        @elseif($payoutRequest->payout_method === 'wise')
                                            <div class="account-details-display">
                                                <p><strong>Wise Email:</strong> {{ $accountDetails['wise_email'] ?? 'N/A' }}</p>
                                            </div>
                                        @else
                                            <pre class="mb-0">{{ $payoutRequest->account_details }}</pre>
                                        @endif
                                    @else
                                        <pre class="mb-0">{{ $payoutRequest->account_details }}</pre>
                                    @endif
                                </div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Status</div>
                                <div class="detail-value">
                                    <span class="status-badge status-{{ $payoutRequest->status }}">
                                        {{ ucfirst($payoutRequest->status) }}
                                    </span>
                                </div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Requested Date</div>
                                <div class="detail-value">{{ $payoutRequest->requested_at->format('M d, Y H:i') }}</div>
                            </div>
                            @if($payoutRequest->processed_at)
                            <div class="detail-row">
                                <div class="detail-label">Processed Date</div>
                                <div class="detail-value">{{ $payoutRequest->processed_at->format('M d, Y H:i') }}</div>
                            </div>
                            @endif
                            @if($payoutRequest->artist_notes)
                            <div class="detail-row">
                                <div class="detail-label">Artist Notes</div>
                                <div class="detail-value">{{ $payoutRequest->artist_notes }}</div>
                            </div>
                            @endif
                            @if($payoutRequest->admin_notes)
                            <div class="detail-row">
                                <div class="detail-label">Admin Notes</div>
                                <div class="detail-value">{{ $payoutRequest->admin_notes }}</div>
                            </div>
                            @endif
                            @if($payoutRequest->attachment_file)
                            <div class="detail-row">
                                <div class="detail-label">Attachment</div>
                                <div class="detail-value">
                                    <a href="{{ asset('storage/' . $payoutRequest->attachment_file) }}" target="_blank" class="btn btn-sm btn-info">
                                        <i class="fas fa-download"></i> Download Attachment
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
