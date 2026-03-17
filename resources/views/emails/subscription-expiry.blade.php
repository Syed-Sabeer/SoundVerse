<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Expiry Reminder</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            background-color: #0d0921;
            color: #333;
        }
        .wrapper {
            max-width: 620px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0,0,0,0.3);
        }
        .header {
            background: linear-gradient(135deg, #b794f6 0%, #7f5fa8 50%, #120b28 100%);
            padding: 40px 30px;
            text-align: center;
        }
        .header .logo {
            font-size: 26px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }
        .header .logo span {
            color: #e2c9ff;
        }
        .header .tagline {
            color: rgba(255,255,255,0.8);
            font-size: 13px;
        }
        .warning-badge {
            background: #fff3cd;
            border: 2px solid #ffc107;
            border-radius: 50px;
            display: inline-block;
            padding: 8px 24px;
            margin: 20px 0 0;
            font-weight: 700;
            color: #856404;
            font-size: 14px;
        }
        .content {
            padding: 35px 35px 25px;
        }
        .greeting {
            font-size: 20px;
            font-weight: 700;
            color: #120b28;
            margin-bottom: 16px;
        }
        .message {
            color: #555;
            font-size: 15px;
            line-height: 1.7;
            margin-bottom: 25px;
        }
        .plan-card {
            background: linear-gradient(135deg, #f3eeff 0%, #ede0ff 100%);
            border: 1px solid #c9a8f5;
            border-left: 5px solid #b794f6;
            border-radius: 10px;
            padding: 20px 25px;
            margin-bottom: 25px;
        }
        .plan-card .plan-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #7f5fa8;
            font-weight: 700;
            margin-bottom: 6px;
        }
        .plan-card .plan-name {
            font-size: 22px;
            font-weight: 800;
            color: #120b28;
            margin-bottom: 12px;
        }
        .plan-card .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }
        .plan-card .detail-label {
            color: #777;
        }
        .plan-card .detail-value {
            font-weight: 700;
            color: #120b28;
        }
        .countdown {
            text-align: center;
            background: #fff5f5;
            border: 2px dashed #e74c3c;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
        }
        .countdown .days-number {
            font-size: 52px;
            font-weight: 900;
            color: #e74c3c;
            line-height: 1;
        }
        .countdown .days-label {
            font-size: 15px;
            color: #e74c3c;
            font-weight: 600;
            margin-top: 4px;
        }
        .countdown .expiry-date {
            margin-top: 10px;
            font-size: 13px;
            color: #666;
        }
        .cta-section {
            text-align: center;
            margin-bottom: 25px;
        }
        .cta-btn {
            display: inline-block;
            background: linear-gradient(135deg, #b794f6 0%, #7f5fa8 100%);
            color: #ffffff !important;
            text-decoration: none;
            padding: 14px 36px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 15px;
            letter-spacing: 0.5px;
        }
        .note {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px 20px;
            font-size: 13px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 25px;
        }
        .footer {
            background: #120b28;
            padding: 25px 35px;
            text-align: center;
        }
        .footer p {
            color: rgba(255,255,255,0.6);
            font-size: 12px;
            line-height: 1.7;
        }
        .footer a {
            color: #b794f6;
        }
    </style>
</head>
<body>
<div class="wrapper">

    <!-- Header -->
    <div class="header">
        <div class="logo">Sing<span>WithMe</span></div>
        <div class="tagline">Your Music. Your Journey.</div>
        <div class="warning-badge">⚠️ Subscription Expiry Reminder</div>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="greeting">Hi {{ $userName }},</div>

        <p class="message">
            We noticed your
            @if($isArtist)
                <strong>Artist</strong>
            @else
                <strong>Listener</strong>
            @endif
            subscription plan on <strong>SingWithMe</strong> is about to expire soon.
            Don't lose access to your {{ $isArtist ? 'artist tools, royalty collection, and distribution features' : 'exclusive music, early access tracks, and premium features' }}!
        </p>

        <!-- Plan Card -->
        <div class="plan-card">
            <div class="plan-label">{{ $isArtist ? 'Artist' : 'Listener' }} Plan</div>
            <div class="plan-name">{{ $planName }}</div>
            <div class="detail-row">
                <span class="detail-label">Expiry Date</span>
                <span class="detail-value">{{ $expiryDate }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Status</span>
                <span class="detail-value" style="color: #e74c3c;">Expiring Soon</span>
            </div>
        </div>

        <!-- Countdown -->
        <div class="countdown">
            <div class="days-number">{{ $daysLeft }}</div>
            <div class="days-label">{{ $daysLeft === 1 ? 'Day' : 'Days' }} Left</div>
            <div class="expiry-date">Your plan expires on <strong>{{ $expiryDate }}</strong></div>
        </div>

        <!-- CTA -->
        <div class="cta-section">
            <a href="{{ url('/') }}" class="cta-btn">
                Renew My Plan Now →
            </a>
        </div>

        <!-- Note -->
        <div class="note">
            <strong>What happens if I don't renew?</strong><br>
            @if($isArtist)
                After your plan expires, you will lose access to premium distribution features, royalty collection, and artist analytics until you renew.
            @else
                After your plan expires, you will revert to the free plan and lose access to exclusive content and premium features until you renew.
            @endif
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>
            You're receiving this email because you have an active subscription on SingWithMe.<br>
            If you have any questions, contact us at <a href="mailto:support@singwithme.com">support@singwithme.com</a>
        </p>
        <p style="margin-top: 10px;">© {{ date('Y') }} SingWithMe. All rights reserved.</p>
    </div>

</div>
</body>
</html>
