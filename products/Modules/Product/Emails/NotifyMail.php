<?php

namespace Modules\Product\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = array('name' => "Virat Gandhi");

        Mail::send(['text' => 'mail'], $data, function ($message) {
            $message->to('abc@gmail.com', 'Tutorials Point')->subject
            ('Laravel Basic Testing Mail');
            $message->from('xyz@gmail.com', 'Virat Gandhi');
        });
        echo "Basic Email Sent. Check your inbox.";

    }
}
