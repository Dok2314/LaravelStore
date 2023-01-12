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
        'email',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')
            ->withPivot('count')
            ->withTimestamps();
    }

    public function calculateFullSum()
    {
        $sum = 0;

        foreach ($this->products()->withTrashed()->get() as $product) {
            $sum += $product->getPriceForCount();
        }

        return $sum;
    }

    public static function getFullSum()
    {
        return session('full_order_sum', 0);
    }

    public static function changeFullSum($changeSum)
    {
        $sum = self::getFullSum() + $changeSum;
        session(['full_order_sum' => $sum]);
    }

    public function saveOrder($phone, $email)
    {
        if($this->status == 0) {
            $this->phone  = $phone;
            $this->email  = $email;
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

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public static function eraseOrderSum()
    {
        session()->forget('full_order_sum');
    }
}
