@extends('layouts.frontend.master')


@section('css')
<style>
    .right-panel{
        overflow-y: scroll;
        height: 700px;
    }

    /* Search Results Styles */
    .search-results {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        max-height: 300px;
        overflow-y: auto;
        z-index: 1000;
        margin-top: 4px;
    }

    .search-result-item {
        padding: 12px 16px;
        border-bottom: 1px solid #f3f4f6;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 12px;
        transition: background-color 0.2s;
    }

    .search-result-item:hover {
        background-color: #f9fafb;
    }

    .search-result-item:last-child {
        border-bottom: none;
    }

    .search-result-thumbnail {
        width: 40px;
        height: 40px;
        border-radius: 4px;
        object-fit: cover;
    }

    .search-result-info h5 {
        margin: 0;
        font-size: 14px;
        font-weight: 600;
        color: #111827;
    }

    .search-result-info p {
        margin: 0;
        font-size: 12px;
        color: #6b7280;
    }

    .search-loading {
        padding: 12px 16px;
        text-align: center;
        color: #6b7280;
        font-size: 14px;
    }

    .search-no-results {
        padding: 12px 16px;
        text-align: center;
        color: #6b7280;
        font-size: 14px;
    }

    /* Selected Songs Styles */
    .selected-song-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 8px 12px;
        background: #f3f4f6;
        border-radius: 6px;
        margin-bottom: 8px;
        position: relative;
    }

    .selected-song-thumbnail {
        width: 32px;
        height: 32px;
        border-radius: 4px;
        object-fit: cover;
    }

    .selected-song-info {
        flex: 1;
    }

    .selected-song-info h6 {
        margin: 0;
        font-size: 13px;
        font-weight: 600;
        color: #111827;
    }

    .selected-song-info p {
        margin: 0;
        font-size: 11px;
        color: #6b7280;
    }

    .remove-song-btn {
        background: #ef4444;
        color: white;
        border: none;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 12px;
        line-height: 1;
    }

    .remove-song-btn:hover {
        background: #dc2626;
    }

    /* Form group relative positioning for search */
    .form-group {
        position: relative;
    }

    /* Search result item hover effects */
    .search-result-item:hover {
        background-color: #f9fafb;
        border-color: #d1d5db;
    }

    /* Error message styles */
    .error-message {
        color: #ef4444;
        font-size: 12px;
        margin-top: 4px;
        display: block;
    }

    .form-input.error {
        border-color: #ef4444;
        box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.1);
    }

    /* Success message styles */
    .success-message {
        color: #10b981;
        font-size: 14px;
        margin-bottom: 16px;
        padding: 12px;
        background: #ecfdf5;
        border: 1px solid #d1fae5;
        border-radius: 8px;
        display: none;
    }

    /* Login form specific styles */
    .login-form .form-group:nth-child(1) {
        display: none; /* Hide name field for login */
    }

    .login-form .form-group:nth-child(2) {
        display: none; /* Hide password confirmation for login */
    }

    .login-form .checkbox-group {
        display: none; /* Hide checkboxes for login */
    }

    /* User actions styles */
    .user-actions {
        display: flex;
        gap: 12px;
        align-items: center;
        margin-top: 16px;
    }

    .user-actions .btn {
        padding: 10px 20px;
        border-radius: 25px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .user-actions .btn-outline-light {
        border: 2px solid rgba(255, 255, 255, 0.3);
        color: white;
        background: transparent;
    }

    .user-actions .btn-outline-light:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.5);
        transform: translateY(-2px);
    }

    /* Favorites Grid Styles */
    .favorites-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .favorite-song-card {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 16px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
        cursor: pointer;
    }
    .favorites-grid .fvtBtn {
        display: flex;
        align-items: center;
        margin:0 auto;
        background: #9959f6;
        border: none;
    }
    .uniqueBtnnn {
        background: #9959f6;
        border: none;
    }
    .uniqueBtnnn:hover{
        background:white;
        color:black;
    }
    .favorites-grid .fvtBtn i {
        margin-bottom:0;
        font-size:16px;
    }
    .favorite-song-card:hover {
        transform: translateY(-5px);
        background: rgba(255, 255, 255, 0.15);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .favorite-song-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }

    .favorite-song-thumbnail {
        width: 50px;
        height: 50px;
        border-radius: 8px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .favorite-song-info {
        flex: 1;
        min-width: 0;
    }

    .favorite-song-title {
        font-size: 16px;
        font-weight: 600;
        color: white;
        margin: 0 0 4px 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .favorite-song-artist {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .favorite-song-actions {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .favorite-song-btn {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 14px;
    }

    .favorite-song-btn:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: scale(1.1);
    }

    .favorite-song-btn.play-btn {
        background: #1db954;
    }
    .favorite-song-actions .favorite-song-btn.play-btn {
        background: transparent;
    }
    .favorite-song-btn.play-btn:hover {
       // background: #1ed760;
    }

    .favorite-song-btn.remove-btn {
        background: #e74c3c;
    }

    .favorite-song-btn.remove-btn:hover {
        background: #c0392b;
    }

    .favorite-song-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 12px;
        color: rgba(255, 255, 255, 0.6);
    }

    .favorite-song-duration {
        font-weight: 500;
    }

    .favorite-song-added {
        font-style: italic;
    }

    .no-favorites {
        text-align: center;
        padding: 40px 20px;
        color: rgba(255, 255, 255, 0.7);
    }

    .no-favorites i {
       font-size: 30px ;
        margin-bottom: 16px;
        opacity: 1 ;
    }

    .no-favorites h4 {
        margin-bottom: 8px;
        color: white;
    }

    .no-favorites p {
        margin-bottom: 20px;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .favorites-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .favorite-song-card {
            padding: 12px;
        }

        .favorite-song-thumbnail {
            width: 40px;
            height: 40px;
        }

        .favorite-song-title {
            font-size: 14px;
        }

        .favorite-song-artist {
            font-size: 12px;
        }

        .favorite-song-btn {
            width: 32px;
            height: 32px;
            font-size: 12px;
        }
    }

    /* Subscription Popup Styles - Theme Matching */
    .subscription-popup {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 10000;
    }

    .subscription-popup.active {
        display: block;
    }

    .subscription-popup .overlay {
        background: linear-gradient(135deg, rgb(28 28 28 / 24%) 0%, rgb(42 42 42 / 42%) 100%);
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        backdrop-filter: blur(10px);
    }

    .subscription-popup .popup {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        background: #290d46;
        border-radius: 20px;
        max-width: 600px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 20px 40px rgba(17, 10, 92, 0.3);
        border: 1px solid rgba(229, 209, 250, 0.3);
    }

    .subscription-popup .popup-header {
        padding: 30px 30px 0 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid rgba(229, 209, 250, 0.3);
    }

    .subscription-popup .popup-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: white;
        margin: 0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .subscription-popup .close-btn {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(229, 209, 250, 0.3);
        font-size: 1.5rem;
        color: white;
        cursor: pointer;
        padding: 8px;
        border-radius: 50%;
        transition: all 0.3s ease;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .subscription-popup .close-btn:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: scale(1.1);
    }

    .subscription-details {
        padding: 30px;
    }

    .plan-info {
        text-align: center;
        margin-bottom: 30px;
        padding: 25px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        border: 1px solid rgba(229, 209, 250, 0.3);
        backdrop-filter: blur(10px);
    }

    .plan-info h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin: 0 0 10px 0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .plan-info .plan-price {
        font-size: 3rem;
        font-weight: 800;
        color:#b379f5;
        margin: 0 0 8px 0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .plan-info .plan-period {
        font-size: 1rem;
        color: rgba(229, 209, 250, 0.8);
        margin: 0;
        font-weight: 500;
    }

    .payment-methods {
        margin-bottom: 30px;
    }

    .payment-methods h4 {
        color: white;
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 15px;
        text-align: center;
    }

    .subscription-popup .payment-method {
        display: flex;
        align-items: center;
        padding: 20px;
        border: 2px solid rgba(229, 209, 250, 0.3);
        border-radius: 15px;
        margin-bottom: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
    }

    .subscription-popup .payment-method:hover {
        border-color: rgba(229, 209, 250, 0.6);
        background: rgba(255, 255, 255, 0.1);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(17, 10, 92, 0.2);
    }

    .subscription-popup .payment-method.selected {
        border-color: #1db954;
        background: rgba(29, 185, 84, 0.1);
        box-shadow: 0 0 20px rgba(29, 185, 84, 0.3);
    }

    .subscription-popup .payment-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: 700;
        margin-right: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .subscription-popup .payment-icon.stripe {
        background: linear-gradient(135deg, #635bff 0%, #4f46e5 100%);
        color: white;
        padding: 0 10px;
    }

    .subscription-popup .payment-icon.google-pay {
        background: linear-gradient(135deg, #4285f4 0%, #34a853 100%);
        color: white;
        padding: 0 14px;
    }

    .subscription-popup .payment-icon.apple-pay {
        background: linear-gradient(135deg, #000000 0%, #333333 100%);
        color: white;
        padding: 0 10px;
    }

    .subscription-popup .payment-icon.paypal {
        background: linear-gradient(135deg, #0070ba 0%, #009cde 100%);
        color: white;
        padding: 0 10px;
    }

    .subscription-popup .payment-icon.square {
        background: linear-gradient(135deg, #00a86b 0%, #00d4aa 100%);
        color: white;
        padding: 0 10px;
    }

    .subscription-popup .payment-info h3 {
        font-size: 1.1rem;
        font-weight: 600;
        color: white;
        margin: 0 0 5px 0;
    }

    .subscription-popup .payment-info p {
        font-size: 0.9rem;
        color: rgba(229, 209, 250, 0.8);
        margin: 0;
    }

    .subscription-terms {
        margin-bottom: 30px;
        text-align: center;
    }

    .checkbox-container {
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 0.9rem;
        color: rgba(229, 209, 250, 0.9);
    }

    .checkbox-container input[type="checkbox"] {
        margin-right: 10px;
        margin-top: 3px;
        transform: scale(1.2);
    }

    .terms-link {
        color: #1db954;
        text-decoration: none;
        font-weight: 600;
        padding: 0 5px;
    }

    .terms-link:hover {
        text-decoration: underline;
        color: #1ed760;
    }

    .subscription-popup .popup-actions {
        padding: 0 30px 30px 30px;
        display: flex;
        gap: 15px;
        justify-content: center;
    }

    .subscription-popup .btn-cancel,
    .subscription-popup .btn-confirm {
        padding: 8px 12px ;
        border-radius: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        font-size: 1rem;
        min-width: 120px;
    }

    .subscription-popup .btn-cancel {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border: 1px solid #9f54f5 ;
    }

    .subscription-popup .btn-cancel:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }

    .subscription-popup .btn-confirm {
        background: #9f54f5;
        color: white;
        box-shadow: 0 4px 15px rgba(29, 185, 84, 0.3);
    }

    .subscription-popup .btn-confirm:hover {
        background: white;
        color:black;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(29, 185, 84, 0.4);
    }

    .subscription-popup .btn-confirm:disabled {
        background: rgba(156, 163, 175, 0.5);
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    /* Payment Forms */
    .payment-form {
        margin-top: 20px;
        padding: 20px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 15px;
        border: 1px solid rgba(229, 209, 250, 0.3);
    }

    .payment-form label {
        color: white;
        font-weight: 600;
        margin-bottom: 10px;
        display: block;
    }

    .stripe-card-element {
        background: white;
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
    }

    .stripe-card-errors {
        color: #ef4444;
        font-size: 14px;
        margin-top: 10px;
    }

    #paypal-button-container {
        width: 100%;
        min-height: 50px;
    }

    .payment-info-text {
        background: rgba(255, 255, 255, 0.1);
        padding: 15px;
        border-radius: 8px;
        border: 1px solid rgba(229, 209, 250, 0.3);
    }

    .payment-info-text p {
        color: rgba(229, 209, 250, 0.9);
        margin: 0;
        font-size: 14px;
        line-height: 1.5;
    }

    .google-pay-container {
        width: 100%;
        min-height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 8px;
        border: 1px solid rgba(229, 209, 250, 0.3);
        padding: 15px;
    }

    .payment-errors {
        color: #ef4444;
        font-size: 14px;
        margin-top: 10px;
        text-align: center;
    }

    /* Current Plan Styling */
    .plan-card.current-plan {
        border: 2px solid rgba(139, 92, 246, 0.6);
        box-shadow: 0 8px 30px rgba(139, 92, 246, 0.3);
        position: relative;
    }

    .plan-card.current-plan::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #8b5cf6, #a855f7);
        border-radius: 12px 12px 0 0;
    }

    .current-plan-indicator {
        position: absolute;
        top: -10px;
        right: 20px;
        background: linear-gradient(135deg, #8b5cf6, #a855f7);
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
        z-index: 10;
    }

    .square-card-container {
        background: white;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        padding: 15px;
        margin-top: 10px;
    }

    .square-card-element {
        width: 100%;
        min-height: 50px;
    }

    .square-card-errors {
        color: #ef4444;
        font-size: 14px;
        margin-top: 10px;
    }

    /* Playlist Section Styles */
    .playlistSection {
        position: relative;
    }

    .playlistSection .create-btn {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
        background: linear-gradient(135deg, #8b5cf6, #a855f7);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer !important;
        margin: 20px auto;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
        pointer-events: auto !important;
        z-index: 1000 !important;
        position: relative;
    }

    .playlistSection .create-btn:hover {
        background: linear-gradient(135deg, #a855f7, #8b5cf6);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(139, 92, 246, 0.4);
    }

    .playlistSection .create-btn span {
        font-size: 20px;
        margin-right: 8px;
    }

    /* Playlist Overlay Styles */
    .playlistSection .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(5px);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }

    .playlistSection .overlay.active {
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .playlistSection .overlay .popup {
        background: linear-gradient(135deg, #290d46 0%, #1a0a2e 100%);
        border-radius: 20px;
        max-width: 600px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        border: 1px solid rgba(139, 92, 246, 0.3);
        position: relative;
        margin: 20px;
    }

    .playlistSection .overlay .popup-header {
        padding: 25px 30px;
        border-bottom: 1px solid rgba(139, 92, 246, 0.3);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .playlistSection .overlay .popup-title {
        color: white;
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
    }

    .playlistSection .overlay .close-btn {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(139, 92, 246, 0.3);
        color: white;
        font-size: 1.5rem;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .playlistSection .overlay .close-btn:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: scale(1.1);
    }

    .playlistSection .overlay .popup-content {
        padding: 30px;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .subscription-popup .popup {
            margin: 10px;
            max-width: calc(100% - 20px);
        }

        .subscription-popup .popup-header {
            padding: 20px 20px 0 20px;
        }

        .subscription-details {
            padding: 20px;
        }

        .subscription-popup .popup-actions {
            padding: 0 20px 20px 20px;
            flex-direction: column;
        }

        .subscription-popup .btn-cancel,
        .subscription-popup .btn-confirm {
            width: 100%;
        }
    }
    @media (max-width: 476px) {
        .checkbox-container {
                display: block;
        }
        .payment-methods .payment-info {
            text-align: left;
        }
        .subscription-popup .payment-info p {
            line-height: 1.4;
        }
    }
</style>
@endsection

@section('content')


         <!-- Start of InnerBanner -->
         <section class="inner-banner contact-banner">
            <div class="contact_child">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="h1-title wow fadeup-animation" data-wow-duration="0.8s" data-wow-delay="0.2s">
                                User Portal Dashboard
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End of InnerBanner -->
        <!-- modal form content -->


        <section class="parent_modalForm">
            <!-- Main page content -->
            <div class="main-content d-none">
                <h1 class="main-title">Welcome to SingWithMe</h1>
                <p class="main-subtitle">Discover amazing music experiences and start your journey today</p>
            </div>

            <!-- Modal Overlay -->
            <div class="modal-overlay" id="modalOverlay" onclick="closeModalOnOverlay(event)">
                <div class="modal-particles">
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                </div>

                <div class="modal-container" onclick="event.stopPropagation()">
                    <button class="close-btn" onclick="closeModal()">&times;</button>

                    <div class="left-panel">
                        <div class="logo">SINGWITHME</div>
                        {{-- <div class="tagline">Start your 30-day free trial now</div> --}}
                        <div class="platform-icons">
                            <div class="icon"><lord-icon src="https://cdn.lordicon.com/zsixeihu.json" trigger="loop"
                                    delay="2000"
                                    colors="primary:#110a5c,secondary:#e5d1fa,tertiary:#e5d1fa,quaternary:#c69cf4"
                                    style="width:250px;height:250px">
                                </lord-icon></div>
                            <div class="icon"><lord-icon src="https://cdn.lordicon.com/wtrpyxpe.json" trigger="loop"
                                    colors="primary:#320a5c,secondary:#c69cf4,tertiary:#a866ee,quaternary:#c69cf4"
                                    style="width:250px;height:250px">
                                </lord-icon></div>
                            <div class="icon"><lord-icon src="https://cdn.lordicon.com/brkvhuny.json" trigger="loop"
                                    colors="primary:#110a5c,secondary:#e5d1fa,tertiary:#110a5c,quaternary:#c69cf4"
                                    style="width:250px;height:250px">
                                </lord-icon></div>
                            <div class="icon"><lord-icon src="https://cdn.lordicon.com/hqkfqrrm.json" trigger="loop"
                                    delay="2000" colors="primary:#320a5c,secondary:#c69cf4,tertiary:#e5d1fa"
                                    style="width:250px;height:250px">
                                </lord-icon></div>
                            <div class="icon"><lord-icon src="https://cdn.lordicon.com/ylmvxcix.json" trigger="loop"
                                    colors="primary:#110a5c,secondary:#e5d1fa,tertiary:#e5d1fa,quaternary:#c69cf4,quinary:#e5d1fa"
                                    style="width:250px;height:250px">
                                </lord-icon></div>
                            <div class="icon"><lord-icon src="https://cdn.lordicon.com/ngukaiic.json" trigger="loop"
                                    delay="2000"
                                    colors="primary:#320a5c,secondary:#c69cf4,tertiary:#320a5c,quaternary:#320a5c"
                                    style="width:250px;height:250px">
                                </lord-icon></div>
                        </div>
                    </div>

                    <div class="right-panel">
                        <div class="form-header">
                            <div class="form-title" id="formTitle">Create an account</div>
                            <div class="form-subtitle" id="formSubtitle">Already have an account? <a href="{{ route('user.login') }}">Log in</a>
                            </div>
                        </div>

                        <div style="text-align: center; padding: 20px;">
                            <a href="{{ route('user.register') }}" class="submit-btn" style="text-decoration: none; display: inline-block; width: 100%; text-align: center; margin-bottom: 10px;">Go to Registration Page</a>
                            <a href="{{ route('user.login') }}" class="submit-btn" style="text-decoration: none; display: inline-block; width: 100%; text-align: center; background-color: #6c757d;">Go to Login Page</a>
                        </div>

                        <form id="authForm" action="{{ route('register.attempt') }}" method="POST" style="display: none;">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" class="form-input" placeholder="Full Name" required value="{{ old('name') }}">
                                @error('name')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" class="form-input" placeholder="Email Address" required value="{{ old('email') }}">
                                @error('email')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="password" name="password" class="form-input" placeholder="Password" required>
                                @error('password')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="password" name="password_confirmation" class="form-input" placeholder="Confirm Password" required>
                            </div>

                            <div class="checkbox-group">
                                <input type="checkbox" class="checkbox" id="newsletter" name="newsletter" value="1">
                                <label class="checkbox-label" for="newsletter">
                                    Keep me up to date with music industry news and promotions
                                </label>
                            </div>

                            <div class="checkbox-group">
                                <input type="checkbox" class="checkbox" id="terms" name="terms" required>
                                <label class="checkbox-label" for="terms">
                                    I have read and agree to SingWithMe's <a href="#">terms of service</a>
                                </label>
                            </div>

                            <button type="submit" class="submit-btn" id="submitBtn" onclick="return false;">Sign Up</button>
                        </form>

                        {{-- <div class="divider">
                            <span>OR</span>
                        </div>

                        <button class="google-btn">
                            <div class="google-icon"></div>
                            Continue with Google
                        </button> --}}

                        <div class="privacy-text">
                            Protected by reCAPTCHA and subject to the Google Privacy Policy and Terms of Service.
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- modal form content -->
        <section class="user-portal py-5">
            <div class="container">
                <!-- Welcome Section -->
                <section class="welcome-section">
                    @auth
                        <h1 class="welcome-title">
                            Welcome back, {{ Auth::user()->name }}
                            @if(isset($subscriptionFeatures) && ($subscriptionFeatures['supporter_badge'] ?? false))
                                <span class="supporter-badge" style="display: inline-block; background: linear-gradient(135deg, #fbbf24, #f59e0b); color: #fff !important; font-size: 0.6rem; padding: 4px 10px; border-radius: 12px; margin-left: 10px; font-weight: 600; vertical-align: middle;">
                                   <span style="color: #fff !important;"> ⭐ Supporter </span>
                                </span>
                            @endif
                            <div class="user-Lord">
                                <lord-icon src="https://cdn.lordicon.com/zsixeihu.json" trigger="loop" delay="2000"
                                    colors="primary:#110a5c,secondary:#e5d1fa,tertiary:#e5d1fa,quaternary:#c69cf4">
                                </lord-icon>
                            </div>
                        </h1>
                        <p class="welcome-subtitle">Ready to discover new music and manage your collections? Here's your
                            music journey overview.</p>
                        <div class="user-actions">
                            <a href="{{ route('logout') }}" class="btn btn-outline-light me-2" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a>
                            <button class="open-popup-btn" onclick="openModal()">Manage Account</button>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <h1 class="welcome-title">Welcome to SingWithMe!
                        <div class="user-Lord">
                            <lord-icon src="https://cdn.lordicon.com/zsixeihu.json" trigger="loop" delay="2000"
                                colors="primary:#110a5c,secondary:#e5d1fa,tertiary:#e5d1fa,quaternary:#c69cf4">
                            </lord-icon>
                        </div>
                    </h1>
                    <p class="welcome-subtitle">Ready to discover new music and manage your collections? Here's your
                        music journey overview.</p>
                    <a href="{{ route('user.login') }}" class="open-popup-btn" style="text-decoration: none; display: inline-block;">Login & Unlock Features</a>
                    @endauth

                    <div class="stats-grid pt-4">
                        <div class="stat-card">
                            <div class="stat-number" id="playlistsCount">
                                @if(auth()->check())
                                    {{ Auth::user()->playlists()->distinct('playlist_name')->count() }}
                                @else
                                    0
                                @endif
                            </div>
                            <div class="stat-label">Playlists Created</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number" id="favoriteSongsCount">
                                @if(auth()->check())
                                    {{ Auth::user()->playlists()->count() }}
                                @else
                                    0
                                @endif
                            </div>
                            <div class="stat-label">Favorite Songs</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number" id="hoursListened">
                                @if(auth()->check())
                                    {{ round(Auth::user()->playlists()->count() * 3.5 / 60) }}h
                                @else
                                    0h
                                @endif
                            </div>
                            <div class="stat-label">Hours Listened</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number" id="artistsFollowed">
                                @if(auth()->check())
                                    {{ Auth::user()->playlists()->with('music.user')->get()->pluck('music.user')->unique('id')->count() }}
                                @else
                                    0
                                @endif
                            </div>
                            <div class="stat-label">Artists Followed</div>
                        </div>
                    </div>
                </section>

                @if(auth()->check() && isset($subscriptionFeatures))
                    <!-- Current Subscription Features Summary -->
                    <section class="section" style="margin-bottom: 40px;">
                        <div style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 12px; padding: 20px;">
                            <h3 style="color: #b794f6; margin-bottom: 15px; font-size: 1.2rem;">
                                <i class="fas fa-star" style="margin-right: 8px;"></i>Your Current Plan Features
                            </h3>
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                                <div style="color: #fff;">
                                    <strong style="color: #b794f6;">Playlists:</strong>
                                    @if($subscriptionFeatures['unlimited_playlists'])
                                        Unlimited
                                    @else
                                        {{ $subscriptionFeatures['playlist_limit'] ?? 3 }} max
                                    @endif
                                </div>
                                <div style="color: #fff;">
                                    <strong style="color: #b794f6;">Ads:</strong>
                                    {{ $subscriptionFeatures['ad_free'] ? 'Ad-free' : 'With ads' }}
                                </div>
                                <div style="color: #fff;">
                                    <strong style="color: #b794f6;">Offline Downloads:</strong>
                                    @if($subscriptionFeatures['offline_downloads'])
                                        @if($subscriptionFeatures['offline_download_limit'])
                                            {{ $downloadedSongsCount ?? 0 }}/{{ $subscriptionFeatures['offline_download_limit'] }} songs
                                        @else
                                            {{ $downloadedSongsCount ?? 0 }} (unlimited)
                                        @endif
                                    @else
                                        Not available
                                    @endif
                                </div>
                                <div style="color: #fff;">
                                    <strong style="color: #b794f6;">Audio Quality:</strong>
                                    {{ $subscriptionFeatures['high_quality'] ? 'HD Audio' : 'Standard' }}
                                </div>
                                @if($subscriptionFeatures['exclusive_content'])
                                    <div style="color: #fff;">
                                        <strong style="color: #b794f6;">Early Access:</strong>
                                        <span style="color: #fbbf24;">⭐ Enabled</span>
                                    </div>
                                @endif
                                @if($subscriptionFeatures['tip_artists'])
                                    <div style="color: #fff;">
                                        <strong style="color: #b794f6;">Tip Artists:</strong>
                                        <span style="color: #10b981;">✓ Enabled</span>
                                    </div>
                                @endif
                                @if($subscriptionFeatures['personalized_recommendations'])
                                    <div style="color: #fff;">
                                        <strong style="color: #b794f6;">Recommendations:</strong>
                                        <span style="color: #10b981;">✓ Personalized</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </section>
                @endif

                <!-- Subscription Plans Section -->
                <section class="section" id="subscription">
                    <h2 class="section-title">
                        <div class="user-Lord">
                            <lord-icon src="https://cdn.lordicon.com/usbdkqwm.json" trigger="loop" delay="2000"
                                colors="primary:#320a5c,secondary:#e5d1fa,tertiary:#e5d1fa,quaternary:#c69cf4">
                            </lord-icon>
                        </div> Subscription <span class="text-white" style="margin-left: -15px;">Plans</span>
                    </h2>
                    <p>Choose the perfect plan for your music journey. Upgrade anytime!</p>

                    @if($currentSubscription && $currentPlan)
                        <div class="current-plan-badge" style="background: linear-gradient(135deg, rgba(139, 92, 246, 0.2), rgba(168, 85, 247, 0.2)); border: 2px solid rgba(139, 92, 246, 0.5); border-radius: 12px; padding: 15px 20px; margin-bottom: 30px; text-align: center;">
                            <div style="color: #b794f6; font-weight: 600; font-size: 0.9rem; margin-bottom: 5px;">Current Plan</div>
                            <div style="color: #fff; font-size: 1.3rem; font-weight: 700;">
                                {{ $currentPlan->title }}
                                @if($subscriptionFeatures['supporter_badge'] ?? false)
                                    <span class="supporter-badge" style="display: inline-block; background: linear-gradient(135deg, #fbbf24, #f59e0b); color: #fff; font-size: 0.7rem; padding: 3px 8px; border-radius: 12px; margin-left: 8px; font-weight: 600;">
                                        ⭐ Supporter
                                    </span>
                                @endif
                            </div>
                            @if($currentSubscription->usersubscription_date && $currentSubscription->usersubscription_duration)
                                @php
                                    $endDate = \Carbon\Carbon::parse($currentSubscription->usersubscription_date)->addDays($currentSubscription->usersubscription_duration);
                                    $daysRemaining = now()->diffInDays($endDate, false);
                                @endphp
                                <div style="color: #b8a8d0; font-size: 0.85rem; margin-top: 5px;">
                                    @if($daysRemaining > 0)
                                        {{ $daysRemaining }} day{{ $daysRemaining !== 1 ? 's' : '' }} remaining
                                    @else
                                        Expired
                                    @endif
                                </div>
                            @endif
                            @if($subscriptionFeatures['offline_downloads'] ?? false)
                                <div style="color: #b8a8d0; font-size: 0.85rem; margin-top: 8px;">
                                    📥 Downloads: {{ $downloadedSongsCount ?? 0 }}{{ $downloadLimit ? "/{$downloadLimit}" : " (unlimited)" }}
                                </div>
                            @endif
                        </div>
                    @elseif(auth()->check())
                        <div class="current-plan-badge" style="background: rgba(107, 114, 128, 0.2); border: 2px solid rgba(107, 114, 128, 0.5); border-radius: 12px; padding: 15px 20px; margin-bottom: 30px; text-align: center;">
                            <div style="color: #9ca3af; font-weight: 600; font-size: 0.9rem; margin-bottom: 5px;">Current Plan</div>
                            <div style="color: #fff; font-size: 1.3rem; font-weight: 700;">Free Listener</div>
                        </div>
                    @endif

                    <div class="plans-grid">
                        @foreach($user_subscription_plans as $index => $plan)
                            @php
                                $isCurrentPlan = $currentSubscription && $currentSubscription->usersubscription_id == $plan->id &&
                                                $currentSubscription->isActive();
                                $isPopular = strpos(strtolower($plan->title ?? ''), 'premium') !== false || strpos(strtolower($plan->title ?? ''), 'super') !== false;
                            @endphp
                            <div class="plan-card {{ $isPopular ? 'popular' : '' }} {{ $isCurrentPlan ? 'current-plan' : '' }}">
                                @if($isCurrentPlan)
                                    <div class="current-plan-indicator" style="position: absolute; top: -10px; right: 20px; background: linear-gradient(135deg, #8b5cf6, #a855f7); color: white; padding: 5px 15px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);">
                                        ✓ Current Plan
                                    </div>
                                @endif
                                <h3 class="plan-name">{{ $plan->title }}</h3>
                                <div class="plan-price">
                                    @if($plan->price == '0' || $plan->price == 0)
                                        Free
                                    @else
                                        £{{ number_format((float)$plan->price, 2) }}
                                    @endif
                                </div>
                                <div class="plan-period">{{ $plan->duration }}</div>

                                @if($plan->ideal_for)
                                    <p style="color: #b8a8d0; font-size: 0.9rem; margin: 10px 0; text-align: center;">{{ $plan->ideal_for }}</p>
                                @endif

                                <ul class="plan-features">
                                    @if($plan->is_ads == 0)
                                        <li><i class="fas fa-check"></i> Stream songs with ads</li>
                                    @else
                                        <li><i class="fas fa-check"></i> Ad-free listening</li>
                                    @endif

                                    @if($plan->is_unlimitedplaylist)
                                        <li><i class="fas fa-check"></i> Unlimited playlist creation</li>
                                    @elseif($plan->playlist_limit)
                                        <li><i class="fas fa-check"></i> Create up to {{ $plan->playlist_limit }} playlists</li>
                                    @endif

                                    @if($plan->is_offline)
                                        @if($plan->offline_download_limit && $plan->offline_download_limit > 0)
                                            <li><i class="fas fa-check"></i> Offline downloads (up to {{ $plan->offline_download_limit }} songs)</li>
                                        @else
                                            <li><i class="fas fa-check"></i> Unlimited offline downloads</li>
                                        @endif
                                    @endif

                                    @if($plan->is_highquality)
                                        <li><i class="fas fa-check"></i> High-quality streaming with HD audio</li>
                                    @endif

                                    @if($plan->is_exclusivecontent)
                                        <li><i class="fas fa-check"></i> Early access to Certified Creator releases</li>
                                    @endif

                                    @if($plan->is_tip_artists)
                                        <li><i class="fas fa-check"></i> Tip artists directly to support them</li>
                                    @endif

                                    @if($plan->is_personalized_recommendations)
                                        <li><i class="fas fa-check"></i> Personalized weekly music recommendations</li>
                                    @endif

                                    @if($plan->is_supporter_badge)
                                        <li><i class="fas fa-check"></i> Supporter Badge on profile & comments</li>
                                    @endif

                                    @if($plan->is_trending_access)
                                        <li><i class="fas fa-check"></i> Access trending & featured creators</li>
                                    @endif
                                </ul>

                                @if($isCurrentPlan)
                                    <button class="plan-button secondary" disabled style="opacity: 0.7; cursor: not-allowed;">
                                        <i class="fas fa-check-circle" style="margin-right: 5px;"></i>Current Plan
                                    </button>
                                @else
                                    <button class="plan-button primary" onclick="openSubscriptionPopup('{{ $plan->id }}', '{{ $plan->title }}', '{{ $plan->price }}', '{{ $plan->duration }}')">
                                        @if($plan->price == '0' || $plan->price == 0)
                                            Get Started
                                        @else
                                            Subscribe Now
                                        @endif
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </section>

                <!-- popup form content -->
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
                <!-- popup form content -->

                <!-- Subscription Purchase Popup -->
                <div class="subscription-popup" id="subscriptionPopup" style="z-index: 9999999;">
                    <div class="overlay" onclick="closeSubscriptionPopup(event)">
                        <div class="popup" onclick="event.stopPropagation()">
                            <div class="popup-header">
                                <h2 class="popup-title">Purchase Subscription</h2>
                                <button class="close-btn" onclick="closeSubscriptionPopup()">&times;</button>
                            </div>

                            <div class="subscription-details">
                                <div class="plan-info">
                                    <h3 id="selectedPlanName">Premium Plan</h3>
                                    <div class="plan-price" id="selectedPlanPrice">£9.99</div>
                                    <div class="plan-period" id="selectedPlanPeriod">per month</div>
                                </div>

                                <div class="payment-methods">
                                    <h4>Choose Payment Method</h4>

                                    <div class="payment-method" onclick="selectPaymentMethod(this, 'stripe')">
                                        <div class="payment-icon stripe">S</div>
                                        <div class="payment-info">
                                            <h3>Stripe</h3>
                                            <p>Pay securely with Stripe</p>
                                        </div>
                                    </div>

                                    <div class="payment-method" onclick="selectPaymentMethod(this, 'google-pay')">
                                        <div class="payment-icon google-pay">G</div>
                                        <div class="payment-info">
                                            <h3>Google Pay</h3>
                                            <p>Quick and secure payment via Stripe</p>
                                        </div>
                                    </div>

                                    <div class="payment-method" onclick="selectPaymentMethod(this, 'apple-pay')">
                                        <div class="payment-icon apple-pay">AP</div>
                                        <div class="payment-info">
                                            <h3>Apple Pay</h3>
                                            <p>Pay with Touch ID or Face ID via Stripe</p>
                                        </div>
                                    </div>

                                    <div class="payment-method" onclick="selectPaymentMethod(this, 'paypal')">
                                        <div class="payment-icon paypal">P</div>
                                        <div class="payment-info">
                                            <h3>PayPal</h3>
                                            <p>Pay with your PayPal account</p>
                                        </div>
                                    </div>

                                    <div class="payment-method" onclick="selectPaymentMethod(this, 'square')">
                                        <div class="payment-icon square">Sq</div>
                                        <div class="payment-info">
                                            <h3>Square</h3>
                                            <p>Secure payment processing</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Stripe Payment Form (Hidden by default) -->
                                <div id="stripe-payment-form" class="payment-form" style="display: none;">
                                    <div class="form-group">
                                        <label>Card Details</label>
                                        <div id="stripe-card-element" class="stripe-card-element">
                                            <!-- Stripe Elements will create form elements here -->
                                        </div>
                                        <div id="stripe-card-errors" class="stripe-card-errors"></div>
                                    </div>
                                </div>

                                <!-- PayPal Payment Button (Hidden by default) -->
                                <div id="paypal-payment-button" class="payment-form" style="display: none;">
                                    <div id="paypal-button-container"></div>
                                </div>

                                <!-- Google Pay Payment Form (Hidden by default) -->
                                <div id="google-pay-payment-form" class="payment-form" style="display: none;">
                                    <div class="form-group">
                                        <label>Google Pay</label>
                                        <div id="google-pay-button-container" class="google-pay-container">
                                            <!-- Google Pay button will be rendered here -->
                                        </div>
                                        <div id="google-pay-errors" class="payment-errors"></div>
                                    </div>
                                </div>

                                <!-- Apple Pay Payment Form (Hidden by default) -->
                                <div id="apple-pay-payment-form" class="payment-form" style="display: none;">
                                    <div class="form-group">
                                        <label>Apple Pay</label>
                                        <div class="payment-info-text">
                                            <p>Apple Pay will be processed securely through Stripe. Click "Purchase Now" to proceed.</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Square Payment Form (Hidden by default) -->
                                <div id="square-payment-form" class="payment-form" style="display: none;">
                                    <div class="form-group">
                                        <label>Card Details</label>
                                        <div class="square-card-container">
                                            <div id="square-card-element" class="square-card-element">
                                                <p style="text-align: center; color: #666; padding: 20px;">Loading card input...</p>
                                            </div>
                                            <div id="square-card-errors" class="square-card-errors"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="subscription-terms">
                                    <label class="checkbox-container">
                                        <input type="checkbox" id="agreeTerms" required>
                                        <span class="checkmark"></span>
                                        I agree to the <a href="#" class="terms-link">Terms of Service</a> and <a href="#" class="terms-link">Privacy Policy</a>
                                    </label>
                                </div>
                            </div>

                            <div class="popup-actions">
                                <button class="btn-cancel" onclick="closeSubscriptionPopup()">Cancel</button>
                                <button id="purchaseSubscriptionBtn" class="btn-confirm" onclick="purchaseSubscription()">Purchase Now</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Playlists Section -->
                @auth
                <section class="section" id="playlists">
                    <section class="playlistSection">
                        <div class="main-container">
                            <div class="header">
                                <div class="logo">
                                    <div class="user-Lord"><lord-icon src="https://cdn.lordicon.com/wrjtqsvf.json"
                                            trigger="loop" delay="2000"
                                            colors="primary:#320a5c,secondary:#e5d1fa,tertiary:#c69cf4,quaternary:#320a5c">
                                        </lord-icon>
                                    </div>
                                </div>
                                <div class="header-content">
                                    <h1>My <span class="playlist-word">Playlists</span></h1>
                                    <p>Organize your favorite tracks into custom playlists</p>
                                </div>
                            </div>

                            <!-- Create New Playlist Button -->
                            <a href="{{ route('playlist.create') }}" class="create-btn" style="pointer-events: auto !important; z-index: 1000 !important; position: relative !important; cursor: pointer !important; text-decoration: none; display: inline-block;">
                                <span>+</span> Create New Playlist
                            </a>

                            <script>
                                // Simple, reliable function to open playlist modal
                                function openPlaylistModalNow() {
                                    console.log('openPlaylistModalNow: Called');

                                    const section = document.querySelector('.playlistSection');
                                    console.log('openPlaylistModalNow: Section', !!section);

                                    if (!section) {
                                        console.error('Playlist section not found');
                                        alert('Playlist section not found. Please refresh the page.');
                                        return;
                                    }

                                    const overlay = section.querySelector('.overlay');
                                    console.log('openPlaylistModalNow: Overlay', !!overlay);

                                    if (!overlay) {
                                        console.error('Overlay not found');
                                        alert('Playlist modal overlay not found. Please refresh the page.');
                                        return;
                                    }

                                    // Open the modal
                                    overlay.classList.add('active');
                                    overlay.setAttribute('aria-hidden', 'false');
                                    overlay.style.display = 'flex';
                                    overlay.style.zIndex = '10000';
                                    overlay.style.visibility = 'visible';
                                    overlay.style.opacity = '1';
                                    document.body.style.overflow = 'hidden';

                                    console.log('Modal opened', {
                                        hasActive: overlay.classList.contains('active'),
                                        display: overlay.style.display,
                                        computedDisplay: window.getComputedStyle(overlay).display,
                                        visibility: window.getComputedStyle(overlay).visibility,
                                        opacity: window.getComputedStyle(overlay).opacity
                                    });

                                    // Initialize music search after modal is fully visible
                                    setTimeout(function() {
                                        console.log('Initializing music search after modal open');
                                        const searchInput = document.getElementById('musicSearchInput');
                                        const songsGrid = document.getElementById('selectedSongsGrid');

                                        console.log('Music search elements check:', {
                                            searchInput: !!searchInput,
                                            songsGrid: !!songsGrid,
                                            searchInputId: searchInput ? searchInput.id : 'not found',
                                            songsGridId: songsGrid ? songsGrid.id : 'not found'
                                        });

                                        // Try to initialize using the global function
                                        if (typeof window.initializeMusicSearch === 'function') {
                                            console.log('Calling window.initializeMusicSearch');
                                            try {
                                                const result = window.initializeMusicSearch();
                                                console.log('initializeMusicSearch returned:', result);
                                            } catch (err) {
                                                console.error('Error calling initializeMusicSearch:', err);
                                                // Fallback to direct initialization
                                                initializeSearchDirectly(searchInput, songsGrid);
                                            }
                                        } else {
                                            console.warn('window.initializeMusicSearch not found, using direct initialization');
                                            initializeSearchDirectly(searchInput, songsGrid);
                                        }

                                        function initializeSearchDirectly(input, grid) {
                                            if (!input || !grid) {
                                                console.error('Cannot initialize search - missing elements');
                                                return;
                                            }

                                            console.log('Initializing search directly');

                                            // Remove any existing listeners by cloning
                                            const newInput = input.cloneNode(true);
                                            input.parentNode.replaceChild(newInput, input);

                                            // Add input event listener with INLINE search function
                                            newInput.addEventListener('input', function(e) {
                                                const query = this.value.trim();
                                                console.log('Search input changed:', query, 'Length:', query.length);

                                                if (query.length < 2) {
                                                    grid.innerHTML = '<div style="text-align: center; padding: 20px; color: #6b7280;">Start typing to search for songs...</div>';
                                                    return;
                                                }

                                                // Clear previous timeout
                                                if (window.playlistSearchTimeout) {
                                                    clearTimeout(window.playlistSearchTimeout);
                                                }

                                                // Debounce search
                                                window.playlistSearchTimeout = setTimeout(async () => {
                                                    console.log('=== Executing search for:', query, '===');

                                                    // INLINE search function - doesn't depend on external functions
                                                    try {
                                                        grid.innerHTML = '<div style="text-align: center; padding: 20px; color: #6b7280;">Searching for "' + query + '"...</div>';

                                                        const response = await fetch(`/music-search?q=${encodeURIComponent(query)}`, {
                                                            method: 'GET',
                                                            headers: {
                                                                'Accept': 'application/json',
                                                                'Content-Type': 'application/json'
                                                            }
                                                        });

                                                        console.log('Search response status:', response.status);

                                                        if (!response.ok) {
                                                            throw new Error(`HTTP error! status: ${response.status}`);
                                                        }

                                                        const responseText = await response.text();
                                                        console.log('Search response (first 200 chars):', responseText.substring(0, 200));

                                                        if (responseText.trim().startsWith('<!DOCTYPE') || responseText.trim().startsWith('<html')) {
                                                            throw new Error('Server returned HTML instead of JSON');
                                                        }

                                                        const data = JSON.parse(responseText);
                                                        console.log('Search data:', data);

                                                        if (data.success && data.data && Array.isArray(data.data) && data.data.length > 0) {
                                                            console.log('Displaying', data.data.length, 'results');

                                                            // Verify function is available before generating HTML
                                                            const funcAvailable = typeof window.addSongToPlaylist === 'function';
                                                            console.log('addSongToPlaylist function available:', funcAvailable);
                                                            console.log('Window object check:', {
                                                                hasWindow: typeof window !== 'undefined',
                                                                hasAddFunction: typeof window.addSongToPlaylist !== 'undefined',
                                                                functionType: typeof window.addSongToPlaylist
                                                            });

                                                            // Don't create fallback if function already exists - it should be available
                                                            if (!funcAvailable) {
                                                                console.error('addSongToPlaylist not available when generating search results!');
                                                                console.error('This should not happen - function should be defined early in the script');
                                                            }

                                                            const html = data.data.map(song => {
                                                                if (!song || !song.id || !song.name) return '';
                                                                const escapedName = String(song.name || '').replace(/'/g, "\\'").replace(/"/g, '\\"').replace(/\n/g, ' ').replace(/\r/g, '');
                                                                const escapedArtist = String(song.artist || 'Unknown Artist').replace(/'/g, "\\'").replace(/"/g, '\\"').replace(/\n/g, ' ').replace(/\r/g, '');
                                                                const escapedThumbnail = String(song.thumbnail || '').replace(/'/g, "\\'").replace(/"/g, '\\"').replace(/\n/g, ' ').replace(/\r/g, '');
                                                                const songId = parseInt(song.id) || 0;
                                                                // Use data attributes and event delegation instead of inline onclick
                                                                return `
                                                                    <div class="search-result-item" data-song-id="${songId}" data-song-name="${escapedName.replace(/"/g, '&quot;')}" data-song-artist="${escapedArtist.replace(/"/g, '&quot;')}" data-song-thumbnail="${escapedThumbnail.replace(/"/g, '&quot;')}" style="padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; margin-bottom: 8px; display: flex; align-items: center; gap: 12px; background: #fff; cursor: pointer;">
                                                                        <img src="${escapedThumbnail || 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0xNiAxMkgxNlYyOEgxNlYxMloiIGZpbGw9IiM5Q0EzQUYiLz4KPHBhdGggZD0iTTI0IDEySDI0VjI4SDI0VjEyWiIgZmlsbD0iIzlDQTNBRiIvPgo8L3N2Zz4K'}" alt="Cover" style="width: 50px; height: 50px; border-radius: 6px; object-fit: cover; background: #f3f4f6;" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0xNiAxMkgxNlYyOEgxNlYxMloiIGZpbGw9IiM5Q0EzQUYiLz4KPHBhdGggZD0iTTI0IDEySDI0VjI4SDI0VjEyWiIgZmlsbD0iIzlDQTNBRiIvPgo8L3N2Zz4K'">
                                                                        <div style="flex: 1;">
                                                                            <h5 style="margin: 0; font-size: 15px; font-weight: 600; color: #111827;">${escapedName}</h5>
                                                                            <p style="margin: 0; font-size: 13px; color: #6b7280;">${escapedArtist}</p>
                                                                        </div>
                                                                        <button class="add-song-btn" data-song-id="${songId}" data-song-name="${escapedName.replace(/"/g, '&quot;')}" data-song-artist="${escapedArtist.replace(/"/g, '&quot;')}" data-song-thumbnail="${escapedThumbnail.replace(/"/g, '&quot;')}" style="background: #6b7280; color: white; border: none; border-radius: 50%; width: 36px; height: 36px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 14px;" title="Add to playlist">
                                                                            <i class="fas fa-plus"></i>
                                                                        </button>
                                                                    </div>
                                                                `;
                                                            }).filter(html => html !== '').join('');

                                                            if (html) {
                                                                grid.innerHTML = html;
                                                                console.log('Results displayed inline', { songCount: data.data.length });

                                                                // Attach event listeners using event delegation (remove old listeners first)
                                                                const oldHandler = grid._addSongHandler;
                                                                if (oldHandler) {
                                                                    grid.removeEventListener('click', oldHandler);
                                                                }

                                                                const clickHandler = function(e) {
                                                                    const addBtn = e.target.closest('.add-song-btn');
                                                                    const resultItem = e.target.closest('.search-result-item');

                                                                    if (addBtn) {
                                                                        e.preventDefault();
                                                                        e.stopPropagation();

                                                                        const songId = parseInt(addBtn.getAttribute('data-song-id')) || 0;
                                                                        const songName = addBtn.getAttribute('data-song-name') || '';
                                                                        const songArtist = addBtn.getAttribute('data-song-artist') || '';
                                                                        const songThumbnail = addBtn.getAttribute('data-song-thumbnail') || '';

                                                                        console.log('Add button clicked via delegation:', { songId, songName, songArtist });

                                                                        if (typeof window.addSongToPlaylist === 'function') {
                                                                            try {
                                                                                window.addSongToPlaylist(songId, songName, songArtist, songThumbnail);
                                                                            } catch (err) {
                                                                                console.error('Error calling addSongToPlaylist:', err);
                                                                                alert('Error adding song: ' + err.message);
                                                                            }
                                                                        } else {
                                                                            console.error('addSongToPlaylist function not available');
                                                                            alert('Function not available. Please refresh the page.');
                                                                        }
                                                                        return false;
                                                                    } else if (resultItem && !e.target.closest('button')) {
                                                                        // Click on the item itself (not the button)
                                                                        const songId = parseInt(resultItem.getAttribute('data-song-id')) || 0;
                                                                        const songName = resultItem.getAttribute('data-song-name') || '';
                                                                        const songArtist = resultItem.getAttribute('data-song-artist') || '';
                                                                        const songThumbnail = resultItem.getAttribute('data-song-thumbnail') || '';

                                                                        if (typeof window.addSongToPlaylist === 'function') {
                                                                            try {
                                                                                window.addSongToPlaylist(songId, songName, songArtist, songThumbnail);
                                                                            } catch (err) {
                                                                                console.error('Error calling addSongToPlaylist:', err);
                                                                            }
                                                                        }
                                                                    }
                                                                };

                                                                grid._addSongHandler = clickHandler;
                                                                grid.addEventListener('click', clickHandler);
                                                            } else {
                                                                grid.innerHTML = '<div style="text-align: center; padding: 20px; color: #ef4444;">Error displaying results.</div>';
                                                            }
                                                        } else {
                                                            console.log('No results found');
                                                            grid.innerHTML = '<div style="text-align: center; padding: 20px; color: #6b7280;">No songs found. Try a different search term.</div>';
                                                        }
                                                    } catch (error) {
                                                        console.error('Inline search error:', error);
                                                        grid.innerHTML = '<div style="text-align: center; padding: 20px; color: #ef4444;">Error searching: ' + error.message + '</div>';
                                                    }
                                                }, 300);
                                            }, true);

                                            console.log('Direct search initialization complete');
                                        }
                                    }, 400);
                                }

                                // Make it globally available
                                window.openPlaylistModalNow = openPlaylistModalNow;

                                // Attach handler when DOM is ready
                                function attachPlaylistButtonHandler() {
                                    const btn = document.getElementById('createPlaylistBtn');
                                    if (btn) {
                                        // Remove any existing handlers by cloning
                                        const newBtn = btn.cloneNode(true);
                                        btn.parentNode.replaceChild(newBtn, btn);

                                        // Add click handler
                                        newBtn.addEventListener('click', function(e) {
                                            e.preventDefault();
                                            e.stopPropagation();
                                            console.log('Button clicked - opening modal');
                                            openPlaylistModalNow();
                                            return false;
                                        }, true);

                                        // Also set onclick as backup
                                        newBtn.onclick = function(e) {
                                            e.preventDefault();
                                            e.stopPropagation();
                                            openPlaylistModalNow();
                                            return false;
                                        };

                                        console.log('Playlist button handler attached', {
                                            button: !!newBtn,
                                            buttonId: newBtn.id
                                        });
                                    } else {
                                        console.warn('Button not found, retrying...');
                                        setTimeout(attachPlaylistButtonHandler, 100);
                                    }
                                }

                                // Try immediately
                                attachPlaylistButtonHandler();

                                // Also try on DOM ready
                                if (document.readyState === 'loading') {
                                    document.addEventListener('DOMContentLoaded', attachPlaylistButtonHandler);
                                }
                            </script>
                        </div>

                        <!-- overlay does not use inline onclick anymore -->
                        <div class="overlay" aria-hidden="true">
                            <div class="popup" role="dialog">
                                <div class="popup-header">
                                    <h2 class="popup-title">Create New Playlist</h2>
                                    <!-- removed inline onclick -->
                                    <button type="button" class="close-btn" aria-label="Close">&times;</button>
                                </div>

                                <div class="popup-content">
                                    <!-- changed id -> class (playlistForm) -->
                                    <form class="playlistForm" novalidate>
                                        <div class="form-section">
                                            <div class="form-group">
                                                <label class="form-label">Playlist Name *</label>
                                                <input type="text" class="form-input" placeholder="My Awesome Playlist"
                                                    required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">Search Song</label>
                                                <input type="text" id="musicSearchInput" class="form-input" placeholder="Search Songs..." autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="form-section d-none">
                                            <label class="form-label">Cover Image</label>
                                            <div class="cover-upload-section" role="button" tabindex="0">

                                                <div class="upload-placeholder cover-preview-placeholder">🎵</div>
                                                <p>Click to upload cover image</p>
                                                <small style="color:#a1a1aa;">JPG, PNG up to 10MB</small>
                                            </div>

                                            <input type="file" class="coverUpload" accept="image/*"
                                                style="display:none;">
                                        </div>

                                        <div class="form-section d-none">
                                            <label class="form-label">Privacy Settings</label>
                                            <div class="privacy-options">
                                                <!-- added data-privacy so JS can detect -->
                                                <div class="privacy-option selected" data-privacy="public">
                                                    <div class="privacy-icon">🌍</div>
                                                    <div><strong>Public</strong></div>
                                                    <small>Anyone can find and play</small>
                                                </div>
                                                <div class="privacy-option" data-privacy="private">
                                                    <div class="privacy-icon">🔒</div>
                                                    <div><strong>Private</strong></div>
                                                    <small>Only you can access</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-section">
                                            <label class="form-label">
                                                Add Songs to Playlist
                                                <!-- changed id -> class (selected-count) -->
                                                <span class="selected-count" style="display:none;">0 selected</span>
                                            </label>
                                            <div id="selectedSongsGrid" class="songs-grid" style="min-height: 100px;">
                                                <!-- Selected songs will be dynamically added here -->
                                                <div style="text-align: center; color: #6b7280; padding: 20px;">Start typing in the search box above to find songs...</div>
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <button type="button" class="btn-secondary">Cancel</button>
                                            <button type="submit" class="btn-primary">Create Playlist</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>




                    <section class="playlist_section">
                        <div class="bg-particles"></div>

                        <div class="container">
                            <div class="playlists-header d-flex justify-content-between align-items-center mb-4">
                                <h2 class="text-white mb-0">Your Playlists</h2>
                                <div class="d-flex gap-2">
                                    <a href="/songs-library" class="btn btn-outline-light">
                                        <i class="fas fa-music me-2"></i>All Songs
                                    </a>

                                    </div>
                                </div>

                            <div class="playlists-grid" id="playlistsGrid">
                                <div class="loading-spinner">
                                        <div class="spinner"></div>
                                </div>
                            </div>


                    </section>
                </section>
                @else
                <!-- Login Prompt for Playlists -->
                <section class="section" id="playlists">
                    <div style="text-align: center; padding: 60px 20px; background: rgba(139, 92, 246, 0.1); border-radius: 12px; border: 1px solid rgba(139, 92, 246, 0.3);">
                        <lord-icon src="https://cdn.lordicon.com/wrjtqsvf.json" trigger="loop" delay="2000"
                            colors="primary:#320a5c,secondary:#e5d1fa,tertiary:#c69cf4,quaternary:#320a5c"
                            style="width:100px;height:100px;margin-bottom:20px;">
                        </lord-icon>
                        <h2 style="color: #fff; margin-bottom: 15px;">My Playlists</h2>
                        <p style="color: #b8a8d0; margin-bottom: 25px;">Organize your favorite tracks into custom playlists</p>
                        <a href="{{ route('user.login') }}" class="open-popup-btn" style="text-decoration: none; display: inline-block;">Login to Create Playlists</a>
                    </div>
                </section>
                @endauth

                <!-- Favorites Collection Section -->
            </div>
        </section>

        @auth
        <section class="song_list">
            <div class="container">
                <div class="section-header">
                    <div class="section-icon"><lord-icon src="https://cdn.lordicon.com/wtrpyxpe.json" trigger="loop"
                            colors="primary:#320a5c,secondary:#c69cf4,tertiary:#a866ee,quaternary:#c69cf4"
                            style="width:250px;height:250px">
                        </lord-icon></div>
                    <div>
                        <h1 class="section-title">Favorite Collection</h1>
                        <p class="section-subtitle">Your curated music collections</p>
                    </div>
                    <!-- <button class="create-playlist-btn create-btn" onclick="createPlaylist()">+ Create New</button> -->
                </div>

                <div class="favorites-header d-flex justify-content-between align-items-center mb-4">
                                <div>
                        <h3 class="text-white mb-0">Latest Favorites</h3>
                        <p class="text-muted mb-0">Your recently added favorite songs</p>
                                </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-light" onclick="openFavoritesDetail()">
                            <i class="fas fa-heart me-2"></i>View All Favorites
                        </button>
                        <a href="/songs-library" class="btn btn-primary uniqueBtnnn">
                            <i class="fas fa-plus me-2"></i>Add Songs
                        </a>
                        </div>
                    </div>

                <div class="favorites-grid" id="favoritesGrid">
                    <div class="loading-spinner">
                        <div class="spinner"></div>
                    </div>
                </div>

                <div class="quick-playlists">
                    <h3>Quick Actions</h3>
                    <div class="quick-playlist-list">
                        <div class="quick-playlist-item" onclick="createSmartPlaylist('discover')">🔍 Discover Weekly
                        </div>
                        <div class="quick-playlist-item" onclick="createSmartPlaylist('recently-played')">⏰ Recently
                            Played</div>
                        <div class="quick-playlist-item" onclick="createSmartPlaylist('liked')">❤️ Liked Songs</div>
                        @if(auth()->check() && (auth()->user()->hasUserFeature('personalized_recommendations') ?? false))
                            <div class="quick-playlist-item" onclick="loadPersonalizedRecommendations()">✨ Personalized Recommendations
                            </div>
                        @else
                            <div class="quick-playlist-item" onclick="alert('Personalized recommendations are only available for Super Listener subscribers. Please upgrade your plan.');" style="opacity: 0.6; cursor: not-allowed;">✨ Personalized Recommendations
                            </div>
                        @endif
                        <div class="quick-playlist-item" onclick="createSmartPlaylist('trending')">📈 Trending</div>
                    </div>
                </div>

                <div class="stats">
                    <div class="stat-item">
                        <div class="stat-number">{{ $userStats['total_playlists'] ?? 0 }}</div>
                        <div class="stat-label">Total Playlists</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ $userStats['total_songs'] ?? 0 }}</div>
                        <div class="stat-label">Total Songs</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ $userStats['total_favorites'] ?? 0 }}</div>
                        <div class="stat-label">Total Favorites</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ $userStats['total_subscribed'] ?? 0 }}</div>
                        <div class="stat-label">Total Subscribed</div>
                    </div>
                </div>
            </div>
        </section>
        @else
        <!-- Login Prompt for Favorites -->
        <section class="song_list">
            <div class="container">
                <div style="text-align: center; padding: 60px 20px; background: rgba(139, 92, 246, 0.1); border-radius: 12px; border: 1px solid rgba(139, 92, 246, 0.3);">
                    <lord-icon src="https://cdn.lordicon.com/wtrpyxpe.json" trigger="loop"
                        colors="primary:#320a5c,secondary:#c69cf4,tertiary:#a866ee,quaternary:#c69cf4"
                        style="width:100px;height:100px;margin-bottom:20px;">
                    </lord-icon>
                    <h1 class="section-title" style="margin-bottom: 15px;">Favorite Collection</h1>
                    <p class="section-subtitle" style="margin-bottom: 25px;">Your curated music collections</p>
                    <a href="{{ route('user.login') }}" class="open-popup-btn" style="text-decoration: none; display: inline-block;">Login to View Favorites</a>
                </div>
            </div>
        </section>
        @endauth

        @auth
        <!-- My Downloads Section -->
        @if(isset($subscriptionFeatures) && ($subscriptionFeatures['offline_downloads'] ?? false))
        <section class="song_list" style="margin-top: 40px;">
            <div class="container">
                <div class="section-header">
                    <div class="section-icon">
                        <lord-icon src="https://cdn.lordicon.com/wtrpyxpe.json" trigger="loop"
                            colors="primary:#320a5c,secondary:#c69cf4,tertiary:#a866ee,quaternary:#c69cf4"
                            style="width:250px;height:250px">
                        </lord-icon>
                    </div>
                    <div>
                        <h1 class="section-title">My Downloads</h1>
                        <p class="section-subtitle">Your offline music collection</p>
                    </div>
                </div>

                <div class="favorites-header d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h3 class="text-white mb-0">Downloaded Songs</h3>
                        <p class="text-muted mb-0">{{ $downloadedSongsCount ?? 0 }}{{ $downloadLimit ? "/{$downloadLimit}" : " (unlimited)" }} songs downloaded</p>
                    </div>
                </div>

                <div class="favorites-grid" id="downloadsGrid">
                    <div class="loading-spinner">
                        <div class="spinner"></div>
                    </div>
                </div>
            </div>
        </section>
        @endif
        @endauth

@endsection

                @php
                    $squareApplicationId = (string) env('SQUARE_APPLICATION_ID', '');
                    $squareSdkUrl = strpos($squareApplicationId, 'sandbox-') === 0
                        ? 'https://sandbox.web.squarecdn.com/v1/square.js'
                        : 'https://web.squarecdn.com/v1/square.js';
                @endphp

        @section('script')
        <!-- Stripe SDK -->
        <script src="https://js.stripe.com/v3/"></script>
        <!-- PayPal SDK -->
        <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID', 'sb') }}&currency=GBP"></script>
        <!-- Google Pay SDK -->
        <script async src="https://pay.google.com/gp/p/js/pay.js"></script>
        <!-- Square Web Payments SDK -->
                <script type="text/javascript" src="{{ $squareSdkUrl }}"></script>
        <!-- Fallback Square SDK -->
        <script>
            // Fallback if Square doesn't load
            window.addEventListener('load', function() {
                setTimeout(function() {
                    if (typeof Square === 'undefined') {
                        console.log('Square SDK failed to load, trying alternative...');
                        // Try alternative Square SDK
                        const script = document.createElement('script');
                                script.src = @json($squareSdkUrl);
                        script.onload = function() {
                            console.log('Alternative Square SDK loaded');
                            if (typeof Square !== 'undefined') {
                                initializeSquare();
                            }
                        };
                        script.onerror = function() {
                            console.log('Alternative Square SDK also failed');
                            const container = document.getElementById('square-card-element');
                            if (container) {
                                container.innerHTML = '<p style="color: #ef4444; text-align: center;">Square payment is currently unavailable. Please try another payment method.</p>';
                            }
                        };
                        document.head.appendChild(script);
                    }
                }, 3000);
            });
        </script>

        <script>
            //playlist popup js

            // Global variable for selected songs
            let ps_selectedSongs = new Map();

            // Define addSongToPlaylist function EARLY so it's always available
            // Use a flag to prevent recursive calls
            let isAddingSong = false;

            window.addSongToPlaylist = function(musicId, name, artist, thumbnail) {
                // Prevent recursive calls
                if (isAddingSong) {
                    console.warn('addSongToPlaylist already executing, ignoring duplicate call');
                    return;
                }

                isAddingSong = true;

                try {
                    console.log('Adding song to playlist (global):', { musicId, name, artist, thumbnail });
                    console.log('Current selected songs count:', ps_selectedSongs ? ps_selectedSongs.size : 0);

                    if (!ps_selectedSongs) {
                        console.error('ps_selectedSongs is not initialized');
                        ps_selectedSongs = new Map();
                    }

                    if (ps_selectedSongs.has(musicId)) {
                        alert('This song is already in the playlist');
                        isAddingSong = false;
                        return;
                    }

                    ps_selectedSongs.set(musicId, {
                        id: musicId,
                        name: name || 'Unknown Song',
                        artist: artist || 'Unknown Artist',
                        thumbnail: thumbnail || ''
                    });

                    console.log('Song added. New count:', ps_selectedSongs.size);

                    // Update UI if functions are available (use setTimeout to prevent recursion)
                    setTimeout(() => {
                        try {
                            if (typeof window.updateSelectedCount === 'function') {
                                window.updateSelectedCount();
                            }
                            if (typeof window.updateSelectedSongsGrid === 'function') {
                                window.updateSelectedSongsGrid();
                            }
                        } catch (e) {
                            console.warn('Error updating UI:', e);
                        } finally {
                            isAddingSong = false;
                        }
                    }, 0);

                    // Clear search input if available
                    const musicSearchInput = document.getElementById('musicSearchInput');
                    if (musicSearchInput) {
                        musicSearchInput.value = '';
                    }

                    // Show success feedback
                    console.log('Song successfully added to playlist');
                } catch (error) {
                    console.error('Error in addSongToPlaylist:', error);
                    alert('Error adding song to playlist. Please try again.');
                    isAddingSong = false;
                }
            };

            // Ensure function is available immediately and log it
            console.log('addSongToPlaylist function initialized:', typeof window.addSongToPlaylist === 'function');
            console.log('Function details:', {
                isFunction: typeof window.addSongToPlaylist === 'function',
                functionName: window.addSongToPlaylist ? window.addSongToPlaylist.name : 'anonymous',
                ps_selectedSongs: typeof ps_selectedSongs !== 'undefined'
            });

            // Set up global event delegation for add-song buttons (works even if HTML is generated dynamically)
            function setupGlobalAddSongDelegation() {
                // Use document-level delegation so it works for dynamically added elements
                document.addEventListener('click', function(e) {
                    const addBtn = e.target.closest('.add-song-btn');
                    const resultItem = e.target.closest('.search-result-item');

                    if (addBtn) {
                        e.preventDefault();
                        e.stopPropagation();

                        const songId = parseInt(addBtn.getAttribute('data-song-id')) || 0;
                        const songName = addBtn.getAttribute('data-song-name') || '';
                        const songArtist = addBtn.getAttribute('data-song-artist') || '';
                        const songThumbnail = addBtn.getAttribute('data-song-thumbnail') || '';

                        console.log('Global delegation: Add button clicked', { songId, songName, songArtist });

                        if (typeof window.addSongToPlaylist === 'function') {
                            try {
                                window.addSongToPlaylist(songId, songName, songArtist, songThumbnail);
                            } catch (err) {
                                console.error('Error calling addSongToPlaylist:', err);
                                alert('Error adding song: ' + err.message);
                            }
                        } else {
                            console.error('addSongToPlaylist function not available in global delegation');
                            alert('Function not available. Please refresh the page.');
                        }
                        return false;
                    } else if (resultItem && !e.target.closest('button') && resultItem.hasAttribute('data-song-id')) {
                        // Click on the item itself (not a button)
                        const songId = parseInt(resultItem.getAttribute('data-song-id')) || 0;
                        const songName = resultItem.getAttribute('data-song-name') || '';
                        const songArtist = resultItem.getAttribute('data-song-artist') || '';
                        const songThumbnail = resultItem.getAttribute('data-song-thumbnail') || '';

                        if (typeof window.addSongToPlaylist === 'function') {
                            try {
                                window.addSongToPlaylist(songId, songName, songArtist, songThumbnail);
                            } catch (err) {
                                console.error('Error calling addSongToPlaylist:', err);
                            }
                        }
                    }
                }, true); // Use capture phase

                console.log('Global add-song delegation handler attached');
            }

            // Set up delegation immediately
            setupGlobalAddSongDelegation();

            // Also make it available on window load as backup
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', function() {
                    console.log('DOMContentLoaded: Verifying addSongToPlaylist', typeof window.addSongToPlaylist === 'function');
                    setupGlobalAddSongDelegation(); // Set up again in case it wasn't set up before
                });
            } else {
                console.log('DOM already loaded: Verifying addSongToPlaylist', typeof window.addSongToPlaylist === 'function');
            }

            // Define searchMusic function EARLY so it's available when modal opens
            window.searchMusic = async function(query, songsGrid = null) {
                console.log('searchMusic function called (early definition)', {
                    query: query,
                    songsGridProvided: !!songsGrid,
                    queryLength: query ? query.length : 0
                });

                const grid = songsGrid || document.getElementById('selectedSongsGrid');

                if (!grid) {
                    console.error('Selected songs grid not found');
                    return;
                }

                try {
                    // Show loading
                    grid.innerHTML = '<div class="search-loading" style="text-align: center; padding: 20px; color: #6b7280;">Searching for "' + query + '"...</div>';

                    console.log('Fetching from /music-search?q=' + encodeURIComponent(query));

                    const response = await fetch(`/music-search?q=${encodeURIComponent(query)}`, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    });

                    console.log('Response status:', response.status);

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const responseText = await response.text();
                    console.log('Raw response (first 200 chars):', responseText.substring(0, 200));

                    if (responseText.trim().startsWith('<!DOCTYPE') || responseText.trim().startsWith('<html')) {
                        console.error('Received HTML instead of JSON');
                        throw new Error('Server returned HTML instead of JSON');
                    }

                    const data = JSON.parse(responseText);
                    console.log('Search response data:', data);

                    if (data.success && data.data && Array.isArray(data.data) && data.data.length > 0) {
                        console.log('Displaying', data.data.length, 'search results');

                        // Display results directly using event delegation
                        const html = data.data.map(song => {
                            if (!song || !song.id || !song.name) {
                                console.warn('Invalid song object:', song);
                                return '';
                            }
                            const escapedName = String(song.name || '').replace(/'/g, "\\'").replace(/"/g, '\\"').replace(/\n/g, ' ').replace(/\r/g, '');
                            const escapedArtist = String(song.artist || 'Unknown Artist').replace(/'/g, "\\'").replace(/"/g, '\\"').replace(/\n/g, ' ').replace(/\r/g, '');
                            const escapedThumbnail = String(song.thumbnail || '').replace(/'/g, "\\'").replace(/"/g, '\\"').replace(/\n/g, ' ').replace(/\r/g, '');
                            const songId = parseInt(song.id) || 0;
                            return `
                                <div class="search-result-item" data-song-id="${songId}" data-song-name="${escapedName.replace(/"/g, '&quot;')}" data-song-artist="${escapedArtist.replace(/"/g, '&quot;')}" data-song-thumbnail="${escapedThumbnail.replace(/"/g, '&quot;')}" style="padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; margin-bottom: 8px; display: flex; align-items: center; gap: 12px; background: #fff; cursor: pointer;">
                                    <img src="${escapedThumbnail || 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0xNiAxMkgxNlYyOEgxNlYxMloiIGZpbGw9IiM5Q0EzQUYiLz4KPHBhdGggZD0iTTI0IDEySDI0VjI4SDI0VjEyWiIgZmlsbD0iIzlDQTNBRiIvPgo8L3N2Zz4K'}" alt="Cover" style="width: 50px; height: 50px; border-radius: 6px; object-fit: cover; background: #f3f4f6;" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0xNiAxMkgxNlYyOEgxNlYxMloiIGZpbGw9IiM5Q0EzQUYiLz4KPHBhdGggZD0iTTI0IDEySDI0VjI4SDI0VjEyWiIgZmlsbD0iIzlDQTNBRiIvPgo8L3N2Zz4K'">
                                    <div style="flex: 1;">
                                        <h5 style="margin: 0; font-size: 15px; font-weight: 600; color: #111827;">${escapedName}</h5>
                                        <p style="margin: 0; font-size: 13px; color: #6b7280;">${escapedArtist}</p>
                                    </div>
                                    <button class="add-song-btn" data-song-id="${songId}" data-song-name="${escapedName.replace(/"/g, '&quot;')}" data-song-artist="${escapedArtist.replace(/"/g, '&quot;')}" data-song-thumbnail="${escapedThumbnail.replace(/"/g, '&quot;')}" style="background: #6b7280; color: white; border: none; border-radius: 50%; width: 36px; height: 36px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 14px;" title="Add to playlist">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            `;
                        }).filter(html => html !== '').join('');

                        if (html) {
                            grid.innerHTML = html;
                            console.log('Results displayed', { songCount: data.data.length });

                            // Attach event delegation (remove old handler first)
                            const oldHandler = grid._addSongHandler;
                            if (oldHandler) {
                                grid.removeEventListener('click', oldHandler);
                            }

                            const clickHandler = function(e) {
                                const addBtn = e.target.closest('.add-song-btn');
                                const resultItem = e.target.closest('.search-result-item');

                                if (addBtn) {
                                    e.preventDefault();
                                    e.stopPropagation();

                                    const songId = parseInt(addBtn.getAttribute('data-song-id')) || 0;
                                    const songName = addBtn.getAttribute('data-song-name') || '';
                                    const songArtist = addBtn.getAttribute('data-song-artist') || '';
                                    const songThumbnail = addBtn.getAttribute('data-song-thumbnail') || '';

                                    console.log('Add button clicked via delegation:', { songId, songName, songArtist });

                                    if (typeof window.addSongToPlaylist === 'function') {
                                        try {
                                            window.addSongToPlaylist(songId, songName, songArtist, songThumbnail);
                                        } catch (err) {
                                            console.error('Error calling addSongToPlaylist:', err);
                                            alert('Error adding song: ' + err.message);
                                        }
                                    } else {
                                        console.error('addSongToPlaylist function not available');
                                        alert('Function not available. Please refresh the page.');
                                    }
                                    return false;
                                } else if (resultItem && !e.target.closest('button')) {
                                    const songId = parseInt(resultItem.getAttribute('data-song-id')) || 0;
                                    const songName = resultItem.getAttribute('data-song-name') || '';
                                    const songArtist = resultItem.getAttribute('data-song-artist') || '';
                                    const songThumbnail = resultItem.getAttribute('data-song-thumbnail') || '';

                                    if (typeof window.addSongToPlaylist === 'function') {
                                        try {
                                            window.addSongToPlaylist(songId, songName, songArtist, songThumbnail);
                                        } catch (err) {
                                            console.error('Error calling addSongToPlaylist:', err);
                                        }
                                    }
                                }
                            };

                            grid._addSongHandler = clickHandler;
                            grid.addEventListener('click', clickHandler);
                        } else {
                            grid.innerHTML = '<div style="text-align: center; padding: 20px; color: #ef4444;">Error displaying results.</div>';
                        }
                    } else {
                        console.log('No results found');
                        grid.innerHTML = '<div style="text-align: center; padding: 20px; color: #6b7280;">No songs found. Try a different search term.</div>';
                    }
                } catch (error) {
                    console.error('Search error:', error);
                    grid.innerHTML = '<div style="text-align: center; padding: 20px; color: #ef4444;">Error searching: ' + error.message + '</div>';
                }
            };

            console.log('searchMusic function defined early', {
                isFunction: typeof window.searchMusic === 'function'
            });

            // Inline function for button onclick - works immediately, no dependencies
            function openPlaylistModalInline(e) {
                try {
                    if (e) {
                        e.preventDefault();
                        e.stopPropagation();
                    }

                    console.log('openPlaylistModalInline: Button clicked');

                    const section = document.querySelector('.playlistSection');
                    console.log('openPlaylistModalInline: Section found', !!section);

                    if (!section) {
                        console.error('openPlaylistModalInline: Playlist section not found');
                        alert('Playlist section not found. Please refresh the page.');
                        return false;
                    }

                    const overlay = section.querySelector('.overlay');
                    console.log('openPlaylistModalInline: Overlay found', !!overlay);

                    if (!overlay) {
                        console.error('openPlaylistModalInline: Overlay not found in section');
                        alert('Playlist modal overlay not found. Please refresh the page.');
                        return false;
                    }

                    // Open the modal
                    overlay.classList.add('active');
                    overlay.setAttribute('aria-hidden', 'false');
                    overlay.style.display = 'flex';
                    overlay.style.zIndex = '10000';
                    document.body.style.overflow = 'hidden';

                    console.log('openPlaylistModalInline: Modal opened', {
                        hasActive: overlay.classList.contains('active'),
                        display: overlay.style.display,
                        computedDisplay: window.getComputedStyle(overlay).display
                    });

                    // Initialize music search after a short delay
                    setTimeout(function() {
                        if (typeof window.initializeMusicSearch === 'function') {
                            window.initializeMusicSearch();
                        } else if (typeof initializeMusicSearch === 'function') {
                            initializeMusicSearch();
                        }
                    }, 200);

                    return false;
                } catch (error) {
                    console.error('openPlaylistModalInline: Error', error);
                    alert('Error opening playlist modal: ' + error.message);
                    return false;
                }
            }

            // Make it globally available immediately
            window.openPlaylistModalInline = openPlaylistModalInline;

            // Simple, direct function to open playlist modal - available immediately
            function openPlaylistModalDirect(e) {
                if (e) {
                    e.preventDefault();
                    e.stopPropagation();
                }

                console.log('openPlaylistModalDirect: Opening playlist modal');

                // Try multiple ways to find the overlay
                let overlay = null;
                let section = document.querySelector('.playlistSection');

                if (section) {
                    overlay = section.querySelector('.overlay');
                    console.log('openPlaylistModalDirect: Found section and overlay', {
                        section: !!section,
                        overlay: !!overlay
                    });
                }

                // If not found, try direct query
                if (!overlay) {
                    overlay = document.querySelector('.playlistSection .overlay');
                    console.log('openPlaylistModalDirect: Trying direct query', {
                        overlay: !!overlay
                    });
                }

                // If still not found, try just .overlay (but make sure it's in playlistSection)
                if (!overlay) {
                    const allOverlays = document.querySelectorAll('.overlay');
                    console.log('openPlaylistModalDirect: Found overlays', {
                        count: allOverlays.length,
                        overlays: Array.from(allOverlays).map(o => ({
                            hasPlaylistSection: !!o.closest('.playlistSection'),
                            classes: o.className
                        }))
                    });

                    // Find overlay that's inside playlistSection
                    for (let ov of allOverlays) {
                        if (ov.closest('.playlistSection')) {
                            overlay = ov;
                            break;
                        }
                    }
                }

                if (!overlay) {
                    console.error('openPlaylistModalDirect: Overlay not found. Available elements:', {
                        playlistSection: !!document.querySelector('.playlistSection'),
                        overlay: !!document.querySelector('.overlay'),
                        allOverlays: document.querySelectorAll('.overlay').length
                    });
                    alert('Unable to open playlist creation modal. Please refresh the page.');
                    return;
                }

                // Open the modal
                overlay.classList.add('active');
                overlay.setAttribute('aria-hidden', 'false');
                overlay.style.display = 'flex';
                overlay.style.zIndex = '10000';
                document.body.style.overflow = 'hidden';

                console.log('openPlaylistModalDirect: Modal opened successfully', {
                    hasActive: overlay.classList.contains('active'),
                    display: overlay.style.display,
                    ariaHidden: overlay.getAttribute('aria-hidden'),
                    zIndex: overlay.style.zIndex
                });

                // Initialize music search after a short delay
                setTimeout(function() {
                    if (typeof window.initializeMusicSearch === 'function') {
                        window.initializeMusicSearch();
                    } else if (typeof initializeMusicSearch === 'function') {
                        initializeMusicSearch();
                    }
                }, 200);
            }

            // Make it globally available immediately
            window.openPlaylistModalDirect = openPlaylistModalDirect;

            // Global click handler for the button - SIMPLE AND RELIABLE
            window.handleCreatePlaylistClick = function(e) {
                console.log('handleCreatePlaylistClick: Called', {
                    event: !!e,
                    hasDirect: typeof window.openPlaylistModalDirect === 'function',
                    hasSimple: typeof window.openPlaylistModalSimple === 'function'
                });

                if (e) {
                    e.preventDefault();
                    e.stopPropagation();
                }

                // Always use the direct function
                if (typeof window.openPlaylistModalDirect === 'function') {
                    window.openPlaylistModalDirect(e);
                } else {
                    console.error('handleCreatePlaylistClick: openPlaylistModalDirect not available');
                    alert('Playlist modal not ready. Please refresh the page.');
                }
            };

            // Attach event listener to button immediately if it exists
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', function() {
                    attachPlaylistButtonHandler();
                });
            } else {
                attachPlaylistButtonHandler();
            }

            function attachPlaylistButtonHandler() {
                const btn = document.getElementById('createPlaylistBtn');
                if (btn) {
                    // Add clean event listener
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        console.log('Create Playlist button clicked (direct handler)');
                        window.handleCreatePlaylistClick(e);
                    }, true);

                    console.log('Direct playlist button handler attached', {
                        button: !!btn,
                        buttonId: btn.id
                    });
                } else {
                    // Try again after a short delay if button not found
                    setTimeout(attachPlaylistButtonHandler, 500);
                }
            }

            // Define openPlaylistModalSimple early to ensure it's available
            window.openPlaylistModalSimple = function(e) {
                try {
                    if (e) {
                        e.preventDefault();
                        e.stopPropagation();
                    }

                    console.log('openPlaylistModalSimple: Opening playlist modal');

                    // Try multiple ways to find the overlay
                    let overlay = null;
                    let section = document.querySelector('.playlistSection');

                    if (section) {
                        overlay = section.querySelector('.overlay');
                        console.log('openPlaylistModalSimple: Found section and overlay', {
                            section: !!section,
                            overlay: !!overlay
                        });
                    }

                    // If not found, try direct query
                    if (!overlay) {
                        overlay = document.querySelector('.playlistSection .overlay');
                        console.log('openPlaylistModalSimple: Trying direct query', {
                            overlay: !!overlay
                        });
                    }

                    // If still not found, try just .overlay
                    if (!overlay) {
                        overlay = document.querySelector('.overlay');
                        console.log('openPlaylistModalSimple: Trying generic overlay', {
                            overlay: !!overlay
                        });
                    }

                    if (overlay) {
                        overlay.classList.add('active');
                        overlay.setAttribute('aria-hidden', 'false');
                        overlay.style.display = 'flex';
                        overlay.style.zIndex = '10000';
                        document.body.style.overflow = 'hidden';
                        console.log('openPlaylistModalSimple: Modal opened successfully', {
                            hasActive: overlay.classList.contains('active'),
                            display: overlay.style.display,
                            ariaHidden: overlay.getAttribute('aria-hidden')
                        });

                        // Initialize music search if available
                        setTimeout(function() {
                            if (typeof window.initializeMusicSearch === 'function') {
                                window.initializeMusicSearch();
                            } else if (typeof initializeMusicSearch === 'function') {
                                initializeMusicSearch();
                            }
                        }, 200);
                    } else {
                        console.error('openPlaylistModalSimple: Overlay not found. Available elements:', {
                            playlistSection: !!document.querySelector('.playlistSection'),
                            overlay: !!document.querySelector('.overlay'),
                            allOverlays: document.querySelectorAll('.overlay').length
                        });
                        alert('Unable to open playlist creation modal. Please refresh the page.');
                    }
                } catch (error) {
                    console.error('openPlaylistModalSimple: Error opening modal', error);
                    alert('Error opening playlist modal: ' + error.message);
                }
            };

            function initializePlaylistModal() {
                console.log('initializePlaylistModal: Starting initialization...');

                // scope to the playlist section so no globals are created
                const section = document.querySelector('.playlistSection');
                if (!section) {
                    console.warn('Playlist section not found, skipping initialization');
                    // Try again after a short delay
                    setTimeout(initializePlaylistModal, 500);
                    return;
                }

                console.log('initializePlaylistModal: Section found', section);

                const overlay = section.querySelector('.overlay');
                const openBtn = section.querySelector('.create-btn');
                const closeBtn = section.querySelector('.close-btn');
                const form = section.querySelector('form.playlistForm');

                console.log('initializePlaylistModal: Elements found', {
                    overlay: !!overlay,
                    openBtn: !!openBtn,
                    closeBtn: !!closeBtn,
                    form: !!form
                });

                // Safety check - if required elements are missing, exit
                if (!overlay || !openBtn || !closeBtn || !form) {
                    console.error('Playlist section required elements not found:', {
                        overlay: !!overlay,
                        openBtn: !!openBtn,
                        closeBtn: !!closeBtn,
                        form: !!form,
                        section: !!section
                    });
                    // Try again after a short delay
                    setTimeout(initializePlaylistModal, 500);
                    return;
                }

                // Optional elements
                const coverUpload = section.querySelector('input.coverUpload');
                const coverUploadSection = section.querySelector('.cover-upload-section');
                const coverPreviewDiv = section.querySelector('.cover-preview-placeholder') || section.querySelector('.upload-placeholder');
                const selectedCountEl = section.querySelector('.selected-count');
                const privacyOptions = section.querySelectorAll('.privacy-option');

                const submitBtn = form.querySelector('.btn-primary');
                const cancelBtn = form.querySelector('.btn-secondary');

                // Buttons are optional - form can still work without them being found immediately
                if (!submitBtn) {
                    console.warn('Submit button not found, but continuing initialization');
                }
                if (!cancelBtn) {
                    console.warn('Cancel button not found, but continuing initialization');
                }

                // New elements for music search
                const musicSearchInput = document.getElementById('musicSearchInput');
                const selectedSongsGrid = document.getElementById('selectedSongsGrid');

                // local-scoped state (won't pollute global scope)
                let ps_selectedPrivacy = 'public';
                let searchTimeout = null;

                // Make searchTimeout accessible globally for the search function
                window.playlistSearchTimeout = null;

                // Open popup handler
                function openPlaylistModal(e) {
                    if (e) {
                        e.preventDefault();
                        e.stopPropagation();
                    }
                    console.log('Create playlist button clicked');
                    console.log('Overlay element:', overlay);
                    console.log('Overlay classes before:', overlay ? overlay.className : 'overlay is null');

                    if (overlay) {
                        overlay.classList.add('active');
                        overlay.setAttribute('aria-hidden', 'false');
                        overlay.style.display = 'flex';
                        document.body.style.overflow = 'hidden';
                        console.log('Modal opened, overlay active:', overlay.classList.contains('active'));
                        console.log('Overlay classes after:', overlay.className);
                        console.log('Overlay display style:', overlay.style.display);

                        // Re-initialize music search when modal opens (in case it wasn't initialized before)
                        setTimeout(() => {
                            if (typeof window.initializeMusicSearch === 'function') {
                                console.log('Re-initializing music search on modal open');
                                window.initializeMusicSearch();
                            } else {
                                console.warn('initializeMusicSearch function not available, attempting direct initialization');
                                // Direct initialization as fallback
                                const searchInput = document.getElementById('musicSearchInput');
                                const songsGrid = document.getElementById('selectedSongsGrid');
                                if (searchInput && songsGrid) {
                                    // Clone to remove old listeners
                                    const newInput = searchInput.cloneNode(true);
                                    searchInput.parentNode.replaceChild(newInput, searchInput);

                                    // Add search listener
                                    newInput.addEventListener('input', function() {
                                        const query = this.value.trim();
                                        console.log('Search input (fallback):', query);

                                        if (window.playlistSearchTimeout) {
                                            clearTimeout(window.playlistSearchTimeout);
                                        }

                                        if (query.length < 2) {
                                            if (typeof updateSelectedSongsGrid === 'function') {
                                                updateSelectedSongsGrid();
                                            } else if (typeof window.updateSelectedSongsGrid === 'function') {
                                                window.updateSelectedSongsGrid();
                                            } else {
                                                songsGrid.innerHTML = '<div style="text-align: center; padding: 20px; color: #6b7280;">Start typing to search for songs...</div>';
                                            }
                                            return;
                                        }

                                        window.playlistSearchTimeout = setTimeout(() => {
                                            console.log('Fallback: Executing search for:', query);
                                            if (typeof searchMusic === 'function') {
                                                searchMusic(query, songsGrid);
                                            } else if (typeof window.searchMusic === 'function') {
                                                window.searchMusic(query, songsGrid);
                                            } else {
                                                console.error('searchMusic function not found in fallback');
                                                songsGrid.innerHTML = '<div style="text-align: center; padding: 20px; color: #ef4444;">Search function not available. Please refresh the page.</div>';
                                            }
                                        }, 300);
                                    });
                                    console.log('Fallback search initialized');
                                }
                            }
                        }, 200);
                    } else {
                        console.error('Overlay not found when trying to open modal');
                    }
                }

                // Simple, direct event handler
                function handleCreatePlaylistClick(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Create Playlist button clicked (from initializePlaylistModal)');
                    openPlaylistModal(e);
                }

                // Use the direct handler if available, otherwise use the local one
                if (typeof window.openPlaylistModalDirect === 'function') {
                    openBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        window.openPlaylistModalDirect(e);
                    }, true);
                    openBtn.onclick = function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        window.openPlaylistModalDirect(e);
                    };
                } else {
                    // Fallback to local handler
                    openBtn.addEventListener('click', handleCreatePlaylistClick, true);
                    openBtn.onclick = handleCreatePlaylistClick;
                }

                // Make it globally accessible for debugging
                window.openPlaylistModal = openPlaylistModal;
                window.playlistModalOverlay = overlay;
                window.playlistModalOpenBtn = openBtn;

                console.log('Playlist modal button initialized', {
                    button: !!openBtn,
                    buttonId: openBtn.id,
                    hasOverlay: !!overlay,
                    hasDirectHandler: typeof window.openPlaylistModalDirect === 'function'
                });

                console.log('Playlist modal initialized successfully. Button:', openBtn);

                // Close popup when clicking overlay (outside the popup)
                overlay.addEventListener('click', (e) => {
                    if (e.target === overlay) closePopup();
                });

                // Close button
                closeBtn.addEventListener('click', closePopup);

                // Cancel action (reset & close)
                if (cancelBtn) {
                    cancelBtn.addEventListener('click', () => {
                        if (form) form.reset();
                        if (coverPreviewDiv) coverPreviewDiv.innerHTML = '🎵';
                        if (privacyOptions && privacyOptions.length > 0) {
                            privacyOptions.forEach((opt) => opt.classList.toggle('selected', opt.dataset.privacy === 'public'));
                        }
                        ps_selectedSongs.clear();
                        updateSelectedCount();
                        updateSelectedSongsGrid();
                        ps_selectedPrivacy = 'public';
                        closePopup();
                    });
                }

                // Escape key closes popup when active - handled in global keydown listener

                function closePopup() {
                    if (overlay) {
                        overlay.classList.remove('active');
                        overlay.setAttribute('aria-hidden', 'true');
                        overlay.style.display = 'none';
                        document.body.style.overflow = '';
                        if (musicSearchInput) musicSearchInput.value = '';
                        // Clear search results from songs grid
                        if (typeof updateSelectedSongsGrid === 'function') {
                            updateSelectedSongsGrid();
                        }
                    }
                }

                // Make closePopup globally accessible
                window.closePlaylistModal = closePopup;


                // Cover upload triggers
                if (coverUploadSection && coverUpload) {
                    coverUploadSection.addEventListener('click', () => coverUpload.click());
                    coverUpload.addEventListener('change', function () {
                        const file = this.files && this.files[0];
                        if (!file) return;
                        const reader = new FileReader();
                        reader.onload = function (evt) {
                            if (coverPreviewDiv) {
                                coverPreviewDiv.innerHTML = `<img src="${evt.target.result}" alt="Cover Preview" class="cover-preview">`;
                            }
                        };
                        reader.readAsDataURL(file);
                    });
                }

                // Privacy options (use data-privacy attribute set in HTML)
                if (privacyOptions && privacyOptions.length > 0) {
                    privacyOptions.forEach(option => {
                    option.addEventListener('click', () => {
                        privacyOptions.forEach(opt => opt.classList.remove('selected'));
                        option.classList.add('selected');
                        ps_selectedPrivacy = option.dataset.privacy || 'public';
                    });
                }

                // Music search functionality - initialize when modal opens
                function initializeMusicSearch() {
                    console.log('initializeMusicSearch: Starting...');

                    const searchInput = document.getElementById('musicSearchInput');
                    const songsGrid = document.getElementById('selectedSongsGrid');

                    console.log('initializeMusicSearch: Elements found', {
                        searchInput: !!searchInput,
                        songsGrid: !!songsGrid,
                        searchInputId: searchInput ? searchInput.id : 'not found',
                        songsGridId: songsGrid ? songsGrid.id : 'not found'
                    });

                    if (!searchInput || !songsGrid) {
                        console.error('Music search elements not found:', {
                            searchInput: !!searchInput,
                            songsGrid: !!songsGrid
                        });
                        return false;
                    }

                    // Remove any existing listener by cloning the input
                    const newSearchInput = searchInput.cloneNode(true);
                    searchInput.parentNode.replaceChild(newSearchInput, searchInput);

                    console.log('initializeMusicSearch: Input cloned and replaced');

                    // Add event listener to the new search input
                    newSearchInput.addEventListener('input', function(e) {
                        const query = this.value.trim();

                        console.log('Search input changed:', query, 'Length:', query.length);

                        // Clear previous timeout
                        if (window.playlistSearchTimeout) {
                            clearTimeout(window.playlistSearchTimeout);
                        }

                        if (query.length < 2) {
                            console.log('Query too short, clearing results');
                            if (typeof updateSelectedSongsGrid === 'function') {
                                updateSelectedSongsGrid();
                            } else if (typeof window.updateSelectedSongsGrid === 'function') {
                                window.updateSelectedSongsGrid();
                            } else {
                                songsGrid.innerHTML = '<div style="text-align: center; padding: 20px; color: #6b7280;">Start typing to search for songs...</div>';
                            }
                            return;
                        }

                        // Debounce search
                        console.log('Setting timeout for search (300ms delay)');
                        window.playlistSearchTimeout = setTimeout(() => {
                            console.log('=== Executing search for:', query, '===');
                            console.log('Available search functions:', {
                                localSearchMusic: typeof searchMusic === 'function',
                                windowSearchMusic: typeof window.searchMusic === 'function'
                            });

                            if (typeof window.searchMusic === 'function') {
                                console.log('Using window.searchMusic function');
                                window.searchMusic(query, songsGrid).catch(err => {
                                    console.error('Search error:', err);
                                    songsGrid.innerHTML = '<div style="text-align: center; padding: 20px; color: #ef4444;">Error searching: ' + err.message + '</div>';
                                });
                            } else if (typeof searchMusic === 'function') {
                                console.log('Using local searchMusic function');
                                searchMusic(query, songsGrid).catch(err => {
                                    console.error('Search error:', err);
                                    songsGrid.innerHTML = '<div style="text-align: center; padding: 20px; color: #ef4444;">Error searching: ' + err.message + '</div>';
                                });
                            } else {
                                console.error('searchMusic function not found');
                                songsGrid.innerHTML = '<div style="text-align: center; padding: 20px; color: #ef4444;">Search function not available. Please refresh the page.</div>';
                            }
                        }, 300);
                    });

                    // Also add keyup as fallback
                    newSearchInput.addEventListener('keyup', function(e) {
                        if (e.key === 'Enter') {
                            const query = this.value.trim();
                            console.log('Enter key pressed, query:', query);
                            if (query.length >= 2) {
                                if (window.playlistSearchTimeout) {
                                    clearTimeout(window.playlistSearchTimeout);
                                }
                                if (typeof searchMusic === 'function') {
                                    searchMusic(query, songsGrid);
                                } else if (typeof window.searchMusic === 'function') {
                                    window.searchMusic(query, songsGrid);
                                }
                            }
                        }
                    });

                    console.log('Music search initialized successfully', {
                        hasSearchInput: !!newSearchInput,
                        hasSongsGrid: !!songsGrid,
                        searchMusicAvailable: typeof window.searchMusic === 'function'
                    });
                    return true;
                }

                // Make it globally accessible
                window.initializeMusicSearch = initializeMusicSearch;

                // Initialize search when modal opens (if elements exist)
                if (musicSearchInput && selectedSongsGrid) {
                    console.log('Initializing music search on page load');
                    initializeMusicSearch();
                } else {
                    console.warn('Music search elements not found on initial load:', {
                        musicSearchInput: !!musicSearchInput,
                        selectedSongsGrid: !!selectedSongsGrid
                    });
                }

                // Also initialize when DOM is ready (fallback)
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', function() {
                        setTimeout(() => {
                            if (typeof window.initializeMusicSearch === 'function') {
                                window.initializeMusicSearch();
                            }
                        }, 500);
                    });
                }

                // Only define searchMusic if it doesn't already exist (to avoid overwriting the early definition)
                if (typeof window.searchMusic !== 'function') {
                    async function searchMusic(query, songsGrid = null) {
                        console.log('searchMusic function called (late definition)', {
                            query: query,
                            songsGridProvided: !!songsGrid,
                            queryLength: query ? query.length : 0
                        });

                        const grid = songsGrid || document.getElementById('selectedSongsGrid');

                        if (!grid) {
                            console.error('Selected songs grid not found', {
                                songsGridProvided: !!songsGrid,
                                gridById: !!document.getElementById('selectedSongsGrid')
                            });
                            return;
                        }

                        console.log('Grid found, starting search...', {
                            gridId: grid.id,
                            gridElement: !!grid
                        });

                        try {
                            // Show loading in songs grid
                            grid.innerHTML = '<div class="search-loading" style="text-align: center; padding: 20px; color: #6b7280;">Searching for "' + query + '"...</div>';

                            console.log('Searching for:', query);
                            console.log('Current location:', window.location.href);
                            console.log('Origin:', window.location.origin);

                            // Use the correct URL pattern (from routes/web.php)
                            const url = `${window.location.origin}/music-search?q=${encodeURIComponent(query)}`;

                            console.log('Fetching from URL:', url);

                        const response = await fetch(url, {
                            method: 'GET',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            }
                        });

                        console.log('Response status:', response.status);

                        if (!response.ok) {
                            const errorText = await response.text();
                            console.error('Error response:', errorText);
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }

                        // Check content type
                        const contentType = response.headers.get('content-type');
                        console.log('Response content-type:', contentType);

                        // Check if response is HTML instead of JSON
                        const responseText = await response.text();
                        console.log('Raw response (first 200 chars):', responseText.substring(0, 200));

                        if (responseText.trim().startsWith('<!DOCTYPE') || responseText.trim().startsWith('<html')) {
                            console.error('Received HTML instead of JSON:', responseText.substring(0, 500));
                            throw new Error('Server returned HTML instead of JSON');
                        }

                        let data;
                        try {
                            data = JSON.parse(responseText);
                        } catch (parseError) {
                            console.error('JSON parse error:', parseError);
                            console.error('Response text:', responseText);
                            throw new Error('Invalid JSON response from server');
                        }

                        console.log('Response data:', data);
                        console.log('Data success:', data.success);
                        console.log('Data array length:', data.data ? data.data.length : 0);
                        console.log('Data type:', typeof data.data);
                        console.log('Is array:', Array.isArray(data.data));

                        console.log('Processing search results...', {
                            success: data.success,
                            hasData: !!data.data,
                            isArray: Array.isArray(data.data),
                            dataLength: data.data ? data.data.length : 0,
                            firstItem: data.data && data.data.length > 0 ? data.data[0] : null
                        });

                        if (data.success && data.data && Array.isArray(data.data) && data.data.length > 0) {
                            console.log('Displaying', data.data.length, 'search results');

                            // Try to use displaySearchResultsInGrid function
                            if (typeof window.displaySearchResultsInGrid === 'function') {
                                console.log('Using window.displaySearchResultsInGrid');
                                window.displaySearchResultsInGrid(data.data, grid);
                            } else if (typeof displaySearchResultsInGrid === 'function') {
                                console.log('Using local displaySearchResultsInGrid');
                                displaySearchResultsInGrid(data.data, grid);
                            } else {
                                console.warn('displaySearchResultsInGrid function not found, using fallback display');
                                // Fallback: display results directly
                                const html = data.data.map(song => {
                                    if (!song || !song.id || !song.name) {
                                        console.warn('Invalid song object:', song);
                                        return '';
                                    }
                                    const escapedName = String(song.name || '').replace(/'/g, "\\'").replace(/"/g, '\\"');
                                    const escapedArtist = String(song.artist || 'Unknown Artist').replace(/'/g, "\\'").replace(/"/g, '\\"');
                                    const escapedThumbnail = String(song.thumbnail || '').replace(/'/g, "\\'").replace(/"/g, '\\"');
                                    return `
                                        <div class="search-result-item" style="padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; margin-bottom: 8px; display: flex; align-items: center; gap: 12px; background: #fff;">
                                            <img src="${escapedThumbnail || 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0xNiAxMkgxNlYyOEgxNlYxMloiIGZpbGw9IiM5Q0EzQUYiLz4KPHBhdGggZD0iTTI0IDEySDI0VjI4SDI0VjEyWiIgZmlsbD0iIzlDQTNBRiIvPgo8L3N2Zz4K'}" alt="Cover" style="width: 50px; height: 50px; border-radius: 6px; object-fit: cover; background: #f3f4f6;" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0xNiAxMkgxNlYyOEgxNlYxMloiIGZpbGw9IiM5Q0EzQUYiLz4KPHBhdGggZD0iTTI0IDEySDI0VjI4SDI0VjEyWiIgZmlsbD0iIzlDQTNBRiIvPgo8L3N2Zz4K'">
                                            <div style="flex: 1;">
                                                <h5 style="margin: 0; font-size: 15px; font-weight: 600; color: #111827;">${escapedName}</h5>
                                                <p style="margin: 0; font-size: 13px; color: #6b7280;">${escapedArtist}</p>
                                            </div>
                                            <button onclick="try{if(typeof window.addSongToPlaylist==='function'){window.addSongToPlaylist(${song.id}, '${escapedName}', '${escapedArtist}', '${escapedThumbnail}');}else{console.error('addSongToPlaylist not available');alert('Please wait for the page to fully load, then try again.');}}catch(e){console.error('Error adding song:',e);alert('Error adding song. Please try again.');}" style="background: #6b7280; color: white; border: none; border-radius: 50%; width: 36px; height: 36px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 14px;" title="Add to playlist">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    `;
                                }).filter(html => html !== '').join('');

                                if (html) {
                                    grid.innerHTML = html;
                                    console.log('Results displayed using fallback method', {
                                        htmlLength: html.length,
                                        songCount: data.data.length
                                    });
                                } else {
                                    console.error('No valid HTML generated from search results');
                                    grid.innerHTML = '<div class="search-no-results" style="text-align: center; padding: 20px; color: #ef4444;">Error displaying results. Please try again.</div>';
                                }
                            }
                        } else {
                            console.log('No results found or empty data', {
                                success: data.success,
                                hasData: !!data.data,
                                isArray: Array.isArray(data.data),
                                length: data.data ? data.data.length : 0,
                                message: data.message || 'No message'
                            });
                            grid.innerHTML = '<div class="search-no-results" style="text-align: center; padding: 20px; color: #6b7280;">No songs found. Try a different search term.</div>';
                        }
                    } catch (error) {
                        console.error('Search error:', error);
                        console.error('Error stack:', error.stack);
                        grid.innerHTML = '<div class="search-no-results" style="text-align: center; padding: 20px; color: #ef4444;">Error searching songs: ' + error.message + '. Please try again.</div>';
                    }
                }

                        // Make searchMusic globally accessible (only if not already defined)
                        if (typeof window.searchMusic !== 'function') {
                            window.searchMusic = searchMusic;
                            console.log('searchMusic function made globally available (late)', {
                                isFunction: typeof window.searchMusic === 'function',
                                functionName: 'searchMusic'
                            });
                        } else {
                            console.log('searchMusic already defined globally, keeping early definition');
                        }
                    }
                } else {
                    console.log('searchMusic already defined globally, skipping late definition');
                }

                // FINAL CHECK: Ensure searchMusic is always available
                if (typeof window.searchMusic !== 'function') {
                    console.error('CRITICAL: searchMusic function is missing! Re-defining...');
                    window.searchMusic = async function(query, songsGrid) {
                        console.error('Fallback searchMusic called - this should not happen');
                        const grid = songsGrid || document.getElementById('selectedSongsGrid');
                        if (grid) {
                            grid.innerHTML = '<div style="text-align: center; padding: 20px; color: #ef4444;">Search function error. Please refresh the page.</div>';
                        }
                    };
                }

                console.log('FINAL CHECK: searchMusic available:', typeof window.searchMusic === 'function');

                function displaySearchResultsInGrid(songs, songsGrid = null) {
                    const grid = songsGrid || selectedSongsGrid || document.getElementById('selectedSongsGrid');

                    if (!grid) {
                        console.error('Selected songs grid not found for displaying results');
                        return;
                    }

                    if (!songs || !Array.isArray(songs) || songs.length === 0) {
                        console.warn('No songs to display or invalid songs array');
                        grid.innerHTML = '<div class="search-no-results" style="text-align: center; padding: 20px; color: #6b7280;">No songs found</div>';
                        return;
                    }

                    console.log('Displaying search results:', songs.length, 'songs');
                    grid.innerHTML = songs.map(song => {
                        // Ensure song has required properties
                        if (!song || !song.id || !song.name) {
                            console.warn('Invalid song object:', song);
                            return '';
                        }
                        // Escape special characters in song data
                        const escapedName = song.name.replace(/'/g, "\\'").replace(/"/g, '\\"');
                        const escapedArtist = song.artist.replace(/'/g, "\\'").replace(/"/g, '\\"');
                        const escapedThumbnail = (song.thumbnail || '').replace(/'/g, "\\'").replace(/"/g, '\\"');

                        return `
                            <div class="search-result-item" style="padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; margin-bottom: 8px; display: flex; align-items: center; gap: 12px; transition: background-color 0.2s;">
                                <img src="${song.thumbnail || 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0xNiAxMkgxNlYyOEgxNlYxMloiIGZpbGw9IiM5Q0EzQUYiLz4KPHBhdGggZD0iTTI0IDEySDI0VjI4SDI0VjEyWiIgZmlsbD0iIzlDQTNBRiIvPgo8L3N2Zz4K'}" alt="Album Cover" style="width: 40px; height: 40px; border-radius: 4px; object-fit: cover;" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0xNiAxMkgxNlYyOEgxNlYxMloiIGZpbGw9IiM5Q0EzQUYiLz4KPHBhdGggZD0iTTI0IDEySDI0VjI4SDI0VjEyWiIgZmlsbD0iIzlDQTNBRiIvPgo8L3N2Zz4K'">
                                <div style="flex: 1; cursor: pointer;" onclick="playSongFromSearch(${song.id}, '${escapedName}', '${escapedArtist}', '${escapedThumbnail}', '${song.music_file || ''}')">
                                    <h5 style="margin: 0; font-size: 14px; font-weight: 600; color: #111827;">${song.name}</h5>
                                    <p style="margin: 0; font-size: 12px; color: #6b7280;">${song.artist}</p>
                                </div>
                                <div style="display: flex; gap: 8px; align-items: center;">
                                    <button onclick="playSongFromSearch(${song.id}, '${escapedName}', '${escapedArtist}', '${escapedThumbnail}', '${song.music_file || ''}')" style="background: #1db954; color: white; border: none; border-radius: 50%; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 12px;" title="Play song">
                                        <i class="fas fa-play"></i>
                                    </button>
                                    <button onclick="try{if(typeof window.addSongToPlaylist==='function'){window.addSongToPlaylist(${song.id}, '${escapedName}', '${escapedArtist}', '${escapedThumbnail}');}else{console.error('addSongToPlaylist not available');alert('Please wait for the page to fully load, then try again.');}}catch(e){console.error('Error adding song:',e);alert('Error adding song. Please try again.');}" style="background: #6b7280; color: white; border: none; border-radius: 50%; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 12px;" title="Add to playlist">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        `;
                    }).filter(html => html !== '').join('');

                    if (grid.innerHTML.trim() === '') {
                        grid.innerHTML = '<div class="search-no-results" style="text-align: center; padding: 20px; color: #6b7280;">No valid songs found</div>';
                    }
                }

                // Make displaySearchResultsInGrid globally accessible
                window.displaySearchResultsInGrid = displaySearchResultsInGrid;

                // Ensure addSongToPlaylist is available (already defined globally, but ensure it uses local functions)
                if (window.addSongToPlaylist) {
                    // Override with version that has access to local functions
                    const originalAddSong = window.addSongToPlaylist;
                    window.addSongToPlaylist = function(musicId, name, artist, thumbnail) {
                        originalAddSong(musicId, name, artist, thumbnail);
                        // Update local UI
                        updateSelectedCount();
                        updateSelectedSongsGrid();
                        if (musicSearchInput) musicSearchInput.value = '';
                    };
                }

                // Global function to play a song from search results
                window.playSongFromSearch = function(musicId, name, artist, thumbnail, musicFile) {
                    console.log('Playing song from search:', { musicId, name, artist, thumbnail, musicFile });

                    // Track the play for monthly analytics
                    trackPlayForSong(musicId);

                    if (window.MusicPlayer) {
                        const track = {
                            id: musicId,
                            name: name,
                            artist: artist,
                            thumbnail: thumbnail,
                            music_file: musicFile
                        };

                        window.MusicPlayer.loadTrack(track);
                        window.MusicPlayer.play();
                    }
                };

                // Flag to prevent recursive updates
                let isUpdatingGrid = false;

                function updateSelectedSongsGrid() {
                    // Prevent recursive calls
                    if (isUpdatingGrid) {
                        console.warn('updateSelectedSongsGrid already executing, ignoring duplicate call');
                        return;
                    }

                    isUpdatingGrid = true;

                    try {
                        const grid = selectedSongsGrid || document.getElementById('selectedSongsGrid');
                        if (!grid) {
                            console.warn('Selected songs grid not found in updateSelectedSongsGrid');
                            isUpdatingGrid = false;
                            return;
                        }

                        if (ps_selectedSongs.size === 0) {
                            grid.innerHTML = '<div style="text-align: center; color: #6b7280; padding: 20px;">No songs selected. Search and add songs to your playlist.</div>';
                            isUpdatingGrid = false;
                            return;
                        }

                        grid.innerHTML = Array.from(ps_selectedSongs.values()).map(song => {
                            const escapedName = String(song.name || '').replace(/'/g, "\\'").replace(/"/g, '\\"').replace(/`/g, '\\`');
                            const escapedArtist = String(song.artist || '').replace(/'/g, "\\'").replace(/"/g, '\\"').replace(/`/g, '\\`');
                            const escapedThumbnail = String(song.thumbnail || '').replace(/'/g, "\\'").replace(/"/g, '\\"').replace(/`/g, '\\`');
                            return `
                            <div class="selected-song-item">
                                <img src="${escapedThumbnail || 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzIiIGhlaWdodD0iMzIiIHZpZXdCb3g9IjAgMCAzMiAzMiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjMyIiBoZWlnaHQ9IjMyIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0xMyAxMEgxM1YyMkgxM1YxMFoiIGZpbGw9IiM5Q0EzQUYiLz4KPHBhdGggZD0iTTE5IDEwSDE5VjIySDE5VjEwWiIgZmlsbD0iIzlDQTNBRiIvPgo8L3N2Zz4K'}" alt="Album Cover" class="selected-song-thumbnail" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzIiIGhlaWdodD0iMzIiIHZpZXdCb3g9IjAgMCAzMiAzMiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjMyIiBoZWlnaHQ9IjMyIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0xMyAxMEgxM1YyMkgxM1YxMFoiIGZpbGw9IiM5Q0EzQUYiLz4KPHBhdGggZD0iTTE5IDEwSDE5VjIySDE5VjEwWiIgZmlsbD0iIzlDQTNBRiIvPgo8L3N2Zz4K'">
                                <div class="selected-song-info">
                                    <h6>${escapedName}</h6>
                                    <p>${escapedArtist}</p>
                                </div>
                                <button class="remove-song-btn" onclick="if(typeof window.removeSongFromPlaylist==='function'){window.removeSongFromPlaylist(${song.id});}else{alert('Remove function not available');}" title="Remove song">×</button>
                            </div>
                        `;
                        }).join('');
                    } catch (error) {
                        console.error('Error in updateSelectedSongsGrid:', error);
                    } finally {
                        isUpdatingGrid = false;
                    }
                }

                // Make updateSelectedSongsGrid globally accessible
                window.updateSelectedSongsGrid = updateSelectedSongsGrid;

                // Global function to remove song from playlis
                window.removeSongFromPlaylist = function(musicId) {
                    ps_selectedSongs.delete(musicId);
                    updateSelectedCount();
                    updateSelectedSongsGrid();
                };

                function updateSelectedCount() {
                    const count = ps_selectedSongs.size;
                    const countEl = selectedCountEl || document.querySelector('.selected-count');
                    if (!countEl) return;
                    if (count > 0) {
                        countEl.textContent = `${count} selected`;
                        countEl.style.display = 'inline-block';
                    } else {
                        countEl.style.display = 'none';
                    }
                }

                // Make updateSelectedCount globally available
                window.updateSelectedCount = updateSelectedCount;

                form.addEventListener('submit', async function (e) {
                    e.preventDefault();
                    if (!form) return;
                    const playlistTitleInput = form.querySelector('input[type="text"]');
                    const playlistTitle = playlistTitleInput ? playlistTitleInput.value.trim() : '';
                    console.log('Form submission - Playlist title:', playlistTitle);
                    console.log('Form submission - Selected songs count:', ps_selectedSongs.size);
                    console.log('Form submission - Selected songs:', Array.from(ps_selectedSongs.keys()));

                    if (!playlistTitle.trim()) {
                        alert('Please enter a playlist name');
                        return;
                    }

                    if (ps_selectedSongs.size === 0) {
                        alert('Please add at least one song to the playlist');
                        return;
                    }

                    // Check playlist limit before submission
                    try {
                        const response = await fetch('/api/user/playlist-limit-check', {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        });

                        if (response.ok) {
                            const data = await response.json();
                            if (data.can_create === false) {
                                alert(data.message || 'You have reached your playlist limit. Please upgrade your plan to create more playlists.');
                                return;
                            }
                        }
                    } catch (error) {
                        console.warn('Could not check playlist limit, proceeding anyway:', error);
                    }

                    if (submitBtn) {
                        submitBtn.textContent = 'Creating...';
                        submitBtn.disabled = true;
                    }

                    try {
                        const response = await fetch('/api/playlist/create', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                playlist_name: playlistTitle,
                                music_ids: Array.from(ps_selectedSongs.keys())
                            })
                        });

                        // Check if response is JSON
                        let data;
                        const contentType = response.headers.get('content-type');
                        if (contentType && contentType.includes('application/json')) {
                            data = await response.json();
                        } else {
                            // If not JSON, it's likely an HTML error page
                            const text = await response.text();
                            console.error('Non-JSON response:', text);
                            throw new Error('Server returned an error. Please check the console for details.');
                        }

                        if (data.success) {
                            alert(`Playlist "${playlistTitle}" created successfully with ${data.data.songs_count} songs!`);

                            if (form) form.reset();
                            if (coverPreviewDiv) coverPreviewDiv.innerHTML = '🎵';
                            if (privacyOptions && privacyOptions.length > 0) {
                                privacyOptions.forEach(opt => opt.classList.toggle('selected', opt.dataset.privacy === 'public'));
                            }
                            ps_selectedSongs.clear();
                            updateSelectedCount();
                            updateSelectedSongsGrid();
                            ps_selectedPrivacy = 'public';
                            closePopup();
                        } else {
                            const errorMsg = data.message || (data.errors ? Object.values(data.errors).flat().join(', ') : 'Failed to create playlist');
                            alert('Error creating playlist: ' + errorMsg);
                        }
                    } catch (error) {
                        console.error('Error creating playlist:', error);
                        let errorMessage = 'Failed to create playlist. Please try again.';
                        if (error.message) {
                            errorMessage = error.message;
                        }
                        alert(errorMessage);
                    } finally {
                        if (submitBtn) {
                            submitBtn.textContent = 'Create Playlist';
                            submitBtn.disabled = false;
                        }
                    }
                });

                function getAuthToken() {
                    // Try to get token from various sources
                    return localStorage.getItem('auth_token') ||
                           sessionStorage.getItem('auth_token') ||
                           document.querySelector('meta[name="auth-token"]')?.getAttribute('content') ||
                           '';
                }

                // Initialize selected songs grid
                updateSelectedSongsGrid();
            }

            // Initialize when DOM is ready
            function initPlaylistModalWhenReady() {
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', function() {
                        console.log('DOMContentLoaded: Initializing playlist modal');
                        initializePlaylistModal();
                    });
                } else {
                    // DOM is already loaded, initialize immediately
                    console.log('DOM already loaded: Initializing playlist modal immediately');
                    initializePlaylistModal();
                }
            }

            // Call initialization
            initPlaylistModalWhenReady();

            // Also try after window load
            window.addEventListener('load', function() {
                console.log('Window loaded: Re-initializing playlist modal');
                setTimeout(initializePlaylistModal, 100);
            });

            // Fallback: Direct button click handler (in case initialization fails)
            document.addEventListener('click', function(e) {
                const createBtn = e.target.closest('.create-btn');
                const playlistSection = e.target.closest('.playlistSection');

                if (createBtn && playlistSection) {
                    console.log('Fallback click handler triggered for create playlist button');
                    const overlay = playlistSection.querySelector('.overlay');
                    if (overlay) {
                        e.preventDefault();
                        e.stopPropagation();
                        overlay.classList.add('active');
                        overlay.setAttribute('aria-hidden', 'false');
                        overlay.style.display = 'flex';
                        document.body.style.overflow = 'hidden';
                        console.log('Fallback: Modal opened via direct click handler');
                    } else {
                        console.error('Fallback: Overlay not found in playlist section');
                    }
                }
            }, true); // Use capture phase to catch early

            // Additional fallback: Try to find button by ID
            document.addEventListener('click', function(e) {
                if (e.target.id === 'createPlaylistBtn' || e.target.closest('#createPlaylistBtn')) {
                    console.log('ID-based fallback handler triggered');
                    e.preventDefault();
                    e.stopPropagation();

                    // Try using the direct function first
                    if (typeof window.openPlaylistModalDirect === 'function') {
                        window.openPlaylistModalDirect(e);
                        return;
                    }

                    // Try using the simple function
                    if (typeof window.openPlaylistModalSimple === 'function') {
                        window.openPlaylistModalSimple(e);
                        return;
                    }

                    // Fallback: Direct overlay manipulation
                    const playlistSection = document.querySelector('.playlistSection');
                    if (playlistSection) {
                        const overlay = playlistSection.querySelector('.overlay');
                        if (overlay) {
                            overlay.classList.add('active');
                            overlay.setAttribute('aria-hidden', 'false');
                            overlay.style.display = 'flex';
                            overlay.style.zIndex = '10000';
                            document.body.style.overflow = 'hidden';
                            console.log('ID-based fallback: Modal opened');

                            // Initialize music search
                            setTimeout(function() {
                                if (typeof window.initializeMusicSearch === 'function') {
                                    window.initializeMusicSearch();
                                }
                            }, 200);
                        } else {
                            console.error('ID-based fallback: Overlay not found');
                            alert('Unable to open playlist modal. Please refresh the page.');
                        }
                    } else {
                        console.error('ID-based fallback: Playlist section not found');
                        alert('Playlist section not found. Please refresh the page.');
                    }
                }
            }, true);

            // Simple function to open playlist modal - works as standalone
            function openPlaylistModalSimple(e) {
                try {
                    if (e) {
                        e.preventDefault();
                        e.stopPropagation();
                    }

                    console.log('openPlaylistModalSimple: Opening playlist modal');

                    // Try multiple ways to find the overlay
                    let overlay = null;
                    let section = document.querySelector('.playlistSection');

                    if (section) {
                        overlay = section.querySelector('.overlay');
                        console.log('openPlaylistModalSimple: Found section and overlay', {
                            section: !!section,
                            overlay: !!overlay
                        });
                    }

                    // If not found, try direct query
                    if (!overlay) {
                        overlay = document.querySelector('.playlistSection .overlay');
                        console.log('openPlaylistModalSimple: Trying direct query', {
                            overlay: !!overlay
                        });
                    }

                    // If still not found, try just .overlay
                    if (!overlay) {
                        overlay = document.querySelector('.overlay');
                        console.log('openPlaylistModalSimple: Trying generic overlay', {
                            overlay: !!overlay
                        });
                    }

                    if (overlay) {
                        overlay.classList.add('active');
                        overlay.setAttribute('aria-hidden', 'false');
                        overlay.style.display = 'flex';
                        overlay.style.zIndex = '10000';
                        document.body.style.overflow = 'hidden';
                        console.log('openPlaylistModalSimple: Modal opened successfully', {
                            hasActive: overlay.classList.contains('active'),
                            display: overlay.style.display,
                            ariaHidden: overlay.getAttribute('aria-hidden')
                        });

                        // Initialize music search if available
                        setTimeout(function() {
                            if (typeof window.initializeMusicSearch === 'function') {
                                window.initializeMusicSearch();
                            } else if (typeof initializeMusicSearch === 'function') {
                                initializeMusicSearch();
                            }
                        }, 200);
                    } else {
                        console.error('openPlaylistModalSimple: Overlay not found. Available elements:', {
                            playlistSection: !!document.querySelector('.playlistSection'),
                            overlay: !!document.querySelector('.overlay'),
                            allOverlays: document.querySelectorAll('.overlay').length
                        });
                        alert('Unable to open playlist creation modal. Please refresh the page.');
                    }
                } catch (error) {
                    console.error('openPlaylistModalSimple: Error opening modal', error);
                    alert('Error opening playlist modal: ' + error.message);
                }
            }

            // Make it globally available immediately
            window.openPlaylistModalSimple = openPlaylistModalSimple;

            // Also ensure it's available on DOM ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', function() {
                    window.openPlaylistModalSimple = openPlaylistModalSimple;
                });
            }
        </script>
        <script>
            // Note: selectedPrivacy and selectedSongs are already declared in initializePlaylistModal
            // Only declare if not already declared
            if (typeof selectedPrivacy === 'undefined') {
                var selectedPrivacy = 'public';
            }
            if (typeof selectedSongs === 'undefined') {
                var selectedSongs = new Set();
            }

            function showPlaylistPopup() {
                document.getElementById('overlay').classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closePlaylistPopup(event) {
                if (event && event.target !== document.getElementById('overlay')) return;
                document.getElementById('overlay').classList.remove('active');
                document.body.style.overflow = 'auto';
            }

            function triggerFileUpload() {
                document.getElementById('coverUpload').click();
            }

            function handleImageUpload(input) {
                const file = input.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const preview = document.getElementById('coverPreview');
                        preview.innerHTML = `<img src="${e.target.result}" alt="Cover Preview" class="cover-preview">`;
                    };
                    reader.readAsDataURL(file);
                }
            }

            function selectPrivacy(element, privacy) {
                document.querySelectorAll('.privacy-option').forEach(option => {
                    option.classList.remove('selected');
                });
                element.classList.add('selected');
                selectedPrivacy = privacy;
            }

            function toggleSong(element) {
                const songTitle = element.querySelector('h4').textContent;

                if (element.classList.contains('selected')) {
                    element.classList.remove('selected');
                    selectedSongs.delete(songTitle);
                } else {
                    element.classList.add('selected');
                    selectedSongs.add(songTitle);
                }

                updateSelectedCount();
            }

            function updateSelectedCount() {
                const countElement = document.getElementById('selectedCount');
                const count = selectedSongs.size;

                if (count > 0) {
                    countElement.textContent = `${count} selected`;
                    countElement.style.display = 'inline-block';
                } else {
                    countElement.style.display = 'none';
                }
            }

            // Form submission
            document.getElementById('playlistForm').addEventListener('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(this);
                const playlistName = this.querySelector('input[type="text"]').value;
                const description = this.querySelector('textarea').value;

                if (!playlistName.trim()) {
                    alert('Please enter a playlist name');
                    return;
                }

                // Simulate playlist creation
                const submitBtn = this.querySelector('.btn-primary');
                submitBtn.textContent = 'Creating...';
                submitBtn.disabled = true;

                setTimeout(() => {
                    alert(`Playlist "${playlistName}" created successfully!\nPrivacy: ${selectedPrivacy}\nSongs added: ${selectedSongs.size}`);

                    // Reset form
                    this.reset();
                    document.getElementById('coverPreview').innerHTML = '🎵';
                    document.querySelectorAll('.privacy-option').forEach((option, index) => {
                        option.classList.toggle('selected', index === 0);
                    });
                    document.querySelectorAll('.song-item').forEach(song => {
                        song.classList.remove('selected');
                    });
                    selectedSongs.clear();
                    updateSelectedCount();
                    selectedPrivacy = 'public';

                    submitBtn.textContent = 'Create Playlist';
                    submitBtn.disabled = false;
                    closePopup();
                }, 2000);
            });

            // Close popup with Escape key - handled in global keydown listener

        </script>
             <script>

