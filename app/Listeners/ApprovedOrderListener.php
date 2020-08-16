<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Admin;
use App\Mail\Admin\ApprovedOrderAdminMail;
use App\Mail\Editor\ApprovedOrderEditorMail;
use App\Mail\Writer\ApprovedOrderWriterMail;
use Illuminate\Support\Facades\Mail;

class ApprovedOrderListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $adminEmails = Admin::pluck('email');
        
        sleep(3);
        Mail::to($event->order->editor->email)->send(new ApprovedOrderEditorMail($event->order));

        sleep(3);
        Mail::to($event->order->writer->email)->send(new ApprovedOrderWriterMail($event->order));
        
        foreach ($adminEmails as $email) {
        sleep(3);
        Mail::to($email)->send(new ApprovedOrderAdminMail($event->order));
        }
    }
}
