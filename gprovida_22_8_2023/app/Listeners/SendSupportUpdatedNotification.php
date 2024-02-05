<?php

namespace App\Listeners;

use App\Events\SupportTicketUpdated;
use App\Mail\SupportCreated;
use App\Mail\SupportUpdated;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendSupportUpdatedNotification implements ShouldQueue
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
     * @param  \App\Events\SupportTicketUpdated  $event
     * @return void
     */
    public function handle(SupportTicketUpdated $event)
    {
        $reply= $event->reply;
        $parent= $event->parent;
        $user= User::find($reply->user_id);

        // send to user
        Mail::to($user)->send(new SupportUpdated($reply,$parent, $user, false));

        // send queue email to all admin
        $systemAdmins = User::where('type',User::ADMIN_USER)->pluck('email');
        foreach ($systemAdmins as $recipient) {
            Mail::to($recipient)->send(new SupportUpdated($reply,$parent, $user, true));
        }
    }
}
