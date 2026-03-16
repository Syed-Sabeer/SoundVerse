@extends('layouts.frontend.master')

@section('content')
@if(session('success'))
    <div class="alert alert-success" style="background: rgba(0, 242, 254, 0.2); border: 1px solid rgba(0, 242, 254, 0.5); color: #00f2fe; padding: 15px; border-radius: 10px; margin: 20px 0;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger" style="background: rgba(255, 51, 68, 0.2); border: 1px solid rgba(255, 51, 68, 0.5); color: #ff3344; padding: 15px; border-radius: 10px; margin: 20px 0;">
        {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger" style="background: rgba(255, 51, 68, 0.2); border: 1px solid rgba(255, 51, 68, 0.5); color: #ff3344; padding: 15px; border-radius: 10px; margin: 20px 0;">
        <ul style="margin: 0; padding-left: 20px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<style>
    /* Ensure page is visible and properly positioned */
    .collaboration-detail-section {
        background: linear-gradient(135deg, #0f0c29, #302b63, #24243e) !important;
        min-height: 100vh !important;
        padding: 40px 0 !important;
        position: relative !important;
        z-index: 1 !important;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
        width: 100% !important;
        margin-top: 0 !important;
    }

    .collaboration-detail-section * {
        visibility: visible !important;
        opacity: 1 !important;
    }

    .collaboration-detail-section .container {
        position: relative !important;
        z-index: 2 !important;
        display: block !important;
        visibility: visible !important;
    }

    .collaboration-detail-section .row {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .collaboration-detail-section .col-12,
    .collaboration-detail-section .col-md-12,
    .collaboration-detail-section .col-md-8,
    .collaboration-detail-section .col-md-6,
    .collaboration-detail-section .col-md-4 {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    .collaboration-header-card {
        background: rgba(45, 27, 78, 0.6) !important;
        border: 1px solid rgba(183, 148, 246, 0.3) !important;
        border-radius: 15px !important;
        padding: 30px !important;
        margin-bottom: 30px !important;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
        position: relative !important;
        z-index: 2 !important;
    }
    
    .collaboration-card {
        background: rgba(45, 27, 78, 0.6) !important;
        border: 1px solid rgba(183, 148, 246, 0.3) !important;
        border-radius: 15px !important;
        padding: 25px !important;
        margin-bottom: 20px !important;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
        position: relative !important;
        z-index: 2 !important;
    }
    
    .ownership-badge {
        background: rgba(183, 148, 246, 0.2);
        color: #b794f6;
        padding: 8px 16px;
        border-radius: 20px;
        display: inline-block;
        margin: 5px;
        border: 1px solid rgba(183, 148, 246, 0.3);
    }
    
    .revenue-table {
        width: 100% !important;
        color: #fbfbfb !important;
        background: rgba(183, 148, 246, 0.05) !important;
        border-radius: 10px !important;
        overflow: hidden !important;
        display: table !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    .revenue-table thead {
        background: rgba(183, 148, 246, 0.2) !important;
        display: table-header-group !important;
        visibility: visible !important;
    }
    
    .revenue-table th {
        padding: 15px !important;
        color: #b794f6 !important;
        font-weight: 600 !important;
        text-align: left !important;
        display: table-cell !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    .revenue-table td {
        padding: 15px !important;
        border-top: 1px solid rgba(183, 148, 246, 0.1) !important;
        display: table-cell !important;
        visibility: visible !important;
        opacity: 1 !important;
        color: #fbfbfb !important;
    }
    
    .revenue-table tbody {
        display: table-row-group !important;
        visibility: visible !important;
    }

    .revenue-table tr {
        display: table-row !important;
        visibility: visible !important;
    }
    
    .revenue-table tbody tr:hover {
        background: rgba(183, 148, 246, 0.1) !important;
    }

    .ownership-badge {
        display: inline-block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    /* Ensure all headings and paragraphs are visible */
    .collaboration-detail-section h1,
    .collaboration-detail-section h2,
    .collaboration-detail-section h3,
    .collaboration-detail-section h4,
    .collaboration-detail-section p,
    .collaboration-detail-section span,
    .collaboration-detail-section div,
    .collaboration-detail-section ul,
    .collaboration-detail-section li {
        visibility: visible !important;
        opacity: 1 !important;
    }

    /* Override any global hiding styles */
    .collaboration-detail-section {
        overflow: visible !important;
    }

    /* Ensure Bootstrap classes work properly */
    .collaboration-detail-section .container {
        max-width: 100% !important;
        width: 100% !important;
    }

    /* Fix for any potential overlay issues */
    body:has(.collaboration-detail-section) {
        overflow-x: hidden !important;
    }

    /* Ensure proper spacing from header */
    .collaboration-detail-section {
        margin-top: 20px !important;
        padding-top: 60px !important;
    }

    /* Ensure alerts are visible */
    .alert {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
        position: relative !important;
        z-index: 2 !important;
    }

    /* Ensure buttons are visible */
    .btn {
        display: inline-block !important;
        visibility: visible !important;
        opacity: 1 !important;
        position: relative !important;
        z-index: 2 !important;
    }

    /* Ensure badges are visible */
    .badge {
        display: inline-block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
</style>

<section class="collaboration-detail-section" style="display: block !important; visibility: visible !important; opacity: 1 !important;">
    <div class="container" style="display: block !important; visibility: visible !important; opacity: 1 !important;">
        <div class="row" style="display: block !important; visibility: visible !important; opacity: 1 !important;">
            <div class="col-12" style="display: block !important; visibility: visible !important; opacity: 1 !important;">
                <!-- Back Button -->
                <a href="{{ route('artist.portal') }}" class="btn mb-4" style="background: rgba(183, 148, 246, 0.3); color: #b794f6; border: 1px solid rgba(183, 148, 246, 0.5); padding: 10px 20px; border-radius: 8px; text-decoration: none; display: inline-block;">
                    <i class="fas fa-arrow-left"></i> Back to Portal
                </a>

                @if(!isset($collaboration) || !$collaboration)
                    <div class="alert alert-danger" style="background: rgba(255, 51, 68, 0.2); border: 1px solid rgba(255, 51, 68, 0.5); color: #ff3344; padding: 20px; border-radius: 10px; margin: 20px 0;">
                        <h4 style="color: #ff3344; margin-bottom: 10px;">No Collaboration Data Found</h4>
                        <p>Unable to load collaboration details. Please check if the collaboration exists and you have access to it.</p>
                        <a href="{{ route('artist.portal') }}" class="btn" style="background: rgba(183, 148, 246, 0.3); color: #b794f6; border: 1px solid rgba(183, 148, 246, 0.5); padding: 10px 20px; border-radius: 8px; text-decoration: none; display: inline-block; margin-top: 10px;">
                            Return to Portal
                        </a>
                    </div>
                @else

                <!-- Collaboration Header -->
                <div class="collaboration-header-card" style="display: block !important; visibility: visible !important; opacity: 1 !important;">
                    <div class="row align-items-center" style="display: flex !important; visibility: visible !important; opacity: 1 !important;">
                        <div class="col-md-8" style="display: block !important; visibility: visible !important; opacity: 1 !important;">
                            <h1 style="color: #fbfbfb !important; font-size: 2.5rem !important; margin-bottom: 15px !important; display: block !important; visibility: visible !important; opacity: 1 !important;">
                                <i class="fas fa-music" style="color: #b794f6; margin-right: 15px;"></i>
                                {{ $collaboration->music->name ?? 'Unknown Track' }}
                            </h1>
                            <div style="margin-bottom: 20px;">
                                <span class="badge" style="background: rgba(183, 148, 246, 0.3); color: #b794f6; padding: 8px 16px; border-radius: 20px; margin-right: 10px; font-size: 1rem;">
                                    {{ ucfirst($collaboration->collaboration_type ?? 'collaboration') }}
                                </span>
                                <span class="badge" style="background: {{ ($collaboration->status ?? 'pending') === 'active' ? 'rgba(0, 242, 254, 0.3)' : 'rgba(241, 196, 15, 0.3)' }}; color: {{ ($collaboration->status ?? 'pending') === 'active' ? '#00f2fe' : '#f1c40f' }}; padding: 8px 16px; border-radius: 20px; font-size: 1rem;">
                                    {{ ucfirst($collaboration->status ?? 'pending') }}
                                </span>
                            </div>
                            <p style="color: #b8a8d0; font-size: 1.1rem; margin-bottom: 0;">
                                Primary Artist: <strong style="color: #fbfbfb;">{{ $collaboration->primaryArtist->name ?? 'Unknown Artist' }}</strong>
                            </p>
                        </div>
                        <div class="col-md-4 text-end" style="display: block !important; visibility: visible !important; opacity: 1 !important;">
                            @php
                                $userOwnership = $collaboration->ownershipSplits->where('artist_id', auth()->id())->first()->ownership_percentage ?? 0;
                                $totalEarnings = $collaboration->revenueDistributions->where('artist_id', auth()->id())->sum('artist_share_after_split') ?? 0;
                            @endphp
                            <div style="background: rgba(0, 242, 254, 0.1); padding: 20px; border-radius: 12px; border: 1px solid rgba(0, 242, 254, 0.3);">
                                <div style="color: #b8a8d0; font-size: 0.9rem; margin-bottom: 8px;">Your Ownership</div>
                                <div style="color: #00f2fe; font-size: 2rem; font-weight: bold; margin-bottom: 15px;">
                                    {{ number_format($userOwnership, 2) }}%
                                </div>
                                <div style="color: #b8a8d0; font-size: 0.9rem; margin-bottom: 8px;">Total Earnings</div>
                                <div style="color: #fbfbfb; font-size: 1.8rem; font-weight: bold;">
                                    ${{ number_format($totalEarnings, 2) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ownership Distribution -->
                <div class="collaboration-card" style="display: block !important; visibility: visible !important; opacity: 1 !important;">
                    <h2 style="color: #fbfbfb !important; font-size: 1.8rem !important; margin-bottom: 20px !important; display: block !important; visibility: visible !important; opacity: 1 !important;">
                        <i class="fas fa-users" style="color: #b794f6; margin-right: 10px;"></i>
                        Ownership Distribution
                    </h2>
                    @if($collaboration->ownershipSplits && $collaboration->ownershipSplits->count() > 0)
                        <div class="row" style="display: flex !important; visibility: visible !important; opacity: 1 !important;">
                            @foreach($collaboration->ownershipSplits as $split)
                                <div class="col-md-6 mb-3" style="display: block !important; visibility: visible !important; opacity: 1 !important;">
                                    <div style="background: rgba(183, 148, 246, 0.1); padding: 15px; border-radius: 10px; border: 1px solid rgba(183, 148, 246, 0.3);">
                                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                            <div>
                                                <h4 style="color: #fbfbfb; margin: 0; font-size: 1.2rem;">
                                                    {{ $split->artist->name ?? 'Unknown Artist' }}
                                                    @if($split->is_primary)
                                                        <span style="color: #b794f6; font-size: 0.9rem;">(Primary Artist)</span>
                                                    @endif
                                                </h4>
                                                @if($split->role)
                                                    <p style="color: #b8a8d0; margin: 5px 0 0 0; font-size: 0.9rem;">
                                                        Role: {{ $split->role }}
                                                    </p>
                                                @endif
                                            </div>
                                            <div style="text-align: right;">
                                                <div style="color: #b794f6; font-size: 1.8rem; font-weight: bold;">
                                                    {{ number_format($split->ownership_percentage ?? 0, 2) }}%
                                                </div>
                                                @if($split->approved_by_artist)
                                                    <span style="color: #00f2fe; font-size: 0.85rem;">
                                                        <i class="fas fa-check-circle"></i> Approved
                                                    </span>
                                                @elseif(!$split->is_primary)
                                                    <span style="color: #f1c40f; font-size: 0.85rem;">
                                                        <i class="fas fa-clock"></i> Pending
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5" style="background: rgba(183, 148, 246, 0.1); border-radius: 10px; border: 1px solid rgba(183, 148, 246, 0.3);">
                            <i class="fas fa-users" style="font-size: 3rem; color: #b794f6; margin-bottom: 20px; opacity: 0.5;"></i>
                            <p style="color: #b8a8d0; font-size: 1.1rem;">No ownership splits found for this collaboration.</p>
                        </div>
                    @endif
                </div>

                <!-- Revenue Distribution History -->
                <div class="collaboration-card" style="display: block !important; visibility: visible !important; opacity: 1 !important;">
                    <h2 style="color: #fbfbfb !important; font-size: 1.8rem !important; margin-bottom: 20px !important; display: block !important; visibility: visible !important; opacity: 1 !important;">
                        <i class="fas fa-chart-line" style="color: #b794f6; margin-right: 10px;"></i>
                        Your Revenue Distribution History
                    </h2>
                    
                    @if($userRevenue && $userRevenue->count() > 0)
                        <div style="overflow-x: auto;">
                            <table class="revenue-table">
                                <thead>
                                    <tr>
                                        <th>Period Date</th>
                                        <th>Streams</th>
                                        <th>Total Revenue</th>
                                        <th>Platform Fee</th>
                                        <th>Your Share ({{ number_format($userOwnership, 2) }}%)</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($userRevenue as $revenue)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($revenue->period_date)->format('M d, Y') }}</td>
                                            <td>{{ number_format($revenue->stream_count) }}</td>
                                            <td>${{ number_format($revenue->total_revenue, 2) }}</td>
                                            <td>${{ number_format($revenue->platform_fee, 2) }}</td>
                                            <td style="color: #00f2fe; font-weight: bold;">
                                                ${{ number_format($revenue->artist_share_after_split, 2) }}
                                            </td>
                                            <td>
                                                @if($revenue->status === 'paid')
                                                    <span style="color: #00f2fe;">
                                                        <i class="fas fa-check-circle"></i> Paid
                                                    </span>
                                                @elseif($revenue->status === 'calculated')
                                                    <span style="color: #f1c40f;">
                                                        <i class="fas fa-clock"></i> Calculated
                                                    </span>
                                                @else
                                                    <span style="color: #b8a8d0;">
                                                        <i class="fas fa-hourglass-half"></i> Pending
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $userRevenue->links() }}
                        </div>
                    @else
                        <div class="text-center py-5" style="background: rgba(183, 148, 246, 0.1); border-radius: 10px; border: 1px solid rgba(183, 148, 246, 0.3);">
                            <i class="fas fa-chart-line" style="font-size: 3rem; color: #b794f6; margin-bottom: 20px; opacity: 0.5;"></i>
                            <p style="color: #b8a8d0; font-size: 1.1rem;">No revenue distributions yet. Revenue will be calculated and distributed based on streaming data.</p>
                        </div>
                    @endif
                </div>

                <!-- Revenue Calculation Info -->
                <div class="collaboration-card" style="background: rgba(0, 242, 254, 0.05) !important; border-color: rgba(0, 242, 254, 0.3) !important; display: block !important; visibility: visible !important; opacity: 1 !important;">
                    <h3 style="color: #00f2fe !important; font-size: 1.4rem !important; margin-bottom: 15px !important; display: block !important; visibility: visible !important; opacity: 1 !important;">
                        <i class="fas fa-info-circle" style="margin-right: 10px;"></i>
                        How Revenue is Calculated
                    </h3>
                    <div style="color: #b8a8d0; line-height: 1.8;">
                        <p>Revenue for collaborative tracks is calculated based on:</p>
                        <ul style="margin-left: 20px; margin-top: 10px;">
                            <li>Total streams for the track during the period</li>
                            <li>Platform fee (typically 20% of total revenue)</li>
                            <li>Your ownership percentage ({{ number_format($userOwnership, 2) }}%)</li>
                            <li>Revenue is distributed to all collaborators based on their ownership splits</li>
                        </ul>
                        <p style="margin-top: 15px; color: #fbfbfb;">
                            <strong>Example:</strong> If the track earns $20 in a period, the platform takes $4 (20% fee), leaving $16 for artists. With your {{ number_format($userOwnership, 2) }}% ownership, you receive ${{ number_format(16 * ($userOwnership / 100), 2) }}.
                        </p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