function toggleFaq(element) {
    const faqItem = element.parentElement;
    const isActive = faqItem.classList.contains('active');

    // Close all FAQ items
    document.querySelectorAll('.faq-item').forEach(item => {
        item.classList.remove('active');
    });

    // Open clicked item if it wasn't already active
    if (!isActive) {
        faqItem.classList.add('active');
    }
}

// Add some interactive animations
document.addEventListener('DOMContentLoaded', function () {
    const faqQuestions = document.querySelectorAll('.faq-question');

    faqQuestions.forEach(question => {
        question.addEventListener('mouseenter', function () {
            this.style.transform = 'translateX(10px)';
        });

        question.addEventListener('mouseleave', function () {
            this.style.transform = 'translateX(0)';
        });
    });
});
</script>
<script>
// Create animated background particles
function createParticles() {
    const particlesContainer = document.querySelector('.bg-particles');
    const particleCount = 50;

    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';

        // Random positioning
        particle.style.left = Math.random() * 100 + '%';
        particle.style.top = Math.random() * 100 + '%';

        // Random animation delay and duration
        particle.style.animationDelay = Math.random() * 6 + 's';
        particle.style.animationDuration = (Math.random() * 4 + 4) + 's';

        particlesContainer.appendChild(particle);
    }
}

// Add loading overlay functionality
function addLoadingEffect() {
    const playButtons = document.querySelectorAll('.btn-primary');
    const cards = document.querySelectorAll('.playlist-card');

    playButtons.forEach((btn, index) => {
        btn.addEventListener('click', () => {
            const overlay = cards[index].querySelector('.loading-overlay');
            overlay.classList.add('active');

            // Simulate loading
            setTimeout(() => {
                overlay.classList.remove('active');
            }, 2000);
        });
    });
}

