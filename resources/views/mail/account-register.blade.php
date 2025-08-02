<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Welcome to {{ config('app.name') }}</title>
    </head>

    <body style="font-family: Manrope, serif; background-color: #E0E0E0; padding: 20px;">
        <div style="background-color: #ffffff; padding: 30px; border-radius: 10px; max-width: 600px; margin: auto;">
            @if($mail['user']->role === 'partner')
                <h2 style="color: #000000;">Welcome, Partner!</h2>
                <p style="font-size: 16px; color: #1E1E1E;">Hi {{ $mail['user']->first_name . ' ' . $mail['user']->last_name ?? 'there' }},</p>

                <p style="font-size: 16px; color: #1E1E1E;">
                    Thank you for registering on <strong>{{ config('app.name') }}</strong> - the trusted platform to list and rent warehouse spaces.
                </p>

                <p style="font-size: 16px; color: #1E1E1E;">
                    Your account is currently under review. Once approved, you'll be able to:
                    <br>- Add and manage your warehouse listings
                    <br>- Receive inquiries and bookings
                    <br>- Get visibility from businesses across the region
                </p>

                <p style="font-size: 16px; color: #1E1E1E;">
                    We'll notify you via email once your account is approved. After that, you can log in and start listing your warehouses.
                </p>
            @else
                <h2 style="color: #333333;">Welcome to {{ config('app.name') }}</h2>
                <p style="font-size: 16px; color: #1E1E1E;">Hi {{ $mail['user']->first_name . ' ' . $mail['user']->last_name ?? 'there' }},</p>

                <p style="font-size: 16px; color: #1E1E1E;">
                    Thank you for signing up to <strong>{{ config('app.name') }}</strong>, your go-to platform to find and book warehouse spaces.
                </p>

                <p style="font-size: 16px; color: #1E1E1E;">
                    Your account is currently under review. Once it's approved, you'll be able to:
                    <br>- Browse warehouses using advanced search filters
                    <br>- Compare listings and pricing
                    <br>- Book the right space for your business
                </p>

                <p style="font-size: 16px; color: #1E1E1E;">
                    You'll receive another email once your account is approved. Then you can log in and begin exploring.
                </p>
            @endif

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