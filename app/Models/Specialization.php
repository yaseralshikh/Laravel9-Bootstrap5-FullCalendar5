<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Specialization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User ::class);
    }

    public function status(): string
    {
        return $this->status ? 'Active' : 'Inactive';
    }
}
