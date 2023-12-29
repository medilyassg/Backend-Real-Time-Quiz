<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NextQuestion implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $pin;
    public $state;
    public $index;
    public function __construct($pin,$state,$index)
    {
        $this->pin=$pin;
        $this->state=$state;
        $this->index=$index;
    }

    public function broadcastOn()
    {
        return new Channel("next-question-{$this->pin}");
    }
}
