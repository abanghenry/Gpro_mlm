<?php

namespace App\Events;

use App\Models\Support;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SupportTicketUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $reply;
    public $parent;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Support $reply, Support $parent)
    {
        $this->reply  = $reply;
        $this->parent = $parent;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
