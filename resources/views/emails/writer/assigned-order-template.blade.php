@component('mail::message')
# Dear Writer {{$order->writer_id}}

Order #{{$order->id}} has been assigned to you

Login, accept and start working on the order

@component('mail::button', ['url' => route('writer.assigned.index',$order)])
Login
@endcomponent

{{env('APP_NAMEWE')}} &copy; {{ date('Y') }} All rights reserved.
@endcomponent

