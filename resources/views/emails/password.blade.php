@component('mail::message')
# Reset Password

You requested a password reset. Click the button below to reset your password:

@component('mail::button', ['url' => $url])
Reset Password
@endcomponent

If you did not request this, please ignore this email.

Thanks,  
{{ config('app.name') }}
@endcomponent
