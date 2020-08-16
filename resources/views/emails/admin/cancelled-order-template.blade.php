@component('mail::message')
# Dear admin

Order #{{$order->id}} has been cancelled.

<strong>Reason given: </strong> {{$order->clientCancelReason}} <br>

@component('mail::button', ['url' => route('admin.cancelled.show',$order)])
Respond
@endcomponent

{{env('APP_NAMECA')}} &copy; {{ date('Y') }} All rights reserved.
@endcomponent