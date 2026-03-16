@extends('layouts.frontend.master')

@section('css')
<style>
    /* Ensure page is visible and properly positioned */
    .royalty-dashboard {
        //background: linear-gradient(135deg, #0f0c29, #302b63, #24243e) !important;
        min-height: auto !important;
        padding: 40px 0 !important;
        position: relative !important;
        z-index: 1 !important;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
        width: 100% !important;
        margin-top: 0 !important;
    }

   // .royalty-dashboard * {
      //  visibility: visible !important;
     //   opacity: 1 !important;
   // }

   // .royalty-dashboard .container {
     //   position: relative !important;
       // z-index: 2 !important;
       // display: block !important;
        //visibility: visible !important;
    //}

    .royalty-dashboard .row {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .royalty-dashboard .col-12,
    .royalty-dashboard .col-md-12 {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .stats-grid {
        display: grid !important;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)) !important;
        gap: 20px !important;
        margin-bottom: 40px !important;
        visibility: visible !important;
        opacity: 1 !important;
        position: relative !important;
        z-index: 2 !important;
    }

    .stat-card {
        background:#16002d !important;
        border: 1px solid rgba(183, 148, 246, 0.3) !important;
        border-radius: 15px !important;
        padding: 25px !important;
        text-align: center !important;
        transition: transform 0.3s ease !important;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
        position: relative !important;
        z-index: 2 !important;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(183, 148, 246, 0.3);
    }

    .stat-card h3 {
        color: #b8a8d0 !important;
        font-size: 0.9rem !important;
        font-weight: 700 !important;
        margin-bottom: 10px !important;
        text-transform: uppercase !important;
        letter-spacing: 1px !important;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .stat-card .value {
        color: #fbfbfb !important;
        font-size: 2rem !important;
        font-weight: 700 !important;
        margin: 0 !important;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .stat-card p {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .earnings-table {
        background: #16002d !important;
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

    .earnings-table h3 {
        color: #fbfbfb !important;
        font-size: 1.5rem !important;
        margin-bottom: 20px !important;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .table {
        width: 100% !important;
        color: #fbfbfb !important;
        display: table !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .table thead {
        background: rgba(183, 148, 246, 0.2) !important;
        display: table-header-group !important;
        visibility: visible !important;
    }

    .table th {
        padding: 15px !important;
        text-align: left !important;
        color: #b794f6 !important;
        font-weight: 600 !important;
        border-bottom: 2px solid rgba(183, 148, 246, 0.3) !important;
        display: table-cell !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .table td {
        padding: 15px !important;
        border-bottom: 1px solid rgba(183, 148, 246, 0.1) !important;
        display: table-cell !important;
        visibility: visible !important;
        opacity: 1 !important;
        color: #fbfbfb !important;
    }

    .table tbody {
        display: table-row-group !important;
        visibility: visible !important;
    }

    .table tr {
        display: table-row !important;
        visibility: visible !important;
    }

    .table tbody tr:hover {
        background: rgba(183, 148, 246, 0.1);
    }

    .btn-export {
        background: #9f54f5 !important;
        color: white !important;
        border: none !important;
        padding: 10px 20px !important;
        border-radius: 8px !important;
        text-decoration: none !important;
        display: inline-block !important;
        margin-right: 10px !important;
        transition: all 0.3s !important;
        visibility: visible !important;
        opacity: 1 !important;
        position: relative !important;
        z-index: 2 !important;
    }

    .btn-export:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(183, 148, 246, 0.4);
    }

    .payout-btn {
        background: linear-gradient(135deg, #1db954, #1ed760) !important;
        color: white !important;
        border: none !important;
        padding: 12px 30px !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        cursor: pointer !important;
        transition: all 0.3s !important;
        display: inline-block !important;
        visibility: visible !important;
        opacity: 1 !important;
        position: relative !important;
        z-index: 2 !important;
    }

    .payout-btn:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(29, 185, 84, 0.4);
    }

    .payout-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .per-track-section {
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

    .track-earning-item {
        display: flex;
        justify-content: space-between;
        padding: 15px;
        border-bottom: 1px solid rgba(183, 148, 246, 0.1);
    }

    .track-earning-item:last-child {
        border-bottom: none;
    }

    .track-name {
        color: #fbfbfb;
        font-weight: 600;
    }

    .track-stats {
        color: #b8a8d0;
        font-size: 0.9rem;
    }

    .track-earnings {
        color: #1db954 !important;
        font-weight: 700 !important;
        font-size: 1.1rem !important;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .track-name {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .track-stats {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .track-earning-item {
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    /* Ensure all headings and paragraphs are visible */
    .royalty-dashboard h1,
    .royalty-dashboard h2,
    .royalty-dashboard h3,
    .royalty-dashboard p,
    .royalty-dashboard span,
    .royalty-dashboard div {
        visibility: visible !important;
        opacity: 1 !important;
    }

    /* Override any global hiding styles */
    .royalty-dashboard {
        overflow: visible !important;
    }

    /* Ensure Bootstrap classes work properly */
   // .royalty-dashboard .container {
     //   max-width: 100% !important;
      //  width: 100% !important;
    //}

    /* Fix for any potential overlay issues */
    body:has(.royalty-dashboard) {
        overflow-x: hidden !important;
    }

    /* Ensure proper spacing from header */
    .royalty-dashboard {
        margin-top: 20px !important;
        padding-top: 60px !important;
    }
</style>
@endsection

@section('content')
<div class="royalty-dashboard">
    <div class="container">
        <div class="row mb-4" style="display: block !important; visibility: visible !important; opacity: 1 !important;">
            <div class="col-12" style="display: block !important; visibility: visible !important; opacity: 1 !important;">
                <h1 style="color: #fbfbfb !important; font-size: 2.5rem !important; font-weight: 700; margin-bottom: 10px !important; display: block !important; visibility: visible !important; opacity: 1 !important;">Royalty & Earnings Dashboard</h1>
                <p style="color: #b8a8d0 !important; font-size: 1.1rem !important; display: block !important; visibility: visible !important; opacity: 1 !important;">Track your earnings, streams, and request payouts</p>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Available Balance</h3>
                <p class="value">${{ number_format($availableBalance, 2) }}</p>
                <p style="color: #b8a8d0; font-size: 0.85rem; margin-top: 10px;">
                    @if($availableBalance >= 50)
                        <span style="color: #1db954;">✓ Ready for payout</span>
                    @else
                        <span>Minimum $50 required</span>
                    @endif
                </p>
            </div>

            <div class="stat-card">
                <h3>Total Earned</h3>
                <p class="value">${{ number_format($totalEarned, 2) }}</p>
                <p style="color: #b8a8d0; font-size: 0.85rem; margin-top: 10px; font-weight: 700;">Lifetime earnings</p>
            </div>

            <div class="stat-card">
                <h3>Total Streams</h3>
                <p class="value">{{ number_format($totalStreams) }}</p>
                <p style="color: #b8a8d0; font-size: 0.85rem; margin-top: 10px; font-weight: 700;">All time</p>
            </div>

            <div class="stat-card">
                <h3>Total Downloads</h3>
                <p class="value">{{ number_format($totalDownloads) }}</p>
                <p style="color: #b8a8d0; font-size: 0.85rem; margin-top: 10px; font-weight: 700;">All time</p>
            </div>

            <div class="stat-card">
                <h3>This Month Streams</h3>
                <p class="value">{{ number_format($currentMonthStreams) }}</p>
                <p style="color: #b8a8d0; font-size: 0.85rem; margin-top: 10px; font-weight: 700;">{{ now()->format('F Y') }}</p>
            </div>

            <div class="stat-card">
                <h3>Pending Payouts</h3>
                <p class="value">${{ number_format($pendingPayouts, 2) }}</p>
                <p style="color: #b8a8d0; font-size: 0.85rem; margin-top: 10px; font-weight: 700;">In processing</p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="row mb-4" style="display: block !important; visibility: visible !important; opacity: 1 !important;">
            <div class="col-12" style="display: block !important; visibility: visible !important; opacity: 1 !important;">
                <div style="display: flex !important; gap: 15px; flex-wrap: wrap; visibility: visible !important; opacity: 1 !important;">
                    @if($availableBalance >= 50)
                        <button class="payout-btn" onclick="openPayoutModal()">Request Payout</button>
                    @else
                        <button class="payout-btn" disabled title="Minimum $50 required for payout">
                            Request Payout (Min: $50)
                        </button>
                    @endif
                    <a href="{{ route('artist.royalty.export.csv') }}" class="btn-export">
                        <i class="fas fa-download"></i> Export CSV
                    </a>
                    <a href="{{ route('artist.royalty.export.pdf') }}" class="btn-export">
                        <i class="fas fa-file-pdf"></i> Export PDF
                    </a>
                    <a href="{{ route('artist.royalty.earnings') }}" class="btn-export">
                        <i class="fas fa-list"></i> View All Earnings
                    </a>
                    <a href="{{ route('artist.royalty.payout-requests') }}" class="btn-export">
                        <i class="fas fa-money-bill-wave"></i> Payout History
                    </a>
                </div>
            </div>
        </div>

        <!-- Per-Track Earnings (Current Month) -->
        @if(count($perTrackEarnings) > 0)
        <div class="per-track-section">
            <h3 style="color: #fbfbfb; margin-bottom: 20px;">
                Per-Track Earnings - {{ now()->format('F Y') }}
            </h3>
            @foreach($perTrackEarnings as $track)
                <div class="track-earning-item">
                    <div>
                        <div class="track-name">{{ $track['track_name'] }}</div>
                        <div class="track-stats">{{ number_format($track['streams']) }} streams</div>
                    </div>
                    <div style="text-align: right;">
                        <div class="track-earnings">${{ number_format($track['net_amount'], 2) }}</div>
                        <div class="track-stats">Gross: ${{ number_format($track['gross_revenue'], 2) }}</div>
                    </div>
                </div>
            @endforeach
        </div>
        @endif

        <!-- Recent Earnings -->
        <div class="earnings-table">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 style="color: #fbfbfb; margin: 0; font-weight: 700;">Recent Earnings</h3>
            </div>
            
            @if($recentEarnings->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Period</th>
                        <th>Track</th>
                        <th>Type</th>
                        <th>Gross</th>
                        <th>Platform Fee</th>
                        <th>Net Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentEarnings as $earning)
                    <tr>
                        <td>{{ $earning->period_date->format('M Y') }}</td>
                        <td>{{ $earning->music ? $earning->music->name : 'N/A' }}</td>
                        <td>{{ ucfirst($earning->earnings_type) }}</td>
                        <td>${{ number_format($earning->gross_amount, 2) }}</td>
                        <td>${{ number_format($earning->platform_fee, 2) }}</td>
                        <td style="color: #1db954; font-weight: 600;">${{ number_format($earning->net_amount, 2) }}</td>
                        <td>
                            <span style="padding: 5px 10px; border-radius: 5px; font-size: 0.85rem;
                                background: {{ $earning->status == 'processed' ? 'rgba(29, 185, 84, 0.2)' : 'rgba(255, 193, 7, 0.2)' }};
                                color: {{ $earning->status == 'processed' ? '#1db954' : '#ffc107' }};
                            ">
                                {{ ucfirst($earning->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p style="color: #b8a8d0; text-align: center; padding: 40px;">No earnings recorded yet. Start uploading music to earn royalties!</p>
            @endif
        </div>

        <!-- Royalty Calculations History -->
        @if($royaltyCalculations->count() > 0)
        <div class="earnings-table">
            <h3 style="color: #fbfbfb; margin-bottom: 20px;">Monthly Royalty Calculations</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Period</th>
                        <th>Streams</th>
                        <th>Downloads</th>
                        <th>Gross Revenue</th>
                        <th>Platform Fee</th>
                        <th>Your Share</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($royaltyCalculations as $calc)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($calc->calculation_period)->format('M Y') }}</td>
                        <td>{{ number_format($calc->total_streams) }}</td>
                        <td>{{ number_format($calc->total_downloads) }}</td>
                        <td>${{ number_format($calc->total_gross_revenue, 2) }}</td>
                        <td>${{ number_format($calc->platform_fee_amount, 2) }} ({{ $calc->platform_fee_percentage }}%)</td>
                        <td style="color: #1db954; font-weight: 600;">${{ number_format($calc->artist_royalty_amount, 2) }}</td>
                        <td>
                            <span style="padding: 5px 10px; border-radius: 5px; font-size: 0.85rem;
                                background: {{ $calc->status == 'paid' ? 'rgba(29, 185, 84, 0.2)' : 'rgba(183, 148, 246, 0.2)' }};
                                color: {{ $calc->status == 'paid' ? '#1db954' : '#b794f6' }};
                            ">
                                {{ ucfirst($calc->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

<!-- Payout Request Modal -->
<div class="payout-modal" id="payoutModal" style="display: none;">
    <div class="modal-overlay" onclick="closePayoutModal()">
        <div class="modal-content" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h2>Request Payout</h2>
                <button class="close-btn" onclick="closePayoutModal()">&times;</button>
            </div>
            <form action="{{ route('artist.royalty.request-payout') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Available Balance</label>
                    <div style="font-size: 1.5rem; color: #1db954; font-weight: 700;">
                        ${{ number_format($availableBalance, 2) }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="amount">Requested Amount *</label>
                    <input type="number" id="amount" name="amount" step="0.01" min="50" max="{{ $availableBalance }}" 
                           value="{{ $availableBalance >= 50 ? $availableBalance : 0 }}" required
                           style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid rgba(183, 148, 246, 0.3); background: rgba(255, 255, 255, 0.1); color: white;">
                    <small style="color: #b8a8d0;">Minimum: $50.00</small>
                </div>
                <div class="form-group">
                    <label for="payout_method">Payout Method *</label>
                    <select id="payout_method" name="payout_method" required
                            style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid rgba(183, 148, 246, 0.3); background: rgba(255, 255, 255, 0.1); color: white;">
                        <option value="">Select method</option>
                        <option value="paypal">PayPal</option>
                        <option value="bank_transfer">Bank Transfer</option>
                        <option value="wise">Wise</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="account_details">Account Details *</label>
                    <textarea id="account_details" name="account_details" rows="3" required
                              placeholder="Enter your PayPal email, bank account details, or Wise account information"
                              style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid rgba(183, 148, 246, 0.3); background: rgba(255, 255, 255, 0.1); color: white;"></textarea>
                </div>
                <div class="form-group">
                    <label for="notes">Notes (Optional)</label>
                    <textarea id="notes" name="notes" rows="2"
                              placeholder="Any additional information..."
                              style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid rgba(183, 148, 246, 0.3); background: rgba(255, 255, 255, 0.1); color: white;"></textarea>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-secondary" onclick="closePayoutModal()">Cancel</button>
                    <button type="submit" class="btn-primary">Submit Request</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.payout-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 999999;
}

.modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.modal-content {
    background: linear-gradient(135deg, #1a0b2e 0%, #2d1b4e 100%);
    border-radius: 20px;
    padding: 30px;
    max-width: 500px;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    border: 1px solid rgba(183, 148, 246, 0.3);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.modal-header h2 {
    color: white;
    margin: 0;
}

.close-btn {
    background: none;
    border: none;
    color: white;
    font-size: 2rem;
    cursor: pointer;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    color: white;
    margin-bottom: 8px;
    font-weight: 600;
}

.modal-actions {
    display: flex;
    gap: 15px;
    margin-top: 25px;
}

.btn-primary, .btn-secondary {
    flex: 1;
    padding: 12px;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
}

.btn-primary {
    background: linear-gradient(135deg, #b794f6, #9d50bb);
    color: white;
}

.btn-secondary {
    background: rgba(255, 255, 255, 0.1);
    color: white;
}
</style>

<script>
function openPayoutModal() {
    document.getElementById('payoutModal').style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function closePayoutModal() {
    document.getElementById('payoutModal').style.display = 'none';
    document.body.style.overflow = '';
}
</script>
@endsection
