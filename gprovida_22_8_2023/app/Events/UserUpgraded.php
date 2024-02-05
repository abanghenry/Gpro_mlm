<?php

namespace App\Events;

use App\Models\Package;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserUpgraded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $old_package;
    public $new_package;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Package $old_package, Package $new_package)
    {
        $this->user = $user;
        $this->old_package = $old_package;
        $this->new_package = $new_package;
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
