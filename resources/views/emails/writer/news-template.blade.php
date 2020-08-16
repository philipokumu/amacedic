@component('mail::message')
# Dear Writer,

{{$news['newsItem']}}

@component('mail::button', ['url' => url('/writer/login')])
My account
@endcomponent

Thanks,<br>
{{env('APP_NAMEWE')}} support team

&copy; {{ date('Y') }} All rights reserved
@endcomponent