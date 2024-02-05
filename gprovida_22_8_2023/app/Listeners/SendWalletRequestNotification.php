<?php

namespace App\Listeners;

use App\Events\WalletRequested;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendWalletRequestNotification
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
     * @param  \App\Events\WalletRequested  $event
     * @return void
     */
    public function handle(WalletRequested $event)
    {
        //
    }
}
