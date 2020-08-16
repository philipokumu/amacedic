<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\AssignedOrderEvent;
use App\Mail\Writer\AssignedOrderWriterMail;
use Illuminate\Support\Facades\Mail;

class AssignedOrderListener implements ShouldQueue
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
        sleep(4);

        Mail::to($event->order->writer->email)->send(new AssignedOrderWriterMail($event->order));
    }
}
