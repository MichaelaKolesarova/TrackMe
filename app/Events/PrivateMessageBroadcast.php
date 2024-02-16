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

class PrivateMessageBroadcast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public int $id;
    public int $from;
    public int $to;
    /**
     * Create a new event instance.
     */
    public function __construct(int $id, int $from, int $to)
    {
        $this->id = $id;
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {

        return ['user.'.$this->from];
        //return new PrivateChannel('user');//.auth()->id());
        //return new PrivateChannel('user.'.auth()->id());

    }

    public function broadcastAs(): string
    {
        /*
        return [
            new PrivateChannel('channel-name'),
        ];
        */
        return 'private-chat.'.$this->to;
    }

    public function broadcastWith(): array
    {
        $payload = ['id' => $this->id];
        Log::info('Broadcast Payload:', $payload);
        return $payload;
    }

}
