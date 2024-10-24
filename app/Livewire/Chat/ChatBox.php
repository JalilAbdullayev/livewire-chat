<?php

namespace App\Livewire\Chat;

use App\Models\Message;
use Livewire\Component;

class ChatBox extends Component {
    public $selected;
    public $body;

    public function sendMessage() {
        $this->validate(['body' => 'required|string']);
        Message::create([
            'conversation_id' => $this->selected->id,
            'sender_id' => auth()->user()->id,
            'receiver_id' => $this->selected->getReceiver()->id,
            'body' => $this->body
        ]);
        $this->reset('body');
    }

    public function render() {
        return view('livewire.chat.chat-box');
    }
}
