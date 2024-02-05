<?php

namespace App\Listeners;

use App\Events\UserActivated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendUserActivationNotification
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
     * @param  \App\Events\UserActivated  $event
     * @return void
     */
    public function handle(UserActivated $event)
    {
        //
    }
}
