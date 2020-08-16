<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Admin;
use App\Mail\Admin\MessageAdminMail;
use App\Mail\Editor\MessageEditorMail;
use Illuminate\Support\Facades\Mail;

class MessageEditorListener implements ShouldQueue
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
        Mail::to($event->message->order->editor->email)->send(new MessageEditorMail($event->message));

        if ($event->message->messageSender != 'support') {
            foreach ($adminEmails as $email) {
                sleep(3);
                Mail::to($email)->send(new MessageAdminMail($event->message));
            }
        }
    }
}
