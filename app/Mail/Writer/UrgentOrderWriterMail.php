<?php

namespace App\Mail\Writer;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UrgentOrderWriterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($qualifiedOrder, $OrderRemainingTime)
    {
        $this->qualifiedOrder = $qualifiedOrder;
        $this->OrderRemainingTime = $OrderRemainingTime;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Order #'.$this->qualifiedOrder->id.' '.'expires in less than'.' '.$this->OrderRemainingTime.' hours!')
                            ->from('support@aqualitypapers.com')
                            ->markdown('emails.writer.urgent-order-template');
    }
}
