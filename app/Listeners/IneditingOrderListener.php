<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Admin;
use App\Editor;
use App\Mail\Admin\IneditingOrderAdminMail;
use App\Mail\Editor\IneditingOrderEditorMail;
use Illuminate\Support\Facades\Mail;

class IneditingOrderListener implements ShouldQueue
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
        $editorEmails = Editor::pluck('email');
        
        foreach ($editorEmails as $email) {
            sleep(2);
            Mail::to($email)->send(new IneditingOrderEditorMail($event->order));
        }

        foreach ($adminEmails as $email) {
            sleep(2);
            Mail::to($email)->send(new IneditingOrderAdminMail($event->order));
        }
    }
}
