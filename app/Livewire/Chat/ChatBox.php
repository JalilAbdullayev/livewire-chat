<?php

namespace App\Livewire\Chat;

use App\Events\MessageSent;
use App\Models\Message;
use Livewire\Component;

class ChatBox extends Component {
    public $selected;
    public $body;
    public $loaded;
    public int $paginate = 10;
    protected $listeners = ['loadMore'];

    public function getListeners(): array {
        $auth_id = auth()->user()->id;
        return ['loadMore',
            "echo:users.{$auth_id},MessageSent" => 'broadcastedNotifications'];
    }

    public function broadcastedNotifications($event) {
        if(($event['type'] === MessageSent::class) && $event['conversation_id'] === $this->selected->id) {
            $this->dispatch('scroll-bottom');
            $new = Message::find($event['message_id']);
            $this->loaded->push($new);
        }
    }

    public function loadMore(): void {
        #increment
        $this->paginate += 10;
        #call loadMessages
        $this->loadMessages();
        #update the height
        $this->dispatch('update-height');
    }

    public function loadMessages() {
        $count = Message::where('conversation_id', $this->selected->id)->count();
        $this->loaded = Message::where('conversation_id', $this->selected->id)
            ->skip($count - $this->paginate)->take($this->paginate)->get();
        return $this->loaded;
    }

    public function mount(): void {
        $this->loadMessages();
    }

    public function sendMessage(): void {
        $this->validate(['body' => 'required|string']);
        $create = Message::create([
            'conversation_id' => $this->selected->id,
            'sender_id' => auth()->user()->id,
            'receiver_id' => $this->selected->getReceiver()->id,
            'body' => $this->body,
        ]);
        $this->reset('body');
        #scroll to bottom
        $this->dispatch('scroll-bottom');
        #push the message
        $this->loaded->push($create);
        #update conversation
        $this->selected->updated_at = now();
        $this->selected->save();
        #refresh chat-list
        $this->dispatch('refresh')->to('chat.chat-list');

        #broadcast
        event(new MessageSent(auth()->user(), $create, $this->selected, $this->selected->getReceiver()->id));
    }

    public function render() {
        return view('livewire.chat.chat-box');
    }
}
