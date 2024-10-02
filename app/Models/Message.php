<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model {
    use HasFactory;

    protected $fillable = [
        'body',
        'sender_id',
        'receiver_id',
        'sender_deleted_at',
        'receiver_deleted_at',
        'read_at'
    ];

    protected array $dates = [
        'read_at',
        'sender_deleted_at',
        'receiver_deleted_at'
    ];

    public function conversation(): BelongsTo {
        $this->belongsTo(Conversation::class);
    }

    public function isRead(): bool {
        return $this->read_at !== null;
    }
}
