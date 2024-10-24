<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model {
    use HasFactory;

    protected $fillable = [
        'receiver_id',
        'sender_id'
    ];

    public function messages(): HasMany {
        return $this->hasMany(Message::class);
    }

    public function getReceiver(): User {
        if($this->sender_id === auth()->user()->id) {
            return User::firstWhere('id', $this->receiver_id);
        }
        return User::firstWhere('id', $this->sender_id);
    }
}