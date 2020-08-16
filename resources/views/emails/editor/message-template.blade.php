@component('mail::message')
# Dear {{$message['recipient']}}

{{$message['message']}}

@component('mail::button', ['url' => url('/editor/login')])
My account
@endcomponent

<strong>From:</strong> {{$message['messageSender']}}

{{env('APP_NAMEWE')}} &copy; {{ date('Y') }} All rights reserved.
@endcomponent
