<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'semester',
        'title',
        'start',
        'end',
        'user_id',
        'color',
        'status',
    ];

    public function status(): string
    {
        return $this->status ? 'Active' : 'Inactive';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
