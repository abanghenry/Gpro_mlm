<?php

namespace App\Listeners;

use App\Events\OrderShipped;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendShipmentNotification
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
     * @param  \App\Events\OrderShipped  $event
     * @return void
     */
    public function handle(OrderShipped $event)
    {
        $order = $event->order;
        $user= User::find($order->user_id);
        $order->load('store');

        // send to user
        Mail::to($user)->send(new \App\Mail\OrderShipped($order, $user, false));

        // send queue email to all admin
        $systemAdmins = User::where('type',User::ADMIN_USER)->pluck('email');
        foreach ($systemAdmins as $recipient) {
            Mail::to($recipient)->send(new \App\Mail\OrderShipped($order,$user, true));
        }



    }
}
