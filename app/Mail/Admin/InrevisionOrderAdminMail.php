<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InrevisionOrderAdminMail extends Mailable
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
                    ->from('support@topnotchhomeworks.com')
                    ->markdown('emails.admin.inrevision-order-template');
    }
}
