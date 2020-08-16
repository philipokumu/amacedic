@component('mail::message')
# Dear Writer

A new order has been posted. Login to bid.

@component('mail::button', ['url' => route('writer.unassigned.index')])
Login
@endcomponent

{{env('APP_NAMEWE')}} &copy; {{ date('Y') }} All rights reserved.
@endcomponent

