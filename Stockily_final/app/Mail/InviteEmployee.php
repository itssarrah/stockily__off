<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;


class InviteEmployee extends Mailable
{
    use Queueable, SerializesModels;
    public $invitationLink; 
    /**
     * Create a new message instance.
     */
    public function __construct(string $invitationLink)
    {
        $this->invitationLink = $invitationLink;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
{
    return new Envelope(
        subject: 'Your Invitation Link',
        from: new Address('orchode.ensia@gmail.com')
    );
}


    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.Sending',
        );
    }

    public function build()
    {
        return $this->subject('Your Invitation Link')
                    ->view('mail.Sending')
                    ->with(['invitationLink' => $this->invitationLink]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
