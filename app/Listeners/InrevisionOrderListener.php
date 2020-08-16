<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Admin;
use App\Mail\Admin\InrevisionOrderAdminMail;
use App\Mail\Editor\InrevisionOrdereditorMail;
use App\Mail\Writer\InrevisionOrderWriterMail;
use Illuminate\Support\Facades\Mail;
use Auth;

class InrevisionOrderListener implements ShouldQueue
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

        if (Auth::guard('web')->check()) {        
            sleep(3);
            Mail::to($event->order->editor->email)->send(new InrevisionOrderEditorMail($event->order, $event->revisionInstruction));
        }

        sleep(3);
        Mail::to($event->order->writer->email)->send(new InrevisionOrderWriterMail($event->order, $event->revisionInstruction));
        
        foreach ($adminEmails as $email) {
            sleep(3);
            Mail::to($email)->send(new InrevisionOrderAdminMail($event->order, $event->revisionInstruction));
        }
    }
}
