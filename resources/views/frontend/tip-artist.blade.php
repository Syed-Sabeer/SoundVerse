@extends('layouts.frontend.master')

@section('css')
  <style>
    .artistTip_sec {
        padding:3rem 0;
        position: relative;
    }
    .bottom_fixedMucicPlayer .player-controls {
        display: none;
    }
.artistTip_sec .artist-profile {
    background: #15012a !important;
    backdrop-filter: blur(10px);
    border-radius: 25px;
    padding: 40px;
    border: 1px solid rgb(103 58 183 / 63%);
    margin-bottom: 40px;
    animation: artistTip_fadeIn 0.6s ease;
}

.artistTip_sec .profile-header {
    display: flex;
    align-items: center;
    gap: 30px;
    margin-bottom: 30px;
    flex-wrap: wrap;
}

.artistTip_sec .artist-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3em;
    border: 4px solid rgba(255, 255, 255, 0.2);
    overflow: hidden;
}

.artistTip_sec .artist-avatar img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
}

.artistTip_sec .artist-info h2 {
    font-size: 2em;
    margin-bottom: 10px;
    font-family: 'Poppins';
    font-weight: 500;
    color: white;
}

.artistTip_sec .artist-info p {
    color: #b8b8d4;
    font-size: 1.1em;
}

/* Artist Selection */
.artistTip_sec .artist-selection {
    background: linear-gradient(135deg, rgb(22 6 50), rgb(20 7 42));
    border: 2px solid rgb(103 58 183 / 76%);
    border-radius: 20px;
    padding: 35px;
    margin-bottom: 30px;
}

.artistTip_sec .artist-selection h3 {
    color: white;
    margin-bottom: 20px;
    font-size: 1.5em;
}

.artistTip_sec .artist-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 15px;
}

.artistTip_sec .artist-item {
    background: rgba(255, 255, 255, 0.08);
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 15px;
    padding: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
}

.artistTip_sec .artist-item:hover {
    border-color: #673AB7;
    background: rgb(159 84 245 / 14%);
    transform: translateY(-3px);
}

.artistTip_sec .artist-item.selected {
    border-color: #9f54f5;
    background: rgb(159 84 245 / 20%);
}

.artistTip_sec .artist-item-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    margin: 0 auto 10px;
    overflow: hidden;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.artistTip_sec .artist-item-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.artistTip_sec .artist-item-name {
    color: white;
    font-weight: 600;
    font-size: 0.95em;
}

/* ================= SUPPORT SECTION ================= */

.artistTip_sec .support-section {
        background: linear-gradient(135deg, rgb(22 6 50), rgb(20 7 42));
    border: 2px solid rgb(103 58 183 / 76%);
    border-radius: 20px;
    padding: 35px;
    margin-top: 30px;
}

.artistTip_sec .support-header {
    text-align: center;
    margin-bottom: 30px;
}

.artistTip_sec .support-header h3 {
    font-size: 1.8em;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    font-family: 'Poppins';
    color: white;
}

.artistTip_sec .support-header p {
    color: #b8b8d4;
    font-size: 1em;
}

/* ================= TIP OPTIONS ================= */

.artistTip_sec .tip-options {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 15px;
    margin-bottom: 25px;
}

.artistTip_sec .tip-option {
    background: rgba(255, 255, 255, 0.08);
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 15px;
    padding: 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.artistTip_sec .tip-option:hover {
    transform: translateY(-5px);
        border-color: #673AB7 !important;
    background: rgb(159 84 245 / 14%) !important;
}

.artistTip_sec .tip-option.selected {
    border-color: #9f54f5 !important;
        box-shadow: 0 0 20px rgb(103 58 183 / 55%);
}

.artistTip_sec .tip-option.selected::after {
    content: '✓';
    position: absolute;
    top: 10px;
    right: 10px;
    background: #9f54f5;
    width: 25px;
    height: 25px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9em;
    color:white;
}

.artistTip_sec .tip-amount {
    font-size: 2em;
    font-weight: 700;
    color: #fff;
    margin-bottom: 5px;
}

.artistTip_sec .tip-label {
    font-size: 0.85em;
    color: #b8b8d4;
}

/* ================= CUSTOM AMOUNT ================= */

.artistTip_sec .custom-amount {
    margin-top: 20px;
}

.artistTip_sec .custom-amount label {
    display: block;
    margin-bottom: 10px;
    font-weight: 600;
    color: #b8b8d4;
}

.artistTip_sec .custom-input-wrapper {
    display: flex;
    gap: 10px;
}

.artistTip_sec .custom-input-wrapper input {
    flex: 1;
    padding: 15px 20px;
    background: rgba(255, 255, 255, 0.08);
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    color: #fff;
    font-size: 1.1em;
    transition: all 0.3s ease;
}

.artistTip_sec .custom-input-wrapper input:focus {
    outline: none;
    border-color: #673AB7 ;
    background: rgba(255, 255, 255, 0.12);
}

/* ================= TIP BUTTON ================= */

.artistTip_sec .tip-button {
    width: 100%;
    padding: 18px;
    background-color: #9f54f5;
    border: none;
    border-radius: 15px;
    font-size: 1.2em;
    font-weight: 700;
    color: #fff;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.artistTip_sec .tip-button:hover {
    transform: scale(1.02);
    box-shadow: 0 10px 30px #673ab785 !important;
}

.artistTip_sec .tip-button:active {
    transform: scale(0.98);
}

.artistTip_sec .tip-button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
}

