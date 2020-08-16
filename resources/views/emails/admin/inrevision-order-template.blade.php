@component('mail::message')
# Dear admin

Order #{{$order->id}} has been returned for revision.

<strong>Instruction:</strong> {{$revisionInstruction->revisionInstructions}} <br>
<strong>From:</strong> {{$revisionInstruction->messageSender}}

@component('mail::button', ['url' => route('admin.inrevision.index')])
Check it out
@endcomponent

{{env('APP_NAMECA')}} &copy; {{ date('Y') }} All rights reserved.
@endcomponent