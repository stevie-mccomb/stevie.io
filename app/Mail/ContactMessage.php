<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\ValidatedInput;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public string $firstName;
    public string $lastName;
    public string $email;
    public string $phone;
    public string $content;

    /**
     * Create a new message instance.
     */
    public function __construct(ValidatedInput $fields)
    {
        $this->firstName = $fields->first_name;
        $this->lastName = $fields->last_name;
        $this->email = $fields->email;
        $this->phone = $fields->phone ?? '';
        $this->content = $fields->message;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            to: config('mail.to.address'),
            subject: 'Stevie.IO :: Contact Message',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact-message',
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
