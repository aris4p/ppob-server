<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class kirimEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data_email;

    public function __construct($data)
    {
        $this->data_email = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {


        
        return $this->view('mail.test')
                    ->subject($this->data_email['subject'])
                    ->from($this->data_email['sender_name']);
    }
}
