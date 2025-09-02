@include('mail.partials.header', ['subject' => $subject])

<h2 style="font-family: 'Raleway', sans-serif; font-weight: 600; margin: 0; margin-bottom: 10px;">New User Registration on {{ config('app.name') }} 🎉</h2>

<p style="font-size: 15px; line-height: 1.6; margin: 0; margin-bottom: 5px;">A new user has just registered on your platform:</p>

<table style="width: 100%; margin: 20px 0; border-collapse: collapse;">
    <tr>
        <td style="padding: 8px; font-weight: bold; font-size: 15px;">Name:</td>
        <td style="padding: 8px; font-size: 15px;">{{ $mail['user']->name }}</td>
    </tr>
    <tr>
        <td style="padding: 8px; font-weight: bold; font-size: 15px;">Email:</td>
        <td style="padding: 8px; font-size: 15px;">{{ $mail['user']->email }}</td>
    </tr>
    <tr>
        <td style="padding: 8px; font-weight: bold; font-size: 15px;">Role:</td>
        <td style="padding: 8px; font-size: 15px;">{{ ucfirst($mail['user']->role) }}</td>
    </tr>
    <tr>
        <td style="padding: 8px; font-weight: bold; font-size: 15px;">Registered At:</td>
        <td style="padding: 8px; font-size: 15px;">{{ $mail['user']->created_at->format('F j, Y, g:i A') }}</td>
    </tr>
</table>

<p style="font-size: 15px; line-height: 1.6; margin: 0;">You can review their profile or manage users in the admin dashboard.</p>

<div style="margin-top: 25px;">
    <a style="margin: 0; background-color: #4CAF50; color: white; font-weight: bold; padding: 15px 25px; display: inline-block; font-size: 17px; text-decoration: none;" href="{{ route('admin.users.edit', $mail['user']->id) }}">Go to Admin Dashboard</a>
</div>

@include('mail.partials.footer')