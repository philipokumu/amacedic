@component('mail::message')
# Dear client,

Thank you for trusting in our services. We assure high quality work.

@component('mail::button', ['url' => url('/login')])
My account
@endcomponent

Thanks,<br>
{{env('APP_NAMECA')}} support team

&copy; {{ date('Y') }} All rights reserved
@endcomponent