/* ================= MODAL ================= */

.artistTip_sec .modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.8);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 99999999999;
    backdrop-filter: blur(5px);
    animation: artistTip_fadeIn 0.3s ease;
}

.artistTip_sec .modal-overlay.active {
    display: flex;
}

.artistTip_sec .modal {
    background: linear-gradient(135deg, #1a1a2e, #16213e);
    border-radius: 25px;
    padding: 40px;
    max-width: 500px;
    width: 90%;
    border: 2px solid rgba(255, 255, 255, 0.1);
    animation: artistTip_slideUp 0.4s ease;
    position: relative;
    display:block;
    height: auto;
    max-height: 90vh;
    overflow-y: auto;
}

.artistTip_sec .modal-close {
    position: absolute;
    top: 20px;
    right: 20px;
    background: rgba(255, 255, 255, 0.1);
    border: none;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    color: #fff;
    font-size: 1.5em;
    cursor: pointer;
    transition: all 0.3s ease;
}

.artistTip_sec .modal-close:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: rotate(90deg);
}

/* ================= MODAL CONTENT ================= */

.artistTip_sec .modal-header {
    text-align: center;
    margin-bottom: 30px;
    justify-content:center;
}

.artistTip_sec .modal-header h3 {
   font-size: 1.8em;
    margin-bottom: 10px;
    font-family: 'Poppins';
    font-weight: 500;
    color: white;
}

.artistTip_sec .modal-icon {
    font-size: 4em;
    margin-bottom: 15px;
}

.artistTip_sec .payment-details {
        background: rgb(13 1 34 / 27%) !important;
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 25px;
    border: 2px solid #8a4eef;
}

.artistTip_sec .payment-row {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.artistTip_sec .payment-row:last-child {
    border-bottom: none;
    font-size: 1.2em;
    font-weight: 700;
    color: #a877ff;
}

.artistTip_sec .payment-label {
    color: #ffffff;
}

.artistTip_sec .payment-value {
    font-weight: 600;
}

/* ================= PAYMENT METHODS ================= */

.artistTip_sec .payment-methods {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
    gap: 15px;
    margin-bottom: 25px;
}

.artistTip_sec .payment-method {
    background: rgba(255, 255, 255, 0.08);
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    padding: 20px 10px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.9em;
}

.artistTip_sec .payment-method:hover {
    border-color: #8d50f1;
    background: rgba(245, 87, 108, 0.1);
}

.artistTip_sec .payment-method.selected {
        border-color: #9f54f5;
    background: rgb(18 1 48 / 21%);
}

.artistTip_sec .payment-method-icon {
    font-size: 2em;
    margin-bottom: 8px;
}

.artistTip_sec .payment-method-icon.google-pay-icon {
    width: 84px;
    height: 54px;
    margin: 0 auto 8px;
    background: #ffffff;
    border-radius: 10px;
    padding: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.artistTip_sec .payment-method-icon.google-pay-icon img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    display: block;
}

/* Payment Forms */
.artistTip_sec .payment-form {
    display: none;
    margin-bottom: 20px;
}

.artistTip_sec .payment-form.active {
    display: block;
}

.artistTip_sec #stripe-card-element {
    background: rgba(255, 255, 255, 0.1);
    padding: 15px;
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    margin-bottom: 10px;
}

.artistTip_sec #stripe-card-errors {
    color: #f5576c;
    font-size: 0.9em;
    margin-top: 5px;
}

/* ================= CONFIRM & STATUS ================= */

.artistTip_sec .confirm-button {
    width: 100%;
    padding: 18px;
    background: linear-gradient(45deg, #9f54f5, #884eef) ;
    border: none;
    border-radius: 15px;
    font-size: 1.2em;
    font-weight: 700;
    color: #ffffff;
    cursor: pointer;
    transition: all 0.3s ease;
}

.artistTip_sec .confirm-button:hover {
    transform: scale(1.02);
    box-shadow: 0 10px 30px rgba(67, 233, 123, 0.4);
}

.artistTip_sec .confirm-button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
}

