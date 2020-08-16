@component('mail::message')
# Dear admin,

New order has been posted. Login to view and assign.

@component('mail::button', ['url' => route('admin.unassigned.index')])
Check it out
@endcomponent

Thanks,<br>
{{env('APP_NAMECA')}}  &copy; {{ date('Y') }} All rights reserved.
@endcomponent
