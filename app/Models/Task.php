<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'completed'
    ];

    protected $casts = [
        'completed' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function markAsCompleted(): void
    {
        $this->update(['completed' => true]);
    }

    public function markAsUncompleted(): void
    {
        $this->update(['completed' => false]);
    }

    public function toggleCompleted(): void
    {
        $this->update(['completed' => !$this->completed]);
    }
}