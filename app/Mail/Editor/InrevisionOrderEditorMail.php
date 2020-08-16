<?php

namespace App\Mail\Editor;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InrevisionOrderEditorMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $revisionInstruction;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $revisionInstruction)
    {
        $this->order = $order;
        $this->revisionInstruction = $revisionInstruction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Order #'.$this->order->id.' has been returned for revision')
                    ->from('support@aqualitypapers.com')
                    ->markdown('emails.editor.inrevision-order-template');
    }
}
