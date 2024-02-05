<?php

namespace App\Listeners;

use App\Events\EmailBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailBroadcast
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
     * @param  \App\Events\EmailBroadcast  $event
     * @return void
     */
    public function handle(EmailBroadcast $event)
    {
        //
    }
}
