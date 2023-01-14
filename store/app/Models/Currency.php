<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'rate',
    ];

    public function scopeBySlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    public function isMain(): bool
    {
        return $this->is_main === 1;
    }
}
