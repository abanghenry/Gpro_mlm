<?php

namespace App\Mail;

use App\Models\Support;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SupportCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $support;
    public $user;
    public $forAdmin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Support $support, User $user, $isForAdmin)
    {
        $this->support = $support;
        $this->user = $user;
        $this->forAdmin = $isForAdmin;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Support Created',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        if($this->forAdmin ){
            return new Content(
                markdown: 'emails.support.created',
                with: [
                    'url' => url('admin/support/'.$this->support->id),
                    'url_home' => url('/'),
                    'url_logo' => url('/assets/images/logo-icon.png'),
                ],
            );
        }else{
            return new Content(
                markdown: 'emails.support.created',
                with: [
                    'url' => url('/support/'.base64_encode($this->support->ticket_id )),
                    'url_home' => url('/'),
                    'url_logo' => url('/assets/images/logo-icon.png'),
                ],
            );
        }

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
