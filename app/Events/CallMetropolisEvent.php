<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CallMetropolisEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user_id;
    public $title;
    public $body;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        $this->user_id = $post->user_id;
        $this->title   = $post->title;
        $this->body    = $post->body;
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
