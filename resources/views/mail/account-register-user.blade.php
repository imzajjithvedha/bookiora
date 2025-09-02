@include('mail.partials.header', ['subject' => $subject])

@if($mail['user']->role === 'partner')
    <h2 style="font-family: 'Raleway', sans-serif; font-weight: 600; margin: 0; margin-bottom: 10px;">Welcome to {{ config('app.name') }}, {{ $mail['user']->name }} 🎉</h2>

    <p style="font-size: 15px; line-height: 1.6; margin: 0; margin-bottom: 5px;">Thank you for joining <strong>{{ config('app.name') }}</strong> as a <strong>Partner</strong>! You can now list your stays, surf camps, and vehicle rentals to attract explorers from all over the world.</p>

    <p style="font-size: 15px; line-height: 1.6; margin: 0;">Get started by adding your first listing today and unlock the opportunity to grow your bookings globally.</p>

    <div style="margin-top: 25px;">
        <a style="margin: 0; background-color: #4CAF50; color: white; font-weight: bold; padding: 15px 25px; display: inline-block; font-size: 17px; text-decoration: none;" href="{{ route('partner.dashboard') }}">Go to Partner Dashboard</a>
    </div>

@elseif($mail['user']->role === 'explorer')
    <h2 style="font-family: 'Raleway', sans-serif; font-weight: 600; margin: 0; margin-bottom: 10px;">Welcome to {{ config('app.name') }}, {{ $mail['user']->name }} 🌍</h2>

    <p style="font-size: 15px; line-height: 1.6; margin: 0; margin-bottom: 5px;">We're excited to have you onboard as an <strong>Explorer</strong>! On <strong>{{ config('app.name') }}</strong>, you can browse and book amazing stays, surf camps, and vehicle rentals across the world.</p>

    <p style="font-size: 15px; line-height: 1.6; margin: 0;">Start your adventure today by exploring the best listings tailored for you.</p>

    <div style="margin-top: 25px;">
        <a style="margin: 0; background-color: #4CAF50; color: white; font-weight: bold; padding: 15px 25px; display: inline-block; font-size: 17px; text-decoration: none;" href="{{ route('home') }}">Start Exploring</a>
    </div>
@endif

@include('mail.partials.footer')