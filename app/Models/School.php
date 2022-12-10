<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'level_id',
        'director',
        'mobile',
        'idcard',
    ];

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }
}
