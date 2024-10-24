<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Message;
use Livewire\Component;

class Chat extends Component {
    public $query;
    public $selected;

    public function mount() {
        $this->selected = Conversation::findOrFail($this->query);
        Message::whereConversationId($this->selected->id)->whereReceiverId(auth()->user()->id)->whereNull('read_at')->update(['read_at' => now()]);
    }

    public function render() {
        return view('livewire.chat.chat');
    }
}
