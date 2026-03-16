<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Reset Password</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f9f9f9; padding: 40px;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background: #fff; border: 1px solid #eee;">
        <tr>
            <td style="padding: 30px;">
                <h2>Hello!</h2>
                <p>Click the button below to reset your password:</p>

                <table cellpadding="0" cellspacing="0" style="margin: 20px 0;">
                    <tr>
                        <td align="center" bgcolor="#3490dc" style="border-radius: 4px;">
                            <a href="{{ $resetUrl }}" target="_blank" style="color: #fff; text-decoration: none; padding: 12px 24px; display: inline-block;">Reset Password</a>
                        </td>
                    </tr>
                </table>

                <p>If you did not request a password reset, no further action is required.</p>
                <p>Regards,<br><strong>SingWithMe</strong></p>

                <hr style="margin: 30px 0; border: none; border-top: 1px solid #eee;" />

                <p style="font-size: 12px; color: #777;">
                    If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your browser:<br />
                    <a href="{{ $resetUrl }}">{{ $resetUrl }}</a>
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
