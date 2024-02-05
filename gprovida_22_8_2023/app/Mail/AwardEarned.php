<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AwardEarned extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $award;
    public $usersAward;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $award, $usersAward)
    {
        $this->user        = $user;
        $this->award       = $award;
        $this->usersAward  = $usersAward;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Award Earned',
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
            markdown: 'emails.awards.awardearned',
            with: [
                'url_home' => url('/'),
                'url_award_logo' => url('/images/rank/'.$this->award['rank_image']),
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
