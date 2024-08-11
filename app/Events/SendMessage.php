<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public User $user, public string $message)
    {}

    public function broadcastOn()
    {
        return new PresenceChannel('chat');
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->user->id,
            'userName' => $this->user->name,
            'message' => $this->message,
        ];
    }
}
