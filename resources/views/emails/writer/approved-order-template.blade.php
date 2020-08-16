@component('mail::message')
# Dear writer

Order #{{$order->id}} has been approved.

@component('mail::button', ['url' => url('/writer')])
My account
@endcomponent

{{env('APP_NAMEWE')}} &copy; {{ date('Y') }} All rights reserved.
@endcomponent