// Floating player functionality
function setupFloatingPlayer() {
    const playPauseBtn = document.querySelector('.play-pause-btn');
    if (!playPauseBtn) {
        console.log('Floating player button not found, skipping setup');
        return;
    }

    let isPlaying = true;

    playPauseBtn.addEventListener('click', () => {
        if (isPlaying) {
            playPauseBtn.textContent = '▶️';
            isPlaying = false;
        } else {
            playPauseBtn.textContent = '⏸️';
            isPlaying = true;
        }
    });
}

// Add click ripple effect
function addRippleEffect() {
    const buttons = document.querySelectorAll('.btn');

    buttons.forEach(button => {
        button.addEventListener('click', function (e) {
            let ripple = document.createElement('span');
            let rect = this.getBoundingClientRect();
            let size = Math.max(rect.width, rect.height);

            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
            ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';
            ripple.classList.add('ripple');

            this.appendChild(ripple);

            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
}

// Add hover sound effect simulation
function addHoverEffects() {
    const cards = document.querySelectorAll('.playlist-card');

    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            // Add subtle scale animation on hover
            card.style.transition = 'all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
        });

        card.addEventListener('mouseleave', () => {
            card.style.transition = 'all 0.4s ease-out';
        });
    });
}

// Initialize all features
document.addEventListener('DOMContentLoaded', () => {
    createParticles();
    addLoadingEffect();
    setupFloatingPlayer();
    addRippleEffect();
    addHoverEffects();
});

