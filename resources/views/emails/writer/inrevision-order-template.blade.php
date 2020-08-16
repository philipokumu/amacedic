@component('mail::message')
# Dear writer

Order #{{$order->id}} has been returned for revision. 

Kindly login and address issues raised.

<strong>Instruction:</strong> {{$revisionInstruction->revisionInstructions}}<br>
<strong>From:</strong> {{$revisionInstruction->messageSender}}

@component('mail::button', ['url' => route('writer.inrevision.show',$order)])
Login
@endcomponent

{{env('APP_NAMEWE')}} &copy; {{ date('Y') }} All rights reserved.
@endcomponent