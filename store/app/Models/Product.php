<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use App\Services\CurrencyConversion;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, Translatable;

    protected $fillable = [
        'name', 'slug', 'category_id', 'description', 'image',
        'new', 'hit', 'recommend', 'name_en', 'description_en',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function skus()
    {
        return $this->hasMany(Sku::class);
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class,'property_product')
            ->withTimestamps();
    }

    public function isHit(): bool
    {
        return $this->hit === 1;
    }

    public function isNew(): bool
    {
        return $this->new === 1;
    }

    public function isRecommend(): bool
    {
        return $this->recommend === 1;
    }

    /**
     * Interact with the user's first name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function hit(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => (bool)$value,
        );
    }

    /**
     * Interact with the user's first name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function new(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => (bool)$value,
        );
    }

    /**
     * Interact with the user's first name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function recommend(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => (bool)$value,
        );
    }

    public function scopeHit($query)
    {
        return $query->where('hit', 1);
    }

    public function scopeNew($query)
    {
        return $query->where('new', 1);
    }

    public function scopeRecommend($query)
    {
        return $query->where('recommend', 1);
    }
}
