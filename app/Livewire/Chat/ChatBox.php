<?php

namespace App\Livewire\Chat;

use App\Models\Message;
use Livewire\Component;

class ChatBox extends Component {
    public $selected;
    public $body;
    public $loaded;

    public function loadMessages() {
        $this->loaded = Message::where('conversation_id', $this->selected->id)->get();
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
            'body' => $this->body
        ]);
        $this->reset('body');
        $this->dispatch('scroll-bottom');
        $this->loaded->push($create);
    }

    public function render() {
        return view('livewire.chat.chat-box');
    }
}