// Add CSS for ripple effect
if (!document.getElementById('ripple-effect-style')) {
    const rippleStyle = document.createElement('style');
    rippleStyle.id = 'ripple-effect-style';
    rippleStyle.textContent = `
.ripple {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.4);
    transform: scale(0);
    animation: ripple-animation 0.6s linear;
    pointer-events: none;
}

@keyframes ripple-animation {
    to {
        transform: scale(4);
        opacity: 0;
    }
}
`;
    document.head.appendChild(rippleStyle);
}
</script>
<script>
// Only declare if not already declared
if (typeof isLoginMode === 'undefined') {
    var isLoginMode = false;
}

// Modal functions
function openModal() {
    const overlay = document.getElementById('modalOverlay');
    overlay.classList.add('active');
    document.body.style.overflow = 'hidden'; // Prevent background scrolling

    // Reset animations
    resetAnimations();
}

function closeModal() {
    const overlay = document.getElementById('modalOverlay');
    overlay.classList.remove('active');
    document.body.style.overflow = 'auto'; // Restore background scrolling
}

function closeModalOnOverlay(event) {
    if (event.target === event.currentTarget) {
        closeModal();
    }
}

// Close modal on Escape key - handled in global keydown listener

function resetAnimations() {
    // Reset form animations when modal opens
    const animatedElements = document.querySelectorAll('.form-title, .form-subtitle, .form-group, .submit-btn, .divider, .google-btn, .privacy-text');
    animatedElements.forEach(element => {
        element.style.animation = 'none';
        element.offsetHeight; // Trigger reflow
        element.style.animation = null;
    });
}

