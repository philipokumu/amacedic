@component('mail::message')
# Dear {{$message['recipient']}}

{{$message['message']}}

<strong>From:</strong> {{$message['messageSender']}}

@component('mail::button', ['url' => url('/writer/login')])
My account
@endcomponent

{{env('APP_NAMEWE')}} &copy; {{ date('Y') }} All rights reserved.
@endcomponent
