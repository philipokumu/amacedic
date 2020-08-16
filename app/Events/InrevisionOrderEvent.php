<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class InrevisionOrderEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;
    public $revisionInstruction;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($order, $revisionInstruction)
    {
        $this->order = $order;
        $this->revisionInstruction = $revisionInstruction;
    }
}
