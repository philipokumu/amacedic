<?php

namespace App\Mail\Writer;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewsWriterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $news;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($news)
    {
        $this->news = $news;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('A-Quality News: '.$this->news['title'])->from('support@aqualitypapers.com')
                                                        ->markdown('emails.writer.news-template');
    }
}
