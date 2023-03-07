<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'value',
        'description',
        'section',
        'office_id',
        'status',
    ];

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }

    public function value(): string
    {
        return $this->value ? __('site.close') : __('site.open');
    }

    public function status(): string
    {
        return $this->status ? __('site.active') : __('site.inActive');
    }
}
