<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotifAnnonce extends Mailable
{

    public $message_id;
    public $annonce_id;

    /**
     * Create a new message instance.
     */
    public function __construct($message_id, $annonce_id)
    {
        $this->message_id = $message_id;
        $this->annonce_id = $annonce_id;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notification',
            from: env('MAIL_FROM_ADDRESS')
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.notifannonce',
            with: array(
                'message_id' => $this->message_id,
                'annonce_id' => $this->annonce_id
            )
        );
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
