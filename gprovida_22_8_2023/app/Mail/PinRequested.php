<?php

namespace App\Mail;

use App\Models\PinRequest;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PinRequested extends Mailable
{
    use Queueable, SerializesModels;

    public $pinrequest;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(PinRequest $pinrequest, User $user)
    {
        $this->pinrequest = $pinrequest;
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Pin Requested',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.pin.request',
            with: [
                'url_home' => url('/'),
                'url_logo' => url('/assets/images/logo-icon.png'),
            ],
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
