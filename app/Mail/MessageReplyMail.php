<?php

namespace App\Mail;

use App\Models\Message;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MessageReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Message $message,
        public array $data,
    ) {}

    public function envelope(): Envelope
    {
        $fromEmail = Setting::get('email', config('mail.from.address'));
        $fromName = Setting::get('site_name', config('mail.from.name'));

        return new Envelope(
            subject: $this->data['subject'],
            replyTo: [new Address($fromEmail, is_string($fromName) ? $fromName : config('mail.from.name'))],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.message-reply',
        );
    }
}
