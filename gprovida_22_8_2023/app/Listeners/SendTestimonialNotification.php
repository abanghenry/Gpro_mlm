<?php

namespace App\Listeners;

use App\Events\TestimonialCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendTestimonialNotification
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
     * @param  \App\Events\TestimonialCreated  $event
     * @return void
     */
    public function handle(TestimonialCreated $event)
    {
        //
    }
}
