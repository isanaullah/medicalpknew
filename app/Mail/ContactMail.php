<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject($this->details['subject'])
                    ->from($this->details['email'], $this->details['name'])
                    ->replyTo($this->details['email'], $this->details['name'])
                    ->view('emails.contact')
                    ->with([
                        'name' => $this->details['name'],
                        'email' => $this->details['email'],
                        'messageBody' => $this->details['message'],
                        'ip' => $this->details['ip'] ?? 'N/A',
                        'user_agent' => $this->details['user_agent'] ?? 'N/A',
                    ]);
    }
}
