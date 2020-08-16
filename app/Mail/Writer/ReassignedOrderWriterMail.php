<?php

namespace App\Mail\Writer;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReassignedOrderWriterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $oldWriterId;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $oldWriterId)
    {
        $this->order = $order;
        $this->oldWriterId = $oldWriterId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Order #'.$this->order->id.' has been reassigned')
                            ->from('support@aqualitypapers.com')
                            ->markdown('emails.writer.reassigned-order-template');
    }
}
