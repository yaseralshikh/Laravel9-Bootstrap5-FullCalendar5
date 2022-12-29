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
        'title',
        'start',
        'end',
        'user_id',
        'week_id',
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

    public function week(): BelongsTo
    {
        return $this->belongsTo(Week::class);
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";

        $query->where(function($query) use ($term){
            $query->where('title', 'like' , $term)
                ->orWhere(function ($qu) use ($term) {
                    $qu->whereHas('user', function ($q) use ($term) {
                        $q->where('name', 'like', $term);
                });
            });
        });
    }

}
