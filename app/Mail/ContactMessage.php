<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMessage extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $name, $email, $content;

    public $forMe;

    /**
     * Create a new message instance.
     *
     * @param array $data
     * @param bool $forMe
     */
    public function __construct(array $data, $forMe = true)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->content = $data['message'];
        $this->forMe = $forMe;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.contact')
            ->subject($this->forMe ? 'New Message' : 'Message Confirmation')
            ->from($this->forMe ? $this->email : config('mail.address'), 'Veo\'s Contact Form');
    }
}
