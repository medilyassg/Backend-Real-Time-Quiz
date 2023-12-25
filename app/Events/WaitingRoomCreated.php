<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WaitingRoomCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pin;
    public $waitingRoom;

    public function __construct($pin, $waitingRoom)
    {
        $this->pin = $pin;
        $this->waitingRoom = $waitingRoom;
    }

    public function broadcastOn()
    {
        return new Channel("waiting-room-{$this->pin}");
    }
}