.artistTip_sec .success-modal .modal-icon {
    color: #43e97b;
}

.artistTip_sec .error-modal .modal-icon {
    color: #f5576c;
}

.artistTip_sec .message-text {
    text-align: center;
    color: #b8b8d4;
    line-height: 1.6;
    margin-bottom: 25px;
}

/* ================= ANIMATIONS ================= */

@keyframes artistTip_fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes artistTip_slideUp {
    from {
        opacity: 0;
        transform: translateY(50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ================= RESPONSIVE ================= */

@media (max-width: 991px) {
    .artistTip_sec {
        padding:5rem 0;
    }
}
@media (max-width: 768px) {
    .artistTip_sec .profile-header {
        flex-direction: column;
        text-align: center;
    }

    .artistTip_sec .tip-options {
        grid-template-columns: 1fr 1fr;
    }

    .artistTip_sec .payment-methods {
        grid-template-columns: 1fr;
    }

    .artistTip_sec .modal {
        padding: 30px 20px;
    }
    .artistTip_sec .modal {
        height: 500px !important;
    }
}

@media (max-width: 476px) { 
    .artistTip_sec .artist-profile {
        padding: 14px;
    }
    .artistTip_sec .tip-amount {
            font-size: 24px;
    }
    .artistTip_sec .tip-label {
            font-size: 12px;
    }
}

/* ================= ARTIST SELECTION ================= */
.artistTip_sec .artist-selection {
    background: #15012a !important;
    backdrop-filter: blur(10px);
    border-radius: 25px;
    padding: 40px;
    border: 1px solid rgb(103 58 183 / 63%);
    margin-bottom: 40px;
    animation: artistTip_fadeIn 0.6s ease;
}

.artistTip_sec .artist-selection h3 {
    color: white;
    text-align: center;
    margin-bottom: 30px;
    font-size: 1.8em;
}

.artistTip_sec .artist-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 20px;
}

.artistTip_sec .artist-item {
    background: rgba(255, 255, 255, 0.08);
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 15px;
    padding: 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.artistTip_sec .artist-item:hover {
    transform: translateY(-5px);
    border-color: #673AB7 !important;
    background: rgb(159 84 245 / 14%) !important;
}

.artistTip_sec .artist-item-avatar {
    width: 80px;
    height: 80px;
    margin: 0 auto 15px;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid rgba(255, 255, 255, 0.2);
}

.artistTip_sec .artist-item-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.artistTip_sec .artist-item-name {
    color: #fff;
    font-weight: 600;
    font-size: 0.95em;
}

/* ================= PAYMENT FORMS ================= */
.artistTip_sec .payment-form {
    display: none;
    margin-bottom: 20px;
}

.artistTip_sec .payment-form.active {
    display: block;
}

.artistTip_sec #stripe-card-element {
    background: rgba(255, 255, 255, 0.1);
    padding: 15px;
    border-radius: 8px;
    border: 2px solid rgba(255, 255, 255, 0.2);
    margin-bottom: 10px;
}

.artistTip_sec #stripe-card-errors {
    color: #f5576c;
    font-size: 0.9em;
    margin-top: 5px;
    min-height: 20px;
}

.artistTip_sec #square-card-element {
    min-height: 200px;
}
    </style>
@endsection

@section('content')

