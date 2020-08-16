<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Admin;
use App\Mail\Admin\UnassignedOrderAdminMail;
use Illuminate\Support\Facades\Mail;

class UnassignedOrderListener implements ShouldQueue
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
        
        foreach ($adminEmails as $email) {
        sleep(4);
        Mail::to($email)->send(new UnassignedOrderAdminMail($event->order));
        }
    }
}
