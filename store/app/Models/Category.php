<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'name_en',
        'description_en',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
