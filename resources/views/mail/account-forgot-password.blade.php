<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Reset Your Password - {{ config('app.name') }}</title>
    </head>

    <body style="font-family: Manrope, serif; background-color: #E0E0E0; padding: 20px;">
        <div style="background-color: #ffffff; padding: 30px; border-radius: 10px; max-width: 600px; margin: auto;">
            <h2 style="color: #000000;">Reset Your Password</h2>

            <p style="font-size: 16px; color: #1E1E1E;">
                Hi {{ $mail['user']->first_name . ' ' . $mail['user']->last_name ?? 'there' }},
            </p>

            <p style="font-size: 16px; color: #1E1E1E; margin-bottom: 30px;">
                We received a request to reset your password. Click the button below to set a new one. If you didn't request this, you can safely ignore this email.
            </p>

            <p style="text-align: center; margin: 40px 0;">
                <a href="{{ route('reset-password', [$mail['user']->email, $mail['token']]) }}"
                style="background-color: #E31D1D; color: white; padding: 14px 30px; font-size: 16px; text-decoration: none; border-radius: 8px;">
                    Reset Password
                </a>
            </p>

            <p style="font-size: 15px; color: #1E1E1E;">
                If the button doesn't work, copy and paste the following URL into your browser:
            </p>

            <p style="font-size: 15px; color: #1E1E1E; word-break: break-all;">
                {{ route('reset-password', [$mail['user']->email, $mail['token']]) }}
            </p>

            <p style="font-size: 14px; color: #2B2D42;">
                Need help? Reach out to us at <a href="mailto:info@bookiora.com">info@bookiora.com</a>.
            </p>

            <p style="font-size: 14px; color: #2B2D42; margin-top: 10px;">
                Best regards,<br>
                <strong>{{ config('app.name') }} Team</strong>
            </p>
        </div>
    </body>
</html>