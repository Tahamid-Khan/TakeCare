<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'to',
        'from',
        'subject',
        'message',
        'attachment',
        'user_id',
        'voice'
    ];

    public function toDept(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'to');
    }

    public function fromDept(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'from');
    }
    public function replies(): HasMany
    {
        return $this->hasMany(MessageReply::class, 'message_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
