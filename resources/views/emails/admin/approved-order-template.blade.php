@component('mail::message')
# Dear admin

Order #{{$order->id}} has been approved.

@component('mail::button', ['url' => url('/admin')])
My account
@endcomponent

{{env('APP_NAMECA')}} &copy; {{ date('Y') }} All rights reserved.
@endcomponent