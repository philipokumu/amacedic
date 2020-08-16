@component('mail::message')
# Dear admin

Writer has returned order #{{$order->id}} to bidding. Login to reassign

@component('mail::button', ['url' => route('admin.unassigned.index')])
Login
@endcomponent

{{env('APP_NAMECA')}} &copy; {{ date('Y') }} All rights reserved.
@endcomponent