<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Writer;
use App\Mail\Writer\NewsWriterMail;
use Illuminate\Support\Facades\Mail;

class NewsWriterListener implements ShouldQueue
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
        $writerEmails = Writer::pluck('email');

        foreach ($writerEmails as $email) {
            sleep(3);
            Mail::to($email)->send(new NewsWriterMail($event->news));
        }
    }
}
