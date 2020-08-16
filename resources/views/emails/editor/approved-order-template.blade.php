@component('mail::message')
# Dear editor

Order #{{$order->id}} has been approved.

@component('mail::button', ['url' => url('/editor')])
My account
@endcomponent

{{env('APP_NAMEWE')}} &copy; {{ date('Y') }} All rights reserved.
@endcomponent