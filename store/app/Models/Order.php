<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product', 'product_id', 'order_id')
            ->withPivot('count')
            ->withTimestamps();
    }

    public function getFullPrice()
    {
        $sum = 0;

        foreach ($this->products as $product) {
            $sum += $product->getPriceForCount();
        }

        return $sum;
    }
}
