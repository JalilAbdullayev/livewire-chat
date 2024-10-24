<?php

namespace App\Livewire;

use App\Models\Conversation;
use App\Models\User;
use Livewire\Component;

class Users extends Component {
    public function message($id) {
        $user = auth()->user()->id;
        $existing = Conversation::where(function($query) use ($user, $id) {
            $query->where('sender_id', $user)->where('receiver_id', $id);
        })->orWhere(function($query) use ($user, $id) {
            $query->where('receiver_id', $user)->where('sender_id', $id);
        })->first();
        if($existing) {
            return $this->redirect(route('chat', ['query' => $existing->id]), navigate: true);
        }
        $create = Conversation::create([
            'sender_id' => $user,
            'receiver_id' => $id
        ]);
        return $this->redirect(route('chat', ['query' => $create->id]), navigate: true);
    }

    public function render() {
        return view('livewire.users', [
            'users' => User::where('id', '!=', auth()->user()->id)->get()
        ]);
    }
}
