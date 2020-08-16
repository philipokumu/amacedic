<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Admin;
use App\Mail\Admin\CancelledOrderAdminMail;
use App\Mail\Editor\CancelledOrdereditorMail;
use App\Mail\Writer\CancelledOrderWriterMail;
use Illuminate\Support\Facades\Mail;

class CancelledOrderListener implements ShouldQueue
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
        Mail::to($event->order->editor->email)->send(new CancelledOrderEditorMail($event->order));

        sleep(3);
        Mail::to($event->order->writer->email)->send(new CancelledOrderWriterMail($event->order));
        
        foreach ($adminEmails as $email) {
        sleep(3);
        Mail::to($email)->send(new CancelledOrderAdminMail($event->order));
        }
    }
}
