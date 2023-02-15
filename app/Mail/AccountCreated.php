<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AccountCreated extends Mailable
{
    use Queueable, SerializesModels;
    public $toEmail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($toEmail)
    {
        $this->toEmail = $toEmail;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */

    public function envelope()
    {
        return new Envelope(
            subject: 'Account Created',
        );
    }


    public function build()
    {
        return $this->view('mail.accountcreated')->with('toEmail', $this->toEmail);
    }
        /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        // return view('mail.accountcreated')->with('toEmail',$this->toEmail);
        return new Content(
            view: 'mail.accountcreated',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
