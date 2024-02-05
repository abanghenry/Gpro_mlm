<?php

namespace App\Listeners;

use App\Events\PinRequested;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPinRequestedNotification
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
     * @param  \App\Events\PinRequested  $event
     * @return void
     */
    public function handle(PinRequested $event)
    {
        //
    }
}
