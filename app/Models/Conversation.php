<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conversation extends Model {
    use SoftDeletes;

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

    public function scopeWhereNotDeleted($query) {
        $userId = auth()->user()->id;
        return $query->where(function($query) use ($userId) {
            #Where message is not deleted
            $query->whereHas('messages', function($query) use ($userId) {
                $query->where(function($query) use ($userId) {
                    $query->where('sender_id', $userId)->orWhereNull('sender_deleted_at');
                })->orWhere(function($query) use ($userId) {
                    $query->where('receiver_id', $userId)->orWhereNull('receiver_deleted_at');
                });
                #include conversations without messages
            })->orWhereDoesntHave('messages');
        });
    }

    public function unread(): int {
        return Message::whereConversationId($this->id)->whereReceiverId(auth()->user()->id)->whereNull('read_at')->count();
    }

    public function isReadByUser(): bool {
        $user = auth()->user();
        $last = $this->messages()->latest()->first();
        if($last) {
            return $last->read_at !== null && $last->sender_id === $user->id;
        }
    }
}
