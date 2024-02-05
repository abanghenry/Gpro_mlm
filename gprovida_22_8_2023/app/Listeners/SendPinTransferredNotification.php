<?php

namespace App\Listeners;

use App\Events\PinTransferred;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPinTransferredNotification
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
     * @param  \App\Events\PinTransferred  $event
     * @return void
     */
    public function handle(PinTransferred $event)
    {
        //
    }
}
