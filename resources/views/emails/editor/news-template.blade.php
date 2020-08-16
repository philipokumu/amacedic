@component('mail::message')
# Dear editor,

{{$news['newsItem']}}

@component('mail::button', ['url' => url('/editor/login')])
My account
@endcomponent

Thanks,<br>
{{env('APP_NAMEWE')}} support team

&copy; {{ date('Y') }} All rights reserved
@endcomponent
