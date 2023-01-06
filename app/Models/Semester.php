<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Semester extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'school_year',
        'status',
    ];

    public function weeks(): HasMany
    {
        return $this->hasMany(Week ::class);
    }

    public function status(): string
    {
        return $this->status ? 'Active' : 'Inactive';
    }
}
