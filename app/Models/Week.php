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
}
