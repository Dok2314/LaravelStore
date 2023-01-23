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
        'currency_id',
        'sum',
    ];

    public function skus()
    {
        return $this->belongsToMany(Sku::class, 'order_sku', 'order_id','sku_id')
            ->withPivot(['count', 'price'])
            ->withTimestamps();
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function calculateFullSum()
    {
        $sum = 0;

        foreach ($this->skus()->withTrashed()->get() as $sku) {
            $sum += $sku->getPriceForCount();
        }

        return $sum;
    }

    public function getFullSum()
    {
        $sum = 0;

        foreach ($this->skus as $sku) {
            $sum += $sku->price * $sku->countInOrder;
        }

        return $sum;
    }

    public function saveOrder($phone, $email)
    {
        $this->phone  = $phone;
        $this->email  = $email;
        $this->status = 1;
        $this->sum = $this->getFullSum();

        $skus = $this->skus;

        $this->save();

        foreach ($skus as $skuInOrder) {
            $this->skus()->attach($skuInOrder, [
                'count' => $skuInOrder->countInOrder,
                'price' => $skuInOrder->price,
            ]);
        }

        session()->forget('order');

        return true;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
