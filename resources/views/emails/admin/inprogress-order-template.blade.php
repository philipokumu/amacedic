@component('mail::message')
# Dear admin

Writer has began working on order #{{$order->id}}.

@component('mail::button', ['url' => url('/admin/login')])
My account
@endcomponent

{{env('APP_NAMECA')}} &copy; {{ date('Y') }} All rights reserved.
@endcomponent