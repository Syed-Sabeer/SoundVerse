<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to {{ config('app.name') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .email-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e0e0e0;
        }
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .welcome-title {
            color: #27ae60;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .content {
            margin-bottom: 30px;
        }
        .user-info {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .info-row {
            display: flex;
            margin-bottom: 10px;
        }
        .info-label {
            font-weight: bold;
            width: 150px;
            color: #555;
        }
        .info-value {
            color: #333;
        }
        .cta-button {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: bold;
        }
        .cta-button:hover {
            background-color: #2980b9;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            color: #666;
            font-size: 14px;
        }
        .subscription-info {
            background-color: #e8f5e8;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 4px solid #27ae60;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <div class="logo">{{ config('app.name') }}</div>
            <h1 class="welcome-title">Welcome to Our Platform!</h1>
        </div>

        <div class="content">
            <p>Dear {{ $user->name }},</p>
            
            <p>Thank you for registering with {{ config('app.name') }}! We're excited to have you on board.</p>
            
            <div class="user-info">
                <h3>Your Account Details:</h3>
                <div class="info-row">
                    <span class="info-label">Name:</span>
                    <span class="info-value">{{ $user->name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email:</span>
                    <span class="info-value">{{ $user->email }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Phone:</span>
                    <span class="info-value">{{ $user->phone }}</span>
                </div>
                @if($user->user_type == 2)
                <div class="info-row">
                    <span class="info-label">Company:</span>
                    <span class="info-value">{{ $user->company_name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Contact Person:</span>
                    <span class="info-value">{{ $user->company_person_name }}</span>
                </div>
                @endif
                <div class="info-row">
                    <span class="info-label">Account Type:</span>
                    <span class="info-value">{{ $user->user_type == 2 ? 'Company' : 'Individual' }}</span>
                </div>
            </div>

            @if($user->subscription_price)
            <div class="subscription-info">
                <h3>🎉 Subscription Confirmed!</h3>
                <p><strong>Subscription Price:</strong> ${{ number_format($user->subscription_price, 2) }}</p>
                <p><strong>Payment Method:</strong> {{ ucfirst($user->payment_method) }}</p>
                <p><strong>Payment ID:</strong> {{ $user->payment_id }}</p>
                <p><strong>Purchase Date:</strong> {{ $user->subscription_purchased_at ? $user->subscription_purchased_at->format('F j, Y \a\t g:i A') : 'N/A' }}</p>
            </div>
            @endif

            <p>You can now access all the features of our platform. Here are some things you can do:</p>
            <ul>
                <li>Complete your profile setup</li>
                <li>Upload your content and media</li>
                <li>Connect with other users</li>
                <li>Explore our premium features</li>
            </ul>

            <div style="text-align: center;">
                <a href="{{ config('app.url') }}/dashboard" class="cta-button">Go to Dashboard</a>
            </div>

            <p>If you have any questions or need assistance, please don't hesitate to contact our support team.</p>
        </div>

        <div class="footer">
            <p>Best regards,<br>The {{ config('app.name') }} Team</p>
            <p>This email was sent to {{ $user->email }}. If you didn't create an account, please ignore this email.</p>
        </div>
    </div>
</body>
</html>

