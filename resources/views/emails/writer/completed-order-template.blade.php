@component('mail::message')
# Dear writer

Order #{{$order->id}} has been marked as completed.

@component('mail::button', ['url' => url('/writer/login')])
My account
@endcomponent

{{env('APP_NAMEWE')}} &copy; {{ date('Y') }} All rights reserved.
@endcomponent