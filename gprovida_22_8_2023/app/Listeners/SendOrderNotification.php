<?php

namespace App\Listeners;

use App\Events\ProductOrdered;
use App\Mail\OrderInvoice;
use App\Mail\OrderPlaced;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderNotification implements ShouldQueue
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
     * @param  \App\Events\ProductOrdered  $event
     * @return void
     */
    public function handle(ProductOrdered $event)
    {
        $order= $event->order;
        $user = $event->user;

        // Place the order...
        Mail::to($user)->send(new OrderPlaced($order, $user));

        // to all Admin
        $systemAdmins = User::where('type',User::ADMIN_USER)->pluck('email');
        foreach ($systemAdmins as $recipient) {
            Mail::to($recipient)->send(new OrderPlaced($order, $user));
        }

        //Mail::to($user)->send(new OrderInvoice($order, $user));
    }
}
