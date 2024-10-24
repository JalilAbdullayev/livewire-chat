<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use Livewire\Component;

class Chat extends Component {
    public $query;
    public $selected;

    public function mount() {
        $this->selected = Conversation::findOrFail($this->query);
    }

    public function render() {
        return view('livewire.chat.chat');
    }
}
