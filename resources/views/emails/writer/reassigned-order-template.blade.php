@component('mail::message')
# Dear Writer {{$oldWriterId}}

Order #{{$order->id}} has been reassigned

Kindly stop working on the order.

@component('mail::button', ['url' => url('/writer/login')])
Login
@endcomponent

{{env('APP_NAMEWE')}} &copy; {{ date('Y') }} All rights reserved.
@endcomponent

