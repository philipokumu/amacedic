@component('mail::message')
# Introduction

This order is almost due!!.

@component('mail::button', ['url' => route('writer.inprogress.index')])
Submit
@endcomponent

Thanks,<br>
{{env('APP_NAMEWE')}} &copy; {{ date('Y') }} All rights reserved.
@endcomponent
