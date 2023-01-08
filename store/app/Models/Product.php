<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'price', 'category_id', 'description', 'image',
        'new', 'hit', 'recommend'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getPriceForCount()
    {
        if(!is_null($this->pivot)) {
            return $this->pivot->count * $this->price;
        }

        return $this->price;
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
}
