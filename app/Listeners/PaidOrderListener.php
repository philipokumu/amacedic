<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Admin;
use App\Writer;
use App\Order;
use App\Mail\Admin\PaidOrderAdminMail;
use App\Mail\User\PaidOrderUserMail;
use App\Mail\Writer\PaidOrderWriterMail;
use Illuminate\Support\Facades\Mail;

class PaidOrderListener implements shouldQueue
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

        $userId = Order::where('id',$event->orderId)->pluck('user_id');
        $userEmail = User::where('id',$userId)->pluck('email');

        $writerEmails = Writer::pluck('email');

        sleep(3);
        foreach ($adminEmails as $email) {
            Mail::to($email)->send(new PaidOrderAdminMail());
        }
        try {
            sleep(3);
            Mail::to($userEmail)->send(new PaidOrderUserMail());

        } catch (Exception $e) {
                    
            report($e);

        }

        sleep(3);
        foreach ($writerEmails as $email) {
        Mail::to($email)->send(new PaidOrderWriterMail());
        }
    }
}
