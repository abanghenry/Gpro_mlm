<?php

namespace App\Listeners;

use App\Events\UserUpgraded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendUserUpgradeNotification
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
     * @param  \App\Events\UserUpgraded  $event
     * @return void
     */
    public function handle(UserUpgraded $event)
    {
        //
    }
}
