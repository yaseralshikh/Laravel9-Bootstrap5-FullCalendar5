<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Office extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User ::class);
    }

    public function schools(): HasMany
    {
        return $this->hasMany(School ::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event ::class);
    }

    public function subtasks(): HasMany
    {
        return $this->hasMany(Subtask ::class);
    }

    public function status(): string
    {
        return $this->status ? 'Active' : 'Inactive';
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";

        $query->where(function($query) use ($term){
            $query->where('name', 'like' , $term);
        });
    }
}
