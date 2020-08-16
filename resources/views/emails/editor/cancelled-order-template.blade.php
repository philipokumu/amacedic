@component('mail::message')
# Dear editor

Order #{{$order->id}} has been cancelled.

<strong>Reason given: </strong> {{$order->clientCancelReason}} <br>

@component('mail::button', ['url' => route('editor.cancelled.show',$order)])
Check it out
@endcomponent

{{env('APP_NAMEWE')}} &copy; {{ date('Y') }} All rights reserved.
@endcomponent