{{-- This file is included in artisit-portal.blade.php, so no layout extension needed --}}

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
/* Music name input styling to match upload boxes */
#musicName::placeholder {
    color: rgba(255, 255, 255, 0.6);
    opacity: 1;
}

#musicName:focus::placeholder {
    color: rgba(255, 255, 255, 0.8);
}

/* Override form-control styles for music name input */
#musicName.form-control {
    background: rgba(255, 255, 255, 0.1) !important;
    border: none !important;
    color: white !important;
    text-align: center !important;
}

#musicName.form-control:focus {
    background: rgba(255, 255, 255, 0.2) !important;
    border: none !important;
    color: white !important;
    box-shadow: none !important;
}

/* Dark theme SweetAlert styling */
.swal2-popup {
    background-color: #1a1a1a !important;
    color: white !important;
    border: 1px solid #333 !important;
}
.audio-box {
    width:unset;
}
.popular-songs li {
    gap: 20px;
}
.artAllBtn {
    background: linear-gradient(135deg, #452d64, #21183c, #321a4a);
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    width: 200px;
    font-weight: 600;
    margin: 0 auto;
    display: flex;
    justify-content: center;
    transition: background 0.4s ease, transform 0.3s ease; /* Added transition */
}

.artAllBtn:hover {
    background: linear-gradient(135deg, #8a57ff, #9f54f5);
    transform: translateY(-2px); /* optional small lift effect */
}
.swal2-title {
    color: white !important;
}

.swal2-content {
    color: #ccc !important;
}

.swal2-confirm {
    background-color: #9f54f5 !important;
    border: none !important;
    color: white !important;
    font-weight: 600 !important;
    padding: 10px 30px !important;
    border-radius: 8px !important;
    transition: all 0.3s ease !important;
}

.swal2-confirm:hover {
    background-color:rgb(92, 0, 179) !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 4px 12px rgba(119, 0, 255, 0.3) !important;
}

.swal2-cancel {
    background-color: #6c757d !important;
    border: none !important;
    color: white !important;
    font-weight: 600 !important;
    padding: 10px 30px !important;
    border-radius: 8px !important;
    transition: all 0.3s ease !important;
}

.swal2-cancel:hover {
    background-color: #545b62 !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3) !important;
}

.swal2-close {
    color: #ccc !important;
}

.swal2-close:hover {
    color: white !important;
}


.swal2-success-circular-line-left,
.swal2-success-circular-line-right,
.swal2-success-fix {
    background-color: #1a1a1a !important;
}

.swal2-success-ring {
    border-color: #9f54f5 !important;
}

.swal2-success-line-tip,
.swal2-success-line-long {
    background-color: #9f54f5 !important;
}

/* Artist Subscription Popup Styles */
.artist-subscription-popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999999;
    display: none;
}

.artist-subscription-popup.active {
    display: block;
}

.artist-subscription-popup .overlay {
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

.artist-subscription-popup .popup {
    background: linear-gradient(135deg, #1a0b2e 0%, #2d1b4e 100%);
    border-radius: 20px;
    padding: 30px;
    max-width: 500px;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
    border: 1px solid rgba(183, 148, 246, 0.3);
}

.artist-subscription-popup .popup-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.artist-subscription-popup .popup-title {
    color: white;
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0;
}

.artist-subscription-popup .close-btn {
    background: none;
    border: none;
    color: white;
    font-size: 2rem;
    cursor: pointer;
    padding: 0;
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: background 0.3s;
}

.artist-subscription-popup .close-btn:hover {
    background: rgba(255, 255, 255, 0.1);
}

.artist-subscription-popup .plan-info {
    text-align: center;
    margin-bottom: 30px;
    padding: 20px;
    background: rgba(183, 148, 246, 0.1);
    border-radius: 15px;
}

.artist-subscription-popup .plan-info h3 {
    color: white;
    font-size: 1.5rem;
    margin: 0 0 10px 0;
}

.artist-subscription-popup .plan-price {
    font-size: 3rem;
    font-weight: 800;
    color: #b379f5;
    margin: 0 0 8px 0;
}

.artist-subscription-popup .plan-period {
    font-size: 1rem;
    color: rgba(229, 209, 250, 0.8);
    margin: 0;
}

.artist-subscription-popup .payment-methods {
    margin-bottom: 30px;
}

.artist-subscription-popup .payment-methods h4 {
    color: white;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 15px;
    text-align: center;
}

.artist-subscription-popup .payment-method {
    display: flex;
    align-items: center;
    padding: 20px;
    border: 2px solid rgba(229, 209, 250, 0.3);
    border-radius: 15px;
    margin-bottom: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.05);
}

.artist-subscription-popup .payment-method:hover {
    border-color: rgba(229, 209, 250, 0.6);
    background: rgba(255, 255, 255, 0.1);
    transform: translateY(-2px);
}

.artist-subscription-popup .payment-method.selected {
    border-color: #1db954;
    background: rgba(29, 185, 84, 0.1);
    box-shadow: 0 0 20px rgba(29, 185, 84, 0.3);
}

.artist-subscription-popup .payment-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: 700;
    margin-right: 20px;
}

.artist-subscription-popup .payment-icon.stripe {
    background: linear-gradient(135deg, #635bff 0%, #4f46e5 100%);
    color: white;
}

.artist-subscription-popup .payment-icon.google-pay {
    background: linear-gradient(135deg, #4285f4 0%, #34a853 100%);
    color: white;
}

.artist-subscription-popup .payment-icon.apple-pay {
    background: linear-gradient(135deg, #000000 0%, #333333 100%);
    color: white;
}

.artist-subscription-popup .payment-icon.paypal {
    background: linear-gradient(135deg, #0070ba 0%, #009cde 100%);
    color: white;
}

.artist-subscription-popup .payment-icon.square {
    background: linear-gradient(135deg, #00a86b 0%, #00d4aa 100%);
    color: white;
}

.artist-subscription-popup .payment-info h3 {
    font-size: 1.1rem;
    font-weight: 600;
    color: white;
    margin: 0 0 5px 0;
}

.artist-subscription-popup .payment-info p {
    font-size: 0.9rem;
    color: rgba(229, 209, 250, 0.7);
    margin: 0;
}

.artist-subscription-popup .payment-form {
    margin-top: 20px;
    padding: 20px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 10px;
}

.artist-subscription-popup .form-group {
    margin-bottom: 15px;
}

.artist-subscription-popup .form-group label {
    color: white;
    font-size: 0.95rem;
    font-weight: 600;
    margin-bottom: 10px;
    display: block;
}

.artist-subscription-popup .subscription-terms {
    margin: 25px 0;
}

.artist-subscription-popup .checkbox-container {
    display: flex;
    align-items: center;
    color: rgba(229, 209, 250, 0.9);
    font-size: 0.9rem;
    cursor: pointer;
}

.artist-subscription-popup .checkbox-container input[type="checkbox"] {
    margin-right: 10px;
    width: 18px;
    height: 18px;
    cursor: pointer;
}

.artist-subscription-popup .terms-link {
    color: #b794f6;
    text-decoration: underline;
}

.artist-subscription-popup .popup-actions {
    display: flex;
    gap: 15px;
    margin-top: 25px;
}

.artist-subscription-popup .btn-cancel,
.artist-subscription-popup .btn-confirm {
    flex: 1;
    padding: 15px;
    border: none;
    border-radius: 10px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}

.artist-subscription-popup .btn-cancel {
    background: rgba(255, 255, 255, 0.1);
    color: white;
}

.artist-subscription-popup .btn-cancel:hover {
    background: rgba(255, 255, 255, 0.2);
}

.artist-subscription-popup .btn-confirm {
    background: linear-gradient(135deg, #b794f6, #9d50bb);
    color: white;
}

.artist-subscription-popup .btn-confirm:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(183, 148, 246, 0.4);
}

.artist-subscription-popup .stripe-card-element,
.artist-subscription-popup .square-card-element {
    padding: 15px;
    background: white;
    border-radius: 8px;
    margin-top: 10px;
}

.artist-subscription-popup .stripe-card-errors,
.artist-subscription-popup .square-card-errors,
.artist-subscription-popup .payment-errors {
    color: #ef4444;
    font-size: 0.85rem;
    margin-top: 10px;
}

/* Error icon styling */
.swal2-error {
    border-color: #dc3545 !important;
}

.swal2-x-mark-line-left,
.swal2-x-mark-line-right {
    background-color: #dc3545 !important;
}

/* Progress bar styling */
.swal2-timer-progress-bar {
    background-color: #9f54f5 !important;
}

/* Input styling for SweetAlert */
.swal2-input {
    background-color: #2a2a2a !important;
    border: 1px solid #333 !important;
    color: white !important;
}

.swal2-input:focus {
    border-color: #9f54f5 !important;
    box-shadow: 0 0 0 0.2rem rgba(174, 0, 255, 0.25) !important;
}

/* Toast styling */
.swal2-toast {
    background-color: #1a1a1a !important;
    color: white !important;
    border: 1px solid #333 !important;
}



// withdrawal payment css

        .withdrawalPayment_popup .demo-trigger {
    padding: 15px 30px;
    background: linear-gradient(45deg, #f5576c, #f093fb);
    border: none;
    border-radius: 12px;
    font-size: 1.1em;
    font-weight: 600;
    color: #fff;
    cursor: pointer;
    transition: all 0.3s ease;
}

.withdrawalPayment_popup .demo-trigger:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 30px rgba(245, 87, 108, 0.4);
}

.withdrawalPayment_popup .modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.85);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 99999999999;
    backdrop-filter: blur(8px);
    animation: withdrawal_fadeIn 0.3s ease;
    padding: 20px;
}

.withdrawalPayment_popup .modal-overlay.active {
    display: flex;
}

.withdrawalPayment_popup .modal {
     display:block;
    background: #cabfeb;
    backdrop-filter: blur(20px);
    border-radius: 20px;
    max-width: 600px;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
    animation: withdrawal_slideUp 0.4s ease;
    position: relative;
}

.withdrawalPayment_popup .modal-header {
    background: linear-gradient(135deg, #8650c3, #603a87);
    padding: 30px;
    border-radius: 20px 20px 0 0;
    position: relative;
    display:block;
}

.withdrawalPayment_popup .modal-close {
    position: absolute;
    top: 20px;
    right: 20px;
    z-index: 222;
    background: rgba(255, 255, 255, 0.2);
    border: none;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    color: #fff;
    font-size: 1.5em;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.withdrawalPayment_popup .modal-close:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: rotate(90deg);
}

.withdrawalPayment_popup .modal-title {
    font-size: 1.8em;
    font-weight: 700;
    margin-bottom: 8px;
    color: #fff;
}

.withdrawalPayment_popup .modal-subtitle {
    font-size: 1em;
    color: rgba(255, 255, 255, 0.9);
    font-weight: 400;
}

.withdrawalPayment_popup .balance-display {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    padding: 20px;
    border-radius: 12px;
    margin-top: 20px;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.withdrawalPayment_popup .balance-label {
    font-size: 0.9em;
    color: rgba(255, 255, 255, 0.8);
    margin-bottom: 8px;
}

.withdrawalPayment_popup .balance-amount {
    font-size: 2.2em;
    font-weight: 700;
    color: #fff;
}

.withdrawalPayment_popup .modal-body {
    padding: 30px;
    color: #1a1a1a;
}

.withdrawalPayment_popup .form-section {
    margin-bottom: 25px;
    display: block;
    padding: 0;
}

.withdrawalPayment_popup .form-section:last-child {
    margin-bottom: 0;
}

.withdrawalPayment_popup .form-label {
    display: block;
    font-size: 0.95em;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 8px;
}

.withdrawalPayment_popup .form-label.required::after {
    content: '*';
    color: #e74c3c;
    margin-left: 4px;
}

.withdrawalPayment_popup .input-wrapper {
    position: relative;
}

.withdrawalPayment_popup .currency-symbol {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    font-weight: 600;
    color: #7f8c8d;
    font-size: 1.1em;
}

.withdrawalPayment_popup .form-input {
    width: 100%;
    padding: 14px 15px 14px 40px;
    border: 2px solid #e0e6ed;
    border-radius: 10px;
    font-size: 1em;
    color: #2c3e50;
    transition: all 0.3s ease;
    background: #fff;
    margin:0;
}

.withdrawalPayment_popup .form-input:focus {
    outline: none;
    border-color: #b673ff;
    box-shadow: 0 0 0 3px rgba(170, 152, 250, 0.1);
}

.withdrawalPayment_popup .form-input.error {
    border-color: #e74c3c;
}

.withdrawalPayment_popup .helper-text {
    font-size: 0.85em;
    margin: 10px 0 0 0px;
    font-weight: 600;
    color: #2c3e50;
}

.withdrawalPayment_popup .error-text {
    font-size: 0.85em;
    color: #e74c3c;
    margin-top: 6px;
    display: none;
}

.withdrawalPayment_popup .error-text.show {
    display: block;
}

.withdrawalPayment_popup .auto-fill-btn {
    margin-top: 10px;
    padding: 12px 16px;
    background: linear-gradient(135deg, #ab5eff, #59367d);
    border: 1px solid #d0d7de;
    border-radius: 8px;
    font-size: 0.9em;
    font-weight: 600;
    color: #ffffff;
    cursor: pointer;
    transition: all 0.3s ease;
}

.withdrawalPayment_popup .auto-fill-btn:hover {
    border-color: #ffffff;
}

.withdrawalPayment_popup .form-select {
    width: 100%;
    padding: 14px 15px;
    border: 2px solid #e0e6ed;
    border-radius: 10px;
    font-size: 1em;
    color: #2c3e50;
    background: #fff;
    cursor: pointer;
    transition: all 0.3s ease;
}

.withdrawalPayment_popup .form-select:focus {
    outline: none;
    border-color: #b673ff;
    box-shadow: 0 0 0 3px rgba(170, 152, 250, 0.1);
}

.withdrawalPayment_popup .account-info {
    background: #e4dbff;
    border: 2px solid #9559ff;
    border-radius: 10px;
    padding: 15px;
    margin-top: 10px;
}

.withdrawalPayment_popup .account-info-row {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    font-size: 0.9em;
}

.withdrawalPayment_popup .account-info-label {
    color: #2c3e50;
    font-weight: 600;
}

.withdrawalPayment_popup .account-info-value {
    font-weight: 600;
    color: #2c3e50;
}

.withdrawalPayment_popup .info-card {
    background: #7446a6;
    border-left: 4px solid #000000;
    padding: 15px;
    border-radius: 8px;
    margin-top: 20px;
}

.withdrawalPayment_popup .info-card-title {
    font-size: 0.95em;
    font-weight: 600;
    color: #ffffff;
    margin-bottom: 10px;
}

.withdrawalPayment_popup .info-item {
    display: flex;
    justify-content: space-between;
    padding: 6px 0;
    font-size: 0.9em;
}

.withdrawalPayment_popup .info-label {
    color: #ffffff;
}

.withdrawalPayment_popup .info-value {
    font-weight: 600;
    color: #ffffff;
}

.withdrawalPayment_popup .info-value.highlight {
    color: #e4d5ff;
    font-size: 1.1em;
}

.withdrawalPayment_popup .checkbox-wrapper {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-top: 20px;
    padding: 15px;
    background: #fff9e6;
    border: 1px solid #f39c12;
    border-radius: 10px;
}

.withdrawalPayment_popup .checkbox-wrapper input[type="checkbox"] {
    width: 20px;
    height: 20px;
    cursor: pointer;
    margin-top: 2px;
}

.withdrawalPayment_popup .checkbox-label {
    font-size: 0.9em;
    color: #2c3e50;
    line-height: 1.5;
}

.withdrawalPayment_popup .security-note {
    background: #f0f3f7;
    border-left: 4px solid #95a5a6;
    padding: 12px 15px;
    border-radius: 8px;
    margin-top: 15px;
    font-size: 0.85em;
    color: #5a6c7d;
}

.withdrawalPayment_popup .modal-actions {
    display: flex;
    gap: 15px;
    margin-top: 30px;
}

.withdrawalPayment_popup .btn {
    flex: 1;
    padding: 15px;
    border: none;
    border-radius: 10px;
    font-size: 1em;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.withdrawalPayment_popup .btn-primary {
    background: linear-gradient(135deg, #ab5eff, #59367d);
    color: #fff;
}

.withdrawalPayment_popup .btn-primary:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
}

.withdrawalPayment_popup .btn-primary:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.withdrawalPayment_popup .btn-secondary {
    background: #fff;
    color: #7f8c8d;
    border: 2px solid #e0e6ed;
}

.withdrawalPayment_popup .btn-secondary:hover {
    background: #f8f9fa;
    border-color: #d0d7de;
}

.withdrawalPayment_popup .loading-spinner {
    width: 18px;
    height: 18px;
    border: 3px solid rgba(255, 255, 255, 0.3);
    border-top-color: #fff;
    border-radius: 50%;
    animation: withdrawal_spin 0.8s linear infinite;
    display: none;
}

.withdrawalPayment_popup .btn-primary.loading .loading-spinner {
    display: block;
}

.withdrawalPayment_popup .btn-primary.loading .btn-text {
    display: none;
}

.withdrawalPayment_popup .success-message {
    background: #d4edda;
    border: 2px solid #28a745;
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    display: none;
}

.withdrawalPayment_popup .success-message.show {
    display: block;
}

.withdrawalPayment_popup .success-icon {
    font-size: 2em;
    margin-bottom: 15px;
}

.withdrawalPayment_popup .success-title {
    font-size: 1.3em;
    font-weight: 700;
    color: #155724;
    margin-bottom: 8px;
}

.withdrawalPayment_popup .success-text {
    font-size: 0.95em;
    color: #155724;
    line-height: 1.5;
}

/* ================= KEYFRAMES ================= */

@keyframes withdrawal_fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes withdrawal_slideUp {
    from {
        opacity: 0;
        transform: translateY(50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes withdrawal_spin {
    to { transform: rotate(360deg); }
}

/* ================= RESPONSIVE ================= */

@media (max-width: 640px) {
    .withdrawalPayment_popup .modal {
        max-height: 95vh;
    }

    .withdrawalPayment_popup .modal-header {
        padding: 25px 20px;
    }

    .withdrawalPayment_popup .modal-title {
        font-size: 1.5em;
    }

    .withdrawalPayment_popup .balance-amount {
        font-size: 1.8em;
    }

    .withdrawalPayment_popup .modal-body {
        padding: 20px;
    }

    .withdrawalPayment_popup .modal-actions {
        flex-direction: column;
    }

    .withdrawalPayment_popup .btn {
        width: 100%;
    }
}

/* ================= SCROLLBAR ================= */

.withdrawalPayment_popup .modal::-webkit-scrollbar {
    width: 8px;
}

.withdrawalPayment_popup .modal::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.withdrawalPayment_popup .modal::-webkit-scrollbar-thumb {
    background: #d0d7de;
    border-radius: 4px;
}

.withdrawalPayment_popup .modal::-webkit-scrollbar-thumb:hover {
    background: #b0b7be;
}
@media (max-width: 476px) {
    .withdrawalPayment_popup .info-item {
        font-size: 12px;
    }
    .withdrawalPayment_popup .checkbox-label {
            font-size: 10px;
            text-align: left;
    }
    .withdrawalPayment_popup .security-note {
            font-size: 10px;
            line-height: 1.5;
    }
}
a .payout-btn {
        width: 300px;
    margin: 0 auto;
    display: flex;
    justify-content: center;
}
// withdrawal payment css




</style>

   <!-- Start of InnerBanner -->
        <section class="inner-banner contact-banner">
            <div class="contact_child">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="h1-title wow fadeup-animation" data-wow-duration="0.8s" data-wow-delay="0.2s">
                                Royalty Collection
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End of InnerBanner -->

        <!-- uplaod section -->
        <section class="secRoyalty">
            <div class="container">
                <!-- Stats Overview -->
                <div class="stats-grid">
                    @php
                        // Get wallet and earnings data
                        $wallet = \App\Models\ArtistWallet::getOrCreateForArtist(auth()->id());
                        // Show all streams (both complete and incomplete) for total count
                        // Complete streams (30+ seconds) are used for royalty calculation
                        $totalStreams = \App\Models\StreamStat::where('artist_id', auth()->id())
                            ->where('stream_duration', '>', 0) // Only count streams with actual duration
                            ->count();
                        $completeStreams = \App\Models\StreamStat::where('artist_id', auth()->id())
                            ->where('is_complete', true)
                            ->count();
                        $totalEarnings = $wallet->total_earned;
                        $availableBalance = $wallet->available_balance;
                        $lastPayout = \App\Models\PayoutRequest::where('artist_id', auth()->id())
                            ->where('status', 'completed')
                            ->latest('processed_at')
                            ->first();
                    @endphp
                    <div class="stat-card">
                        <div class="stats-icon">
                            <h2>Total Streams</h2>
                            <lord-icon src="https://cdn.lordicon.com/hmabmtlg.json" trigger="loop" delay="2000"
                                colors="primary:#7166ee,secondary:#110a5c">
                            </lord-icon>
                        </div>
                        <div>
                            <p>{{ $totalStreams >= 1000000 ? number_format($totalStreams / 1000000, 1) . 'M' : ($totalStreams >= 1000 ? number_format($totalStreams / 1000, 1) . 'K' : number_format($totalStreams)) }}</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stats-icon">
                            <h2>Total Earnings</h2>
                            <lord-icon src="https://cdn.lordicon.com/ecngpoqo.json" trigger="loop" delay="2000"
                                colors="primary:#7166ee,secondary:#110a5c">
                            </lord-icon>
                        </div>
                        <div>
                            <p>${{ number_format($totalEarnings, 2) }}</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stats-icon">
                            <h2>Available Balance</h2>
                            <lord-icon src="https://cdn.lordicon.com/dhzbkemf.json" trigger="loop"
                                colors="primary:#7166ee,secondary:#110a5c">
                            </lord-icon>
                        </div>
                        <div>
                            <p>${{ number_format($availableBalance, 2) }}</p>
                            @if($availableBalance >= 50)
                                <small style="color: #1db954;">Ready for payout</small>
                            @else
                                <small style="color: #ffc107;">Min $50 required</small>
                            @endif
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stats-icon">
                            <h2>Last Payout</h2>
                            <lord-icon src="https://cdn.lordicon.com/bsdkzyjd.json" trigger="loop" delay="2000"
                                colors="primary:#7166ee,secondary:#7166ee">
                            </lord-icon>
                        </div>
                        <div>
                            <p>{{ $lastPayout ? $lastPayout->processed_at->format('M d, Y') : 'No payouts yet' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Royalty Dashboard Link -->
                <div class="row mb-4">
                    <div class="col-12 text-center">
                        <a href="{{ route('artist.royalty.index') }}" class="btn" style="background: linear-gradient(135deg, #b794f6, #9d50bb); color: white; padding: 15px 40px; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 1.1rem; display: inline-block;">
                            <i class="fas fa-chart-line"></i> View Full Royalty Dashboard
                        </a>
                    </div>
                </div>

                <!-- Monthly Chart -->
                <section class="secGraph">
                <div class="container">
                    <div class="dashboard">
                        <div class="graph-container">
                            <div class="graph-header">
                                <h2 class="graph-title">Monthly Earnings</h2>
                                <div class="time-filters">
                                    <button class="filter-btn" data-period="3">3M</button>
                                    <button class="filter-btn active" data-period="6">6M</button>
                                    <button class="filter-btn" data-period="12">1Y</button>
                                    <button class="filter-btn" data-period="all">All</button>
                                </div>
                            </div>

                            <div class="chart-wrapper">
                                <canvas id="earningsChart"></canvas>
                            </div>

                            <div class="earnings-summary">
                                <div class="summary-item">
                                    <div class="summary-label">Average Monthly</div>
                                    <div class="summary-value">${{ number_format($earningsData['average_monthly'] ?? 0, 0) }}</div>
                                    @if(isset($earningsData['growth_rate']) && $earningsData['growth_rate'] != 0)
                                    <div class="summary-change {{ ($earningsData['growth_rate'] ?? 0) > 0 ? 'positive' : '' }}">
                                        @if(($earningsData['growth_rate'] ?? 0) > 0)↑@elseif(($earningsData['growth_rate'] ?? 0) < 0)↓@endif
                                        {{ number_format(abs($earningsData['growth_rate'] ?? 0), 1) }}%
                                    </div>
                                    @else
                                    <div class="summary-change">No data</div>
                                    @endif
                                </div>
                                <div class="summary-item">
                                    <div class="summary-label">Highest Month</div>
                                    <div class="summary-value">${{ number_format($earningsData['highest_month_amount'] ?? 0, 0) }}</div>
                                    <div class="summary-change">{{ $earningsData['highest_month_name'] ?? 'N/A' }}</div>
                                </div>
                                <div class="summary-item">
                                    <div class="summary-label">Growth Rate</div>
                                    <div class="summary-value">{{ ($earningsData['growth_rate'] ?? 0) >= 0 ? '+' : '' }}{{ number_format($earningsData['growth_rate'] ?? 0, 0) }}%</div>
                                    <div class="summary-change {{ ($earningsData['growth_rate'] ?? 0) > 0 ? 'positive' : '' }}">↑ vs last period</div>
                                </div>
                                <div class="summary-item">
                                    <div class="summary-label">Total Revenue</div>
                                    <div class="summary-value">${{ number_format(($earningsData['total_revenue'] ?? 0) / 1000, 1) }}K</div>
                                    <div class="summary-change">Last 6 months</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </section>

                <!-- Payout Section -->
                <div class="payout-section py-4">
                    <h2>Request Payout</h2>
                    <button class="payout-btn" type="button" onclick="if(typeof window.openModall==='function'){window.openModall();}else{const modal=document.getElementById('withdrawModal');if(modal){modal.classList.add('active');document.body.style.overflow='hidden';}else{console.error('Withdraw modal not found');}}">Withdraw Funds</button>
                </div>
                <div class="withdrawalPayment_popup">
                    {{--<button class="demo-trigger" >Open Withdraw Funds</button>--}}
                    <div class="modal-overlay" id="withdrawModal">
                        <div class="modal">
                            <div class="modal-header">
                                <button class="modal-close" type="button" onclick="if(window.closeModall){window.closeModall();}else{console.error('closeModall function not available');}">×</button>
                                <h2 class="modal-title">Withdraw Funds</h2>
                                <p class="modal-subtitle">Request payout from your available balance</p>

                                <div class="balance-display">
                                    <div class="balance-label">Available Balance</div>
                                    <div class="balance-amount" id="availableBalance">${{ number_format($wallet->available_balance ?? 0, 2) }}</div>
                                </div>
                            </div>

                            <div class="modal-body">
                                <div id="withdrawForm">
                                    <div class="form-section">
                                        <label class="form-label required">Withdrawal Amount</label>
                                        <div class="input-wrapper">
                                            <span class="currency-symbol">$</span>
                                            <input
                                                type="number"
                                                class="form-input"
                                                id="withdrawAmount"
                                                placeholder="0.00"
                                                min="50"
                                                step="0.01"
                                            >
                                        </div>
                                        <p class="helper-text">Minimum withdrawal: $50.00</p>
                                        <p class="error-text" id="amountError">Please enter a valid amount</p>
                                        <button class="auto-fill-btn" type="button" onclick="if(window.fillFullBalance){window.fillFullBalance();}">Withdraw Full Balance</button>
                                    </div>

                                    <div class="form-section">
                                        <label class="form-label required">Payout Method</label>
                                        <select class="form-select" id="payoutMethod" onchange="if(window.updateAccountDetails){window.updateAccountDetails();}">
                                            <option value="">Select payout method</option>
                                            <option value="bank_transfer" {{ $paymentDetails && $paymentDetails->payment_method == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                            <option value="paypal" {{ $paymentDetails && $paymentDetails->payment_method == 'paypal' ? 'selected' : '' }}>PayPal</option>
                                            <option value="wise" {{ $paymentDetails && $paymentDetails->payment_method == 'wise' ? 'selected' : '' }}>Wise (TransferWise)</option>
                                        </select>

                                        <div class="account-info" id="accountInfo" style="display: {{ $paymentDetails ? 'block' : 'none' }};">
                                            @if($paymentDetails)
                                            <div class="account-info-row">
                                                <span class="account-info-label">Account:</span>
                                                <span class="account-info-value" id="accountDisplay">{{ $paymentDetails->masked_account_number }}</span>
                                            </div>
                                            <div class="account-info-row">
                                                <span class="account-info-label">Account Name:</span>
                                                <span class="account-info-value">{{ $paymentDetails->account_name ?? auth()->user()->name }}</span>
                                            </div>
                                            @if($paymentDetails->payment_method == 'paypal' && $paymentDetails->paypal_email)
                                            <div class="account-info-row">
                                                <span class="account-info-label">PayPal Email:</span>
                                                <span class="account-info-value">{{ substr($paymentDetails->paypal_email, 0, 3) }}***@{{ substr(strrchr($paymentDetails->paypal_email, '@'), 1) }}</span>
                                            </div>
                                            @endif
                                            @endif
                                        </div>

                                        <div class="mt-3">
                                            <button type="button" class="btn btn-secondary btn-sm" onclick="if(window.openPaymentDetailsModal){window.openPaymentDetailsModal();}else{console.error('openPaymentDetailsModal not available');}">
                                                <i class="fas fa-edit"></i> {{ $paymentDetails ? 'Update' : 'Add' }} Payment Details
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Payment Details Modal -->
                                    <div class="modal-overlay" id="paymentDetailsModal" style="display: none;">
                                        <div class="modal" style="max-width: 600px;">
                                            <div class="modal-header">
                                                <button class="modal-close" type="button" onclick="if(window.closePaymentDetailsModal){window.closePaymentDetailsModal();}">×</button>
                                                <h2 class="modal-title">{{ $paymentDetails ? 'Update' : 'Add' }} Payment Details</h2>
                                            </div>
                                            <div class="modal-body">
                                                <form id="paymentDetailsForm" action="{{ route('artist.payment-details.save') }}" method="POST">
                                                    @csrf
                                                    <div class="form-section">
                                                        <label class="form-label required">Payment Method</label>
                                                        <select class="form-select" name="payment_method" id="paymentMethodSelect" required onchange="if(window.togglePaymentFields){window.togglePaymentFields();}">
                                                            <option value="">Select method</option>
                                                            <option value="bank_transfer" {{ $paymentDetails && $paymentDetails->payment_method == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                                            <option value="paypal" {{ $paymentDetails && $paymentDetails->payment_method == 'paypal' ? 'selected' : '' }}>PayPal</option>
                                                            <option value="wise" {{ $paymentDetails && $paymentDetails->payment_method == 'wise' ? 'selected' : '' }}>Wise (TransferWise)</option>
                                                        </select>
                                                        <script>
                                                            // Initialize payment fields on page load if payment method is already selected
                                                            document.addEventListener('DOMContentLoaded', function() {
                                                                const select = document.getElementById('paymentMethodSelect');
                                                                if (select && select.value) {
                                                                    if (window.togglePaymentFields) {
                                                                        window.togglePaymentFields();
                                                                    }
                                                                }
                                                            });
                                                        </script>
                                                    </div>

                                                    <div class="form-section" id="bankFields" style="display: none;">
                                                        <label class="form-label required">Account Holder Name</label>
                                                        <input type="text" class="form-input" name="account_name" id="account_name" value="{{ $paymentDetails->account_name ?? '' }}" data-required="bank_transfer">

                                                        <label class="form-label required">Bank Name</label>
                                                        <input type="text" class="form-input" name="bank_name" id="bank_name" value="{{ $paymentDetails->bank_name ?? '' }}" data-required="bank_transfer">

                                                        <label class="form-label required">Account Number</label>
                                                        <input type="text" class="form-input" name="account_number" id="account_number" value="{{ $paymentDetails->account_number ?? '' }}" data-required="bank_transfer">

                                                        <label class="form-label">Routing/SWIFT Code</label>
                                                        <input type="text" class="form-input" name="routing_number" id="routing_number" value="{{ $paymentDetails->routing_number ?? '' }}">
                                                    </div>

                                                    <div class="form-section" id="paypalFields" style="display: none;">
                                                        <label class="form-label required">PayPal Email</label>
                                                        <input type="email" class="form-input" name="paypal_email" id="paypal_email" value="{{ $paymentDetails->paypal_email ?? '' }}" data-required="paypal">
                                                    </div>

                                                    <div class="form-section" id="wiseFields" style="display: none;">
                                                        <label class="form-label required">Wise Email</label>
                                                        <input type="email" class="form-input" name="wise_email" id="wise_email" value="{{ $paymentDetails->wise_email ?? '' }}" data-required="wise">
                                                    </div>

                                                    <div class="modal-actions">
                                                        <button type="button" class="btn btn-secondary" onclick="if(window.closePaymentDetailsModal){window.closePaymentDetailsModal();}">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Save Payment Details</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="info-card">
                                        <div class="info-card-title">Processing Information</div>
                                        <div class="info-item">
                                            <span class="info-label">Processing Time:</span>
                                            <span class="info-value">3–5 business days</span>
                                        </div>
                                        <div class="info-item">
                                            <span class="info-label">Platform Fee (2%):</span>
                                            <span class="info-value" id="platformFee">$0.00</span>
                                        </div>
                                        <div class="info-item">
                                            <span class="info-label">Net Amount:</span>
                                            <span class="info-value highlight" id="netAmount">$0.00</span>
                                        </div>
                                    </div>

                                    <div class="checkbox-wrapper">
                                        <input type="checkbox" id="confirmCheckbox">
                                        <label class="checkbox-label" for="confirmCheckbox">
                                            I confirm that the payout details are correct and understand that this withdrawal request cannot be cancelled once submitted.
                                        </label>
                                    </div>

                                    <div class="security-note">
                                        🔒 For your protection, withdrawals may be reviewed by our security team. Large withdrawals may require additional verification.
                                    </div>

                                    <div class="modal-actions">
                                        <button class="btn btn-secondary" type="button" onclick="if(window.closeModall){window.closeModall();}">Cancel</button>
                                        <button class="btn btn-primary" id="submitBtn" type="button" onclick="if(window.submitWithdrawal){window.submitWithdrawal();}">
                                            <span class="loading-spinner"></span>
                                            <span class="btn-text">Submit Withdrawal Request</span>
                                        </button>
                                    </div>
                                </div>

                                <div class="success-message" id="successMessage">
                                    <div class="success-icon">✅</div>
                                    <div class="success-title">Withdrawal Request Submitted!</div>
                                    <p class="success-text">
                                        Your withdrawal request of <strong id="successAmount">$0.00</strong> has been submitted successfully.
                                        The funds will be processed within 3–5 business days and sent to your selected payout method.
                                    </p>
                                    <button class="btn btn-primary" onclick="closeModall()" style="margin-top: 20px;">Done</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               {{--
                <div class="payment-popup">
                    <!-- <button class="withdraw-btn" >
                        Withdraw Funds
                    </button> -->
                    <div class="overlay" id="overlay" onclick="closePopup(event)">
                        <div class="popup" onclick="event.stopPropagation()">
                            <div class="popup-header">
                                <h2 class="popup-title">Withdraw Funds</h2>
                                <button class="close-btn" onclick="closePopup()">&times;</button>
                            </div>

                            <div class="amount-section">
                                <div class="amount-label">Amount to withdraw</div>
                                <input type="number" class="amount-input" placeholder="0.00" min="1" step="0.01">
                            </div>

                            <div class="payment-methods">
                                <div class="payment-method" onclick="selectMethod(this)">
                                    <div class="payment-icon paypal">PP</div>
                                    <div class="payment-info">
                                        <h3>PayPal</h3>
                                        <p>Instant transfer to your PayPal account</p>
                                    </div>
                                </div>

                                <div class="payment-method" onclick="selectMethod(this)">
                                    <div class="payment-icon cashapp">CA</div>
                                    <div class="payment-info">
                                        <h3>Cash App</h3>
                                        <p>Direct deposit to your Cash App</p>
                                    </div>
                                </div>

                                <!-- <div class="payment-method" onclick="selectMethod(this)">
                                    <div class="payment-icon venmo">V</div>
                                    <div class="payment-info">
                                        <h3>Venmo</h3>
                                        <p>Send to your Venmo account</p>
                                    </div>
                                </div> -->

                                <div class="payment-method" onclick="selectMethod(this)">
                                    <div class="payment-icon bank">BT</div>
                                    <div class="payment-info">
                                        <h3>Bank Transfer</h3>
                                        <p>2-3 business days to your bank</p>
                                    </div>
                                </div>

                                <!-- <div class="payment-method" onclick="selectMethod(this)">
                                    <div class="payment-icon crypto">₿</div>
                                    <div class="payment-info">
                                        <h3>Cryptocurrency</h3>
                                        <p>Bitcoin, Ethereum, or other crypto</p>
                                    </div>
                                </div> -->
                            </div>

                            <div class="withdraw-action">
                                <button class="btn-cancel" onclick="closePopup()">Cancel</button>
                                <button class="btn-confirm" onclick="processWithdraw()">Confirm Withdrawal</button>
                            </div>
                        </div>
                    </div>
                </div>
                --}}

                <!-- Payout History -->
                <div class="payout-history">
                    <h2 style="margin-bottom: 10px;">Payout History</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($payoutHistory as $payout)
                            <tr>
                                <td>{{ $payout['date'] }}</td>
                                <td>{{ $payout['amount'] }}</td>
                                <td>{{ $payout['status'] }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" style="text-align: center; color: #b8a8d0;">No payout history yet</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <a href="/payout-history">
                 <button class="payout-btn mt-4">View All</button>
                </a>
            </div>

            <!-- Recent Tips Section -->
            @if(isset($recentTips) && $recentTips->count() > 0)
            <div class="payout-history mt-4 container">
                <h2 style="margin-bottom: 10px;">💝 Recent Tips Received</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>From</th>
                            <th>Amount</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentTips as $tip)
                        <tr>
                            <td>{{ $tip->sent_to_artist_at->format('M d, Y') }}</td>
                            <td>{{ $tip->user->name }}</td>
                            <td style="color: #9f54f5; font-weight: 600;">£{{ number_format($tip->amount, 2) }}</td>
                            <td>{{ $tip->user_message ? Str::limit($tip->user_message, 50) : '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </section>
        <!-- uplaod section -->


        <!-- upload section -->
        <div class="container py-5">
            <div class="upload-container">
                <div class="upload-header mb-5">
                    <h2 style="text-align: center;">Upload Your Music & Videos</h2>
                    <!-- <p>Effortlessly upload to major platforms like YouTube, Spotify, iTunes, TikTok, and more.</p> -->
                </div>

                {{-- Success/Error messages will be shown via SweetAlert --}}

                <form method="POST" action="{{ route('artist.music.upload') }}" enctype="multipart/form-data" id="uploadForm">
                    @csrf

                    @if(isset($currentArtistPlan) && $currentArtistPlan)
                        @php
                            $currentMonthStart = now()->startOfMonth();
                            $currentMonthEnd = now()->endOfMonth();
                            $uploadsThisMonth = \App\Models\ArtistMusic::where('driver_id', auth()->id())
                                ->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
                                ->count();
                            $uploadLimit = $hasUnlimitedUploads ? null : ($songsPerMonth ?? 3);
                        @endphp
                        <div class="row justify-content-center mb-3">
                            <div class="col-md-8">
                                <div class="alert alert-info" style="background: rgba(183, 148, 246, 0.2); border: 1px solid rgba(183, 148, 246, 0.5); color: #fbfbfb; padding: 15px; border-radius: 8px; text-align: center;">
                                    @if($hasUnlimitedUploads)
                                        <strong>Unlimited Uploads</strong> - You can upload as many songs as you want this month.
                                    @else
                                        <strong>Upload Limit:</strong> {{ $uploadsThisMonth }}/{{ $uploadLimit }} songs this month
                                        @if($uploadsThisMonth >= $uploadLimit)
                                            <br><span style="color: #ff6b6b;">⚠️ You've reached your monthly limit. Upgrade to upload more!</span>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="row justify-content-center mb-4">
                        <div class="col-md-8">
                            <div class="upload-box" style="text-align: center; padding: 20px;">
                                <div style="color: white; margin-bottom: 15px; font-size: 18px; font-weight: 600;">
                                    🎵 Music Name *
                                </div>
                                <input type="text"
                                       class="form-control"
                                       id="musicName"
                                       name="name"
                                       placeholder="Enter your music/song name"
                                       value="{{ old('name') }}"
                                       required
                                       style="padding: 12px; border-radius: 8px; border: none; background: rgba(255, 255, 255, 0.1); color: white; font-size: 16px; text-align: center; width: 100%; max-width: 400px; margin: 0 auto;"
                                       onfocus="this.style.background='rgba(255, 255, 255, 0.2)'; this.style.outline='none';"
                                       onblur="this.style.background='rgba(255, 255, 255, 0.1)';">
                                @error('name')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                </div>

                {{-- ISRC Code Field (Only for Pro Artist and Certified Creator plans) --}}
                @php
                    $hasIsrcAccess = false;
                    if (Auth::check() && Auth::user()->is_artist) {
                        $hasIsrcAccess = Auth::user()->hasArtistFeature('isrc_codes');
                    }
                @endphp

                @if($hasIsrcAccess)
                <div class="row justify-content-center mb-4">
                    <div class="col-md-8">
                        <div class="upload-box" style="text-align: center; padding: 20px;">
                            <div style="color: white; margin-bottom: 15px; font-size: 18px; font-weight: 600;">
                                🎼 ISRC Code (Optional)
                            </div>
                            <input type="text"
                                   class="form-control"
                                   id="isrcCode"
                                   name="isrc_code"
                                   placeholder="Example: GXHE8-23-00001"
                                   value="{{ old('isrc_code') }}"
                                   maxlength="20"
                                   style="padding: 12px; border-radius: 8px; border: none; background: rgba(255, 255, 255, 0.1); color: white; font-size: 16px; text-align: center; width: 100%; max-width: 400px; margin: 0 auto; text-transform: uppercase;"
                                   oninput="this.value = this.value.toUpperCase().replace(/[^A-Z0-9\-]/g, '');"
                                   onfocus="this.style.background='rgba(255, 255, 255, 0.2)'; this.style.outline='none';"
                                   onblur="this.style.background='rgba(255, 255, 255, 0.1)';">
                            <small style="color: #b8a8d0; margin-top: 8px; display: block; font-size: 12px;">
                                Enter your International Standard Recording Code (e.g., GXHE8-23-00001)
                            </small>
                            @error('isrc_code')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                @else
                {{-- Show upgrade message for Starter Artist plan --}}
                <div class="row justify-content-center mb-4">
                    <div class="col-md-8">
                        <div class="upload-box" style="text-align: center; padding: 20px; background: rgba(183, 148, 246, 0.1); border: 1px dashed rgba(183, 148, 246, 0.5);">
                            <div style="color: #b8a8d0; margin-bottom: 10px; font-size: 14px;">
                                🎼 <strong>ISRC Codes</strong> are available for Pro Artist and Certified Creator plans
                            </div>
                            <a href="#subscription-plans" style="color: #b794f6; text-decoration: underline; font-size: 14px;">
                                Upgrade your plan to get ISRC codes assigned to your releases
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                <div class="row justify-content-center">
                    <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6 col-sm-12 py-4">
                            <div class="upload-box">
                            <div style="color: white;">🎵 Upload Music File *</div>
                                <input type="file" name="music_file" id="musicInput" accept="audio/*" style="display:none;" required />
                                <button type="button" class="upload-btn" id="musicSelectBtn" onclick="document.getElementById('musicInput').click();">
                                Select Music
                            </button>

                            <div id="musicPreviewContainer"
                                style="margin-top:15px; position:relative; display:inline-block;width: 100%;display: flex;justify-content: center;">
                                <audio id="musicPreview" controls style="display:none; border-radius:10px;"></audio>
                                    <button type="button" id="closeMusicBtn"
                                    style="display: block; position: absolute; top: -12px; right: 0px; background: #9f54f5; color: white; border: none; border-radius: 50%; width: 25px; height: 25px; cursor: pointer; display: flex; justify-content: center; align-items: center; display: none;">
                                    ×
                                </button>
                                </div>
                            </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6 col-sm-12 py-4">
                            <div class="upload-box">
                            <div style="color: white;">📹 Upload Video File (Optional)</div>
                                <input type="file" name="video_file" id="videoInput" accept="video/*" style="display: none;" />
                                <button type="button" class="upload-btn" id="videoSelectBtn" onclick="document.getElementById('videoInput').click();">
                                Select Video
                            </button>

                            <div id="previewContainer"
                                    style="margin-top:15px; position:relative; display:inline-block; width: 100%; display: flex; justify-content: center;">
                                <video id="videoPreview" width="300" controls
                                    style="display:none; border-radius:10px;"></video>
                                    <button type="button" id="closeBtn"
                                    style="position: absolute;top: -10px; right: 0px; background: rgb(137, 108, 179);color: white; border: none; border-radius: 50%; width: 29px; height: 29px; cursor: pointer; display: block; justify-content: center; align-items: baseline; display: none;">
                                    ×
                                </button>
                                </div>
                            </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6 col-sm-12 py-4">
                            <div class="upload-box">
                            <div style="color: white;">🖼️ Upload Thumbnail *</div>
                                <input type="file" name="thumbnail_image" id="thumbInput" accept="image/*" style="display:none;" required />
                                <button type="button" class="upload-btn" id="thumbSelectBtn" onclick="document.getElementById('thumbInput').click();">
                                Select Thumbnail
                            </button>

                            <div id="thumbPreviewContainer"
                                style="margin-top:15px; position:relative; display:flex; justify-content:center; width:100%;">
                                <img id="thumbPreview"
                                    style="display:none; max-width:200px; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,0.2);" />
                                    <button type="button" id="closeThumbBtn" style="display:none; position:absolute; top:-11px; right:0px;
                   background:#9f54f5; color:white; border:none; border-radius:50%;
                   width:25px; height:25px; cursor:pointer; display:flex;
                   justify-content:center; align-items:center; display: none;">
                                    ×
                                </button>
                            </div>
                            </div>
                        </div>
                            </div>

                    <div class="row justify-content-center mt-4">
                        <div class="col-12 text-center">
                            <button type="submit" class="upload-btn" style="padding: 15px 40px; font-size: 18px;  color: white; border: none; border-radius: 8px; cursor: pointer;">
                                Upload Files
                            </button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>


        <section class="artWork">
            <div class="container">
                <div class="header">
                    <h1>Artwork & Photo Upload</h1>
                    <p>Upload your album artwork, promotional photos, and graphics, so your visual identity shines just
                        as brightly as your music.</p>
                </div>

                {{-- Success/Error messages will be shown via SweetAlert --}}

                <form method="POST" action="{{ route('artist.artwork.upload') }}" enctype="multipart/form-data" id="artworkForm">
                    @csrf
                <div class="upload-area" id="uploadArea">
                    <div class="upload-icon">📁</div>
                    <div class="upload-text">Drag & drop your files here or</div>
                        <div class="upload-subtext">Support for multiple files (JPEG, PNG, GIF, WebP)</div>
                        <input type="file" id="fileInput" name="images[]" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp,image/avif" multiple style="display: none;" />
                    <button type="button" class="browse-btn" onclick="document.getElementById('fileInput').click();">
                        Browse Files
                    </button>

                    <div class="preview-gallery" id="previewGallery"></div>

                        <div class="text-center mt-4" id="uploadButtonContainer" style="display: none;">
                            <button type="submit" class="upload-btn" style="padding: 15px 40px; font-size: 18px;  color: white; border: none; border-radius: 8px; cursor: pointer;">
                                Upload Artwork
                            </button>
                        </div>
                </div>
                </form>
            </div>
        </section>

        <section class="artworkUploaded-Sec py-5">
            <div class="container">
                <div class="gallery-header">
                <h1>Our Uploaded Artwork</h1>
                    <p>A curated collection of artworks shared by creators.</p>

                </div>

                <div class="gallery-grid">
                    @forelse($artworkPhotos as $index => $artwork)
                        <div class="gallery-item gallery-item22" data-index="{{ $index }}">
                            <img src="{{ $artwork->image_url }}" alt="Artwork {{ $index + 1 }}" onerror="this.src='https://via.placeholder.com/400x400?text=Image+Not+Found'">
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">No artwork uploaded yet. Upload your first artwork above!</p>
                        </div>
                    @endforelse
                </div>
                <div>
                <a href="/all-artwork">
                    <button class="artAllBtn mt-4">View All</button>
                </a>
                </div>
            </div>

            <div class="modal" id="modal22">
                <div class="close-button" id="closeBtn22"></div>
                <div class="nav-button prev" id="prevBtn22"></div>
                <div class="nav-button next" id="nextBtn22"></div>
                <div class="modal-content">
                <img class="modal-image" id="modalImage22" src="" alt="">
                <div class="modal-info">
                    <div class="modal-title" id="modalTitle22"></div>
                    <div class="modal-subtitle" id="modalSubtitle22"></div>
                </div>
                </div>
            </div>
        </section>

        <section class="album-banner mb-5">
            <div class="container-fulid">
                <div class="album-image">
                    @php
                        // Get artist profile picture (same logic as profile-settings.blade.php)
                        $user = auth()->user();
                        $profile = $user->profile ?? null;

                        $avatar = 'https://via.placeholder.com/200x200?text=Artist';
                        if ($profile && !empty($profile->picture)) {
                            if (strpos($profile->picture, 'http') === 0) {
                                $avatar = $profile->picture;
                            } elseif (strpos($profile->picture, '/') === 0 && strpos($profile->picture, '/storage/') === 0) {
                                // Already has /storage/ prefix
                                $avatar = asset($profile->picture);
                            } elseif (strpos($profile->picture, 'storage/') === 0) {
                                $avatar = asset($profile->picture);
                            } elseif (strpos($profile->picture, 'artist_profiles/') === 0) {
                                // Path stored as artist_profiles/xxx.jpg
                                $avatar = asset('storage/' . $profile->picture);
                            } elseif (strpos($profile->picture, 'public/') === 0) {
                                // Remove public/ prefix if present
                                $avatar = asset(str_replace('public/', 'storage/', $profile->picture));
                            } else {
                                // Default: assume it needs storage/ prefix
                                $avatar = asset('storage/' . $profile->picture);
                            }
                        }
                    @endphp
                    <div class="back-img" style="background-image: url({{$avatar}}); position: relative;">

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6"></div>
                    <div class="col-lg-6">
                        <div class="album-details">
                            <div class="title">
    @php
        $totalListeners = \App\Models\ArtistMusic::where('driver_id', auth()->id())->sum('listeners');
        $formattedListeners = $totalListeners >= 1000000 ?
            round($totalListeners / 1000000, 1) . 'M' :
            ($totalListeners >= 1000 ? round($totalListeners / 1000, 1) . 'K' : $totalListeners);
    @endphp

    <h2 class="h1-title">{{ auth()->user()->name }}</h2>

    <!-- Monthly listeners + Edit profile + Logout in one line -->
    <div class="d-flex align-items-center justify-content-between mt-2">
        <div class="container">
        <div class="row listener_row">
        <div class="col-md-6">
            <span class="small-text">
                {{ $formattedListeners }} monthly listeners
            </span>
        </div>
        <div class="col-md-6">
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('artist.profile.edit') }}"
                class="btn"
                style="background: rgba(183,148,246,0.3); color:#b794f6; border:1px solid rgba(183,148,246,0.5); padding:8px 20px; border-radius:8px; text-decoration:none;">
                    <i class="fas fa-user-edit"></i> Edit Profile
                </a>
                <a href="{{ route('logout') }}"
                class="btn"
                onclick="event.preventDefault(); document.getElementById('artist-logout-form').submit();"
                style="background: rgba(220,53,69,0.3); color:#dc3545; border:1px solid rgba(220,53,69,0.5); padding:8px 20px; border-radius:8px; text-decoration:none; margin-right:5%;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
        </div>
        </div>
    </div>

    <form id="artist-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>


                            <div class="album-songs-detail">
                                <div class="popular-songs">
                                    <h4>popular songs</h4>
                                    <ul class="single-albums-list-box">
                                        @php
                                            // Get songs with most streams based on stream_stats table
                                            $topMusics = \App\Models\ArtistMusic::where('driver_id', auth()->id())
                                                ->withCount(['streamStats as total_streams' => function($query) {
                                                    $query->where('is_complete', 1);
                                                }])
                                                ->orderBy('total_streams', 'desc')
                                                ->orderBy('created_at', 'desc') // Secondary sort by date
                                                ->take(3)
                                                ->get();
                                        @endphp

                                        @forelse($topMusics as $index => $music)
                                            <li class="music-list-box {{ $index === 0 ? 'current_play' : '' }}">
                                            <div class="songs-name">
                                                <div class="back-img"
                                                        style="background-image: url({{ $music->thumbnail_image_url ?: 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgZmlsbD0iIzMzMzMzMyIvPjx0ZXh0IHg9IjUwJSIgeT0iNTAlIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiNmZmYiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj5NdXNpYzwvdGV4dD48L3N2Zz4=' }});">
                                                </div>
                                                <h3 class="h3-title">
                                                        {{ $music->name }}
                                                </h3>
                                            </div>
                                            <div class="audio-box ">
                                                <div class="music-controls play play_btn">
                                                        <div data-id="{{ $music->id }}" class="music-controls-item">
                                                        <i class="fas fa-play music-controls-item--icon play-icon"></i>
                                                        </div>
                                                </div>
                                            </div>
                                        </li>
                                        @empty
                                        <li class="music-list-box">
                                            <div class="songs-name">
                                                <div class="back-img"
                                                        style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgZmlsbD0iIzMzMzMzMyIvPjx0ZXh0IHg9IjUwJSIgeT0iNTAlIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiNmZmYiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj5NdXNpYzwvdGV4dD48L3N2Zz4=');">
                                                    </div>
                                                    <h3 class="h3-title">
                                                        No music uploaded yet
                                                    </h3>
                                            </div>
                                            <div class="audio-box ">
                                                <div class="music-controls play play_btn">
                                                        <div class="music-controls-item">
                                                            <i class="fas fa-plus music-controls-item--icon play-icon"></i>
                                                        </div>
                                                </div>
                                            </div>
                                        </li>
                                        @endforelse
                                    </ul>
                                    @if($topMusics->count() > 0)
                                    <div class="mt-3 text-end">
                                        <a href="{{ route('artist.my-music') }}" class="btn btn-sm" style="background: rgba(183,148,246,0.25); color:#b794f6; border-radius:20px; padding:6px 16px; text-decoration:none;">
                                            View All Songs
                                        </a>
                                    </div>
                                    @endif
                                </div>
                                <div class="similar-artists">
                                    <h4>latest songs</h4>
                                    <ul class="single-albums-list-box">
                                        @php
                                            // Get latest songs uploaded by the artist
                                            $latestMusics = \App\Models\ArtistMusic::where('driver_id', auth()->id())
                                                ->latest('created_at')
                                                ->take(3)
                                                ->get();
                                        @endphp

                                        @forelse($latestMusics as $index => $music)
                                            <li class="music-list-box {{ $index === 0 ? 'current_play' : '' }}">
                                            <div class="songs-name">
                                                <div class="back-img"
                                                        style="background-image: url({{ $music->thumbnail_image_url ?: 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgZmlsbD0iIzMzMzMzMyIvPjx0ZXh0IHg9IjUwJSIgeT0iNTAlIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiNmZmYiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj5NdXNpYzwvdGV4dD48L3N2Zz4=' }});">
                                                </div>
                                                <h3 class="h3-title">
                                                        {{ $music->name }}
                                                </h3>
                                            </div>
                                            <div class="audio-box ">
                                                <div class="music-controls play play_btn">
                                                        <div data-id="{{ $music->id }}" class="music-controls-item">
                                                        <i class="fas fa-play music-controls-item--icon play-icon"></i>
                                                        </div>
                                                </div>
                                            </div>
                                        </li>
                                        @empty
                                        <li class="music-list-box">
                                            <div class="songs-name">
                                                <div class="back-img"
                                                        style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgZmlsbD0iIzMzMzMzMyIvPjx0ZXh0IHg9IjUwJSIgeT0iNTAlIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiNmZmYiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj5NdXNpYzwvdGV4dD48L3N2Zz4=');">
                                                    </div>
                                                    <h3 class="h3-title">
                                                        No music uploaded yet
                                                    </h3>
                                            </div>
                                            <div class="audio-box ">
                                                <div class="music-controls play play_btn">
                                                        <div class="music-controls-item">
                                                            <i class="fas fa-plus music-controls-item--icon play-icon"></i>
                                                        </div>
                                                </div>
                                            </div>
                                        </li>
                                        @endforelse
                                    </ul>
                                    @if($latestMusics->count() > 0)
                                    <div class="mt-3 text-end">
                                        <a href="{{ route('artist.my-music') }}" class="btn btn-sm" style="background: rgba(183,148,246,0.25); color:#b794f6; border-radius:20px; padding:6px 16px; text-decoration:none;">
                                            View All Songs
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="music_content ">
                                @php
                                    $topMusic = \App\Models\ArtistMusic::where('driver_id', auth()->id())
                                        ->orderBy('listeners', 'desc')
                                        ->first();
                                @endphp
                                <div class="music-info">
                                    <h2 class="music-name">{{ $topMusic->name ?? 'No Music' }}</h2>
                                    <p class="music-artist">{{ auth()->user()->name }}</p>
                                </div>
                                <audio id="audio1" data-id="{{ $topMusic->id ?? 'default' }}" src="{{ $topMusic->music_file_url ?? '#' }}"></audio>
                                <div class="music-progress">
                                    <div id="progress-bar" class="music-progress-bar"></div>
                                    <div class="music-progress__time">
                                        <span class="music-progress__time-item music-current-time">00:00</span>
                                        <span class="music-progress__time-item music-duration-time">00:00</span>
                                    </div>
                                </div>
                                <div class="music-controls music-controls-single-albums">
                                    <div class="music-controls-item play">
                                        <i class="fas fa-play music-controls-item--icon play-icon"></i>
                                        <div class="play-icon-background"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>





        <!-- Track Collaboration Section -->
        <section class="collaboration-section py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="collaboration-header text-center mb-5">
                            <h2 style="color: #fbfbfb; font-size: 2.5rem; margin-bottom: 15px; font-weight: 700;">Track Collaborations & Revenue Split</h2>
                            <p style="color: #b8a8d0; font-size: 1.1rem;">Manage collaborative tracks and split ownership percentages for fair revenue distribution</p>
                        </div>

                        <!-- Create Collaboration Form -->
                        <div class="collaboration-card mb-4" style="background: #120b28; border: 1px solid rgba(183, 148, 246, 0.3); border-radius: 15px; padding: 30px; margin-bottom: 30px;">
                            <h3 style="color: #fbfbfb; font-weight: 500; margin-bottom: 20px; font-size: 1.8rem;">
                                <i class="fas fa-users" style="margin-right: 10px; color: #b794f6;"></i>
                                Create New Collaboration
                            </h3>

                            <form id="collaborationForm" method="POST" action="">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label style="color: #b8a8d0; margin-bottom: 8px; display: block;">Select Track *</label>
                                        <select name="music_id" id="collaboration_music_id" class="form-control" required style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(183, 148, 246, 0.3); color: #fbfbfb; padding: 12px; border-radius: 8px;">
                                            <option value="">-- Select a track --</option>
                                            @foreach($musics as $music)
                                                <option value="{{ $music->id }}" data-has-collab="{{ $music->collaboration ? '1' : '0' }}">
                                                    {{ $music->name }}
                                                    @if($music->collaboration)
                                                        <span style="color: #b794f6;">(Has Collaboration)</span>
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label style="color: #b8a8d0; margin-bottom: 8px; display: block;">Collaboration Type *</label>
                                        <select name="collaboration_type" id="collaboration_type" class="form-control" required style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(183, 148, 246, 0.3); color: #fbfbfb; padding: 12px; border-radius: 8px;">
                                            <option value="collaboration">Collaboration</option>
                                            <option value="feature">Feature</option>
                                            <option value="remix">Remix</option>
                                            <option value="producer">Producer</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Collaborators Section -->
                                <div class="collaborators-container">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <label style="color: #b8a8d0; font-size: 1.1rem; font-weight: 600;">Collaborators & Ownership Split</label>
                                        <button type="button" class="btn btn-sm" id="addCollaboratorBtn" style="background: #b794f6; color: white; border: none; padding: 8px 20px; border-radius: 6px; cursor: pointer;">
                                            <i class="fas fa-plus"></i> Add Collaborator
                                        </button>
                                    </div>

                                    <div id="collaboratorsList">
                                        <!-- Collaborators will be added dynamically here -->
                                    </div>

                                    <div class="ownership-summary mt-3" style="background: rgba(183, 148, 246, 0.1); padding: 15px; border-radius: 8px; border: 1px solid rgba(183, 148, 246, 0.3);">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <strong style="color: #b794f6;">Primary Artist (You):</strong>
                                                <span id="primaryArtistOwnership" style="color: #fbfbfb; font-size: 1.2rem; font-weight: bold; margin-left: 10px;">100%</span>
                                            </div>
                                            <div class="col-md-6">
                                                <strong style="color: #b794f6;">Total Collaborators Share:</strong>
                                                <span id="totalCollaboratorsShare" style="color: #fbfbfb; font-size: 1.2rem; font-weight: bold; margin-left: 10px;">0%</span>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div id="ownershipStatus" style="color: #f1c40f; font-weight: 600;"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn" id="submitCollaborationBtn" style="background: linear-gradient(135deg, #b794f6, #9d50bb); color: white; border: none; padding: 12px 40px; font-size: 1.1rem; border-radius: 8px; cursor: pointer; font-weight: 600;">
                                        <i class="fas fa-save"></i> Create Collaboration
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Existing Collaborations -->
                        <div class="collaborations-list">
                            <h3 style="color: #fbfbfb; margin-bottom: 25px; font-size: 1.8rem;">
                                <i class="fas fa-list" style="margin-right: 10px; color: #b794f6;"></i>
                                My Collaborations
                            </h3>

                            @forelse($collaborations as $collaboration)
                                <div class="collaboration-item mb-4" style="background: rgba(45, 27, 78, 0.6); border: 1px solid rgba(183, 148, 246, 0.3); border-radius: 15px; padding: 25px;">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <h4 style="color: #fbfbfb; margin-bottom: 10px;">
                                                <i class="fas fa-music" style="color: #b794f6; margin-right: 10px;"></i>
                                                {{ $collaboration->music->name }}
                                            </h4>
                                            <div style="color: #b8a8d0; margin-bottom: 15px;">
                                                <span class="badge" style="background: rgba(183, 148, 246, 0.3); color: #b794f6; padding: 5px 12px; border-radius: 20px; margin-right: 10px;">
                                                    {{ ucfirst($collaboration->collaboration_type) }}
                                                </span>
                                                <span class="badge" style="background: {{ $collaboration->status === 'active' ? 'rgba(0, 242, 254, 0.3)' : 'rgba(241, 196, 15, 0.3)' }}; color: {{ $collaboration->status === 'active' ? '#00f2fe' : '#f1c40f' }}; padding: 5px 12px; border-radius: 20px;">
                                                    {{ ucfirst($collaboration->status) }}
                                                </span>
                                            </div>

                                            <!-- Ownership Splits -->
                                            <div class="ownership-splits mt-3">
                                                <h5 style="color: #b794f6; font-size: 1rem; margin-bottom: 10px;">Ownership Distribution:</h5>
                                                <div class="row">
                                                    @foreach($collaboration->ownershipSplits as $split)
                                                        <div class="col-md-6 mb-2">
                                                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 8px; background: rgba(183, 148, 246, 0.1); border-radius: 6px;">
                                                                <span style="color: #fbfbfb;">
                                                                    {{ $split->artist->name }}
                                                                    @if($split->is_primary)
                                                                        <span style="color: #b794f6;">(Primary)</span>
                                                                    @endif
                                                                </span>
                                                                <span style="color: #b794f6; font-weight: bold; font-size: 1.1rem;">
                                                                    {{ number_format($split->ownership_percentage, 2) }}%
                                                                </span>
                                                            </div>
                                                            @if(!$split->is_primary && !$split->approved_by_artist && $split->artist_id === auth()->id())
                                                                <form method="POST" action="{{ route('artist.collaborations.approve-split', ['collaborationId' => $collaboration->id, 'splitId' => $split->id]) }}" style="display: inline; margin-top: 5px;">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-sm" style="background: #00f2fe; color: #0f0c29; border: none; padding: 5px 15px; border-radius: 5px; font-size: 0.85rem;">
                                                                        Approve
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 text-end">
                                            <!-- Revenue Summary -->
                                            @php
                                                $userRevenue = $collaboration->revenueDistributions->where('artist_id', auth()->id())->sum('artist_share_after_split');
                                                $userOwnership = $collaboration->ownershipSplits->where('artist_id', auth()->id())->first()->ownership_percentage ?? 0;
                                            @endphp
                                            <div style="background: rgba(0, 242, 254, 0.1); padding: 15px; border-radius: 8px; border: 1px solid rgba(0, 242, 254, 0.3);">
                                                <div style="color: #b8a8d0; font-size: 0.9rem; margin-bottom: 5px;">Your Ownership</div>
                                                <div style="color: #00f2fe; font-size: 1.5rem; font-weight: bold; margin-bottom: 10px;">
                                                    {{ number_format($userOwnership, 2) }}%
                                                </div>
                                                <div style="color: #b8a8d0; font-size: 0.9rem; margin-bottom: 5px;">Total Earnings</div>
                                                <div style="color: #fbfbfb; font-size: 1.3rem; font-weight: bold;">
                                                    ${{ number_format($userRevenue, 2) }}
                                                </div>
                                            </div>

                                            <a href="{{ route('artist.collaborations.show', $collaboration->id) }}" class="btn mt-3" style="background: rgba(183, 148, 246, 0.3); color: #b794f6; border: 1px solid rgba(183, 148, 246, 0.5); padding: 8px 20px; border-radius: 6px; text-decoration: none; display: inline-block; width: 100%;">
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5" style="background: #120b28; border: 1px solid rgba(183, 148, 246, 0.3); border-radius: 15px; padding: 40px;">
                                    <i class="fas fa-users" style="font-size: 3rem; color: #b794f6; margin-bottom: 20px; opacity: 0.5;"></i>
                                    <p style="color: #b8a8d0; font-size: 1.1rem;">No collaborations yet. Create your first collaboration above!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <!-- Current Subscription Plan Display -->
        @if(auth()->check() && auth()->user()->is_artist && isset($artistSubscriptionFeatures) && is_array($artistSubscriptionFeatures))
        <section class="section p-0">
            <div class="container">
            <div style="background: #120b28; border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 12px; padding: 20px;">
                <h3 style="color: #b794f6; margin-bottom: 15px; font-size: 1.2rem;">
                    <i class="fas fa-star" style="margin-right: 8px;"></i>Your Current Plan Features
                    @if(isset($currentArtistPlan) && $currentArtistPlan)
                        <span style="color: #fff; font-size: 0.9rem; font-weight: normal;">({{ $currentArtistPlan->plan_name }})</span>
                    @else
                        <span style="color: #fff; font-size: 0.9rem; font-weight: normal;">(Starter Artist - Free)</span>
                    @endif
                </h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                    <div style="color: #fff;">
                        <strong style="color: #b794f6;">Uploads:</strong>
                        @if($artistSubscriptionFeatures['unlimited_uploads'])
                            Unlimited
                        @else
                            {{ $artistSubscriptionFeatures['songs_per_month'] }} per month
                        @endif
                    </div>
                    @if($artistSubscriptionFeatures['featured_rotation'])
                        <div style="color: #fff;">
                            <strong style="color: #b794f6;">Featured Rotation:</strong>
                            {{ $artistSubscriptionFeatures['featured_rotation_weeks'] }} week{{ $artistSubscriptionFeatures['featured_rotation_weeks'] > 1 ? 's' : '' }}/month
                        </div>
                    @endif
                    @if($artistSubscriptionFeatures['priority_search'])
                        <div style="color: #fff;">
                            <strong style="color: #b794f6;">Search:</strong>
                            <span style="color: #10b981;">✓ Priority Placement</span>
                        </div>
                    @endif
                    @if($artistSubscriptionFeatures['custom_banner'])
                        <div style="color: #fff;">
                            <strong style="color: #b794f6;">Banner:</strong>
                            <span style="color: #10b981;">✓ Custom Banner</span>
                        </div>
                    @endif
                    @if($artistSubscriptionFeatures['isrc_codes'])
                        <div style="color: #fff;">
                            <strong style="color: #b794f6;">ISRC Codes:</strong>
                            <span style="color: #10b981;">✓ Enabled</span>
                        </div>
                    @endif
                    @if($artistSubscriptionFeatures['early_access_insights'])
                        <div style="color: #fff;">
                            <strong style="color: #b794f6;">Insights:</strong>
                            <span style="color: #10b981;">✓ Early Access</span>
                        </div>
                    @endif
                    @if($artistSubscriptionFeatures['certified_badge'])
                        <div style="color: #fff;">
                            <strong style="color: #b794f6;">Badge:</strong>
                            <span style="color: #fbbf24;">⭐ Certified Creator</span>
                        </div>
                    @endif
                    @if($artistSubscriptionFeatures['showcase_placement'])
                        <div style="color: #fff;">
                            <strong style="color: #b794f6;">Showcase:</strong>
                            <span style="color: #10b981;">✓ Featured</span>
                        </div>
                    @endif
                    @if($artistSubscriptionFeatures['royalty_tracking'])
                        <div style="color: #fff;">
                            <strong style="color: #b794f6;">Royalty Tracking:</strong>
                            <span style="color: #10b981;">✓ Enabled</span>
                        </div>
                    @endif
                    @if($artistSubscriptionFeatures['playlist_highlighted'])
                        <div style="color: #fff;">
                            <strong style="color: #b794f6;">Playlists:</strong>
                            <span style="color: #10b981;">✓ Highlighted</span>
                        </div>
                    @endif
                    @if($artistSubscriptionFeatures['advanced_analytics'])
                        <div style="color: #fff;">
                            <strong style="color: #b794f6;">Analytics:</strong>
                            <span style="color: #10b981;">✓ Advanced</span>
                        </div>
                    @endif
                    @if($artistSubscriptionFeatures['showcase_invitations'])
                        <div style="color: #fff;">
                            <strong style="color: #b794f6;">Invitations:</strong>
                            <span style="color: #10b981;">✓ Enabled</span>
                        </div>
                    @endif
                    @if($artistSubscriptionFeatures['profile_customization'])
                        <div style="color: #fff;">
                            <strong style="color: #b794f6;">Profile:</strong>
                            <span style="color: #10b981;">✓ Customization</span>
                        </div>
                    @endif
                </div>
            </div>
            </div>
        </section>
        @endif

        <!-- Certified Creator Application Section -->
        @if(auth()->check() && auth()->user()->is_artist)
        <section class="section py-4">
            <div class="container">
                <div style="background: #120b28; border: 1px solid rgba(183, 148, 246, 0.35); border-radius: 16px; padding: 25px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; gap: 15px; flex-wrap: wrap; margin-bottom: 20px;">
                        <h3 style="color: #f2e9ff; font-size: 1.4rem; margin: 0; font-weight: 700;">
                            <i class="fas fa-shield-check" style="color: #b794f6; margin-right: 8px;"></i>
                            Apply As Certified Creator
                        </h3>

                        @if(auth()->user()->is_certified_creator)
                            <span style="display: inline-block; background: linear-gradient(135deg, #10b981, #059669); color: #fff; font-size: 0.8rem; font-weight: 700; padding: 7px 14px; border-radius: 999px;">
                                ✓ You are a Certified Creator
                            </span>
                        @elseif(isset($certifiedCreatorRequest) && $certifiedCreatorRequest)
                            @if($certifiedCreatorRequest->status === 'pending')
                                <span style="display: inline-block; background: linear-gradient(135deg, #f59e0b, #d97706); color: #fff; font-size: 0.8rem; font-weight: 700; padding: 7px 14px; border-radius: 999px;">
                                    Pending Admin Review
                                </span>
                            @elseif($certifiedCreatorRequest->status === 'approved')
                                <span style="display: inline-block; background: linear-gradient(135deg, #10b981, #059669); color: #fff; font-size: 0.8rem; font-weight: 700; padding: 7px 14px; border-radius: 999px;">
                                    Approved
                                </span>
                            @else
                                <span style="display: inline-block; background: linear-gradient(135deg, #ef4444, #b91c1c); color: #fff; font-size: 0.8rem; font-weight: 700; padding: 7px 14px; border-radius: 999px;">
                                    Rejected - You Can Reapply
                                </span>
                            @endif
                        @endif
                    </div>

                    <p style="color: #c7b7df; margin-bottom: 20px;">
                        Submit your KYC and supporting documents with a short reason. Admin will review and approve your request.
                    </p>

                    @if(isset($certifiedCreatorRequest) && $certifiedCreatorRequest && $certifiedCreatorRequest->status === 'rejected' && $certifiedCreatorRequest->admin_notes)
                        <div style="background: rgba(239, 68, 68, 0.12); border: 1px solid rgba(239, 68, 68, 0.35); border-radius: 10px; padding: 12px 15px; color: #ffd3d3; margin-bottom: 18px;">
                            <strong>Admin Notes:</strong> {{ $certifiedCreatorRequest->admin_notes }}
                        </div>
                    @endif

                    <form action="{{ route('artist.certified-creator.apply') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label style="color: #e8dcff; font-weight: 600; margin-bottom: 8px; display: block;">KYC Document <span style="color: #fca5a5;">*</span></label>
                                <input type="file" name="kyc_document" accept=".pdf,.jpg,.jpeg,.png" required
                                    style="width: 100%; background: rgba(255,255,255,0.07); border: 1px solid rgba(183,148,246,0.35); border-radius: 10px; color: #fff; padding: 12px;">
                                @error('kyc_document')
                                    <small style="color: #fca5a5;">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label style="color: #e8dcff; font-weight: 600; margin-bottom: 8px; display: block;">Supporting Document</label>
                                <input type="file" name="supporting_document" accept=".pdf,.jpg,.jpeg,.png"
                                    style="width: 100%; background: rgba(255,255,255,0.07); border: 1px solid rgba(183,148,246,0.35); border-radius: 10px; color: #fff; padding: 12px;">
                                @error('supporting_document')
                                    <small style="color: #fca5a5;">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label style="color: #e8dcff; font-weight: 600; margin-bottom: 8px; display: block;">Reason For Applying <span style="color: #fca5a5;">*</span></label>
                                <textarea name="reason" rows="4" required placeholder="Tell admin why you should be approved as a Certified Creator..."
                                    style="width: 100%; background: rgba(255,255,255,0.07); border: 1px solid rgba(183,148,246,0.35); border-radius: 10px; color: #fff; padding: 12px;">{{ old('reason') }}</textarea>
                                @error('reason')
                                    <small style="color: #fca5a5;">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12">
                                <button type="submit"
                                    {{ (isset($certifiedCreatorRequest) && $certifiedCreatorRequest && $certifiedCreatorRequest->status === 'pending') ? 'disabled' : '' }}
                                    style="background: linear-gradient(135deg, #8b5cf6, #6d28d9); color: #fff; border: none; border-radius: 10px; padding: 12px 22px; font-weight: 700; {{ (isset($certifiedCreatorRequest) && $certifiedCreatorRequest && $certifiedCreatorRequest->status === 'pending') ? 'opacity: 0.6; cursor: not-allowed;' : '' }}">
                                    Submit Certified Creator Request
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        @endif

        <!-- Artist Subscription Plans Section -->
        <section class="artist-subscription-plans-section py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center mb-3">
                            <h2 style="color: #fbfbfb; font-size: 2.5rem; margin-bottom: 15px; font-weight: 800;">Artist Subscription Plans</h2>
                            <p style="color: #b8a8d0; font-size: 1.1rem;">Choose the perfect plan to grow your music career</p>
                        </div>

                        @if(auth()->check() && auth()->user()->is_artist)
                            @if(isset($currentArtistPlan) && $currentArtistPlan)
                                <div class="current-plan-badge" style="background: #16002d; border: 2px solid rgb(157 106 245); border-radius: 50px; padding: 5px 10px; margin-bottom: 62px; max-width: 200px; margin: 0 auto 62px auto; text-align: center;">
                                    <div style="color: #b794f6; font-weight: 600; font-size: 0.9rem;">Current Plan</div>
                                    <div style="color: #fff; font-size: 1rem; font-weight: 700;">
                                        {{ $currentArtistPlan->plan_name ?? 'Starter Artist' }}
                                        @if(isset($currentArtistPlan->is_certified_badge) && $currentArtistPlan->is_certified_badge)
                                            <span class="certified-badge" style="display: inline-block; background: linear-gradient(135deg, #fbbf24, #f59e0b); color: #fff; font-size: 0.7rem; padding: 3px 8px; border-radius: 12px; margin-left: 8px; font-weight: 600;">
                                                ⭐ Certified
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="current-plan-badge" style="background: #16002d; border: 2px solid rgba(139, 92, 246, 0.5); border-radius: 12px; padding: 15px 20px; margin-bottom: 30px; text-align: center;">
                                    <div style="color: #b794f6; font-weight: 600; font-size: 0.9rem; margin-bottom: 5px;">Current Plan</div>
                                    <div style="color: #fff; font-size: 1.3rem; font-weight: 700;">
                                        Starter Artist (Free)
                                    </div>
                                </div>
                            @endif
                        @endif

                        <div class="row justify-content-center">
                            @foreach($artist_plans as $index => $plan)
                                @php
                                    $isPopular = $plan->plan_slug == 'pro-artist';
                                    // Check if this is the current plan
                                    $isCurrentPlan = false;

                                    // If we have a current subscription and plan, compare by ID
                                    if (isset($currentArtistSubscription) && $currentArtistSubscription && isset($currentArtistPlan) && $currentArtistPlan && isset($currentArtistPlan->id)) {
                                        // User has an active subscription - compare by plan ID
                                        $isCurrentPlan = ($currentArtistPlan->id == $plan->id);
                                    } else {
                                        // No active subscription - check if this is the free/starter plan
                                        // This handles both cases: when currentArtistPlan is set (free plan found) or when it's null
                                        if (isset($currentArtistPlan) && $currentArtistPlan && isset($currentArtistPlan->id)) {
                                            // Free plan was found and set - compare by ID
                                            $isCurrentPlan = ($currentArtistPlan->id == $plan->id);
                                        } else {
                                            // No subscription and free plan not found - check if this plan is free/starter
                                            $isCurrentPlan = ($plan->monthly_fee == 0 || $plan->plan_slug == 'starter-artist' || (isset($plan->plan_name) && stripos($plan->plan_name, 'Starter') !== false));
                                        }
                                    }
                                @endphp
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="artist-plan-card" style="background: #16002d; border: 1px solid rgba(183, 148, 246, 0.3); border-radius: 15px; padding: 30px; height: 100%; position: relative; transition: transform 0.3s ease; {{ $isPopular ? 'border: 2px solid #b794f6; transform: scale(1.05);' : '' }}">
                                        @if($isCurrentPlan)
                                            <div style="position: absolute; top: -15px; right: 20px; background: linear-gradient(135deg, #8b5cf6, #a855f7); color: white; padding: 8px 20px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4); z-index: 10;">
                                                ✓ Current Plan
                                            </div>
                                        @elseif($isPopular)
                                            <div style="position: absolute; top: -15px; right: 20px; background: linear-gradient(135deg, #b794f6, #9d50bb); color: white; padding: 8px 20px; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">Most Popular</div>
                                        @endif

                                        <div class="text-center mb-4">
                                            <h3 style="color: #ccc; font-size: 1.8rem; margin-bottom: 10px; font-weight: bold;">{{ $plan->plan_name }}</h3>
                                            @if($plan->ideal_for)
                                                <p style="color: #b8a8d0; font-size: 0.95rem; margin-bottom: 15px;">{{ $plan->ideal_for }}</p>
                                            @endif
                                            <div style="color: #b794f6; font-size: 2.5rem; font-weight: bold; margin-bottom: 5px;">
                                                @if($plan->monthly_fee > 0)
                                                    {{ $plan->currency }} {{ number_format($plan->monthly_fee, 2) }}
                                                @else
                                                    Free
                                                @endif
                                            </div>
                                            <div style="color: #b8a8d0; font-size: 0.9rem;">per month</div>
                                        </div>

                                        <ul class="artistPlansCards" style="list-style: none; padding: 0; margin: 25px 0; min-height: 300px; height: 330px; overflow-y: auto; padding-right: 10px;">
                                            @if($plan->songs_per_month)
                                                <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1); display: flex !important; align-items: baseline !important;">
                                                    <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                                    Upload up to {{ $plan->songs_per_month }} songs per month
                                                </li>
                                            @elseif($plan->is_unlimited_uploads)
                                                <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1); display: flex !important; align-items: baseline !important;">
                                                    <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                                    Unlimited song uploads
                                                </li>
                                            @endif

                                            <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1); display: flex !important; align-items: baseline !important;">
                                                <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                                Access to community feed & comments
                                            </li>

                                            <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1); display: flex !important; align-items: baseline !important;">
                                                <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                                Basic analytics (plays, likes, shares)
                                            </li>

                                            <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1); display: flex !important; align-items: baseline !important;">
                                                <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                                Profile customization tools
                                            </li>

                                            @if($plan->is_featured_rotation)
                                                <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1); display: flex !important; align-items: baseline !important;">
                                                    <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                                    Featured on front page rotation ({{ $plan->featured_rotation_weeks }} week{{ $plan->featured_rotation_weeks > 1 ? 's' : '' }}/month)
                                                </li>
                                            @endif

                                            @if($plan->is_priority_search)
                                                <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1); display: flex !important; align-items: baseline !important;">
                                                    <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                                    Priority placement in search results
                                                </li>
                                            @endif

                                            @if($plan->is_custom_banner)
                                                <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1); display: flex !important; align-items: baseline !important;">
                                                    <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                                    Custom banner/profile cover
                                                </li>
                                            @endif

                                            @if($plan->is_isrc_codes)
                                                <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1); display: flex !important; align-items: baseline !important;">
                                                    <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                                    ISRC codes assigned to each release
                                                </li>
                                            @endif

                                            @if($plan->is_early_access_insights)
                                                <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1); display: flex !important; align-items: baseline !important;">
                                                    <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                                    Early access to platform insights & music trends
                                                </li>
                                            @endif

                                            @if($plan->is_certified_badge)
                                                <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1); display: flex !important; align-items: baseline !important;">
                                                    <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                                    "Certified Creator" badge on profile
                                                </li>
                                            @endif

                                            @if($plan->is_showcase_placement)
                                                <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1); display: flex !important; align-items: baseline !important;">
                                                    <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                                    Placement in Certified Creators Showcase
                                                </li>
                                            @endif

                                            @if($plan->is_royalty_tracking)
                                                <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1); display: flex !important; align-items: baseline !important;">
                                                    <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                                    Official royalty tracking with ISRC integration
                                                </li>
                                            @endif

                                            @if($plan->is_playlist_highlighted)
                                                <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1); display: flex !important; align-items: baseline !important;">
                                                    <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                                    Highlighted inclusion in curated playlists
                                                </li>
                                            @endif

                                            @if($plan->is_advanced_analytics)
                                                <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1); display: flex !important; align-items: baseline !important;">
                                                    <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                                    Advanced analytics (listener demographics, regional data)
                                                </li>
                                            @endif

                                            @if($plan->is_showcase_invitations)
                                                <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1); display: flex !important; align-items: baseline !important;">
                                                    <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                                    Invitations to online showcases, collaborations & promo campaigns
                                                </li>
                                            @endif
                                        </ul>

                                        <div class="text-center mt-4">
                                            @if($isCurrentPlan)
                                                <button class="btn" disabled style="background: rgba(183, 148, 246, 0.2); color: #b794f6; border: 1px solid rgba(183, 148, 246, 0.5); padding: 12px 30px; border-radius: 8px; font-weight: 600; width: 100%; cursor: not-allowed; opacity: 0.7;">
                                                    <i class="fas fa-check-circle" style="margin-right: 5px;"></i>Current Plan
                                                </button>
                                            @else
                                                <button onclick="openArtistPortalSubscriptionPopup('{{ $plan->id }}', '{{ $plan->plan_name }}', '{{ $plan->monthly_fee }}', 'per month')" class="btn" style="background: {{ $isPopular ? 'linear-gradient(135deg, #b794f6, #9d50bb)' : 'rgba(183, 148, 246, 0.3)' }}; color: white; border: 1px solid rgba(183, 148, 246, 0.5); padding: 12px 30px; border-radius: 8px; text-decoration: none; display: inline-block; font-weight: 600; width: 100%; cursor: pointer;">
                                                    {{ $plan->monthly_fee > 0 ? 'Subscribe Now' : 'Get Started' }}
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                console.log("DOM loaded, initializing file upload functionality...");

                // File upload preview functionality
                const musicInput = document.getElementById("musicInput");
                const musicPreview = document.getElementById("musicPreview");
                const closeMusicBtn = document.getElementById("closeMusicBtn");

                const videoInput = document.getElementById("videoInput");
                const videoPreview = document.getElementById("videoPreview");
                const closeBtn = document.getElementById("closeBtn");

                const thumbInput = document.getElementById("thumbInput");
                const thumbPreview = document.getElementById("thumbPreview");
                const closeThumbBtn = document.getElementById("closeThumbBtn");

                console.log("Elements found:", {
                    musicInput: !!musicInput,
                    videoInput: !!videoInput,
                    thumbInput: !!thumbInput
                });

                if (musicInput) {
                    console.log("Setting up music input handler");
                    musicInput.addEventListener("change", function(e) {
                        console.log("Music file selected");
                        const file = e.target.files[0];
                        if (file) {
                            console.log("Music file:", file.name, file.type);
                            const url = URL.createObjectURL(file);
                            if (musicPreview) {
                                musicPreview.src = url;
                                musicPreview.style.display = "block";
                            }
                            if (closeMusicBtn) {
                                closeMusicBtn.style.display = "flex";
                            }
                        }
                    });

                    if (closeMusicBtn) {
                        closeMusicBtn.addEventListener("click", function(e) {
                            e.preventDefault();
                            console.log("Closing music preview");
                            if (musicPreview) {
                                musicPreview.pause();
                                musicPreview.src = "";
                                musicPreview.style.display = "none";
                            }
                            closeMusicBtn.style.display = "none";
                            musicInput.value = "";
                        });
                    }
                }

                // Video file handling
                if (videoInput) {
                    console.log("Setting up video input handler");
                    videoInput.addEventListener("change", function(e) {
                        console.log("Video file selected");
                        const file = e.target.files[0];
                        if (file) {
                            console.log("Video file:", file.name, file.type);
                            const url = URL.createObjectURL(file);
                            if (videoPreview) {
                                videoPreview.src = url;
                                videoPreview.style.display = "block";
                            }
                            if (closeBtn) {
                                closeBtn.style.display = "flex";
                            }
                        }
                    });

                    if (closeBtn) {
                        closeBtn.addEventListener("click", function(e) {
                            e.preventDefault();
                            console.log("Closing video preview");
                            if (videoPreview) {
                                videoPreview.pause();
                                videoPreview.src = "";
                                videoPreview.style.display = "none";
                            }
                            closeBtn.style.display = "none";
                            videoInput.value = "";
                        });
                    }
                }

                // Thumbnail file handling
                if (thumbInput) {
                    console.log("Setting up thumbnail input handler");
                    thumbInput.addEventListener("change", function(e) {
                        console.log("Thumbnail file selected");
                        const file = e.target.files[0];
                        if (file) {
                            console.log("Thumbnail file:", file.name, file.type);
                            const url = URL.createObjectURL(file);
                            if (thumbPreview) {
                                thumbPreview.src = url;
                                thumbPreview.style.display = "block";
                            }
                            if (closeThumbBtn) {
                                closeThumbBtn.style.display = "flex";
                            }
                        }
                    });

                    if (closeThumbBtn) {
                        closeThumbBtn.addEventListener("click", function(e) {
                            e.preventDefault();
                            console.log("Closing thumbnail preview");
                            if (thumbPreview) {
                                thumbPreview.src = "";
                                thumbPreview.style.display = "none";
                            }
                            closeThumbBtn.style.display = "none";
                            thumbInput.value = "";
                        });
                    }
                }

                // Form submission with AJAX and SweetAlert
                // Check upload limits before form submission
                @if(isset($currentArtistPlan) && $currentArtistPlan)
                    const uploadLimit = {{ $uploadLimit ?: 'null' }};
                    const uploadsThisMonth = {{ $uploadsThisMonth }};
                    const hasUnlimitedUploads = {{ $hasUnlimitedUploads ? 'true' : 'false' }};
                @else
                    const uploadLimit = 3; // Default free tier
                    const uploadsThisMonth = {{ isset($uploadsThisMonth) ? $uploadsThisMonth : 0 }};
                    const hasUnlimitedUploads = false;
                @endif

                const uploadForm = document.getElementById("uploadForm");
                if (uploadForm) {
                    console.log("Setting up form submission handler");
                    uploadForm.addEventListener("submit", function(e) {
                        e.preventDefault();
                        console.log("Form submitted");

                        // Validate required fields
                        const musicName = document.getElementById("musicName").value.trim();
                        const musicFile = document.getElementById("musicInput").files.length;
                        const thumbnailFile = document.getElementById("thumbInput").files.length;

                        if (!musicName) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                text: 'Please enter a music name.',
                                confirmButtonColor: '#9f54f5',
                                background: '#1a1a1a',
                                color: 'white',
                                confirmButtonText: 'OK'
                            });
                            return false;
                        }

                        if (musicFile === 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                text: 'Please select a music file.',
                                confirmButtonColor: '#9f54f5',
                                background: '#1a1a1a',
                                color: 'white',
                                confirmButtonText: 'OK'
                            });
                            return false;
                        }

                        // Check upload limit
                        if (!hasUnlimitedUploads && uploadLimit !== null) {
                            if (uploadsThisMonth >= uploadLimit) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Upload Limit Reached',
                                    html: `You have reached your monthly upload limit of ${uploadLimit} songs.<br><br>Current uploads this month: ${uploadsThisMonth}/${uploadLimit}<br><br>Please upgrade your plan to upload more songs.`,
                                    confirmButtonColor: '#9f54f5',
                                    background: '#1a1a1a',
                                    color: 'white',
                                    confirmButtonText: 'OK'
                                });
                                return false;
                            }
                        }

                        if (thumbnailFile === 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                text: 'Please select a thumbnail image.',
                                confirmButtonColor: '#9f54f5',
                                background: '#1a1a1a',
                                color: 'white',
                                confirmButtonText: 'OK'
                            });
                            return false;
                        }

                        const submitBtn = this.querySelector('button[type="submit"]');
                        const originalText = submitBtn.innerHTML;

                        // Show loading state
                        submitBtn.innerHTML = 'Uploading...';
                        submitBtn.disabled = true;

                        // Create FormData
                        const formData = new FormData(this);

                        // Submit via AJAX
                        fetch(this.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: 'Music uploaded successfully!',
                                    confirmButtonColor: '#9f54f5',
                                    background: '#1a1a1a',
                                    color: 'white',
                                    confirmButtonText: 'OK',
                                    timer: 3000,
                                    timerProgressBar: true
                                }).then(() => {
                                    // Reset form
                                    this.reset();
                                    // Hide previews
                                    document.getElementById('musicPreview').style.display = 'none';
                                    document.getElementById('videoPreview').style.display = 'none';
                                    document.getElementById('thumbPreview').style.display = 'none';
                                    document.getElementById('closeMusicBtn').style.display = 'none';
                                    document.getElementById('closeBtn').style.display = 'none';
                                    document.getElementById('closeThumbBtn').style.display = 'none';
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Upload Failed',
                                    text: data.message || 'An error occurred during upload.',
                                    confirmButtonColor: '#9f54f5',
                                    background: '#1a1a1a',
                                    color: 'white',
                                    confirmButtonText: 'OK'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Upload Failed',
                                text: 'An error occurred during upload. Please try again.',
                                confirmButtonColor: '#9f54f5',
                                background: '#1a1a1a',
                                color: 'white',
                                confirmButtonText: 'OK'
                            });
                        })
                        .finally(() => {
                            // Reset button state
                            submitBtn.innerHTML = originalText;
                            submitBtn.disabled = false;
                        });
                    });
                }

                const audio = document.getElementById("audio1");
                const playBtns = document.querySelectorAll(".play_btn, .music-controls-single-albums .play");
                const progressBar = document.getElementById("progress-bar");
                const currentTimeEl = document.querySelector(".music-current-time");
                const durationTimeEl = document.querySelector(".music-duration-time");
                const musicName = document.querySelector(".music-name");
                const musicArtist = document.querySelector(".music-artist");

                if (audio && playBtns.length > 0) {
                    console.log("Setting up music player");

                    // Get dynamic songs data from the database
                    const songs = {
                        @php
                            $topMusics = \App\Models\ArtistMusic::where('driver_id', auth()->id())
                                ->orderBy('listeners', 'desc')
                                ->take(3)
                                ->get();
                        @endphp

                        @foreach($topMusics as $music)
                            {{ $music->id }}: {
                                name: "{{ $music->name }}",
                                artist: "{{ auth()->user()->name }}",
                                src: "{{ $music->music_file_url ?: '#' }}"
                            },
                        @endforeach
                    };

                    let isPlaying = false;

                    function formatTime(seconds) {
                        const mins = Math.floor(seconds / 60);
                        const secs = Math.floor(seconds % 60);
                        return `${mins}:${secs < 10 ? "0" + secs : secs}`;
                    }

                    function loadSong(song) {
                        if (musicName) musicName.textContent = song.name;
                        if (musicArtist) musicArtist.textContent = song.artist;
                        audio.src = song.src;
                        audio.load();
                    }

                    function togglePlay(btn) {
                        if (!isPlaying) {
                            audio.play();
                            isPlaying = true;
                            btn.querySelector("i").classList.remove("fa-play");
                            btn.querySelector("i").classList.add("fa-pause");
                        } else {
                            audio.pause();
                            isPlaying = false;
                            btn.querySelector("i").classList.remove("fa-pause");
                            btn.querySelector("i").classList.add("fa-play");
                        }
                    }

                    audio.addEventListener("timeupdate", function () {
                        if (audio.duration && progressBar) {
                            let progress = (audio.currentTime / audio.duration) * 100;
                            progressBar.style.width = `${progress}%`;
                            if (currentTimeEl) currentTimeEl.textContent = formatTime(audio.currentTime);
                            if (durationTimeEl) durationTimeEl.textContent = formatTime(audio.duration);
                        }
                    });

                    const musicProgress = document.querySelector(".music-progress");
                    if (musicProgress) {
                        musicProgress.addEventListener("click", function (e) {
                            let width = this.clientWidth;
                            let clickX = e.offsetX;
                            let duration = audio.duration;
                            audio.currentTime = (clickX / width) * duration;
                        });
                    }

                    playBtns.forEach(btn => {
                        btn.addEventListener("click", function () {
                            const dataId = this.querySelector(".music-controls-item")?.dataset.id || this.dataset.id;
                            if (dataId && songs[dataId]) {
                                loadSong(songs[dataId]);
                            }
                            togglePlay(this);
                        });
                    });

                    audio.addEventListener("ended", function () {
                        isPlaying = false;
                        playBtns.forEach(btn => {
                            btn.querySelector("i").classList.remove("fa-pause");
                            btn.querySelector("i").classList.add("fa-play");
                        });
                    });
                }

                // Artwork upload functionality
                const fileInput = document.getElementById("fileInput");
                const previewGallery = document.getElementById("previewGallery");
                const uploadButtonContainer = document.getElementById("uploadButtonContainer");
                const uploadArea = document.getElementById("uploadArea");

                if (fileInput && previewGallery) {
                    console.log("Setting up artwork upload functionality");

                    // File input change handler
                    fileInput.addEventListener("change", function(e) {
                        console.log("Artwork files selected");
                        const files = Array.from(e.target.files);

                        if (files.length > 0) {
                            console.log("Processing", files.length, "artwork files");

                            // Clear previous previews
                            previewGallery.innerHTML = "";

                            files.forEach((file, index) => {
                                if (file.type.startsWith('image/')) {
                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        const previewItem = document.createElement('div');
                                        previewItem.className = 'preview-item';
                                        previewItem.style.cssText = `
                                            position: relative;
                                            display: inline-block;
                                            margin: 10px;
                                            border-radius: 8px;
                                            overflow: hidden;
                                            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                                        `;

                                        previewItem.innerHTML = `
                                            <img src="${e.target.result}" style="width: 150px; height: 150px; object-fit: cover; display: block;">
                                            <button type="button" class="remove-preview" style="
                                                position: absolute;
                                                top: 5px;
                                                right: 5px;
                                                background: #dc3545;
                                                color: white;
                                                border: none;
                                                border-radius: 50%;
                                                width: 25px;
                                                height: 25px;
                                                cursor: pointer;
                                                font-size: 14px;
                                                display: flex;
                                                align-items: center;
                                                justify-content: center;
                                            " onclick="removePreview(this, ${index})">×</button>
                                        `;

                                        previewGallery.appendChild(previewItem);
                                    };
                                    reader.readAsDataURL(file);
                                }
                            });

                            // Show upload button
                            uploadButtonContainer.style.display = 'block';
                        }
                    });

                    // Drag and drop functionality
                    uploadArea.addEventListener('dragover', function(e) {
                        e.preventDefault();
                        uploadArea.style.backgroundColor = '#f8f9fa';
                    });

                    uploadArea.addEventListener('dragleave', function(e) {
                        e.preventDefault();
                        uploadArea.style.backgroundColor = '';
                    });

                    uploadArea.addEventListener('drop', function(e) {
                        e.preventDefault();
                        uploadArea.style.backgroundColor = '';

                        const files = Array.from(e.dataTransfer.files);
                        const imageFiles = files.filter(file => file.type.startsWith('image/'));

                        if (imageFiles.length > 0) {
                            // Create a new FileList-like object
                            const dt = new DataTransfer();
                            imageFiles.forEach(file => dt.items.add(file));
                            fileInput.files = dt.files;

                            // Trigger change event
                            fileInput.dispatchEvent(new Event('change'));
                        }
                    });

                    // Form submission handler with AJAX and SweetAlert
                    const artworkForm = document.getElementById("artworkForm");
                    if (artworkForm) {
                        artworkForm.addEventListener("submit", function(e) {
                            e.preventDefault();
                            console.log("Artwork form submitted");

                            const submitBtn = this.querySelector('button[type="submit"]');
                            const originalText = submitBtn.innerHTML;

                            // Show loading state
                            submitBtn.innerHTML = 'Uploading...';
                            submitBtn.disabled = true;

                            // Create FormData
                            const formData = new FormData(this);

                            // Submit via AJAX
                            fetch(this.action, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success!',
                                        text: 'Artwork uploaded successfully!',
                                        confirmButtonColor: '#9f54f5',
                                        background: '#1a1a1a',
                                        color: 'white',
                                        confirmButtonText: 'OK',
                                        timer: 3000,
                                        timerProgressBar: true
                                    }).then(() => {
                                        // Reset form and clear previews
                                        this.reset();
                                        previewGallery.innerHTML = '';
                                        uploadButtonContainer.style.display = 'none';
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Upload Failed',
                                        text: data.message || 'An error occurred during upload.',
                                        confirmButtonColor: '#9f54f5',
                                        background: '#1a1a1a',
                                        color: 'white',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Upload Failed',
                                    text: 'An error occurred during upload. Please try again.',
                                    confirmButtonColor: '#9f54f5',
                                    background: '#1a1a1a',
                                    color: 'white',
                                    confirmButtonText: 'OK'
                                });
                            })
                            .finally(() => {
                                // Reset button state
                                submitBtn.innerHTML = originalText;
                                submitBtn.disabled = false;
                            });
                        });
                    }
                }

                // Function to remove preview items
                window.removePreview = function(button, index) {
                    console.log("Removing preview item", index);
                    const previewItem = button.parentElement;
                    previewItem.remove();

                    // Check if any previews remain
                    const remainingPreviews = previewGallery.querySelectorAll('.preview-item');
                    if (remainingPreviews.length === 0) {
                        uploadButtonContainer.style.display = 'none';
                        fileInput.value = '';
                    }
                };

                console.log("File upload functionality initialized");
            });
        </script>


        <script>
            document.addEventListener('DOMContentLoaded', () => {

                const artworkModal = document.getElementById('modal22');
                const artworkModalImage = document.getElementById('modalImage22');
                const artworkModalTitle = document.getElementById('modalTitle22');
                const artworkModalSubtitle = document.getElementById('modalSubtitle22');
                const artworkCloseBtn = document.getElementById('closeBtn22');
                const artworkPrevBtn = document.getElementById('prevBtn22');
                const artworkNextBtn = document.getElementById('nextBtn22');
                const artworkGalleryItems = document.querySelectorAll('.gallery-item22');

                if (!artworkModal || !artworkGalleryItems.length) return;

                let artworkCurrentIndex = 0;

                artworkGalleryItems.forEach((item, index) => {
                    item.addEventListener('click', () => openArtworkModal(index));
                });

                function openArtworkModal(index) {
                    artworkCurrentIndex = index;
                    updateArtworkModalContent();
                    artworkModal.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }

                function closeArtworkModal() {
                    artworkModal.classList.remove('active');
                    document.body.style.overflow = '';
                }

                function updateArtworkModalContent() {
                    const currentItem = artworkGalleryItems[artworkCurrentIndex];
                    const img = currentItem.querySelector('img');

                    if (img) artworkModalImage.src = img.src;
                    if (artworkModalTitle) artworkModalTitle.textContent = 'Artwork ' + (artworkCurrentIndex + 1);
                    if (artworkModalSubtitle) artworkModalSubtitle.textContent = '';
                }

                function showNextArtwork() {
                    artworkCurrentIndex = (artworkCurrentIndex + 1) % artworkGalleryItems.length;
                    updateArtworkModalContent();
                }

                function showPrevArtwork() {
                    artworkCurrentIndex = (artworkCurrentIndex - 1 + artworkGalleryItems.length) % artworkGalleryItems.length;
                    updateArtworkModalContent();
                }

                artworkCloseBtn?.addEventListener('click', closeArtworkModal);
                artworkPrevBtn?.addEventListener('click', showPrevArtwork);
                artworkNextBtn?.addEventListener('click', showNextArtwork);

                artworkModal.addEventListener('click', (e) => {
                    if (e.target === artworkModal) closeArtworkModal();
                });

                document.addEventListener('keydown', (e) => {
                    if (!artworkModal.classList.contains('active')) return;

                    if (e.key === 'Escape') closeArtworkModal();
                    if (e.key === 'ArrowLeft') showPrevArtwork();
                    if (e.key === 'ArrowRight') showNextArtwork();
                });

            });
        </script>

        <script>
            // Monthly Earnings Chart - Dynamic Data
            @if(isset($earningsData) && !empty($earningsData['chart_data']))
            window.earningsChartData = @json($earningsData['chart_data'] ?? []);
            window.hasDynamicEarningsChart = true; // Flag to prevent default chart initialization
            const monthlyEarningsData = @json($earningsData['monthly_earnings'] ?? []);
            const earningsChartData = window.earningsChartData;

            let earningsChart = null;

            window.initEarningsChart = function(period = '6') {
                const ctx = document.getElementById('earningsChart');
                if (!ctx) {
                    console.warn('Earnings chart canvas not found');
                    return;
                }

                // Filter data based on period
                let filteredData = [];
                if (period === 'all') {
                    filteredData = earningsChartData;
                } else {
                    const months = parseInt(period);
                    filteredData = earningsChartData.slice(-months);
                }

                if (filteredData.length === 0) {
                    console.warn('No earnings data available for chart');
                    ctx.parentElement.innerHTML = '<p style="color: #b8a8d0; text-align: center; padding: 40px;">No earnings data available yet. Start uploading music to earn royalties!</p>';
                    return;
                }

                if (earningsChart) {
                    earningsChart.destroy();
                }

                // Wait for Chart.js to be available
                if (typeof Chart === 'undefined') {
                    console.warn('Chart.js not loaded, retrying...');
                    setTimeout(() => initEarningsChart(period), 500);
                    return;
                }

                const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 400);
                gradient.addColorStop(0, 'rgba(139, 92, 246, 0.4)');
                gradient.addColorStop(1, 'rgba(139, 92, 246, 0.01)');

                earningsChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: filteredData.map(d => d.month),
                        datasets: [{
                            label: 'Monthly Earnings',
                            data: filteredData.map(d => d.amount),
                            borderColor: 'rgba(139, 92, 246, 1)',
                            backgroundColor: gradient,
                            tension: 0.4,
                            fill: true,
                            pointBackgroundColor: 'rgba(139, 92, 246, 1)',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 5,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                titleColor: '#fff',
                                bodyColor: '#fff',
                                callbacks: {
                                    label: function(context) {
                                        return 'Earnings: $' + context.parsed.y.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    color: '#b8a8d0',
                                    callback: function(value) {
                                        return '$' + value.toLocaleString();
                                    }
                                },
                                grid: {
                                    color: 'rgba(184, 168, 208, 0.1)'
                                }
                            },
                            x: {
                                ticks: {
                                    color: '#b8a8d0'
                                },
                                grid: {
                                    color: 'rgba(184, 168, 208, 0.1)'
                                }
                            }
                        }
                    }
                });
            }

            // Filter button handlers
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    const period = this.dataset.period;
                    if (window.initEarningsChart) {
                        window.initEarningsChart(period);
                    }
                });
            });

            // Initialize chart on page load
            function initChartWhenReady() {
                if (typeof Chart !== 'undefined' && window.initEarningsChart) {
                    window.initEarningsChart('6');
                } else if (typeof Chart === 'undefined') {
                    setTimeout(initChartWhenReady, 100);
                }
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initChartWhenReady);
            } else {
                initChartWhenReady();
            }
            @else
            // No earnings data available
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('earningsChart');
                if (ctx) {
                    ctx.parentElement.innerHTML = '<p style="color: #b8a8d0; text-align: center; padding: 40px;">No earnings data available yet. Start uploading music to earn royalties!</p>';
                }
            });
            @endif

            //withdrawal payment popup js
            // Make availableBalance globally accessible
            window.availableBalance = {{ $wallet ? $wallet->available_balance : 0 }};
            const availableBalance = window.availableBalance;

            // Make functions globally accessible
            window.openModall = function() {
                const modal = document.getElementById('withdrawModal');
                if (modal) {
                    modal.classList.add('active');
                    document.body.style.overflow = 'hidden';
                    console.log('Withdraw modal opened');
                } else {
                    console.error('Withdraw modal element not found');
                }
            };

            window.closeModall = function() {
                const modal = document.getElementById('withdrawModal');
                if (modal) {
                    modal.classList.remove('active');
                    document.body.style.overflow = 'auto';
                    if (window.resetForm) {
                        window.resetForm();
                    }
                    console.log('Withdraw modal closed');
                }
            };

            // Make resetForm globally accessible
            window.resetForm = function() {
                const withdrawAmount = document.getElementById('withdrawAmount');
                const payoutMethod = document.getElementById('payoutMethod');
                const confirmCheckbox = document.getElementById('confirmCheckbox');
                const accountInfo = document.getElementById('accountInfo');
                const platformFee = document.getElementById('platformFee');
                const netAmount = document.getElementById('netAmount');
                const withdrawForm = document.getElementById('withdrawForm');
                const successMessage = document.getElementById('successMessage');
                const amountError = document.getElementById('amountError');

                if (withdrawAmount) withdrawAmount.value = '';
                if (payoutMethod) payoutMethod.value = '';
                if (confirmCheckbox) confirmCheckbox.checked = false;
                if (accountInfo) accountInfo.style.display = 'none';
                if (platformFee) platformFee.textContent = '$0.00';
                if (netAmount) netAmount.textContent = '$0.00';
                if (withdrawForm) withdrawForm.style.display = 'block';
                if (successMessage) successMessage.classList.remove('show');
                if (withdrawAmount) withdrawAmount.classList.remove('error');
                if (amountError) amountError.classList.remove('show');
            };

            window.fillFullBalance = function() {
                const withdrawAmount = document.getElementById('withdrawAmount');
                if (withdrawAmount) {
                    const balance = window.availableBalance || availableBalance || 0;
                    withdrawAmount.value = balance.toFixed(2);
                    if (window.calculateFees) {
                        window.calculateFees();
                    }
                }
            };

            window.updateAccountDetails = function() {
                const method = document.getElementById('payoutMethod').value;
                const accountInfo = document.getElementById('accountInfo');

                // Check if payment details exist for this method
                @if($paymentDetails)
                    const paymentMethod = '{{ $paymentDetails->payment_method }}';
                    if (method === paymentMethod) {
                        accountInfo.style.display = 'block';
                    } else {
                        accountInfo.style.display = 'none';
                        alert('Please add payment details for ' + method.replace('_', ' ') + ' first.');
                        if (window.openPaymentDetailsModal) {
                            window.openPaymentDetailsModal();
                        }
                    }
                @else
                    if (method) {
                        accountInfo.style.display = 'none';
                        alert('Please add payment details first.');
                        if (window.openPaymentDetailsModal) {
                            window.openPaymentDetailsModal();
                        }
                    } else {
                        accountInfo.style.display = 'none';
                    }
                @endif
            }

            window.openPaymentDetailsModal = function() {
                const modal = document.getElementById('paymentDetailsModal');
                if (modal) {
                    modal.style.display = 'flex';
                    document.body.style.overflow = 'hidden';
                    if (window.togglePaymentFields) {
                        window.togglePaymentFields();
                    }
                }
            };

            window.closePaymentDetailsModal = function() {
                const modal = document.getElementById('paymentDetailsModal');
                if (modal) {
                    modal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            };

            window.togglePaymentFields = function() {
                const method = document.getElementById('paymentMethodSelect')?.value || '';
                const bankFields = document.getElementById('bankFields');
                const paypalFields = document.getElementById('paypalFields');
                const wiseFields = document.getElementById('wiseFields');

                // Get all input fields
                const accountName = document.getElementById('account_name');
                const bankName = document.getElementById('bank_name');
                const accountNumber = document.getElementById('account_number');
                const routingNumber = document.getElementById('routing_number');
                const paypalEmail = document.getElementById('paypal_email');
                const wiseEmail = document.getElementById('wise_email');

                // Show/hide fields and toggle required attribute
                if (method === 'bank_transfer') {
                    if (bankFields) bankFields.style.display = 'block';
                    if (paypalFields) paypalFields.style.display = 'none';
                    if (wiseFields) wiseFields.style.display = 'none';

                    // Set required for bank fields
                    if (accountName) accountName.setAttribute('required', 'required');
                    if (bankName) bankName.setAttribute('required', 'required');
                    if (accountNumber) accountNumber.setAttribute('required', 'required');
                    if (routingNumber) routingNumber.removeAttribute('required');

                    // Remove required from other fields
                    if (paypalEmail) paypalEmail.removeAttribute('required');
                    if (wiseEmail) wiseEmail.removeAttribute('required');
                } else if (method === 'paypal') {
                    if (bankFields) bankFields.style.display = 'none';
                    if (paypalFields) paypalFields.style.display = 'block';
                    if (wiseFields) wiseFields.style.display = 'none';

                    // Set required for PayPal field
                    if (paypalEmail) paypalEmail.setAttribute('required', 'required');

                    // Remove required from other fields
                    if (accountName) accountName.removeAttribute('required');
                    if (bankName) bankName.removeAttribute('required');
                    if (accountNumber) accountNumber.removeAttribute('required');
                    if (routingNumber) routingNumber.removeAttribute('required');
                    if (wiseEmail) wiseEmail.removeAttribute('required');
                } else if (method === 'wise') {
                    if (bankFields) bankFields.style.display = 'none';
                    if (paypalFields) paypalFields.style.display = 'none';
                    if (wiseFields) wiseFields.style.display = 'block';

                    // Set required for Wise field
                    if (wiseEmail) wiseEmail.setAttribute('required', 'required');

                    // Remove required from other fields
                    if (accountName) accountName.removeAttribute('required');
                    if (bankName) bankName.removeAttribute('required');
                    if (accountNumber) accountNumber.removeAttribute('required');
                    if (routingNumber) routingNumber.removeAttribute('required');
                    if (paypalEmail) paypalEmail.removeAttribute('required');
                } else {
                    // No method selected - hide all
                    if (bankFields) bankFields.style.display = 'none';
                    if (paypalFields) paypalFields.style.display = 'none';
                    if (wiseFields) wiseFields.style.display = 'none';

                    // Remove required from all fields
                    if (accountName) accountName.removeAttribute('required');
                    if (bankName) bankName.removeAttribute('required');
                    if (accountNumber) accountNumber.removeAttribute('required');
                    if (routingNumber) routingNumber.removeAttribute('required');
                    if (paypalEmail) paypalEmail.removeAttribute('required');
                    if (wiseEmail) wiseEmail.removeAttribute('required');
                }
            };

            // Initialize fields on page load if payment method is already selected
            document.addEventListener('DOMContentLoaded', function() {
                const methodSelect = document.getElementById('paymentMethodSelect');
                if (methodSelect && methodSelect.value) {
                    if (window.togglePaymentFields) {
                        window.togglePaymentFields();
                    }
                }
            });

            // Handle payment details form submission
            document.addEventListener('DOMContentLoaded', function() {
                const paymentDetailsForm = document.getElementById('paymentDetailsForm');
                if (paymentDetailsForm) {
                    paymentDetailsForm.addEventListener('submit', function(e) {
                        e.preventDefault();
                        const form = this;

                        // Validate visible required fields only
                        const method = document.getElementById('paymentMethodSelect')?.value;
                        if (!method) {
                            alert('Please select a payment method');
                            return;
                        }

                        // Check required fields for selected method
                        const requiredFields = form.querySelectorAll(`input[data-required="${method}"]`);
                        let isValid = true;
                        let firstInvalidField = null;

                        requiredFields.forEach(field => {
                            if (!field.value || field.value.trim() === '') {
                                isValid = false;
                                if (!firstInvalidField) {
                                    firstInvalidField = field;
                                }
                            }
                        });

                        if (!isValid) {
                            if (firstInvalidField) {
                                firstInvalidField.focus();
                                firstInvalidField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            }
                            alert('Please fill in all required fields for the selected payment method');
                            return;
                        }

                        const formData = new FormData(form);

                        fetch(form.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                                'Accept': 'application/json',
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                return response.json();
                            }
                            return response.text().then(text => {
                                try {
                                    return JSON.parse(text);
                                } catch {
                                    return { success: false, message: 'Error saving payment details' };
                                }
                            });
                        })
                        .then(data => {
                            if (data.success) {
                                if (typeof Swal !== 'undefined') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Payment details saved successfully!',
                                        confirmButtonColor: '#9f54f5',
                                        background: '#1a1a1a',
                                        color: 'white',
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    alert('Payment details saved successfully!');
                                    location.reload();
                                }
                            } else {
                                alert(data.message || 'Error saving payment details. Please try again.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error saving payment details. Please try again.');
                        });
                    });
                }
            });

            window.calculateFees = function() {
                const amount = parseFloat(document.getElementById('withdrawAmount')?.value || 0);
                const fee = amount * 0.02;
                const net = amount - fee;

                const platformFee = document.getElementById('platformFee');
                const netAmount = document.getElementById('netAmount');
                if (platformFee) platformFee.textContent = '$' + fee.toFixed(2);
                if (netAmount) netAmount.textContent = '$' + net.toFixed(2);
            };

            // Set up event listener for withdraw amount input
            document.addEventListener('DOMContentLoaded', function() {
                const withdrawAmount = document.getElementById('withdrawAmount');
                if (withdrawAmount) {
                    withdrawAmount.addEventListener('input', function() {
                        if (window.calculateFees) {
                            window.calculateFees();
                        }
                    });
                }
            });

            window.validateForm = function() {
                const amount = parseFloat(document.getElementById('withdrawAmount').value);
                const method = document.getElementById('payoutMethod').value;
                const confirmed = document.getElementById('confirmCheckbox').checked;
                const amountInput = document.getElementById('withdrawAmount');
                const amountError = document.getElementById('amountError');

                let isValid = true;

                // Validate amount
                const balance = window.availableBalance || availableBalance || 0;
                if (!amount || amount < 50 || amount > balance) {
                    amountInput.classList.add('error');
                    amountError.classList.add('show');

                    if (amount > balance) {
                        amountError.textContent = 'Amount exceeds available balance';
                    } else {
                        amountError.textContent = 'Please enter a valid amount (minimum $50.00)';
                    }
                    isValid = false;
                } else {
                    amountInput.classList.remove('error');
                    amountError.classList.remove('show');
                }

                // Validate method
                if (!method) {
                    alert('Please select a payout method');
                    isValid = false;
                }

                // Validate confirmation
                if (!confirmed) {
                    alert('Please confirm that the payout details are correct');
                    isValid = false;
                }

                return isValid;
            }

            window.submitWithdrawal = function() {
                if (!window.validateForm || !window.validateForm()) {
                    return;
                }

                const submitBtn = document.getElementById('submitBtn');
                if (!submitBtn) {
                    console.error('Submit button not found');
                    return;
                }

                submitBtn.classList.add('loading');
                submitBtn.disabled = true;

                const amount = parseFloat(document.getElementById('withdrawAmount')?.value || 0);
                const method = document.getElementById('payoutMethod')?.value;

                if (!amount || amount <= 0) {
                    alert('Please enter a valid withdrawal amount');
                    submitBtn.classList.remove('loading');
                    submitBtn.disabled = false;
                    return;
                }

                if (!method) {
                    alert('Please select a payout method');
                    submitBtn.classList.remove('loading');
                    submitBtn.disabled = false;
                    return;
                }

                // Get payment details
                @if($paymentDetails)
                    const paymentMethod = '{{ $paymentDetails->payment_method }}';
                    let accountDetails = {};

                    if (paymentMethod === 'bank_transfer') {
                        accountDetails = {
                            account_name: '{{ addslashes($paymentDetails->account_name ?? '') }}',
                            account_number: '{{ addslashes($paymentDetails->account_number ?? '') }}',
                            bank_name: '{{ addslashes($paymentDetails->bank_name ?? '') }}',
                            routing_number: '{{ addslashes($paymentDetails->routing_number ?? '') }}',
                            payment_method: 'bank_transfer'
                        };
                    } else if (paymentMethod === 'paypal') {
                        accountDetails = {
                            paypal_email: '{{ addslashes($paymentDetails->paypal_email ?? '') }}',
                            payment_method: 'paypal'
                        };
                    } else if (paymentMethod === 'wise') {
                        accountDetails = {
                            wise_email: '{{ addslashes($paymentDetails->wise_email ?? '') }}',
                            payment_method: 'wise'
                        };
                    }

                    // Check if selected method matches saved payment details
                    if (method !== paymentMethod) {
                        alert('Selected payout method does not match your saved payment details. Please update your payment details first.');
                        if (window.openPaymentDetailsModal) {
                            window.openPaymentDetailsModal();
                        }
                        submitBtn.classList.remove('loading');
                        submitBtn.disabled = false;
                        return;
                    }
                @else
                    alert('Please add payment details first.');
                    if (window.openPaymentDetailsModal) {
                        window.openPaymentDetailsModal();
                    }
                    submitBtn.classList.remove('loading');
                    submitBtn.disabled = false;
                    return;
                @endif

                // Get CSRF token
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
                if (!csrfToken) {
                    alert('CSRF token not found. Please refresh the page and try again.');
                    submitBtn.classList.remove('loading');
                    submitBtn.disabled = false;
                    return;
                }

                // Submit payout request
                fetch('{{ route("artist.royalty.request-payout") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: JSON.stringify({
                        amount: amount,
                        payout_method: method,
                        account_details: JSON.stringify(accountDetails),
                        currency: 'USD',
                    })
                })
                .then(async response => {
                    const contentType = response.headers.get('content-type');
                    let data;

                    if (contentType && contentType.includes('application/json')) {
                        data = await response.json();
                    } else {
                        const text = await response.text();
                        try {
                            data = JSON.parse(text);
                        } catch (e) {
                            console.error('Failed to parse response:', text);
                            throw new Error('Invalid response from server');
                        }
                    }

                    if (data.success) {
                        const net = amount - (amount * 0.02);
                        const successAmountEl = document.getElementById('successAmount');
                        const withdrawFormEl = document.getElementById('withdrawForm');
                        const successMessageEl = document.getElementById('successMessage');

                        if (successAmountEl) successAmountEl.textContent = '$' + net.toFixed(2);
                        if (withdrawFormEl) withdrawFormEl.style.display = 'none';
                        if (successMessageEl) successMessageEl.classList.add('show');

                        // Show success message
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Withdrawal request submitted successfully!',
                                confirmButtonColor: '#9f54f5',
                                background: '#1a1a1a',
                                color: 'white',
                            });
                        }
                    } else {
                        const errorMsg = data.message || data.error || 'Error submitting payout request. Please try again.';
                        alert(errorMsg);
                    }
                    submitBtn.classList.remove('loading');
                    submitBtn.disabled = false;
                })
                .catch(error => {
                    console.error('Error submitting withdrawal:', error);
                    alert('Error submitting payout request: ' + (error.message || 'Please try again.'));
                    submitBtn.classList.remove('loading');
                    submitBtn.disabled = false;
                });
            }

            // Close modal on overlay click
            document.addEventListener('DOMContentLoaded', function() {
                const withdrawModal = document.getElementById('withdrawModal');
                if (withdrawModal) {
                    withdrawModal.addEventListener('click', function(e) {
                        if (e.target === this) {
                            if (window.closeModall) {
                                window.closeModall();
                            }
                        }
                    });
                }
            });

            // ============================================
            // TRACK COLLABORATION MANAGEMENT
            // ============================================

            let collaboratorCount = 0;
            const artistsList = @json($artistsList ?? []);

            // Add Collaborator Button
            document.getElementById('addCollaboratorBtn')?.addEventListener('click', function() {
                addCollaboratorRow();
            });

            // Update form action when music is selected
            document.getElementById('collaboration_music_id')?.addEventListener('change', function() {
                const musicId = this.value;
                const form = document.getElementById('collaborationForm');
                if (musicId && form) {
                    // Use named route helper - get base URL and construct path
                    @php
                        // Generate a sample route to extract the pattern
                        $sampleRoute = route('artist.collaborations.store', ['id' => 999]);
                        $routePattern = str_replace('999', 'MUSIC_ID', $sampleRoute);
                    @endphp
                    const routePattern = '{{ $routePattern }}';
                    form.action = routePattern.replace('MUSIC_ID', musicId);
                }

                // Check if track already has collaboration
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption.dataset.hasCollab === '1') {
                    alert('This track already has a collaboration. Please select another track.');
                    this.value = '';
                    form.action = '';
                }
            });

            function addCollaboratorRow() {
                collaboratorCount++;
                const container = document.getElementById('collaboratorsList');

                const row = document.createElement('div');
                row.className = 'collaborator-row mb-3';
                row.id = `collaborator_${collaboratorCount}`;
                row.style.cssText = 'background: rgba(183, 148, 246, 0.1); padding: 15px; border-radius: 8px; border: 1px solid rgba(183, 148, 246, 0.3);';

                row.innerHTML = `
                    <div class="row align-items-end">
                        <div class="col-md-5">
                            <label style="color: #b8a8d0; margin-bottom: 8px; display: block;">Artist *</label>
                            <select name="artists[${collaboratorCount}][artist_id]" class="form-control collaborator-artist-select" required style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(183, 148, 246, 0.3); color: #fbfbfb; padding: 10px; border-radius: 6px;">
                                <option value="">-- Select Artist --</option>
                                ${artistsList.map(artist => `<option value="${artist.id}">${artist.name} (${artist.email})</option>`).join('')}
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label style="color: #b8a8d0; margin-bottom: 8px; display: block;">Ownership % *</label>
                            <input type="number" name="artists[${collaboratorCount}][ownership_percentage]"
                                   class="form-control ownership-input"
                                   step="0.01" min="0" max="100"
                                   required
                                   style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(183, 148, 246, 0.3); color: #fbfbfb; padding: 10px; border-radius: 6px;"
                                   class="ownership-input-dynamic">
                        </div>
                        <div class="col-md-3">
                            <label style="color: #b8a8d0; margin-bottom: 8px; display: block;">Role</label>
                            <input type="text" name="artists[${collaboratorCount}][role]"
                                   placeholder="e.g., Featured Artist"
                                   style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(183, 148, 246, 0.3); color: #fbfbfb; padding: 10px; border-radius: 6px; width: 100%;">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-sm remove-collaborator"
                                    onclick="removeCollaborator(${collaboratorCount})"
                                    style="background: rgba(255, 75, 43, 0.3); color: #ff4b2b; border: 1px solid rgba(255, 75, 43, 0.5); padding: 10px; border-radius: 6px; cursor: pointer; width: 100%;">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                `;

                container.appendChild(row);

                // Add event listener to the new input
                const newInput = row.querySelector('.ownership-input-dynamic');
                if (newInput) {
                    newInput.addEventListener('input', updateOwnershipSummary);
                    newInput.addEventListener('change', updateOwnershipSummary);
                }

                updateOwnershipSummary();
            }


            // Make functions globally accessible
            window.updateOwnershipSummary = function() {
                const ownershipInputs = document.querySelectorAll('.ownership-input');
                let totalCollaboratorsShare = 0;

                ownershipInputs.forEach(input => {
                    const value = parseFloat(input.value) || 0;
                    totalCollaboratorsShare += value;
                });

                const primaryArtistOwnership = 100 - totalCollaboratorsShare;

                const totalShareEl = document.getElementById('totalCollaboratorsShare');
                const primaryOwnershipEl = document.getElementById('primaryArtistOwnership');
                const statusDiv = document.getElementById('ownershipStatus');
                const submitBtn = document.getElementById('submitCollaborationBtn');

                if (totalShareEl) totalShareEl.textContent = totalCollaboratorsShare.toFixed(2) + '%';
                if (primaryOwnershipEl) primaryOwnershipEl.textContent = primaryArtistOwnership.toFixed(2) + '%';

                if (statusDiv && submitBtn) {
                    if (Math.abs(totalCollaboratorsShare - 100) < 0.01) {
                        statusDiv.innerHTML = '<i class="fas fa-check-circle" style="color: #00f2fe;"></i> <span style="color: #00f2fe;">Perfect! Total ownership is 100%</span>';
                        submitBtn.disabled = false;
                        submitBtn.style.opacity = '1';
                    } else if (totalCollaboratorsShare > 100) {
                        statusDiv.innerHTML = '<i class="fas fa-exclamation-triangle" style="color: #ff4b2b;"></i> <span style="color: #ff4b2b;">Total ownership exceeds 100%! Please adjust percentages.</span>';
                        submitBtn.disabled = true;
                        submitBtn.style.opacity = '0.5';
                    } else {
                        statusDiv.innerHTML = '<i class="fas fa-info-circle" style="color: #f1c40f;"></i> <span style="color: #f1c40f;">Remaining: ' + primaryArtistOwnership.toFixed(2) + '% will be assigned to you (Primary Artist)</span>';
                        submitBtn.disabled = false;
                        submitBtn.style.opacity = '1';
                    }
                }
            };

            window.removeCollaborator = function(id) {
                const row = document.getElementById(`collaborator_${id}`);
                if (row) {
                    row.remove();
                    updateOwnershipSummary();
                }
            };

            // Form submission
            document.getElementById('collaborationForm')?.addEventListener('submit', function(e) {
                const musicId = document.getElementById('collaboration_music_id').value;
                if (!musicId) {
                    e.preventDefault();
                    alert('Please select a track first.');
                    return false;
                }

                const totalShare = parseFloat(document.getElementById('totalCollaboratorsShare').textContent);
                if (totalShare > 100) {
                    e.preventDefault();
                    alert('Total ownership percentage cannot exceed 100%.');
                    return false;
                }

                if (collaboratorCount === 0) {
                    e.preventDefault();
                    alert('Please add at least one collaborator.');
                    return false;
                }
            });

            // Add event listeners to all ownership inputs (event delegation)
            document.addEventListener('input', function(e) {
                if (e.target.classList.contains('ownership-input') || e.target.classList.contains('ownership-input-dynamic')) {
                    updateOwnershipSummary();
                }
            });

            // Initialize ownership summary
            setTimeout(() => {
                updateOwnershipSummary();
            }, 100);
            //withdrawal payment popup js
        </script>

        <!-- Artist Subscription Purchase Popup -->
        <div class="artist-subscription-popup" id="artistPortalSubscriptionPopup">
            <div class="overlay" onclick="closeArtistPortalSubscriptionPopup(event)">
                <div class="popup" onclick="event.stopPropagation()">
                    <div class="popup-header">
                        <h2 class="popup-title">Purchase Artist Subscription</h2>
                        <button class="close-btn" onclick="closeArtistPortalSubscriptionPopup()">&times;</button>
                    </div>

                    <div class="subscription-details">
                        <div class="plan-info">
                            <h3 id="selectedArtistPortalPlanName">Pro Artist</h3>
                            <div class="plan-price" id="selectedArtistPortalPlanPrice">£9.99</div>
                            <div class="plan-period" id="selectedArtistPortalPlanPeriod">per month</div>
                        </div>

                        <div class="payment-methods">
                            <h4>Choose Payment Method</h4>

                            <div class="payment-method" onclick="selectArtistPortalPaymentMethod(this, 'stripe')">
                                <div class="payment-icon stripe">S</div>
                                <div class="payment-info">
                                    <h3>Stripe</h3>
                                    <p>Pay securely with Stripe</p>
                                </div>
                            </div>

                            <div class="payment-method" onclick="selectArtistPortalPaymentMethod(this, 'google-pay')">
                                <div class="payment-icon google-pay">G</div>
                                <div class="payment-info">
                                    <h3>Google Pay</h3>
                                    <p>Quick and secure payment via Stripe</p>
                                </div>
                            </div>

                            <div class="payment-method" onclick="selectArtistPortalPaymentMethod(this, 'apple-pay')">
                                <div class="payment-icon apple-pay">AP</div>
                                <div class="payment-info">
                                    <h3>Apple Pay</h3>
                                    <p>Pay with Touch ID or Face ID via Stripe</p>
                                </div>
                            </div>

                            <div class="payment-method" onclick="selectArtistPortalPaymentMethod(this, 'paypal')">
                                <div class="payment-icon paypal">P</div>
                                <div class="payment-info">
                                    <h3>PayPal</h3>
                                    <p>Pay with your PayPal account</p>
                                </div>
                            </div>

                            <div class="payment-method" onclick="selectArtistPortalPaymentMethod(this, 'square')">
                                <div class="payment-icon square">Sq</div>
                                <div class="payment-info">
                                    <h3>Square</h3>
                                    <p>Secure payment processing</p>
                                </div>
                            </div>
                        </div>

                        <!-- Stripe Payment Form (Hidden by default) -->
                        <div id="artist-portal-stripe-payment-form" class="payment-form" style="display: none;">
                            <div class="form-group">
                                <label>Card Details</label>
                                <div id="artist-portal-stripe-card-element" class="stripe-card-element">
                                    <!-- Stripe Elements will create form elements here -->
                                </div>
                                <div id="artist-portal-stripe-card-errors" class="stripe-card-errors"></div>
                            </div>
                        </div>

                        <!-- PayPal Payment Button (Hidden by default) -->
                        <div id="artist-portal-paypal-payment-button" class="payment-form" style="display: none;">
                            <div id="artist-portal-paypal-button-container"></div>
                        </div>

                        <!-- Google Pay Payment Form (Hidden by default) -->
                        <div id="artist-portal-google-pay-payment-form" class="payment-form" style="display: none;">
                            <div class="form-group">
                                <label>Google Pay</label>
                                <div id="artist-portal-google-pay-button-container" class="google-pay-container">
                                    <!-- Google Pay button will be rendered here -->
                                </div>
                                <div id="artist-portal-google-pay-errors" class="payment-errors"></div>
                            </div>
                        </div>

                        <!-- Apple Pay Payment Form (Hidden by default) -->
                        <div id="artist-portal-apple-pay-payment-form" class="payment-form" style="display: none;">
                            <div class="form-group">
                                <label>Apple Pay</label>
                                <div class="payment-info-text">
                                    <p>Apple Pay will be processed securely through Stripe. Click "Purchase Now" to proceed.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Square Payment Form (Hidden by default) -->
                        <div id="artist-portal-square-payment-form" class="payment-form" style="display: none;">
                            <div class="form-group">
                                <label>Card Details</label>
                                <div class="square-card-container">
                                    <div id="artist-portal-square-card-element" class="square-card-element">
                                        <p style="text-align: center; color: #666; padding: 20px;">Loading card input...</p>
                                    </div>
                                    <div id="artist-portal-square-card-errors" class="square-card-errors"></div>
                                </div>
                            </div>
                        </div>

                        <div class="subscription-terms">
                            <label class="checkbox-container">
                                <input type="checkbox" id="agreeArtistPortalTerms" required>
                                <span class="checkmark"></span>
                                I agree to the <a href="#" class="terms-link">Terms of Service</a> and <a href="#" class="terms-link">Privacy Policy</a>
                            </label>
                        </div>
                    </div>

                    <div class="popup-actions">
                        <button class="btn-cancel" onclick="closeArtistPortalSubscriptionPopup()">Cancel</button>
                        <button class="btn-confirm" id="artistPortalPurchaseBtn" onclick="purchaseArtistPortalSubscription()">Purchase Now</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://js.stripe.com/v3/"></script>
        <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID', 'YOUR_CLIENT_ID') }}&currency=GBP"></script>
        <script src="https://pay.google.com/gp/p/js/pay.js"></script>
        <?php
            $artistSquareApplicationId = env('SQUARE_APPLICATION_ID', '');
            $artistSquareSdkUrl = (strpos($artistSquareApplicationId, 'sandbox-') === 0)
                ? 'https://sandbox.web.squarecdn.com/v1/square.js'
                : 'https://web.squarecdn.com/v1/square.js';
        ?>
        <script src="{{ $artistSquareSdkUrl }}"></script>
        <script>
        // Make functions globally accessible
        window.selectedArtistPortalPlan = null;
        window.selectedArtistPortalPaymentMethod = null;
        window.artistPortalStripe = null;
        window.artistPortalStripeCardElement = null;
        window.artistPortalPaypalButtons = null;
        window.artistPortalSquarePayments = null;
        window.artistPortalSquareCard = null;
        window.isArtistPortalSquareInitialized = false;
        window.artistPortalGooglePayToken = null;
        window.artistPortalGooglePayButton = null;

        // Initialize Stripe when it's loaded - only once
        let stripeInitialized = false;
        function initArtistPortalStripe() {
            // Only initialize once
            if (stripeInitialized && window.artistPortalStripe) {
                return;
            }

            if (typeof Stripe !== 'undefined') {
                const stripeKey = '{{ env("STRIPE_KEY", "") }}';
                if (stripeKey && !window.artistPortalStripe) {
                    window.artistPortalStripe = Stripe(stripeKey);
                    stripeInitialized = true;
                    // Unmount any existing card element to ensure fresh start
                    if (window.artistPortalStripeCardElement) {
                        try {
                            window.artistPortalStripeCardElement.unmount();
                        } catch(e) {}
                        window.artistPortalStripeCardElement = null;
                    }
                }
            } else {
                // Retry after a short delay if Stripe isn't loaded yet
                setTimeout(initArtistPortalStripe, 100);
            }
        }

        // Initialize when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initArtistPortalStripe);
        } else {
            initArtistPortalStripe();
        }

        // Also try to initialize when Stripe script loads (but only if not already initialized)
        window.addEventListener('load', function() {
            if (!stripeInitialized) {
                initArtistPortalStripe();
            }
            // Initialize Square and Google Pay on page load
            if (typeof Square !== 'undefined' && !window.isArtistPortalSquareInitialized) {
                initializeArtistPortalSquare();
            }
            if (typeof google !== 'undefined' && google.payments) {
                initializeArtistPortalGooglePay();
            }
        });

        window.openArtistPortalSubscriptionPopup = function(planId, planTitle, planPrice, planDuration) {
            window.selectedArtistPortalPlan = planId;
            window.selectedArtistPortalPaymentMethod = null; // Reset payment method

            const popup = document.getElementById('artistPortalSubscriptionPopup');
            const planName = document.getElementById('selectedArtistPortalPlanName');
            const priceEl = document.getElementById('selectedArtistPortalPlanPrice');
            const periodEl = document.getElementById('selectedArtistPortalPlanPeriod');

            // Reset payment method selection
            document.querySelectorAll('#artistPortalSubscriptionPopup .payment-method').forEach(method => {
                method.classList.remove('selected');
            });

            // Hide all payment forms
            document.querySelectorAll('#artistPortalSubscriptionPopup .payment-form').forEach(form => {
                form.style.display = 'none';
            });

            // Reset terms checkbox
            document.getElementById('agreeArtistPortalTerms').checked = false;

            // Update plan details
            planName.textContent = planTitle;
            if (planPrice == '0' || planPrice == 0) {
                priceEl.textContent = 'Free';
                periodEl.textContent = 'forever';
            } else {
                priceEl.textContent = '£' + parseFloat(planPrice).toFixed(2);
                periodEl.textContent = planDuration;
            }

            popup.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        window.closeArtistPortalSubscriptionPopup = function(event) {
            if (event && event.target !== event.currentTarget) return;

            const popup = document.getElementById('artistPortalSubscriptionPopup');
            popup.classList.remove('active');
            document.body.style.overflow = '';

            window.selectedArtistPortalPlan = null;
            window.selectedArtistPortalPaymentMethod = null;

            // Don't unmount Stripe element - keep it for reuse
            // Just hide the form
            document.querySelectorAll('#artistPortalSubscriptionPopup .payment-form').forEach(form => {
                form.style.display = 'none';
            });
        }

        window.selectArtistPortalPaymentMethod = function(element, method) {
            // Remove selection from all payment methods
            document.querySelectorAll('#artistPortalSubscriptionPopup .payment-method').forEach(m => {
                m.classList.remove('selected');
            });

            // Hide all payment forms
            document.querySelectorAll('#artistPortalSubscriptionPopup .payment-form').forEach(form => {
                form.style.display = 'none';
            });

            // Add selection to clicked method
            element.classList.add('selected');
            window.selectedArtistPortalPaymentMethod = method;

            // Show appropriate payment form
            if (method === 'stripe') {
                window.showArtistPortalStripeForm();
            } else if (method === 'paypal') {
                window.showArtistPortalPayPalForm();
            } else if (method === 'google-pay') {
                window.showArtistPortalGooglePayForm();
            } else if (method === 'apple-pay') {
                window.showArtistPortalApplePayForm();
            } else if (method === 'square') {
                window.showArtistPortalSquareForm();
            }
        };

        window.showArtistPortalStripeForm = function() {
            const stripeForm = document.getElementById('artist-portal-stripe-payment-form');
            stripeForm.style.display = 'block';

            // Ensure Stripe is initialized
            if (!window.artistPortalStripe) {
                initArtistPortalStripe();
                // Wait a bit for Stripe to initialize
                setTimeout(function() {
                    if (window.artistPortalStripe && !window.artistPortalStripeCardElement) {
                        createStripeCardElement();
                    }
                }, 200);
                return;
            }

            // Create card element if it doesn't exist
            if (!window.artistPortalStripeCardElement) {
                createStripeCardElement();
            }
        };

        function createStripeCardElement() {
            if (!window.artistPortalStripe) {
                console.error('Stripe not initialized');
                return;
            }

            // Unmount existing element if any
            if (window.artistPortalStripeCardElement) {
                try {
                    window.artistPortalStripeCardElement.unmount();
                } catch(e) {
                    console.warn('Error unmounting Stripe element:', e);
                }
                window.artistPortalStripeCardElement = null;
            }

            // Clear the container
            const cardElementContainer = document.getElementById('artist-portal-stripe-card-element');
            if (cardElementContainer) {
                cardElementContainer.innerHTML = '';
            }

            // Create new card element using the same Stripe instance
            const elements = window.artistPortalStripe.elements();
            window.artistPortalStripeCardElement = elements.create('card', {
                style: {
                    base: {
                        fontSize: '16px',
                        color: '#424770',
                    },
                },
            });

            window.artistPortalStripeCardElement.mount('#artist-portal-stripe-card-element');

            window.artistPortalStripeCardElement.on('change', function(event) {
                const displayError = document.getElementById('artist-portal-stripe-card-errors');
                if (displayError) {
                    if (event.error) {
                        displayError.textContent = event.error.message;
                    } else {
                        displayError.textContent = '';
                    }
                }
            });
        }

        window.showArtistPortalPayPalForm = function() {
            const paypalForm = document.getElementById('artist-portal-paypal-payment-button');
            paypalForm.style.display = 'block';

            if (!window.artistPortalPaypalButtons && typeof paypal !== 'undefined') {
                const planPriceEl = document.getElementById('selectedArtistPortalPlanPrice');
                const planPriceText = planPriceEl.textContent.replace('£', '').replace('Free', '0');
                const planPrice = parseFloat(planPriceText) || 0;

                window.artistPortalPaypalButtons = paypal.Buttons({
                    createOrder: function(data, actions) {
                        return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    value: planPrice.toString()
                                }
                            }]
                        });
                    },
                    onApprove: function(data, actions) {
                        return actions.order.capture().then(function(details) {
                            window.processArtistPortalPaymentWithMethod('paypal', details.id);
                        });
                    },
                    onError: function(err) {
                        Swal.fire({
                            icon: 'error',
                            title: 'PayPal Error',
                            text: 'PayPal payment failed: ' + err.message
                        });
                    }
                });

                window.artistPortalPaypalButtons.render('#artist-portal-paypal-button-container');
            }
        };

        window.showArtistPortalGooglePayForm = function() {
            document.getElementById('artist-portal-google-pay-payment-form').style.display = 'block';
            window.artistPortalGooglePayToken = null;

            // Initialize Google Pay if not done yet
            if (!window.artistPortalGooglePaymentsClient) {
                initializeArtistPortalGooglePay();
                setTimeout(function() {
                    if (window.artistPortalGooglePaymentsClient && !window.artistPortalGooglePayButton) {
                        createArtistPortalGooglePayButton();
                    }
                }, 500);
            } else if (!window.artistPortalGooglePayButton) {
                createArtistPortalGooglePayButton();
            }
        };

        function initializeArtistPortalGooglePay() {
            try {
                const paymentsClient = new google.payments.api.PaymentsClient({
                    environment: 'TEST'
                });

                const baseCardPaymentMethod = {
                    type: 'CARD',
                    parameters: {
                        allowedAuthMethods: ['PAN_ONLY', 'CRYPTOGRAM_3DS'],
                        allowedCardNetworks: ['MASTERCARD', 'VISA']
                    },
                    tokenizationSpecification: {
                        type: 'PAYMENT_GATEWAY',
                        parameters: {
                            gateway: 'stripe',
                            'stripe:version': '2020-08-27',
                            'stripe:publishableKey': '{{ env("STRIPE_KEY") }}'
                        }
                    }
                };

                window.artistPortalGooglePayBaseConfig = {
                    apiVersion: 2,
                    apiVersionMinor: 0,
                    allowedPaymentMethods: [baseCardPaymentMethod],
                    merchantInfo: {
                        merchantId: 'BCR2DN4TZ5XVLH9H',
                        merchantName: 'SingWithMe'
                    }
                };

                window.artistPortalGooglePaymentsClient = paymentsClient;
            } catch (error) {
                console.error('Google Pay init error:', error);
            }
        }

        function createArtistPortalGooglePayButton() {
            if (!window.artistPortalGooglePaymentsClient) return;

            window.artistPortalGooglePaymentsClient.isReadyToPay(window.artistPortalGooglePayBaseConfig)
                .then(function(response) {
                    if (response.result) {
                        window.artistPortalGooglePayButton = window.artistPortalGooglePaymentsClient.createButton({
                            onClick: onArtistPortalGooglePayButtonClicked,
                            buttonColor: 'default',
                            buttonType: 'pay'
                        });

                        const container = document.getElementById('artist-portal-google-pay-button-container');
                        if (container) {
                            container.innerHTML = '';
                            container.appendChild(window.artistPortalGooglePayButton);
                        }
                    } else {
                        const container = document.getElementById('artist-portal-google-pay-button-container');
                        if (container) container.innerHTML = '<p style="color:#ef4444;text-align:center;">Google Pay is not available for this transaction</p>';
                    }
                })
                .catch(function(err) {
                    const container = document.getElementById('artist-portal-google-pay-button-container');
                    if (container) container.innerHTML = '<p style="color:#ef4444;text-align:center;">Google Pay is not available</p>';
                });
        }

        function onArtistPortalGooglePayButtonClicked() {
            if (!window.artistPortalGooglePaymentsClient) return;

            const planPriceEl = document.getElementById('selectedArtistPortalPlanPrice');
            const planPriceText = planPriceEl ? planPriceEl.textContent.replace('£', '').replace('Free', '0') : '0';
            const planPrice = parseFloat(planPriceText) || 0;

            const paymentDataRequest = {
                ...window.artistPortalGooglePayBaseConfig,
                transactionInfo: {
                    totalPriceStatus: 'FINAL',
                    totalPrice: planPrice.toFixed(2),
                    currencyCode: 'GBP'
                }
            };

            window.artistPortalGooglePaymentsClient.loadPaymentData(paymentDataRequest)
                .then(function(paymentData) {
                    processArtistPortalGooglePayPayment(paymentData);
                })
                .catch(function(err) {
                    console.error('Google Pay error:', err);
                    Swal.fire({ icon: 'error', title: 'Google Pay Error', text: 'Google Pay payment failed: ' + err.message });
                });
        }

        function processArtistPortalGooglePayPayment(paymentData) {
            try {
                const gatewayToken = paymentData?.paymentMethodData?.tokenizationData?.token || null;
                if (!gatewayToken) {
                    Swal.fire({ icon: 'error', title: 'Google Pay Error', text: 'Unable to get Google Pay token' });
                    return;
                }

                try {
                    const parsedToken = JSON.parse(gatewayToken);
                    window.artistPortalGooglePayToken = parsedToken?.id || gatewayToken;
                } catch (e) {
                    window.artistPortalGooglePayToken = gatewayToken;
                }

                Swal.fire({ icon: 'success', title: 'Google Pay Authorized', text: 'Click Purchase Now to complete the payment.', timer: 2000, showConfirmButton: false });
            } catch (error) {
                console.error('Google Pay processing error:', error);
                Swal.fire({ icon: 'error', title: 'Google Pay Error', text: 'Failed to process Google Pay token' });
            }
        }

        window.showArtistPortalApplePayForm = function() {
            document.getElementById('artist-portal-apple-pay-payment-form').style.display = 'block';
        };

        window.showArtistPortalSquareForm = function() {
            document.getElementById('artist-portal-square-payment-form').style.display = 'block';

            if (window.artistPortalSquarePayments && !window.artistPortalSquareCard) {
                createArtistPortalSquareCard();
            } else if (!window.artistPortalSquarePayments) {
                if (typeof Square !== 'undefined') {
                    initializeArtistPortalSquare();
                    setTimeout(function() {
                        if (window.artistPortalSquarePayments && !window.artistPortalSquareCard) {
                            createArtistPortalSquareCard();
                        }
                    }, 1000);
                } else {
                    const container = document.getElementById('artist-portal-square-card-element');
                    if (container) container.innerHTML = '<p style="color:#ef4444;text-align:center;">Square SDK is not loaded. Please refresh the page.</p>';
                }
            }
        };

        function initializeArtistPortalSquare() {
            if (window.isArtistPortalSquareInitialized) return;

            try {
                window.artistPortalSquarePayments = Square.payments('{{ env("SQUARE_APPLICATION_ID") }}', '{{ env("SQUARE_LOCATION_ID") }}');
                window.isArtistPortalSquareInitialized = true;
            } catch (error) {
                console.error('Error initializing Square:', error);
                const container = document.getElementById('artist-portal-square-card-element');
                if (container) container.innerHTML = '<p style="color:#ef4444;text-align:center;">Failed to initialize Square: ' + error.message + '</p>';
            }
        }

        async function createArtistPortalSquareCard() {
            if (!window.artistPortalSquarePayments) return;

            try {
                window.artistPortalSquareCard = await window.artistPortalSquarePayments.card();
                await window.artistPortalSquareCard.attach('#artist-portal-square-card-element');
            } catch (error) {
                console.error('Error creating Square card:', error);
                const container = document.getElementById('artist-portal-square-card-element');
                if (container) container.innerHTML = '<p style="color:#ef4444;text-align:center;">Error creating card input: ' + error.message + '</p>';
            }
        }

        function setArtistPortalPurchaseButtonLoading(isLoading) {
            const button = document.getElementById('artistPortalPurchaseBtn');
            if (!button) return;
            if (!button.dataset.originalText) button.dataset.originalText = button.textContent;
            if (isLoading) {
                button.disabled = true;
                button.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="margin-right:8px;"></span>Processing...';
            } else {
                button.disabled = false;
                button.textContent = button.dataset.originalText || 'Purchase Now';
            }
        }

        window.purchaseArtistPortalSubscription = async function() {
            if (!window.selectedArtistPortalPlan) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No Plan Selected',
                    text: 'Please select a subscription plan first'
                });
                return;
            }

            // Check if it's a free plan
            const planPriceEl = document.getElementById('selectedArtistPortalPlanPrice');
            let planPrice = 0;
            if (planPriceEl) {
                const planPriceText = planPriceEl.textContent.replace('£', '').replace('Free', '0').trim();
                planPrice = parseFloat(planPriceText) || 0;
            }

            // For free plans, process directly
            if (planPrice === 0) {
                const termsCheckbox = document.getElementById('agreeArtistPortalTerms');
                if (termsCheckbox && !termsCheckbox.checked) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Terms Required',
                        text: 'Please agree to the terms and conditions'
                    });
                    return;
                }
                setArtistPortalPurchaseButtonLoading(true);
                try {
                    await processArtistPortalPaymentWithMethod('free');
                } finally {
                    setArtistPortalPurchaseButtonLoading(false);
                }
                return;
            }

            // For paid plans, require payment method
            if (!window.selectedArtistPortalPaymentMethod) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Payment Method Required',
                    text: 'Please select a payment method'
                });
                return;
            }

            // Check terms checkbox for paid plans
            const termsCheckbox = document.getElementById('agreeArtistPortalTerms');
            if (termsCheckbox && !termsCheckbox.checked) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Terms Required',
                    text: 'Please agree to the terms and conditions'
                });
                return;
            }

            setArtistPortalPurchaseButtonLoading(true);

            try {
                // Handle different payment methods
                if (window.selectedArtistPortalPaymentMethod === 'stripe') {
                    await window.processArtistPortalStripePayment();
                } else if (window.selectedArtistPortalPaymentMethod === 'paypal') {
                    Swal.fire({
                        icon: 'info',
                        title: 'Complete PayPal Payment',
                        text: 'Please complete the PayPal payment above'
                    });
                    return;
                } else if (window.selectedArtistPortalPaymentMethod === 'google-pay') {
                    if (!window.artistPortalGooglePayToken) {
                        Swal.fire({ icon: 'info', title: 'Google Pay Required', text: 'Please use the Google Pay button above to authorize payment first.' });
                        return;
                    }
                    await window.processArtistPortalPaymentWithMethod('google-pay', window.artistPortalGooglePayToken);
                } else if (window.selectedArtistPortalPaymentMethod === 'apple-pay') {
                    await window.processArtistPortalPaymentWithMethod('apple-pay');
                } else if (window.selectedArtistPortalPaymentMethod === 'square') {
                    await window.processArtistPortalSquarePayment();
                } else {
                    await window.processArtistPortalPaymentWithMethod(window.selectedArtistPortalPaymentMethod);
                }
            } finally {
                setArtistPortalPurchaseButtonLoading(false);
            }
        };

        window.processArtistPortalStripePayment = async function() {
            // Ensure Stripe is initialized
            if (!window.artistPortalStripe) {
                initArtistPortalStripe();
                await new Promise(resolve => setTimeout(resolve, 300));
            }

            if (!window.artistPortalStripe) {
                Swal.fire({
                    icon: 'error',
                    title: 'Stripe Error',
                    text: 'Stripe not initialized. Please refresh the page and try again.'
                });
                return;
            }

            if (!window.artistPortalStripeCardElement) {
                Swal.fire({
                    icon: 'error',
                    title: 'Card Error',
                    text: 'Please select Stripe as payment method first'
                });
                return;
            }

            try {
                // Use the same Stripe instance that was used to create the card element
                const { paymentMethod, error } = await window.artistPortalStripe.createPaymentMethod({
                    type: 'card',
                    card: window.artistPortalStripeCardElement,
                });

                if (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Card Error',
                        text: 'Card error: ' + error.message
                    });
                    return;
                }

                await window.processArtistPortalPaymentWithMethod('stripe', paymentMethod.id);
            } catch (error) {
                console.error('Stripe payment error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Payment Failed',
                    text: 'Payment failed: ' + error.message
                });
            }
        };

        window.processArtistPortalSquarePayment = async function() {
            if (!window.artistPortalSquareCard) {
                Swal.fire({ icon: 'error', title: 'Square Error', text: 'Square card input not initialized. Please select Square as payment method first.' });
                return;
            }

            try {
                const result = await window.artistPortalSquareCard.tokenize();
                if (result.status === 'OK') {
                    await window.processArtistPortalPaymentWithMethod('square', result.token);
                } else {
                    console.error('Square tokenization failed:', result.errors);
                    Swal.fire({ icon: 'error', title: 'Card Error', text: 'Card tokenization failed: ' + (result.errors[0]?.detail || 'Unknown error') });
                }
            } catch (error) {
                console.error('Square payment error:', error);
                Swal.fire({ icon: 'error', title: 'Square Error', text: 'Square payment failed: ' + error.message });
            }
        };

        window.processArtistPortalPaymentWithMethod = async function(method, paymentMethodId = null) {
            try {
                const planNameEl = document.getElementById('selectedArtistPortalPlanName');
                const planPriceEl = document.getElementById('selectedArtistPortalPlanPrice');
                const planPriceText = planPriceEl.textContent.replace('£', '').replace('Free', '0');
                const planPrice = parseFloat(planPriceText) || 0;

                const paymentMethodNames = {
                    'stripe': 'Stripe',
                    'google-pay': 'Google Pay (via Stripe)',
                    'apple-pay': 'Apple Pay (via Stripe)',
                    'paypal': 'PayPal',
                    'square': 'Square',
                    'free': 'Free'
                };

                const response = await fetch(@json(url('/api/artist-subscription/purchase')), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    },
                    body: JSON.stringify({
                        plan_id: window.selectedArtistPortalPlan,
                        plan_type: planNameEl ? planNameEl.textContent.toLowerCase().replace(/\s+/g, '-') : '',
                        price: planPrice,
                        duration: 30,
                        payment_method: method,
                        payment_method_name: paymentMethodNames[method] || method,
                        payment_method_id: paymentMethodId
                    })
                });

                const responseText = await response.text();
                let data;
                try {
                    data = JSON.parse(responseText);
                } catch (parseError) {
                    throw new Error('Endpoint returned a non-JSON response. Status: ' + response.status);
                }

                if (!response.ok) {
                    throw new Error(data.message || data.error || ('Request failed with status ' + response.status));
                }

                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Artist subscription purchased successfully!',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.closeArtistPortalSubscriptionPopup();
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Purchase Failed',
                        text: data.message || 'Failed to purchase subscription'
                    });
                }
            } catch (error) {
                console.error('Subscription purchase error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to purchase subscription. Please try again.'
                });
            }
        }
        </script>







