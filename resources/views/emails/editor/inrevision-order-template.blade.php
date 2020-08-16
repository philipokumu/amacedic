@component('mail::message')
# Dear editor

Order #{{$order->id}} has been returned for revision. 

Kindly login to checkout the issues raised.

<strong>Instruction:</strong> {{$revisionInstruction->revisionInstructions}}<br>
<strong>From:</strong> {{$revisionInstruction->messageSender}}

@component('mail::button', ['url' => route('editor.inrevision.show',$order)])
Login
@endcomponent

{{env('APP_NAMEWE')}} &copy; {{ date('Y') }} All rights reserved.
@endcomponent