function switchToLogin() {
    isLoginMode = true;
    const formTitle = document.getElementById('formTitle');
    const formSubtitle = document.getElementById('formSubtitle');
    const submitBtn = document.getElementById('submitBtn');
    const form = document.getElementById('authForm');
    const checkboxGroups = document.querySelectorAll('.checkbox-group');
    const nameField = form.querySelector('input[name="name"]');
    const passwordConfirmationField = form.querySelector('input[name="password_confirmation"]');

    formTitle.textContent = 'Welcome back';
    formSubtitle.innerHTML = 'Don\'t have an account? <a href="#" onclick="switchToRegister(); return false;">Sign up</a>';
    submitBtn.textContent = 'Log In';
    form.action = '{{ route("login.attempt") }}';
    form.setAttribute('action', '{{ route("login.attempt") }}');
    form.classList.add('login-form');

    // Hide fields not needed for login
    nameField.closest('.form-group').style.display = 'none';
    passwordConfirmationField.closest('.form-group').style.display = 'none';
        checkboxGroups.forEach(group => group.style.display = 'none');

    // Update email field placeholder for login
    const emailField = form.querySelector('input[name="email"]');
    if (emailField) {
        emailField.placeholder = 'Email or Username';
        emailField.name = 'email_username';
        emailField.type = 'text'; // Change type to text to allow username input
        emailField.required = true;
    }

    // Set required attributes for login fields only
    const passwordField = form.querySelector('input[name="password"]');
    passwordField.required = true;

    // Remove required from hidden fields
    nameField.required = false;
    passwordConfirmationField.required = false;

    // Remove required from terms checkbox in login mode
    const termsCheckbox = form.querySelector('input[name="terms"]') || form.querySelector('#terms');
    if (termsCheckbox) {
        termsCheckbox.required = false;
    }

    // Add forgot password link if it doesn't exist
    let forgotPasswordLink = form.querySelector('.forgot-password-link');
    if (!forgotPasswordLink) {
        forgotPasswordLink = document.createElement('div');
        forgotPasswordLink.className = 'forgot-password-link';
        forgotPasswordLink.style.cssText = 'text-align: right; margin-bottom: 16px; margin-top: -10px;';
        forgotPasswordLink.innerHTML = '<a href="{{ route("password.forgot") }}" style="color: #667eea; text-decoration: none; font-size: 14px;">Forgot Password?</a>';
        passwordField.closest('.form-group').insertAdjacentElement('afterend', forgotPasswordLink);
    } else {
        forgotPasswordLink.style.display = 'block';
    }

    // Clear form and errors
    form.reset();
    clearFormErrors();

    // Add animation to form change
    const rightPanel = document.querySelector('.right-panel');
    rightPanel.style.animation = 'none';
    rightPanel.offsetHeight; // Trigger reflow
    rightPanel.style.animation = 'fadeInUp 0.5s ease-out';
}

