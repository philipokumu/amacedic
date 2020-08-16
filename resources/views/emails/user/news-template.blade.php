@component('mail::message')
# Dear client,

{{$news['newsItem']}}

@component('mail::button', ['url' => url('/login')])
My account
@endcomponent

Thanks,<br>
{{env('APP_NAMECA')}} support team

&copy; {{ date('Y') }} All rights reserved
@endcomponent
