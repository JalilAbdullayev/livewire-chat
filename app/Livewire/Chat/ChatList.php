<?php

namespace App\Livewire\Chat;

use Livewire\Attributes\On;
use Livewire\Component;

class ChatList extends Component {
    public $selected;
    public $query;
    protected $listeners = ['refresh' => '$refresh'];

    #[On('refresh')]
    public function refresh() {
        $this->dispatch('scroll-top');
    }

    public function render() {
        $user = auth()->user();
        return view('livewire.chat.chat-list', [
            'conversations' => $user->conversations()->latest('updated_at')->get()
        ]);
    }
}