<section class="artistTip_sec">
    <div class="container">
        @if(!$artist)
            <!-- Artist Selection -->
            <div class="artist-selection">
                <h3>💝 Select an Artist to Tip</h3>
                <p style="color: #b8b8d4; text-align: center; margin-bottom: 30px;">Choose an artist you'd like to support with a tip</p>
                <div class="artist-list">
                    @forelse($artists as $art)
                        @php
                            $avatar = 'https://via.placeholder.com/200x200?text=Artist';
                            if ($art->profile && $art->profile->picture) {
                                $picPath = $art->profile->picture;
                                $picPath = preg_replace('#^(storage/|public/storage/|public/)#', '', $picPath);
                                if (strpos($picPath, 'storage/') !== 0) {
                                    $picPath = 'storage/' . $picPath;
                                }
                                $avatar = asset($picPath);
                            }
                        @endphp
                        <div class="artist-item" onclick="selectArtist({{ $art->id }}, '{{ addslashes($art->name) }}', '{{ $avatar }}')">
                            <div class="artist-item-avatar">
                                <img src="{{ $avatar }}" alt="{{ $art->name }}" onerror="this.src='https://via.placeholder.com/200x200?text=Artist'">
                            </div>
                            <div class="artist-item-name">{{ $art->name }}</div>
                        </div>
                    @empty
                        <p style="color: #b8b8d4; text-align: center; grid-column: 1/-1; padding: 40px;">No artists available</p>
                    @endforelse
                </div>
            </div>
        @endif

        @if($artist)
        <div class="artist-profile" id="artistProfile" style="display: block;">
            <div class="profile-header">
                <div class="artist-avatar">
                    @php
                        $avatar = 'https://via.placeholder.com/200x200?text=Artist';
                        if ($artist->profile && $artist->profile->picture) {
                            $picPath = $artist->profile->picture;
                            $picPath = preg_replace('#^(storage/|public/storage/|public/)#', '', $picPath);
                            if (strpos($picPath, 'storage/') !== 0) {
                                $picPath = 'storage/' . $picPath;
                            }
                            $avatar = asset($picPath);
                        }
                    @endphp
                    <img src="{{ $avatar }}" alt="{{ $artist->name }}" id="artistAvatar" onerror="this.src='https://via.placeholder.com/200x200?text=Artist'">
                </div>
                <div class="artist-info">
                    <h2 id="artistName">{{ $artist->name }}</h2>
                    <p id="artistInfo">
                        @if($artist->profile && $artist->profile->about)
                            {{ Str::limit($artist->profile->about, 100) }}
                        @else
                            Artist on SingWithMe
                        @endif
                    </p>
                </div>
            </div>

            <div class="support-section">
                <div class="support-header">
                    <h3>💝 Support This Artist</h3>
                    <p>Your tip is sent directly to the artist wallet instantly. This helps them create more amazing music!</p>
                </div>

                <div class="tip-options">
                    <div class="tip-option" data-amount="5">
                        <div class="tip-amount">£5</div>
                        <div class="tip-label">Coffee</div>
                    </div>
                    <div class="tip-option" data-amount="10">
                        <div class="tip-amount">£10</div>
                        <div class="tip-label">Studio Time</div>
                    </div>
                    <div class="tip-option" data-amount="20">
                        <div class="tip-amount">£20</div>
                        <div class="tip-label">Super Fan</div>
                    </div>
                    <div class="tip-option" data-amount="50">
                        <div class="tip-amount">£50</div>
                        <div class="tip-label">Legend</div>
                    </div>
                </div>

                <div class="custom-amount">
                    <label>Or enter custom amount:</label>
                    <div class="custom-input-wrapper">
                        <input type="number" id="customAmount" placeholder="Enter amount in £" min="1" step="0.01">
                    </div>
                </div>

                <div class="custom-amount" style="margin-top: 15px;">
                    <label>Message to Artist (Optional):</label>
                    <textarea id="userMessage" class="custom-input-wrapper input" style="min-height: 80px; padding: 15px; background: rgba(255, 255, 255, 0.08); border: 2px solid rgba(255, 255, 255, 0.2); border-radius: 12px; color: #fff; font-size: 1em; resize: vertical;" placeholder="Leave a message for the artist..."></textarea>
                </div>

                <button class="tip-button" id="tipButton">
                    <span>💝</span>
                    <span>Send Tip</span>
                </button>
            </div>
        </div>
        @endif
    </div>

    <!-- Payment Modal -->
    <div class="modal-overlay" id="paymentModal">
        <div class="modal">
            <button class="modal-close" onclick="closeModal('paymentModal')">×</button>
            <div class="modal-header">
                <h3>Complete Your Tip</h3>
            </div>

            <div class="payment-details">
                <div class="payment-row">
                    <span class="payment-label">Artist:</span>
                    <span class="payment-value" id="modalArtistName">{{ $artist->name ?? '' }}</span>
                </div>
                <div class="payment-row">
                    <span class="payment-label">Tip Amount:</span>
                    <span class="payment-value" id="modalAmount">£0</span>
                </div>
                <div class="payment-row">
                    <span class="payment-label">Platform Fee (5%):</span>
                    <span class="payment-value" id="modalFee">£0</span>
                </div>
                <div class="payment-row">
                    <span class="payment-label">Total:</span>
                    <span class="payment-value" id="modalTotal">£0</span>
                </div>
            </div>

            <div class="payment-methods">
                <div class="payment-method selected" data-method="stripe" onclick="selectTipPaymentMethod(this, 'stripe')">
                    <div class="payment-method-icon">💳</div>
                    <div>Card</div>
                </div>
                <div class="payment-method" data-method="paypal" onclick="selectTipPaymentMethod(this, 'paypal')">
                    <div class="payment-method-icon">🅿️</div>
                    <div>PayPal</div>
                </div>
                <div class="payment-method" data-method="google-pay" onclick="selectTipPaymentMethod(this, 'google-pay')">
                    <div class="payment-method-icon google-pay-icon">
                        <img src="{{ asset('FrontendAssets/images/gpay.svg') }}" alt="Google Pay">
                    </div>
                    <div>Google Pay</div>
                </div>
                <div class="payment-method" data-method="apple-pay" onclick="selectTipPaymentMethod(this, 'apple-pay')">
                    <div class="payment-method-icon">🍎</div>
                    <div>Apple Pay</div>
                </div>
                <div class="payment-method" data-method="square" onclick="selectTipPaymentMethod(this, 'square')">
                    <div class="payment-method-icon">⬜</div>
                    <div>Square</div>
                </div>
            </div>

            <!-- Payment Forms -->
            <div id="stripe-payment-form" class="payment-form active">
                <div id="stripe-card-element"></div>
                <div id="stripe-card-errors" role="alert"></div>
            </div>

            <div id="paypal-payment-button" class="payment-form"></div>

            <div id="google-pay-button" class="payment-form"></div>

            <div id="square-payment-form" class="payment-form">
                <div id="square-card-element"></div>
            </div>

            <button class="confirm-button" id="confirmTipButton" onclick="processTipPayment()">Confirm Payment</button>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal-overlay" id="successModal">
        <div class="modal success-modal">
            <button class="modal-close" onclick="closeModal('successModal')">×</button>
            <div class="modal-header">
                <div class="modal-icon">✅</div>
                <h3>Tip Sent Successfully!</h3>
            </div>
            <p class="message-text">
                Your support means the world! Your tip of <strong id="successAmount">£0</strong> has been sent directly to the artist.
            </p>
            <button class="confirm-button" onclick="closeModal('successModal')">Done</button>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal-overlay" id="errorModal">
        <div class="modal error-modal">
            <button class="modal-close" onclick="closeModal('errorModal')">×</button>
            <div class="modal-header">
                <div class="modal-icon">❌</div>
                <h3>Payment Failed</h3>
            </div>
            <p class="message-text" id="errorMessage">
                Oops! Something went wrong with your payment. Please try again or use a different payment method.
            </p>
            <button class="confirm-button" onclick="closeModal('errorModal')">Try Again</button>
        </div>
    </div>
    </section>

     
{{--@include('partials.frontend.newsletter')--}}

