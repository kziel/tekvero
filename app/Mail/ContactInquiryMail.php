<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ContactInquiryMail extends Mailable
{
    use Queueable;

    /**
     * @param array{name: string, scope: string, budget: string, message: string} $inquiry
     */
    public function __construct(public array $inquiry)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Tekvero inquiry: '.$this->inquiry['name'],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-inquiry',
        );
    }

    /**
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
