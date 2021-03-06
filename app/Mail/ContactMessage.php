<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Message;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    //alternativa public e' visibile in contact.blade
    protected $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.contact')
        ->with([
            'myname' => $this->message->guest_name,
            'myemail' => $this->message->guest_email,
            'content' => $this->message->content
        ])
        ;
    }
}
