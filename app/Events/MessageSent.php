<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $message;
    public $conversation;
    public $receiverId;

    /**
     * Create a new event instance.
     */
    public function __construct($user, $message, $conversation, $receiverId) {
        $this->user = $user;
        $this->message = $message;
        $this->conversation = $conversation;
        $this->receiverId = $receiverId;
    }

    /**
     * Get the channels the event should broadcast on.
     * @return array<int, Channel>
     */
    public function broadcastOn(): array {
        return [
            new Channel("users.{$this->receiverId}"),
        ];
    }

    public function broadcastWith(): array {
        return [
            'user_id' => $this->user->id,
            'conversation_id' => $this->conversation->id,
            'message_id' => $this->message->id,
            'receiver_id' => $this->receiverId,
            'type' => __CLASS__
        ];
    }
}