function switchToRegister() {
    isLoginMode = false;
    const formTitle = document.getElementById('formTitle');
    const formSubtitle = document.getElementById('formSubtitle');
    const submitBtn = document.getElementById('submitBtn');
    const form = document.getElementById('authForm');
    const checkboxGroups = document.querySelectorAll('.checkbox-group');
    const nameField = form.querySelector('input[name="name"]');
    const passwordConfirmationField = form.querySelector('input[name="password_confirmation"]');

    formTitle.textContent = 'Create an account';
    formSubtitle.innerHTML = 'Already have an account? <a href="#" onclick="switchToLogin(); return false;">Log in</a>';
    submitBtn.textContent = 'Sign Up';
    form.action = '{{ route("register.attempt") }}';
    form.setAttribute('action', '{{ route("register.attempt") }}');
    form.classList.remove('login-form');

    // Show all fields for registration
    nameField.closest('.form-group').style.display = 'block';
    passwordConfirmationField.closest('.form-group').style.display = 'block';
        checkboxGroups.forEach(group => group.style.display = 'flex');

    // Hide forgot password link in register mode
    const forgotPasswordLink = form.querySelector('.forgot-password-link');
    if (forgotPasswordLink) {
        forgotPasswordLink.style.display = 'none';
    }

    // Update email field placeholder for registration
    const emailField = form.querySelector('input[name="email_username"]');
    if (emailField) {
        emailField.name = 'email';
        emailField.placeholder = 'Email Address';
        emailField.type = 'email'; // Change back to email type for registration
        emailField.required = true;
    }

    // Set required attributes for all registration fields
    nameField.required = true;
    passwordConfirmationField.required = true;

    const passwordField = form.querySelector('input[name="password"]');
    passwordField.required = true;

    // Set required for terms checkbox in registration mode
    const termsCheckbox = form.querySelector('input[name="terms"]') || form.querySelector('#terms');
    if (termsCheckbox) {
        termsCheckbox.required = true;
    }

    // Clear form and errors
    form.reset();
    clearFormErrors();

    // Add animation to form change
    const rightPanel = document.querySelector('.right-panel');
    rightPanel.style.animation = 'none';
    rightPanel.offsetHeight; // Trigger reflow
    rightPanel.style.animation = 'fadeInUp 0.5s ease-out';
}

// Helper function to clear form errors
function clearFormErrors() {
    const errorMessages = document.querySelectorAll('.error-message');
    errorMessages.forEach(msg => msg.remove());

    const errorInputs = document.querySelectorAll('.form-input.error');
    errorInputs.forEach(input => input.classList.remove('error'));
}

// Helper function to show form errors
function showFormErrors(errors) {
    clearFormErrors();

    Object.keys(errors).forEach(field => {
        const input = document.querySelector(`[name="${field}"]`);
        if (input) {
            input.classList.add('error');
            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message';
            errorDiv.textContent = errors[field][0];
            input.parentNode.appendChild(errorDiv);
        }
    });
}

// Function to validate form based on current mode
function validateForm() {
    const form = document.getElementById('authForm');
    if (!form) return false;

    // Find fields by name (they don't have IDs)
    const emailField = form.querySelector('input[name="email"]') || form.querySelector('input[name="email_username"]');
    const passwordField = form.querySelector('input[name="password"]');

    let isValid = true;
    clearFormErrors(); // Clear previous errors first

    if (isLoginMode) {
        // For login, only validate email/username and password
        if (!emailField || !emailField.value.trim()) {
            if (emailField) showFieldError(emailField, 'Email or username is required');
            isValid = false;
        }

        if (!passwordField || !passwordField.value.trim()) {
            if (passwordField) showFieldError(passwordField, 'Password is required');
            isValid = false;
        }
    } else {
        // For registration, validate all fields
        const nameField = form.querySelector('input[name="name"]');
        const confirmPasswordField = form.querySelector('input[name="password_confirmation"]');
        const termsCheckbox = form.querySelector('input[name="terms"]') || form.querySelector('#terms');

        if (!nameField || !nameField.value.trim()) {
            if (nameField) showFieldError(nameField, 'Full name is required');
            isValid = false;
        }

        if (!emailField || !emailField.value.trim()) {
            if (emailField) showFieldError(emailField, 'Email is required');
            isValid = false;
        } else if (emailField && !isValidEmail(emailField.value)) {
            showFieldError(emailField, 'Please enter a valid email address');
            isValid = false;
        }

        if (!passwordField || !passwordField.value.trim()) {
            if (passwordField) showFieldError(passwordField, 'Password is required');
            isValid = false;
        } else if (passwordField && passwordField.value.length < 8) {
            showFieldError(passwordField, 'Password must be at least 8 characters');
            isValid = false;
        }

        if (!confirmPasswordField || !confirmPasswordField.value.trim()) {
            if (confirmPasswordField) showFieldError(confirmPasswordField, 'Please confirm your password');
            isValid = false;
        } else if (passwordField && confirmPasswordField && passwordField.value !== confirmPasswordField.value) {
            showFieldError(confirmPasswordField, 'Passwords do not match');
            isValid = false;
        }

        if (termsCheckbox && termsCheckbox.required && !termsCheckbox.checked) {
            showFieldError(termsCheckbox, 'You must accept the terms and conditions');
            isValid = false;
        }
    }

    return isValid;
}

// Function to validate email format
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Function to show field error
function showFieldError(field, message) {
    // Remove existing error
    const existingError = field.parentNode.querySelector('.error-message');
    if (existingError) {
        existingError.remove();
    }

    // Add error class
    field.classList.add('error');

    // Create error message
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message';
    errorDiv.textContent = message;
    errorDiv.style.color = '#e74c3c';
    errorDiv.style.fontSize = '12px';
    errorDiv.style.marginTop = '4px';

    // Insert error message after the field
    field.parentNode.appendChild(errorDiv);
}

// Add form submission handling - ensure it only runs once
if (!window.formHandlerAttached) {
    window.formHandlerAttached = true;

    document.addEventListener('DOMContentLoaded', function() {
        const authForm = document.getElementById('authForm');
        if (!authForm) {
            console.error('Auth form not found!');
            return;
        }

        console.log('Form submission handler attached');

        let isSubmitting = false; // Prevent multiple submissions

        // Check if form already has a submit handler
        if (authForm.dataset.handlerAttached === 'true') {
            console.log('Form handler already attached, skipping...');
            return;
        }
        authForm.dataset.handlerAttached = 'true';

        authForm.addEventListener('submit', function (e) {
        e.preventDefault();
        console.log('Form submit event triggered');

        // Prevent multiple submissions
        if (isSubmitting) {
            console.log('Form is already submitting, ignoring...');
            return;
        }

        const submitBtn = document.getElementById('submitBtn');
        if (!submitBtn) {
            console.error('Submit button not found!');
            return;
        }

        // Check if button is disabled (already submitting)
        if (submitBtn.disabled) {
            console.log('Submit button is disabled, ignoring...');
            return;
        }

        isSubmitting = true;
        const originalText = submitBtn.textContent;
        const form = this;

        // Double-check form action is set correctly based on mode
        if (isLoginMode) {
            form.action = '{{ route("login.attempt") }}';
            form.setAttribute('action', '{{ route("login.attempt") }}');
        } else {
            form.action = '{{ route("register.attempt") }}';
            form.setAttribute('action', '{{ route("register.attempt") }}');
        }

        // Debug: Show what mode we're in
        console.log('Form submitted in mode:', isLoginMode ? 'LOGIN' : 'REGISTER');
        console.log('Form action URL:', form.action);
        console.log('Form action attribute:', form.getAttribute('action'));

        // Validate form based on current mode
        if (!validateForm()) {
            console.log('Form validation failed');
            isSubmitting = false;
            return;
        }

        console.log('Form validation passed, proceeding with submission');

    // Animate button
    submitBtn.style.transform = 'scale(0.98)';
    submitBtn.textContent = isLoginMode ? 'Logging in...' : 'Signing up...';
    submitBtn.disabled = true;

    // Clear previous errors
    clearFormErrors();

    // Submit form data
    const formData = new FormData(form);

    // Get the current form action URL
    const formAction = form.getAttribute('action') || form.action;

    // Debug: Log form data
    console.log('Form action:', formAction);
    console.log('Form action attribute:', form.getAttribute('action'));
    console.log('Is login mode:', isLoginMode);
    console.log('Form data entries:');
    for (let [key, value] of formData.entries()) {
        console.log(key, ':', value);
    }

    fetch(formAction, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        credentials: 'same-origin'
    })
    .then(response => {
        console.log('Response received. Status:', response.status);
        console.log('Response ok:', response.ok);
        console.log('Response headers:', response.headers);

        // Check if response is ok
        if (!response.ok) {
            console.error('Response not ok, status:', response.status);
            return response.text().then(text => {
                console.error('Error response text:', text);
                try {
                    const errorData = JSON.parse(text);
                    return Promise.reject(errorData);
                } catch (e) {
                    return Promise.reject({
                        success: false,
                        message: `Server error (${response.status}): ${text || 'Unknown error'}`
                    });
                }
            });
        }

        // Check if response is JSON
        const contentType = response.headers.get('content-type');
        console.log('Content-Type:', contentType);

        if (contentType && contentType.includes('application/json')) {
            return response.json();
        } else {
            // If not JSON, get text and try to parse
            return response.text().then(text => {
                console.log('Non-JSON response text:', text.substring(0, 500));
                try {
                    const parsed = JSON.parse(text);
                    return parsed;
                } catch (e) {
                    console.error('Failed to parse response as JSON:', e);
                    // If it's HTML (like a redirect or error page), handle it
                    if (text.includes('<!DOCTYPE') || text.includes('<html')) {
                        return {
                            success: false,
                            message: 'Server returned HTML instead of JSON. This might be a redirect or error page.'
                        };
                    }
                    return {
                        success: false,
                        message: 'Server returned invalid response. Please try again.'
                    };
                }
            });
        }
    })
    .then(data => {
        console.log('Response data received:', data);
        console.log('Login success:', data.success);

        isSubmitting = false;
        submitBtn.style.transform = 'scale(1)';
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;

        if (data && data.success) {
            // Show success message
            const successMsg = data.message || (isLoginMode ? 'Login successful!' : 'Registration successful!');
            showSuccessMessage(successMsg);
            console.log('Login/Registration successful, closing modal...');

            // Close modal after a delay
            setTimeout(() => {
                closeModal();
                // Reload page to show logged in state
                window.location.reload();
            }, 1500);
        } else {
            console.log('Login/Registration failed:', data);
            // Show validation errors
            if (data && data.errors) {
                showFormErrors(data.errors);
            } else {
                const errorMsg = (data && data.message) ? data.message : 'An error occurred. Please try again.';
                showErrorMessage(errorMsg);
            }
        }
    })
    .catch(error => {
        console.error('Fetch error:', error);
        console.error('Error details:', error.message, error.stack);

        isSubmitting = false;
        submitBtn.style.transform = 'scale(1)';
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;

        // Check if error has a message
        if (error && error.message) {
            showErrorMessage(error.message || 'Network error. Please try again.');
        } else if (error && typeof error === 'object' && error.success === false) {
            // Handle error object from response
            showErrorMessage(error.message || 'An error occurred. Please try again.');
        } else {
            showErrorMessage('Network error. Please check your connection and try again.');
        }
    });
    });
    });
}

