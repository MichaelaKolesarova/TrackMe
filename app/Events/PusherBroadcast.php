<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class PusherBroadcast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public int $id;
    /**
     * Create a new event instance.
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        /*
        return [
            new PrivateChannel('channel-name'),
        ];
        */
        return ['public'];
    }

    public function broadcastAs(): string
    {
        /*
        return [
            new PrivateChannel('channel-name'),
        ];
        */
        return 'chat';
    }

    public function broadcastWith(): array
    {
        $payload = ['id' => $this->id];
        Log::info('Broadcast Payload:', $payload);
        return $payload;
    }

}
