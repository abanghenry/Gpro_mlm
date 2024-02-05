<?php

namespace App\Listeners;

use App\Events\PayoutSent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPayoutNotification
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
     * @param  \App\Events\PayoutSent  $event
     * @return void
     */
    public function handle(PayoutSent $event)
    {
        //
    }
}