<script src="https://js.stripe.com/v3/"></script>
<script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID', 'sb') }}&currency=GBP"></script>
<script src="https://pay.google.com/gp/p/js/pay.js"></script>
<script src="https://sandbox.web.squarecdn.com/v1/square.js"></script>

<script>
    let selectedAmount = 0;
    let selectedArtistId = {{ $artist ? $artist->id : 'null' }};
    let selectedPaymentMethod = 'stripe';
    let tipStripe = null;
    let tipStripeCardElement = null;
    let tipPaypalButtons = null;
    let tipSquareCard = null;
    let tipSquarePayments = null;

    // Initialize Stripe
    function initTipStripe() {
        if (typeof Stripe !== 'undefined' && !tipStripe) {
            const stripeKey = '{{ env("STRIPE_KEY", "") }}';
            if (stripeKey) {
                tipStripe = Stripe(stripeKey);
                const elements = tipStripe.elements();
                tipStripeCardElement = elements.create('card', {
                    style: {
                        base: {
                            fontSize: '16px',
                            color: '#ffffff',
                            '::placeholder': {
                                color: '#aab7c4',
                            },
                        },
                    },
                });
                tipStripeCardElement.mount('#stripe-card-element');
                tipStripeCardElement.on('change', function(event) {
                    const displayError = document.getElementById('stripe-card-errors');
                    if (event.error) {
                        displayError.textContent = event.error.message;
                    } else {
                        displayError.textContent = '';
                    }
                });
            }
        }
    }

    // Initialize PayPal
    function initTipPayPal() {
        if (typeof paypal !== 'undefined' && !tipPaypalButtons) {
            paypal.Buttons({
                createOrder: function(data, actions) {
                    const total = parseFloat(document.getElementById('modalTotal').textContent.replace('£', ''));
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: total.toFixed(2),
                                currency_code: 'GBP'
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        processTipPaymentWithMethod('paypal', details.id);
                    });
                },
                onError: function(err) {
                    showError('PayPal payment failed: ' + err);
                }
            }).render('#paypal-payment-button');
            tipPaypalButtons = true;
        } else if (typeof paypal === 'undefined') {
            const container = document.getElementById('paypal-payment-button');
            if (container) {
                container.innerHTML = '<p style="color:#f5576c;text-align:center;">PayPal failed to load. Please check PAYPAL_CLIENT_ID or try again.</p>';
            }
        }
    }

    // Initialize Google Pay
    function initTipGooglePay() {
        if (typeof google !== 'undefined' && google.payments && google.payments.api) {
            const paymentsClient = new google.payments.api.PaymentsClient({
                environment: 'TEST' // Change to 'PRODUCTION' for live
            });
            
            const button = paymentsClient.createButton({
                onClick: function() {
                    const total = parseFloat(document.getElementById('modalTotal').textContent.replace('£', ''));
                    const paymentDataRequest = {
                        apiVersion: 2,
                        apiVersionMinor: 0,
                        merchantInfo: {
                            merchantId: '{{ env("GOOGLE_PAY_MERCHANT_ID", "") }}',
                            merchantName: 'SingWithMe'
                        },
                        allowedPaymentMethods: [{
                            type: 'CARD',
                            parameters: {
                                allowedAuthMethods: ['PAN_ONLY', 'CRYPTOGRAM_3DS'],
                                allowedCardNetworks: ['AMEX', 'DISCOVER', 'JCB', 'MASTERCARD', 'VISA']
                            },
                            tokenizationSpecification: {
                                type: 'PAYMENT_GATEWAY',
                                parameters: {
                                    gateway: 'stripe',
                                    'stripe:version': '2018-10-31',
                                    'stripe:publishableKey': '{{ env("STRIPE_KEY", "") }}'
                                }
                            }
                        }],
                        transactionInfo: {
                            totalPriceStatus: 'FINAL',
                            totalPrice: total.toFixed(2),
                            currencyCode: 'GBP'
                        }
                    };
                    
                    paymentsClient.loadPaymentData(paymentDataRequest)
                        .then(function(paymentData) {
                            const paymentMethodData = paymentData.paymentMethodData;
                            processTipPaymentWithMethod('google-pay', paymentMethodData.tokenizationData.token);
                        })
                        .catch(function(err) {
                            showError('Google Pay failed: ' + err.message);
                        });
                }
            });
            
            const container = document.getElementById('google-pay-button');
            if (container) {
                container.innerHTML = '';
                container.appendChild(button);
            }
        }
    }

    // Initialize Square
    async function initTipSquare() {
        if (typeof Square !== 'undefined' && !tipSquarePayments) {
            try {
                tipSquarePayments = Square.payments('{{ env("SQUARE_APPLICATION_ID", "") }}', '{{ env("SQUARE_LOCATION_ID", "") }}');
                tipSquareCard = await tipSquarePayments.card();
                await tipSquareCard.attach('#square-card-element');
            } catch (error) {
                console.error('Square initialization error:', error);
            }
        }
    }

    // Handle tip option selection
    document.querySelectorAll('.tip-option').forEach(option => {
        option.addEventListener('click', function() {
            document.querySelectorAll('.tip-option').forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
            selectedAmount = parseFloat(this.dataset.amount);
            document.getElementById('customAmount').value = '';
        });
    });

    // Handle custom amount input
    document.getElementById('customAmount')?.addEventListener('input', function() {
        document.querySelectorAll('.tip-option').forEach(opt => opt.classList.remove('selected'));
        selectedAmount = parseFloat(this.value) || 0;
    });

    // Select payment method
    function selectTipPaymentMethod(element, method) {
        document.querySelectorAll('.payment-method').forEach(m => m.classList.remove('selected'));
        element.classList.add('selected');
        selectedPaymentMethod = method;
        
        // Show/hide payment forms
        document.querySelectorAll('.payment-form').forEach(form => form.classList.remove('active'));
        if (method === 'stripe') {
            document.getElementById('stripe-payment-form').classList.add('active');
            initTipStripe();
        } else if (method === 'paypal') {
            document.getElementById('paypal-payment-button').classList.add('active');
            initTipPayPal();
        } else if (method === 'google-pay') {
            document.getElementById('google-pay-button').classList.add('active');
            initTipGooglePay();
        } else if (method === 'square') {
            document.getElementById('square-payment-form').classList.add('active');
            initTipSquare();
        }
    }

    // Open payment modal
    document.getElementById('tipButton')?.addEventListener('click', function() {
        if (!selectedArtistId) {
            alert('Please select an artist first');
            return;
        }
        
        if (selectedAmount < 1) {
            alert('Please select a tip amount of at least £1');
            return;
        }

        const fee = Math.round(selectedAmount * 0.05 * 100) / 100;
        const total = selectedAmount + fee;

        document.getElementById('modalAmount').textContent = '£' + selectedAmount.toFixed(2);
        document.getElementById('modalFee').textContent = '£' + fee.toFixed(2);
        document.getElementById('modalTotal').textContent = '£' + total.toFixed(2);

        openModal('paymentModal');
        
        // Initialize payment methods
        setTimeout(() => {
            if (selectedPaymentMethod === 'stripe') {
                initTipStripe();
            } else if (selectedPaymentMethod === 'paypal') {
                initTipPayPal();
            }
        }, 100);
    });

    // Process tip payment
    async function processTipPayment() {
        if (selectedPaymentMethod === 'stripe') {
            if (!tipStripe || !tipStripeCardElement) {
                showError('Stripe not initialized. Please wait a moment and try again.');
                return;
            }
            
            const {error, paymentMethod} = await tipStripe.createPaymentMethod({
                type: 'card',
                card: tipStripeCardElement,
            });
            
            if (error) {
                showError('Stripe payment failed: ' + error.message);
                return;
            }
            
            await processTipPaymentWithMethod('stripe', paymentMethod.id);
        } else if (selectedPaymentMethod === 'paypal') {
            showError('Please complete the PayPal payment above');
        } else if (selectedPaymentMethod === 'google-pay') {
            showError('Please use the Google Pay button above');
        } else if (selectedPaymentMethod === 'apple-pay') {
            await processTipPaymentWithMethod('apple-pay');
        } else if (selectedPaymentMethod === 'square') {
            if (!tipSquareCard) {
                showError('Square not initialized');
                return;
            }
            try {
                const result = await tipSquareCard.tokenize();
                if (result.status === 'OK') {
                    await processTipPaymentWithMethod('square', result.token);
                } else {
                    showError('Square payment failed');
                }
            } catch (error) {
                showError('Square payment error: ' + error.message);
            }
        }
    }

    // Process payment with method
    async function processTipPaymentWithMethod(method, paymentMethodId = null) {
        const confirmBtn = document.getElementById('confirmTipButton');
        if (confirmBtn) {
            confirmBtn.disabled = true;
            confirmBtn.textContent = 'Processing...';
        }

        try {
            const userMessage = document.getElementById('userMessage')?.value || null;
            const total = parseFloat(document.getElementById('modalTotal').textContent.replace('£', ''));

            const response = await fetch('{{ route("api.tip.process") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    artist_id: selectedArtistId,
                    amount: selectedAmount,
                    payment_method: method,
                    payment_method_id: paymentMethodId,
                    user_message: userMessage
                })
            });

            const data = await response.json();

            if (data.success) {
                document.getElementById('successAmount').textContent = '£' + selectedAmount.toFixed(2);
                closeModal('paymentModal');
                openModal('successModal');
                
                // Reset form
                document.querySelectorAll('.tip-option').forEach(opt => opt.classList.remove('selected'));
                document.getElementById('customAmount').value = '';
                document.getElementById('userMessage').value = '';
                selectedAmount = 0;
            } else {
                showError(data.message || 'Payment failed. Please try again.');
            }
        } catch (error) {
            console.error('Tip payment error:', error);
            showError('Error processing payment: ' + error.message);
        } finally {
            if (confirmBtn) {
                confirmBtn.disabled = false;
                confirmBtn.textContent = 'Confirm Payment';
            }
        }
    }

    // Select artist
    function selectArtist(artistId, artistName, artistAvatar) {
        selectedArtistId = artistId;
        
        // Update modal artist name
        const modalArtistName = document.getElementById('modalArtistName');
        if (modalArtistName) {
            modalArtistName.textContent = artistName;
        }
        
        // Check if artist profile section exists
        let artistProfile = document.getElementById('artistProfile');
        
        if (!artistProfile) {
            // Create artist profile section dynamically
            const container = document.querySelector('.container');
            const artistSelection = document.querySelector('.artist-selection');
            
            artistProfile = document.createElement('div');
            artistProfile.id = 'artistProfile';
            artistProfile.className = 'artist-profile';
            artistProfile.innerHTML = `
                <div class="profile-header">
                    <div class="artist-avatar">
                        <img src="${artistAvatar}" alt="${artistName}" id="artistAvatar">
                    </div>
                    <div class="artist-info">
                        <h2 id="artistName">${artistName}</h2>
                        <p id="artistInfo">Artist on SingWithMe</p>
                    </div>
                </div>
                <div class="support-section">
                    <div class="support-header">
                        <h3>💝 Support This Artist</h3>
                        <p>Your tip goes to the admin first, then will be sent to the artist. This helps them create more amazing music!</p>
                    </div>
                    <div class="tip-options">
                        <div class="tip-option" data-amount="5">
                            <div class="tip-amount">£5</div>
                            <div class="tip-label">Coffee</div>
                        </div>
                        <div class="tip-option" data-amount="10">
                            <div class="tip-amount">£10</div>
                            <div class="tip-label">Studio Time</div>
                        </div>
                        <div class="tip-option" data-amount="20">
                            <div class="tip-amount">£20</div>
                            <div class="tip-label">Super Fan</div>
                        </div>
                        <div class="tip-option" data-amount="50">
                            <div class="tip-amount">£50</div>
                            <div class="tip-label">Legend</div>
                        </div>
                    </div>
                    <div class="custom-amount">
                        <label>Or enter custom amount:</label>
                        <div class="custom-input-wrapper">
                            <input type="number" id="customAmount" placeholder="Enter amount in £" min="1" step="0.01">
                        </div>
                    </div>
                    <div class="custom-amount" style="margin-top: 15px;">
                        <label>Message to Artist (Optional):</label>
                        <textarea id="userMessage" class="custom-input-wrapper input" style="min-height: 80px; padding: 15px; background: rgba(255, 255, 255, 0.08); border: 2px solid rgba(255, 255, 255, 0.2); border-radius: 12px; color: #fff; font-size: 1em; resize: vertical;" placeholder="Leave a message for the artist..."></textarea>
                    </div>
                    <button class="tip-button" id="tipButton">
                        <span>💝</span>
                        <span>Send Tip</span>
                    </button>
                </div>
            `;
            
            // Insert after artist selection or at the end of container
            if (artistSelection && artistSelection.nextSibling) {
                container.insertBefore(artistProfile, artistSelection.nextSibling);
            } else {
                container.appendChild(artistProfile);
            }
            
            // Re-attach event listeners for tip options
            document.querySelectorAll('#artistProfile .tip-option').forEach(option => {
                option.addEventListener('click', function() {
                    document.querySelectorAll('.tip-option').forEach(opt => opt.classList.remove('selected'));
                    this.classList.add('selected');
                    selectedAmount = parseFloat(this.dataset.amount);
                    const customAmount = document.getElementById('customAmount');
                    if (customAmount) customAmount.value = '';
                });
            });
            
            // Re-attach custom amount listener
            const customAmount = document.getElementById('customAmount');
            if (customAmount) {
                customAmount.addEventListener('input', function() {
                    document.querySelectorAll('.tip-option').forEach(opt => opt.classList.remove('selected'));
                    selectedAmount = parseFloat(this.value) || 0;
                });
            }
            
            // Re-attach tip button listener
            const tipButton = document.getElementById('tipButton');
            if (tipButton) {
                tipButton.addEventListener('click', function() {
                    if (!selectedArtistId) {
                        alert('Please select an artist first');
                        return;
                    }
                    
                    if (selectedAmount < 1) {
                        alert('Please select a tip amount of at least £1');
                        return;
                    }

                    const fee = Math.round(selectedAmount * 0.05 * 100) / 100;
                    const total = selectedAmount + fee;

                    document.getElementById('modalAmount').textContent = '£' + selectedAmount.toFixed(2);
                    document.getElementById('modalFee').textContent = '£' + fee.toFixed(2);
                    document.getElementById('modalTotal').textContent = '£' + total.toFixed(2);

                    openModal('paymentModal');
                    
                    setTimeout(() => {
                        if (selectedPaymentMethod === 'stripe') {
                            initTipStripe();
                        } else if (selectedPaymentMethod === 'paypal') {
                            initTipPayPal();
                        }
                    }, 100);
                });
            }
        } else {
            // Update existing profile
            const nameEl = document.getElementById('artistName');
            const avatarEl = document.getElementById('artistAvatar');
            if (nameEl) nameEl.textContent = artistName;
            if (avatarEl) avatarEl.src = artistAvatar;
        }
        
        // Hide artist selection
        const artistSelection = document.querySelector('.artist-selection');
        if (artistSelection) {
            artistSelection.style.display = 'none';
        }
        
        // Show artist profile
        artistProfile.style.display = 'block';
        
        // Scroll to profile
        artistProfile.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    // Modal functions
    function openModal(modalId) {
        document.getElementById(modalId).classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    function showError(message) {
        document.getElementById('errorMessage').textContent = message;
        openModal('errorModal');
    }

    // Close modal on overlay click
    document.querySelectorAll('.modal-overlay').forEach(overlay => {
        overlay.addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal(this.id);
            }
        });
    });

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof Stripe !== 'undefined') {
            initTipStripe();
        }
        if (typeof paypal !== 'undefined') {
            initTipPayPal();
        }
        if (typeof google !== 'undefined' && google.payments) {
            initTipGooglePay();
        }
        if (typeof Square !== 'undefined') {
            initTipSquare();
        }
    });
</script>
@endsection
