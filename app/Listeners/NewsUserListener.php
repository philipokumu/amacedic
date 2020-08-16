<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\NewsUserEvent;
use App\User;
use App\Mail\User\NewsUserMail;
use Illuminate\Support\Facades\Mail;

class NewsUserListener implements ShouldQueue
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
        $userEmails = User::pluck('email');

        foreach ($userEmails as $email) {
        sleep(3);
        Mail::to($email)->send(new NewsUserMail($event->news));
        }
    }
}
