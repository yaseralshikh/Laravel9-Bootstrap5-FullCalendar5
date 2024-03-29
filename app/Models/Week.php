<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Week extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'start',
        'end',
        'semester_id',
        'active',
        'status',
    ];

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event ::class);
    }

    public function status(): string
    {
        return $this->status ? 'Active' : 'Inactive';
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";

        $query->where(function($query) use ($term){
            $query->where('title', 'like' , $term)
                ->orWhere('start', 'like' , $term)
                ->orWhere('end', 'like' , $term);
        });
    }
}
