<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\Writer\ReassignedOrderWriterMail;
use Illuminate\Support\Facades\Mail;
use App\Writer;

class ReassignedOrderListener implements ShouldQueue
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
        $oldWriter = Writer::find($event->oldWriterId);

        Mail::to($oldWriter->email)->send(new ReassignedOrderWriterMail($event->order, $event->oldWriterId));
    }
}
