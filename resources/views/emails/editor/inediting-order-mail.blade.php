@component('mail::message')
# Dear editor

An order has been submitted for editing. Login to pick and edit.

@component('mail::button', ['url' => route('editor.inediting-unpicked.index')])
Login
@endcomponent

{{env('APP_NAMEWE')}} &copy; {{ date('Y') }} All rights reserved.
@endcomponent