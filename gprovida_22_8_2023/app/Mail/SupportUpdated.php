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

class SupportUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $reply;
    public $parent;
    public $user;
    public $forAdmin;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct(Support $reply,Support $parent, User $user, $isForAdmin)
    {
        $this->reply = $reply;
        $this->parent = $parent;
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
            subject: 'Support Updated',
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
                markdown: 'emails.support.updated',
                with: [
                    'url' => url('admin/support/'.$this->parent->id),
                    'url_home' => url('/'),
                    'url_logo' => url('/assets/images/logo-icon.png'),
                ],
            );
        }else{
            return new Content(
                markdown: 'emails.support.updated',
                with: [
                    'url' => url('/support/'.base64_encode($this->parent->ticket_id )),
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