// Helper function to show success message
function showSuccessMessage(message) {
    const form = document.getElementById('authForm');
    let successDiv = form.querySelector('.success-message');

    if (!successDiv) {
        successDiv = document.createElement('div');
        successDiv.className = 'success-message';
        form.insertBefore(successDiv, form.firstChild);
    }

    successDiv.textContent = message;
    successDiv.style.display = 'block';

    // Hide after 3 seconds
    setTimeout(() => {
        successDiv.style.display = 'none';
    }, 3000);
}

// Helper function to show error message
function showErrorMessage(message) {
    const form = document.getElementById('authForm');
    let errorDiv = form.querySelector('.error-message');

    if (!errorDiv) {
        errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.style.marginBottom = '16px';
        form.insertBefore(errorDiv, form.firstChild);
    }

    errorDiv.textContent = message;
    errorDiv.style.display = 'block';

    // Hide after 5 seconds
    setTimeout(() => {
        errorDiv.style.display = 'none';
    }, 5000);
}

// Add input animation effects
document.querySelectorAll('.form-input').forEach(input => {
    input.addEventListener('focus', function () {
        this.parentElement.style.transform = 'scale(1.02)';
    });

    input.addEventListener('blur', function () {
        this.parentElement.style.transform = 'scale(1)';
    });
});

// Add floating animation to icons on hover
document.querySelectorAll('.icon').forEach(icon => {
    icon.addEventListener('mouseenter', function () {
        this.style.animationPlayState = 'paused';
    });

    icon.addEventListener('mouseleave', function () {
        this.style.animationPlayState = 'running';
    });
});

// Load user playlists
async function loadPlaylists() {
    try {
        const response = await fetch('/api/playlists', {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });

        // If API fails or returns non-JSON, just show empty state instead of scary error
        if (!response.ok) {
            console.warn('Non-OK response for playlists, showing empty state.');
            displayPlaylists([]);
            updateUserStats([]);
            return;
        }

        const data = await response.json();

        if (data && data.success && Array.isArray(data.data)) {
            displayPlaylists(data.data);
            updateUserStats(data.data);
        } else {
            // Treat missing/invalid data as no playlists
            displayPlaylists([]);
            updateUserStats([]);
        }
    } catch (error) {
        console.error('Error loading playlists:', error);
        // On any error, fallback to empty playlists UI instead of error screen
        displayPlaylists([]);
        updateUserStats([]);
    }
}

// Update user stats based on playlist data
function updateUserStats(playlists) {
    const playlistsCount = playlists.length;
    const totalSongs = playlists.reduce((sum, playlist) => sum + playlist.songs_count, 0);
    const estimatedHours = Math.round(totalSongs * 3.5 / 60); // Assuming 3.5 minutes per song
    const uniqueArtists = new Set();

    playlists.forEach(playlist => {
        if (playlist.songs && playlist.songs.length > 0) {
            playlist.songs.forEach(song => {
                if (song.artist) {
                    uniqueArtists.add(song.artist);
                }
            });
        }
    });

    // Update the stat cards
    const playlistsCountEl = document.getElementById('playlistsCount');
    const favoriteSongsCountEl = document.getElementById('favoriteSongsCount');
    const hoursListenedEl = document.getElementById('hoursListened');
    const artistsFollowedEl = document.getElementById('artistsFollowed');

    if (playlistsCountEl) playlistsCountEl.textContent = playlistsCount;
    if (favoriteSongsCountEl) favoriteSongsCountEl.textContent = totalSongs;
    if (hoursListenedEl) hoursListenedEl.textContent = estimatedHours + 'h';
    if (artistsFollowedEl) artistsFollowedEl.textContent = uniqueArtists.size;
}

// Display playlists in the grid
function displayPlaylists(playlists) {
    const container = document.getElementById('playlistsGrid');

    if (playlists.length === 0) {
        container.innerHTML = `
            <div class="col-12">
                <div class="text-center text-white py-5">
                    <i class="fas fa-music fa-3x mb-3 opacity-50"></i>
                    <h4>No playlists yet</h4>
                    <p class="opacity-75">Create your first playlist to get started!</p>
                </div>
            </div>
        `;
        return;
    }

    container.innerHTML = playlists.map((playlist, index) => `
        <div class="playlist-card playlist-card_${(index % 6) + 1}" onclick="openPlaylistDetail('${encodeURIComponent(playlist.playlist_name)}')">
            <div class="playlist-cover">
                ${playlist.thumbnail ?
                    `<img src="${playlist.thumbnail}" alt="Playlist Cover" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                     <div class="playlist-icon" style="display: none;">
                        <i class="fas fa-music"></i>
                     </div>` :
                    `<div class="playlist-icon">
                        <i class="fas fa-music"></i>
                     </div>`
                }
            </div>
            <div class="playlist-info">
                <div class="playlist-info-top">
                    <div>
                        <div class="playlist-title">${playlist.playlist_name}</div>
                        <div class="playlist-stats">${playlist.songs_count} songs </div>
                    </div>
                    <div class="Parent-visualizerDots">
                        <div class="music-visualizerDots">
                            <li></li>
                            <li></li>
                            <li></li>
                        </div>
                        <div>
                            <ul class="dropdown_Musicplaylist">
                                <li><a href="javascript:;" onclick="event.stopPropagation(); playPlaylist('${playlist.playlist_name}')">▶ Play</a></li>
                                <li><a href="javascript:;" onclick="event.stopPropagation(); openPlaylistDetail('${encodeURIComponent(playlist.playlist_name)}')">View Details</a></li>
                                <li><a href="javascript:;" onclick="event.stopPropagation(); sharePlaylist('${playlist.playlist_name}')">Share</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="playlist-actions">
                    <button class="btn btn-primary" onclick="event.stopPropagation(); playPlaylist('${playlist.playlist_name}')">▶ Play</button>
                    <button class="btn btn-secondary" onclick="event.stopPropagation(); openPlaylistDetail('${encodeURIComponent(playlist.playlist_name)}')">View</button>
                </div>
            </div>
        </div>
    `).join('');
}

// Show error message for playlists
function showPlaylistsError(message) {
    const container = document.getElementById('playlistsGrid');
    container.innerHTML = `
        <div class="col-12">
            <div class="text-center text-white py-5">
                <i class="fas fa-exclamation-triangle fa-3x mb-3 text-warning"></i>
                <h4>Error Loading Playlists</h4>
                <p class="opacity-75">${message}</p>
                <button class="btn btn-primary" onclick="loadPlaylists()">Try Again</button>
            </div>
        </div>
    `;
}

// Open playlist detail page
function openPlaylistDetail(playlistName) {
    window.location.href = `/playlist-detail?name=${playlistName}`;
}

// Play playlist
function playPlaylist(playlistName) {
    console.log('Playing playlist:', playlistName);
    // Add your playlist player logic here
}

// Share playlist
function sharePlaylist(playlistName) {
    if (navigator.share) {
        navigator.share({
            title: `Check out my playlist: ${playlistName}`,
            text: `Listen to my playlist "${playlistName}" on SingWithMe`,
            url: window.location.origin + `/playlist-detail?name=${encodeURIComponent(playlistName)}`
        });
    } else {
        // Fallback: copy to clipboard
        const url = window.location.origin + `/playlist-detail?name=${encodeURIComponent(playlistName)}`;
        navigator.clipboard.writeText(url).then(() => {
            alert('Playlist link copied to clipboard!');
        });
    }
}

// Global keydown event listener for all Escape key functionality
document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
        // Close any active popup
        const activePopup = document.querySelector('.popup-overlay.active');
        if (activePopup) {
            activePopup.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Close any active modal
        const activeModal = document.querySelector('.modal.show');
        if (activeModal) {
            const modal = bootstrap.Modal.getInstance(activeModal);
            if (modal) {
                modal.hide();
            }
        }

        // Close any custom modals
        const customModal = document.querySelector('.modal-container');
        if (customModal && customModal.style.display !== 'none') {
            closeModal();
        }
    }
});

// Load favorites
async function loadFavorites() {
    try {
        const response = await fetch('/api/favorites/latest?limit=6', {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });

        if (!response.ok) {
            console.warn('Non-OK response for favorites, showing empty state.');
            displayFavorites([]);
            return;
        }

        const data = await response.json();

        if (data && data.success && Array.isArray(data.data)) {
            displayFavorites(data.data);
        } else {
            // Treat missing/invalid data as no favorites
            displayFavorites([]);
        }
    } catch (error) {
        console.error('Error loading favorites:', error);
        // On any error, fallback to empty favorites UI instead of error screen
        displayFavorites([]);
    }
}

// Display favorites in the grid
function displayFavorites(favorites) {
    const container = document.getElementById('favoritesGrid');

    if (favorites.length === 0) {
        container.innerHTML = `
            <div class="no-favorites">
                <i class="fas fa-heart"></i>
                <h4>No favorite songs yet</h4>
                <p>Start adding songs to your favorites to see them here!</p>
                <button class="fvtBtn btn btn-primary" onclick="openAddToFavoritesModal()">
                    <i class="fas fa-plus me-2"></i>Add Songs to Favorites
                </button>
            </div>
        `;
        return;
    }

    container.innerHTML = favorites.map(song => `
        <div class="favorite-song-card" onclick="playFavoriteSong(${song.id}, '${song.name.replace(/'/g, "\\'")}', '${song.artist.replace(/'/g, "\\'")}', '${song.thumbnail}', '${song.music_file}')">
            <div class="favorite-song-header">
                <img src="${song.thumbnail || 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNTAiIGhlaWdodD0iNTAiIHZpZXdCb3g9IjAgMCA1MCA1MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjUwIiBoZWlnaHQ9IjUwIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0yMCAxNUgyMFYzNUgyMFYxNVoiIGZpbGw9IiM5Q0EzQUYiLz4KPHBhdGggZD0iTTMwIDE1SDMwVjM1SDMwVjE1WiIgZmlsbD0iIzlDQTNBRiIvPgo8L3N2Zz4K'}"
                     alt="Album Cover"
                     class="favorite-song-thumbnail"
                     onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNTAiIGhlaWdodD0iNTAiIHZpZXdCb3g9IjAgMCA1MCA1MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjUwIiBoZWlnaHQ9IjUwIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0yMCAxNUgyMFYzNUgyMFYxNVoiIGZpbGw9IiM5Q0EzQUYiLz4KPHBhdGggZD0iTTMwIDE1SDMwVjM1SDMwVjE1WiIgZmlsbD0iIzlDQTNBRiIvPgo8L3N2Zz4K'">
                <div class="favorite-song-info">
                    <h4 class="favorite-song-title">${song.name}</h4>
                    <p class="favorite-song-artist">${song.artist}</p>
                </div>
                <div class="favorite-song-actions" onclick="event.stopPropagation()">
                    <button class="favorite-song-btn play-btn" onclick="playFavoriteSong(${song.id}, '${song.name.replace(/'/g, "\\'")}', '${song.artist.replace(/'/g, "\\'")}', '${song.thumbnail}', '${song.music_file}')" title="Play song">
                        <i class="fas fa-play"></i>
                    </button>
                    <button class="favorite-song-btn remove-btn" onclick="removeFromFavorites(${song.id})" title="Remove from favorites">
                        <i class="fas fa-heart-broken"></i>
                    </button>
                </div>
            </div>
            <div class="favorite-song-meta">
                <span class="favorite-song-duration">${song.duration || '0:00'}</span>
                <span class="favorite-song-added">Added ${formatDate(song.added_at)}</span>
            </div>
        </div>
    `).join('');
}

// Show error message for favorites
function showFavoritesError(message) {
    const container = document.getElementById('favoritesGrid');
    container.innerHTML = `
        <div class="no-favorites">
            <i class="fas fa-exclamation-triangle"></i>
            <h4>Error Loading Favorites</h4>
            <p>${message}</p>
            <button class="btn btn-primary" onclick="loadFavorites()">Try Again</button>
        </div>
    `;
}

// Play favorite song
function playFavoriteSong(songId, name, artist, thumbnail, musicFile) {
    console.log('Playing favorite song:', { songId, name, artist, thumbnail, musicFile });

    if (window.MusicPlayer) {
        const track = {
            id: songId,
            name: name,
            artist: artist,
            thumbnail: thumbnail,
            music_file: musicFile
        };

        window.MusicPlayer.loadTrack(track);
        window.MusicPlayer.play();
    }
}

// Remove from favorites
async function removeFromFavorites(songId) {
    try {
        const response = await fetch('/api/favorites/remove', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                music_id: songId
            })
        });

        const data = await response.json();

        if (data.success) {
            showNotification('Song removed from favorites', 'success');
            loadFavorites(); // Reload favorites
        } else {
            showNotification('Error removing song: ' + data.message, 'error');
        }
    } catch (error) {
        console.error('Error removing from favorites:', error);
        showNotification('Error removing song from favorites', 'error');
    }
}

// Open favorites detail page
function openFavoritesDetail() {
    window.location.href = '/favorites-detail';
}

// Open add to favorites modal
function openAddToFavoritesModal() {
    // For now, redirect to search page or open a modal
    // You can implement a modal similar to playlist creation
    window.location.href = '/songs-library';
}

// Format date helper
function formatDate(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const diffTime = Math.abs(now - date);
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

    if (diffDays === 1) {
        return 'yesterday';
    } else if (diffDays < 7) {
        return `${diffDays} days ago`;
    } else if (diffDays < 30) {
        const weeks = Math.floor(diffDays / 7);
        return `${weeks} week${weeks > 1 ? 's' : ''} ago`;
    } else {
        return date.toLocaleDateString();
    }
}

