<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Admin;
use App\Mail\Admin\CompletedOrderAdminMail;
use App\Mail\User\CompletedOrderUserMail;
use App\Mail\Writer\CompletedOrderWriterMail;
use Illuminate\Support\Facades\Mail;

class CompletedOrderListener implements ShouldQueue
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
        Mail::to($event->order->user->email)->send(new CompletedOrderUserMail($event->order));

        sleep(3);
        Mail::to($event->order->writer->email)->send(new CompletedOrderWriterMail($event->order));
        
        foreach ($adminEmails as $email) {
            sleep(3);
            Mail::to($email)->send(new CompletedOrderAdminMail($event->order));
        }
    }
}
