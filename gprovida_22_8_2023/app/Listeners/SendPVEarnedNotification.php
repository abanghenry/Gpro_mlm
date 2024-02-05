<?php

namespace App\Listeners;

use App\Events\PVEarned;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPVEarnedNotification
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
     * @param  \App\Events\PVEarned  $event
     * @return void
     */
    public function handle(PVEarned $event)
    {
        //
    }
}