// Show notification helper
function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `alert alert-${type === 'success' ? 'success' : type === 'error' ? 'danger' : 'info'} alert-dismissible fade show position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

    document.body.appendChild(notification);

    // Auto remove after 3 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 3000);
}

// Subscription popup functions (Global scope)
// Only declare if not already declared
if (typeof selectedPlan === 'undefined') {
    var selectedPlan = null;
}
if (typeof selectedPaymentMethod === 'undefined') {
    var selectedPaymentMethod = null;
}
let stripe = null;
let stripeElements = null;
let stripeCardElement = null;
let paypalButtons = null;
let googlePayButton = null;
let googlePayToken = null;
let squarePayments = null;
let squareCard = null;
let isSquareInitialized = false;

// Play Tracking System
async function trackPlayForSong(musicId) {
    if (!musicId) {
        console.log('PlayTracking: No music ID provided');
        return;
    }

    try {
        console.log('PlayTracking: Tracking play for song', { music_id: musicId });

        const response = await fetch('/api/monthly-plays/track', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                music_id: musicId
            })
        });

        const data = await response.json();

        if (data.success) {
            console.log('PlayTracking: Play tracked successfully', {
                monthly_play_id: data.data.monthly_play_id,
                current_plays: data.data.current_plays,
                month: data.data.month,
                year: data.data.year,
                music_name: data.data.music_name,
                artist: data.data.artist
            });
        } else {
            console.warn('PlayTracking: Failed to track play', data.message);
        }

    } catch (error) {
        console.error('PlayTracking: Error tracking play', error);
    }
}

// Ad Injection System
let adInjectionSystem = {
    isEnabled: false,
    currentAd: null,
    adContainer: null,
    isShowingAd: false,
    showAdsBetweenSongs: true, // Show ads between every song for free users
    showAdsDuringPlayback: true, // Show ads while music is playing
    adTimer: null,
    nextAdTime: 0,

    init() {
        console.log('AdInjectionSystem: Initializing...');
        this.adContainer = document.getElementById('ad-container');
        this.checkAdStatus();
    },

    async checkAdStatus() {
        try {
            console.log('AdInjectionSystem: Checking ad status...');

            const response = await fetch('/api/ad-injection/data', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            console.log('AdInjectionSystem: API response status:', response.status);

            const data = await response.json();
            console.log('AdInjectionSystem: API response data:', data);

            // Fix: Check data.data.show_ads instead of data.show_ads (API returns nested structure)
            if (data.success && data.data && data.data.show_ads) {
                this.isEnabled = true;
                this.currentAd = data.data.ad;
                this.nextAdTime = data.data.next_ad_in_seconds || 30; // Default 30 seconds
                console.log('AdInjectionSystem: Ads enabled - will show during playback and between songs', {
                    ad: this.currentAd,
                    showAdsBetweenSongs: this.showAdsBetweenSongs,
                    showAdsDuringPlayback: this.showAdsDuringPlayback,
                    nextAdIn: this.nextAdTime
                });
                // Start timer for during-playback ads
                this.startAdTimer();
            } else {
                this.isEnabled = false;
                // Clear any existing ad timer if ads are disabled
                if (this.adTimer) {
                    clearTimeout(this.adTimer);
                    this.adTimer = null;
                }
                console.log('AdInjectionSystem: Ads disabled - Premium user or no ads available', {
                    success: data.success,
                    show_ads: data.data ? data.data.show_ads : 'no data',
                    message: data.data ? data.data.message : 'Unknown error'
                });
            }
        } catch (error) {
            console.error('AdInjectionSystem: Error checking ad status', error);
            this.isEnabled = false;
        }
    },

    // Start ad timer for during-playback ads
    startAdTimer() {
        if (!this.isEnabled || this.adTimer) return;

        console.log(`AdInjectionSystem: Starting ad timer - next ad in ${this.nextAdTime} seconds`);

        this.adTimer = setTimeout(() => {
            this.showAdDuringPlayback();
        }, this.nextAdTime * 1000);
    },

    // Show ad between songs (called when song completes)
    showAdBetweenSongs() {
        if (!this.isEnabled || this.isShowingAd) {
            console.log('AdInjectionSystem: Skipping ad - system disabled or already showing ad');
            return;
        }

        console.log('AdInjectionSystem: Showing ad between songs');
        this.showAd();
    },

    // Show ad during music playback
    showAdDuringPlayback() {
        if (!this.isEnabled || this.isShowingAd) {
            console.log('AdInjectionSystem: Skipping during-playback ad - system disabled or already showing ad');
            return;
        }

        console.log('AdInjectionSystem: Showing ad during playback');
        this.showAd();
    },

    showAd() {
        if (!this.isEnabled || !this.currentAd || this.isShowingAd) return;

        console.log('AdInjectionSystem: Showing ad', this.currentAd);
        this.isShowingAd = true;

        // Pause music
        if (window.MusicPlayer && window.MusicPlayer.isPlaying) {
            window.MusicPlayer.pause();
        }

        // Create ad modal
        this.createAdModal();

        // Set up ad completion timer (5-15 seconds)
        const adDuration = Math.floor(Math.random() * 10) + 5; // 5-15 seconds
        setTimeout(() => {
            this.hideAd();
        }, adDuration * 1000);
    },

    createAdModal() {
        if (!this.adContainer) {
            this.adContainer = document.createElement('div');
            this.adContainer.id = 'ad-container';
            document.body.appendChild(this.adContainer);
        }

        const adType = this.currentAd.type;
        const adContent = adType === 'video' ?
            `<video autoplay muted style="width: 100%; height: 100%; object-fit: cover;">
                <source src="${this.currentAd.file_url}" type="video/mp4">
            </video>` :
            `<img src="${this.currentAd.file_url}" style="width: 100%; height: 100%; object-fit: cover;" alt="${this.currentAd.title}">`;

        this.adContainer.innerHTML = `
            <div class="ad-overlay" style="
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.95);
                z-index: 10000;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
            ">
                <div class="ad-content" style="
                    position: relative;
                    width: 90%;
                    max-width: 600px;
                    height: 400px;
                    background: white;
                    border-radius: 12px;
                    overflow: hidden;
                    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
                ">
                    <div class="ad-header" style="
                        position: absolute;
                        top: 0;
                        left: 0;
                        right: 0;
                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                        color: white;
                        padding: 15px 20px;
                        z-index: 10;
                    ">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <h3 style="margin: 0; font-size: 18px; font-weight: 600;">Advertisement</h3>
                                <p style="margin: 5px 0 0 0; font-size: 14px; opacity: 0.9;">${this.currentAd.title}</p>
                            </div>
                            <div class="ad-timer" style="
                                background: rgba(255, 255, 255, 0.2);
                                padding: 8px 12px;
                                border-radius: 20px;
                                font-weight: 600;
                                font-size: 14px;
                            ">
                                <span id="ad-countdown">5</span>s
                            </div>
                        </div>
                    </div>

                    <div class="ad-media" style="
                        width: 100%;
                        height: 100%;
                        position: relative;
                        cursor: pointer;
                    " onclick="window.open('${this.currentAd.link}', '_blank')">
                        ${adContent}
                    </div>

                    <div class="ad-footer" style="
                        position: absolute;
                        bottom: 0;
                        left: 0;
                        right: 0;
                        background: rgba(0, 0, 0, 0.8);
                        color: white;
                        padding: 15px 20px;
                        text-align: center;
                    ">
                        <p style="margin: 0; font-size: 14px;">
                            <i class="fas fa-external-link-alt" style="margin-right: 8px;"></i>
                            Click to visit advertiser
                        </p>
                    </div>
                </div>

                <div class="ad-info" style="
                    margin-top: 20px;
                    text-align: center;
                    color: white;
                ">
                    <p style="margin: 0; font-size: 14px; opacity: 0.8;">
                        <i class="fas fa-info-circle" style="margin-right: 8px;"></i>
                        Upgrade to Premium to remove ads
                    </p>
                </div>
            </div>
        `;

        // Start countdown
        this.startAdCountdown();
    },

    startAdCountdown() {
        let countdown = 5;
        const countdownElement = document.getElementById('ad-countdown');

        const timer = setInterval(() => {
            countdown--;
            if (countdownElement) {
                countdownElement.textContent = countdown;
            }

            if (countdown <= 0) {
                clearInterval(timer);
            }
        }, 1000);
    },

    hideAd() {
        console.log('AdInjectionSystem: Hiding ad');
        this.isShowingAd = false;

        if (this.adContainer) {
            this.adContainer.innerHTML = '';
        }

        // Resume music
        if (window.MusicPlayer && !window.MusicPlayer.isPlaying) {
            window.MusicPlayer.play();
        }

        // Get new ad for next time
        this.getRandomAd().then(() => {
            // Restart timer for during-playback ads
            if (this.isEnabled && this.showAdsDuringPlayback) {
                this.nextAdTime = Math.floor(Math.random() * 120) + 30; // 30-150 seconds
                this.startAdTimer();
            }
        });
    },

    async getRandomAd() {
        try {
            const response = await fetch('/api/ad-injection/random-ad', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const data = await response.json();

            // Fix: Check data.data.show_ads instead of data.show_ads (API returns nested structure)
            if (data.success && data.data && data.data.show_ads && data.data.ad) {
                this.currentAd = data.data.ad;
                console.log('AdInjectionSystem: New ad loaded for next song', {
                    ad: this.currentAd
                });
            } else {
                this.isEnabled = false;
                console.log('AdInjectionSystem: No more ads available, disabling system');
            }
        } catch (error) {
            console.error('AdInjectionSystem: Error getting random ad', error);
            this.isEnabled = false;
        }
    },

    destroy() {
        if (this.adTimer) {
            clearTimeout(this.adTimer);
            this.adTimer = null;
        }
        this.isEnabled = false;
        this.isShowingAd = false;
        if (this.adContainer) {
            this.adContainer.innerHTML = '';
        }
    }
};

// Initialize Stripe and Google Pay
document.addEventListener('DOMContentLoaded', function() {
    if (typeof Stripe !== 'undefined') {
        stripe = Stripe('{{ env("STRIPE_KEY") }}');
    }

    // Initialize Google Pay when SDK is loaded
    if (typeof google !== 'undefined' && google.payments) {
        console.log('Google Pay SDK loaded, initializing...');
        initializeGooglePay();
    } else {
        console.log('Google Pay SDK not loaded yet, waiting...');
        // Wait for Google Pay SDK to load
        window.addEventListener('load', function() {
            if (typeof google !== 'undefined' && google.payments) {
                console.log('Google Pay SDK loaded on window load, initializing...');
                initializeGooglePay();
            } else {
                console.log('Google Pay SDK still not available');
            }
        });
    }

    // Initialize Square when SDK is loaded
    if (typeof Square !== 'undefined') {
        console.log('Square SDK loaded, initializing...');
        initializeSquare();
    } else {
        console.log('Square SDK not loaded yet, waiting...');
        // Wait for Square SDK to load
        window.addEventListener('load', function() {
            if (typeof Square !== 'undefined') {
                console.log('Square SDK loaded on window load, initializing...');
                initializeSquare();
            } else {
                console.log('Square SDK still not available');
            }
        });

        // Also try after a short delay
        setTimeout(function() {
            if (typeof Square !== 'undefined') {
                console.log('Square SDK loaded after timeout, initializing...');
                initializeSquare();
            }
        }, 2000);
    }

    // Initialize Ad Injection System
    if (typeof adInjectionSystem !== 'undefined') {
        console.log('Initializing Ad Injection System...');
        adInjectionSystem.init();

        // Make it globally available
        window.adInjectionSystem = adInjectionSystem;
        console.log('AdInjectionSystem: Made globally available');

        // Also make it available to MusicPlayer if it exists
        if (window.MusicPlayer) {
            console.log('AdInjectionSystem: MusicPlayer found, linking ad system');
        }
    } else {
        console.warn('AdInjectionSystem: adInjectionSystem object not found');
    }

    // Function to check if ad system is ready
    window.checkAdSystemReady = function() {
        if (window.adInjectionSystem) {
            console.log('AdInjectionSystem: System is ready and available');
            return true;
        } else {
            console.log('AdInjectionSystem: System not ready, retrying in 500ms...');
            setTimeout(() => {
                window.checkAdSystemReady();
            }, 500);
            return false;
        }
    };

    // Start checking for ad system readiness
    window.checkAdSystemReady();

    // Test function to manually trigger an ad (for debugging)
    window.testAdSystem = function() {
        if (window.adInjectionSystem && window.adInjectionSystem.isEnabled) {
            console.log('Testing ad system - showing ad manually');
            window.adInjectionSystem.showAd();
        } else {
            console.log('Ad system not available or not enabled');
        }
    };
});

function openSubscriptionPopup(planId, planTitle, planPrice, planDuration) {
    selectedPlan = planId;
    selectedPaymentMethod = null;

    const popup = document.getElementById('subscriptionPopup');
    const planName = document.getElementById('selectedPlanName');
    const priceEl = document.getElementById('selectedPlanPrice');
    const periodEl = document.getElementById('selectedPlanPeriod');

    // Reset payment method selection
    document.querySelectorAll('.subscription-popup .payment-method').forEach(method => {
        method.classList.remove('selected');
    });

    // Hide all payment forms
    document.querySelectorAll('.payment-form').forEach(form => {
        form.style.display = 'none';
    });

    // Reset terms checkbox
    document.getElementById('agreeTerms').checked = false;

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

function closeSubscriptionPopup(event) {
    if (event && event.target !== event.currentTarget) return;

    const popup = document.getElementById('subscriptionPopup');
    popup.classList.remove('active');
    document.body.style.overflow = '';

    selectedPlan = null;
    selectedPaymentMethod = null;
}

// Helper function to get the actual plan price from the DOM
function getPlanPrice() {
    const priceEl = document.getElementById('selectedPlanPrice');
    if (!priceEl) return '0';
    const priceText = priceEl.textContent.trim();

    if (priceText === 'Free') {
        return '0';
    }

    // Remove £ symbol and parse the number
    const price = parseFloat(priceText.replace('£', '').trim());
    return isNaN(price) ? '0' : price.toString();
}

function selectPaymentMethod(element, method) {
    // Remove selection from all payment methods
    document.querySelectorAll('.subscription-popup .payment-method').forEach(method => {
        method.classList.remove('selected');
    });

    // Hide all payment forms
    document.querySelectorAll('.payment-form').forEach(form => {
        form.style.display = 'none';
    });

    // Add selection to clicked method
    element.classList.add('selected');
    selectedPaymentMethod = method;

    // Show appropriate payment form
    if (method === 'stripe') {
        showStripeForm();
    } else if (method === 'paypal') {
        showPayPalForm();
    } else if (method === 'google-pay') {
        showGooglePayForm();
    } else if (method === 'apple-pay') {
        showApplePayForm();
    } else if (method === 'square') {
        showSquareForm();
    }
}

function showStripeForm() {
    const stripeForm = document.getElementById('stripe-payment-form');
    stripeForm.style.display = 'block';

    // Initialize Stripe Elements if not already done
    if (!stripeCardElement && stripe) {
        const elements = stripe.elements();
        stripeCardElement = elements.create('card', {
            style: {
                base: {
                    fontSize: '16px',
                    color: '#424770',
                    '::placeholder': {
                        color: '#aab7c4',
                    },
                },
            },
        });

        stripeCardElement.mount('#stripe-card-element');

        // Handle real-time validation errors from the card Element
        stripeCardElement.on('change', function(event) {
            const displayError = document.getElementById('stripe-card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
    }
}

function showPayPalForm() {
    const paypalForm = document.getElementById('paypal-payment-button');
    paypalForm.style.display = 'block';

    // Initialize PayPal buttons if not already done
    if (!paypalButtons && typeof paypal !== 'undefined') {
        paypalButtons = paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: getPlanPrice()
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Process the payment
                    processPaymentWithMethod('paypal', details.id);
                });
            },
            onError: function(err) {
                showNotification('PayPal payment failed: ' + err.message, 'error');
            }
        });

        paypalButtons.render('#paypal-button-container');
    }
}

function initializeGooglePay() {
    console.log('Initializing Google Pay...');
    let paymentsClient;

    try {
        paymentsClient = new google.payments.api.PaymentsClient({
            environment: 'TEST' // Use 'PRODUCTION' for live environment
        });
        console.log('Google Pay client created successfully');
    } catch (error) {
        console.error('Error creating Google Pay client:', error);
        return;
    }

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

    const googlePayBaseConfiguration = {
        apiVersion: 2,
        apiVersionMinor: 0,
        allowedPaymentMethods: [baseCardPaymentMethod],
        merchantInfo: {
            merchantId: 'BCR2DN4TZ5XVLH9H', // Replace with your merchant ID
            merchantName: 'SingWithMe'
        }
    };

    // Store the payments client globally
    window.googlePaymentsClient = paymentsClient;
    window.googlePayBaseConfiguration = googlePayBaseConfiguration;
    console.log('Google Pay initialized successfully');
}

function showGooglePayForm() {
    const googlePayForm = document.getElementById('google-pay-payment-form');
    if (googlePayForm) {
        googlePayForm.style.display = 'block';
    }

    googlePayToken = null;

    // Initialize Google Pay button if not already done
    if (window.googlePaymentsClient && !googlePayButton) {
        createGooglePayButton();
    }
}

function createGooglePayButton() {
    if (!window.googlePaymentsClient) {
        const container = document.getElementById('google-pay-button-container');
        if (container) {
            container.innerHTML = '<p style="color: #ef4444; text-align: center;">Google Pay is not available in your browser</p>';
        }
        return;
    }

    // Check if Google Pay is available
    window.googlePaymentsClient.isReadyToPay(window.googlePayBaseConfiguration)
        .then(function(response) {
            if (response.result) {
                const paymentDataRequest = {
                    ...window.googlePayBaseConfiguration,
                    transactionInfo: {
                        totalPriceStatus: 'FINAL',
                        totalPrice: getPlanPrice(),
                        currencyCode: 'GBP'
                    }
                };

                googlePayButton = window.googlePaymentsClient.createButton({
                    onClick: onGooglePayButtonClicked,
                    buttonColor: 'default',
                    buttonType: 'pay'
                });

                const container = document.getElementById('google-pay-button-container');
                if (container) {
                    container.innerHTML = '';
                    container.appendChild(googlePayButton);
                }
            } else {
                const container = document.getElementById('google-pay-button-container');
                if (container) {
                    container.innerHTML = '<p style="color: #ef4444; text-align: center;">Google Pay is not available for this transaction</p>';
                }
            }
        })
        .catch(function(err) {
            console.error('Google Pay availability check failed:', err);
            const container = document.getElementById('google-pay-button-container');
            if (container) {
                container.innerHTML = '<p style="color: #ef4444; text-align: center;">Google Pay is not available</p>';
            }
        });
}

function onGooglePayButtonClicked() {
    if (!window.googlePaymentsClient) {
        showNotification('Google Pay is not available', 'error');
        return;
    }

    const paymentDataRequest = {
        ...window.googlePayBaseConfiguration,
        transactionInfo: {
            totalPriceStatus: 'FINAL',
            totalPrice: getPlanPrice(),
            currencyCode: 'GBP'
        }
    };

    window.googlePaymentsClient.loadPaymentData(paymentDataRequest)
        .then(function(paymentData) {
            processGooglePayPayment(paymentData);
        })
        .catch(function(err) {
            console.error('Google Pay error:', err);
            showNotification('Google Pay payment failed: ' + err.message, 'error');
        });
}

async function processGooglePayPayment(paymentData) {
    try {
        const gatewayToken = paymentData?.paymentMethodData?.tokenizationData?.token || null;

        if (!gatewayToken) {
            showNotification('Unable to get Google Pay token', 'error');
            return;
        }

        try {
            const parsedToken = JSON.parse(gatewayToken);
            googlePayToken = parsedToken?.id || gatewayToken;
        } catch (parseError) {
            googlePayToken = gatewayToken;
        }

        if (!googlePayToken) {
            showNotification('Unable to get Google Pay token', 'error');
            return;
        }

        showNotification('Google Pay authorized. Click Purchase Now to continue.', 'success');

    } catch (error) {
        console.error('Google Pay processing error:', error);
        showNotification('Failed to process Google Pay payment', 'error');
    }
}

function setPurchaseButtonLoading(isLoading) {
    const button = document.getElementById('purchaseSubscriptionBtn');
    if (!button) return;

    if (!button.dataset.originalText) {
        button.dataset.originalText = button.textContent;
    }

    if (isLoading) {
        button.disabled = true;
        button.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="margin-right: 8px;"></span>Processing...';
    } else {
        button.disabled = false;
        button.textContent = button.dataset.originalText || 'Purchase Now';
    }
}

function showApplePayForm() {
    const applePayForm = document.getElementById('apple-pay-payment-form');
    if (applePayForm) {
        applePayForm.style.display = 'block';
    }

    // Apple Pay will be processed through Stripe
    showNotification('Apple Pay will be processed through Stripe', 'info');
}

function initializeSquare() {
    console.log('Initializing Square...');

    // Prevent multiple initializations
    if (isSquareInitialized) {
        console.log('Square already initialized, skipping...');
        return;
    }

    try {
        squarePayments = Square.payments('{{ env("SQUARE_APPLICATION_ID") }}', '{{ env("SQUARE_LOCATION_ID") }}');
        isSquareInitialized = true;
        console.log('Square Payments initialized successfully');
    } catch (error) {
        console.error('Error initializing Square:', error);
        const container = document.getElementById('square-card-element');
        if (container) {
            container.innerHTML = '<p style="color: #ef4444; text-align: center;">Failed to initialize Square payment element: ' + error.message + '</p>';
        }
    }
}

function showSquareForm() {
    console.log('Showing Square form...');
    const squareForm = document.getElementById('square-payment-form');
    if (squareForm) {
        squareForm.style.display = 'block';
        console.log('Square form displayed');
    }

    // Check if Square is available
    console.log('Square available:', typeof Square !== 'undefined');
    console.log('Square payments object:', squarePayments);
    console.log('Square card object:', squareCard);

    // Initialize Square card if not already done
    if (squarePayments && !squareCard) {
        console.log('Creating Square card...');
        createSquareCard();
    } else if (!squarePayments) {
        console.log('Square payments not available, trying to initialize...');
        if (typeof Square !== 'undefined') {
            initializeSquare();
            // Try again after initialization
            setTimeout(() => {
                if (squarePayments && !squareCard) {
                    createSquareCard();
                }
            }, 1000);
        } else {
            console.log('Square SDK not loaded');
            const container = document.getElementById('square-card-element');
            if (container) {
                container.innerHTML = '<p style="color: #ef4444; text-align: center;">Square SDK is not loaded. Please refresh the page.</p>';
            }
        }
    }
}

async function createSquareCard() {
    console.log('Creating Square card...');
    if (!squarePayments) {
        console.log('Square payments not available');
        return;
    }

    try {
        console.log('Creating Square card input...');
        squareCard = await squarePayments.card();
        console.log('Square card object created, attaching to element...');
        await squareCard.attach('#square-card-element');

        console.log('Square card created and attached successfully');
    } catch (error) {
        console.error('Error creating Square card:', error);
        const container = document.getElementById('square-card-element');
        if (container) {
            container.innerHTML = '<p style="color: #ef4444; text-align: center;">Error creating card input: ' + error.message + '</p>';
        }
    }
}

async function purchaseSubscription() {
    if (!selectedPlan || selectedPlan === 'free') {
        showNotification('Please select a valid plan', 'error');
        return;
    }

    if (!selectedPaymentMethod) {
        showNotification('Please select a payment method', 'error');
        return;
    }

    if (!document.getElementById('agreeTerms').checked) {
        showNotification('Please agree to the terms and conditions', 'error');
        return;
    }

    setPurchaseButtonLoading(true);

    try {
        // Handle different payment methods
        if (selectedPaymentMethod === 'stripe') {
            await processStripePayment();
        } else if (selectedPaymentMethod === 'paypal') {
            // PayPal is handled in the onApprove callback
            showNotification('Please complete the PayPal payment above', 'info');
            return;
        } else if (selectedPaymentMethod === 'google-pay') {
            if (!googlePayToken) {
                showNotification('Please use the Google Pay button above to authorize payment', 'info');
                return;
            }
            await processPaymentWithMethod('google-pay', googlePayToken);
        } else if (selectedPaymentMethod === 'apple-pay') {
            // Apple Pay processed through Stripe
            await processPaymentWithMethod(selectedPaymentMethod);
        } else if (selectedPaymentMethod === 'square') {
            // Square payment processed with card
            await processSquarePayment();
        } else {
            // For other methods
            await processPaymentWithMethod(selectedPaymentMethod);
        }
    } finally {
        setPurchaseButtonLoading(false);
    }
}

async function processStripePayment() {
    if (!stripe || !stripeCardElement) {
        showNotification('Stripe not initialized', 'error');
        return;
    }

    const {error, paymentMethod} = await stripe.createPaymentMethod({
        type: 'card',
        card: stripeCardElement,
    });

    if (error) {
        showNotification('Stripe payment failed: ' + error.message, 'error');
        return;
    }

    await processPaymentWithMethod('stripe', paymentMethod.id);
}

async function processSquarePayment() {
    if (!squareCard) {
        showNotification('Square card input not initialized', 'error');
        return;
    }

    try {
        // Tokenize the card
        const result = await squareCard.tokenize();
        if (result.status === 'OK') {
            // Process payment with the token
            await processPaymentWithMethod('square', result.token);
        } else {
            console.error('Square tokenization failed:', result.errors);
            showNotification('Card tokenization failed: ' + (result.errors[0]?.detail || 'Unknown error'), 'error');
        }
    } catch (error) {
        console.error('Square payment error:', error);
        showNotification('Square payment failed: ' + error.message, 'error');
    }
}

async function processPaymentWithMethod(method, paymentMethodId = null) {
    try {
        // Get plan details from the selected plan
        const planNameEl = document.getElementById('selectedPlanName');
        const planPriceEl = document.getElementById('selectedPlanPrice');
        const planPriceText = planPriceEl.textContent.replace('£', '').replace('Free', '0');
        const planPrice = parseFloat(planPriceText) || 0;

        // Map payment methods to their display names
        const paymentMethodNames = {
            'stripe': 'Stripe',
            'google-pay': 'Google Pay (via Stripe)',
            'apple-pay': 'Apple Pay (via Stripe)',
            'paypal': 'PayPal',
            'square': 'Square'
        };

        const response = await fetch(@json(url('/api/subscription/purchase')), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                plan_id: selectedPlan,
                plan_type: planNameEl.textContent.toLowerCase().replace(/\s+/g, '-'),
                price: planPrice,
                duration: 30, // 30 days (1 month)
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
            throw new Error('Subscription endpoint returned a non-JSON response. Status: ' + response.status);
        }

        if (!response.ok) {
            throw new Error(data.message || ('Subscription request failed with status ' + response.status));
        }

        if (data.success) {
            showNotification('Subscription purchased successfully!', 'success');
            closeSubscriptionPopup();

            // Update UI to show new subscription status
            updateSubscriptionStatus(data.subscription);
        } else {
            showNotification(data.message || 'Failed to purchase subscription', 'error');
        }
    } catch (error) {
        console.error('Subscription purchase error:', error);
        showNotification(error.message || 'Failed to purchase subscription. Please try again.', 'error');
    }
}

function updateSubscriptionStatus(subscription) {
    // Update the UI to show the new subscription status
    // This could include updating plan buttons, showing subscription info, etc.
    console.log('Subscription updated:', subscription);

    // Reload page to show updated subscription features
    setTimeout(() => {
        window.location.reload();
    }, 1500);
}

// Pass subscription features to global scope for music player
@if(auth()->check() && isset($subscriptionFeatures))
    window.userSubscriptionFeatures = @json($subscriptionFeatures);
@else
    window.userSubscriptionFeatures = {
        ad_free: false,
        unlimited_playlists: false,
        playlist_limit: 3,
        offline_downloads: false,
        offline_download_limit: 0,
        high_quality: false,
        exclusive_content: false,
        tip_artists: false,
        personalized_recommendations: false,
        supporter_badge: false,
        trending_access: true,
    };
@endif

// Load personalized recommendations
async function loadPersonalizedRecommendations() {
    try {
        const response = await fetch('/api/recommendations?limit=10', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            }
        });

        const data = await response.json();

        if (data.success && data.data.length > 0) {
            // Display recommendations in favorites grid
            const favoritesGrid = document.getElementById('favoritesGrid');
            if (favoritesGrid) {
                favoritesGrid.innerHTML = data.data.map(song => `
                    <div class="favorite-song-card" onclick="playSong(${song.id}, '${song.name.replace(/'/g, "\\'")}', '${song.artist.replace(/'/g, "\\'")}', '${song.thumbnail}', '${song.music_file}')">
                        <div class="favorite-song-header">
                            <img src="${song.thumbnail || '/storage/default-music.jpg'}" alt="${song.name}" class="favorite-song-thumbnail" onerror="this.src='/storage/default-music.jpg'">
                            <div class="favorite-song-info">
                                <h5 class="favorite-song-title">${song.name}</h5>
                                <p class="favorite-song-artist">${song.artist}</p>
                            </div>
                        </div>
                        <div class="favorite-song-actions">
                            <button class="favorite-song-btn play-btn" onclick="event.stopPropagation(); playSong(${song.id}, '${song.name.replace(/'/g, "\\'")}', '${song.artist.replace(/'/g, "\\'")}', '${song.thumbnail}', '${song.music_file}')">
                                <i class="fas fa-play"></i>
                            </button>
                        </div>
                    </div>
                `).join('');
            }
        } else {
            alert(data.message || 'No personalized recommendations available at this time.');
        }
    } catch (error) {
        console.error('Error loading recommendations:', error);
        alert('Error loading personalized recommendations. Please try again.');
    }
}

window.loadPersonalizedRecommendations = loadPersonalizedRecommendations;

// Load playlists when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Only load playlists if user is authenticated
    @if(auth()->check())
    loadPlaylists();
    loadFavorites();
    @if(isset($subscriptionFeatures) && ($subscriptionFeatures['offline_downloads'] ?? false))
    loadMyDownloads();
    @endif
    @endif
});

// Load user's downloaded songs
async function loadMyDownloads() {
    try {
        const response = await fetch('/api/downloads/my', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            }
        });

        const data = await response.json();
        const downloadsGrid = document.getElementById('downloadsGrid');

        if (!downloadsGrid) return;

        if (data.success && data.data.length > 0) {
            downloadsGrid.innerHTML = data.data.map(song => `
                <div class="favorite-song-card" onclick="playSong(${song.id}, '${song.name.replace(/'/g, "\\'")}', '${song.artist.replace(/'/g, "\\'")}', '${song.thumbnail}', '${song.music_file}')">
                    <div class="favorite-song-header">
                        <img src="${song.thumbnail || '/storage/default-music.jpg'}" alt="${song.name}" class="favorite-song-thumbnail" onerror="this.src='/storage/default-music.jpg'">
                        <div class="favorite-song-info">
                            <h5 class="favorite-song-title">${song.name}</h5>
                            <p class="favorite-song-artist">${song.artist}</p>
                            <small style="color: #b794f6;">Downloaded: ${new Date(song.downloaded_at).toLocaleDateString()}</small>
                        </div>
                    </div>
                    <div class="favorite-song-actions">
                        <button class="favorite-song-btn play-btn" onclick="event.stopPropagation(); playSong(${song.id}, '${song.name.replace(/'/g, "\\'")}', '${song.artist.replace(/'/g, "\\'")}', '${song.thumbnail}', '${song.music_file}')">
                            <i class="fas fa-play"></i>
                        </button>
                        <button class="favorite-song-btn remove-btn" onclick="event.stopPropagation(); removeDownload(${song.id})" title="Remove download">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            `).join('');
        } else {
            downloadsGrid.innerHTML = `
                <div class="no-favorites">
                    <i class="fas fa-download"></i>
                    <h4>No Downloads Yet</h4>
                    <p>Download songs to listen offline</p>
                </div>
            `;
        }
    } catch (error) {
        console.error('Error loading downloads:', error);
        const downloadsGrid = document.getElementById('downloadsGrid');
        if (downloadsGrid) {
            downloadsGrid.innerHTML = `
                <div class="no-favorites">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h4>Error Loading Downloads</h4>
                    <p>Please try again later</p>
                </div>
            `;
        }
    }
}

// Remove download
async function removeDownload(musicId) {
    if (!confirm('Remove this song from your downloads?')) return;

    try {
        const response = await fetch(`/api/download/${musicId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            }
        });

        const data = await response.json();

        if (data.success) {
            loadMyDownloads(); // Reload downloads
            alert('Download removed successfully');
        } else {
            alert(data.message || 'Error removing download');
        }
    } catch (error) {
        console.error('Error removing download:', error);
        alert('Error removing download. Please try again.');
    }
}

window.loadMyDownloads = loadMyDownloads;
window.removeDownload = removeDownload;
</script>

@endsection
