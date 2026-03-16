<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset OTP - {{ config('app.name') }}</title>
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
            color: #667eea;
            margin-bottom: 10px;
        }
        .title {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .content {
            margin-bottom: 30px;
        }
        .otp-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            margin: 30px 0;
        }
        .otp-code {
            font-size: 48px;
            font-weight: bold;
            letter-spacing: 10px;
            margin: 20px 0;
            font-family: 'Courier New', monospace;
        }
        .otp-label {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 10px;
        }
        .info-box {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 4px solid #667eea;
        }
        .warning-box {
            background-color: #fff3cd;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 4px solid #ffc107;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            color: #666;
            font-size: 14px;
        }
        .security-note {
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
            <h1 class="title">Password Reset Verification</h1>
        </div>

        <div class="content">
            <p>Hello,</p>
            
            <p>We received a request to reset your password for your {{ config('app.name') }} account. To complete the password reset process, please use the OTP (One-Time Password) code below:</p>
            
            <div class="otp-box">
                <div class="otp-label">Your Verification Code</div>
                <div class="otp-code">{{ $otp }}</div>
                <div style="font-size: 12px; opacity: 0.9;">This code will expire in 10 minutes</div>
            </div>

            <div class="info-box">
                <strong>📝 Instructions:</strong>
                <ol style="margin: 10px 0; padding-left: 20px;">
                    <li>Enter this OTP code on the password reset page</li>
                    <li>Create your new password</li>
                    <li>Confirm your new password</li>
                </ol>
            </div>

            <div class="warning-box">
                <strong>⚠️ Security Notice:</strong>
                <p style="margin: 5px 0;">If you did not request a password reset, please ignore this email. Your account remains secure and no changes have been made.</p>
            </div>

            <div class="security-note">
                <strong>🔒 Security Tips:</strong>
                <ul style="margin: 10px 0; padding-left: 20px;">
                    <li>Never share your OTP code with anyone</li>
                    <li>This code is valid for only 10 minutes</li>
                    <li>Our team will never ask for your OTP code</li>
                </ul>
            </div>

            <p>If you're having trouble, you can request a new OTP code from the password reset page.</p>
        </div>

        <div class="footer">
            <p>Best regards,<br><strong>The {{ config('app.name') }} Team</strong></p>
            <p style="font-size: 12px; color: #999; margin-top: 15px;">
                This is an automated email. Please do not reply to this message.<br>
                If you have any questions, please contact our support team.
            </p>
        </div>
    </div>
</body>
</html>
