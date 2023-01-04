<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'phone',
        'user_id',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')
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

    public function saveOrder($phone)
    {
        if($this->status == 0) {
            $this->phone  = $phone;
            $this->status = 1;
            $this->save();

            session()->forget('orderId');

            return true;
        }

        return false;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
