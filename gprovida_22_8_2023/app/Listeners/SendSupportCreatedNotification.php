<?php

namespace App\Listeners;

use App\Events\SupportTicketCreated;
use App\Mail\SupportCreated;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendSupportCreatedNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SupportTicketCreated  $event
     * @return void
     */
    public function handle(SupportTicketCreated $event)
    {
        $support= $event->support;
        $user= User::find($support->user_id);

        // send to user
        Mail::to($user)->send(new SupportCreated($support, $user, false));

        // send queue email to all admin
        $systemAdmins = User::where('type',User::ADMIN_USER)->pluck('email');
        foreach ($systemAdmins as $recipient) {
            Mail::to($recipient)->send(new SupportCreated($support, $user, true));
        }

    }
}
