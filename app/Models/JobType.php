<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
    ];

    public function status(): string
    {
        return $this->status ? __('site.active') : __('site.inActive');
    }
}
