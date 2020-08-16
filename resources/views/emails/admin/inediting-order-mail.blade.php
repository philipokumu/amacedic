@component('mail::message')
# Dear admin

Order #{{$order->id}} has been submitted for editing.

@component('mail::button', ['url' => url('/admin/login')])
My account
@endcomponent

{{env('APP_NAMECA')}} &copy; {{ date('Y') }} All rights reserved.
@endcomponent