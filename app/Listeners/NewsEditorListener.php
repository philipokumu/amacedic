<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Editor;
use App\Mail\Editor\NewsEditorMail;
use Illuminate\Support\Facades\Mail;

class NewsEditorListener implements ShouldQueue
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
        
        $editorEmails = Editor::pluck('email');
        
        foreach ($editorEmails as $email) {
        sleep(3);
        Mail::to($email)->send(new NewsEditorMail($event->news));
        }
    }
}
