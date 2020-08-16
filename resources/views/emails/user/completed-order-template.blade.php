@component('mail::message')
# Dear client

Order #{{$order->id}} has been marked as completed. Login to view.

@component('mail::button', ['url' => route('user.completed.show',$order)])
Check it out
@endcomponent

{{env('APP_NAMECA')}} &copy; {{ date('Y') }} All rights reserved.
@endcomponent