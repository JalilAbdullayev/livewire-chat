<?php

namespace App\Livewire\Chat;

use App\Models\Message;
use Livewire\Component;

class ChatBox extends Component {
    public $selected;
    public $body;
    public $loaded;
    public int $paginate = 10;
    protected $listeners = ['loadMore'];

    public function loadMore() {
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

    public function mount() {
        $this->loadMessages();
    }

    public function sendMessage() {
        $this->validate(['body' => 'required|string']);
        $create = Message::create([
            'conversation_id' => $this->selected->id,
            'sender_id' => auth()->user()->id,
            'receiver_id' => $this->selected->getReceiver()->id,
            'body' => $this->body,
        ]);
        $this->reset('body');
        $this->dispatch('scroll-bottom');
        $this->loaded->push($create);
        $this->selected->updated_at = now();
        $this->selected->save();
        $this->dispatch('refresh')->to('chat.chat-list');
    }

    public function render() {
        return view('livewire.chat.chat-box');
    }
}
